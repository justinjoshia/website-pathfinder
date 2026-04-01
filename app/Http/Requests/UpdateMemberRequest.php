<?php

namespace App\Http\Requests;

use App\Models\Member;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMemberRequest extends FormRequest
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
    public function rules(): array
    {
        /** @var Member $member */
        $member = $this->route('member');

        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('users', 'name')->ignore($member->user_id)],
            'password' => ['nullable', 'string', 'min:8'],
            'class_id' => ['required', 'exists:classes,id'],
            'team_id' => ['required', 'exists:teams,id'],
        ];
    }
}
