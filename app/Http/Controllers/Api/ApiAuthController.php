<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\registerPostRequest;
use App\Http\Requests\loginPostRequest;
use App\Http\Requests\ForgotPassword;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\User;
use App\Models\doctorReferral;
use App\Models\Api\patientDetails;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Token;
use App\Models\Admin\PatientRasMaster;
use App\Models\ConsentAnswer;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Str;

class ApiAuthController extends BaseController
{
    public function register(registerPostRequest $request)
    {

        try {
            DB::beginTransaction();

            $Patients = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'identity_number' => $request->identity_number,
                'role_id' => '5',
                'email' =>  $request->email,
                'password' => bcrypt($request->password),
                'status' => '1'
            ]);

            $Patient_id =  $Patients->id;

            $patient = User::find($Patient_id);

            if (!empty($Patient_id)) {

                $contactDetail = new patientDetails;

                $contactDetail->user_id = $Patient_id;
                $contactDetail->passport_SAID = $request->passport_SAID;
                $contactDetail->date_of_birth =  $request->date_of_birth;
                $contactDetail->referring_provider = $request->referring_provider;
                $contactDetail->next_of_kin = $request->next_of_kin;
                $contactDetail->name = $request->name;
                $contactDetail->surname = $request->surname;
                $contactDetail->gender = $request->gender;
                $contactDetail->EZMed_number = $request->EZMed_number;
                $contactDetail->essenital_contact_type = $request->essenital_contact_type;

                $contactDetail->country_code = $request->country_code;
                $contactDetail->contact_number = $request->contact_number;

                $contactDetail->alternative_contact_number = $request->alternative_contact_number;
                $contactDetail->alternative_country_code = $request->alternative_country_code;
                $contactDetail->home_number = $request->home_number;
                $contactDetail->home_country_code = $request->home_country_code;
                $contactDetail->work_number = $request->work_number;
                $contactDetail->work_country_code = $request->work_country_code;
                // $contactDetail->fax_number = $request->fax_number;
                // $contactDetail->fax_country_code = $request->fax_country_code;
                // $contactDetail->non_essential_same_essential_detail = ($request->non_essential_same_essential_detail) ? $request->non_essential_same_essential_detail : '0';
                $contactDetail->agree_share_contact = ($request->agree_share_contact) ? $request->agree_share_contact : '0';
                $contactDetail->non_essenital_contact_type = $request->non_essenital_contact_type;
                $contactDetail->unsubscribe_non_essential_email = ($request->unsubscribe_non_essential_email) ? $request->unsubscribe_non_essential_email : '1';
                $contactDetail->unsubscribe_non_essential_sms = ($request->unsubscribe_non_essential_sms) ? $request->unsubscribe_non_essential_sms : '1';

                // $contactDetail->physical_address = $request->physical_address;
                // $contactDetail->complex_name = $request->complex_name;
                // $contactDetail->unit_no = $request->unit_no;

                // $contactDetail->street_name = $request->street_name;
                $contactDetail->address_1 = $request->address_1;
                $contactDetail->address_2 = $request->address_2;
                $contactDetail->city = $request->city;
                $contactDetail->province = $request->province;
                $contactDetail->country = $request->country;
                $contactDetail->postal_code = $request->postal_code;

                $contactDetail->funder_type  = $request->funder_type;

                // Medical Scheme //

                $contactDetail->medical_aid  = $request->medical_aid;
                $contactDetail->medical_aid_number = $request->medical_aid_number;
                $contactDetail->medical_aid_plan = $request->medical_aid_plan;
                $contactDetail->patient_dependant_code = $request->patient_dependant_code;

                // Insure //

                $contactDetail->insure_membership_number  = $request->insure_membership_number;
                $contactDetail->insure_medical_aid_plan = $request->insure_medical_aid_plan;
                $contactDetail->contact_person = $request->contact_person;

                // Private //

                $contactDetail->id_number  = $request->id_number;
                $contactDetail->cell_number = $request->cell_number;
                $contactDetail->email_address = $request->email_address;

                $patient->patientDetails()->save($contactDetail);
                DB::commit();
            }
            $token = $Patients->createToken('token')->accessToken;
            $success['token'] =  $token;
            $success['name'] =  $Patients->first_name . ' ' . $Patients->last_name;
            $success['id'] =  $Patients->id;


            return $this->sendResponse($success, 'User register successfully.');
        } catch (QueryException $e) {
            DB::rollBack();
            Log::error('Database query error: ' . $e->getMessage());
            toastr()->error($e->getMessage());
            return $this->sendErrorResponse("something went wrong", $e->getMessage());
        }
    }

    public function refferingProvider()
    {
        $doctor = User::whereIn('role_id', [3, 4])->get();
        if (count($doctor) != 0) {

            return $this->sendResponse($doctor, 'Refering provider');
        }
    }

    public function userLogin(loginPostRequest $request)
    {

        if ($request->user_type == '1') {

            if (Auth::attempt(['identity_number' => $request->identity_number, 'password' => $request->password])) {
                $doctors = Auth::user();

                if ($doctors->status == '1') {
                    Token::where('user_id', $doctors->id)->delete();

                    $success['token'] =  $doctors->createToken('token')->accessToken;
                    $success['id'] = $doctors->id;
                    $success['name'] = $doctors->first_name . ' ' . $doctors->last_name;
                    return $this->sendResponse($success, 'User login successfully.');
                } else {
                    return $this->sendErrorResponse('inactive', 'Your account is inactive please contact to admin');
                }
            } else {
                return $this->sendErrorResponse('Unauthorised', 'Your identity number or password is wrong');
            }
        } else {
            $role = 5; // Client
            if (Auth::attempt(['identity_number' => $request->identity_number, 'password' => $request->password, 'role_id' => $role])) {

                $patient = Auth::user();
                $checkRASComplated = PatientRasMaster::where(['patient_id' => $patient->id, 'test_type' => '0'])->count();
                $checkConsentAns = ConsentAnswer::where(['patient_id' => $patient->id])->count();
                $success['consent_done'] = false;
                if ($checkConsentAns != 0) {
                    $success['consent_done'] = true;
                }

                if ($patient->status == '1') {
                    Token::where('user_id', $patient->id)->delete();
                    if ($checkRASComplated == 0) {
                        $iscompleted = false;
                    } else {

                        $iscompleted = true;
                    }
                    $success['token'] =  $patient->createToken('token')->accessToken;
                    $success['id'] = $patient->id;
                    $success['name'] = $patient->first_name . ' ' . $patient->last_name;
                    $success['ras_complated'] = $iscompleted;
                    return $this->sendResponse($success, 'User login successfully.');
                } else {
                    if ($patient->status == '0') {
                        return $this->sendErrorResponse('inactive', 'Your account is inactive please contact to admin');
                    }
                    return $this->sendErrorResponse('inactive', 'Your RAS submited and under review please contact to admin');
                }
            } else {
                return $this->sendErrorResponse('Unauthorised', 'Your identity number or password is wrong');
            }
        }
    }

    public function forgotPassword(ForgotPassword $request)
    {
        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        $mailIs = Mail::send('email.forgetPassword', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });


        if ($mailIs) {
            return $this->sendResponse('successfully', 'We have e-mailed your password reset link!');
        }
        return $this->sendErrorResponse('error', 'Something went wrong');
    }
}
