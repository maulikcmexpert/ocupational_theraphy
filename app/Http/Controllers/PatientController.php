<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Api\patientDetails;
use App\Models\Admin\Group;
use App\Models\GroupPatientAssignment;
use App\Models\doctorReferral;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PatientsPostRequest;
use App\Http\Requests\PatientsPostUpdateRequest;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\RasQuestion;
use App\Models\Admin\RasRating;
use App\Models\Admin\Attendance;
use App\Http\Requests\RasPostRequest;
use App\Models\Admin\PatientRasMaster;
use App\Models\Admin\rasQuestionCategories;
use App\Http\Requests\PatientAPOMPost;
use App\Models\Admin\GroupDoctorAssignment;
use App\Models\Admin\PatientApoms;
use App\Models\Admin\Group_session;
use App\Models\Admin\Patient_discharge_master;
use App\Http\Requests\PostchangePassword;
use App\Models\ConsentQuestion;
use Illuminate\Support\Facades\Hash;
use PDF;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['page'] = 'patient.list';
        $data['js'] = ['patient'];
        $data['role_id'] = Auth::guard('web')->user()->role_id;
        if ($request->ajax()) {
            $groups = Group::All();
            $data = User::with('patientDetails')->where('role_id', 5)->orderBy('id', 'desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('number', function ($row) {
                    static $count = 1;
                    return $count++;
                })
                ->addColumn('patient_name', function ($row) {

                    return $row->first_name . ' ' . $row->last_name;
                })
                ->addColumn('ezmed_number', function ($row) {

                    return $row->patientDetails->EZMed_number;
                })



                ->addColumn('action', function ($row) {

                    $cryptId = encrypt($row->id);
                    $edit_url = route('patient.edit', $cryptId);
                    $delete_url = route('patient.destroy', $cryptId);
                    $view = route('patient.show', $cryptId);
                    $discharge_report = route('patient.discharge_report', $cryptId);
                    $change_password_url = route('patient.changePassword', $cryptId);
                    $apomReport = route('patient.apom_assessment_report', $cryptId);
                    $check_patient_status = route('patient.check_patient_status', $cryptId);
                    $consentForm = route('patient.consentForm', $cryptId);
                    $actionBtn = ' <div class="action-icon">
                  
                    <a class="" href="' . $edit_url . '"  title="Edit"><i class="fas fa-edit" ></i></a>
                    
                    <a class="" href="javascript:;"   data-url="' . $delete_url . '"  id="delete_patient" parentID="' . $cryptId . '" title="Delete"><i class="fas fa-trash" ></i></a>';
                    $checkInitialRasComplated = PatientRasMaster::where(['test_type' => '0', 'patient_id' => $row->id])->count();
                    $checkInitialAPOMComplated = PatientApoms::where(['test_type' => '0', 'patient_id' => $row->id])->count();
                    if ($checkInitialRasComplated != 0 && $checkInitialAPOMComplated != 0) {

                        if ($row->status == 1) {
                            $actionBtn .=  '<a class=" changeStatus" patient_id="' . $cryptId . '" statusData="0" role="button" title="Active">
                            <i class="fas fa-toggle-on"></i>
                     </a>';
                        } else {
                            $actionBtn .=    '<a class=" changeStatus" patient_id="' . $cryptId . '" statusData="1" title="Inactive" role="button">
                            <i class="fas fa-toggle-off"></i>
                     </a>';
                        }
                    }
                    $actionBtn .= '<a class="" href="' . $view . '"  title="View"><i class="fas fa-eye" ></i></a>
                   ';

                    $checkInitialRasComplated = PatientRasMaster::where(['test_type' => '0', 'patient_id' => $row->id])->count();
                    $checkFinalRasComplated = PatientRasMaster::where(['test_type' => '1', 'patient_id' => $row->id])->count();
                    $checkInitialAPOMComplated = PatientApoms::where(['test_type' => '0', 'patient_id' => $row->id])->count();
                    $checkFinalAPOMComplated = PatientApoms::where(['test_type' => '1', 'patient_id' => $row->id])->count();

                    if ($checkInitialAPOMComplated != 0 && $checkFinalAPOMComplated != 0) {
                        $actionBtn .= '<a class="" href="' . $apomReport . '"  title="APOM"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                        </a>
                    ';
                    }
                    if ($checkInitialRasComplated != 0 && $checkFinalRasComplated != 0 &&  $checkInitialAPOMComplated != 0 && $checkFinalAPOMComplated != 0) {

                        $actionBtn .= '<a class="" href="' . $discharge_report . '"  title="Discharge Report"><i class="fa fa-file"></i>
                    </a>';
                    } else {
                        $total_session = GroupPatientAssignment::with(['group' => function ($query) {
                            $query->with('group_session')->withCount(['group_session']);
                        }])->where('patient_id', $row->id)->first();

                        if ($total_session != null && $total_session->group->group_session->first()->session_date <= date('Y-m-d')) {

                            $total_attendence = Attendance::where(['patient_id' => $row->id, 'group_id' => $total_session->group_id])->count();
                            $actionBtn .=   '<a href="" id="dischargeCheck" totalAttendence = "' . $total_attendence . '" totalSession = "' . $total_session->group->group_session_count . '"  title="Discharge" class="" url = "' . $check_patient_status . '" data-bs-toggle="modal" data-bs-target="#exampleModal">
                           
    <svg width="11" height="16" viewBox="0 0 11 16" fill="none" xmlns="http://www.w3.org/2000/svg">
    <g clip-path="url(#clip0_2359_4832)">
    <path d="M7.98611 11.5089C7.95833 13.5322 6.36111 15.1681 4.40278 15.1681C2.41667 15.1681 0.805556 13.5035 0.805556 11.4515C0.805556 9.3995 2.41667 7.74928 4.38889 7.74928V6.91699C1.97222 6.91699 0 8.94031 0 11.4515C0 13.9627 1.97222 15.9861 4.38889 15.9861C6.79167 15.9861 8.75 13.9771 8.77778 11.5089H7.98611Z" fill="#3699FF"/>
    <path d="M10.8473 12.226L8.23617 8.65292C8.04172 8.39462 7.73617 8.27982 7.45839 8.32287C7.4445 8.32287 7.4445 8.32287 7.43061 8.32287H5.95839V4.23318C5.95839 3.73094 5.68061 3.30045 5.26394 3.0852C5.68061 2.76951 5.95839 2.26726 5.95839 1.70762C5.95839 0.760538 5.22228 0 4.30561 0C3.38894 0 2.65283 0.760538 2.65283 1.70762C2.65283 2.28161 2.93061 2.78386 3.34728 3.0852C2.9445 3.30045 2.65283 3.73094 2.65283 4.23318V9.01166C2.65283 9.06906 2.65283 9.11211 2.66672 9.16951C2.66672 9.19821 2.65283 9.24126 2.65283 9.26996V9.3417C2.65283 9.87265 3.0695 10.2888 3.5695 10.2888H3.90283H4.6945H7.04172L9.30561 13.417C9.58339 13.7901 10.0973 13.8619 10.4584 13.5892L10.6806 13.417C11.0417 13.1444 11.1112 12.5991 10.8473 12.226Z" fill="#3699FF"/>
    <path d="M5.01367 11.4514C5.01367 11.8101 4.73589 12.0971 4.38867 12.0971C4.04145 12.0971 3.76367 11.8101 3.76367 11.4514C3.76367 11.0927 4.04145 10.8057 4.38867 10.8057C4.73589 10.8057 5.01367 11.0927 5.01367 11.4514Z" fill="#3699FF"/>
    </g>
    <defs>
    <clipPath id="clip0_2359_4832">
    <rect width="11" height="16" fill="white"/>
    </clipPath>
    </defs>
    </svg>
    
    
    </a>';
                        }
                        // $actionBtn .= '<a class="" href="' . $discharge_report . '"  title="Descharge Report"><i class="fa fa-file"></i>
                        // </a>';
                    }
                    if (Auth::guard('web')->user()->role_id != 3) {
                        $actionBtn .= '<a class="" href="' . $change_password_url . '"  title="Change Password" id="change_password_doctor" ><i class="fas fa-key"></i></a> ';
                    }
                    $actionBtn .= ' <a class="" href="' . $consentForm . '"  title="Consent Form"><i class="fa fa-wpforms" ></i></a>';

                    '</div>';
                    return $actionBtn;
                })

                ->addColumn('group_assignment', function ($row) {
                    $cryptId = encrypt($row->id);

                    $assignGroup = route('patient.groupAssign', $cryptId);
                    $checkInitialRasComplated = PatientRasMaster::where(['test_type' => '0', 'patient_id' => $row->id])->count();
                    $checkInitialAPOMComplated = PatientApoms::where(['test_type' => '0', 'patient_id' => $row->id])->count();
                    if ($checkInitialRasComplated != 0 && $checkInitialAPOMComplated != 0) {
                        return   '<a class="btn btn-primary" href="' . $assignGroup . '"  role="button" >Assign</a>';
                    }
                    return '-';
                })

                ->addColumn('ras_form', function ($row) {
                    $cryptId = encrypt($row->id);
                    $test_type = 0;
                    $rasForm = route('patient.recoveryAssessment', [$cryptId, $test_type]);


                    $checkRASInitialFormStaus = PatientRasMaster::where(['patient_id' => $row->id, 'test_type' => '0'])->count();
                    $checkRASFinalFormStaus = PatientRasMaster::where(['patient_id' => $row->id, 'test_type' => '1'])->count();

                    $classbtn = 'btn-danger';
                    if ($checkRASInitialFormStaus != 0  && $checkRASFinalFormStaus == 0) {
                        $classbtn = "btn-warning";
                    } elseif (($checkRASInitialFormStaus != 0) && ($checkRASFinalFormStaus != 0)) {
                        $classbtn = "btn-success";
                    }

                    return   '<a class="btn ' . $classbtn . '" href="' . $rasForm . '"  role="button" >RAS-24</a>';
                })


                ->addColumn('apom_form', function ($row) {
                    $cryptId = encrypt($row->id);
                    $test_type = 0;
                    $apomForm = route('patient.patientApom', [$cryptId, $test_type]);

                    $checkAPOMInitialFormStaus = PatientApoms::where(['patient_id' => $row->id, 'test_type' => '0'])->count();
                    $checkAPOMFinalFormStaus = PatientApoms::where(['patient_id' => $row->id, 'test_type' => '1'])->count();
                    $classbtn = 'btn-danger';
                    if ($checkAPOMInitialFormStaus != 0 && $checkAPOMFinalFormStaus == 0) {
                        $classbtn = "btn-warning";
                    } elseif ($checkAPOMInitialFormStaus != 0 && $checkAPOMFinalFormStaus != 0) {
                        $classbtn = "btn-success";
                    }

                    return   '<a class="btn ' . $classbtn . '" href="' . $apomForm . '"  role="button" id="startTimer" >APOM</a>';
                })


                ->rawColumns(['number', 'action', 'patient_name', 'profile', 'ezmed_number', 'ras_form', 'apom_form', 'group_assignment'])

                ->make(true);
        }

        return view('admin.main_layout', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['page'] = 'patient.add';
        $data['role_id'] = Auth::guard('web')->user()->role_id;
        $data['countryList'] = $this->countryList();
        $data['getRefferingDR'] = User::whereIn('role_id', ['4', '3'])->get();
        $data['js'] = ['patient'];
        return view('admin.main_layout', $data);
    }


    public function createConsentForm(string $id)
    {
        $paitent_id =  decrypt($id);
        $data['page'] = 'patient.consentform';
        $data['role_id'] = Auth::guard('web')->user()->role_id;
        $data['css'] = ['consent'];
        $data['patient_id'] = $id;
        $data['question'] = ConsentQuestion::get();
        return view('admin.main_layout', $data);
    }


    public function consentFormStore(Request $request, string $id)
    {
        dd($request->questions);
        foreach ($request->question_id as $val) {
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PatientsPostRequest $request)
    {


        try {
            DB::beginTransaction();
            $Patients = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'identity_number' => $request->identity_number,
                'role_id' => '5',
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
                $contactDetail->next_of_kin = $request->next_of_kin;
                $contactDetail->name = $request->name;
                $contactDetail->surname = $request->surname;
                $contactDetail->gender = $request->gender;
                $contactDetail->EZMed_number = $request->EZMed_number;
                $contactDetail->referring_provider =  $request->referring_provider;

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
                // $contactDetail->non_essential_same_essential_detail = (isset($request->non_essential_same_essential_detail)) ? $request->non_essential_same_essential_detail : '0';
                $contactDetail->agree_share_contact = (isset($request->agree_share_contact)) ? $request->agree_share_contact : '0';

                $contactDetail->non_essenital_contact_type = $request->non_essenital_contact_type;
                $contactDetail->unsubscribe_non_essential_email = (isset($request->unsubscribe_non_essential_email)) ? $request->unsubscribe_non_essential_email : '1';
                $contactDetail->unsubscribe_non_essential_sms = (isset($request->unsubscribe_non_essential_sms)) ? $request->unsubscribe_non_essential_sms : '1';
                // $contactDetail->physical_address = $request->physical_address;
                // $contactDetail->complex_name = $request->complex_name;
                // $contactDetail->unit_no = $request->unit_no;
                // $contactDetail->language = $request->language;

                // $contactDetail->street_name = $request->street_name;
                $contactDetail->address_1 = $request->address_1;
                $contactDetail->address_2 = $request->address_2;
                $contactDetail->city = $request->city;
                $contactDetail->province = $request->province;
                $contactDetail->country = $request->country;
                $contactDetail->postal_code = $request->postal_code;

                $contactDetail->funder_type  = $request->funder_type;

                $contactDetail->medical_aid  = $request->medical_aid;
                $contactDetail->medical_aid_number = $request->medical_aid_number;
                $contactDetail->medical_aid_plan = $request->medical_aid_plan;
                $contactDetail->patient_dependant_code = $request->patient_dependant_code;

                $contactDetail->insure_membership_number = $request->insure_membership_number;
                $contactDetail->insure_medical_aid_plan = $request->insure_medical_aid_plan;
                $contactDetail->contact_person = $request->contact_person;

                $contactDetail->id_number = $request->id_number;
                $contactDetail->cell_number = $request->cell_number;
                $contactDetail->email_address = $request->email_address;



                $patient->patientDetails()->save($contactDetail);


                // refer doctor //
                $referDoctor = new doctorReferral;
                $referDoctor->referring_doctor_id = $request->referring_provider;
                $referDoctor->patient_id = $Patient_id;
                $referDoctor->referral_date = date('Y-m-d');
                $referDoctor->save();
            }
            DB::commit();
            toastr()->success('Patient added successfully !');
            return redirect()->route('patient.index');
        } catch (QueryException $e) {
            DB::rollBack();
            Log::error('Database query error: ' . $e->getMessage());
            toastr()->error($e->getMessage());
            return redirect()->route('patient.create');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $paitent_id =  decrypt($id);
        $data['page'] = 'patient.patientView';
        $data['role_id'] = Auth::guard('web')->user()->role_id;
        $data['js'] = ['patient'];
        $data['PatientData'] =  User::with(['patientDetails', 'groupPatientAssignments' => function ($query) {
            $query->with('group')->where('in_out', 'in');
        }])->find($paitent_id);

        return view('admin.main_layout', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {



        $patient_id =  decrypt($id);
        $data['page'] = 'patient.edit';
        $data['role_id'] = Auth::guard('web')->user()->role_id;
        $data['countryList'] = $this->countryList();
        $data['getRefferingDR'] = User::whereIn('role_id', ['4', '3'])->get();
        $data['js'] = ['patient'];
        $data['patientDetail'] = User::with('patientDetails')->where('id', $patient_id)->get();

        $data['patientId'] = $id;
        return view('admin.main_layout', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PatientsPostUpdateRequest $request, string $id)
    {

        $patientId = decrypt($id);
        try {
            DB::beginTransaction();
            $patient = User::with('patientDetails')->findOrFail($patientId);

            if (!empty($patient)) {
                $patient->first_name = $request->first_name;
                $patient->last_name = $request->last_name;
                $patient->email = $request->email;
                $patient->identity_number =  $request->identity_number;
                if ($patient->save() == true) {

                    $patient->patientDetails->passport_SAID = $request->passport_SAID;
                    $patient->patientDetails->date_of_birth = $request->date_of_birth;
                    $patient->patientDetails->referring_provider = $request->referring_provider;
                    $patient->patientDetails->EZMed_number = $request->EZMed_number;
                    $patient->patientDetails->gender = $request->gender;
                    $patient->patientDetails->next_of_kin = $request->next_of_kin;
                    $patient->patientDetails->name = $request->name;
                    $patient->patientDetails->surname = $request->surname;

                    $patient->patientDetails->essenital_contact_type = $request->essenital_contact_type;
                    $patient->patientDetails->country_code = $request->country_code;
                    $patient->patientDetails->contact_number = $request->contact_number;
                    $patient->patientDetails->alternative_contact_number = $request->alternative_contact_number;
                    $patient->patientDetails->alternative_country_code = $request->alternative_country_code;
                    $patient->patientDetails->home_number = $request->home_number;
                    $patient->patientDetails->home_country_code = $request->home_country_code;
                    $patient->patientDetails->work_number = $request->work_number;
                    $patient->patientDetails->work_country_code = $request->work_country_code;
                    // $patient->patientDetails->fax_number = $request->fax_number;
                    // $patient->patientDetails->fax_country_code = $request->fax_country_code;
                    // $patient->patientDetails->non_essential_same_essential_detail = (isset($request->non_essential_same_essential_detail)) ? $request->non_essential_same_essential_detail : '0';
                    $patient->patientDetails->agree_share_contact = (isset($request->agree_share_contact)) ? $request->agree_share_contact : '0';
                    $patient->patientDetails->non_essenital_contact_type = $request->non_essenital_contact_type;
                    $patient->patientDetails->unsubscribe_non_essential_email = (isset($request->unsubscribe_non_essential_email)) ? $request->unsubscribe_non_essential_email : '1';
                    $patient->patientDetails->unsubscribe_non_essential_sms = (isset($request->unsubscribe_non_essential_sms)) ? $request->unsubscribe_non_essential_sms : '1';
                    // $patient->patientDetails->physical_address = $request->physical_address;
                    // $patient->patientDetails->complex_name = $request->complex_name;
                    // $patient->patientDetails->unit_no = $request->unit_no;


                    // $patient->patientDetails->street_name = $request->street_name;
                    $patient->patientDetails->address_1 = $request->address_1;
                    $patient->patientDetails->address_2 = $request->address_2;
                    $patient->patientDetails->city = $request->city;
                    $patient->patientDetails->postal_code = $request->postal_code;
                    $patient->patientDetails->province = $request->province;
                    $patient->patientDetails->country = $request->country;

                    $patient->patientDetails->funder_type  = $request->funder_type;

                    $patient->patientDetails->medical_aid  = $request->medical_aid;
                    $patient->patientDetails->medical_aid_number = $request->medical_aid_number;
                    $patient->patientDetails->medical_aid_plan = $request->medical_aid_plan;
                    $patient->patientDetails->patient_dependant_code = $request->patient_dependant_code;

                    $patient->patientDetails->insure_membership_number = $request->insure_membership_number;
                    $patient->patientDetails->insure_medical_aid_plan = $request->insure_medical_aid_plan;
                    $patient->patientDetails->contact_person = $request->contact_person;

                    $patient->patientDetails->id_number = $request->id_number;
                    $patient->patientDetails->cell_number = $request->cell_number;
                    $patient->patientDetails->email_address = $request->email_address;

                    $patient->patientDetails->save();


                    // refer doctor //

                    $checkdoctorReferral = doctorReferral::where(['patient_id' => $patientId, 'referrer_by' => NULL])->first();
                    if ($checkdoctorReferral && $checkdoctorReferral->exists()) {

                        if ($checkdoctorReferral->referring_doctor_id != $request->referring_provider) {
                            $checkdoctorReferral->referring_doctor_id = $request->referring_provider;
                            $checkdoctorReferral->patient_id = $patientId;
                            $checkdoctorReferral->referral_date = date('Y-m-d');
                            $checkdoctorReferral->save();
                        }
                    } else {
                        $referDoctor = new doctorReferral;
                        $referDoctor->referring_doctor_id = $request->referring_provider;
                        $referDoctor->patient_id = $patientId;
                        $referDoctor->referral_date = date('Y-m-d');
                        $referDoctor->save();
                    }
                }
            } else {
                toastr()->error('Patients not found');
                return redirect()->route('patient.edit', $id);
            }
            DB::commit();
            toastr()->success('Patient details updated successfully !');
            return redirect()->route('patient.index');
        } catch (QueryException $e) {
            DB::rollBack();
            Log::error('Database query error: ' . $e->getMessage());
            toastr()->error($e->getMessage());
            return redirect()->route('patient.edit', $id);
        }
    }



    public function group_assignment($id)
    {
        $data['page'] = 'patient.groupAssignment';
        $data['js'] = ['patient'];
        $data['role_id'] = Auth::guard('web')->user()->role_id;
        $data['groupData'] = Group::withCount('groupPatientAssignments')->whereHas('groupDoctorAssignments')->where('start_session_date', '>=', date('Y-m-d'))->get();
        $data['selectedGroup'] =  GroupPatientAssignment::select('group_id')->where(['patient_id' => decrypt($id), 'in_out' => 'In'])->get();
        $data['patientDetail'] = User::select(['first_name', 'last_name'])->where('id', decrypt($id))->get();
        $data['patient_id'] = $id;
        return view('admin.main_layout', $data);
    }

    public function assignGroupToPatient(Request $request)
    {

        $id = $request->patient_id;
        $patient_id = decrypt($request->patient_id);

        try {
            if (!empty($request->assignGroup) && count($request->assignGroup) != 0) {

                DB::beginTransaction();
                $patient_reffering_dr = patientDetails::where('user_id', $patient_id)->first();

                $checkGroupIsNotAssigned = $this->checkGroupIsNotAssigned($request);
                if (!empty($checkGroupIsNotAssigned)) {
                    foreach ($checkGroupIsNotAssigned as $key => $value) {
                        $AssignGroups = new GroupPatientAssignment;
                        $AssignGroups->group_id = $value;
                        $AssignGroups->patient_id = $patient_id;
                        if ($patient_reffering_dr != null && $patient_reffering_dr->referring_provider != null || $patient_reffering_dr->referring_provider != "") {

                            $AssignGroups->doctor_id = $patient_reffering_dr->referring_provider;
                        }
                        $AssignGroups->AssignmentDate = date('Y-m-d,h:i:s');
                        $AssignGroups->in_out = "In";
                        $AssignGroups->save();
                    }
                } else {
                    $patientRemoveGroup = GroupPatientAssignment::where(['patient_id' => $patient_id])->whereNotIn('group_id', $request->assignGroup)->get();

                    if (!empty($patientRemoveGroup)) {

                        foreach ($patientRemoveGroup as $key => $value) {
                            $patientRemoveGroup = GroupPatientAssignment::where(['group_id' => $value->group_id, 'patient_id' => $patient_id])->first();

                            $patientRemoveGroup->in_out = "Out";
                            $patientRemoveGroup->save();
                        }
                    }
                }
                GroupPatientAssignment::where(['patient_id' => $patient_id, 'in_out' => 'Out'])->whereIn('group_id', $request->assignGroup)->update(['in_out' => 'In']);
            } else {
                GroupPatientAssignment::where(['patient_id' => $patient_id])->update(['in_out' => 'Out']);
            }

            DB::commit();
            toastr()->success("groups are assigned succesfully");
            return redirect()->route('patient.groupAssign', $id);
        } catch (QueryException $e) {
            DB::rollBack();
            toastr()->error('Database query error' . $e->getMessage());
            return redirect()->route('patient.groupAssign', $id);
        }
    }

    public function checkGroupIsNotAssigned($request)
    {
        $checkGroupAssign = GroupPatientAssignment::select('group_id')->where(['patient_id' => decrypt($request->patient_id)])->whereIn('group_id', $request->assignGroup)->get();


        $assignGroup = $checkGroupAssign->pluck('group_id')->toArray();

        $notAssignGroups = [];
        if (!empty($request->assignGroup)) {
            foreach ($request->assignGroup as $value) {

                if (!in_array($value, $assignGroup)) {
                    $notAssignGroups[] = $value;
                }
            }
            return $notAssignGroups;
        }
        return  $request->assignGroup;
    }


    public function  removePatientFromGroup(Request $request)
    {
        $patientRemoveGroup = GroupPatientAssignment::where(['group_id' => $request->group_id, 'patient_id' => $request->patient_id])->first();
        $patientRemoveGroup->in_out = "Out";
        if ($patientRemoveGroup->save()) {

            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }




    //  recovery Assessment //

    public function recoveryAssessment($id, $test_type)
    {
        $patient_id = decrypt($id);

        $data['page'] = 'patient.recoveryAssessment';
        $data['js'] = ['patient'];
        $data['role_id'] = Auth::guard('web')->user()->role_id;
        $data['rasQues'] = RasQuestion::select('id', 'question')->get();
        $data['rasRating'] = RasRating::select('id', 'scale_type')->get();
        $data['checkGroupLastsession'] = GroupPatientAssignment::with(['group'])->where('patient_id', $patient_id)->orderByDesc('id')->take(1)->first();

        $data['patientRasAnswer'] = PatientRasMaster::with('ras_rating')->where(['patient_id' => $patient_id, 'test_type' => $test_type])->get();
        $data['checkFinalRasDone'] = PatientRasMaster::where(['patient_id' => $patient_id, 'test_type' => '1'])->count();
        $data['patient_id'] = $id;
        return view('admin.main_layout', $data);
    }

    public function recoveryAssessmentPatient(RasPostRequest $request)
    {

        //dd($request->questions);
        try {
            DB::beginTransaction();
            $checkInitialTest = PatientRasMaster::where('patient_id', decrypt($request->patient_id))->count();

            if ($checkInitialTest == 0) {

                foreach ($request->questions as $value) {

                    $patient_ras_master = new PatientRasMaster;
                    $patient_ras_master->patient_id = decrypt($request->patient_id);
                    $patient_ras_master->question_id = $value['question'];
                    $patient_ras_master->answer_id = $value['answer'];
                    $patient_ras_master->test_type = '0';
                    $patient_ras_master->save();
                }
                $patient = User::find(decrypt($request->patient_id));
                $patient->status = '0';
                $patient->save();
                // Log::info('API request processed successfully');

            } else {
                $patientStatus = User::where('id', decrypt($request->patient_id))->get();
                if ($patientStatus[0]->status == '1') {
                    foreach ($request->questions as $value) {
                        $patient_ras_master = new PatientRasMaster;
                        $patient_ras_master->patient_id = decrypt($request->patient_id);
                        $patient_ras_master->question_id = $value['question'];
                        $patient_ras_master->answer_id = $value['answer'];
                        $patient_ras_master->test_type = '1';
                        $patient_ras_master->save();
                    }
                }
            }


            DB::commit();
            toastr()->success("Ras submited succesfully");
            return redirect()->route('patient.index');
        } catch (QueryException $e) {

            DB::rollBack();
            toastr()->error("Ras not submit");
            return redirect()->route('patient.index');
        }
    }
    // 

    public function patientApom($id, $test_type)
    {
        $patient_id = decrypt($id);
        $data['page'] = 'patient.patientApom';
        $data['js'] = ['patient'];
        $data['css'] = ['apom'];
        $data['role_id'] = Auth::guard('web')->user()->role_id;
        $data['patientDetail'] = User::with('patientDetails')->where('id', $patient_id)->get();
        $groupList = Group::where('start_session_date', '>=', date('Y-m-d'))->whereHas('groupDoctorAssignments')->get();
        $data['checkGroupLastsession'] = Group::select('end_session_date')->whereIn('id', function ($query) use ($patient_id) {
            $query->select('group_id')
                ->from('group_patient_assignments')
                ->where('patient_id', $patient_id);
        })
            ->orderByDesc('end_session_date')
            ->take(1)
            ->first();
        $groupData = [];
        foreach ($groupList as $val) {
            $checkLastDate =  Group_session::where('group_id', $val->id)->orderBy('id', 'desc')->take(1)->get();
            $checkTime = GroupDoctorAssignment::select('end_time')->where('group_id', $val->id)->orderBy('end_time', 'desc')->take(1)->get();
            if ($checkLastDate[0]->session_date >= date('Y-m-d')) {

                if (@$checkTime[0]->endtime < session()->get('currentTime')) {
                    $groupDetail['id'] = $val->id;
                    $groupDetail['group_name'] = $val->group_name;
                    $groupData[]  = $groupDetail;
                }
            }
        }
        $data['groupList'] = $groupData;
        $data['patientApom'] = PatientApoms::with('group')->where(['patient_id' => $patient_id, 'test_type' => $test_type])->first();

        $data['checkinitialApomDone'] = PatientApoms::where(['patient_id' => $patient_id, 'test_type' => '0'])->count();
        $data['checkFinalApomDone'] = PatientApoms::where(['patient_id' => $patient_id, 'test_type' => '1'])->count();
        $data['patient_id'] = $id;
        return view('admin.main_layout', $data);
    }

    public function storePatientAPOM(PatientAPOMPost $request)
    {

        try {
            DB::beginTransaction();

            $checkpatientApom = PatientApoms::where('patient_id', $request->patient_id)->count();
            $group = PatientApoms::where(['patient_id' => $request->patient_id, 'test_type' => '0'])->get();
            $patient_apoms = new PatientApoms;

            $patient_apoms->patient_id = $request->patient_id;
            $patient_apoms->patientName = $request->patientName;
            $patient_apoms->dateOfScreening = $request->dateOfScreening;
            $patient_apoms->idNumber = $request->idNumber;
            $patient_apoms->doctor_id = $request->doctor_id;
            $patient_apoms->therapistName = $request->therapistName;
            $patient_apoms->age = $request->age;
            $patient_apoms->duration = $request->duration;
            $patient_apoms->psychiatrist = $request->psychiatrist;
            $patient_apoms->place = $request->place;
            $patient_apoms->psychologist = $request->psychologist;
            $patient_apoms->prev_add_diagnosis = $request->prev_add_diagnosis;
            $patient_apoms->compliance_followup = $request->compliance_followup;
            $patient_apoms->complaint = is_array($request->complaint) ? implode(',', $request->complaint) : $request->complaint;
            // ...
            $patient_apoms->strugglingWith = is_array($request->strugglingWith) ? implode(',', $request->strugglingWith) : $request->strugglingWith;

            $patient_apoms->medicalConditions = $request->medicalConditions;
            $patient_apoms->relationshipStatus = $request->relationshipStatus;
            $patient_apoms->partnerName = $request->partnerName;
            $patient_apoms->durationOfRelationship = $request->durationOfRelationship;
            $patient_apoms->qualityOfRelationship = $request->qualityOfRelationship;
            $patient_apoms->childrenDependants = $request->childrenDependants;
            $patient_apoms->livingArrangements = $request->livingArrangements;
            $patient_apoms->qualityOfRelationshipsInFamily = $request->qualityOfRelationshipsInFamily;
            $patient_apoms->familyStressorsConflict = $request->familyStressorsConflict;
            $patient_apoms->supportSystem = $request->supportSystem;
            $patient_apoms->nextOfKinContact = $request->nextOfKinContact;
            $patient_apoms->jobTitle = $request->jobTitle;
            $patient_apoms->employer = $request->employer;
            $patient_apoms->yearsInJob = $request->yearsInJob;
            $patient_apoms->jobSatisfaction = $request->jobSatisfaction;

            $patient_apoms->jobRole = is_array($request->jobRole) ? implode(',', $request->jobRole) : $request->jobRole;

            $patient_apoms->otherInfo = $request->otherInfo;
            $patient_apoms->hobbiesLeisure = $request->hobbiesLeisure;
            $patient_apoms->mood = $request->mood;
            $patient_apoms->coping = $request->coping;
            $patient_apoms->substanceYesNo = $request->substanceYesNo;
            $patient_apoms->substance1 = $request->substance1;
            $patient_apoms->substance1Frequency = $request->substance1Frequency;
            $patient_apoms->substance1LastUse = $request->substance1LastUse;
            $patient_apoms->substance2 = $request->substance2;
            $patient_apoms->substance2Frequency = $request->substance2Frequency;
            $patient_apoms->substance2LastUse = $request->substance2LastUse;
            $patient_apoms->substance3 = $request->substance3;
            $patient_apoms->substance3Frequency = $request->substance3Frequency;
            $patient_apoms->substance3LastUse = $request->substance3LastUse;
            $patient_apoms->substance4 = $request->substance4;
            $patient_apoms->substance4Frequency = $request->substance4Frequency;
            $patient_apoms->substance4LastUse = $request->substance4LastUse;
            $patient_apoms->cutDown = $request->cutDown;
            $patient_apoms->peopleAnnoyed = $request->peopleAnnoyed;
            $patient_apoms->feltBadGuilty = $request->feltBadGuilty;
            $patient_apoms->drinkUsedMorning = $request->drinkUsedMorning;
            $patient_apoms->expectationsGoals = $request->expectationsGoals;

            $patient_apoms->attention = ($request->attention != null) ? $request->attention : "0";
            $patient_apoms->pace = ($request->pace != null) ? $request->pace : "0";
            $patient_apoms->knowledgeToolsAndMaterials = ($request->knowledgeToolsAndMaterials != null) ? $request->knowledgeToolsAndMaterials : "0";
            $patient_apoms->knowledgeConceptFormation = ($request->knowledgeConceptFormation != null) ? $request->knowledgeConceptFormation : "0";
            $patient_apoms->skillsToUseToolsAndMaterials = ($request->skillsToUseToolsAndMaterials != null) ? $request->skillsToUseToolsAndMaterials : "0";
            $patient_apoms->taskConcept = ($request->taskConcept != null) ? $request->taskConcept : "0";
            $patient_apoms->organizingSpaceAndObjects = ($request->organizingSpaceAndObjects != null) ? $request->organizingSpaceAndObjects : "0";
            $patient_apoms->adaptation = ($request->adaptation != null) ? $request->adaptation : "0";


            $patient_apoms->nonVerbalPhysicalContact = ($request->nonVerbalPhysicalContact != null) ? $request->nonVerbalPhysicalContact : "0";
            $patient_apoms->nonVerbalEyeContact = ($request->nonVerbalEyeContact != null) ? $request->nonVerbalEyeContact : "0";
            $patient_apoms->nonVerbalGestures = ($request->nonVerbalGestures != null) ? $request->nonVerbalGestures : "0";
            $patient_apoms->nonVerbalUseOfBody = ($request->nonVerbalUseOfBody != null) ? $request->nonVerbalUseOfBody : "0";
            $patient_apoms->verbalSpeech = ($request->verbalSpeech != null) ? $request->verbalSpeech : "0";
            $patient_apoms->verbalContent = ($request->verbalContent != null) ? $request->verbalContent : "0";
            $patient_apoms->verbalExpressNeeds = ($request->verbalExpressNeeds != null) ? $request->verbalExpressNeeds : "0";
            $patient_apoms->verbalConversation = ($request->verbalConversation != null) ? $request->verbalConversation : "0";
            $patient_apoms->relationsSocialNorms = ($request->relationsSocialNorms != null) ? $request->relationsSocialNorms : "0";
            $patient_apoms->relationsRapport = ($request->relationsRapport != null) ? $request->relationsRapport : "0";


            $patient_apoms->personalCare = ($request->personalCare != null) ? $request->personalCare : "0";
            $patient_apoms->personalSafety = ($request->personalSafety != null) ? $request->personalSafety : "0";
            $patient_apoms->careOfMedication = ($request->careOfMedication != null) ? $request->careOfMedication : "0";
            $patient_apoms->useOfTransport = ($request->useOfTransport != null) ? $request->useOfTransport : "0";
            $patient_apoms->domesticSkills = ($request->domesticSkills != null) ? $request->domesticSkills : "0";
            $patient_apoms->childCareSkills = ($request->childCareSkills != null) ? $request->childCareSkills : "0";
            $patient_apoms->moneyManagementAndBudgetingSkills = ($request->moneyManagementAndBudgetingSkills != null) ? $request->moneyManagementAndBudgetingSkills : "0";
            $patient_apoms->assertiveness = ($request->assertiveness != null) ? $request->assertiveness : "0";
            $patient_apoms->stressManagement = ($request->stressManagement != null) ? $request->stressManagement : "0";
            $patient_apoms->conflictManagement = ($request->conflictManagement != null) ? $request->conflictManagement : "0";
            $patient_apoms->problemSolvingSkills = ($request->problemSolvingSkills != null) ? $request->problemSolvingSkills : "0";
            $patient_apoms->preVocationalSkills = ($request->preVocationalSkills != null) ? $request->preVocationalSkills : "0";
            $patient_apoms->vocationalSkills = ($request->vocationalSkills != null) ? $request->vocationalSkills : "0";

            $patient_apoms->awarenessOfRoles = ($request->awarenessOfRoles != null) ? $request->awarenessOfRoles : "0";
            $patient_apoms->roleExpectations = ($request->roleExpectations != null) ? $request->roleExpectations : "0";
            $patient_apoms->roleBalance = ($request->roleBalance != null) ? $request->roleBalance : "0";
            $patient_apoms->competency = ($request->competency != null) ? $request->competency : "0";

            $patient_apoms->timeUseRoutines = ($request->timeUseRoutines != null) ? $request->timeUseRoutines : "0";
            $patient_apoms->habits = ($request->habits != null) ? $request->habits : "0";
            $patient_apoms->mixOfOccupations = ($request->mixOfOccupations != null) ? $request->mixOfOccupations : "0";

            $patient_apoms->activeInvolvement = ($request->activeInvolvement != null) ? $request->activeInvolvement : "0";
            $patient_apoms->motivesAndDrives = ($request->motivesAndDrives != null) ? $request->motivesAndDrives : "0";
            $patient_apoms->showsInterest = ($request->showsInterest != null) ? $request->showsInterest : "0";
            $patient_apoms->goalDirectedBehaviour = ($request->goalDirectedBehaviour != null) ? $request->goalDirectedBehaviour : "0";
            $patient_apoms->locusOfControl = ($request->locusOfControl != null) ? $request->locusOfControl : "0";


            $patient_apoms->commitmentToTaskSituation = ($request->commitmentToTaskSituation != null) ? $request->commitmentToTaskSituation : "0";
            $patient_apoms->usingFeedback = ($request->usingFeedback != null) ? $request->usingFeedback : "0";
            $patient_apoms->selfWorth = ($request->selfWorth != null) ? $request->selfWorth : "0";
            $patient_apoms->attitudeSelfAssurance = ($request->attitudeSelfAssurance != null) ? $request->attitudeSelfAssurance : "0";
            $patient_apoms->attitudeSelfSatisfaction = ($request->attitudeSelfSatisfaction != null) ? $request->attitudeSelfSatisfaction : "0";
            $patient_apoms->awarenessOfQualities = ($request->awarenessOfQualities != null) ? $request->awarenessOfQualities : "0";
            $patient_apoms->socialPresence = ($request->socialPresence != null) ? $request->socialPresence : "0";


            $patient_apoms->repertoireOfEmotions = ($request->repertoireOfEmotions != null) ? $request->repertoireOfEmotions : "0";
            $patient_apoms->emotionControl = ($request->emotionControl != null) ? $request->emotionControl : "0";
            $patient_apoms->moods = ($request->moods != null) ? $request->moods : "0";

            $patient_apoms->group_id = ($checkpatientApom != 0) ? $group[0]->group_id : $request->group;
            $patient_apoms->test_type =  ($checkpatientApom != 0) ? '1' : '0';

            if ($checkpatientApom == 0) {
                $reautl = $patient_apoms->save();
                if ($reautl) {

                    $selectGroupDoctorAssign  = GroupDoctorAssignment::where('group_id', $request->group)->first();

                    $AssignGroups = new GroupPatientAssignment;
                    $AssignGroups->group_id = $request->group;
                    $AssignGroups->patient_id = $request->patient_id;
                    $AssignGroups->doctor_id = $selectGroupDoctorAssign->doctor_id;
                    $AssignGroups->AssignmentDate = date('Y-m-d,h:i:s');
                    $AssignGroups->in_out = "In";
                    if ($AssignGroups->save()) {

                        $referDoctor = new doctorReferral;
                        $referDoctor->referring_doctor_id = $selectGroupDoctorAssign->doctor_id;
                        $referDoctor->referrer_by = $request->doctor_id;
                        $referDoctor->patient_id =  $request->patient_id;
                        $referDoctor->referral_date = date('Y-m-d');
                        $referDoctor->save();

                        $patient = User::find($request->patient_id);
                        $patient->status = '1';
                        $patient->save();
                    }
                }
            } else {
                $patient_apoms->save();
            }

            DB::commit();
            return response()->json(true);
        } catch (QueryException $e) {

            DB::rollBack();


            return response()->json("db error");
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        try {
            DB::beginTransaction();
            $id = decrypt($id);
            $user = User::find($id)->delete();
            DB::commit();
            return response()->json(true);
        } catch (QueryException $e) {
            DB::rollBack();
            return response()->json($e->getMessage());
        }
    }

    public function change_status(Request $request)
    {
        try {
            DB::beginTransaction();

            $patient_id =  decrypt($request->patient_id);

            $updateStatus = User::findOrFail($patient_id);
            $updateStatus->status = $request->input('status');
            $updateStatus->save();
            DB::commit();
            if (!empty($updateStatus)) {
                return response()->json(true);
            }
            return response()->json(false);
        } catch (QueryException $e) {

            DB::rollBack();
            return response()->json(false);
        }
    }

    public function check_ezmed_number_is_already(Request $request)
    {

        try {
            DB::beginTransaction();
            $EZMed_number = $request->EZMed_number;


            $patient = User::whereHas('patientDetails', function ($query) use ($EZMed_number) {
                $query->where('EZMed_number', $EZMed_number);
            })->get();


            if (count($patient) > 0) {
                if (isset($request->id) && !empty($request->id)) {

                    if ($patient[0]->id == decrypt($request->id)) {

                        $return =  true;
                        echo json_encode($return);
                        exit;
                    }
                }
                $return =  false;
            } else {
                $return = true;
            }
            DB::commit();
            echo json_encode($return);
            exit;
        } catch (QueryException $e) {
            echo "error";
            exit;
            DB::rollback();
            echo json_encode(false);
            exit;
        }
    }

    public function check_identity_number_is_already(Request $request)
    {


        try {
            DB::beginTransaction();
            $patient = User::where('identity_number', $request->identity_number)->get();

            if (count($patient) > 0) {
                if (isset($request->id) && !empty($request->id)) {

                    if ($patient[0]->id == decrypt($request->id)) {

                        $return =  true;
                        echo json_encode($return);
                        exit;
                    }
                }
                $return =  false;
            } else {
                $return = true;
            }
            DB::commit();
            echo json_encode($return);
            exit;
        } catch (QueryException $e) {
            DB::rollBack();
            echo json_encode($return);
            exit;
        }
    }

    public function deschargeReport($id)
    {
        $patient_id = decrypt($id);
        // $getAPOMreport = PatientApoms::where('patient_id', $patient_id)->get();
        $apomReports = $this->apomReports($patient_id);

        // Initial RAS Report //
        $rasReport = $this->rasReports($patient_id);

        $data['page'] = 'patient.deschargeReport';
        $data['initialReport'] = $rasReport['initialRas'];
        $data['finalReport'] = $rasReport['finalRas'];;
        $data['subscaleName'] = $rasReport['subscaleName'];;

        $data['initialApom'] = $apomReports['initialApomReport'];
        $data['finalApom'] = $apomReports['finalApomReport'];
        $data['partOfApom'] = $apomReports['partOfAPOM'];

        $patientData = User::with(['patientDetails', 'PatientApoms.group'])->where('id', $patient_id)->first();
        $data['patientDetails'] = $patientData;

        $group_id = $patientData->PatientApoms[0]->group_id;
        $data['attendence'] = Attendance::where(['patient_id' => $patient_id, 'group_id' => $group_id])->count();
        $data['groupTotalSessions'] = Group_session::where('group_id', $group_id)->count();
        $data['patientID'] = $patient_id;
        return view('admin.main_layout', $data);
        // Process Skill //

        // $data['process_skill'] = $getAPOMreport[0]->;


    }

    public function rasReports($patient_id)
    {


        $getInitialRASreport = PatientRasMaster::with(['ras_question.ras_question_categories'])
            ->withSum('ras_rating', 'scale')
            ->where(['patient_id' => $patient_id, 'test_type' => '0'])
            ->get();

        $groupedRASreport = $getInitialRASreport->groupBy(function ($item) {
            return $item->ras_question->subscale;
        });

        $initialresult = $groupedRASreport->map(function ($group) {
            $count = $group->count();
            $subscale = $group->first()->ras_question->subscale;
            $groupData = $group->all();
            return [
                'subscale' => $subscale,
                'total_questions' => $count,
                'group_data' => $groupData,
            ];
        });

        // Initial RAS Report //


        // Final RAS Report //

        $getFinalRASreport = PatientRasMaster::with(['ras_question.ras_question_categories'])
            ->withSum('ras_rating', 'scale')
            ->where(['patient_id' => $patient_id, 'test_type' => '1'])
            ->get();

        $groupedRASreport = $getFinalRASreport->groupBy(function ($item) {
            return $item->ras_question->subscale;
        });

        $Finalresult = $groupedRASreport->map(function ($group) {
            $count = $group->count();
            $subscale = $group->first()->ras_question->subscale;
            $groupData = $group->all();
            return [
                'subscale' => $subscale,
                'total_questions' => $count,
                'group_data' => $groupData,
            ];
        });

        // Final RAS Report //


        $rasInitialReport = [];
        $rasFinalReport = [];
        $subscaleName = [];
        foreach ($initialresult as $value) {

            $sumallQuestionscale = 0;
            $subscale_name = "";
            $totalQuestion = $value['total_questions'];
            foreach ($value['group_data'] as $val) {
                $subscale_name =  str_replace(' ', '_', $val->ras_question->ras_question_categories->category);
                $sumallQuestionscale += $val->ras_rating_sum_scale;
            }
            $subscaleName[] = $subscale_name;
            $finalAvg = $sumallQuestionscale / ($totalQuestion * 5) * 100;
            $rasInitialReport[] = round($finalAvg);
        }


        foreach ($Finalresult as $value) {
            $sumallQuestionscale = 0;
            $subscale_name = "";
            $totalQuestion = $value['total_questions'];
            foreach ($value['group_data'] as $val) {

                $subscale_name =  str_replace(' ', '_', $val->ras_question->ras_question_categories->category);
                $sumallQuestionscale += $val->ras_rating_sum_scale;
            }
            $finalAvg = $sumallQuestionscale / ($totalQuestion * 5) * 100;
            $rasFinalReport[] = round($finalAvg);
        }
        return ['initialRas' => $rasInitialReport, 'finalRas' => $rasFinalReport, 'subscaleName' => $subscaleName];
    }

    public function apomReports($patient_id)
    {
        // Initial APOM // 

        $patientInitialAPOM = PatientApoms::where(['patient_id' => $patient_id, 'test_type' => '0'])->first();

        $processSkill = 0;
        $communicationInteractionSkills = 0;
        $lifeSkills = 0;
        $roleperformance = 0;
        $balancedLifeStyle = 0;
        $motivation = 0;
        $selfEsteem = 0;
        $affect = 0;
        $processSkill = $patientInitialAPOM->attention +
            $patientInitialAPOM->pace +
            $patientInitialAPOM->knowledgeToolsAndMaterials +
            $patientInitialAPOM->knowledgeConceptFormation +
            $patientInitialAPOM->skillsToUseToolsAndMaterials +
            $patientInitialAPOM->taskConcept +
            $patientInitialAPOM->organizingSpaceAndObjects +
            $patientInitialAPOM->adaptation;

        $processSkillAvg = round($processSkill / 8);


        $communicationInteractionSkills =
            $patientInitialAPOM->nonVerbalPhysicalContact +
            $patientInitialAPOM->nonVerbalEyeContact +
            $patientInitialAPOM->nonVerbalGestures +
            $patientInitialAPOM->nonVerbalUseOfBody +
            $patientInitialAPOM->verbalSpeech +
            $patientInitialAPOM->verbalContent +
            $patientInitialAPOM->verbalExpressNeeds +
            $patientInitialAPOM->verbalConversation +
            $patientInitialAPOM->relationsSocialNorms +
            $patientInitialAPOM->relationsRapport;


        $communicationInteractionSkillsAvg = round($communicationInteractionSkills / 10);

        $lifeSkills =
            $patientInitialAPOM->personalCare +
            $patientInitialAPOM->personalSafety +
            $patientInitialAPOM->careOfMedication +
            $patientInitialAPOM->useOfTransport +
            $patientInitialAPOM->domesticSkills +
            $patientInitialAPOM->childCareSkills +
            $patientInitialAPOM->moneyManagementAndBudgetingSkills +
            $patientInitialAPOM->assertiveness +
            $patientInitialAPOM->stressManagement +
            $patientInitialAPOM->conflictManagement +
            $patientInitialAPOM->problemSolvingSkills +
            $patientInitialAPOM->preVocationalSkills +
            $patientInitialAPOM->vocationalSkills;


        $lifeSkillsAvg = round($lifeSkills / 13);

        $roleperformance =
            $patientInitialAPOM->awarenessOfRoles +
            $patientInitialAPOM->roleExpectations +
            $patientInitialAPOM->roleBalance +
            $patientInitialAPOM->competency;

        $roleperformanceAvg = round($roleperformance / 4);

        $balancedLifeStyle =
            $patientInitialAPOM->timeUseRoutines +
            $patientInitialAPOM->habits +
            $patientInitialAPOM->mixOfOccupations;

        $balancedLifeStyleAvg = round($balancedLifeStyle / 3);

        $motivation =
            $patientInitialAPOM->activeInvolvement +
            $patientInitialAPOM->motivesAndDrives +
            $patientInitialAPOM->showsInterest +
            $patientInitialAPOM->goalDirectedBehaviour +
            $patientInitialAPOM->locusOfControl;

        $motivationAvg = round($motivation / 5);

        $selfEsteem =

            $patientInitialAPOM->commitmentToTaskSituation +
            $patientInitialAPOM->usingFeedback +
            $patientInitialAPOM->selfWorth +
            $patientInitialAPOM->attitudeSelfAssurance +
            $patientInitialAPOM->attitudeSelfSatisfaction +
            $patientInitialAPOM->awarenessOfQualities +
            $patientInitialAPOM->socialPresence;

        $selfEsteemAvg = round($selfEsteem / 7);

        $affect =
            $patientInitialAPOM->repertoireOfEmotions +
            $patientInitialAPOM->emotionControl +
            $patientInitialAPOM->moods;

        $affectAvg = round($affect / 3);

        $initialAPOM = [
            $processSkillAvg,
            $communicationInteractionSkillsAvg,
            $lifeSkillsAvg,
            $roleperformanceAvg,
            $balancedLifeStyleAvg,
            $motivationAvg,
            $selfEsteemAvg,
            $affectAvg
        ];


        // Final APOM // 


        $patientFinalAPOM = PatientApoms::where(['patient_id' => $patient_id, 'test_type' => '1'])->first();

        $final_processSkill = 0;
        $final_communicationInteractionSkills = 0;
        $final_lifeSkills = 0;
        $final_roleperformance = 0;
        $final_balancedLifeStyle = 0;
        $final_motivation = 0;
        $final_selfEsteem = 0;
        $final_affect = 0;

        if ($patientFinalAPOM != null) {

            $final_processSkill = $patientFinalAPOM->attention +
                $patientFinalAPOM->pace +
                $patientFinalAPOM->knowledgeToolsAndMaterials +
                $patientFinalAPOM->knowledgeConceptFormation +
                $patientFinalAPOM->skillsToUseToolsAndMaterials +
                $patientFinalAPOM->taskConcept +
                $patientFinalAPOM->organizingSpaceAndObjects +
                $patientFinalAPOM->adaptation;

            $final_communicationInteractionSkills =
                $patientFinalAPOM->nonVerbalPhysicalContact +
                $patientFinalAPOM->nonVerbalEyeContact +
                $patientFinalAPOM->nonVerbalGestures +
                $patientFinalAPOM->nonVerbalUseOfBody +
                $patientFinalAPOM->verbalSpeech +
                $patientFinalAPOM->verbalContent +
                $patientFinalAPOM->verbalExpressNeeds +
                $patientFinalAPOM->verbalConversation +
                $patientFinalAPOM->relationsSocialNorms +
                $patientFinalAPOM->relationsRapport;


            $final_lifeSkills =
                $patientFinalAPOM->personalCare +
                $patientFinalAPOM->personalSafety +
                $patientFinalAPOM->careOfMedication +
                $patientFinalAPOM->useOfTransport +
                $patientFinalAPOM->domesticSkills +
                $patientFinalAPOM->childCareSkills +
                $patientFinalAPOM->moneyManagementAndBudgetingSkills +
                $patientFinalAPOM->assertiveness +
                $patientFinalAPOM->stressManagement +
                $patientFinalAPOM->conflictManagement +
                $patientFinalAPOM->problemSolvingSkills +
                $patientFinalAPOM->preVocationalSkills +
                $patientFinalAPOM->vocationalSkills;


            $final_roleperformance =
                $patientFinalAPOM->awarenessOfRoles +
                $patientFinalAPOM->roleExpectations +
                $patientFinalAPOM->roleBalance +
                $patientFinalAPOM->competency;



            $final_balancedLifeStyle =
                $patientFinalAPOM->timeUseRoutines +
                $patientFinalAPOM->habits +
                $patientFinalAPOM->mixOfOccupations;

            $final_motivation =
                $patientFinalAPOM->activeInvolvement +
                $patientFinalAPOM->motivesAndDrives +
                $patientFinalAPOM->showsInterest +
                $patientFinalAPOM->goalDirectedBehaviour +
                $patientFinalAPOM->locusOfControl;

            $final_selfEsteem =

                $patientFinalAPOM->commitmentToTaskSituation +
                $patientFinalAPOM->usingFeedback +
                $patientFinalAPOM->selfWorth +
                $patientFinalAPOM->attitudeSelfAssurance +
                $patientFinalAPOM->attitudeSelfSatisfaction +
                $patientFinalAPOM->awarenessOfQualities +
                $patientFinalAPOM->socialPresence;

            $final_affect =
                $patientFinalAPOM->repertoireOfEmotions +
                $patientFinalAPOM->emotionControl +
                $patientFinalAPOM->moods;
        }

        $final_processSkillAvg = round($final_processSkill / 8);


        $final_communicationInteractionSkillsAvg = round($final_communicationInteractionSkills / 10);



        $final_lifeSkillsAvg = round($final_lifeSkills / 13);


        $final_roleperformanceAvg = round($final_roleperformance / 4);

        $final_balancedLifeStyleAvg = round($final_balancedLifeStyle / 3);



        $final_motivationAvg = round($final_motivation / 5);



        $final_selfEsteemAvg = round($final_selfEsteem / 7);


        $final_affectAvg = round($final_affect / 3);

        $finalAPOM = [
            $final_processSkillAvg,
            $final_communicationInteractionSkillsAvg,
            $final_lifeSkillsAvg,
            $final_roleperformanceAvg,
            $final_balancedLifeStyleAvg,
            $final_motivationAvg,
            $final_selfEsteemAvg,
            $final_affectAvg
        ];


        $partofApom = ['Process skills', 'Communication / Interaction skills', 'Life Skills', 'Role performance', 'Balanced life style', 'Motivation', 'Self esteem', 'Affect'];
        return ['initialApomReport' => $initialAPOM, 'finalApomReport' => $finalAPOM, 'partOfAPOM' => $partofApom];
    }

    public function dischargeReportPdf(Request $request)
    {

        $patient_id = $request->patient_id;
        // $getAPOMreport = PatientApoms::where('patient_id', $patient_id)->get();
        $apomReports = $this->apomReports($patient_id);

        // Initial RAS Report //
        $rasReport = $this->rasReports($patient_id);


        $data['initialReport'] = $rasReport['initialRas'];
        $data['finalReport'] = $rasReport['finalRas'];;
        $data['subscaleName'] = $rasReport['subscaleName'];;

        $data['initialApom'] = $apomReports['initialApomReport'];
        $data['finalApom'] = $apomReports['finalApomReport'];
        $data['partOfApom'] = $apomReports['partOfAPOM'];



        $patientData = User::with(['patientDetails', 'PatientApoms.group'])->where('id', $patient_id)->first();
        $data['patientDetails'] = $patientData;

        $group_id = $patientData->PatientApoms[0]->group_id;
        $data['attendence'] = Attendance::where(['patient_id' => $patient_id, 'group_id' => $group_id])->count();
        $data['groupTotalSessions'] = Group_session::where('group_id', $group_id)->count();
        $data['deschargeDetail'] = $request;

        if (isset($request->viewreport)) {
            return view('patient.pdfDeschargeReport', $data);
        } else {


            $pdf = PDF::loadView('patient.pdfDeschargeReport', $data);
            $patientName = str_replace(' ', '_', $patientData->first_name) . '_' . str_replace(' ', '_', $patientData->last_name);
            $filename = $patientName . '.pdf';

            $tempPath = public_path('storage/pdf/' . $filename);
            $pdf->save($tempPath);
            $destinationPath = public_path('storage/pdf/');
            \File::move($tempPath, $destinationPath . $filename);


            return $pdf->download($patientName . '.pdf');
        }
    }

    public function apomAssessmentReport($id)
    {
        $patient_id = decrypt($id);
        // $getAPOMreport = PatientApoms::where('patient_id', $patient_id)->get();
        $apomReports = $this->apomReports($patient_id);

        // Initial RAS Report //


        $data['page'] = 'patient.apomAssessmentReport';


        $data['initialApom'] = $apomReports['initialApomReport'];
        $data['finalApom'] = $apomReports['finalApomReport'];
        $data['partOfApom'] = $apomReports['partOfAPOM'];

        $patientData = User::with(['patientDetails', 'PatientApoms.group'])->where('id', $patient_id)->first();
        $data['patientDetails'] = $patientData;

        $data['patientID'] = $patient_id;
        return view('admin.main_layout', $data);
    }

    public function apomAssessmentPdfGenarate(Request $request)
    {

        $patient_id = $request->patientID;

        $apomReports = $this->apomReports($patient_id);


        $data['initialApom'] = $apomReports['initialApomReport'];
        $data['finalApom'] = $apomReports['finalApomReport'];
        $data['partOfApom'] = $apomReports['partOfAPOM'];

        $patientData = User::with(['patientDetails', 'PatientApoms.group'])->where('id', $patient_id)->first();
        $data['patientDetails'] = $patientData;

        $data['apomChartDetail'] = $request;
        //  return view('patient.apomAssessmentpdf', $data);
        $pdf = PDF::loadView('patient.apomAssessmentpdf', $data);
        if (Storage::disk('public')->exists('apompdf/' . $patientData->first_name . '_' . $patientData->last_name . '.pdf')) {

            Storage::disk('public')->delete('apompdf/' . $patientData->first_name . '_' . $patientData->last_name . '.pdf');

            Storage::put('public/apompdf/' . $patientData->first_name . '_' . $patientData->last_name . '.pdf', $pdf->output());
        } else {
            Storage::put('public/apompdf/' . $patientData->first_name . '_' . $patientData->last_name . '.pdf', $pdf->output());
        }

        $checkDischargeReport =  Patient_discharge_master::where('patient_id', $patientData->id)->count();

        if ($checkDischargeReport != 0) {
            Patient_discharge_master::where('patient_id', $patientData->id)->delete();
        }
        $PatientDischargeMaster = new Patient_discharge_master;
        $PatientDischargeMaster->patient_id =  $patientData->id;
        $PatientDischargeMaster->discharge_date = date('Y-m-d');
        $PatientDischargeMaster->discharge_report = $patientData->first_name . '_' . $patientData->last_name . '.pdf';
        $PatientDischargeMaster->save();

        return $pdf->download($patientData->first_name . '_' . $patientData->last_name . '.pdf');
    }

    public function change_password(string $id)
    {


        $data['page'] = 'patient.change_password';

        $data['js'] = ['patient'];
        $data['patientId'] = $id;
        $data['role_id'] = Auth::guard('web')->user()->role_id;
        return view('admin.main_layout', $data);
    }

    public function store_change_password(PostchangePassword $request, $id)
    {

        try {

            DB::beginTransaction();

            $patientId = decrypt($id);
            $patient = User::findOrFail($patientId);

            if (!empty($patient)) {

                $patient->password = bcrypt($request->new_password);
                $patient->save();

                DB::commit();
                toastr()->success('Patient"s password changed  successfully !');
                return redirect()->route('patient.index');
            } else {
                toastr()->error('Patient not found');
                return redirect()->route('patient.changePassword', $id);
            }
        } catch (QueryException $e) {
            DB::rollBack();
            Log::error('Database query error' . $e->getMessage());
            toastr()->error($e->getMessage());
            return redirect()->route('patient.changePassword', $id);
        }
    }


    public function check_current_password_is_correct(Request $request)
    {

        try {
            $patientId = decrypt($request->id);
            $user = User::where(['id' => $patientId])->first();

            if ($user != null) {
                if (Hash::check($request->current_password, $user->password)) {
                    $return =  true;
                } else {
                    $return =  false;
                }
            } else {
                $return =  false;
            }
            echo json_encode($return);
            exit;
        } catch (QueryException $e) {
            DB::rollBack();
            Log::error('Database query error');
            echo json_encode(false);
        }
    }

    function CheckPatientStatus($id)
    {
        $patientId = decrypt($id);
        $checkFinalAPOMComplated = PatientApoms::where(['test_type' => '1', 'patient_id' => $patientId])->count();
        $test_type = '1';
        if ($checkFinalAPOMComplated == 0) {
            return redirect()->route('patient.patientApom', [$id, $test_type]);
        }
        return redirect()->route('patient.patientApom', [$id, $test_type]);
    }


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

    function countryList()
    {

        $countries = [
            "Afghanistan", "Aland Islands", "Albania", "Algeria", "American Samoa",
            "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda",
            "Argentina", "Armenia", "Aruba", "Australia", "Austria",
            "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados",
            "Belarus", "Belgium", "Belize", "Benin", "Bermuda",
            "Bhutan", "Bolivia", "Bonaire, Sint Eustatius and Saba", "Bosnia and Herzegovina", "Botswana",
            "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria",
            "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada",
            "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile",
            "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros",
            "Congo", "Congo, Democratic Republic of the Congo", "Cook Islands", "Costa Rica", "Cote D'Ivoire",
            "Croatia", "Cuba", "Curacao", "Cyprus", "Czech Republic",
            "Denmark", "Djibouti", "Dominica", "Dominican Republic", "Ecuador",
            "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia",
            "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland",
            "France", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon",
            "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar",
            "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam",
            "Guatemala", "Guernsey", "Guinea", "Guinea-Bissau", "Guyana",
            "Haiti", "Heard Island and Mcdonald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong",
            "Hungary", "Iceland", "India", "Indonesia", "Iran, Islamic Republic of",
            "Iraq", "Ireland", "Isle of Man", "Israel", "Italy",
            "Jamaica", "Japan", "Jersey", "Jordan", "Kazakhstan",
            "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kosovo",
            "Kuwait", "Kyrgyzstan", "Lao People's Democratic Republic", "Latvia", "Lebanon",
            "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania",
            "Luxembourg", "Macao", "Macedonia, the Former Yugoslav Republic of", "Madagascar", "Malawi",
            "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands",
            "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico",
            "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montenegro",
            "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia",
            "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia",
            "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue",
            "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan",
            "Palau", "Palestinian Territory, Occupied", "Panama", "Papua New Guinea", "Paraguay",
            "Peru", "Philippines", "Pitcairn", "Poland", "Portugal",
            "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation",
            "Rwanda", "Saint Barthelemy", "Saint Helena", "Saint Kitts and Nevis", "Saint Lucia",
            "Saint Martin", "Saint Pierre and Miquelon", "Saint Vincent and the Grenadines", "Samoa", "San Marino",
            "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Serbia", "Serbia and Montenegro",
            "Seychelles", "Sierra Leone", "Singapore", "Sint Maarten", "Slovakia",
            "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands",
            "South Sudan", "Spain", "Sri Lanka", "Sudan", "Suriname",
            "Svalbard and Jan Mayen", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic",
            "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Timor-Leste",
            "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia",
            "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda",
            "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands",
            "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Viet Nam",
            "Virgin Islands, British", "Virgin Islands, U.s.", "Wallis and Futuna", "Western Sahara", "Yemen",
            "Zambia", "Zimbabwe"
        ];

        return $countries;
    }
}
