<?php

namespace Sparc\Vacancies\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Sparc\Vacancies\Enums\ApplicationStatus;
use Sparc\Vacancies\Models\Application;

class UpdateApplicationRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status' => ['nullable', Rule::enum(ApplicationStatus::class)],
        ];
    }

    /**
     * Updates a resource in storage.
     */
    public function persist(Application $application)
    {
        if ($status = $this->validated('status')) {
            $application->update([
                'status' => $status,
            ]);
        }
    }
}
