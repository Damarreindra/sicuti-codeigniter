<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLeavesTable extends Migration
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
            'employee_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'leave_date' => [
                'type' => 'DATE',
            ],
            'reason' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'leave_duration' => [
                'type'       => 'INT',
                'constraint' => 11,
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
        $this->forge->addForeignKey('employee_id', 'employees', 'id');
        $this->forge->createTable('leaves');
    }

    public function down() {}
}
