<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Employee;

class EmployeeController extends Controller
{
    /**
     * View all employees.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $employees = Employee::filter();
        
        return view('employees.index', compact('employees'));
    }

    /**
     * Show a single employee.
     *
     * @param Employee $employee
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Employee $employee)
    {   // if logged in user not the owner of the employee, show error
        if(auth()->user()->id != $employee->created_by){
            abort(403);
        }    

        $employeeCompany = Company::where('id', '=', $employee->company_id)->get();  
    
        return view('employees.show', compact('employee'))->with('company', $employeeCompany);
    }

    /**
     * Create a new employee.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employees.create');
    }

    
    /**
     * Persist a new employee.
     *
     * @return mixed
     */
    public function store()
    {
        //persist
        $employee = auth()->user()->employees()->create($this->validateRequest()); //switch to middleware approach

        //redirect
        return redirect(route('employees.index'))->with('success', 'Employee '.ucwords($employee->name).' has been created');
    }

    /**
     * Edit the employee.
     *
     * @param  Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the employee.
     *
     * @param  Employee $employee
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Employee $employee)
    {   // if logged in user not the owner of the employee, show error
        if(auth()->user()->id != $employee->created_by){
            abort(403);
        }    

        $employee->update($this->validateRequest());

        return redirect(route('employees.index'))->with('success', 'Employee '.ucwords($employee->name).' has been updated');
    }

    /**
     * Destroy the employee.
     *
     * @param  Employee $employee
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Employee $employee)
    {
        // if logged in user not the owner of the company, show error
        if(auth()->user()->id != $employee->created_by){
            abort(403);
        }

        $employee->delete();

        return redirect('/employees')->with('success', 'Employee '.ucwords($employee->name).' has been deleted');;
    }


    /**
     * Validate Requests
     */
    public function validateRequest(){
        //validate
        return request()->validate([
            'first_name' => ['required','max:255'],
            'last_name' => ['required','max:255'],
            'email' => ['required','max:255'],
            'phone_number' => ['required','max:255'],
            // 'name' => ['required','max:255'],
            // 'email' => ['nullable','email:rfc,dns','max:255'],
            // 'logo' => ['nullable','image','dimensions:min_width=100,min_height=100','max:1024'],
            // 'website' => ['nullable','url','max:255'],
            // 'created_by' => ['required']
        ]);
    }
}
