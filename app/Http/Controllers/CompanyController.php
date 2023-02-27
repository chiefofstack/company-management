<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateCompany;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Employee;

class CompanyController extends Controller
{
    /**
     * View all companies.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $companies = Company::filter();
        
        return view('companies.index', compact('companies'));
    }

    /**
     * Show a single company.
     *
     * @param Company $company
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Company $company)
    {   // if logged in user not the owner of the company, show error
        if(auth()->user()->id != $company->created_by){
            abort(403);
        }    

        //$company = Company::findOrFail(request('company'));
        $companyEmployees = Employee::where('created_by', '=', auth()->user()->id)
                                    ->where('company_id', '=', $company->id)
                                    ->latest('updated_at')->paginate(10);   
    
        return view('companies.show', compact('company'))->with('employees', $companyEmployees);
    }

    /**
     * Create a new company.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
    }

    
    /**
     * Persist a new company.
     *
     * @return mixed
     */
    public function store(ValidateCompany $request)
    {
        $attributes = $request->validated();

        if ($attributes['logo'] ?? false) {
            $attributes['logo'] = basename(request()->file('logo')->store('public/uploaded/logos'));
        }

        
        //persist
        $company = auth()->user()->companies()->create($attributes); //switch to middleware approach

        //redirect
        return redirect(route('companies.index'))->with('success', 'Company '.ucwords($company->name).' has been created');
    }

    /**
     * Edit the company.
     *
     * @param  Company $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }
\
    /**
     * Update the company.
     *
     * @param  Company $company
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Company $company, ValidateCompany $request)
    {   // if logged in user not the owner of the company, show error
        if(auth()->user()->id != $company->created_by){
            abort(403);
        }    

        $attributes = $request->validated();
        if ($attributes['logo'] ?? false) {
            $attributes['logo'] = basename(request()->file('logo')->store('public/uploaded/logos'));
        }

        $company->update($attributes);

        return redirect(route('companies.index'))->with('success', 'Company '.ucwords($company->name).' has been updated');
    }

    /**
     * Destroy the company.
     *
     * @param  Company $company
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Company $company)
    {
        // if logged in user not the owner of the company, show error
        if(auth()->user()->id != $company->created_by){
            abort(403);
        }

        $company->delete();

        return redirect('/companies')->with('success', 'Company '.ucwords($company->name).' has been deleted');;
    }

 
}

