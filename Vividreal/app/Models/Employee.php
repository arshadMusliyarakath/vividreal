<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $primaryKey = 'employee_id';
    protected $guarded =[];

    public function company(){
        return  $this->hasOne(Company::class, 'company_id', 'company_id');
    }
    

}
