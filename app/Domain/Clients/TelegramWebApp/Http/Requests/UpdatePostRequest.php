<?php

namespace App\Domain\Clients\TelegramWebApp\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'text' => 'required|string',
            'links' => 'array',
            'links.*.title' => 'required|string',
            'links.*.url' => 'required|string',
            'scheduleDates' => 'required|array',
            'scheduleDates.*' => 'required|date',
            'attachmentIds' => 'nullable|array',
            'attachmentIds.*' => 'nullable|exists:attachment_files,id',
            'channelIds' => 'nullable|array',
            'channelIds.*' => 'nullable|exists:client_channels,id',
        ];
    }
}
