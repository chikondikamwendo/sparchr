<?php

namespace Sparc\Vacancies\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;
use Sparc\Vacancies\Models\Requirement;
use Sparc\Vacancies\Models\Vacancy;

class StoreRequirementRequest extends FormRequest
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
            'requirements' => ['required', 'array'],
            'requirements.*.title' => ['required', 'string', 'max:255'],
            'requirements.*.description' => ['nullable', 'string'],
        ];
    }

    /**
     * Store a requirement if validation passes.
     *
     * @return Collection<int, Requirement>
     */
    public function persist(Vacancy $vacancy): Collection
    {
        /** @var Collection<int, Requirement> */
        $created = collect([]);

        /** @var Collection<int, array<string, string>> */
        $requirements = collect($this->validated('requirements'));

        $requirements->each(function (array $requirement) use ($created, $vacancy) {
            $created->push($vacancy->requirements()->create($requirement));
        });

        return $created;
    }
}
