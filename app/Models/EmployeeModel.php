<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model
{
    protected $table          = 'employees';
    protected $primaryKey     = 'id';
    protected $allowedFields = ['nip', 'name', 'gender', 'phone_number', 'address', 'date_of_birth'];


    protected $useTimestamps      = true;

    public function generateNIP()
    {
        $lastEmployee = $this->orderBy('id', 'DESC')->first();

        if ($lastEmployee) {

            $lastNip = (int) substr($lastEmployee['nip'], 3);
            $newNip = $lastNip + 1;
        } else {
            $newNip = 1;
        }

        return 'EMP' . str_pad($newNip, 4, '0', STR_PAD_LEFT);
    }

    public function getLeave(?string $name = null, ?string $date = null, ?string $nip = null, $perPage, $currentPage)
    {
        $query = $this->select("employees.*, leaves.*")
            ->join("leaves", "employee_id = employees.id");
        if (!empty($name)) {
            $query->like('name', $name);
        }
        if (!empty($date)) {
            $query->where('leave_date', $date);
        }
        if (!empty($nip)) {
            $query->like('nip', $nip);
        }

        return $query->paginate($perPage, 'default', $currentPage);
    }
}
