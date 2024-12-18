<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        $data = [];
        for ($i = 0; $i < 50; $i++) {
            $data[] = [
                'nip' => $faker->unique()->numerify('EMP######'),
                'name' => $faker->name(),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'phone_number' => $faker->unique()->phoneNumber(),
                'address' => $faker->address(),
                'date_of_birth' => $faker->date(),
                'created_at' =>
                $faker->dateTimeThisYear()->format('Y-m-d H:i:s'),
                'updated_at' =>
                $faker->dateTimeThisYear()->format('Y-m-d H:i:s'),
            ];
        }

        $this->db->table('employees')->insertBatch($data);
    }
}
