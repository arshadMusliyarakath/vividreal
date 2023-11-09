<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function login()
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        $validator = Validator::make(request()->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400, 
                'errors' => $validator->errors(),
            ]);
        }

        $user = User::where('email', request('email'))->first();
        if ($user) {
            if (Hash::check(request('password'), $user->password)) {
                $token = $user->createToken('api')->plainTextToken;
                $data = [
                    'status' => 200,
                    'token' => $token,
                    'message' => 'Api Token Created Successfully',
                ];
            } else {
                $data = [
                    'status' => 400,
                    'message' => 'Invalid Password',
                ];
            }
        } else {
            $data = [
                'status' => 400,
                'message' => 'Invalid Credentials',
            ];
        }

        return response()->json($data);
    }

    public function logout(){
        $userId = auth()->user()->user_id;
        $user = User::find($userId);
        $user->tokens()->delete();
        $data = [
            'status' => 200,
            'message' => 'User Logout Successfully',
        ];
        return response()->json($data);
    }

    

    public function allEmployees(){
        $employees = Employee::all();
        $data = [
            'status' => 200,
            'data' => $employees,
            'message' => 'Fetched all employees'
        ];
        return response()->json($data);
    }

    public function employee(){
        $rules = [
            'employee_id' => 'required|numeric'
        ];

        $validator = Validator::make(request()->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400, 
                'errors' => $validator->errors(),
            ]);
        }
        $employee = Employee::find(request('employee_id'));
        if(isset($employee)){
            $data = [
                'status' => 200,
                'data' => $employee,
            ];
        }
        else{
            $data = [
                'status' => 400,
                'message' => "Invalid Employee"
            ];
        }
        
        return response()->json($data);
    }


    public function addEmployee(){
        $rules = [
            'fname' => 'required',
            'lname' => 'required',
            'company_id' => 'required|numeric',
            'email' => 'required|email',
            'phone' => 'required|numeric',
        ];

        $validator = Validator::make(request()->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400, 
                'errors' => $validator->errors(),
            ]);
        }

        $company_id = request('company_id');
        $company = Company::find($company_id);
        if(isset($company)){
            Employee::create(request()->all());
            $data = [
                'status' => 200,
                'message' => "Employee Added Successfully"
            ];
        }
        else{
            $data = [
                'status' => 400,
                'message' => "Invalid Company"
            ];
        }

        return response()->json($data);
    }


    public function editEmployee(){
        $rules = [
            'employee_id' => 'required|numeric',
            'fname' => 'required',
            'lname' => 'required',
            'company_id' => 'required|numeric',
            'email' => 'required|email',
            'phone' => 'required|numeric',
        ];

        $validator = Validator::make(request()->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400, 
                'errors' => $validator->errors(),
            ]);
        }

        $employee = Employee::find(request('employee_id'));
        if(isset($employee)){
            $company = Company::find(request('company_id'));
            if(isset($company)){
                $data = [
                    'status' => 200,
                    'message' => "Employee Updated Successfully"
                ];
                $employee->update(request()->all());
            }
            else{
                $data = [
                    'status' => 400,
                    'message' => "Invalid Company"
                ];
            }
            
        }
        else{
            $data = [
                'status' => 400,
                'message' => "Invalid Employee"
            ];
        }

        return response()->json($data);
    }


    public function deleteEmployee(){
        $rules = [
            'employee_id' => 'required|numeric',
        ];

        $validator = Validator::make(request()->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400, 
                'errors' => $validator->errors(),
            ]);
        }

        $employee = Employee::find(request('employee_id'));
        if(isset($employee)){
            $employee->delete();
            $data = [
                'status' => 200,
                'message' => "Employee Deleted Successfully!"
            ];
        }
        else{
            $data = [
                'status' => 400,
                'message' => "Invalid Employee"
            ];
        }
        
        return response()->json($data);
    }


    public function allCompanies(){
        $companies = Company::all();
        $data = [
            'status' => 200,
            'data' => $companies,
            'message' => 'Fetched all companies'
        ];
        return response()->json($data);
    }

    public function company(){
        $rules = [
            'company_id' => 'required|numeric'
        ];

        $validator = Validator::make(request()->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400, 
                'errors' => $validator->errors(),
            ]);
        }
        $company = Company::find(request('company_id'));
        if(isset($company)){
            $data = [
                'status' => 200,
                'data' => $company,
            ];
        }
        else{
            $data = [
                'status' => 400,
                'message' => "Invalid Company"
            ];
        }
        
        return response()->json($data);
    }


    public function addCompany(){
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'logo' => 'required|image|dimensions:min_width=100,min_height=100',
            'website' => 'required',
        ];

        $validator = Validator::make(request()->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400, 
                'errors' => $validator->errors(),
            ]);
        }

        $insertData = request()->all();

        if(request()->hasFile('logo')){
            $image = request()->file('logo');
            $imageName = time() . '.' . $image->extension();
            $image->move(storage_path('app/public/logos'), $imageName);
            $insertData['logo'] = $imageName;
        }

        Company::create($insertData);
        $data = [
            'status' => 200,
            'message' => "Company Added Successfully"
        ];

        return response()->json($data);
    }


    public function editCompany(){
        $rules = [
            'company_id' => 'required|numeric',
            'name' => 'required',
            'email' => 'required|email',
            'logo' => 'image|dimensions:min_width=100,min_height=100',
            'website' => 'required',
        ];

        $validator = Validator::make(request()->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400, 
                'errors' => $validator->errors(),
            ]);
        }

        $insertData = request()->all();

        $company = Company::find(request('company_id'));
        if(isset($company)){
            if(request()->hasFile('logo')){

                if ($company->logo) {
                    Storage::delete('public/logos/' . $company->logo);
                }

                $image = request()->file('logo');
                $imageName = time() . '.' . $image->extension();
                $image->move(storage_path('app/public/logos'), $imageName);
                $insertData['logo'] = $imageName;
            }
            else{
                $insertData['logo'] = $company->logo;
            }
            $company->update($insertData);
            $data = [
                'status' => 200,
                'message' => "Company Updated Successfully"
            ];
        }
        else{
            $data = [
                'status' => 400,
                'message' => "Invalid Employee"
            ];
        }

        return response()->json($data);
    }


    public function deleteCompany(){
        $rules = [
            'company_id' => 'required|numeric',
        ];

        $validator = Validator::make(request()->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400, 
                'errors' => $validator->errors(),
            ]);
        }

        $company = Company::find(request('company_id'));
        if(isset($company)){
            Employee::where('company_id', request('company_id'))->delete();
            $company->delete();
            $data = [
                'status' => 200,
                'message' => "Company and worked Employees are Deleted!"
            ];
        }
        else{
            $data = [
                'status' => 400,
                'message' => "Invalid Company"
            ];
        }
        
        return response()->json($data);
    }

}
