<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">{{ $group_name->group_name }}</h1>
                <!--end::Title-->
                <!--begin::Separator-->
                <span class="h-20px border-gray-200 border-start mx-4"></span>
                <!--end::Separator-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="@if($role_id == 1) {{ route('admin.dashboard') }}@elseif($role_id == 2) {{ route('staff.dashboard') }}@elseif($role_id == 3 || $role_id == 4) {{ route('doctor.dashboard') }} @endif" class="text-muted text-hover-primary">Dashboard</a>
                    </li>
                    <!--end::Item-->

                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-200 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Attendance List</li>
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
            <div class="card grupList">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        Attendance List
                    </div>
                    <!--begin::Card title-->
                    <!--begin::Card toolbar-->

                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table-->

                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                        <!--begin::Table head-->
                        <thead>
                            <!--begin::Table row-->
                            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                <th class="min-w-125px">Id</th>
                                <th class="min-w-125px">Patient Name</th>
                                @php
                                $i = 1;
                                @endphp
                                @foreach($groupSession as $value)
                                <th>
                                    <div>
                                        <label> {{ $i}}</label>
                                        <label>{{ $value->session_date}}</label>
                                    </div>


                                </th>
                                @php
                                $i++;
                                @endphp
                                @endforeach
                            </tr>
                            <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody class="text-gray-600 fw-bold">

                            @foreach($patientDetails as $value)
                            <tr>
                                <td>{{$value->patient->id}}</td>
                                <td>{{$value->patient->first_name.' '.$value->patient->last_name .' ['. $value->patient->patientDetails->EZMed_number.']'}}</td>
                                @foreach($groupSession as $key => $sessionvalue)
                                <td>
                                    @if($sessionvalue->session_date < date('Y-m-d')) @if(in_array($value->patient->id,$getAttendancepatient) && in_array($sessionvalue->id,$getAttendancesession))
                                        <div class="form-check">
                                            <span><i class="fa fa-check" aria-hidden="true"></i></span>
                                        </div>
                                        @else
                                        <div class="form-check">
                                            <span><i class="far fa-times-circle"></i></span>
                                        </div>

                                        @endif
                                        @endif


                                        @if($sessionvalue->session_date == date('Y-m-d'))

                                        <div class="form-check">
                                            @if(in_array($value->patient->id,$getAttendancepatient) && in_array($sessionvalue->id,$getAttendancesession))
                                            <img src="{{asset('public/assets/media/attendence_sign/'.$getGroupAttendacneData[$key]->attend_sign_img)}}" width="100px">
                                            @else
                                            <button type="button" class="btn btn-primary attendancePatient" data-bs-toggle="modal" data-bs-target="#exampleModal" session_id="{{ $sessionvalue->id}}" group_id="{{$groupId}}" patient_id="{{ $value->patient->id}}">
                                                Attend
                                            </button>
                                            @endif
                                            <!-- <input type="checkbox" {{ (in_array($value->patient->id,$getAttendancepatient) && in_array($sessionvalue->id,$getAttendancesession))?"checked":""}} class="form-check-input patientAttendance" name="patient_id" session_id="{{ $sessionvalue->id}}" group_id="{{$groupId}}" value="{{ $value->patient->id}}" id="attendance{{ $value->patient->id}}"> -->
                                        </div>
                                        @endif
                                </td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
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

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('group.store_attendance')}}">
                    @csrf
                    <input type="hidden" name="session_id" id="session_id" value="">
                    <input type="hidden" name="group_id" id="group_id" value="">
                    <input type="hidden" name="patient_id" id="patient_id" value="">
                    <div class="col-md-12">
                        <label class="" for="">Signature:</label>
                        <br />
                        <div id="sig"></div>
                        <br />
                        <button id="clear" class="btn btn-danger btn-sm">Clear Signature</button>
                        <textarea id="signature64" name="signed" style="display: none"></textarea>
                    </div>
                    <br />
                    <input type="submit" class="btn btn-success" value="Confirm Attendence">
                </form>
            </div>

        </div>
    </div>
</div>



<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<link type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="{{asset('/assets/js/jquery.ui.touch-punch.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/assets/js/jquery.signature.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('/assets/css/jquery.signature.css')}}">
<script>
    var sig = $("#sig").signature({
        syncField: "#signature64",
        syncFormat: "PNG",
    });
    $("#clear").click(function(e) {
        e.preventDefault();
        sig.signature("clear");
        $("#signature64").val("");
    });

    $(".attendancePatient").click(function() {

        var session_id = $(this).attr('session_id');
        var group_id = $(this).attr('group_id');
        var patient_id = $(this).attr('patient_id');

        $('#session_id').val(session_id);
        $('#group_id').val(group_id);
        $('#patient_id').val(patient_id);

    })


    $('canvas.sig_canvas').each(function() {
        var id = $(this).attr('id'); //Get the ID of signature
        var width = $(this).closest('.sig_container').width(); //Get the width of the signature container
        sig_pads[id].off(); //Unbind all events on signature pad (I have an array of them)

        if (!$(this).data('prev_width') || Math.abs(width - $(this).data('prev_width')) > 30) { //Resize threshold 30px, only resize if previous width has changed by 30 pxs
            var ctx = $(this)[0].getContext('2d'); //Get context
            $(this).attr('width', width); //Set canvas width
            ctx.canvas.width = width; //Set context width
            $(this).data('prev_width', width); //Update prev_width for threshold
        }
        sig_pads[id].on(); //Rebind all signature events
    });
</script>