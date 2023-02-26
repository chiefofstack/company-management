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
                                <img 
                                    src="{{  $company->logo ? asset('storage/uploaded/logos/'.$company->logo) : asset('image/blank.jpg') }}" 
                                    width="100" 
                                    height="100" 
                                    alt="{{ $company->name }}" 
                                    class="border-0"
                                >
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
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Company Employees</h4>
                </div>

                <div class="card-body">
                    <div class="container">
                        
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-bordered table-responsive">
                                    <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Company</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Phone Number</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($employees as $employee)
                                        <tr>
                                            <td>{{ $employee->name }}</td>
                                            <td>{{ $employee->company }}</td>
                                            <td>{{ $employee->email }}</td>
                                            <td>{{ $employee->phone_number }}</td>
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
