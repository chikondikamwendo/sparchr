# Sparc HR

Sparc HR is a fullstack human resources platform prototype built to demonstrate practical software engineering for core business systems. It models a vacancy and recruitment workflow for Sparc Systems: HR users publish vacancies, candidates submit structured applications, and the system assists recruiters by scoring applications against vacancy requirements.

The backend is the completed first phase of the project. The frontend is the next phase and will provide an operational interface for HR teams and a candidate-facing application experience.

## Why this project

This project was built as a focused demonstration of the work expected from a Systems Engineer working on internal platforms and SaaS products:

- translating a business workflow into a maintainable domain model;
- designing authenticated and public API boundaries;
- validating and persisting nested business data safely;
- separating domain workflows from HTTP transport concerns;
- testing behavior at the API and unit levels;
- integrating an AI capability without making the core workflow depend on unstructured model output; and
- documenting setup, interfaces, operational workflows, and technical decisions.

## Current scope

### Completed: Core API

The Laravel backend currently provides:

- Sanctum authentication for HR users;
- versioned vacancy management APIs;
- public vacancy discovery and candidate application submission;
- requirements, responsibilities, qualifications, skills, and work experience;
- vacancy lifecycle states and application review states;
- transactional application creation with related records;
- email acknowledgement after application submission;
- scheduled AI-assisted application scoring with structured results;
- vacancy resolution and application status transitions;
- realistic demo vacancies and candidate data; and
- Pest feature and unit tests covering the main workflows.

See the [API README](api/README.md) for setup instructions, endpoints, request examples, demo data, and testing commands.

### Next: Frontend

The frontend will consume the API and turn the backend workflows into usable screens for:

- vacancy creation and publishing;
- candidate browsing and application submission;
- application review and AI-assisted ranking; and
- vacancy resolution and communication.

## Engineering skills demonstrated

### Backend and API engineering

- PHP and Laravel application development;
- RESTful, versioned JSON APIs;
- authentication and authorization boundaries with Laravel Sanctum;
- Form Request validation and consistent API Resources;
- route model binding using vacancy slugs;
- nested request handling for candidate histories and qualifications;
- idempotent demo data seeding; and
- mail and scheduled workflow integration.

### Coding patterns

- Action classes for business operations such as creating applications, resolving vacancies, and scoring candidates;
- typed Data objects for passing workflow input between HTTP and domain code;
- Form Requests for validation and authorization decisions;
- API Resources for stable response serialization;
- enums for vacancy, application, gender, and qualification states;
- Eloquent relationships for aggregate data and polymorphic vacancy metadata;
- database transactions for atomic multi-table writes; and
- dependency injection for AI agents and other workflow services.

### Architecture and design decisions

The repository separates shared application concerns from the vacancy domain. Authentication and cross-cutting application behavior live in the Laravel application layer, while vacancy-specific models, routes, controllers, actions, requests, resources, migrations, factories, seeders, and tests live in `modules/vacancies`.

This modular boundary keeps the first business capability cohesive and gives future modules a clear home. Controllers coordinate transport; Actions coordinate business workflows; models express relationships; Requests validate input; and Resources define the external representation. The boundaries are intentionally simple, making the system easier to test and extend without introducing unnecessary framework abstractions.

AI scoring is isolated behind a recruiter agent with a declared structured output schema. This allows the recruitment workflow to consume predictable application IDs, scores, and remarks while keeping provider configuration in the environment. The application intake path uses a database transaction because one candidate submission writes several related records and should not be partially persisted.

## Repository layout

```text
api/                 Laravel backend and vacancy domain module
	app/               Shared application concerns and authentication
	modules/vacancies/ Vacancy domain, APIs, workflows, tests, and demo data
	database/          Core migrations, factories, and seeders
```

## Quick start

```bash
cd api
composer run setup
php artisan serve
```

Run the backend tests with:

```bash
cd api
php artisan test
```

The API README contains the full setup path, route catalog, application payload, demo seeder command, and quality commands.

## Project status

This is an intentionally focused prototype rather than a claim that every production concern has been completed. The backend establishes the domain and integration contracts first; frontend delivery, broader operational hardening, and deployment automation will follow as the project progresses.
