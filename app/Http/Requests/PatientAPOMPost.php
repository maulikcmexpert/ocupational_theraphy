<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientAPOMPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "attention" => ['min:1', 'max:18', 'numeric'],
            "nonVerbalEyeContact" => ['min:1', 'max:18', 'numeric'],
            "verbalContent" => ['min:1', 'max:18', 'numeric'],
            "relationsSocialNorms" => ['min:1', 'max:18', 'numeric'],
            "relationsRapport" => ['min:1', 'max:18', 'numeric'],
            "personalCare" => ['min:1', 'max:18', 'numeric'],
            "assertiveness" => ['min:1', 'max:18', 'numeric'],
            "stressManagement" => ['min:1', 'max:18', 'numeric'],
            "conflictManagement" => ['min:1', 'max:18', 'numeric'],
            "problemSolvingSkills" => ['min:1', 'max:18', 'numeric'],
            "roleBalance" => ['min:1', 'max:18', 'numeric'],
            "timeUseRoutines" => ['min:1', 'max:18', 'numeric'],
            "habits" => ['min:1', 'max:18', 'numeric'],
            "mixOfOccupations" => ['min:1', 'max:18', 'numeric'],
            "showsInterest" => ['min:1', 'max:18', 'numeric'],
            "locusOfControl" => ['min:1', 'max:18', 'numeric'],
            "selfWorth" => ['min:1', 'max:18', 'numeric'],
            "attitudeSelfAssurance" => ['min:1', 'max:18', 'numeric'],
            "attitudeSelfSatisfaction" => ['min:1', 'max:18', 'numeric'],
            "awarenessOfQualities" => ['min:1', 'max:18', 'numeric'],
            "repertoireOfEmotions" => ['min:1', 'max:18', 'numeric'],
            "emotionControl" => ['min:1', 'max:18', 'numeric'],
            "moods" => ['min:1', 'max:18', 'numeric'],
        ];
    }
}
