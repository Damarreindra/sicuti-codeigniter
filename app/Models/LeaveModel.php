<?php

namespace App\Models;

use CodeIgniter\Model;

class LeaveModel extends Model
{
    protected $table          = 'leaves';
    protected $primaryKey     = 'id';
    protected $allowedFields = ['leave_date', 'leave_duration', 'employee_id', 'reason'];

    protected $useTimestamps  = true;
}
