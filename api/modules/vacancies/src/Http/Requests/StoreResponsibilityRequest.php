<?php

namespace Sparc\Vacancies\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;
use Sparc\Vacancies\Models\Responsibility;
use Sparc\Vacancies\Models\Vacancy;

class StoreResponsibilityRequest extends FormRequest
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
            'responsibilities' => ['required', 'array'],
            'responsibilities.*' => ['array'],
            'responsibilities.*.title' => ['required', 'string'],
            'responsibilities.*.description' => ['nullable', 'string'],
        ];
    }

    /**
     * Store responsibilities if validation passes.
     *
     * @return Collection<int, Responsibility>
     */
    public function persist(Vacancy $vacancy): Collection
    {
        /** @var Collection<int, Responsibility> */
        $created = collect([]);

        /** @var Collection<int, array<string, string>> */
        $responsibilites = collect($this->validated('responsibilities'));

        $responsibilites->each(function (array $responsibility) use ($created, $vacancy) {
            $created->push($vacancy->responsibilities()->create($responsibility));
        });

        return $created;
    }
}
