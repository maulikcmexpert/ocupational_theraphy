<div class="container">
    <div class="form-main">
        <form method="POST" action="{{route('patient.consentFormStore',$patient_id)}}" class="form-wrpper">
            @csrf
            <h3>General Consent Form for GWW APP</h3>
            <p>Your consent is a crucial component of the therapeutic process, and it is rooted in respect for your autonomy and your right to make decisions about your private information and your healthcare. </p>
            <p>For the full Terms and Conditions of the Grounded.Well.Wise Pvt Ltd and its <a href="">associated occupational therapy practices</a> please <a href="#">click here.</a></p>

            <div class="row">
                <div class="col-12 mb-3">
                    <div class="main-content-wrp">
                        <div class="main-content-title">
                            <h3>Identification of person giving consent</h3>
                        </div>
                        <div class="main-content">

                            <?php
                            foreach ($question as $key => $val) {

                                if ($key == 5) {
                                    break;
                                }
                            ?>
                                <div class="form-check">
                                    <div>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{$val->question}}

                                            <?php if ($val->ques_type == 'text') { ?>
                                                <input class="form-control" type="hidden" name="ques_ans[question][]" value="{{ $val->id}}">
                                                <input class="form-control" type="text" name="ques_ans[answer][]" value="">
                                            <?php } ?>
                                        </label>
                                    </div>

                                    <div>
                                        <?php if ($val->ques_type == 'check') {
                                        ?>
                                            <input class="form-control" type="hidden" name="ques_ans[question][]" value="{{ $val->id}}">
                                            <input class="form-check-input" name="ques_ans[answer][]" type="checkbox" id="flexCheckDefault">
                                        <?php }
                                        ?>
                                    </div>
                                </div>

                            <?php  } ?>

                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="main-content-wrp">
                        <div class="main-content-title">
                            <h3>Informed Consent: Assessment And Treatment</h3>
                        </div>
                        <div class="main-content">
                            <?php
                            foreach ($question as $key => $val) {

                                if ($key >= 5 && $key <= 8) {



                            ?>
                                    <div class="form-check">
                                        <div>
                                            <label class="form-check-label" for="flexCheckDefault">
                                                {{ $val->question}}
                                                <?php if ($val->ques_type == 'text') { ?>
                                                    <input class="form-control" type="hidden" name="question_id[]" value="{{ $val->id}}">
                                                    <input class="form-control" type="text" name="answer[]">
                                                <?php } ?>
                                            </label>
                                        </div>
                                        <div>
                                            <?php if ($val->ques_type == 'check') {
                                            ?>
                                                <input class="form-control" type="hidden" name="question_id[]" value="{{ $val->id}}">
                                                <input class="form-check-input" name="answer[]" type="checkbox" value="1" id="flexCheckDefault">
                                            <?php }
                                            ?>

                                        </div>
                                    </div>

                            <?php  }
                            } ?>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="main-content-wrp">
                        <div class="main-content-title">
                            <h3>Withdrawal of Consent</h3>
                        </div>
                        <div class="main-content">
                            <?php
                            foreach ($question as $key => $val) {

                                if ($key >= 9 && $key <= 10) {



                            ?>
                                    <div class="form-check">
                                        <div>
                                            <label class="form-check-label" for="flexCheckDefault">
                                                {{$val->question}}
                                                <?php if ($val->ques_type == 'text') { ?>
                                                    <input class="form-control" type="hidden" name="question_id[]" value="{{ $val->id}}">
                                                    <input class="form-control" type="text" name="answer[]">
                                                <?php } ?>
                                            </label>
                                        </div>
                                        <div>
                                            <?php if ($val->ques_type == 'check') {
                                            ?>
                                                <input class="form-control" type="hidden" name="question_id[]" value="{{ $val->id}}">
                                                <input class="form-check-input" name="answer[]" type="checkbox" value="1" id="flexCheckDefault">
                                            <?php }
                                            ?>
                                        </div>
                                    </div>

                            <?php }
                            } ?>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="main-content-wrp">
                        <div class="main-content-title">
                            <h3>Electronic Communiction:</h3>
                        </div>
                        <div class="main-content">
                            <?php
                            foreach ($question as $key => $val) {

                                if ($key >= 11 && $key <= 15) {



                            ?>
                                    <div class="form-check">
                                        <div>
                                            <label class="form-check-label" for="flexCheckDefault">
                                                {{$val->question}}
                                                <?php if ($val->ques_type == 'text') { ?>
                                                    <input class="form-control" type="hidden" name="question_id[]" value="{{ $val->id}}">
                                                    <input class="form-control" type="text" name="answer[]">
                                                <?php } ?>
                                            </label>
                                        </div>
                                        <div>
                                            <?php if ($val->ques_type == 'check') {
                                            ?>
                                                <input class="form-control" type="hidden" name="question_id[]" value="{{ $val->id}}">
                                                <input class="form-check-input" name="answer[]" type="checkbox" value="1" id="flexCheckDefault">
                                            <?php }
                                            ?>
                                        </div>
                                    </div>

                            <?php }
                            } ?>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="main-content-wrp">
                        <div class="main-content-title">
                            <h3>Telehealth Appointments</h3>
                        </div>
                        <div class="main-content">
                            <?php
                            foreach ($question as $key => $val) {

                                if ($key == 16) {



                            ?>

                                    <div class="form-check">
                                        <div>
                                            <label class="form-check-label" for="flexCheckDefault">
                                                {{ $val->question}}
                                                <?php if ($val->ques_type == 'text') { ?>
                                                    <input class="form-control" type="hidden" name="question_id[]" value="{{ $val->id}}">
                                                    <input class="form-control" type="text" name="answer[]">
                                                <?php } ?>
                                            </label>
                                        </div>
                                        <div>
                                            <?php if ($val->ques_type == 'check') {
                                            ?>
                                                <input class="form-control" type="hidden" name="question_id[]" value="{{ $val->id}}">
                                                <input class="form-check-input" name="answer[]" type="checkbox" value="1" id="flexCheckDefault">
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                            <? }
                            } ?>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="main-content-wrp">
                        <div class="main-content-title">
                            <h3>Billing consent: </h3>
                        </div>
                        <div class="main-content">
                            <?php
                            foreach ($question as $key => $val) {
                                if ($key >= 17 && $key <= 21) {
                            ?>
                                    <div class="form-check">
                                        <div>
                                            <label class="form-check-label" for="flexCheckDefault">
                                                {{$val->question}}
                                                <?php if ($val->ques_type == 'text') { ?>
                                                    <input class="form-control" type="hidden" name="question_id[]" value="{{ $val->id}}">
                                                    <input class="form-control" type="text" name="answer[]">
                                                <?php } ?>
                                            </label>
                                        </div>
                                        <div>
                                            <?php if ($val->ques_type == 'check') {
                                            ?>
                                                <input class="form-control" type="hidden" name="question_id[]" value="{{ $val->id}}">
                                                <input class="form-check-input" name="answer[]" type="checkbox" value="1" id="flexCheckDefault">
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                            <? }
                            } ?>
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
                            <?php
                            foreach ($question as $key => $val) {
                                if ($key >= 22) {
                            ?>

                                    <div class="form-check">
                                        <div>
                                            <label class="form-check-label" for="flexCheckDefault">
                                                {{$val->question}}
                                                <?php if ($val->ques_type == 'text') { ?>
                                                    <input class="form-control" type="hidden" name="question_id[]" value="{{ $val->id}}">
                                                    <input class="form-control" type="text" name="answer[]">
                                                <?php } ?>
                                            </label>
                                        </div>
                                        <div>
                                            <?php if ($val->ques_type == 'check') {
                                            ?>
                                                <input class="form-control" type="hidden" name="question_id[]" value="{{ $val->id}}">
                                                <input class="form-check-input" name="answer[]" type="checkbox" value="1" id="flexCheckDefault">
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <?php if ($val->ques_type == 'text_two') {
                                    ?>
                                        <input class="form-control" type="hidden" name="question_id[]" value="{{ $val->id}}">
                                        <div class="form-check">
                                            <div>
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    My treating team, namely: <input class="form-control" type="text" name="answer_{{ $val->id}}_1">
                                                </label>
                                            </div>
                                            <div>

                                            </div>
                                        </div>
                                        <div class="form-check">
                                            <div>
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Family members, namely: <input class="form-control" type="text" name="answer_{{ $val->id}}_2">
                                                </label>
                                            </div>
                                            <div>

                                            </div>
                                        </div>
                                    <?php }
                                    ?>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <input class="btn btn-primary" type="submit" value="Submit">
        </form>
    </div>
</div>