@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if (session('employee-added'))
                <div class="alert alert-success alert-dismissible" >
                    {{ session('employee-added') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif 
            @if (session('employee-deleted'))
                <div class="alert alert-success alert-dismissible" >
                    {{ session('employee-deleted') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif 

            <!-- Company Information -->
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Company Information</h4>
                    <div class="company-actions">
                        <a href="{{ route('companies.index').'/'.$company->id.'/edit' }}"  type="button" class="btn btn-success"><i class="fas fa-edit"></i></a>
                        <form method="POST" action="{{ route('companies.destroy', $company) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" value="delete"><i class="far fa-trash-alt"></i></button>
                        </form>
                    </div>                        
                </div>
                <div class="card-body">
                    <div class="container">
                        <div class="row mt-2">
                            <div class="col-12 d-flex">
                                <a href="{{ route('companies.index').'/'.$company->id}}" class="thumbnail">
                                    @if($company->logo != NULL)
                                        <img src="{{ asset('storage/uploaded/logos') }}/{{ $company->logo }}" alt="{{ $company->name }}">
                                    @else
                                        <img src="{{ asset('images/no-photo.jpg') }}" alt="{{ $company->name }}">
                                    @endif
                                </a>    
                                <ul class="ml-4">
                                    <li class="text-break list-group-item">
                                        <h4>{{ $company->name }}</h4>
                                    </li>
                                    @if ($company->email)
                                    <li class="text-break list-group-item">
                                        <a 
                                            class="text-reset text-decoration-none link-primary" 
                                            href="mailto:{{ $company->email }}">
                                            {{ $company->email }}
                                        </a>
                                    </li>
                                    @endif
                                    @if ($company->website)
                                    <li class="text-break list-group-item">
                                        <a 
                                            class="text-reset text-decoration-none link-primary" 
                                            target="_blank" href="{{ $company->website }}">
                                            {{ $company->website }}
                                        </a>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                
                </div> 
            </div>

            <!-- Company Employees -->
            <div class="card mt-5">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Company Employees ({{$employees->count()}}) </h4>
                    <a href="{{ route('employees.create',['company_id'=>$company]) }}"  type="button" class="btn btn-primary">Add New Employee</a>
                </div>

                <div class="card-body">
                    <div class="container">
                        
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-bordered table-responsive">
                                    <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Phone Number</th>
                                            <th scope="col">Company</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($employees as $employee)
                                        <tr>
                                            <td>
                                                <a href="{{ route('employees.index').'/'.$employee->id}}">
                                                    {{ ucwords($employee->first_name)." ".ucwords($employee->last_name) }}
                                                </a>
                                            </td>
                                            <td>
                                                <a 
                                                    href="mailto:{{ $employee->email }}">
                                                    {{ $employee->email }}
                                                </a>
                                            </td>
                                            <td>
                                                <a href="tel:{{ $employee->phone_number }}">
                                                    {{ $employee->phone_number }}
                                                </a>
                                            </td>
                                            <td>
                                                @if($employee->company != NULL)
                                                <a href="{{ route('companies.index').'/'.$employee->company->id}}">
                                                    {{ $employee->company->name  ?? ''}}
                                                </a>
                                                @endif
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6"><p>No empployees to display</p></td>
                                        </tr>
                                            
                                        @endforelse     
            
                                    </tbody>
                                </table>                    
                                {{ $employees->links() }}
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
