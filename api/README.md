# Sparc HR Core API

The backend for Sparc HR, a modular human resources platform prototype. The current API focuses on the vacancy and recruitment workflow: authenticated HR users manage vacancies, candidates submit applications, and a scheduled AI service scores applications against vacancy requirements.

## What it provides

- Session-based authentication with login and logout endpoints, using Laravel's stateful API middleware.
- Versioned JSON APIs for vacancy management.
- Public vacancy listing and public application submission.
- Vacancy requirements, responsibilities, and qualifications.
- Candidate applications with nested experience, achievements, skills, and qualifications.
- Application status updates and vacancy resolution.
- Transactional application creation so the application and all related records are persisted together.
- Email acknowledgement after a successful application.
- Scheduled AI-assisted application scoring with structured output and review remarks.
- Feature and unit tests for authentication, vacancies, applications, resources, validation, and workflow behavior.

## Technology

- PHP 8.3+
- Laravel 13
- Laravel Sanctum
- Laravel AI
- `internachi/modular` for module boundaries
- Pest and PHPUnit
- Vite, Tailwind CSS, and the Laravel Vite plugin for the frontend assets

## Project structure

```text
app/                         Shared application concerns and authentication
database/                    Core migrations, factories, and seeders
modules/vacancies/
	database/                  Module migrations, factories, and demo seeders
	src/
		Actions/                 Business operations and workflow orchestration
		Ai/                      Recruiter agent and structured scoring contract
		Data/                    Typed action input objects
		Enums/                   Vacancy, application, and qualification states
		Http/                    Controllers, requests, and API resources
		Jobs/                    Post-processing and result broadcasting
		Models/                  Vacancy domain models and relationships
	tests/                     Module feature and unit tests
routes/                      Application routes and authentication routes
```

## Local setup

From this directory:

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm install
npm run build
```

Configure the database and mail settings in `.env`. AI scoring also requires the provider credentials and model configured for the Laravel AI package. The exact provider is intentionally environment-driven so the application code remains independent of a single vendor.

Start the development server with:

```bash
php artisan serve
```

The API is available at `http://127.0.0.1:8000`.

## API usage

All API routes are JSON routes under the `/v1` prefix.

### Authentication

```http
POST /v1/login
POST /v1/logout
```

The login response establishes an authenticated session. Keep the session cookie returned by the API client and send it with subsequent protected HR requests:

```http
Accept: application/json
Cookie: laravel_session=<session-cookie>
```

### Authenticated HR routes

```http
GET    /v1/vacancies
POST   /v1/vacancies
GET    /v1/vacancies/{vacancy}
PUT    /v1/vacancies/{vacancy}
PATCH  /v1/vacancies/{vacancy}
POST   /v1/vacancies/{vacancy}/requirements
POST   /v1/vacancies/{vacancy}/responsibilities
POST   /v1/vacancies/{vacancy}/qualifications
PATCH  /v1/vacancies/{vacancy}/applications/{application}
PUT    /v1/vacancies/{vacancy}/applications/{application}
GET    /v1/vacancies/{vacancy}/resolve
```

Vacancies are route-bound by their slug. A vacancy can be opened, reviewed, resolved, or closed through the authenticated workflow.

### Public recruitment routes

```http
GET  /v1/public/vacancies
POST /v1/public/vacancies/{vacancy}/applications
```

The application endpoint accepts the candidate's profile and nested recruitment data:

```json
{
	"name": "Jane Doe",
	"email": "jane@example.com",
	"gender": "Female",
	"date_of_birth": "1999-09-19",
	"bio": "Backend developer with experience building business systems.",
	"experiences": [
		{
			"institution": "Acme Corp",
			"position": "Software Developer",
			"started_at": "09-2023",
			"ended_at": null,
			"responsibilities": [{"title": "Develop backend systems"}],
			"achievements": [{"title": "Delivered a production API"}]
		}
	],
	"skills": [{"title": "API development"}],
	"qualifications": [
		{
			"field": "Computer Science",
			"level": "Degree",
			"year": "2016",
			"institution": "University of Code"
		}
	]
}
```

The complete Postman-friendly examples are in [`modules/vacancies/database/seeders/demo-api-applications.json`](modules/vacancies/database/seeders/demo-api-applications.json).

## Demo data

The demo seeder creates realistic open vacancies, related vacancy information, and complete candidate applications. Every demo vacancy receives a deadline five days from the time the seeder runs.

```bash
php artisan db:seed --class='Sparc\\Vacancies\\Database\\Seeders\\DemoSeeder'
```

The seeder is also called by the default `DatabaseSeeder`.

## Testing and quality

Run the full test suite:

```bash
php artisan test
```

Run the formatter:

```bash
composer lint
```

The tests cover authenticated and public routes, validation failures, uniqueness rules, expiry behavior, nested application persistence, resource serialization, vacancy resolution, and the application scoring action.

## Architectural notes

The application keeps shared concerns in `app/` and isolates vacancy domain code inside a module. Controllers remain thin; Form Requests own input validation, Actions own workflows, API Resources own response shape, and Eloquent relationships model the aggregate data. Database transactions protect multi-record application creation, while enums make workflow states explicit and structured AI output keeps scoring results predictable.