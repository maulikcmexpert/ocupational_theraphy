<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="1width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('public/assets/css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/css/common.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/css/consent.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>General Consent Form for GWW APP</title>
</head>

<body>

    <div class="container">
        <div class="form-main">

            <form method="POST" id="consentForm" action="{{ route('patient.consentFormStore', $patient_id) }}" class="form-wrpper">
                @csrf
                <div class="form-logo-title">
                    <span><img alt="Logo" src="{{asset('assets/logo.png')}}" class="h-100px logo"></span>
                    <h3>General Consent Form for GWW APP</h3>
                </div>

                <p>Your consent is a crucial component of the therapeutic process, and it is rooted in respect for your autonomy and your right to make decisions about your private information and your healthcare.</p>
                <p>For the full Terms and Conditions of the Grounded.Well.Wise Pvt Ltd and its <a href="">associated occupational therapy practices</a> please <a href="{{ route('terms_and_condition')}}">click here.</a></p>
                <!-- <label id="questions[0][answer]-error" class="error" for="questions[0][answer]"></label> -->
                <label class="error consentFormError"></label>
                <div class="row">
                    <div class="col-12 mb-3">
                        <div class="main-content-wrp">
                            <div class="main-content-title">
                                <h3>Identification of person giving consent</h3>
                            </div>
                            <div class="main-content">
                                @foreach ($question as $key => $val)
                                @if ($key == 5)
                                @break
                                @endif
                                <div class="form-check">
                                    <div class="text-type-input">
                                        <label class="form-check-label " for="flexCheckDefault_{{ $val->id }}">
                                            <span>{{ $val->question }}</span>
                                            @if ($val->ques_type == 'text')
                                            <span>
                                                <input type="hidden" name="questions[{{ $key }}][question]" value="{{ $val->id }}">
                                                <input class="form-control " type="text" name="questions[{{ $key }}][answer]" value="{{(count($consentAnswers) !=0 && $consentAnswers[$key]->answer !=null)?$consentAnswers[$key]->answer:''}}" <?= (count($consentAnswers) != 0) ? 'disabled' : '' ?>>
                                            </span>
                                            @endif
                                        </label>

                                    </div>
                                    <div>
                                        <?php
                                        $checkbox = "";
                                        $disabled = "";
                                        if ($val->ques_type == 'check') {



                                            if (count($consentAnswers) != 0) {

                                                $disabled = "disabled";
                                                if ($consentAnswers[$key]->answer == '1') {

                                                    $checkbox = "checked";
                                                }
                                            }
                                        ?>
                                            <input type="hidden" name="questions[{{ $key }}][question]" value="{{ $val->id }}">
                                            <input type="hidden" name="questions[{{ $key }}][answer]" value="0">
                                            <input class="form-check-input checkboxAns" name="questions[{{ $key }}][answer]" type="checkbox" value="1" id="flexCheckDefault_{{ $val->id }}" {{$checkbox.' '.$disabled}}>
                                        <?php } ?>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <div class="main-content-wrp">
                            <div class="main-content-title">
                                <h3>Informed Consent: Assessment And Treatment</h3>
                            </div>
                            <div class="main-content">
                                @foreach ($question as $key => $val)
                                @if ($key >= 5 && $key <= 8) <div class="form-check">
                                    <div>
                                        <label class="form-check-label" for="flexCheckDefault_{{ $val->id }}">
                                            {!! $val->question !!}
                                            @if ($val->ques_type == 'text')
                                            <input type="hidden" name="questions[{{ $key }}][question]" value="{{ $val->id }}">
                                            <input class="form-control" type="text" name="questions[{{ $key }}][answer]" value="{{(count($consentAnswers) !=0 && $consentAnswers[$key]->answer !=null)?$consentAnswers[$key]->answer:''}}" <?= (count($consentAnswers) != 0) ? 'disabled' : '' ?>>
                                            @endif
                                        </label>
                                    </div>
                                    <div>
                                        <?php

                                        $checkbox = "";
                                        $disabled = "";
                                        if ($val->ques_type == 'check') {



                                            if (count($consentAnswers) != 0) {

                                                $disabled = "disabled";
                                                if ($consentAnswers[$key]->answer == '1') {

                                                    $checkbox = "checked";
                                                }
                                            }



                                        ?>
                                            <input type="hidden" name="questions[{{ $key }}][question]" value="{{ $val->id }}">
                                            <input type="hidden" name="questions[{{ $key }}][answer]" value="0">
                                            <input class="form-check-input checkboxAns" name="questions[{{ $key }}][answer]" type="checkbox" value="1" id="flexCheckDefault_{{ $val->id }}" {{$checkbox.' '.$disabled}}>
                                        <?php } ?>
                                    </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="main-content-wrp">
                        <div class="main-content-title">
                            <h3>Withdrawal of Consent</h3>
                        </div>
                        <div class="main-content">
                            @foreach ($question as $key => $val)
                            @if ($key >= 9 && $key <= 10) <div class="form-check">
                                <div>
                                    <label class="form-check-label" for="flexCheckDefault_{{ $val->id }}">
                                        {!! $val->question !!}
                                        @if ($val->ques_type == 'text')
                                        <input type="hidden" name="questions[{{ $key }}][question]" value="{{ $val->id }}">
                                        <input class="form-control" type="text" name="questions[{{ $key }}][answer]" value="{{(count($consentAnswers) !=0 && $consentAnswers[$key]->answer !=null)?$consentAnswers[$key]->answer:''}}" <?= (count($consentAnswers) != 0) ? 'disabled' : '' ?>>
                                        @endif
                                    </label>
                                </div>
                                <div>
                                    <?php
                                    $checkbox = "";
                                    $disabled = "";
                                    if ($val->ques_type == 'check') {



                                        if (count($consentAnswers) != 0) {

                                            $disabled = "disabled";
                                            if ($consentAnswers[$key]->answer == '1') {

                                                $checkbox = "checked";
                                            }
                                        }
                                    ?>

                                        <input type="hidden" name="questions[{{ $key }}][question]" value="{{ $val->id }}">
                                        <input type="hidden" name="questions[{{ $key }}][answer]" value="0">
                                        <input class="form-check-input checkboxAns" name="questions[{{ $key }}][answer]" type="checkbox" value="1" id="flexCheckDefault_{{ $val->id }}" {{$checkbox.' '.$disabled}}>
                                    <?php } ?>
                                </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
        </div>
        <div class="col-12 mb-3">
            <div class="main-content-wrp">
                <div class="main-content-title">
                    <h3>Electronic Communication:</h3>
                </div>
                <div class="main-content">
                    @foreach ($question as $key => $val)
                    @if ($key >= 11 && $key <= 15) <div class="form-check">
                        <div>
                            <label class="form-check-label" for="flexCheckDefault_{{ $val->id }}">
                                {!! $val->question !!}
                                @if ($val->ques_type == 'text')
                                <input type="hidden" name="questions[{{ $key }}][question]" value="{{ $val->id }}">
                                <input class="form-control" type="text" name="questions[{{ $key }}][answer]" value="{{(count($consentAnswers) !=0 && $consentAnswers[$key]->answer !=null)?$consentAnswers[$key]->answer:''}}" <?= (count($consentAnswers) != 0) ? 'disabled' : '' ?>>
                                @endif
                            </label>
                        </div>
                        <div>
                            <?php
                            $checkbox = "";
                            $disabled = "";
                            if ($val->ques_type == 'check') {



                                if (count($consentAnswers) != 0) {

                                    $disabled = "disabled";
                                    if ($consentAnswers[$key]->answer == '1') {

                                        $checkbox = "checked";
                                    }
                                }
                            ?>
                                <input type="hidden" name="questions[{{ $key }}][question]" value="{{ $val->id }}">
                                <input type="hidden" name="questions[{{ $key }}][answer]" value="0">
                                <input class="form-check-input checkboxAns" name="questions[{{ $key }}][answer]" type="checkbox" value="1" id="flexCheckDefault_{{ $val->id }}" {{$checkbox.' '.$disabled}}>
                            <?php } ?>
                        </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-12 mb-3">
        <div class="main-content-wrp">
            <div class="main-content-title">
                <h3>Telehealth Appointments</h3>
            </div>
            <div class="main-content">
                @foreach ($question as $key => $val)
                @if ($key == 16)
                <div class="form-check">
                    <div>
                        <label class="form-check-label" for="flexCheckDefault_{{ $val->id }}">
                            {!! $val->question !!}
                            @if ($val->ques_type == 'text')
                            <input type="hidden" name="questions[{{ $key }}][question]" value="{{ $val->id }}">
                            <input class="form-control" type="text" name="questions[{{ $key }}][answer]" value="{{(count($consentAnswers) !=0 && $consentAnswers[$key]->answer !=null)?$consentAnswers[$key]->answer:''}}" <?= (count($consentAnswers) != 0) ? 'disabled' : '' ?>>
                            @endif
                        </label>
                    </div>
                    <div>
                        <?php
                        $checkbox = "";
                        $disabled = "";
                        if ($val->ques_type == 'check') {



                            if (count($consentAnswers) != 0) {

                                $disabled = "disabled";
                                if ($consentAnswers[$key]->answer == '1') {

                                    $checkbox = "checked";
                                }
                            }
                        ?>
                            <input type="hidden" name="questions[{{ $key }}][question]" value="{{ $val->id }}">
                            <input type="hidden" name="questions[{{ $key }}][answer]" value="0">
                            <input class="form-check-input checkboxAns" name="questions[{{ $key }}][answer]" type="checkbox" value="1" id="flexCheckDefault_{{ $val->id }}" {{ $checkbox}}>
                        <?php } ?>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-12 mb-3">
        <div class="main-content-wrp">
            <div class="main-content-title">
                <h3>Billing consent:</h3>
            </div>
            <div class="main-content">
                @foreach ($question as $key => $val)
                @if ($key >= 17 && $key <= 21) <div class="form-check">
                    <div>
                        <label class="form-check-label" for="flexCheckDefault_{{ $val->id }}">
                            {!! $val->question !!}
                            @if ($val->ques_type == 'text')
                            <input type="hidden" name="questions[{{ $key }}][question]" value="{{ $val->id }}">
                            <input class="form-control" type="text" name="questions[{{ $key }}][answer]" value="{{(count($consentAnswers) !=0 && $consentAnswers[$key]->answer !=null)?$consentAnswers[$key]->answer:''}}" <?= (count($consentAnswers) != 0) ? 'disabled' : '' ?>>
                            @endif
                        </label>
                    </div>
                    <div>
                        <?php
                        $checkbox = "";
                        $disabled = "";
                        if ($val->ques_type == 'check') {



                            if (count($consentAnswers) != 0) {

                                $disabled = "disabled";
                                if ($consentAnswers[$key]->answer == '1') {

                                    $checkbox = "checked";
                                }
                            }
                        ?>
                            <input type="hidden" name="questions[{{ $key }}][question]" value="{{ $val->id }}">
                            <input type="hidden" name="questions[{{ $key }}][answer]" value="0">
                            <input class="form-check-input checkboxAns" name="questions[{{ $key }}][answer]" type="checkbox" value="1" id="flexCheckDefault_{{ $val->id }}" {{$checkbox.' '.$disabled}}>
                        <?php } ?>
                    </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
    </div>
    <div class="col-12 mb-3">
        <div class="main-content-wrp">
            <div class="main-content-title">
                <h3>PROTECTION OF PERSONAL INFORMATION AT THIS PRACTICE</h3>
                <h5>(POPI and PAIA manuals are available at www.groundedwellwise.co.za)</h5>
            </div>
            <div class="main-content">
                @foreach ($question as $key => $val)
                @if ($key >= 22)
                <div class="form-check ">
                    <div>
                        <label class="form-check-label" for="flexCheckDefault_{{ $val->id }}">
                            {!! $val->question !!}
                            @if ($val->ques_type == 'text')
                            <input type="hidden" name="questions[{{ $key }}][question]" value="{{ $val->id }}">
                            <input class="form-control" type="text" name="questions[{{ $key }}][answer]" value="{{(count($consentAnswers) !=0 && $consentAnswers[$key]->answer !=null)?$consentAnswers[$key]->answer:''}}" <?= (count($consentAnswers) != 0) ? 'disabled' : '' ?>>
                            @endif
                        </label>
                    </div>
                    <div>
                        <?php
                        $checkbox = "";
                        $disabled = "";
                        if ($val->ques_type == 'check') {



                            if (count($consentAnswers) != 0) {

                                $disabled = "disabled";
                                if ($consentAnswers[$key]->answer == '1') {

                                    $checkbox = "checked";
                                }
                            }
                        ?>
                            <input type="hidden" name="questions[{{ $key }}][question]" value="{{ $val->id }}">
                            <input type="hidden" name="questions[{{ $key }}][answer]" value="0">
                            <input class="form-check-input checkboxAns" name="questions[{{ $key }}][answer]" type="checkbox" value="1" id="flexCheckDefault_{{ $val->id }}" {{$checkbox.' '.$disabled}}>
                        <?php } ?>
                    </div>
                </div>
                @if ($val->ques_type == 'text_two')
                <input type="hidden" name="questions[{{ $key }}][question]" value="{{ $val->id }}">
                <?php
                if (count($consentAnswers) != 0) {


                    $explodeAns = json_decode($consentAnswers[$key]->answer);
                }
                ?>

                <div class="form-check text-type-input">
                    <div>
                        <label class="form-check-label" for="flexCheckDefault_{{ $val->id }}">
                            <!-- {{(count($consentAnswers) != 0) ? 'disabled' : ''}}  -->
                            <span>My treating team, namely:</span> <span><input class="form-control" type="text" name="questions[{{ $key }}][answer][]" value="{{(count($consentAnswers) != 0 && $explodeAns[0] != null)?$explodeAns[0]:''}}" <?= (count($consentAnswers) != 0) ? 'disabled' : '' ?>></span>
                        </label>
                    </div>
                    <div></div>
                </div>
                <div class="form-check text-type-input">
                    <div>
                        <label class="form-check-label" for="flexCheckDefault_{{ $val->id }}">
                            <span>Family members, namely:</span> <span><input class="form-control" type="text" name="questions[{{ $key }}][answer][]" value="{{(count($consentAnswers) != 0 && $explodeAns[1] != null)?$explodeAns[1]:''}}" <?= (count($consentAnswers) != 0) ? 'disabled' : '' ?>></span>
                        </label>
                    </div>
                    <div></div>
                </div>
                @endif
                @endif
                @endforeach
            </div>
        </div>
    </div>
    </div>
    @if(count($consentAnswers) == 0)
    <label class="error consentFormError"></label>
    <div class="text-center footer-form-btn">
        <input type="submit" class="btn btn-primary" value="Submit">

    </div>
    @endif
    </form>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js" integrity="sha512-6S5LYNn3ZJCIm0f9L6BCerqFlQ4f5MwNKq+EthDXabtaJvg3TuFLhpno9pcm+5Ynm6jdA9xfpQoMz2fcjVMk9g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('public/assets/admin/js/consentform.js')}}"></script>
    <script>
        $(document).ready(function() {
            $("#consentForm").on("submit", function(event) {
                var checkedValues = [];
                var uncheckedValues = [];
                var i = 0;
                @foreach($question as $key => $val)
                @if($val->ques_type == 'check')
                i++;
                $('input[name="questions[{{ $key }}][answer]"]:checked').each(function() {
                    checkedValues.push($(this).val());
                });
                $('input[name="questions[{{ $key }}][answer]"]:not(:checked)').each(function() {
                    uncheckedValues.push($(this).val());
                    $(this).css("outline", "2px solid red");
                });
                @endif
                @endforeach
                if (checkedValues.length >= i) {
                    alert('Checked values: ' + checkedValues.join(', '));
                } else {
                    alert('No checkboxes are checked');
                }
                event.preventDefault();
            });

            $('input[type="checkbox"]').on("change", function () {
                if ($(this).is(":checked")) {
                    $(this).css("outline", "");
                }
            });
        });
    </script>
</body>


</html>