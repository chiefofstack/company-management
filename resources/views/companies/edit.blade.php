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
                    <h4>Edit Company</h4>                    
                    <div class="company-actions">
                        <a href="{{ route('companies.index').'/'.$company->id }}" type="button" class="btn btn-primary"><i class="far fa-eye"></i></a>
                        <form method="POST" action="{{ route('companies.destroy', $company) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" value="delete"><i class="far fa-trash-alt"></i></button>
                        </form>
                    </div>  
                </div>
                <div class="card-body">
                   
                    <form action="{{ route('companies.update', $company) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                        <div class="company-form">          
                            <x-form.input name="name" label="Company Name" :value="old('name', $company->name)"/>
                            <x-form.input name="email" label="Email Address" :value="old('email', $company->email)"/>
                            <x-form.file name="logo" label="Company Logo" :value="old('logo', $company->logo)"/>
                            <x-form.input name="website" label="Website" :value="old('website', $company->website)"/>
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
