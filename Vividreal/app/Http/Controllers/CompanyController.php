<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CompanyController extends Controller
{

    public function companies(){
        return view('company.companies');
    }
    public function addCompany(){
        return view('company.add');
    }
    public function doAddCompany(Request $request){
        $data = $request->except('_token');

        $rules = [
            'logo' => 'image|mimes:jpeg,jpg,png|dimensions:min_width=100,min_height=100',
        ];
    
        $validator = Validator::make($data, $rules);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        if($request->hasFile('logo')){
            $image = $request->file('logo');
            $imageName = time() . '.' . $image->extension();
            $image->move(storage_path('app/public/logos'), $imageName);
            $data['logo'] = $imageName;
        }
        Company::create($data);
        return redirect()->route('companies');    
    }

    public function companyData()
    {
        $data = Company::all();
        return DataTables::of($data)
            ->addColumn('action', function ($row) {
                return '<a href="' . route("company.edit",encrypt($row->company_id) ) . '" class="btn btn-primary">Edit</a>  <a href="' . route("company.delete",encrypt($row->company_id) ) . '" class="btn btn-danger">Delete</a>';
            })
            ->make(true);
    }

    public function editCompany($company_id){
        $company = Company::find(decrypt($company_id));
        return view('company.edit', compact('company'));
    }


    public function doEditCompany(Request $request){

        $company_id = $request->input('company_id');
        $company = Company::find($company_id);
        $data = $request->except('_token');

        $rules = [
            'logo' => 'image|mimes:jpeg,jpg,png|dimensions:min_width=100,min_height=100',
        ];
    
        $validator = Validator::make($data, $rules);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        if($request->hasFile('logo')){

            if ($company->logo) {
                Storage::delete('public/logos/' . $company->logo);
            }
            
            $image = $request->file('logo');
            $imageName = time() . '.' . $image->extension();
            $image->move(storage_path('app/public/logos'), $imageName);
            $data['logo'] = $imageName;
        }
        else
        {
            $data['logo'] = $company->logo;
        }

        $company->update($data);
        return redirect()->route('companies');    
    }

    public function deleteCompany($company_id){
        $company = Company::find(decrypt($company_id))->delete();
        return redirect()->route('companies');    
    }

}
