<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('departments')->insert($this->getSeeds());
    }

    /**
     * Sanitizes data to be seeded.
     *
     * @return array<array<string, string>>
     */
    private function getSeeds(): array
    {
        $departments = collect([
            'Accounts',
            'Administration',
            'Infrastructure',
            'Marketing',
            'Sales',
            'Software',
            'Technical',
        ]);

        return $departments->map(fn (string $department) => [
            'name' => $department,
            'slug' => Str::slug($department),
        ])->toArray();
    }
};
