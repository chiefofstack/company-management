<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateEmployee;
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
        return view('employees.create',['companies' => Company::all()]);
    }

    
    /**
     * Persist a new employee.
     *
     * @return mixed
     */
    public function store(ValidateEmployee $request)
    {
        //persist
        $employee = auth()->user()->employees()->create($request->validated()); //switch to middleware approach

        //redirect
        return redirect(route('employees.index'))->with('success', 'Employee '.ucwords($employee->first_name).' '.ucwords($employee->last_name).' has been created');
    }

    /**
     * Edit the employee.
     *
     * @param  Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {   
        return view('employees.edit',  [ 'employee'=>$employee, 'companies' => Company::all()] );
    }

    /**
     * Update the employee.
     *
     * @param  Employee $employee
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Employee $employee, ValidateEmployee $request)
    {   // if logged in user not the owner of the employee, show error
        if(auth()->user()->id != $employee->created_by){
            abort(403);
        }    

        $employee->update($request->validated());

        return redirect(route('employees.index'))->with('success', 'Employee '.ucwords($employee->first_name).' '.ucwords($employee->last_name).' has been updated');
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

        return redirect('/employees')->with('success', 'Employee '.ucwords($employee->first_name).' '.ucwords($employee->last_name).' has been deleted');;
    }


}
