<?php

namespace Sparc\Vacancies\Ai\Agents;

use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\HasStructuredOutput;
use Laravel\Ai\Promptable;
use Stringable;

class Recruiter implements Agent, HasStructuredOutput
{
    use Promptable;

    /**
     * Get the instructions that the agent should follow.
     */
    public function instructions(): Stringable|string
    {
        return 'You are an assistant for the Human Resources department. '.
            'You help them rank applications to open vacancies during recruitment by comparing '.
            'various vacancy requirements and specifications to that submitted in an application. '.
            'In the end you score each application from a scale of 0 - 100 '.
            'indicating how much of a match an application is to the vacancy. '.
            'And give a not more than 2 sentences remarks for why this is the score.';
    }

    /**
     * Get the agent's structured output schema definition.
     */
    public function schema(JsonSchema $schema): array
    {
        return [
            'results' => $schema->array()->items($schema->object(fn ($schema) => [
                'application_id' => $schema->integer()->required(),
                'remarks' => $schema->string()->required(),
                'score' => $schema->integer()->required(),
            ]))->required(),
        ];
    }
}
