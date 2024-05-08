<?php

namespace App\Http\Controllers;

use Yajra\DataTables\Facades\Datatables;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\PatientController;
use App\Models\Api\patientDetails;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\PatientRasMaster;
use App\Models\Admin\PatientApoms;
use App\Models\GroupPatientAssignment;

class CSVController extends Controller
{

    public function export()
    {

        $data = $data = User::with(['patientDetails'])->where('role_id', '5')->get();

        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set the headers
        $headers = [
            'Name',
            'Surname',
            'Patient No',
            'Gender',
            'Date Of Birth',
            'Date Of Admission',
            'Date Of Descharge',
            'Name Of OT',
            'Number groups attended',
            'Date Baseline Assessment',
            'Date Final Assessment',
            'Process skills',
            'Communication / Inter skills',
            'Life Skills',
            'Role Performance',
            'Balanced Life Style',
            'Motivation',
            'Self Esteem',
            'Affect',
            'Process skills',
            'Communication / Inter skills',
            'Life Skills',
            'Role Performance',
            'Balanced Life Style',
            'Motivation',
            'Self Esteem',
            'Affect'

        ];
        $sheet->fromArray($headers, null, 'A1');

        // Set the data starting from the second row
        $rowData = [];

        foreach ($data as $row) {

            $apomData = $this->apomReports($row->id);
            $patientData = User::with(['patientDetails', 'PatientApoms.group'])->where('id', $row->id)->first();
            $numberOFGroupAttend = GroupPatientAssignment::where(['patient_id' => $row->id, 'in_out' => 'in'])->count();
            $checkInitialRasComplated = PatientRasMaster::where(['test_type' => '0', 'patient_id' => $row->id])->count();
            $checkFinalRasComplated = PatientRasMaster::where(['test_type' => '1', 'patient_id' => $row->id])->count();
            $checkInitialAPOMComplated = PatientApoms::where(['test_type' => '0', 'patient_id' => $row->id])->count();
            $checkFinalAPOMComplated = PatientApoms::where(['test_type' => '1', 'patient_id' => $row->id])->count();
            if ($checkInitialRasComplated != 0 && $checkFinalRasComplated != 0 && $checkInitialAPOMComplated != 0 && $checkFinalAPOMComplated != 0) {
                $gender = ($row->patientDetails->gender == 'male') ? 'M' : 'F';

                $rowData[] = [
                    $row->first_name,
                    $row->last_name,
                    'PT' . $row->id,
                    $gender,
                    $row->patientDetails->date_of_birth,
                    date('Y-m-d', strtotime($patientData->created_at)),
                    $patientData->PatientApoms[1]->dateOfScreening,
                    $patientData->PatientApoms[1]->therapistName,
                    $numberOFGroupAttend,
                    $patientData->PatientApoms[0]->dateOfScreening,
                    $patientData->PatientApoms[1]->dateOfScreening,
                    $apomData['initialApomReport'][0],
                    $apomData['initialApomReport'][1],
                    $apomData['initialApomReport'][2],
                    $apomData['initialApomReport'][3],
                    $apomData['initialApomReport'][4],
                    $apomData['initialApomReport'][5],
                    $apomData['initialApomReport'][6],
                    $apomData['initialApomReport'][7],
                    $apomData['finalApomReport'][0],
                    $apomData['finalApomReport'][1],
                    $apomData['finalApomReport'][2],
                    $apomData['finalApomReport'][3],
                    $apomData['finalApomReport'][4],
                    $apomData['finalApomReport'][5],
                    $apomData['finalApomReport'][6],
                    $apomData['finalApomReport'][7]
                ];
            }
        }
        $sheet->fromArray($rowData, null, 'A2');
        $sheet->getStyle('A1:AA1')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
        ]);
        // Create a new Excel Writer object and save the Spreadsheet as a file
        $writer = new Xlsx($spreadsheet);
        $fileName = 'patients.xlsx';
        $writer->save($fileName);

        // Return the file as a download response
        return response()->download($fileName)->deleteFileAfterSend();
    }

    public function apomReports($patient_id)
    {
        // Initial APOM // 



        $processSkill = PatientApoms::selectRaw(
            'SUM(attention +pace +knowledgeToolsAndMaterials +knowledgeConceptFormation +skillsToUseToolsAndMaterials + taskConcept +organizingSpaceAndObjects +adaptation) as processSkill'

        )->where(['patient_id' => $patient_id, 'test_type' => '0'])->first();

        $communicationInteractionSkills = PatientApoms::selectRaw(
            'SUM(nonVerbalPhysicalContact +nonVerbalEyeContact +nonVerbalGestures +nonVerbalUseOfBody +verbalSpeech +verbalContent +verbalExpressNeeds +verbalConversation +relationsSocialNorms +relationsRapport) as communicationInteractionSkills'

        )->where(['patient_id' => $patient_id, 'test_type' => '0'])->first();

        $lifeSkills = PatientApoms::selectRaw(
            'SUM(personalCare +personalSafety +careOfMedication +useOfTransport +domesticSkills +childCareSkills +moneyManagementAndBudgetingSkills +assertiveness +stressManagement +conflictManagement +problemSolvingSkills +preVocationalSkills +vocationalSkills) as lifeSkills'

        )->where(['patient_id' => $patient_id, 'test_type' => '0'])->first();

        $roleperformance = PatientApoms::selectRaw(
            'SUM( awarenessOfRoles + roleExpectations +roleBalance +competency) as roleperformance'

        )->where(['patient_id' => $patient_id, 'test_type' => '0'])->first();

        $balancedLifeStyle = PatientApoms::selectRaw(
            'SUM( timeUseRoutines +habits +mixOfOccupations) as balancedLifeStyle'

        )->where(['patient_id' => $patient_id, 'test_type' => '0'])->first();

        $motivation = PatientApoms::selectRaw(
            'SUM( activeInvolvement +motivesAndDrives +showsInterest +goalDirectedBehaviour +locusOfControl) as motivation'

        )->where(['patient_id' => $patient_id, 'test_type' => '0'])->first();

        $selfEsteem = PatientApoms::selectRaw(
            'SUM( commitmentToTaskSituation +usingFeedback +selfWorth +attitudeSelfAssurance +attitudeSelfSatisfaction +awarenessOfQualities +socialPresence) as selfEsteem'

        )->where(['patient_id' => $patient_id, 'test_type' => '0'])->first();

        $affect = PatientApoms::selectRaw(
            'SUM( repertoireOfEmotions +emotionControl +moods) as affect'

        )->where(['patient_id' => $patient_id, 'test_type' => '0'])->first();

        $processSkillAvg = round($processSkill->processSkill / 8);
        $communicationInteractionSkillsAvg = round($communicationInteractionSkills->communicationInteractionSkills / 10);
        $lifeSkillsAvg = round($lifeSkills->lifeSkills / 13);
        $roleperformanceAvg = round($roleperformance->roleperformance / 4);
        $balancedLifeStyleAvg = round($balancedLifeStyle->balancedLifeStyle / 3);
        $motivationAvg = round($motivation->motivation / 5);
        $selfEsteemAvg = round($selfEsteem->selfEsteem / 7);
        $affectAvg = round($affect->affect / 3);


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


        $final_processSkill = PatientApoms::selectRaw(
            'SUM(attention +pace +knowledgeToolsAndMaterials +knowledgeConceptFormation +skillsToUseToolsAndMaterials + taskConcept +organizingSpaceAndObjects +adaptation) as final_processSkill'

        )->where(['patient_id' => $patient_id, 'test_type' => '1'])->first();

        $final_communicationInteractionSkills = PatientApoms::selectRaw(
            'SUM(nonVerbalPhysicalContact +nonVerbalEyeContact +nonVerbalGestures +nonVerbalUseOfBody +verbalSpeech +verbalContent +verbalExpressNeeds +verbalConversation +relationsSocialNorms +relationsRapport) as final_communicationInteractionSkills'

        )->where(['patient_id' => $patient_id, 'test_type' => '1'])->first();

        $final_lifeSkills = PatientApoms::selectRaw(
            'SUM(personalCare +personalSafety +careOfMedication +useOfTransport +domesticSkills +childCareSkills +moneyManagementAndBudgetingSkills +assertiveness +stressManagement +conflictManagement +problemSolvingSkills +preVocationalSkills +vocationalSkills) as final_lifeSkills'

        )->where(['patient_id' => $patient_id, 'test_type' => '1'])->first();

        $final_roleperformance = PatientApoms::selectRaw(
            'SUM( awarenessOfRoles + roleExpectations +roleBalance +competency) as final_roleperformance'

        )->where(['patient_id' => $patient_id, 'test_type' => '1'])->first();

        $final_balancedLifeStyle = PatientApoms::selectRaw(
            'SUM( timeUseRoutines +habits +mixOfOccupations) as final_balancedLifeStyle'

        )->where(['patient_id' => $patient_id, 'test_type' => '1'])->first();

        $final_motivation = PatientApoms::selectRaw(
            'SUM( activeInvolvement +motivesAndDrives +showsInterest +goalDirectedBehaviour +locusOfControl) as final_motivation'

        )->where(['patient_id' => $patient_id, 'test_type' => '1'])->first();

        $final_selfEsteem = PatientApoms::selectRaw(
            'SUM( commitmentToTaskSituation +usingFeedback +selfWorth +attitudeSelfAssurance +attitudeSelfSatisfaction +awarenessOfQualities +socialPresence) as final_selfEsteem'

        )->where(['patient_id' => $patient_id, 'test_type' => '1'])->first();

        $final_affect = PatientApoms::selectRaw(
            'SUM( repertoireOfEmotions +emotionControl +moods) as final_affect'

        )->where(['patient_id' => $patient_id, 'test_type' => '1'])->first();

        $final_processSkillAvg = round($final_processSkill->final_processSkill / 8);
        $final_communicationInteractionSkillsAvg = round($final_communicationInteractionSkills->final_communicationInteractionSkills / 10);
        $final_lifeSkillsAvg = round($final_lifeSkills->final_lifeSkills / 13);
        $final_roleperformanceAvg = round($final_roleperformance->final_roleperformance / 4);
        $final_balancedLifeStyleAvg = round($final_balancedLifeStyle->final_balancedLifeStyle / 3);
        $final_motivationAvg = round($final_motivation->final_motivation / 5);
        $final_selfEsteemAvg = round($final_selfEsteem->final_selfEsteem / 7);
        $final_affectAvg = round($final_affect->final_affect / 3);

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
}
