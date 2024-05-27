<div class="container">
    <div class="form-main">
        <form action="" class="form-wrpper">
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
                                                <input class="form-control" type="hidden" name="question_id" value="{{ $val->id}}">
                                                <input class="form-control" type="text" name="answer">
                                            <?php } ?>
                                        </label>
                                    </div>

                                    <div>
                                        <?php if ($val->ques_type == 'check') {
                                        ?>
                                            <input class="form-control" type="hidden" name="question_id" value="{{ $val->id}}">
                                            <input class="form-check-input" name="answer" type="checkbox" value="1" id="flexCheckDefault">
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
                                                    <input class="form-control" type="hidden" name="question_id" value="{{ $val->id}}">
                                                    <input class="form-control" type="text" name="answer">
                                                <?php } ?>
                                            </label>
                                        </div>
                                        <div>
                                            <?php if ($val->ques_type == 'check') {
                                            ?>
                                                <input class="form-control" type="hidden" name="question_id" value="{{ $val->id}}">
                                                <input class="form-check-input" name="answer" type="checkbox" value="1" id="flexCheckDefault">
                                            <?php }
                                            ?>

                                        </div>
                                    </div>

                            <?php  }
                            } ?>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>