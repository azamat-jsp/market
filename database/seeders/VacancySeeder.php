<?php

namespace Database\Seeders;

use App\Tbuy\Vacancy\Models\Vacancy;
use App\Tbuy\Vacancy\Models\VacancyCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class VacancySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VacancyCategory::factory(5)
            ->create()
            ->each(function (VacancyCategory $category) {
                $vacancies = collect(Vacancy::factory(5)->raw())
                    ->map(
                        fn(array $vacancy) => Arr::only($vacancy, [
                            'category_id',
                            'title',
                            'description',
                            'salary',
                            'status',
                            'company_id',
                            'address',
                            'position',
                            'working_conditions',
                            'working_type',
                            'deadline',
                        ])
                    );
                $category->vacancies()->createMany($vacancies);
            });
    }
}
