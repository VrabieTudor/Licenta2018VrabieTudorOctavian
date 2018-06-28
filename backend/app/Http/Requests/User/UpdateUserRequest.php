<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        $user = $this->route('user');
        return [
			"name" => "required",
			"username" => "required|string|max:255" . ($user ? '|unique:users,email,' . $user->id : ''),
            "password" => "string|min:6|confirmed",
			"email" => "required|string|email|max:255" . ($user ? '|unique:users,email,' . $user->id : ''),
			"company_id" => "required|exists:". app('App\Optymous\Company')->getTable() . ",id",
            "user_type_id" => "required|exists:". app('App\Optymous\UserType')->getTable() . ",id",
            "fa_enabled" => "boolean"
        ];
    }
}