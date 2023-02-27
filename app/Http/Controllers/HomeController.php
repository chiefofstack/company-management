<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Employee;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $companyTotal = Company::where('created_by','=',auth()->user()->id)->count();
        $employeeTotal = Employee::where('created_by','=',auth()->user()->id)->count();
        return view('home',['companyTotal' => $companyTotal, 'employeeTotal' => $employeeTotal]);
    }
}
