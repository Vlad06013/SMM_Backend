<?php

namespace App\Domain\Clients\TelegramWebApp\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientChannelRequest extends FormRequest
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
        return [
            'user_id' => 'required|exists:users,id',
            'posting_resource_id' => 'required|exists:posting_resources,id',
            'name' => 'required|string',
            'auto_signature' => 'required|boolean',
            'auto_punctuation' => 'required|boolean',
            'water_marks_id' => 'nullable|exists:water_marks,id',
            'reposter_id' => 'nullable|exists:reposters,id',
        ];
    }
}
