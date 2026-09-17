<?php

namespace Sparc\Vacancies\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Sparc\Vacancies\Enums\QualificationLevel;
use Sparc\Vacancies\Models\Qualification;
use Sparc\Vacancies\Models\Vacancy;

class StoreQualificationRequest extends FormRequest
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
            'qualifications' => ['required', 'array'],
            'qualifications.*.field' => ['required', 'string', 'max:255'],
            'qualifications.*.description' => ['nullable', 'string'],
            'qualifications.*.level' => ['required', Rule::enum(QualificationLevel::class)],
            'qualifications.*.required' => ['required', 'bool'],
        ];
    }

    /**
     * Store Qualification if validation passes.
     *
     * @return Collection<int, Qualification>
     */
    public function persist(Vacancy $vacancy): Collection
    {
        /** @var Collection<int, Qualification> */
        $created = collect([]);

        /** @var Collection<int, array<string, string>> */
        $qualifications = collect($this->validated('qualifications'));

        $qualifications->each(function (array $qualification) use ($created, $vacancy) {
            $created->push($vacancy->qualifications()->create($qualification));
        });

        return $created;
    }
}
