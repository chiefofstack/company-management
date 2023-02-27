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
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4>Edit Employee</h4>                    
                    <div class="company-actions">
                        <a href="{{ route('employees.index').'/'.$employee->id }}" type="button" class="btn btn-primary"><i class="far fa-eye"></i></a>
                        <form method="POST" action="{{ route('employees.destroy', $employee) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" value="delete"><i class="far fa-trash-alt"></i></button>
                        </form>
                    </div>  
                </div>
                <div class="card-body">
                   
                    <form action="{{ route('employees.update', $employee) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                        <div class="employee-form">          
                            <x-form.input name="first_name" label="First Name" :value="old('first_name', $employee->first_name)"/>
                            <x-form.input name="last_name" label="Last Name" :value="old('last_name', $employee->last_name)"/>                           
                            <x-form.select name="company_id" label="Company" :value="old('company_id', $employee->company->id ?? '')" :list="$companies" />
                            <x-form.input name="email" label="Email Address" :value="old('email', $employee->email)"/>
                            <x-form.input name="phone_number" label="Phone Number" :value="old('phone_number', $employee->phone_number)"/>
                            <div class="row mb-3">                                    
                                <div class="col-md-6 offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update
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
