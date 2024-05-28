<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="1width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('public/assets/css/consent.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>General Consent Form for GWW APP</title>
</head>

<body>
    @if(count($consentAnswers) == 0)
    <div class="container">
        <div class="form-main">
            <form method="POST" id="consentForm" action="{{ route('patient.consentFormStore', $patient_id) }}" class="form-wrpper">
                @csrf
                <h3>General Consent Form for GWW APP</h3>
                <p>Your consent is a crucial component of the therapeutic process, and it is rooted in respect for your autonomy and your right to make decisions about your private information and your healthcare.</p>
                <p>For the full Terms and Conditions of the Grounded.Well.Wise Pvt Ltd and its <a href="">associated occupational therapy practices</a> please <a href="#">click here.</a></p>

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
                                    <div>
                                        <label class="form-check-label" for="flexCheckDefault_{{ $val->id }}">
                                            {{ $val->question }}
                                            @if ($val->ques_type == 'text')
                                            <input type="hidden" name="questions[{{ $key }}][question]" value="{{ $val->id }}">
                                            <input class="form-control" type="text" name="questions[{{ $key }}][answer]">
                                            @endif
                                        </label>
                                    </div>
                                    <div>
                                        @if ($val->ques_type == 'check')
                                        <input type="hidden" name="questions[{{ $key }}][question]" value="{{ $val->id }}">
                                        <input type="hidden" name="questions[{{ $key }}][answer]" value="0">
                                        <input class="form-check-input" name="questions[{{ $key }}][answer]" type="checkbox" value="1" id="flexCheckDefault_{{ $val->id }}">
                                        @endif
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
                                            {{ $val->question }}
                                            @if ($val->ques_type == 'text')
                                            <input type="hidden" name="questions[{{ $key }}][question]" value="{{ $val->id }}">
                                            <input class="form-control" type="text" name="questions[{{ $key }}][answer]">
                                            @endif
                                        </label>
                                    </div>
                                    <div>
                                        @if ($val->ques_type == 'check')
                                        <input type="hidden" name="questions[{{ $key }}][question]" value="{{ $val->id }}">
                                        <input type="hidden" name="questions[{{ $key }}][answer]" value="0">
                                        <input class="form-check-input" name="questions[{{ $key }}][answer]" type="checkbox" value="1" id="flexCheckDefault_{{ $val->id }}">
                                        @endif
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
                                        {{ $val->question }}
                                        @if ($val->ques_type == 'text')
                                        <input type="hidden" name="questions[{{ $key }}][question]" value="{{ $val->id }}">
                                        <input class="form-control" type="text" name="questions[{{ $key }}][answer]">
                                        @endif
                                    </label>
                                </div>
                                <div>
                                    @if ($val->ques_type == 'check')
                                    <input type="hidden" name="questions[{{ $key }}][question]" value="{{ $val->id }}">
                                    <input type="hidden" name="questions[{{ $key }}][answer]" value="0">
                                    <input class="form-check-input" name="questions[{{ $key }}][answer]" type="checkbox" value="1" id="flexCheckDefault_{{ $val->id }}">
                                    @endif
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
                                {{ $val->question }}
                                @if ($val->ques_type == 'text')
                                <input type="hidden" name="questions[{{ $key }}][question]" value="{{ $val->id }}">
                                <input class="form-control" type="text" name="questions[{{ $key }}][answer]">
                                @endif
                            </label>
                        </div>
                        <div>
                            @if ($val->ques_type == 'check')
                            <input type="hidden" name="questions[{{ $key }}][question]" value="{{ $val->id }}">
                            <input type="hidden" name="questions[{{ $key }}][answer]" value="0">
                            <input class="form-check-input" name="questions[{{ $key }}][answer]" type="checkbox" value="1" id="flexCheckDefault_{{ $val->id }}">
                            @endif
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
                            {{ $val->question }}
                            @if ($val->ques_type == 'text')
                            <input type="hidden" name="questions[{{ $key }}][question]" value="{{ $val->id }}">
                            <input class="form-control" type="text" name="questions[{{ $key }}][answer]">
                            @endif
                        </label>
                    </div>
                    <div>
                        @if ($val->ques_type == 'check')
                        <input type="hidden" name="questions[{{ $key }}][question]" value="{{ $val->id }}">
                        <input type="hidden" name="questions[{{ $key }}][answer]" value="0">
                        <input class="form-check-input" name="questions[{{ $key }}][answer]" type="checkbox" value="1" id="flexCheckDefault_{{ $val->id }}">
                        @endif
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
                            {{ $val->question }}
                            @if ($val->ques_type == 'text')
                            <input type="hidden" name="questions[{{ $key }}][question]" value="{{ $val->id }}">
                            <input class="form-control" type="text" name="questions[{{ $key }}][answer]">
                            @endif
                        </label>
                    </div>
                    <div>
                        @if ($val->ques_type == 'check')
                        <input type="hidden" name="questions[{{ $key }}][question]" value="{{ $val->id }}">
                        <input type="hidden" name="questions[{{ $key }}][answer]" value="0">
                        <input class="form-check-input" name="questions[{{ $key }}][answer]" type="checkbox" value="1" id="flexCheckDefault_{{ $val->id }}">
                        @endif
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
                <div class="form-check">
                    <div>
                        <label class="form-check-label" for="flexCheckDefault_{{ $val->id }}">
                            {{ $val->question }}
                            @if ($val->ques_type == 'text')
                            <input type="hidden" name="questions[{{ $key }}][question]" value="{{ $val->id }}">
                            <input class="form-control" type="text" name="questions[{{ $key }}][answer]">
                            @endif
                        </label>
                    </div>
                    <div>
                        @if ($val->ques_type == 'check')
                        <input type="hidden" name="questions[{{ $key }}][question]" value="{{ $val->id }}">
                        <input type="hidden" name="questions[{{ $key }}][answer]" value="0">
                        <input class="form-check-input" name="questions[{{ $key }}][answer]" type="checkbox" value="1" id="flexCheckDefault_{{ $val->id }}">
                        @endif
                    </div>
                </div>
                @if ($val->ques_type == 'text_two')
                <input type="hidden" name="questions[{{ $key }}][question]" value="{{ $val->id }}">
                <div class="form-check">
                    <div>
                        <label class="form-check-label" for="flexCheckDefault_{{ $val->id }}">
                            My treating team, namely: <input class="form-control" type="text" name="questions[{{ $key }}][answer][]">
                        </label>
                    </div>
                    <div></div>
                </div>
                <div class="form-check">
                    <div>
                        <label class="form-check-label" for="flexCheckDefault_{{ $val->id }}">
                            Family members, namely: <input class="form-control" type="text" name="questions[{{ $key }}][answer][]">
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
    <input type="submit" class="btn btn-primary" value="Send">

    </form>
    </div>
    </div>

    @else

    <div class="container">
        <div class="consent-form-answers">
            @foreach ($consentAnswers as $answer)
            <div class="consent-answer">
                <strong>Question:</strong> {{ $answer->question->question }}
                <br>
                <strong>Answer:</strong>
                @if(is_array($answer->answer))
                <ul>
                    @foreach($answer->answer as $item)
                    <li>{{ $item }}</li>
                    @endforeach
                </ul>
                @else
                {{ $answer->answer }}
                @endif
            </div>
            <hr>
            @endforeach
        </div>

        @endif
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js" integrity="sha512-6S5LYNn3ZJCIm0f9L6BCerqFlQ4f5MwNKq+EthDXabtaJvg3TuFLhpno9pcm+5Ynm6jdA9xfpQoMz2fcjVMk9g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="{{asset('public/assets/admin/js/consentform.js')}}"></script>

</body>


</html>