<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\{
    User
};

class PostchangePassword extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(Request $request): array
    {

        $id = decrypt($request->id);
        $checkUser = User::where('id', $id)->first();

        if ($checkUser->role_id == '1') { // admin

            return [
                'new_password' => ['required', 'string', 'min:8'],
                'confirm_password' => ['required', 'string', 'same:new_password']
            ];
        }



        if ($checkUser->role_id == '2') { // staff

            return [
                'current_password' => ['required', 'string', 'min:8'],
                'new_password' => ['required', 'string', 'min:8'],
                'confirm_password' => ['required', 'string', 'same:new_password']
            ];
            if ($validator->passes() && !Hash::check($request->current_password, $checkUser->password)) {
                $validator->errors()->add('current_password', 'The current password is incorrect.');
            }
        }


        if ($checkUser->role_id == '3') { //Therapist

            return [
                'current_password' => ['required', 'string', 'min:8'],
                'new_password' => ['required', 'string', 'min:8'],
                'confirm_password' => ['required', 'string', 'same:new_password']
            ];

            if ($validator->passes() && !Hash::check($request->current_password,  $checkUser->password)) {
                $validator->errors()->add('current_password', 'The current password is incorrect.');
            }
        }

        if ($checkUser->role_id == '5') { // patient

            return [
                'current_password' => ['required', 'string', 'min:8'],
                'new_password' => ['required', 'string', 'min:8'],
                'confirm_password' => ['required', 'string', 'same:new_password']
            ];
            if ($validator->passes() && !Hash::check($request->current_password,  $checkUser->password)) {
                $validator->errors()->add('current_password', 'The current password is incorrect.');
            }
        }
    }
}
