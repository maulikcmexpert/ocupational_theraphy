<!--begin::Content-->
< <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Update Patient</h1>
                <!--end::Title-->
                <!--begin::Separator-->
                <span class="h-20px border-gray-200 border-start mx-4"></span>
                <!--end::Separator-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">

                        <a href="@if($role_id == 2) {{ route('staff.dashboard') }}@elseif($role_id == 3 || $role_id == 4) {{route('doctor.dashboard') }}@else  {{route('admin.dashboard') }} @endif" class="text-muted text-hover-primary">Dashboard</a>
                    </li>
                    <!--end::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="@if($role_id == 1) {{ route('patient.index') }} @endif" class="text-muted text-hover-primary">Patient List</a>
                    </li>
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-200 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Update Patient</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->

        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <form method="POST" action="{{route('patient.update',$patientId)}}" id="patientForm" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
                        <!--begin::Scroll-->
                        @csrf
                        @method('PUT')

                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px" style="max-height: 158px;">
                            <input type="hidden" name="id" value="{{ $patientId }}">
                            <input type="hidden" name="detail_id" value="{{ $patientDetail[0]->patientDetails->id }}">

                            <div class="generaldetails-wrap mt-5">
                                <div class="card-title">
                                    General Details
                                </div>
                                <div class="row">
                                    <!--begin::Input group-->
                                    <div class="col-xl-6 col-lg-6 col-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <!--begin::Label-->
                                            <label class="required fw-bold fs-6 mb-2">First Name</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="first_name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="First Name" value="{{ $patientDetail[0]->first_name }}">
                                            <!--end::Input-->
                                            @if ($errors->has('first_name'))
                                            <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                            @endif
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <!--begin::Label-->
                                            <label class="required fw-bold fs-6 mb-2">Last Name</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="last_name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Last Name" value="{{ $patientDetail[0]->last_name }}">
                                            <!--end::Input-->
                                            @if ($errors->has('last_name'))
                                            <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                            @endif
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                        <!--end::Input group-->
                                    </div>

                                    <div class="col-xl-6 col-g-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <!--begin::Label-->
                                            <label class="required fw-bold fs-6 mb-2">Passport | SA ID</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <label class="select-label">
                                                <select name="passport_SAID" class="form-control form-control-solid">
                                                    <option value="">Enter Type</option>
                                                    <option {{ ($patientDetail[0]->patientDetails->passport_SAID == "passport")?"selected":"" }} value="passport">passport</option>
                                                    <option {{ ($patientDetail[0]->patientDetails->passport_SAID == "SA_ID")?"selected":"" }} value="SA_ID">SA ID</option>
                                                </select>
                                            </label>

                                            <!--end::Input-->
                                            @if ($errors->has('passport_SAID'))
                                            <span class="text-danger">{{ $errors->first('passport_SAID') }}</span>
                                            @endif
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--begin::Input group-->

                                    <div class="col-xl-6 col-g-6">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <!--begin::Label-->
                                            <label class="required fw-bold fs-6 mb-2">Identification Number</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->

                                            <input type="text" name="identity_number" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Identity Number" value="{{ $patientDetail[0]->identity_number}}">
                                            <!--end::Input-->
                                            @if ($errors->has('identity_number'))
                                            <span class="text-danger">{{ $errors->first('identity_number') }}</span>
                                            @endif
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-g-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <!--begin::Label-->
                                            <label class="required fw-bold fs-6 mb-2">Date Of Birth</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="date" name="date_of_birth" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Date Of Birth" value="{{ $patientDetail[0]->patientDetails->date_of_birth }}">
                                            <!--end::Input-->
                                            @if ($errors->has('date_of_birth'))
                                            <span class="text-danger">{{ $errors->first('date_of_birth') }}</span>
                                            @endif
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                    </div>

                                    <!-- <div class="col-xl-6 col-g-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                         
                                    <label class=" fw-bold fs-6 mb-2">Language</label>
                              
                                    <input type="text" name="language" class="form-control form-control-solid" value="{{ $patientDetail[0]->patientDetails->language }}">


                                    @if ($errors->has('language'))
                                    <span class="text-danger">{{ $errors->first('language') }}</span>
                                    @endif
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                            </div> -->

                                    <div class="col-xl-6 col-g-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <!--begin::Label-->
                                            <label class=" fw-bold fs-6 mb-2">Referring Provider</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->

                                            <label class="select-label">
                                                <select name="referring_provider" class="form-control form-control-solid">
                                                    <option value="0">Select Referring provider</option>
                                                    @foreach($getRefferingDR as $value)
                                                    <option {{ ($patientDetail[0]->patientDetails->referring_provider == $value->id)?"selected":"" }} value="{{$value->id }}">{{ $value->first_name.' '.$value->last_name}}</option>
                                                    @endforeach
                                                </select>
                                            </label>

                                            <!--end::Input-->
                                            @if ($errors->has('referring_provider'))
                                            <span class="text-danger">{{ $errors->first('referring_provider') }}</span>
                                            @endif
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-g-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <!--begin::Label-->
                                            <label class="required fw-bold fs-6 mb-2">EZMed Number</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="EZMed_number" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="EZMed Number" value="{{ $patientDetail[0]->patientDetails->EZMed_number }}">
                                            <!--end::Input-->
                                            @if ($errors->has('EZMed_number'))
                                            <span class="text-danger">{{ $errors->first('EZMed_number') }}</span>
                                            @endif
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-g-6">
                                        <div class="fv-row fv-plugins-icon-container">
                                            <!--begin::Label-->
                                            <label class=" fw-bold fs-6 mb-2">Gender</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <div class="d-flex gender">
                                                <div class="form-check d-flex align-items-center ps-0">
                                                    <!-- <input type="radio" name="gender" class="" value="Male" checked class="form-check-input">
                                                    <label class="fs-6 me-1 form-check-label">Male</label> -->
                                                    <input type="radio" id="test1" name="gender" value="male" {{ ($patientDetail[0]->patientDetails->gender == "male")?"checked":"" }}>
                                                    <label for="test1">Male</label>
                                                </div>
                                                <div class="form-check d-flex align-items-center ps-0">
                                                    <!-- <input type="radio" name="gender" class="" value="female" class="form-check-input">
                                                    <label class="fs-6 me-1 form-check-label">Female</label> -->
                                                    <input type="radio" id="test2" name="gender" value="female" {{ ($patientDetail[0]->patientDetails->gender == "female")?"checked":"" }}>
                                                    <label for="test2">Female</label>
                                                </div>
                                                <div class="form-check d-flex align-items-center ps-0">

                                                    <!-- <input type="radio" name="gender" class="" value="other" class="form-check-input"> -->
                                                    <input type="radio" id="test3" name="gender" value="other" {{ ($patientDetail[0]->patientDetails->gender == "other")?"checked":"" }}>
                                                    <label for="test3">Other</label>
                                                </div>

                                            </div>


                                            <!--end::Input-->
                                            @if ($errors->has('gender'))
                                            <span class="text-danger">{{ $errors->first('gender') }}</span>
                                            @endif
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="contact-wrp mt-5">
                                <div class="card-title">Contact Details</div>
                                <div class="row">

                                    <div class="col-xxl-6 col-xl-6 col-lg-12">
                                        <div class="row">
                                            <div class="col-xl-12 col-lg-6 col-md-6">
                                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                                    <!--begin::Label-->
                                                    <label class=" fw-bold fs-6 mb-2">Next Of Kin</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <select class="form-control form-control-solid mb-3 mb-lg-0" name="next_of_kin" id="next_of_kin">
                                                        <option {{ ($patientDetail[0]->patientDetails->next_of_kin == "Father")?"selected":"" }} value="Father">Select Next Of Kin</option>
                                                        <option {{ ($patientDetail[0]->patientDetails->next_of_kin == "Father")?"selected":"" }} value="Father">Father</option>
                                                        <option {{ ($patientDetail[0]->patientDetails->next_of_kin == "Mother")?"selected":"" }} value="Mother">Mother</option>
                                                        <option {{ ($patientDetail[0]->patientDetails->next_of_kin == "Partner")?"selected":"" }} value="Partner">Partner</option>
                                                        <option {{ ($patientDetail[0]->patientDetails->next_of_kin == "Spouse")?"selected":"" }} value="Spouse">Spouse</option>
                                                        <option {{ ($patientDetail[0]->patientDetails->next_of_kin == "Sibling")?"selected":"" }} value="Sibling">Sibling</option>
                                                        <option {{ ($patientDetail[0]->patientDetails->next_of_kin == "Son")?"selected":"" }} value="Son">Son</option>
                                                        <option {{ ($patientDetail[0]->patientDetails->next_of_kin == "Daughter")?"selected":"" }} value="Daughter">Daughter</option>
                                                        <option {{ ($patientDetail[0]->patientDetails->next_of_kin == "Friend")?"selected":"" }} value="Friend">Friend</option>
                                                        <option {{ ($patientDetail[0]->patientDetails->next_of_kin == "Other")?"selected":"" }} value="Other">Other</option>
                                                    </select>

                                                    <!--end::Input-->
                                                    @if ($errors->has('next_of_kin'))
                                                    <span class="text-danger">{{ $errors->first('next_of_kin') }}</span>
                                                    @endif
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                            </div>

                                            <div class="col-xl-12 col-lg-6 col-md-6 col-12">
                                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                                    <!--begin::Label-->
                                                    <label class=" fw-bold fs-6 mb-2">Name</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Name" value="{{$patientDetail[0]->patientDetails->name}}">
                                                    <!--end::Input-->
                                                    @if ($errors->has('name'))
                                                    <span class=" text-danger">{{ $errors->first('name') }}</span>
                                                    @endif
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                            </div>

                                            <div class="col-xl-12 col-lg-6 col-md-6 col-12">
                                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                                    <!--begin::Label-->
                                                    <label class=" fw-bold fs-6 mb-2">Surname</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" name="surname" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Surname" value="{{ $patientDetail[0]->patientDetails->surname }}">
                                                    <!--end::Input-->
                                                    @if ($errors->has('surname'))
                                                    <span class="text-danger">{{ $errors->first('surname') }}</span>
                                                    @endif
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                            </div>

                                            <div class="col-xl-12 col-lg-6 col-md-6">
                                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                                    <!--begin::Label-->
                                                    <label class=" fw-bold fs-6 mb-2">Preferred Contact Type for Essenital Communication</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <select class="form-control form-control-solid mb-3 mb-lg-0" name="essenital_contact_type" id="essenital_contact_type">
                                                        <option {{ ($patientDetail[0]->patientDetails->essenital_contact_type == '1')?'selected':'' }} value="1">Both Email & Mobile Number</option>
                                                        <option {{ ($patientDetail[0]->patientDetails->essenital_contact_type == '2')?'selected':'' }} value="2">Mobile Number</option>
                                                        <option {{ ($patientDetail[0]->patientDetails->essenital_contact_type == '3')?'selected':'' }} value="3">Email</option>

                                                    </select>
                                                    <!--end::Input-->
                                                    @if ($errors->has('essenital_contact_type'))
                                                    <span class="text-danger">{{ $errors->first('essenital_contact_type') }}</span>
                                                    @endif
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                            </div>

                                            <div class="col-xl-12 col-lg-6 col-md-6">
                                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                                    <!--begin::Label-->
                                                    <label class=" fw-bold fs-6 mb-2">Email</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="email" class="form-control" name="email" id="email" value="{{ $patientDetail[0]->email}}" placeholder="Email">
                                                    <!--end::Input-->
                                                    @if ($errors->has('email'))
                                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                                    @endif
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                            </div>

                                            <div class="col-xl-12 col-lg-6 col-md-6">
                                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                                    <!--begin::Label-->
                                                    <label class=" fw-bold fs-6 mb-2">Contact Number</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" name="contact_number" id="contact_number" class="form-control form-control-solid mb-3 mb-lg-0 " placeholder="Contact Number" value="{{ (!empty($patientDetail[0]->patientDetails->contact_number))?'+'.$patientDetail[0]->patientDetails->country_code.$patientDetail[0]->patientDetails->contact_number:'' }}">
                                                    <input type="hidden" name="country_code" id="country_code" value="{{ $patientDetail[0]->patientDetails->country_code }}">

                                                    <!--end::Input-->
                                                    @if ($errors->has('contact_number'))
                                                    <span class="text-danger">{{ $errors->first('contact_number') }}</span>
                                                    @endif
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                            </div>

                                            <div class="col-xl-12 col-lg-6 col-md-6">
                                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                                    <!--begin::Label-->
                                                    <label class=" fw-bold fs-6 mb-2">Home Number</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->

                                                    <input type="text" name="home_number" class="form-control form-control-solid mb-3 mb-lg-0" id="home_number" placeholder="Home Number" value="{{ (!empty($patientDetail[0]->patientDetails->home_number))?'+'.$patientDetail[0]->patientDetails->home_country_code.$patientDetail[0]->patientDetails->home_number:'' }}">

                                                    <input type="hidden" name="home_country_code" id="home_country_code" value="{{ $patientDetail[0]->patientDetails->home_country_code }}">

                                                    <!--end::Input-->
                                                    @if ($errors->has('home_number'))
                                                    <span class="text-danger">{{ $errors->first('home_number') }}</span>
                                                    @endif
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                            </div>

                                            <div class="col-xl-12 col-lg-6 col-md-6">
                                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                                    <!--begin::Label-->
                                                    <label class=" fw-bold fs-6 mb-2">Work Number</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" name="work_number" class="form-control form-control-solid mb-3 mb-lg-0" id="work_number" placeholder="Work Number" value="{{ (!empty($patientDetail[0]->patientDetails->work_number))?'+'.$patientDetail[0]->patientDetails->work_country_code.$patientDetail[0]->patientDetails->work_number:'' }}">
                                                    <input type="hidden" name="work_country_code" id="work_country_code" value="{{ $patientDetail[0]->patientDetails->work_country_code }}">

                                                    <!--end::Input-->
                                                    @if ($errors->has('work_number'))
                                                    <span class="text-danger">{{ $errors->first('work_number') }}</span>
                                                    @endif
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                            </div>

                                            <!-- <div class="col-xl-12 col-lg-6 col-md-6">
                                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                                  
                                                    <label class=" fw-bold fs-6 mb-2">FAX Number</label>
                                                 
                                                  
                                                    <input type="text" name="fax_number" class="form-control form-control-solid mb-3 mb-lg-0" id="fax_number" placeholder="FAX Number" value="{{ (!empty($patientDetail[0]->patientDetails->fax_number))?'+'.$patientDetail[0]->patientDetails->fax_country_code.$patientDetail[0]->patientDetails->fax_number:'' }}">
                                                    <input type="hidden" name="fax_country_code" id="fax_country_code" value="{{ $patientDetail[0]->patientDetails->fax_country_code }}">

                                                 
                                                    @if ($errors->has('fax_number'))
                                                    <span class="text-danger">{{ $errors->first('fax_number') }}</span>
                                                    @endif
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                            </div> -->

                                            <div class="col-xl-12 col-lg-6 col-md-6">
                                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                                    <!--begin::Label-->
                                                    <label class=" fw-bold fs-6 mb-2">Alternative Contact Number</label>
                                                    <!--end::Label-->
                                                    <input type="text" name="alternative_contact_number" class="form-control form-control-solid mb-3 mb-lg-0" id="alternative_contact_number" placeholder="Alternative Contact Number" value="{{ (!empty($patientDetail[0]->patientDetails->alternative_contact_number))?'+'.$patientDetail[0]->patientDetails->alternative_country_code.$patientDetail[0]->patientDetails->alternative_contact_number:'' }}">
                                                    <input type="hidden" name="alternative_country_code" id="alternative_country_code" value="{{ $patientDetail[0]->patientDetails->alternative_country_code }}">

                                                    <!--end::Input-->
                                                    @if ($errors->has('alternative_contact_number'))
                                                    <span class="text-danger">{{ $errors->first('alternative_contact_number') }}</span>
                                                    @endif
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                            </div>

                                            <!-- <div class="col-xl-12 col-lg-6 col-md-6">
                                                <div class="fv-row mb-7  fv-plugins-icon-container">
                                                    <div class="check-box-wrp">
                                                      
                                                        <input class="form-check-input" name="non_essential_same_essential_detail" type="checkbox" value="1" id="non_essential_same_essential_detail" {{ ($patientDetail[0]->patientDetails->non_essential_same_essential_detail == '1')?'checked':'' }}>
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            The Non-Essential contact details is the same as the Essenital contact details
                                                        </label>
                                                    </div>
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                            </div> -->
                                            <div class="col-xl-12 col-lg-6 col-md-6">
                                                <div class="fv-row mb-7  fv-plugins-icon-container">
                                                    <div class="check-box-wrp">
                                                        <!--begin::Label-->
                                                        <input class="form-check-input" name="agree_share_contact" type="checkbox" value="1" id="agree_share_contact" {{ ($patientDetail[0]->patientDetails->agree_share_contact == '1')?'checked':'' }}>
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            By proceeding, you consent to the use of your personal information for essential healthcare purposes, including appointment scheduling, correspondence, and report sharing.
                                                        </label>
                                                    </div>
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-xl-6 col-lg-12">
                                        <div class="row">
                                            <div class="col-xl-12 col-lg-12">
                                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                                    <!--begin::Label-->
                                                    <label class=" fw-bold fs-6 mb-2">Preferred Contact Type</label>
                                                    <span>Additionally, you may opt-in to receive non-essential communications such as marketing and resource sharing</span>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <select class="form-control form-control-solid mb-3 mb-lg-0" name="non_essenital_contact_type" id="non_essenital_contact_type">
                                                        <option {{ ($patientDetail[0]->patientDetails->non_essenital_contact_type == '1')?'selected':'' }} value="1">Both Email & Mobile Number</option>
                                                        <option {{ ($patientDetail[0]->patientDetails->non_essenital_contact_type == '2')?'selected':'' }} value="2">Mobile Number</option>
                                                        <option {{ ($patientDetail[0]->patientDetails->non_essenital_contact_type == '3')?'selected':'' }} value="3">Email</option>

                                                    </select>
                                                    <!--end::Input-->
                                                    @if ($errors->has('non_essenital_contact_type'))
                                                    <span class="text-danger">{{ $errors->first('non_essenital_contact_type') }}</span>
                                                    @endif
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="col-xl-12 col-lg-12">
                                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                                    <div class="check-box-wrp">
                                                        <input class="form-check-input" name="unsubscribe_non_essential_email" type="checkbox" value="0" id="unsubscribe_non_essential_email" {{ ($patientDetail[0]->patientDetails->unsubscribe_non_essential_email == '0')?'checked':'' }}>
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            Opt In
                                                        </label>
                                                    </div>

                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="col-xl-12 col-lg-12">
                                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                                    <div class="check-box-wrp">
                                                        <input class="form-check-input" name="unsubscribe_non_essential_sms" type="checkbox" value="0" id="unsubscribe_non_essential_sms" {{ ($patientDetail[0]->patientDetails->unsubscribe_non_essential_sms == '0')?'checked':'' }}>
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            Opt Out
                                                        </label>
                                                    </div>
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="patient-wrp mt-5">
                                <div class="card-title">Address Details</div>
                                <div class="row">
                                    <!-- <div class="col-xl-6 col-lg-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">

                                            <label class=" fw-bold fs-6 mb-2">Physical Address</label>
                                            <input type="text" id="address" onfocus="initAutocomplete('address')" name="physical_address" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Physical Address" value="{{$patientDetail[0]->patientDetails->physical_address}}">
                                            <div id="result">
                                            </div>
                                            @if ($errors->has('physical_address'))
                                            <span class="text-danger">{{ $errors->first('physical_address') }}</span>
                                            @endif
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                    </div> -->

                                    <!-- <div class="col-xl-6 col-lg-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                       
                                            <label class=" fw-bold fs-6 mb-2">Complex Name</label>
                                            <input type="text" name="complex_name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Complex Name" value="{{$patientDetail[0]->patientDetails->complex_name}}">
                                            @if ($errors->has('complex_name'))
                                            <span class="text-danger">{{ $errors->first('complex_name') }}</span>
                                            @endif
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                    </div> -->

                                    <!-- <div class="col-xl-6 col-lg-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                        
                                            <label class=" fw-bold fs-6 mb-2">Unit No</label>
                                            <input type="text" name="unit_no" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Unit No" value="{{$patientDetail[0]->patientDetails->unit_no}}">
                                            @if ($errors->has('unit_no'))
                                            <span class="text-danger">{{ $errors->first('unit_no') }}</span>
                                            @endif
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                    </div> -->

                                    <div class="col-xl-6 col-lg-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">

                                            <label class=" fw-bold fs-6 mb-2">Street Name</label>
                                            <input type="text" id="street_name" name="street_name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Street Name" value="{{$patientDetail[0]->patientDetails->street_name}}">
                                            <div id="result">
                                            </div>
                                            @if ($errors->has('street_name'))
                                            <span class="text-danger">{{ $errors->first('street_name') }}</span>
                                            @endif
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">

                                            <label class=" fw-bold fs-6 mb-2">City</label>
                                            <input type="text" id="city" name="city" class="form-control form-control-solid" value="{{$patientDetail[0]->patientDetails->city}}">
                                            @if ($errors->has('city'))
                                            <span class="text-danger">{{ $errors->first('city') }}</span>
                                            @endif
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                    </div>



                                    <div class="col-xl-6 col-lg-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <!--begin::Label-->
                                            <label class=" fw-bold fs-6 mb-2">Postal Code</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="postal_code" id="postal_code" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Postal Code" value="{{$patientDetail[0]->patientDetails->postal_code}}">
                                            <!--end::Input-->
                                            @if ($errors->has('postal_code'))
                                            <span class="text-danger">{{ $errors->first('postal_code') }}</span>
                                            @endif
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <div class="col-xl-6 col-lg-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">

                                            <label class=" fw-bold fs-6 mb-2">Province</label>

                                            <input type="text" id="province" name="province" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Province" value="{{$patientDetail[0]->patientDetails->province}}">
                                            <div id="result">

                                            </div>

                                            @if ($errors->has('province'))
                                            <span class="text-danger">{{ $errors->first('province') }}</span>
                                            @endif
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <!--begin::Label-->
                                            <label class=" fw-bold fs-6 mb-2">Country</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select name="country" id="country">
                                                <option value="">Select Country</option>
                                                @foreach($countryList as $val)
                                                <option {{($patientDetail[0]->patientDetails->country== $val)?'selected':''}} value="{{$val}}">{{$val}}</option>
                                                @endforeach
                                            </select>

                                            <!--end::Input-->
                                            @if ($errors->has('country'))
                                            <span class="text-danger">{{ $errors->first('country') }}</span>
                                            @endif
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="patient-wrp mt-5">
                                <div class="card-title">Funder Details</div>
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <!--begin::Label-->
                                            <label class=" fw-bold fs-6 mb-2">Funder Type</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->

                                            <select name="funder_type" class="funder_type" data-live-search="true">
                                                <option value="" selected disabled>Select Funder Type</option>
                                                <option {{ ($patientDetail[0]->patientDetails->funder_type == "Medical Scheme")?"selected":"" }} value="Medical Scheme">Medical Scheme</option>
                                                <option {{ ($patientDetail[0]->patientDetails->funder_type == "Insurer")?"selected":"" }} value="Insurer">Insurer</option>
                                                <option {{ ($patientDetail[0]->patientDetails->funder_type == "Private")?"selected":"" }} value="Private">Private</option>
                                            </select>
                                            <!--end::Input-->
                                            @if ($errors->has('funder_type'))
                                            <span class="text-danger">{{ $errors->first('funder_type') }}</span>
                                            @endif
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                    </div>


                                    <div id="medical_scheme" class="d-none row">

                                        <div class="col-xl-6 col-lg-6">
                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class=" fw-bold fs-6 mb-2">Medical Aid</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" name="medical_aid" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Medical Aid" value="{{ $patientDetail[0]->patientDetails->medical_aid}}">
                                                <!--end::Input-->
                                                @if ($errors->has('medical_aid'))
                                                <span class="text-danger">{{ $errors->first('medical_aid') }}</span>
                                                @endif
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-lg-6">
                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class=" fw-bold fs-6 mb-2">Medical Aid Number</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" name="medical_aid_number" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Medical Aid Number" value="{{ $patientDetail[0]->patientDetails->medical_aid_number}}">
                                                <!--end::Input-->
                                                @if ($errors->has('medical_aid_number'))
                                                <span class="text-danger">{{ $errors->first('medical_aid_number') }}</span>
                                                @endif
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-lg-6">
                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class=" fw-bold fs-6 mb-2">Medical Aid Plan</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" name="medical_aid_plan" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Medical Aid Plan" value="{{ $patientDetail[0]->patientDetails->medical_aid_plan }}">
                                                <!--end::Input-->
                                                @if ($errors->has('medical_aid_plan'))
                                                <span class="text-danger">{{ $errors->first('medical_aid_plan') }}</span>
                                                @endif
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-lg-6">
                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class=" fw-bold fs-6 mb-2">Patient dependant Code</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" id="patient_dependant_code" name="patient_dependant_code" class="form-control form-control-solid" placeholder="00" value="{{ $patientDetail[0]->patientDetails->patient_dependant_code }}">


                                                <!--end::Input-->
                                                @if ($errors->has('patient_dependant_code'))
                                                <span class="text-danger">{{ $errors->first('patient_dependant_code') }}</span>
                                                @endif
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>
                                        </div>

                                    </div>

                                    <div id="insure" class="d-none row">

                                        <div class="col-xl-6 col-lg-6">
                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class=" fw-bold fs-6 mb-2">Membership / Reference Number</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" name="insure_membership_number" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Membership / Reference Number" value="{{ $patientDetail[0]->patientDetails->insure_membership_number}}">
                                                <!--end::Input-->
                                                @if ($errors->has('insure_membership_number'))
                                                <span class="text-danger">{{ $errors->first('insure_membership_number') }}</span>
                                                @endif
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-lg-6">
                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class=" fw-bold fs-6 mb-2">Medical Aid Plan</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" name="insure_medical_aid_plan" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Medical Aid Plan" value="{{ $patientDetail[0]->patientDetails->insure_medical_aid_plan}}">
                                                <!--end::Input-->
                                                @if ($errors->has('insure_medical_aid_plan'))
                                                <span class="text-danger">{{ $errors->first('insure_medical_aid_plan') }}</span>
                                                @endif
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-lg-6">
                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class=" fw-bold fs-6 mb-2">Contact Person (Optional)</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" id="contact_person" name="contact_person" class="form-control form-control-solid" placeholder="Contact Person" value="{{ $patientDetail[0]->patientDetails->contact_person}}">


                                                <!--end::Input-->
                                                @if ($errors->has('contact_person'))
                                                <span class="text-danger">{{ $errors->first('contact_person') }}</span>
                                                @endif
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="private" class="d-none row">

                                        <div class="col-xl-6 col-lg-6">
                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class=" fw-bold fs-6 mb-2">ID Number</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" name="id_number" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="ID Number" value="">
                                                <!--end::Input-->
                                                @if ($errors->has('id_number'))
                                                <span class="text-danger">{{ $errors->first('id_number') }}</span>
                                                @endif
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-lg-6">
                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class=" fw-bold fs-6 mb-2">cell_number</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" name="cell_number" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Cell Number" value="">
                                                <!--end::Input-->
                                                @if ($errors->has('cell_number'))
                                                <span class="text-danger">{{ $errors->first('cell_number') }}</span>
                                                @endif
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-lg-6">
                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class=" fw-bold fs-6 mb-2">Email Address</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" id="email_address" name="email_address" class="form-control form-control-solid" placeholder="Email Address" value="">


                                                <!--end::Input-->
                                                @if ($errors->has('email_address'))
                                                <span class="text-danger">{{ $errors->first('email_address') }}</span>
                                                @endif
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!--end::Scroll-->
                        <!--begin::Actions-->
                        <div class="text-center pt-5">
                            <a href="{{route('patient.index')}}" class="btn btn-danger me-3" data-kt-users-modal-action="cancel">Discard</a>
                            <input type="submit" class="btn btn-primary" value="Update">
                        </div>
                        <!--end::Actions-->
                        <div></div>
                    </form>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
    </div>
    <!--end::Content-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYCSSv9O2XmFIWrsBRFDvcNLRephrpcmE&libraries=places"></script>