<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEmployeesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nip' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'unique'     => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'gender' => [
                'type' =>   'ENUM',
                'constraint' => ['Male', 'Female'],
                'null'       => false,
            ],
            'phone_number' => [
                'type' => 'VARCHAR',
                'constraint' => 15,
                'unique' => true,
                'null'       => false,
            ],
            'address' => [
                "type" => 'TEXT',
                'null'       => false,
            ],
            'date_of_birth' => [
                'type'       => 'DATE',
                'null'       => true,
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('employees');
    }



    public function down()
    {
        $this->forge->dropTable('employees');
    }
}
