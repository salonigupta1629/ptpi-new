<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Teacher;
use App\Models\TeachersAddress;
use App\Models\TeacherQualification;
use App\Models\TeacherExperience;
use App\Models\TeacherSkill;
use App\Models\TeacherSubject;
use App\Models\TeacherClassCategory;
use App\Models\Subject;
use App\Models\ClassCategory;
use App\Models\EducationalQualification;
use App\Models\Skill;
use App\Models\Role;
use App\Models\TeacherJobType;
use App\Models\Level;
use App\Models\TeacherExperiences;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all required data from the database
        $subjects = Subject::all();
        $classCategories = ClassCategory::all();
        $qualifications = EducationalQualification::all();
        $skills = Skill::all();
        $roles = Role::all();
        $jobTypes = TeacherJobType::all();
        $levels = Level::all();

        // Create 30 teachers
        for ($i = 0; $i < 30; $i++) {
            // Create user first
            $user = User::create([
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Create teacher profile
            $teacher = Teacher::create([
                'user_id' => $user->id,
                'gender' => fake()->randomElement(['Female', 'Male', 'Other']),
                'religion' => fake()->randomElement(['Hindu', 'Muslim', 'Christian', 'Sikh', 'Other']),
                'nationality' => 'Indian',
                'image' => null,
                'aadhar_no' => fake()->numerify('##########'),
                'phone' => fake()->numerify('9##########'),
                'language' => 'hindi',
                'verified' => fake()->boolean(80), // 80% chance of being verified
                'rating' => fake()->randomFloat(2, 3, 5),
                'date_of_birth' => fake()->dateTimeBetween('-50 years', '-22 years')->format('Y-m-d'),
                'marital_status' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Create addresses (current and permanent)
            TeachersAddress::create([
                'user_id' => $user->id,
                'address_type' => 'current',
                'state' => 'Bihar',
                'division' => fake()->randomElement(['Patna', 'Tirhut', 'Saran', 'Darbhanga', 'Kosi', 'Purnia', 'Bhagalpur', 'Munger', 'Magadh']),
                'district' => fake()->city(),
                'block' => fake()->streetName(),
                'village' => fake()->streetName(),
                'area' => fake()->address(),
                'pincode' => fake()->numberBetween(800000, 855999), // FIXED: 6-digit pincodes only
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            TeachersAddress::create([
                'user_id' => $user->id,
                'address_type' => 'permanent',
                'state' => 'Bihar',
                'division' => fake()->randomElement(['Patna', 'Tirhut', 'Saran', 'Darbhanga', 'Kosi', 'Purnia', 'Bhagalpur', 'Munger', 'Magadh']),
                'district' => fake()->city(),
                'block' => fake()->streetName(),
                'village' => fake()->streetName(),
                'area' => fake()->address(),
                'pincode' => fake()->numberBetween(800000, 855999), // FIXED: 6-digit pincodes only
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Create qualifications (1-3 per teacher)
            $qualificationCount = fake()->numberBetween(1, 3);
            for ($j = 0; $j < $qualificationCount; $j++) {
                TeacherQualification::create([
                    'user_id' => $user->id,
                    'qualification_id' => $qualifications->random()->id,
                    'institution' => fake()->company(),
                    'board_or_university' => 'basb',
                    'session' => '2020-2023',
                    'subjects' => json_encode([
                        ['name' => 'Science', 'marks' => 75],
                        ['name' => 'Math', 'marks' => 88],
                        ['name' => 'English', 'marks' => 92],
                    ]),
                    'year_of_passing' => fake()->numberBetween(1990, 2023),
                    'grade_or_percentage' => fake()->randomElement(['A', 'B', 'C', 'First Class', 'Second Class']) . ' (' . fake()->numberBetween(60, 95) . '%)',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Create experiences (0-4 per teacher)
            $experienceCount = fake()->numberBetween(0, 4);
            for ($j = 0; $j < $experienceCount; $j++) {
                $startDate = fake()->dateTimeBetween('-10 years', '-1 year');
                $endDate = fake()->dateTimeBetween($startDate, 'now');

                TeacherExperiences::create([
                    'user_id' => $user->id,
                    'role_id' => $roles->random()->id,
                    'institution' => fake()->company(),
                    'start_date' => $startDate->format('Y-m-d'),
                    'end_date' => $endDate->format('Y-m-d'),
                    'description' => fake()->paragraph(),
                    'achievements' => fake()->sentence(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            $availableSkillCount = $skills->count();
            $skillCount = min(fake()->numberBetween(2, 5), $availableSkillCount);
            $selectedSkills = $skills->random($skillCount);
            foreach ($selectedSkills as $skill) {
                TeacherSkill::create([
                    'user_id' => $user->id,
                    'skill_id' => $skill->id,
                    'proficiency_level' => fake()->randomElement(['Beginner', 'Intermediate', 'Advanced', 'Expert']),
                    'years_of_experience' => fake()->numberBetween(1, 10),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Create subjects (1-3 per teacher)
            $subjectCount = fake()->numberBetween(1, 3);
            $selectedSubjects = $subjects->random($subjectCount);
            foreach ($selectedSubjects as $subject) {
                TeacherSubject::create([
                    'user_id' => $user->id,
                    'subject_id' => $subject->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Create class categories (1-3 per teacher)
            $classCategoryCount = fake()->numberBetween(1, 3);
            $selectedClassCategories = $classCategories->random($classCategoryCount);
            foreach ($selectedClassCategories as $classCategory) {
                TeacherClassCategory::create([
                    'user_id' => $user->id,
                    'class_category_id' => $classCategory->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
