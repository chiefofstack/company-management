<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeFilter(){
        $employees = Employee::with('creator')->where('created_by', '=', auth()->user()->id);

        if (request('search') !== null)
        {   $employees->where(function($query) {
                $query->where('first_name','like','%'.request('search').'%')
                    ->orWhere('last_name','like','%'.request('search').'%')
                    ->orWhere('email','like','%'.request('search').'%')
                    ->orWhere('phone_number','like','%'.request('search').'%');
            });
        }
        
        $employees = $employees->latest('updated_at')->paginate(10);    
        return $employees;
    }

    public function creator(){
        return $this->belongsTo(User::class,'created_by');
    }

    public function company(){
        return $this->belongsTo(Company::class,'company_id');
    }

    public function path(){
        return "/employees/{$this->id}";
    }
}
