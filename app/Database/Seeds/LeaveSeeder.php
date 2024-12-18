<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class LeaveSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        $data = [];
        for ($i = 0; $i < 50; $i++) {
            $data[] = [
                'employee_id'   => $faker->numberBetween(1, 50),
                'leave_date'    => $faker->date(),
                'leave_duration' => $faker->numberBetween(1, 10),
                'created_at'    => $faker->dateTimeThisYear()->format('Y-m-d H:i:s'),
                'updated_at'    => $faker->dateTimeThisYear()->format('Y-m-d H:i:s'),
            ];
        }

        $this->db->table('leaves')->insertBatch($data);
    }
}
