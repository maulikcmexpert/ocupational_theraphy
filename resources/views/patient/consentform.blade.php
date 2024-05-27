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
                                                <input class="form-control" type="text" name="answer">
                                            <?php } ?>
                                        </label>
                                    </div>

                                    <div>
                                        <?php if ($val->ques_type == 'check') {
                                        ?>
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
                            <div class="form-check">
                                <div>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        I give consent to the assessment and treatment provided by the occupational therapists associated with Grounded.Well.Wise Pty Ltd
                                    </label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>
                            <div class="form-check">
                                <div>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        I have read and understand the information sheet on the nature of <a href="">Occupational Therapy in Mental Health.</a> I understand what the therapy will ask of me, what I can expect, the benefits and the risks.
                                    </label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>
                            <div class="form-check">
                                <div>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        I have had sufficient opportunity to ask questions and to consider whether I want to proceed with the occupational therapy assessment and/or treatment.
                                    </label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>
                            <div class="form-check">
                                <div>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        I consent to students working under the occupational therapists associated with Grounded.Well.Wise Pty Ltd. to observe, participate and provide direct occupational therapy intervention.
                                    </label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="main-content-wrp">
                        <div class="main-content-title">
                            <h3>Withdrawal of Consent</h3>
                        </div>
                        <div class="main-content">
                            <div class="form-check">
                                <div>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        I know that I am, at any stage, free to withdraw my consent to undergo assessment and/or treatment, and/or research. I understand that if I do withdraw my consent, I must confirm that I have done so in writing to admin@groundedwellwise.co.za
                                    </label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>
                            <div class="form-check">
                                <div>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        If I withdraw consent to the occupational therapy assessment and/or treatment, the consequences include loss of potential improvement and poorer outcomes for mental health recovery.
                                        I will then not hold the therapist liable for any of those consequences, should they happen. I must still pay for the sessions of therapy I have had up to the date of withdrawing consent.
                                    </label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="main-content-wrp">
                        <div class="main-content-title">
                            <h3>Electronic Communiction:</h3>
                        </div>
                        <div class="main-content">
                            <div class="form-check">
                                <div>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        The occupational therapists and staff associated with Grounded.Well.Wise Pty Ltd. will reach out to me to remind me of my appointments or communicate changes to my appointments, to send me information about my treatment, progress, account, etc. We will not send you spam.
                                    </label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>
                            <div class="form-check">
                                <div>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        I consent to receiving phone calls, SMSs, WhatsApp messages and/or emails for the above purpose.
                                    </label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>
                            <div class="form-check">
                                <div>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        We would like to send you information about the interventions available at the occupational therapy practices associated with Grounded.Well.Wise Pty Ltd. Please check the channels below on how you wish to receive these updates
                                    </label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>
                            <div class="form-check">
                                <div>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        WhatsApp
                                    </label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>
                            <div class="form-check">
                                <div>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        E-mail
                                    </label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="main-content-wrp">
                        <div class="main-content-title">
                            <h3>Telehealth Appointments</h3>
                        </div>
                        <div class="main-content">
                            <div class="form-check">
                                <div>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        I agree that telehealth can be used as an alternative to a traditional in-person consultation. I confirm that telehealth means connecting via a a video call or phone call and agree that technical problems may interrupt or stop my visit before I am done. I understand that a telehealth visit will not cost any more than an office visit. I know I can stop using telehealth any time, even during a telehealth visit.
                                    </label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="main-content-wrp">
                        <div class="main-content-title">
                            <h3>Billing consent: </h3>
                        </div>
                        <div class="main-content">
                            <div class="form-check">
                                <div>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        I understand that there are costs related to the services provided by occupational therapists associated with Grounded.Well.Wise Pty Ltd. These costs are specified in the Grounded.Well.Wise Pty Ltd Terms and Conditions.
                                    </label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>
                            <div class="form-check">
                                <div>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        I understand that I (or my parent/guardian) remain liable for the account for services rendered by this practice, even if I am insured by a medical aid or other third party.
                                    </label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>
                            <div class="form-check">
                                <div>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        I accept that I am fully responsible for payment for services rendered and should I not pay timeously, understand that I will be liable for debt recovery costs on an attorney and own client scale.
                                    </label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>
                            <div class="form-check">
                                <div>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        I consent that Grounded.Well.Wise Pty Ltd can assist me in addressing the non-payment / short-payment and/or imposed co-payments by
                                    </label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>
                            <div class="form-check">
                                <div>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        my medical scheme, which includes lodging a complaint with the Council for Medical Schemes if it is so requires.
                                    </label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>
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
                            <div class="form-check">
                                <div>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        I understand that the occuptional therapists and staff associated with Grounded.Well.Wise Pty Ltd will always act so as to protect my privacy even if I do consent to share personal information. I may direct the occupational therapist to share information with whomever I choose, and I can change your mind and revoke that permission at any time
                                    </label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>
                            <div class="form-check">
                                <div>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        I understand that Grounded.Well.Wise Pty Ltd. will collect information about me and my health, in order to provide healthcare services. If I do not disclose all relevant information, or do not disclose full information, I understand that it may have a negative impact on my health and healthcare services to be provided.
                                    </label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>
                            <div class="form-check">
                                <div>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        The occuptional therapists and staff associated with Grounded.Well.Wise Pty Ltd will use my information for the purposes of providing treatment and care, to bill me for the costs of such treatment, to do healthcare and or financial follow-ups.
                                    </label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>
                            <div class="form-check">
                                <div>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        I understand that my personal information may be disclosed by the practice in response to a specific request by a law enforcement agency, subpoena, court order, or as required by law.
                                    </label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>
                            <div class="form-check">
                                <div>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        If my information is to be used for any other purpose, I will be asked to consent to such use separately.
                                    </label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>
                            <div class="form-check">
                                <div>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        <strong>Research:</strong> I agree that the results of the assessment and/or treatment may be anonymously used for purposes of research and/or data-collection purposes, provided that such information is de-identified with sufficient safeguards.
                                    </label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>
                            <div class="form-check">
                                <div>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        <strong>Emergency:</strong> If there is an emergency during a therapy session or after termination in which the therapist becomes concerned about my personal safety, the possibility of me injuring someone else, or about me requiring psychiatric care, the therapist will contact the person whose name I have provided during my intake as my next of kin.
                                    </label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>
                            <div class="form-check">
                                <div>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Sharing of health information: I agree that information relating to my health status and treatment can be disclosed to
                                    </label>
                                </div>
                                <div>

                                </div>
                            </div>
                            <div class="form-check">
                                <div>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        My treating team, namely: ______________________
                                    </label>
                                </div>
                                <div>

                                </div>
                            </div>
                            <div class="form-check">
                                <div>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Family members, namely: ______________________
                                    </label>
                                </div>
                                <div>

                                </div>
                            </div>
                            <div class="form-check">
                                <div>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        I give permission that the occupational therapists associated with Grounded.Well.Wise Pty Ltd. share appropriate information with my medical scheme for billing and/or review purposes.
                                    </label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>
                            <div class="form-check">
                                <div>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        <strong>Obtaining of health information:</strong> I agree that, where it is in my best interest, the occupational therapists and staff associated with Grounded.Well.Wise Pty Ltd. can obtain information and/or records from any other healthcare professional simultaneously involved in my care.
                                    </label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>
                            <div class="form-check">
                                <div>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        My treating team, namely: ______________________
                                    </label>
                                </div>
                                <div>

                                </div>
                            </div>
                            <div class="form-check">
                                <div>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Family members, namely: ______________________
                                    </label>
                                </div>
                                <div>

                                </div>
                            </div>
                            <div class="form-check">
                                <div>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        <strong>Minors:</strong> If you are a minor, your parents may be legally entitled to some information about your therapy. Your therapist will discuss with you what information is appropriate for them to receive and which issues are more appropriately kept confidential.
                                    </label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>
                            <div class="form-check">
                                <div>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        <strong>Confidentiality Of E-Mail, Voice Mail And Text Communication:</strong> I understand that while the occupational therapists and staff associated with Grounded.Well.Wise Pty Ltd. do their best to protect my confidentiality and security of the services used, e-mail, voice mail, and text communication may be accessed by unauthorized people, compromising the privacy and confidentiality of such communication.
                                    </label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>
                            <div class="form-check">
                                <div>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        <strong>Right to withdraw:</strong> I have the right to withdraw any consent given or refused at any future visit. Should this occur, I will inform the occupational therapist or staff associated with Grounded.Well.Wise Pty Ltd. of this decision by email admin@groundedwellwise.co.za and sign another consent form, indicating your amended decision.
                                    </label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>