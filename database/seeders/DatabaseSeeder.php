<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Department;
use App\Models\Lesson;
use App\Models\LessonContent;
use App\Models\Permission;
use App\Models\Role;
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
        $this->createRoles();
        $this->createPermissions();
        $this->createUsers();

        $this->attachPermissionsToRoles();
        $this->attachRolesToUsers();

        User::factory()->count(10)->create();
        Department::factory()->count(10)->create();

        $this->attachUsersToDepartments();

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


    }

    private function createRoles(): void
    {
        Role::create(['name' => 'Super Admin', 'slug' => 'super-admin']);
        Role::create(['name' => 'Admin', 'slug' => 'admin']);
        Role::create(['name' => 'Author', 'slug' => 'author']);
        Role::create(['name' => 'User', 'slug' => 'user']);
    }

    private function createPermissions(): void
    {
        Permission::create(['name' => 'Create User', 'slug' => 'create-user']);
        Permission::create(['name' => 'View User', 'slug' => 'view-user']);
        Permission::create(['name' => 'Edit User', 'slug' => 'edit-user']);
        Permission::create(['name' => 'Delete User', 'slug' => 'delete-user']);

        Permission::create(['name' => 'Create Role', 'slug' => 'create-role']);
        Permission::create(['name' => 'View Role', 'slug' => 'view-role']);
        Permission::create(['name' => 'Edit Role', 'slug' => 'edit-role']);
        Permission::create(['name' => 'Delete Role', 'slug' => 'delete-role']);

        Permission::create(['name' => 'Create Permission', 'slug' => 'create-permission']);
        Permission::create(['name' => 'View Permission', 'slug' => 'view-permission']);
        Permission::create(['name' => 'Edit Permission', 'slug' => 'edit-permission']);
        Permission::create(['name' => 'Delete Permission', 'slug' => 'delete-permission']);

    }

    private function createUsers(): void
    {
        $users = [
            ['name' => 'Super', 'email' => 'super@super.com', 'password' => bcrypt('M4rc0nd35')],
            ['name' => 'Admin', 'email' => 'admin@admin.com', 'password' => bcrypt('M4rc0nd35')],
            ['name' => 'Author', 'email' => 'author@author.com', 'password' => bcrypt('M4rc0nd35')],
            ['name' => 'User', 'email' => 'user@user.com', 'password' => bcrypt('M4rc0nd35')],
        ];
        foreach ($users as $userData) {
            $user = User::create($userData);
        }
    }

    private function attachPermissionsToRoles(): void
    {
        $roles = ['super-admin', 'admin', 'author', 'user'];
        $permissions = ['create-user', 'view-user', 'edit-user', 'delete-user', 'create-role', 'view-role', 'edit-role', 'delete-role', 'create-permission', 'view-permission', 'edit-permission', 'delete-permission'];

        foreach ($roles as $roleName) {
            $role = Role::where('slug', $roleName)->first();

            foreach ($permissions as $permissionName) {
                $permission = Permission::where('slug', $permissionName)->first();
                $role->permissions()->attach($permission);
            }
        }
    }

    private function attachRolesToUsers(): void
    {
        $users = ['super@super.com', 'admin@admin.com', 'author@author.com', 'user@user.com'];
        $roles = ['super-admin', 'admin', 'author', 'user'];

        foreach ($users as $index => $userEmail) {
            $user = User::where('email', $userEmail)->first();
            $role = Role::where('slug', $roles[$index])->first();
            $user->roles()->attach($role);
        }
    }

    private function attachUsersToDepartments(): void
    {
        $users = User::all();

        Department::all()->each(function ($department) use ($users) {
            $department->users()->attach(
                $users->random(rand(5, 10))->pluck('id')->toArray()
            );
        });
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
