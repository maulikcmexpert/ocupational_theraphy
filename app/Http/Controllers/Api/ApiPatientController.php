<?php

namespace App\Http\Controllers\Api;


use App\Http\Requests\notesPostRequest;
use App\Http\Requests\notesListPostRequest;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\Admin\GroupDoctorAssignment;
use App\Models\Admin\Group;
use App\Models\User;
use App\Models\doctorReferral;
use App\Models\GroupPatientAssignment;
use App\Models\Admin\Group_session;
use App\Models\Api\patientDetails;
use App\Models\Api\Note;
use App\Models\Api\Therapist_notes;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin\RasQuestion;
use App\Models\Admin\RasRating;
use App\Models\Admin\PatientRasMaster;
use App\Models\Admin\PatientApoms;
use App\Models\Admin\Attendance;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ApiPatientController  extends BaseController
{

    public function userInfo()
    {
        $patient_id = Auth::guard('api')->user()->id;
        $patient =  User::with(['patientDetails'])->where('id', $patient_id)->get();

        $patientProfile = [];

        $patientData['id'] = $patient[0]->id;
        $patientData['first_name'] = ($patient[0]->first_name != NULL) ? $patient[0]->first_name : "";
        $patientData['last_name'] = ($patient[0]->last_name != NULL) ? $patient[0]->last_name : "";
        $patientData['email'] = ($patient[0]->patientDetails->email != NULL) ? $patient[0]->patientDetails->email : "";
        $patientData['date_of_birth'] = ($patient[0]->patientDetails->date_of_birth != NULL) ? $patient[0]->patientDetails->date_of_birth : "";
        $patientData['country_code'] = ($patient[0]->patientDetails->country_code != NULL) ? $patient[0]->patientDetails->country_code : "";
        $patientData['contact_number'] = ($patient[0]->patientDetails->contact_number != NULL) ? $patient[0]->patientDetails->contact_number : "";
        $patientData['identity_number'] = ($patient[0]->identity_number != NULL) ? $patient[0]->identity_number : "";
        $patientData['essenital_contact_type'] = ($patient[0]->patientDetails->essenital_contact_type != NULL) ? $patient[0]->patientDetails->essenital_contact_type : "";
        $patientData['physical_address'] = ($patient[0]->patientDetails->physical_address != NULL) ? $patient[0]->patientDetails->physical_address : "";
        $patientData['complex_name'] = ($patient[0]->patientDetails->complex_name != NULL) ? $patient[0]->patientDetails->complex_name : "";
        $patientData['unit_no'] = ($patient[0]->patientDetails->unit_no != NULL) ? $patient[0]->patientDetails->unit_no : "";
        $patientData['street_name'] = ($patient[0]->patientDetails->street_name != NULL) ? $patient[0]->patientDetails->street_name : "";
        $patientData['city'] = ($patient[0]->patientDetails->city != NULL) ? $patient[0]->patientDetails->city : "";
        $patientData['postal_code'] = ($patient[0]->patientDetails->postal_code != NULL) ? $patient[0]->patientDetails->postal_code : "";
        $patientData['province'] = ($patient[0]->patientDetails->province != NULL) ? $patient[0]->patientDetails->province : "";
        $patientData['country'] = ($patient[0]->patientDetails->country != NULL) ? $patient[0]->patientDetails->country : "";
        $patientData['sessions_completed'] = $this->checkSessionComplated($patient_id);
        $patientProfile[] = $patientData;


        return $this->sendResponse($patientProfile, 'User Information.');
    }

    // public function checkSessionComplated($id)
    // {
    //     $assignedGroups = GroupPatientAssignment::where(['patient_id' => $id, 'in_out' => 'in'])->pluck('group_id');

    //     if (count($assignedGroups) != 0) {
    //         $allSessionsCompletedForAllGroups = true;

    //         foreach ($assignedGroups as $groupId) {
    //             // Get the total number of sessions in the group
    //             $totalSessions = Group::findOrFail($groupId)->group_session()->count();

    //             // Get the number of sessions attended by the patient for this group
    //             $attendedSessions = Attendance::whereHas('group_session', function ($query) use ($groupId) {
    //                 $query->where('group_id', $groupId);
    //             })
    //                 ->where('patient_id', $id)
    //                 ->count();

    //             // Check if all sessions are completed for the patient in this group
    //             if ($attendedSessions !== $totalSessions) {
    //                 $allSessionsCompletedForAllGroups = false;
    //                 break; // No need to check other groups if any group has pending sessions
    //             }
    //         }
    //         $checkFianlRASComplated = PatientRasMaster::where(['test_type' => '1', 'patient_id' => $id])->count();
    //         if ($checkFianlRASComplated != 0) {

    //             return  $allSessionsCompletedForAllGroups = false;
    //         } else {
    //             return $allSessionsCompletedForAllGroups;
    //         }
    //     } else {
    //         return  $allSessionsCompletedForAllGroups = false;
    //     }
    // }

    public function checkSessionComplated($id)
    {
        $assignedGroups = GroupPatientAssignment::where(['patient_id' => $id, 'in_out' => 'in'])->pluck('group_id');

        if (count($assignedGroups) != 0) {
            $allSessionsCompletedForAllGroups = true;

            $checkGroupLastsession = Group::select(DB::raw('MAX(end_session_date) as max_date'))->whereIn('id', $assignedGroups)->first();
            $currentDate = date('Y-m-d');
            if ($checkGroupLastsession->max_date > $currentDate) {

                return  $allSessionsCompletedForAllGroups = false;
            }


            $checkFianlRASComplated = PatientRasMaster::where(['test_type' => '1', 'patient_id' => $id])->count();
            if ($checkFianlRASComplated != 0) {

                return  $allSessionsCompletedForAllGroups = false;
            } else {
                return $allSessionsCompletedForAllGroups;
            }
        } else {
            return  $allSessionsCompletedForAllGroups = false;
        }
    }

    public function home()
    {
        $patient_id  = Auth::guard('api')->user()->id;
        $homeData = [];
        // program //
        $groups =  GroupPatientAssignment::with('group')->where(['patient_id' => $patient_id, 'in_out' => 'in'])->get();
        $group = [];

        foreach ($groups as $value) {
            $groupData['group_id'] = $value->group_id;
            $groupData['group_name'] = $value->group->group_name;
            // your OT //
            $ot_doctor = GroupDoctorAssignment::with(['doctor.doctorDetails', 'doctor.groupDoctorAssignments.group'])->where('group_id', $value->group_id)->get();
            $groupOTDoctor = [];
            foreach ($ot_doctor as $value) {
                $OTDoctor['id'] = $value->doctor_id;
                $OTDoctor['image'] =  asset('storage/doctor/' . $value->doctor->image);
                $OTDoctor['doctor_name'] = $value->doctor->first_name;
                $OTDoctor['profession'] = $value->doctor->doctorDetails->profession;
                $assignedGroup = [];
                foreach ($value->doctor->groupDoctorAssignments as $value) {

                    array_push($assignedGroup, $value->group->group_name);
                    $OTDoctor['groups'] = implode(',', $assignedGroup);
                }
                $groupOTDoctor[] = $OTDoctor;
            }
            $groupData['your_ot'] = $groupOTDoctor;
            // your OT //

            // Sessions //

            $group_session = Group_session::select('id', 'session_name', 'session_details', 'session_date')->where('group_id', $value->group_id)->get();
            $sessionData = [];

            $session_status = "";
            foreach ($group_session as $value) {
                $patientSessionStatus = Attendance::where(['session_id' => $value->id, 'patient_id' => $patient_id])->get();

                if ($value->session_date <= date('Y-m-d')) {

                    if (count($patientSessionStatus) != 0) {
                        $session_status = 0;
                    } else {
                        $session_status = 1;
                    }
                } else {

                    $session_status = 2;
                }



                $group_sessions['id'] = $value->id;
                $group_sessions['session_name'] = $value->session_name;
                $group_sessions['session_date'] = $value->session_date;
                $group_sessions['session_details'] = ($value->session_details == NULL) ? "" : $value->session_details;
                $group_sessions['session_status'] = $session_status;

                $sessionData[] = $group_sessions;
            }
            $groupData['sessions'] = $sessionData;

            //   $groupData['sessions'] = $group_session;

            $group[] = $groupData;

            // Sessions //
        }
        $homeData['program'] = $group;
        $homeData['sessions_completed'] = $this->checkSessionComplated($patient_id);

        return $this->sendResponse($homeData, 'Home');
    }


    public function editProfile(Request $request)
    {


        $patientId = Auth::guard('api')->user()->id;
        $patient = User::with('patientDetails')->findOrFail($patientId);

        $setAddress = explode(',', $request->physical_address);

        if (!empty($patient)) {
            $patient->first_name = $request->first_name;
            $patient->last_name = $request->last_name;
            if ($patient->save() == true) {
                $patient->patientDetails->date_of_birth = $request->date_of_birth;
                $patient->patientDetails->essenital_contact_type = $request->essenital_contact_type;
                $patient->patientDetails->email = $request->email;
                $patient->patientDetails->country_code = $request->country_code;
                $patient->patientDetails->contact_number = $request->contact_number;

                // $patient->patientDetails->physical_address = $request->physical_address;
                // $patient->patientDetails->complex_name = $request->complex_name;
                // $patient->patientDetails->unit_no = $request->unit_no;
                $patient->patientDetails->street_name = $request->street_name;
                // if (array_key_exists('2', $setAddress) && isset($setAddress[2])) {
                //     $patient->patientDetails->city = $setAddress[2];
                // }
                $patient->patientDetails->city = $request->city;
                // if (array_key_exists('4', $setAddress) && isset($setAddress[4])) {
                //     $patient->patientDetails->postal_code = $setAddress[4];
                // }
                $patient->patientDetails->postal_code = $request->postal_code;
                $patient->patientDetails->province = $request->province;
                $patient->patientDetails->country = $request->country;

                // if (array_key_exists('5', $setAddress) && isset($setAddress[5])) {
                //     $patient->patientDetails->country = $setAddress[5];
                // }
                $patient->patientDetails->save();
            }

            $patientLetestData = User::with('patientDetails')->findOrFail($patientId);
            return $this->sendResponse($patientLetestData, 'User Data');
        } else {
            return $this->sendError('Unauthorised', ['error' => 'Unauthorised']);
        }
    }

    public function groupDetail(Request $request)
    {

        $groupId = $request->group_id;

        $group = Group::with(['groupDoctorAssignments.doctor.doctorDetails', 'groupDoctorAssignments.doctor.groupDoctorAssignments.group', 'group_session'])->where('id', $groupId)->get();


        $groupDetail = [];

        $groupData['id'] = $group[0]->id;
        $groupData['group_name'] = $group[0]->group_name;
        $groupOTDoctor = [];
        foreach ($group[0]->groupDoctorAssignments as $value) {
            $OTDoctor['id'] = $value->doctor->id;
            $OTDoctor['image'] =  asset('storage/doctor/' . $value->doctor->image);
            $OTDoctor['doctor_name'] = $value->doctor->first_name;
            $OTDoctor['profession'] = $value->doctor->doctorDetails->profession;
            $assignedGroup = [];

            foreach ($value->doctor->groupDoctorAssignments as $value) {

                array_push($assignedGroup, $value->group->group_name);
                $OTDoctor['groups'] = implode(',', $assignedGroup);
            }
            $groupOTDoctor[] = $OTDoctor;
        }
        $groupData['your_ot'] = $groupOTDoctor;
        $group_session = Group_session::select('id', 'session_name', 'session_details')->where('group_id', $group[0]->id)->get();

        $sessionData = [];
        foreach ($group_session as $value) {
            $group_sessions['id'] = $value->id;
            $group_sessions['session_name'] = $value->session_name;
            $group_sessions['session_details'] = ($value->session_details == NULL) ? "" : $value->session_details;
            $sessionData[] = $group_sessions;
        }
        $groupData['sessions'] = $sessionData;
        $patient_id  = Auth::guard('api')->user()->id;
        $groupData['sessions_completed'] = $this->checkSessionComplated($patient_id);
        $groupDetail[] = $groupData;
        return $this->sendResponse($groupDetail, 'Group Detail');
    }


    public function getOtAndSession(Request $request)
    {

        $groupDetail = [];
        $groupId = $request->group_id;

        $ot_list = groupDoctorAssignment::with(['doctor.doctorDetails', 'doctor.groupDoctorAssignments.group'])->where('group_id', $groupId)->get();


        $groupOTDoctor = [];
        foreach ($ot_list as $value) {
            $OTDoctor['id'] = $value->doctor->id;
            $OTDoctor['image'] =  asset('storage/doctor/' . $value->doctor->image);
            $OTDoctor['profession'] = $value->doctor->doctorDetails->profession;

            $OTDoctor['doctor_name'] = $value->doctor->first_name;
            $assignedGroup = [];

            foreach ($value->doctor->groupDoctorAssignments as $value) {

                array_push($assignedGroup, $value->group->group_name);
                $OTDoctor['groups'] = implode(',', $assignedGroup);
            }
            $groupOTDoctor[] = $OTDoctor;
        }
        $groupData['your_ot'] = $groupOTDoctor;


        $group_session = Group_session::select('id', 'session_name', 'session_details', 'session_date')->where('group_id', $groupId)->get();

        $patient_id = Auth::guard('api')->user()->id;
        $sessionData = [];
        foreach ($group_session as $value) {
            $session_status = "";
            $patientSessionStatus = Attendance::where(['session_id' => $value->id, 'patient_id' => $patient_id])->get();
            if ($value->session_date <= date('Y-m-d')) {
                if (count($patientSessionStatus) != 0) {
                    $session_status = 0;
                } else {
                    $session_status = 1;
                }
            } else {
                $session_status = 2;
            }
            $group_sessions['id'] = $value->id;
            $group_sessions['session_name'] = $value->session_name;
            $group_sessions['session_date'] = $value->session_date;
            $group_sessions['session_details'] = ($value->session_details == NULL) ? "" : $value->session_details;

            $group_sessions['session_status'] = $session_status;


            $sessionData[] = $group_sessions;
        }
        $groupData['sessions'] = $sessionData;

        $patient = Auth::guard('api')->user();

        $checkInitialRasComplated = PatientRasMaster::where(['test_type' => '0', 'patient_id' => $patient->id])->count();
        $checkFinalRasComplated = PatientRasMaster::where(['test_type' => '1', 'patient_id' => $patient->id])->count();
        $checkInitialAPOMComplated = PatientApoms::where(['test_type' => '0', 'patient_id' => $patient->id])->count();
        $checkFinalAPOMComplated = PatientApoms::where(['test_type' => '1', 'patient_id' => $patient->id])->count();

        if ($checkInitialRasComplated != 0 && $checkFinalRasComplated != 0 && $checkInitialAPOMComplated != 0 && $checkFinalAPOMComplated != 0) {

            $patientName = str_replace(' ', '_', $patient->first_name) . '_' . str_replace(' ', '_', $patient->last_name);

            if (file_exists(public_path('public/storage/pdf/') . $patientName . '.pdf')) {

                $groupData['is_discharge'] = true;
                $groupData['discharge_report_url'] =  asset('public/storage/pdf/' . $patientName . '.pdf');
            } else {
                $groupData['is_discharge'] = false;
                $groupData['discharge_report_url'] = "";
            }
        } else {

            $groupData['is_discharge'] = false;
            $groupData['discharge_report_url'] = "";
        }
        $patient_id  = Auth::guard('api')->user()->id;
        $groupData['sessions_completed'] = $this->checkSessionComplated($patient_id);
        // $groupData['sessions_completed'] = true;
        $groupDetail[] = $groupData;
        return $this->sendResponse($groupDetail, 'Ot and Sessions');
    }



    public function addNote()
    {


        $patient = Auth::guard('api')->user();

        $jsonData = file_get_contents('php://input');
        $notesData = json_decode($jsonData, true);


        $notesAllData = $notesData['data'];
        foreach ($notesAllData as $value) {


            $notes = Note::create([

                'patient_id' =>  $patient->id,
                'session_id' => $value['session_id'],
                'note' => $value['note']
            ]);
        }


        return $this->sendResponse($notes, 'Note added successfully.');
    }

    public function noteLists(notesListPostRequest $request)
    {
        if (Auth::guard('api')->check()) {
            $patient = Auth::guard('api')->user();

            $noteLists = [];
            $session_id = $request->session_id;
            $noteList['notes'] = Note::Select('id', 'note', 'patient_id', 'session_id', 'created_at', 'updated_at')->where(['patient_id' => $patient->id, 'session_id' => $session_id])->get();
            $noteList['sessions_completed'] = $this->checkSessionComplated($patient->id);
            $noteLists[] = $noteList;

            return $this->sendResponse($noteLists, 'Patient note lists');
        }
        return $this->sendError('Unauthorised', ['error' => 'Unauthorised']);
    }


    public function therapistNoteLists(notesListPostRequest $request)
    {
        if (Auth::guard('api')->check()) {
            $patient = Auth::guard('api')->user();

            $noteLists = [];
            $session_id = $request->session_id;
            $noteList['notes'] = Therapist_notes::Select('id', 'note', 'patient_id', 'session_id', 'doctor_id', 'created_at', 'updated_at')->where(['patient_id' => $patient->id, 'session_id' => $session_id])->get();
            $noteList['sessions_completed'] = $this->checkSessionComplated($patient->id);
            $noteLists[] = $noteList;

            return $this->sendResponse($noteLists, 'Therapist note lists');
        }
        return $this->sendError('Unauthorised', ['error' => 'Unauthorised']);
    }

    public function noteDetails(Request $request)
    {

        $noteDetails = Note::where('id', $request->id)->get();

        if (!$noteDetails->isEmpty()) {
            return $this->sendResponse($noteDetails, 'Note Details');
        } else {
            return $this->sendError('Data not found');
        }
    }


    public function rasInterviewQuestion()
    {
        $patient = Auth::guard('api')->user();

        $checkRAsFill = PatientRasMaster::where(['test_type' => '0', 'patient_id' => $patient->id])->count();

        if ($checkRAsFill == 0) {

            $rasQuestion = RasQuestion::get();
            $rasAnswer = RasRating::select('id', 'scale_type', 'scale')->get();

            $question = [];

            foreach ($rasQuestion as $value) {
                $questionData['id'] = $value->id;
                $questionData['question'] = $value->question;
                $questionData['answer'] = $rasAnswer;
                $question[] = $questionData;
            }
            if (!empty($question)) {
                return $this->sendResponse($question, 'Note Details');
            } else {
                return $this->sendError('Data not found');
            }
        } else {

            $checkSessionComplated =  $this->checkSessionComplated($patient->id);

            if ($checkSessionComplated == true) {

                $rasQuestion = RasQuestion::get();
                $rasAnswer = RasRating::select('id', 'scale_type', 'scale')->get();

                $question = [];

                foreach ($rasQuestion as $value) {
                    $questionData['id'] = $value->id;
                    $questionData['question'] = $value->question;
                    $questionData['answer'] = $rasAnswer;
                    $question[] = $questionData;
                }
                if (!empty($question)) {
                    return $this->sendResponse($question, 'Note Details');
                } else {
                    return $this->sendError('Data not found');
                }
            } else {

                $this->logout();
                return $this->sendErroriftokenFalse('Unauthorised', ['error' => 'Unauthorised']);
            }
        }


        return $this->sendError('Unauthorised', ['error' => 'Unauthorised']);
    }

    public function rasQuestionAnswer()
    {
        $patient_id =  Auth::guard('api')->user();


        $jsonData = file_get_contents('php://input');
        $data = json_decode($jsonData, true);

        if ($data !== null) {
            $rasQuestionAnswer = $data['ras_question_answer'];

            $checkRASExist = PatientRasMaster::where('patient_id', $patient_id->id)->count();
            if ($checkRASExist == 0) {

                foreach ($rasQuestionAnswer as $value) {
                    $patient_ras_master = new PatientRasMaster;
                    $patient_ras_master->patient_id = $patient_id->id;
                    $patient_ras_master->question_id = $value['questionID'];
                    $patient_ras_master->answer_id = $value['answerID'];
                    $patient_ras_master->test_type = '0';
                    $patient_ras_master->save();
                }
                $patient = User::find($patient_id->id);
                $patient->status = '0';
                $patient->save();
                // Log::info('API request processed successfully');
                return $this->sendResponse('RAS form', 'RAS form submited Succesfully');
            } else {
                $patientStatus = User::where('id', $patient_id->id)->get();
                if ($patientStatus[0]->status == 1) {

                    foreach ($rasQuestionAnswer as $value) {
                        $patient_ras_master = new PatientRasMaster;
                        $patient_ras_master->patient_id = $patient_id->id;
                        $patient_ras_master->question_id = $value['questionID'];
                        $patient_ras_master->answer_id = $value['answerID'];
                        $patient_ras_master->test_type = '1';
                        $patient_ras_master->save();
                    }
                }
                return $this->sendResponse('RAS form', 'RAS final form submited Succesfully');
            }
        }
        // Convert JSON data to a PHP array
        // Log::info('API request processed successfully');


    }
    /**
     * Display the specified resource.
     */
    public function logout()
    {
        if (Auth::guard('api')->check()) {
            $patient = Auth::guard('api')->user();
            Token::where('user_id', $patient->id)->delete();
            return $this->sendResponse('logout', 'logout succesfully');
        }
    }
}
