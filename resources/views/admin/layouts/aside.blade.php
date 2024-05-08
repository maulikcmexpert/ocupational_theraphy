<div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
    <!--begin::Brand-->
    <div class="aside-logo flex-column-auto" id="kt_aside_logo">
        <!--begin::Logo-->
        <a href="#">
            <img alt="Logo" src="{{ asset('assets/logo.png')}}" class="h-100px logo" />
        </a>
        <!--end::Logo-->
        <!--begin::Aside toggler-->
        <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="aside-minimize">
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr079.svg-->
            <span class="svg-icon svg-icon-1 rotate-180">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path opacity="0.5" d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z" fill="black" />
                    <path d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z" fill="black" />
                </svg>
            </span>
            <!--end::Svg Icon-->
        </div>
        <!--end::Aside toggler-->
    </div>
    <!--end::Brand-->
    <!--begin::Aside menu-->
    <div class="aside-menu flex-column-fluid">
        <!--begin::Aside Menu-->
        <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">
            <!--begin::Menu-->
            <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true">

                <div class="menu-item">

                    @php $role_id = Auth::guard('web')->user()->role_id @endphp

                    @if($role_id == 1)

                    @php
                    $dashboard = route('admin.dashboard');
                    @endphp

                    @elseif ($role_id == 2)
                    @php

                    $dashboard = route('staff.dashboard');
                    @endphp
                    @elseif ($role_id == 3)
                    @php

                    $dashboard = route('doctor.dashboard');
                    @endphp
                    @endif

                    <a class="menu-link {{ (Request::segment(2) == 'dashboard')? 'active':'' }}" href="{{$dashboard}}">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect x="2" y="2" width="9" height="9" rx="2" fill="black" />
                                    <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="black" />
                                    <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="black" />
                                    <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="black" />
                                </svg>

                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </div>

                @if($role_id == 1 || $role_id == 2)
                @if($role_id == 1 )

                @if(Auth::guard('web')->user()->id == 1)
                <div class="menu-item">
                    <a class="menu-link {{ (Request::segment(2) == 'subadmin')? 'active':'' }}" href="{{route('subadmin.index')}}">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 512 512" viewBox="0 0 512 512" id="administrator">
                                    <path d="M376,311.625c-80.602,0.436-62.207,0.337-65,0.352v-38.398c26.854-18.021,44.707-48.781,44.99-83.514H361
			c19.236,0,34.501-15.349,35-34.125l12.903-73.187c4.233-24.002-11.979-46.239-35.049-50.418l2.097-20.965
			c0.588-5.88-4.032-10.996-9.95-10.996H215c-22.506,0-42.102,12.671-52.048,31.25H146c-27.112,0-47.601,24.487-42.902,51.129
			l12.928,73.329c0.538,18.699,15.801,33.982,34.974,33.982h5v0.31c0,35.745,18.725,67.158,47,84.842v36.787
			c-10.171-0.136-70.939-1.093-79.14,0.696C91.032,318.468,66,347.169,66,381.625v120c0,5.523,4.478,10,10,10h360
			c5.522,0,10-4.477,10-10v-120C446,342.897,414.428,311.625,376,311.625z M377,331.65v159.975H276.185l17.688-22.584
			c1.639-2.092,2.377-4.75,2.052-7.388l-9.808-79.686l4.032-20.98L315,379.625c4.712,3.533,11.505,2.261,14.575-2.855l27.087-45.145
			C367.685,331.635,374.67,331.604,377,331.65z M193.87,356.972l-15.112-25.186c59.039,0.524,27.692,0.314,47.944,0.562
			C214.814,341.265,205.645,348.141,193.87,356.972z M256,335.375l16.349,12.262l-4.61,23.988h-23.941l-5.73-22.801L256,335.375z
			 M301.161,332.064l32.083-0.282l-15.114,25.191l-32.831-24.623L301.161,332.064z M361,170.065h-5c0-10.442,0-19.664,0-30h5
			c8.271,0,15,6.729,15,15C376,163.363,369.296,170.065,361,170.065z M389.207,79.281l-8.29,47.024
			c-11.43-7.956-22.313-5.926-24.917-6.239c-0.062-20.582,0.136-19.772-0.165-21.456c7.051-9.102,13.488-20.966,14.665-32.742
			l1.351-13.505C383.451,55.319,391.399,66.842,389.207,79.281z M146,51.625h10.525c-0.916,6.95-0.357,7.853-0.525,48.75v19.69
			c-2.597,0.312-13.471-1.708-24.916,6.243l-8.291-47.027C120.253,64.867,131.338,51.625,146,51.625z M151,170.065
			c-8.271,0-15-6.684-15-15c0-8.271,6.729-15,15-15h5c0,16.945,0,13.253,0,30H151z M176,190.375c0-25.479,0-65.514,0-80h160
			c0,8.22,0,70.76,0,78.856c0,44.267-35.488,80.666-79.108,81.139C212.211,270.878,176,234.765,176,190.375z M291,283.947v28.297
			l-35.003,0.63c-10.353-0.183-23.949-0.426-32.997-0.591v-27.473C244.641,292.354,268.853,292.387,291,283.947z M155.338,331.625
			l27.087,45.145c3.05,5.082,9.835,6.411,14.575,2.855l23.717-17.788l4.969,19.774l-19.378,76.302
			c-0.851,3.349,0.088,6.9,2.483,9.391l23.377,24.32H136v-160L155.338,331.625z M86,381.625c0-20.461,12.359-38.081,30-45.813
			v155.813H86V381.625z M426,491.625h-29v-155.36c17.105,7.951,29,25.288,29,45.36V491.625z"></path>
                                    <path d="M279 221.655c3.313-4.418 2.418-10.686-2-14-4.418-3.313-10.686-2.418-14 2-3.503 4.671-10.498 4.669-14 0-3.313-4.418-9.581-5.314-14-2-4.418 3.314-5.313 9.582-2 14C244.512 237.004 267.494 236.997 279 221.655zM221 171.625c5.522 0 10-4.477 10-10v-10c0-5.523-4.478-10-10-10s-10 4.477-10 10v10C211 167.148 215.478 171.625 221 171.625zM291 171.625c5.522 0 10-4.477 10-10v-10c0-5.523-4.478-10-10-10s-10 4.477-10 10v10C281 167.148 285.478 171.625 291 171.625z"></path>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">Sub-Admin</span>
                    </a>
                </div>
                @endif
                <div class="menu-item">
                    <a class="menu-link {{ (Request::segment(2) == 'company')? 'active':'' }}" href="{{route('company.index')}}">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 6.35 6.35" id="about">
                                    <path d="M 3.175 0 A 3.175 3.175 0 0 0 0 3.175 A 3.175 3.175 0 0 0 3.175 6.35 A 3.175 3.175 0 0 0 6.35 3.175 A 3.175 3.175 0 0 0 3.175 0 z M 3.175 1.3229167 A 0.26458332 0.26458332 0 0 1 3.4395833 1.5875 A 0.26458332 0.26458332 0 0 1 3.175 1.8520833 A 0.26458332 0.26458332 0 0 1 2.9104167 1.5875 A 0.26458332 0.26458332 0 0 1 3.175 1.3229167 z M 3.1760335 2.3807332 A 0.2645835 0.2645835 0 0 1 3.4395833 2.6463501 L 3.4395833 4.7619832 A 0.2645835 0.2645835 0 0 1 3.1760335 5.0276001 A 0.2645835 0.2645835 0 0 1 2.9104167 4.7619832 L 2.9104167 2.6463501 A 0.2645835 0.2645835 0 0 1 3.1760335 2.3807332 z " paint-order="markers fill stroke"></path>
                                </svg>
                            </span>
                        </span>
                        <!--end::Svg Icon-->

                        <span class="menu-title">Info</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ (Request::segment(2) == 'ras_question')? 'active':'' }}" href="{{route('ras_question.index')}}">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                <!-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="black"></path>
                                    <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="black"></rect>
                                </svg> -->

                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="question">
                                    <g data-name="Layer 2">
                                        <path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm0 16a1 1 0 1 1 1-1 1 1 0 0 1-1 1zm1-5.16V14a1 1 0 0 1-2 0v-2a1 1 0 0 1 1-1 1.5 1.5 0 1 0-1.5-1.5 1 1 0 0 1-2 0 3.5 3.5 0 1 1 4.5 3.34z" data-name="menu-arrow-circle"></path>
                                    </g>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">RAS Questionnaire</span>
                    </a>
                </div>


                <div class="menu-item">
                    <a class="menu-link {{ (Request::segment(2) == 'staff')? 'active':'' }}" href="{{route('staff.index')}}">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                <!-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="black"></path>
                                    <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="black"></rect>
                                </svg> -->
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" id="human-assets">
                                    <path d="M43.49 21.73c.04.36.27.66.61.8.21.08 3.59 1.39 8.91 1.39 2.64 0 5.76-.32 9.21-1.27.38-.11.66-.43.71-.83l.3-2.73c.2-1.82-.2-3.33-1.2-4.49-1.6-1.86-4.19-2.09-4.63-2.12-.18-.03-.33-.06-.47-.11-.55-.18-.66-.43-.68-.65 1.99-1.91 2.27-4.89 2.28-5 .07-.64.08-1.22.03-1.75V4.88C58.21.89 54.91-.06 53.26.01c-.1 0-2.29-.07-3.88 1.47-1.03 1-1.54 2.41-1.53 4.18.01.33.03.68.06 1.03.01.13.29 3.11 2.27 5.02-.04.2-.19.42-.68.58h-.02c-.13.04-.28.08-.44.1-.44.03-3.03.26-4.63 2.12-1 1.16-1.4 2.67-1.2 4.49l.28 2.73zm7.22-18.85c.98-.96 2.47-.94 2.53-.93.12-.01 2.41-.06 3.16 2.1-1.6-.11-3.5-.92-4.22-1.3a.968.968 0 0 0-1.01.06l-.89.62c.13-.21.27-.39.43-.55zm-.87 3.62c-.01-.13-.02-.25-.02-.38l2.01-1.4c.94.43 2.93 1.23 4.8 1.27-.01.17-.02.34-.04.54 0 .03-.29 2.84-2.09 4.13-.02.01-.05.03-.07.05-.04.03-.08.06-.12.08-.68.43-1.5.42-2.19 0-.04-.03-.09-.05-.13-.08-.02-.02-.05-.03-.07-.05-.06-.04-.11-.08-.16-.12-1.67-1.37-1.92-3.99-1.92-4.04zm5.23 6.98c-.42.19-1.04.36-1.86.36-.88 0-1.51-.19-1.93-.39.24-.22.41-.45.54-.68.45.17.92.26 1.39.26.46 0 .91-.09 1.35-.25.12.27.3.5.51.7zm-9.21 2.3c1.16-1.35 3.29-1.46 3.3-1.46.03 0 .07 0 .1-.01h.01c.72.9 2.19 1.47 3.94 1.47 1.71 0 3.14-.54 3.88-1.39.02 0 .05.01.07.01.03 0 .07.01.1.01.02 0 2.14.11 3.3 1.45.63.73.88 1.75.74 3.01l-.23 2.07c-7.89 2.01-13.93.52-15.72-.04l-.23-2.12c-.14-1.25.11-2.26.74-3zm11.53 36.78c-.18-.03-.33-.06-.47-.11-.55-.18-.66-.43-.68-.65 1.99-1.91 2.27-4.88 2.28-4.99.07-.64.08-1.22.03-1.75V44.97c-.35-3.99-3.67-4.93-5.3-4.87-.1 0-2.29-.07-3.88 1.47-1.03 1-1.54 2.41-1.53 4.18.01.33.03.68.06 1.03.01.13.29 3.11 2.27 5.02-.04.2-.19.42-.68.58h-.02c-.13.04-.28.08-.44.1-.44.03-3.03.26-4.63 2.12-1 1.16-1.4 2.67-1.2 4.49l.3 2.73c.04.36.27.66.61.8.21.08 3.59 1.39 8.91 1.39 2.64 0 5.76-.32 9.21-1.27.38-.11.66-.43.71-.83l.3-2.73c.2-1.82-.2-3.33-1.2-4.49-1.62-1.87-4.21-2.11-4.65-2.13zm-6.68-9.6c.97-.96 2.44-.93 2.53-.93.1-.01 2.41-.06 3.16 2.1-1.6-.11-3.5-.92-4.22-1.3a.968.968 0 0 0-1.01.06l-.89.62c.13-.2.27-.39.43-.55zm-.87 3.63c-.01-.13-.02-.25-.02-.38l2.01-1.4c.94.43 2.93 1.23 4.8 1.27-.01.17-.02.34-.04.53 0 .03-.27 2.84-2.09 4.13-.02.01-.05.03-.07.05-.04.03-.08.06-.12.08-.68.43-1.5.42-2.19 0-.04-.03-.09-.05-.13-.08-.02-.02-.05-.03-.08-.05-.05-.04-.11-.08-.16-.12-1.66-1.36-1.91-3.99-1.91-4.03zm5.23 6.98c-.42.19-1.04.36-1.86.36-.88 0-1.51-.19-1.93-.39.24-.22.41-.45.54-.68.45.17.92.26 1.39.26.46 0 .91-.09 1.35-.25.12.26.3.5.51.7zm6.23 5.39-.23 2.07c-7.89 2.02-13.93.52-15.72-.04l-.23-2.12c-.14-1.26.11-2.27.73-3 1.16-1.35 3.29-1.46 3.3-1.46.03 0 .07 0 .1-.01h.01c.72.9 2.19 1.47 3.94 1.47 1.71 0 3.14-.54 3.88-1.39.02 0 .05.01.07.01.03 0 .07.01.1.01.02 0 2.14.11 3.3 1.45.64.73.89 1.74.75 3.01zM1.07 21.73c.04.36.27.66.61.8.21.08 3.59 1.39 8.91 1.39 2.64 0 5.76-.32 9.21-1.27.38-.11.66-.43.71-.83l.3-2.73c.2-1.82-.2-3.33-1.2-4.49-1.6-1.86-4.19-2.09-4.63-2.12-.18-.03-.33-.06-.47-.11-.55-.18-.66-.43-.68-.65 1.99-1.91 2.27-4.89 2.27-5 .07-.64.08-1.23.03-1.75V4.88C15.78.89 12.47-.06 10.83.01c-.1 0-2.29-.07-3.87 1.47-1.03 1-1.54 2.41-1.53 4.18 0 .33.03.68.06 1.03.01.13.28 3.11 2.26 5.02-.04.2-.19.42-.68.58h-.02c-.13.04-.28.08-.45.1-.44.03-3.03.26-4.63 2.12C.97 15.67.56 17.18.77 19l.3 2.73zM8.29 2.88c.98-.96 2.46-.94 2.53-.93.12-.01 2.41-.06 3.16 2.1-1.6-.11-3.5-.92-4.22-1.3a.948.948 0 0 0-1 .05l-.89.63c.12-.21.26-.39.42-.55zM7.41 6.5c-.01-.13-.01-.25-.02-.37l2.01-1.4c.94.43 2.93 1.23 4.8 1.27-.01.17-.02.34-.04.54 0 .03-.29 2.84-2.09 4.13-.02.01-.05.03-.07.05-.04.03-.08.06-.12.08-.69.43-1.5.43-2.19 0-.04-.03-.09-.05-.13-.08-.02-.02-.05-.03-.08-.05-.05-.04-.11-.08-.16-.12-1.65-1.38-1.9-4-1.91-4.05zm5.24 6.98c-.42.19-1.04.36-1.86.36-.88 0-1.51-.19-1.93-.39.24-.22.41-.45.54-.68.45.17.92.26 1.39.26.46 0 .91-.09 1.35-.25.12.27.29.5.51.7zm-9.21 2.3c1.16-1.35 3.29-1.46 3.3-1.46.03 0 .07 0 .1-.01h.01c.72.9 2.19 1.47 3.94 1.47 1.71 0 3.14-.54 3.88-1.39.02 0 .04.01.07.01.03 0 .07.01.1.01.02 0 2.14.11 3.3 1.45.63.73.88 1.75.74 3.01l-.23 2.07c-7.89 2.02-13.93.52-15.72-.04l-.23-2.12c-.14-1.25.11-2.26.74-3zm11.53 36.78c-.17-.03-.33-.06-.47-.11-.55-.18-.66-.43-.68-.65 1.99-1.91 2.27-4.89 2.27-5 .07-.64.08-1.23.03-1.75V44.96c-.35-3.99-3.67-4.93-5.3-4.87-.1 0-2.29-.07-3.87 1.47-1.03 1-1.54 2.41-1.53 4.18 0 .33.03.68.06 1.03.01.13.28 3.11 2.26 5.02-.04.2-.19.42-.68.58h-.02c-.13.04-.28.08-.45.1-.44.03-3.03.26-4.63 2.12-1 1.16-1.41 2.67-1.2 4.49l.3 2.73c.04.36.27.66.61.8.22.08 3.6 1.39 8.92 1.39 2.64 0 5.76-.32 9.21-1.27.38-.11.66-.43.71-.83l.3-2.73c.2-1.82-.2-3.33-1.2-4.49-1.61-1.86-4.2-2.1-4.64-2.12zm-6.68-9.6c.97-.96 2.43-.93 2.53-.93.11-.01 2.41-.06 3.16 2.1-1.6-.11-3.5-.92-4.22-1.3a.968.968 0 0 0-1.01.06l-.89.62c.13-.2.27-.39.43-.55zm-.88 3.63c-.01-.13-.01-.25-.02-.38l2.01-1.4c.94.43 2.93 1.23 4.8 1.27-.01.17-.02.34-.04.54 0 .03-.29 2.84-2.09 4.13-.02.01-.05.03-.07.05-.04.03-.08.06-.12.08-.68.43-1.51.42-2.19 0-.04-.03-.09-.05-.13-.08-.03-.02-.05-.04-.08-.05-.06-.04-.11-.08-.16-.12-1.65-1.37-1.9-4-1.91-4.04zm5.24 6.98c-.42.19-1.04.36-1.86.36-.88 0-1.51-.19-1.93-.39.24-.22.41-.45.54-.68.45.17.92.26 1.39.26.46 0 .91-.09 1.35-.25.12.26.29.5.51.7zm6.23 5.39-.23 2.07c-7.89 2.02-13.93.52-15.72-.04l-.23-2.12c-.14-1.26.11-2.27.73-3 1.16-1.35 3.29-1.46 3.3-1.46.03 0 .07 0 .1-.01h.01c.72.9 2.19 1.47 3.94 1.47 1.71 0 3.15-.54 3.88-1.4.05.01.11.02.16.02.02 0 2.15.11 3.31 1.46.64.74.89 1.75.75 3.01zm27.36-11.15.45-4.14c.29-2.62-.28-4.78-1.7-6.43-2.34-2.71-6.16-3.02-6.7-3.04-.3-.04-.58-.11-.82-.18h-.01c-.5-.17-.81-.74-.98-1.19-.33-.86-.41-1.9-.4-2.25v-.05c3.03-2.75 3.45-7.25 3.46-7.43.11-.95.12-1.82.05-2.59v-.1c-.5-5.69-5.21-7-7.55-6.93-.13 0-3.26-.09-5.51 2.09-1.46 1.42-2.19 3.43-2.17 5.98.01.5.04 1.02.09 1.53.02.2.44 4.71 3.47 7.46-.02.97-.09 2.24-.15 2.45 0 .01-.01.01-.01.02-.21.4-.63.71-1.26.91h-.02c-.21.07-.48.13-.78.18-.55.03-4.36.33-6.7 3.04-1.42 1.65-1.99 3.81-1.7 6.43l.45 4.14c.04.36.27.66.61.8.31.12 5.36 2.07 13.33 2.07 3.96 0 8.65-.48 13.84-1.91.39-.14.67-.47.71-.86zM27.87 16.95c1.64-1.6 4.08-1.55 4.17-1.55.48-.01 4.57 0 5.48 4.21-3.21.08-7.26-2.03-7.3-2.05a.968.968 0 0 0-1.01.06l-2.67 1.87c.24-1.03.67-1.89 1.33-2.54zm-1.49 5.91c-.03-.3-.04-.58-.05-.87l3.51-2.46c1.32.63 4.8 2.12 7.86 2 0 .42-.03.86-.08 1.35 0 .05-.41 4.53-3.39 6.64l-.09.06c-.07.05-.14.1-.21.14-1.2.75-2.65.75-3.85 0-.08-.05-.15-.1-.22-.15-.03-.02-.06-.04-.1-.06-.1-.07-.19-.14-.29-.22-2.69-2.17-3.08-6.36-3.09-6.43zm5.6 12.22-2.28-2.03c.05-.37.09-.82.12-1.28.7.3 1.44.45 2.18.45.76 0 1.51-.16 2.23-.47.05.35.13.72.23 1.11l-2.48 2.22zm.63 3.32-.61.67-.56-.62.58-.66.59.61zm-2-1.94-.96 1.09-1.45-2.32c.21-.13.4-.28.56-.42l1.85 1.65zm4.7-1.76c.16.22.34.41.54.58l-1.33 2.29-1.13-1.15 1.92-1.72zM19.62 46.86l-.39-3.53c-.23-2.06.19-3.72 1.24-4.94 1.91-2.22 5.34-2.38 5.37-2.38.03 0 .07 0 .11-.01.14-.02.27-.05.4-.07l2.35 3.76c.16.26.44.43.74.45h.08c.23 0 .43-.1.6-.24l.26.29-1.19 5.98c-.07.36.07.74.36.96l1.86 1.41c.03.02.07.03.1.05-6.12-.04-10.43-1.25-11.89-1.73zm11.6-.92L32 42l.78 3.94-.78.6-.78-.6zm13.54-2.48-.38 3.48a49.364 49.364 0 0 1-11.86 1.63c.02-.02.05-.02.08-.04l1.85-1.41c.29-.22.43-.6.36-.96l-1.19-5.98.36-.39.05.05c.18.19.43.29.69.29.04 0 .08 0 .12-.01.3-.04.57-.21.72-.48l2.09-3.6c.14.03.27.06.42.08.03 0 .07.01.1.01s3.46.16 5.37 2.39c1.04 1.22 1.45 2.88 1.22 4.94z"></path>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">Staff</span>
                    </a>
                </div>


                @endif
                <div class="menu-item">
                    <a class="menu-link {{ (Request::segment(2) == 'group')? 'active':'' }}" href="{{route('group.index')}}">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                <!-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="black"></path>
                                    <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="black"></rect>
                                </svg> -->
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" id="group">
                                    <path d="M9.5 18A4.5 4.5 0 1 1 14 13.5 4.51 4.51 0 0 1 9.5 18zm0-7A2.5 2.5 0 1 0 12 13.5 2.5 2.5 0 0 0 9.5 11zM19.5 13A5.5 5.5 0 1 1 25 7.5 5.51 5.51 0 0 1 19.5 13zm0-9A3.5 3.5 0 1 0 23 7.5 3.5 3.5 0 0 0 19.5 4zM11.5 30h-4a5.5 5.5 0 0 1 0-11h4a5.5 5.5 0 0 1 0 11zm-4-9a3.5 3.5 0 0 0 0 7h4a3.5 3.5 0 0 0 0-7z"></path>
                                    <path d="M22.5,30H12a1,1,0,0,1,0-2H22.5a5.5,5.5,0,0,0,0-11h-6a1,1,0,0,1,0-2h6a7.5,7.5,0,0,1,0,15Z"></path>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">Group</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ (Request::segment(2) == 'doctor')? 'active':'' }}" href="{{route('doctor.index')}}">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">

                                <svg xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" clip-rule="evenodd" viewBox="0 0 32 32" id="doctor">
                                    <path d="M9.733,14.107c-1.387,0.252 -2.676,0.921 -3.687,1.932c-1.309,1.309 -2.044,3.084 -2.044,4.935l0,4.039c0,1.657 1.343,3 3,3c4.184,-0 13.816,-0 18,-0c1.657,-0 3,-1.343 3,-3l0,-4.039c0,-1.851 -0.735,-3.626 -2.044,-4.935c-1.011,-1.011 -2.3,-1.68 -3.687,-1.932c0.468,-0.939 0.731,-1.997 0.731,-3.117c0,-3.863 -3.137,-7 -7,-7c-3.863,0 -7,3.137 -7,7c0,1.12 0.263,2.178 0.731,3.117Zm12.263,1.984l-0,2.079c1.164,0.412 2,1.524 2,2.83c0,1.101 0.004,1.995 0.004,1.995c0.003,0.552 -0.443,1.002 -0.995,1.005c-0.552,0.002 -1.002,-0.444 -1.005,-0.995c0,-0 -0.004,-0.899 -0.004,-2.005c0,-0.552 -0.446,-1 -0.997,-1c-0.551,-0 -0.997,0.448 -0.997,1l-0.002,2.001c-0.001,0.552 -0.449,1 -1.001,0.999c-0.552,-0.001 -1,-0.449 -0.999,-1.001c-0,-0 0.002,-2 0.002,-1.999c0,-1.304 0.833,-2.414 1.994,-2.828l-0,-1.433c-1.133,0.789 -2.51,1.251 -3.994,1.251c-1.489,0 -2.871,-0.466 -4.006,-1.26l-0,1.441c1.165,0.412 2,1.524 2,2.829c0,1.656 -1.344,3 -3,3c-1.656,-0 -3,-1.344 -3,-3c-0,-1.305 0.835,-2.417 2,-2.829l-0,-2.078c-0.954,0.193 -1.837,0.662 -2.535,1.36c-0.934,0.934 -1.459,2.201 -1.459,3.521c0,0 0,4.039 0,4.039c0,0.552 0.448,1 1,1l18,-0c0.552,-0 1,-0.448 1,-1c0,-0 0,-4.039 0,-4.039c0,-1.32 -0.525,-2.587 -1.458,-3.521c-0.701,-0.701 -1.59,-1.171 -2.548,-1.362Zm-11,3.909c0.552,-0 1,0.448 1,1c0,0.552 -0.448,1 -1,1c-0.552,-0 -1,-0.448 -1,-1c-0,-0.552 0.448,-1 1,-1Zm5.006,-14.01c2.76,0 5,2.241 5,5c0,2.76 -2.24,5 -5,5c-2.76,0 -5,-2.24 -5,-5c0,-2.759 2.24,-5 5,-5Z"></path>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">Therapist</span>
                    </a>
                </div>





                @endif

                <div class="menu-item">
                    <a class="menu-link {{ (Request::segment(1) == 'patient')? 'active':'' }} " href="{{route('patient.index')}}">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                <!-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="black"></path>
                                    <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="black"></rect>
                                </svg> -->

                                <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 512 512" viewBox="0 0 512 512" id="patient">
                                    <path d="M291 406h-10v-10c0-5.523-4.477-10-10-10s-10 4.477-10 10v10h-10c-5.523 0-10 4.477-10 10s4.477 10 10 10h10v10c0 5.523 4.477 10 10 10s10-4.477 10-10v-10h10c5.523 0 10-4.477 10-10S296.523 406 291 406zM411 156c0-5.523-4.477-10-10-10s-10 4.477-10 10v10h-10c-5.523 0-10 4.477-10 10s4.477 10 10 10h10v10c0 5.523 4.477 10 10 10s10-4.477 10-10v-10h10c5.523 0 10-4.477 10-10s-4.477-10-10-10h-10V156z"></path>
                                    <path d="M501,56H321c-5.523,0-10,4.477-10,10s4.477,10,10,10h80v20h-60c-5.523,0-10,4.477-10,10v160c0,16.542,13.458,30,30,30
				c0,18.604,12.767,34.282,30,38.734V416h-40v-38.23c0-33.045-23.087-61.378-55-68.364V136c0-66.168-53.832-120-120-120
				S56,69.832,56,136v173.406c-31.863,6.977-55,35.266-55,68.364V486c0,5.523,4.477,10,10,10h330c5.523,0,10-4.477,10-10v-50h50
				c5.523,0,10-4.477,10-10v-91.266c17.233-4.452,30-20.13,30-38.734c16.542,0,30-13.458,30-30V106c0-5.523-4.477-10-10-10h-40V76
				h70v410c0,5.523,4.477,10,10,10s10-4.477,10-10V66C511,60.477,506.523,56,501,56z M240.179,321.173
				C235.236,352.101,208.108,376,176,376c-32.108,0-59.237-23.9-64.179-54.829c56.318-8.341,26.751-3.972,35.644-5.279
				c4.903-0.727,8.535-4.935,8.535-9.892v-32.531c6.395,1.652,13.096,2.531,20,2.531s13.605-0.88,20-2.531V306
				c0,4.957,3.631,9.166,8.535,9.892c5.133,0.76,9.941,1.473,14.44,2.139c5.187,0.768,12.138,1.797,21.204,3.14
				C240.179,321.172,240.179,321.172,240.179,321.173c-6.149-0.912-13.174-1.953-21.204-3.142
				C190.831,313.863,215.028,317.448,240.179,321.173z M176,256c-33.084,0-60-26.916-60-60v-60.904
				c15.758-1.953,48.36-7.993,78.346-26.138c8.1,8.126,23.479,21.292,41.654,25.643V196C236,229.084,209.084,256,176,256z M331,476
				H21v-98.23c0-24.596,18.347-45.862,42.675-49.468c10.991-1.628,20.356-3.015,28.353-4.199C98.327,364.846,133.491,396,176,396
				c42.479,0,77.67-31.126,83.971-71.895c17.635,2.612,26.678,3.951,0-0.001c0,0,0-0.001,0-0.001
				c8.292,1.228,17.694,2.621,28.353,4.199C312.653,331.908,331,353.174,331,377.77V476z M401,316c-11.028,0-20-8.972-20-20h40
				C421,307.028,412.028,316,401,316z M451,236H351V116h100V236z"></path>
                                    <path d="M166 166c0-5.523-4.477-10-10-10h-10c-5.523 0-10 4.477-10 10s4.477 10 10 10h10C161.523 176 166 171.523 166 166zM206 156h-10c-5.523 0-10 4.477-10 10s4.477 10 10 10h10c5.523 0 10-4.477 10-10S211.523 156 206 156zM197.145 200.542c-4.394-3.348-10.668-2.501-14.015 1.893-.108.142-2.693 3.47-6.933 3.563-4.382.124-7.211-3.416-7.337-3.577-3.352-4.384-9.623-5.224-14.01-1.875-4.391 3.351-5.234 9.626-1.883 14.016 5.173 6.78 14.07 11.649 23.669 11.431 12.915-.283 20.412-8.825 22.401-11.437C202.385 210.164 201.538 203.89 197.145 200.542z"></path>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">Patient</span>
                    </a>
                </div>






            </div>
            <!--end::Menu-->
        </div>
        <!--end::Aside Menu-->
    </div>

</div>