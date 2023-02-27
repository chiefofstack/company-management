<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{   
    use HasFactory;

    protected $guarded = [];

    public function scopeFilter(){
        $companies = Company::where('created_by', '=', auth()->user()->id);

        if (request('search') !== null)
        {   $companies->where(function($query) {
                $query->where('name','like','%'.request('search').'%')
                    ->orWhere('email','like','%'.request('search').'%')
                    ->orWhere('website','like','%'.request('search').'%');
            });
        }
        
        $companies = $companies->latest('updated_at')->paginate(10);    
        return $companies;
    }

    public function creator(){
        return $this->belongsTo(User::class,'created_by');
    }

    public function employees(){
        return $this->hasMany(Employee::class, 'company_id');
    }


    public function path(){
        return "/companies/{$this->id}";
    }
}
