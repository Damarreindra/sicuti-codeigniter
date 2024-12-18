<?php

namespace App\Controllers;

use App\Models\EmployeeModel;
use App\Models\LeaveModel;
use CodeIgniter\HTTP\Request;

class LeaveController extends BaseController
{
    protected $employeeModel;
    protected $leaveModel;
    public function __construct()
    {
        $this->employeeModel = new EmployeeModel();
        $this->leaveModel = new LeaveModel();
    }
    public function index(): string
    {
        $getName = $this->request->getVar('name');
        $getDate = $this->request->getVar('date');
        $getNip = $this->request->getVar('nip');
        $perPage = 10;
        $currentPage = $this->request->getVar('page') ?? 1;
        $leaves = $this->employeeModel->getLeave($getName, $getDate, $getNip, $perPage, $currentPage);
        $pager = $this->employeeModel->pager;


        $data = [
            'leaves' => $leaves,
            'pager' => $pager,
            'search' => [
                'name' => $getName,
                'nip' => $getNip,
                'date' => $getDate,
            ]
        ];

        return view('leaves/list', $data);
    }

    public function create()
    {

        $getNip = $this->request->getVar('nip');
        $leaves = $this->employeeModel->getLeave(nip: $getNip);
        $employees = $this->employeeModel->findAll();
        $data = [
            'leaves' => $leaves,
            'employees' => $employees
        ];
        return view('leaves/create', $data);
    }

    public function store()
    {

        $ids = $this->request->getPost('selected-ids');
        $leaveDate = $this->request->getPost('leave_date');
        $leaveDuration = $this->request->getPost('leave_duration');
        $reason = $this->request->getPost('reason');

        $validationRules = [
            'selected-ids' => 'required',
            'leave_date' => 'required|valid_date',
            'leave_duration' => 'required|integer',
            'reason' => 'required|max_length[255]',
        ];
        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $idArray = explode(',', $ids);
        $leaveData = [];
        foreach ($idArray as $id) {
            $leaveData[] = [
                'employee_id' => $id,
                'leave_date' => $leaveDate,
                'leave_duration' => $leaveDuration,
                'reason' => $reason
            ];
        }
        if ($this->leaveModel->insertBatch($leaveData)) {
            return redirect()->to('/leave')->with('success', 'Leave request submitted successfully.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Failed to submit leave request.');
        }
    }
}
