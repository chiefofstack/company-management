<?php

namespace App\Http\Controllers;

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
    public function store()
    {
        //persist
        $company = auth()->user()->companies()->create($this->validateRequest()); //switch to middleware approach

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

    /**
     * Update the company.
     *
     * @param  Company $company
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Company $company)
    {   // if logged in user not the owner of the company, show error
        if(auth()->user()->id != $company->created_by){
            abort(403);
        }    

        $company->update($this->validateRequest());

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


    /**
     * Validate Requests
     */
    public function validateRequest(){
        //validate
        return request()->validate([
            'name' => ['required','max:255'],
            'email' => ['nullable','max:255'],
            'logo' => ['nullable','max:255'],
            'website' => ['nullable','max:255'],
            // 'name' => ['required','max:255'],
            // 'email' => ['nullable','email:rfc,dns','max:255'],
            // 'logo' => ['nullable','image','dimensions:min_width=100,min_height=100','max:1024'],
            // 'website' => ['nullable','url','max:255'],
            // 'created_by' => ['required']
        ]);
    }
}

