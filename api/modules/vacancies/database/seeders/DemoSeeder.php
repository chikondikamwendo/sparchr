<?php

namespace Sparc\Vacancies\Database\Seeders;

use App\Enums\Gender;
use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Seeder;
use Sparc\Vacancies\Enums\QualificationLevel;
use Sparc\Vacancies\Enums\VacancyStatus;
use Sparc\Vacancies\Models\Application;
use Sparc\Vacancies\Models\Vacancy;

class DemoSeeder extends Seeder
{
    /**
     * Seed realistic vacancy and application data for demonstrations.
     */
    public function run(): void
    {
        $recruiter = User::firstOrCreate(
            ['email' => 'recruiter@example.com'],
            ['name' => 'Demo Recruiter', 'password' => 'password'],
        );

        $vacancies = [
            [
                'department' => 'Software',
                'slug' => 'senior-backend-engineer',
                'title' => 'Senior Backend Engineer',
                'brief' => 'Build reliable services that power a growing digital payments platform.',
                'requirements' => [
                    ['title' => 'Five years of backend engineering experience', 'description' => 'Experience delivering production systems with PHP or a comparable backend language.'],
                    ['title' => 'Strong database and API design skills', 'description' => 'Comfortable designing REST APIs and working with relational databases.'],
                    ['title' => 'Cloud deployment experience', 'description' => 'Hands-on experience with Docker and at least one major cloud platform.'],
                ],
                'responsibilities' => [
                    ['title' => 'Design and build backend services', 'description' => 'Deliver maintainable services with clear interfaces and reliable automated tests.'],
                    ['title' => 'Improve platform reliability', 'description' => 'Monitor production systems and lead practical performance and resilience improvements.'],
                ],
                'qualifications' => [
                    ['field' => 'Computer Science', 'level' => QualificationLevel::DEGREE, 'institution' => 'Accredited university', 'description' => 'A related degree or equivalent professional experience.', 'required' => true],
                    ['field' => 'Software Engineering', 'level' => QualificationLevel::CERTIFICATE, 'institution' => 'Recognized training provider', 'description' => 'Additional training in software engineering is an advantage.', 'required' => false],
                ],
                'applications' => [
                    [
                        'name' => 'Amara Banda',
                        'gender' => Gender::FEMALE,
                        'email' => 'amara.banda@example.com',
                        'date_of_birth' => '1991-04-18',
                        'bio' => 'Backend engineer with eight years of experience building financial and logistics platforms.',
                        'qualifications' => [
                            ['field' => 'Computer Science', 'level' => QualificationLevel::DEGREE, 'institution' => 'University of Zambia', 'year' => 2014, 'description' => 'Bachelor of Computer Science.'],
                        ],
                        'experiences' => [
                            ['institution' => 'CopperPay', 'position' => 'Lead Backend Engineer', 'started_at' => '03-2019', 'ended_at' => null, 'responsibilities' => [['title' => 'Led payment API development', 'description' => 'Managed delivery of secure payment and reconciliation services.']], 'achievements' => [['title' => 'Reduced payment failures', 'description' => 'Improved retry handling and reduced failed payment requests by 28%.']]],
                            ['institution' => 'RouteStack', 'position' => 'Backend Engineer', 'started_at' => '01-2016', 'ended_at' => '02-2019', 'responsibilities' => [['title' => 'Built logistics services', 'description' => 'Created APIs for dispatch, tracking, and delivery notifications.']], 'achievements' => [['title' => 'Improved API response times', 'description' => 'Reduced average response time by 35% through query and caching improvements.']]],
                        ],
                        'skills' => [
                            ['title' => 'PHP and Laravel', 'description' => 'Advanced production experience.'],
                            ['title' => 'PostgreSQL', 'description' => 'Schema design, query tuning, and operational troubleshooting.'],
                            ['title' => 'Docker and AWS', 'description' => 'Containerized deployments and cloud operations.'],
                        ],
                    ],
                    [
                        'name' => 'Thabo Moyo',
                        'gender' => Gender::MALE,
                        'email' => 'thabo.moyo@example.com',
                        'date_of_birth' => '1988-11-02',
                        'bio' => 'Platform engineer focused on APIs, observability, and secure distributed systems.',
                        'qualifications' => [
                            ['field' => 'Information Technology', 'level' => QualificationLevel::DEGREE, 'institution' => 'University of Botswana', 'year' => 2011, 'description' => 'Bachelor of Information Technology.'],
                        ],
                        'experiences' => [
                            ['institution' => 'Nexa Cloud', 'position' => 'Platform Engineer', 'started_at' => '06-2018', 'ended_at' => null, 'responsibilities' => [['title' => 'Maintained cloud services', 'description' => 'Supported high-availability services and deployment pipelines.']], 'achievements' => [['title' => 'Automated release workflows', 'description' => 'Cut deployment time from hours to under twenty minutes.']]],
                        ],
                        'skills' => [
                            ['title' => 'Go and PHP', 'description' => 'Production service development and maintenance.'],
                            ['title' => 'Kubernetes', 'description' => 'Workload deployment, monitoring, and incident response.'],
                            ['title' => 'Redis', 'description' => 'Caching and asynchronous job workflows.'],
                        ],
                    ],
                ],
            ],
            [
                'department' => 'Marketing',
                'slug' => 'product-marketing-manager',
                'title' => 'Product Marketing Manager',
                'brief' => 'Shape the story of products that help small businesses work smarter.',
                'requirements' => [
                    ['title' => 'Four years of product marketing experience', 'description' => 'Experience taking software products from positioning to market.'],
                    ['title' => 'Excellent written communication', 'description' => 'Ability to turn customer insight into clear, compelling content.'],
                ],
                'responsibilities' => [
                    ['title' => 'Own product positioning', 'description' => 'Translate product capabilities into differentiated messages for target customers.'],
                    ['title' => 'Lead go-to-market campaigns', 'description' => 'Coordinate launches with sales, product, and creative teams.'],
                ],
                'qualifications' => [
                    ['field' => 'Marketing', 'level' => QualificationLevel::DEGREE, 'institution' => 'Accredited university', 'description' => 'A degree in marketing, communications, or a related field.', 'required' => true],
                ],
                'applications' => [
                    [
                        'name' => 'Nadia Phiri',
                        'gender' => Gender::FEMALE,
                        'email' => 'nadia.phiri@example.com',
                        'date_of_birth' => '1993-07-09',
                        'bio' => 'Product marketer who has launched SaaS products across Southern African markets.',
                        'qualifications' => [
                            ['field' => 'Marketing', 'level' => QualificationLevel::DEGREE, 'institution' => 'University of Malawi', 'year' => 2015, 'description' => 'Bachelor of Marketing.'],
                        ],
                        'experiences' => [
                            ['institution' => 'MarketBridge', 'position' => 'Product Marketing Lead', 'started_at' => '08-2020', 'ended_at' => null, 'responsibilities' => [['title' => 'Planned product launches', 'description' => 'Built launch plans, messaging, and enablement for new software features.']], 'achievements' => [['title' => 'Increased qualified pipeline', 'description' => 'Improved campaign-sourced pipeline by 42% in one year.']]],
                        ],
                        'skills' => [
                            ['title' => 'Go-to-market strategy', 'description' => 'Launch planning, positioning, and sales enablement.'],
                            ['title' => 'Customer research', 'description' => 'Interviews, segmentation, and insight synthesis.'],
                            ['title' => 'Content strategy', 'description' => 'Long-form, web, email, and campaign content.'],
                        ],
                    ],
                    [
                        'name' => 'Daniel Tembo',
                        'gender' => Gender::MALE,
                        'email' => 'daniel.tembo@example.com',
                        'date_of_birth' => '1990-02-21',
                        'bio' => 'B2B communications specialist with a strong record of turning technical ideas into useful stories.',
                        'qualifications' => [
                            ['field' => 'Communications', 'level' => QualificationLevel::DEGREE, 'institution' => 'University of Zimbabwe', 'year' => 2013, 'description' => 'Bachelor of Arts in Communications.'],
                        ],
                        'experiences' => [
                            ['institution' => 'BrightWorks', 'position' => 'Content Marketing Manager', 'started_at' => '02-2017', 'ended_at' => '07-2020', 'responsibilities' => [['title' => 'Managed editorial calendar', 'description' => 'Coordinated thought leadership and customer education content.']], 'achievements' => [['title' => 'Grew organic traffic', 'description' => 'Doubled qualified organic traffic over eighteen months.']]],
                        ],
                        'skills' => [
                            ['title' => 'B2B storytelling', 'description' => 'Customer-led messaging for business audiences.'],
                            ['title' => 'Campaign analytics', 'description' => 'Funnel measurement and campaign reporting.'],
                        ],
                    ],
                ],
            ],
            [
                'department' => 'Technical',
                'slug' => 'technical-support-specialist',
                'title' => 'Technical Support Specialist',
                'brief' => 'Help customers solve technical problems with patience, precision, and care.',
                'requirements' => [
                    ['title' => 'Two years in technical support', 'description' => 'Experience supporting customers through email, chat, or phone.'],
                    ['title' => 'Strong troubleshooting ability', 'description' => 'Able to investigate issues and explain solutions clearly to non-technical users.'],
                ],
                'responsibilities' => [
                    ['title' => 'Resolve customer issues', 'description' => 'Diagnose product issues and provide timely, friendly solutions.'],
                    ['title' => 'Improve support knowledge', 'description' => 'Document recurring issues and contribute to internal and customer-facing guides.'],
                ],
                'qualifications' => [
                    ['field' => 'Information Technology', 'level' => QualificationLevel::DIPLOMA, 'institution' => 'Accredited college', 'description' => 'A diploma in IT or equivalent practical experience.', 'required' => true],
                ],
                'applications' => [
                    [
                        'name' => 'Lydia Mwale',
                        'gender' => Gender::FEMALE,
                        'email' => 'lydia.mwale@example.com',
                        'date_of_birth' => '1995-09-14',
                        'bio' => 'Customer-focused support specialist experienced in SaaS troubleshooting and knowledge-base writing.',
                        'qualifications' => [
                            ['field' => 'Information Technology', 'level' => QualificationLevel::DIPLOMA, 'institution' => 'Evelyn Hone College', 'year' => 2017, 'description' => 'Diploma in Information Technology.'],
                        ],
                        'experiences' => [
                            ['institution' => 'CloudDesk', 'position' => 'Technical Support Specialist', 'started_at' => '05-2019', 'ended_at' => null, 'responsibilities' => [['title' => 'Supported SaaS customers', 'description' => 'Resolved account, integration, and workflow issues for business customers.']], 'achievements' => [['title' => 'Improved first-contact resolution', 'description' => 'Raised first-contact resolution from 68% to 81%.']]],
                        ],
                        'skills' => [
                            ['title' => 'Customer troubleshooting', 'description' => 'Structured investigation and clear customer communication.'],
                            ['title' => 'SQL basics', 'description' => 'Simple queries for support investigation and data validation.'],
                            ['title' => 'Zendesk', 'description' => 'Ticket management, macros, and knowledge-base workflows.'],
                        ],
                    ],
                    [
                        'name' => 'Brian Chanda',
                        'gender' => Gender::MALE,
                        'email' => 'brian.chanda@example.com',
                        'date_of_birth' => '1992-06-30',
                        'bio' => 'IT support professional who enjoys making complex technical problems understandable and actionable.',
                        'qualifications' => [
                            ['field' => 'Computer Networks', 'level' => QualificationLevel::CERTIFICATE, 'institution' => 'Cisco Networking Academy', 'year' => 2016, 'description' => 'Networking fundamentals certificate.'],
                        ],
                        'experiences' => [
                            ['institution' => 'Northstar Services', 'position' => 'Service Desk Analyst', 'started_at' => '01-2018', 'ended_at' => '04-2021', 'responsibilities' => [['title' => 'Managed service desk queue', 'description' => 'Triaged incidents and coordinated escalations with engineering teams.']], 'achievements' => [['title' => 'Created support playbooks', 'description' => 'Documented repeatable solutions for the ten most common incidents.']]],
                        ],
                        'skills' => [
                            ['title' => 'Incident management', 'description' => 'Prioritization, escalation, and follow-through.'],
                            ['title' => 'Technical writing', 'description' => 'Clear support notes and user documentation.'],
                        ],
                    ],
                ],
            ],
        ];

        foreach ($vacancies as $vacancyData) {
            $vacancy = Vacancy::updateOrCreate(
                ['slug' => $vacancyData['slug']],
                [
                    'user_id' => $recruiter->id,
                    'department_id' => Department::where('name', $vacancyData['department'])->value('id'),
                    'title' => $vacancyData['title'],
                    'brief' => $vacancyData['brief'],
                    'status' => VacancyStatus::OPEN,
                    'expires_at' => now()->addDays(5),
                ],
            );

            $vacancy->requirements()->delete();
            $vacancy->responsibilities()->delete();
            $vacancy->qualifications()->delete();

            $vacancy->requirements()->createMany($vacancyData['requirements']);
            $vacancy->responsibilities()->createMany($vacancyData['responsibilities']);
            $vacancy->qualifications()->createMany($vacancyData['qualifications']);

            foreach ($vacancyData['applications'] as $applicationData) {
                $application = Application::updateOrCreate(
                    ['vacancy_id' => $vacancy->id, 'email' => $applicationData['email']],
                    [
                        'name' => $applicationData['name'],
                        'gender' => $applicationData['gender'],
                        'bio' => $applicationData['bio'],
                        'date_of_birth' => $applicationData['date_of_birth'],
                    ],
                );

                $application->qualifications()->delete();
                $application->experiences()->delete();
                $application->skills()->delete();

                $application->qualifications()->createMany($applicationData['qualifications']);
                $application->skills()->createMany($applicationData['skills']);

                foreach ($applicationData['experiences'] as $experienceData) {
                    $experience = $application->experiences()->create([
                        'institution' => $experienceData['institution'],
                        'position' => $experienceData['position'],
                        'started_at' => $experienceData['started_at'],
                        'ended_at' => $experienceData['ended_at'],
                    ]);

                    $experience->responsibilities()->createMany($experienceData['responsibilities']);
                    $experience->achievements()->createMany($experienceData['achievements']);
                }
            }
        }
    }
}
