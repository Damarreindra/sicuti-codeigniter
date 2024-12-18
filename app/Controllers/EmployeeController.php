<?php

namespace App\Controllers;

use App\Models\EmployeeModel;
use CodeIgniter\HTTP\Request;

class EmployeeController extends BaseController
{
    protected $employeeModel;
    public function __construct()
    {
        $this->employeeModel = new EmployeeModel();
    }
    public function index(): string
    {
        $perPage = 10;
        $currentPage = $this->request->getVar('page') ?? 1;
        $getName = $this->request->getVar('name');
        $getNip = $this->request->getVar('nip');
        if (!empty($getName)) {
            $employees = $this->employeeModel
                ->like('name', $getName)
                ->paginate($perPage, 'default', $currentPage);
        } else if (!empty($getNip)) {
            $employees = $this->employeeModel
                ->like('nip', $getNip)
                ->paginate($perPage, 'default', $currentPage);
        } else {
            $employees = $this->employeeModel->paginate($perPage, 'default', $currentPage);
        }


        $pager = $this->employeeModel->pager;

        $data = [
            "employees" => $employees,
            "pager" => $pager,
        ];
        return view('employees/list', $data);
    }

    public function create()
    {
        return view('employees/create');
    }

    public function store()
    {
        if (!$this->validate([
            'name' => 'required|min_length[3]|max_length[100]|string',
            'gender' => 'required|in_list[male,female]',
            'phone' => 'required|min_length[10]|max_length[15]|regex_match[/^[0-9]+$/]',
            'address' => 'required|min_length[5]',
            'dob' => 'required|valid_date[Y-m-d]',

        ])) {

            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $data = [
            'nip' => $this->employeeModel->generateNIP(),
            'name' => $this->request->getPost('name'),
            'gender' => $this->request->getPost('gender'),
            'phone_number' => $this->request->getPost('phone'),
            'address' => $this->request->getPost('address'),
            'date_of_birth' => $this->request->getPost('dob'),
        ];
        $this->employeeModel->insert($data);
        return redirect()->to('/')->with('success', 'Employee Added Successfully');
    }
}
