<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            ['name' => 'Create User', 'slug' => 'create-user'],
            ['name' => 'View Any User', 'slug' => 'view-any-user'],
            ['name' => 'View User', 'slug' => 'view-user'],
            ['name' => 'Update User', 'slug' => 'update-user'],
            ['name' => 'Delete User', 'slug' => 'delete-user'],
            ['name' => 'Restore User', 'slug' => 'restore-user'],
            ['name' => 'Force Delete User', 'slug' => 'force-delete-user'],
            ['name' => 'Delete Any User', 'slug' => 'delete-any-user'],
            ['name' => 'Restore Any User', 'slug' => 'restore-any-user'],
            ['name' => 'Force Delete Any User', 'slug' => 'force-delete-any-user'],

            ['name' => 'Create Role', 'slug' => 'create-role'],
            ['name' => 'View Any Role', 'slug' => 'view-any-role'],
            ['name' => 'View Role', 'slug' => 'view-role'],
            ['name' => 'Update Role', 'slug' => 'update-role'],
            ['name' => 'Delete Role', 'slug' => 'delete-role'],
            ['name' => 'Restore Role', 'slug' => 'restore-role'],
            ['name' => 'Force Delete Role', 'slug' => 'force-delete-role'],
            ['name' => 'Delete Any Role', 'slug' => 'delete-any-role'],

            ['name' => 'Create Permission', 'slug' => 'create-permission'],
            ['name' => 'View Any Permission', 'slug' => 'view-any-permission'],
            ['name' => 'View Permission', 'slug' => 'view-permission'],
            ['name' => 'Update Permission', 'slug' => 'update-permission'],
            ['name' => 'Delete Permission', 'slug' => 'delete-permission'],
            ['name' => 'Restore Permission', 'slug' => 'restore-permission'],
            ['name' => 'Force Delete Permission', 'slug' => 'force-delete-permission'],
            ['name' => 'Delete Any Permission', 'slug' => 'delete-any-permission'],
            ['name' => 'Restore Any Permission', 'slug' => 'restore-any-permission'],
            ['name' => 'Force Delete Any Permission', 'slug' => 'force-delete-any-permission'],

            ['name' => 'Create Department', 'slug' => 'create-department'],
            ['name' => 'View Any Department', 'slug' => 'view-any-department'],
            ['name' => 'View Department', 'slug' => 'view-department'],
            ['name' => 'Update Department', 'slug' => 'update-department'],
            ['name' => 'Delete Department', 'slug' => 'delete-department'],
            ['name' => 'Restore Department', 'slug' => 'restore-department'],
            ['name' => 'Force Delete Department', 'slug' => 'force-delete-department'],
            ['name' => 'Delete Any Department', 'slug' => 'delete-any-department'],
            ['name' => 'Restore Any Department', 'slug' => 'restore-any-department'],
            ['name' => 'Force Delete Any Department', 'slug' => 'force-delete-any-department'],

            ['name' => 'Create School Year', 'slug' => 'create-school-year'],
            ['name' => 'View Any School Year', 'slug' => 'view-any-school-year'],
            ['name' => 'View School Year', 'slug' => 'view-school-year'],
            ['name' => 'Update School Year', 'slug' => 'update-school-year'],
            ['name' => 'Delete School Year', 'slug' => 'delete-school-year'],
            ['name' => 'Restore School Year', 'slug' => 'restore-school-year'],
            ['name' => 'Force Delete School Year', 'slug' => 'force-delete-school-year'],
            ['name' => 'Delete Any School Year', 'slug' => 'delete-any-school-year'],
            ['name' => 'Restore Any School Year', 'slug' => 'restore-any-school-year'],
            ['name' => 'Force Delete Any School Year', 'slug' => 'force-delete-any-school-year'],

            ['name' => 'Create Subject', 'slug' => 'create-subject'],
            ['name' => 'View Any Subject', 'slug' => 'view-any-subject'],
            ['name' => 'View Subject', 'slug' => 'view-subject'],
            ['name' => 'Update Subject', 'slug' => 'update-subject'],
            ['name' => 'Delete Subject', 'slug' => 'delete-subject'],
            ['name' => 'Restore Subject', 'slug' => 'restore-subject'],
            ['name' => 'Force Delete Subject', 'slug' => 'force-delete-subject'],
            ['name' => 'Delete Any Subject', 'slug' => 'delete-any-subject'],
            ['name' => 'Restore Any Subject', 'slug' => 'restore-any-subject'],
            ['name' => 'Force Delete Any Subject', 'slug' => 'force-delete-any-subject'],

            ['name' => 'Create School Grade', 'slug' => 'create-school-grade'],
            ['name' => 'View Any School Grade', 'slug' => 'view-any-school-grade'],
            ['name' => 'View School Grade', 'slug' => 'view-school-grade'],
            ['name' => 'Update School Grade', 'slug' => 'update-school-grade'],
            ['name' => 'Delete School Grade', 'slug' => 'delete-school-grade'],
            ['name' => 'Restore School Grade', 'slug' => 'restore-school-grade'],
            ['name' => 'Force Delete School Grade', 'slug' => 'force-delete-school-grade'],
            ['name' => 'Delete Any School Grade', 'slug' => 'delete-any-school-grade'],
            ['name' => 'Restore Any School Grade', 'slug' => 'restore-any-school-grade'],
            ['name' => 'Force Delete Any School Grade', 'slug' => 'force-delete-any-school-grade'],

            ['name' => 'Create Course', 'slug' => 'create-course'],
            ['name' => 'View Any Course', 'slug' => 'view-any-course'],
            ['name' => 'View Course', 'slug' => 'view-course'],
            ['name' => 'Update Course', 'slug' => 'update-course'],
            ['name' => 'Delete Course', 'slug' => 'delete-course'],
            ['name' => 'Restore Course', 'slug' => 'restore-course'],
            ['name' => 'Force Delete Course', 'slug' => 'force-delete-course'],
            ['name' => 'Delete Any Course', 'slug' => 'delete-any-course'],
            ['name' => 'Restore Any Course', 'slug' => 'restore-any-course'],
            ['name' => 'Force Delete Any Course', 'slug' => 'force-delete-any-course'],

            ['name' => 'Create Course Category', 'slug' => 'create-course-category'],
            ['name' => 'View Any Course Category', 'slug' => 'view-any-course-category'],
            ['name' => 'View Course Category', 'slug' => 'view-course-category'],
            ['name' => 'Update Course Category', 'slug' => 'update-course-category'],
            ['name' => 'Delete Course Category', 'slug' => 'delete-course-category'],
            ['name' => 'Restore Course Category', 'slug' => 'restore-course-category'],
            ['name' => 'Force Delete Course Category', 'slug' => 'force-delete-course-category'],
            ['name' => 'Delete Any Course Category', 'slug' => 'delete-any-course-category'],
            ['name' => 'Restore Any Course Category', 'slug' => 'restore-any-course-category'],
            ['name' => 'Force Delete Any Course Category', 'slug' => 'force-delete-any-course-category'],

            ['name' => 'Create Lesson', 'slug' => 'create-lesson'],
            ['name' => 'View Any Lesson', 'slug' => 'view-any-lesson'],
            ['name' => 'View Lesson', 'slug' => 'view-lesson'],
            ['name' => 'Update Lesson', 'slug' => 'update-lesson'],
            ['name' => 'Delete Lesson', 'slug' => 'delete-lesson'],
            ['name' => 'Restore Lesson', 'slug' => 'restore-lesson'],
            ['name' => 'Force Delete Lesson', 'slug' => 'force-delete-lesson'],
            ['name' => 'Delete Any Lesson', 'slug' => 'delete-any-lesson'],
            ['name' => 'Restore Any Lesson', 'slug' => 'restore-any-lesson'],
            ['name' => 'Force Delete Any Lesson', 'slug' => 'force-delete-any-lesson'],

            ['name' => 'Create Lesson Content', 'slug' => 'create-lesson-content'],
            ['name' => 'View Any Lesson Content', 'slug' => 'view-any-lesson-content'],
            ['name' => 'View Lesson Content', 'slug' => 'view-lesson-content'],
            ['name' => 'Update Lesson Content', 'slug' => 'update-lesson-content'],
            ['name' => 'Delete Lesson Content', 'slug' => 'delete-lesson-content'],
            ['name' => 'Restore Lesson Content', 'slug' => 'restore-lesson-content'],
            ['name' => 'Force Delete Lesson Content', 'slug' => 'force-delete-lesson-content'],
            ['name' => 'Delete Any Lesson Content', 'slug' => 'delete-any-lesson-content'],
            ['name' => 'Restore Any Lesson Content', 'slug' => 'restore-any-lesson-content'],
            ['name' => 'Force Delete Any Lesson Content', 'slug' => 'force-delete-any-lesson-content'],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
