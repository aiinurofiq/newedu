<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => \Hash::make('admin'),
            ]);
        $this->call(PermissionsSeeder::class);

        // $this->call(AnswerSeeder::class);
        // $this->call(AwardSeeder::class);
        // $this->call(BloodtypeSeeder::class);
        // $this->call(BumnclassSeeder::class);
        // $this->call(BumnsectorSeeder::class);
        // $this->call(CategorySeeder::class);
        // $this->call(CategorylearnSeeder::class);
        // $this->call(CitySeeder::class);
        // $this->call(CouponSeeder::class);
        // $this->call(DivisionSeeder::class);
        // $this->call(EducationSeeder::class);
        // $this->call(EduhistorySeeder::class);
        // $this->call(ExplanationSeeder::class);
        // $this->call(ExsumSeeder::class);
        // $this->call(FieldofpositionSeeder::class);
        // $this->call(GenderSeeder::class);
        // $this->call(InterestSeeder::class);
        // $this->call(JurnalSeeder::class);
        // $this->call(KidSeeder::class);
        // $this->call(KnowledgeSeeder::class);
        // $this->call(LearningSeeder::class);
        // $this->call(LpaymentSeeder::class);
        // $this->call(LTransactionSeeder::class);
        // $this->call(MaritalSeeder::class);
        // $this->call(ModuleSeeder::class);
        // $this->call(OrganizationSeeder::class);
        // $this->call(PositionSeeder::class);
        // $this->call(QuestionSeeder::class);
        // $this->call(QuizSeeder::class);
        // $this->call(ReligionSeeder::class);
        // $this->call(ReportSeeder::class);
        // $this->call(ReqknowledgeSeeder::class);
        // $this->call(ReqknowstatSeeder::class);
        // $this->call(SectionSeeder::class);
        // $this->call(SocialSeeder::class);
        // $this->call(SpeakerSeeder::class);
        // $this->call(TopicSeeder::class);
        // $this->call(TribeSeeder::class);
        // $this->call(UniversitySeeder::class);
        // $this->call(UserSeeder::class);
        // $this->call(ValvisionSeeder::class);
        // $this->call(WifhusSeeder::class);
    }
}
