@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mt-2">{{ __('Dashboard') }}</h5>                    
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <p>Welcome {{ Auth::user()->name }}! </p>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">
                                    Companies
                                </div>
                                <div class="card-body">
                                    <p>Here you can manage companies and see employees for each of them. Right now there's a total of {{ $companyTotal }} available for you. </p>
                                    
                                    <a href="{{ route('companies.index') }}" class="btn btn-primary">See All</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">
                                    Employees
                                </div>
                                <div class="card-body">
                                    <p>This is where you see and manage all employees. You can still see which company an employee belongs to. Right now there's a total of {{ $employeeTotal }} available for you. </p>
                                    
                                    <a href="{{ route('employees.index') }}" class="btn btn-primary">See All</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
