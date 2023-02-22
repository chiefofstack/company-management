<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;

class CompanyController extends Controller
{
    public function index(){
    
        $companies = Company::all();
    
        return view('companies.index', compact('companies'));
    }
    public function show(Company $company){
    
        //$company = Company::findOrFail(request('company'));
    
        return view('companies.show', compact('company'));
    }

    public function store(){
        //validate
        $attributes = request()->validate([
            'name' => ['required','max:255'],
            'email' => ['required','max:255'],
            'logo' => ['required','max:255'],
            'website' => ['required','max:255']
            // 'name' => ['required','max:255'],
            // 'email' => ['nullable','email:rfc,dns','max:255'],
            // 'logo' => ['nullable','image','dimensions:min_width=100,min_height=100','max:1024'],
            // 'website' => ['nullable','url','max:255']
        ]);

        //persist
        Company::create($attributes);

        //redirect
        return redirect('/companies');
    }
}
