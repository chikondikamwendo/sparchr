<?php

namespace Sparc\Vacancies\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Sparc\Vacancies\Enums\VacancyStatus;
use Sparc\Vacancies\Models\Vacancy;

class UpdateVacancyRequest extends FormRequest
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
            'department' => ['nullable', 'string', 'exists:departments,slug'],
            'slug' => ['nullable', 'string', 'unique:vacancies'],
            'title' => ['nullable', 'string'],
            'brief' => ['nullable', 'string'],
            'expires' => ['nullable', 'date'],
            'status' => ['nullable', Rule::enum(VacancyStatus::class)],
        ];
    }

    /**
     * Update resource in storage if validation passes.
     */
    public function persist(Vacancy $vacancy)
    {
        $validated = collect($this->validated())
            ->filter(fn (string $value, string $key) => $key !== 'expires')
            ->toArray();

        if ($expires = $this->validated('expires')) {
            $validated['expires_at'] = $expires;
        }

        $vacancy->update($validated);
    }
}
