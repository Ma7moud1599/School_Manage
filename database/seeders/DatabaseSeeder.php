<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    use WithoutModelEvents;

    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(GradeSeeder::class);
        $this->call(ClassroomSeeder::class);
        $this->call(SectionsSeeder::class);
        $this->call(BloodTableSeeder::class);
        $this->call(NationalitySeeder::class);
        $this->call(ReligionSeeder::class);
        $this->call(SpecializationSeeder::class);
        $this->call(GenderSeeder::class);
        $this->call(ParentsSeeder::class);
        $this->call(SettingsTableSeeder::class);
    }
}
