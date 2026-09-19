<?php

namespace Sparc\Vacancies\Http\Requests;

use App\Enums\Gender;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Sparc\Vacancies\Actions\CreateApplication;
use Sparc\Vacancies\Data\CreateApplicationProps;
use Sparc\Vacancies\Enums\QualificationLevel as Level;
use Sparc\Vacancies\Models\Application;
use Sparc\Vacancies\Models\Vacancy;

class StoreApplicationRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'gender' => ['required', Rule::enum(Gender::class)],
            'date_of_birth' => ['required', 'date'],
            'bio' => ['required', 'string'],
            'experiences' => ['required', 'array'],
            'experiences.*.institution' => ['required', 'string'],
            'expiriences.*.position' => ['required', 'string'],
            'expiriences.*.started_at' => ['required', Rule::date()->format('m-Y')],
            'expiriences.*.ended_at' => ['nullable', Rule::date()->format('m-Y')],
            'expiriences.*.responsibilities' => ['required', 'array'],
            'expiriences.*.achievements' => ['required', 'array:title'],
            'skills' => ['required', 'array'],
            'qualifications' => ['required', 'array'],
            'qualifications.*.field' => ['required', 'string'],
            'qualifications.*.level' => ['required', Rule::enum(Level::class)],
            'qualifications.*.year' => ['required', Rule::date()->format('Y')],
            'qualifications.*.institution' => ['required', 'string'],
        ];
    }

    /**
     * Store an Application if validation passes.
     */
    public function persist(CreateApplication $action, Vacancy $vacancy): Application
    {
        return $action->handle(new CreateApplicationProps(
            $vacancy,
            $this->name,
            $this->email,
            Gender::from($this->gender),
            Carbon::parse($this->date_of_birth),
            $this->bio,
            collect($this->experiences),
            collect($this->skills),
            collect($this->qualifications),
        ));
    }
}
