@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible" >
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif 
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Employees</h4>
                    <a href="{{ route('employees.create')}}" class="btn btn-primary">Add New Employee</a>
                </div>

                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <form action="{{ route('employees.index') }}" method="get">                                    
                                    <div class="search-form">
                                        <div class="form-group">
                                            <input 
                                                type="text" 
                                                id="search" 
                                                name="search" 
                                                class="input-field error" 
                                                value="{{ request('search') }}" 
                                                placeholder="Enter name, email or phone number"
                                            >
                                            <span class="form-message">{{ $employees->total() > 1 ? "There are" : "There is" }} {{ $employees->total() }} {{ $employees->total() > 1 ? "employees" : "employee" }} {{ request('search') !== NULL ? "matching '".request('search')."' " : "" }}  </span>
                                        </div>
                                        <button type="submit" class="btn btn-primary">
                                            Search
                                        </button>
                                    </div>
                                </form>    
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-bordered table-responsive">
                                    <thead>
                                        <tr>
                                            <th scope="col">Full Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Phone Number</th>
                                            <th scope="col">Company Name</th>
                                            <th scope="col">Created By</th>
                                            <th scope="col">Actions</th>
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
                                            <td>{{ $employee->creator->name }}</td>
                                            <td class="col-actions">
                                                <a href="{{ route('employees.index').'/'.$employee->id }}" type="button" class="btn btn-primary"><i class="far fa-eye"></i></a>
                                                <a href="{{ route('employees.index').'/'.$employee->id.'/edit' }}"  type="button" class="btn btn-success"><i class="fas fa-edit"></i></a>
                                                <form method="POST" action="{{ route('employees.destroy', $employee) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" value="delete"><i class="far fa-trash-alt"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6"><p>No employees to display</p></td>
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
