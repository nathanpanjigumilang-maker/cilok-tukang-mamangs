<?php

namespace Database\Seeders;

use App\Models\ClassModel;
use App\Models\Student;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create Classes
        $classes = [
            ['name' => 'X IPA 1', 'grade' => '10', 'description' => 'Kelas IPA 1'],
            ['name' => 'X IPA 2', 'grade' => '10', 'description' => 'Kelas IPA 2'],
            ['name' => 'XI IPA 1', 'grade' => '11', 'description' => 'Kelas IPA 1'],
        ];

        foreach ($classes as $class) {
            ClassModel::create($class);
        }

        // Create Students
        $students = [
            ['class_id' => 1, 'nis' => '1001', 'name' => 'Ahmad Rizki', 'email' => 'ahmad@email.com', 'birth_date' => '2007-01-15', 'address' => 'Jl. Merdeka No. 1'],
            ['class_id' => 1, 'nis' => '1002', 'name' => 'Siti Aminah', 'email' => 'siti@email.com', 'birth_date' => '2007-03-20', 'address' => 'Jl. Sudirman No. 2'],
            ['class_id' => 2, 'nis' => '1003', 'name' => 'Budi Santoso', 'email' => 'budi@email.com', 'birth_date' => '2007-02-10', 'address' => 'Jl. Gatot Subroto No. 3'],
        ];

        foreach ($students as $student) {
            Student::create($student);
        }
    }
}