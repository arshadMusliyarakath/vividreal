<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{

    public function employees(){
        return view('employee.employees');
    }
    public function addEmployee(){
        $companies = Company::select('company_id', 'name')->get();
        return view('employee.add', compact('companies'));
    }
    public function doAddEmployee(Request $request){
        $data = $request->except('_token');
        Employee::create($data);
        return redirect()->route('employees');    
    }

    public function employeeData()
    {
        $data = Employee::all();
        return DataTables::of($data)
            ->addColumn('action', function ($row) {
                return '<a href="' . route("employee.edit",encrypt($row->employee_id) ) . '" class="btn btn-primary">Edit</a>  <a href="' . route("employee.delete",encrypt($row->employee_id) ) . '" class="btn btn-danger">Delete</a>';
            })
            ->addColumn('company_name', function ($employee) {
                return $employee->company->name; 
            })
            ->make(true);
    }

    public function editEmployee($employee_id){
        $employee = Employee::find(decrypt($employee_id));
        $companies = Company::select('company_id', 'name')->get();
        return view('employee.edit', compact('employee', 'companies'));
    }


    public function doEditEmployee(Request $request){

        $employee_id = $request->input('employee_id');
        $company = Employee::find($employee_id);
        $data = $request->except('_token');
        $company->update($data);
        return redirect()->route('employees');    
    }

    public function deleteEmployee($employee_id){
        $employee = Employee::find(decrypt($employee_id))->delete();
        return redirect()->route('employees');    
    }

}
