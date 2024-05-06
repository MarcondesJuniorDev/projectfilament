<?php

namespace Database\Seeders;

use App\Models\Award;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Department;
use App\Models\Event;
use App\Models\EventCategory;
use App\Models\EventImage;
use App\Models\Lesson;
use App\Models\LessonContent;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\NewsImage;
use App\Models\SchoolGrade;
use App\Models\SchoolYear;
use App\Models\Subject;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            PermissionRoleSeeder::class,
            RoleUserSeeder::class,
            DepartmentUserSeeder::class,
        ]);

        User::factory()->count(10)->create();
        Department::factory()->count(10)->create();
        CourseCategory::factory()->count(10)->create();
        Course::factory()->count(10)->create();
        Subject::factory()->count(10)->create();
        SchoolGrade::factory()->count(10)->create();
        $this->createSchoolYears();
        $lessons = Lesson::factory()->count(10)->create();

        foreach ($lessons as $lesson) {
            LessonContent::factory()->count(random_int(1, 5))->create([
                'lesson_id' => $lesson->id,
            ]);
        }

        NewsCategory::factory()->count(10)->create();
        News::factory()->count(10)->create();
        NewsImage::factory()->count(30)->create();

        EventCategory::factory()->count(10)->create();
        Event::factory()->count(10)->create();
        EventImage::factory()->count(30)->create();

        Award::factory()->count(10)->create();
    }

    private function createSchoolYears(): void
    {
        $years = ['2020', '2021', '2022', '2023', '2024'];

        foreach ($years as $year) {
            SchoolYear::factory()->create([
                'author_id' => User::query()->inRandomOrder()->first(),
                'year' => $year,
                'is_current' => $year >= 2023 ? 'yes' : 'no',
            ]);
        }
    }
}
