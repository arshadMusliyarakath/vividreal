<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $primaryKey = 'company_id';
    protected $guarded =[];

    public function getlogoUrlAttribute(){
        return url('/storage/logos/'.$this->logo);
    }
    protected $appends = ['logoUrl'];
}
