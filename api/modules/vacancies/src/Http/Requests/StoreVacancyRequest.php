<?php

namespace Sparc\Vacancies\Http\Requests;

use App\Models\Department;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Sparc\Vacancies\Models\Vacancy;

class StoreVacancyRequest extends FormRequest
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
            'department' => ['required', 'string', 'exists:departments,slug'],
            'slug' => ['required', 'string', 'unique:vacancies'],
            'title' => ['required', 'string'],
            'brief' => ['required', 'string'],
            'expires' => ['nullable', 'date'],
        ];
    }

    /**
     * Stores a new Vacancy if validation passes.
     */
    public function persist(): Vacancy
    {
        $this->department = (Department::firstWhere('slug', $this->department)->first('id'))->id;

        return Vacancy::create([
            'user_id' => $this->user()->id,
            'department_id' => $this->department,
            'slug' => $this->slug,
            'title' => $this->title,
            'brief' => $this->brief,
            'expires_at' => $this->expires,
        ]);
    }
}
