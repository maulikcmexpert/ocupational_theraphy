<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConsentQuestion extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'question' => 'I am the patient/client',
                'ques_type' => 'check',

            ],
            [
                'question' => 'I am authorized to provide consent to treatment on behalf of the patient / client, who is unable to give consent. (The patient is under 12 years of age).',
                'ques_type' => 'check',
            ],
            [
                'question' => 'I am authorized to provide consent to treatment on behalf of the patient / client, who is unable to give consent. (The patient is incapacitated /unconscious/mentally unfit to provide consent).',
                'ques_type' => 'check',
            ],
            [
                'question' => 'Relationship to patient / client (e.g. mother / father / partner / spouse/ etc):',
                'ques_type' => 'text',
            ],
            [
                'question' => 'I confirm that I have read and understand each of the terms and conditions contained in this agreement.',
                'ques_type' => 'check',
            ],
            [
                'question' => 'I have read and understand the information sheet on the nature of <a href="#">Occupational Therapy in Mental Health.</a> I understand what the therapy will ask of me, what I can expect, the benefits and the risks.',
                'ques_type' => 'check',
            ],
            [
                'question' => 'I have had sufficient opportunity to ask questions and to consider whether I want to proceed with the occupational therapy assessment and/or treatment.',
                'ques_type' => 'check',
            ],
            [
                'question' => 'I consent to students working under the occupational therapists associated with Grounded.Well.Wise Pty Ltd. to observe, participate and provide direct occupational therapy intervention.',
                'ques_type' => 'check',
            ],
            [
                'question' => 'I know that I am, at any stage, free to withdraw my consent to undergo assessment and/or treatment, and/or research. I understand that if I do withdraw my consent, I must confirm that I have done so in writing to admin@groundedwellwise.co.za',
                'ques_type' => 'check',
            ],
            [
                'question' => 'If I withdraw consent to the occupational therapy assessment and/or treatment, the consequences include loss of potential improvement and poorer outcomes for mental health recovery. I will then not hold the therapist liable for any of those consequences, should they happen. I must still pay for the sessions of therapy I have had up to the date of withdrawing consent.',
                'ques_type' => 'check',
            ],
            [
                'question' => 'The occupational therapists and staff associated with Grounded.Well.Wise Pty Ltd. will reach out to me to remind me of my appointments or communicate changes to my appointments, to send me information about my treatment, progress, account, etc. We will not send you spam.',
                'ques_type' => 'check',
            ],
            [
                'question' => 'I consent to receiving phone calls, SMSs, WhatsApp messages and/or emails for the above purpose.',
                'ques_type' => 'check',
            ],
            [
                'question' => 'We would like to send you information about the interventions available at the occupational therapy practices associated with Grounded.Well.Wise Pty Ltd. Please check the channels below on how you wish to receive these updates',
                'ques_type' => 'check',
            ],
            [
                'question' => 'WhatsApp',
                'ques_type' => 'check',
            ],
            [
                'question' => 'E-mail',
                'ques_type' => 'check',
            ],
            [
                'question' => 'I agree that telehealth can be used as an alternative to a traditional in-person consultation. I confirm that telehealth means connecting via a a video call or phone call and agree that technical problems may interrupt or stop my visit before I am done. I understand that a telehealth visit will not cost any more than an office visit. I know I can stop using telehealth any time, even during a telehealth visit.',
                'ques_type' => 'check',
            ],
            [
                'question' => 'I understand that there are costs related to the services provided by occupational therapists associated with Grounded.Well.Wise Pty Ltd. These costs are specified in the Grounded.Well.Wise Pty Ltd Terms and Conditions.',
                'ques_type' => 'check',
            ],
            [
                'question' => 'I understand that I (or my parent/guardian) remain liable for the account for services rendered by this practice, even if I am insured by a medical aid or other third party.',
                'ques_type' => 'check',
            ],
            [
                'question' => 'I accept that I am fully responsible for payment for services rendered and should I not pay timeously, understand that I will be liable for debt recovery costs on an attorney and own client scale.',
                'ques_type' => 'check',
            ],
            [
                'question' => 'I consent that Grounded.Well.Wise Pty Ltd can assist me in addressing the non-payment / short-payment and/or imposed co-payments by',
                'ques_type' => 'check',
            ],
            [
                'question' => 'my medical scheme, which includes lodging a complaint with the Council for Medical Schemes if it is so requires.',
                'ques_type' => 'check',
            ],
            [
                'question' => 'I understand that the occuptional therapists and staff associated with Grounded.Well.Wise Pty Ltd will always act so as to protect my privacy even if I do consent to share personal information. I may direct the occupational therapist to share information with whomever I choose, and I can change your mind and revoke that permission at any time',
                'ques_type' => 'check',
            ],
            [
                'question' => 'I understand that Grounded.Well.Wise Pty Ltd. will collect information about me and my health, in order to provide healthcare services. If I do not disclose all relevant information, or do not disclose full information, I understand that it may have a negative impact on my health and healthcare services to be provided.',
                'ques_type' => 'check',
            ],
            [
                'question' => 'The occuptional therapists and staff associated with Grounded.Well.Wise Pty Ltd will use my information for the purposes of providing treatment and care, to bill me for the costs of such treatment, to do healthcare and or financial follow-ups.',
                'ques_type' => 'check',
            ],
            [
                'question' => 'I understand that my personal information may be disclosed by the practice in response to a specific request by a law enforcement agency, subpoena, court order, or as required by law.',
                'ques_type' => 'check',
            ],
            [
                'question' => 'If my information is to be used for any other purpose, I will be asked to consent to such use separately.',
                'ques_type' => 'check',
            ],
            [
                'question' => 'Research: I agree that the results of the assessment and/or treatment may be anonymously used for purposes of research and/or data-collection purposes, provided that such information is de-identified with sufficient safeguards.',
                'ques_type' => 'check',
            ],
            [
                'question' => 'Emergency: If there is an emergency during a therapy session or after termination in which the therapist becomes concerned about my personal safety, the possibility of me injuring someone else, or about me requiring psychiatric care, the therapist will contact the person whose name I have provided during my intake as my next of kin.',
                'ques_type' => 'check',
            ],
            [
                'question' => 'Sharing of health information: I agree that information relating to my health status and treatment can be disclosed to',
                'ques_type' => 'text_two',
            ],
            [
                'question' => 'I give permission that the occupational therapists associated with Grounded.Well.Wise Pty Ltd. share appropriate information with my medical scheme for billing and/or review purposes.',
                'ques_type' => 'check',
            ],
            [
                'question' => 'Obtaining of health information: I agree that, where it is in my best interest, the occupational therapists and staff associated with Grounded.Well.Wise Pty Ltd. can obtain information and/or records from any other healthcare professional simultaneously involved in my care.',
                'ques_type' => 'text',
            ],
            [
                'question' => 'Minors: If you are a minor, your parents may be legally entitled to some information about your therapy. Your therapist will discuss with you what information is appropriate for them to receive and which issues are more appropriately kept confidential.',
                'ques_type' => 'check',
            ],
            [
                'question' => 'Confidentiality Of E-Mail, Voice Mail And Text Communication: I understand that while the occupational therapists and staff associated with Grounded.Well.Wise Pty Ltd. do their best to protect my confidentiality and security of the services used, e-mail, voice mail, and text communication may be accessed by unauthorized people, compromising the privacy and confidentiality of such communication.',
                'ques_type' => 'check',
            ],
            [
                'question' => 'Right to withdraw: I have the right to withdraw any consent given or refused at any future visit. Should this occur, I will inform the occupational therapist or staff associated with Grounded.Well.Wise Pty Ltd. of this decision by email admin@groundedwellwise.co.za and sign another consent form, indicating your amended decision.',
                'ques_type' => 'check',
            ],

            // Add more records as needed
        ]);
    }
}
