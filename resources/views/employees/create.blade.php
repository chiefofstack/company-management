@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible" >
                    There were {{ $errors->count() }} errors found in the form.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
                            
            <div class="card">
                <div class="card-header">Create an Employee</div>
                <div class="card-body">
                    <form action="{{ route('employees.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                        <div class="employee-form">          
                            <x-form.input name="first_name" label="First Name"/>
                            <x-form.input name="last_name" label="Last Name"/>
                            <x-form.input name="company_id" label="Company"/>
                            <x-form.input name="email" label="Email Address"/>
                            <x-form.input name="phone_number" label="Phone Number"/>
                            <div class="row mb-3">                                    
                                <div class="col-md-6 offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Add Employee
                                    </button>
                                </div>
                            </div>  
                        </div>
                    </form>   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
