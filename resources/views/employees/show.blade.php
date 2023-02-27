@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <!-- Employee Information -->
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Employee Information</h4>
                    <div class="company-actions">
                        <a href="{{ route('employees.index').'/'.$employee->id.'/edit' }}"  type="button" class="btn btn-success"><i class="fas fa-edit"></i></a>
                        <form method="POST" action="{{ route('employees.destroy', $employee) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" value="delete"><i class="far fa-trash-alt"></i></button>
                        </form>
                    </div>                        
                </div>
                <div class="card-body">
                    <div class="container">
                        <div class="row mt-2">
                            <div class="col-12">

                                <ul class="ml-4">
                                    <li class="text-break list-group-item">
                                        <h4>{{ ucwords($employee->first_name)." ".ucwords($employee->last_name) }}</h4>
                                    </li>
                                    @if ($employee->email)
                                    <li class="text-break list-group-item">
                                        <a 
                                            class="text-reset text-decoration-none link-primary" 
                                            href="mailto:{{ $employee->email }}">
                                            {{ $employee->email }}
                                        </a>
                                    </li>
                                    @endif
                                    @if ($employee->phone_number)
                                    <li class="text-break list-group-item">
                                        <a 
                                            class="text-reset text-decoration-none link-primary" 
                                            href="tel:{{ $employee->phone_number }}">
                                            {{ $employee->phone_number }}
                                        </a>
                                    </li>
                                    @endif
                                    @if ($employee->company)
                                    <li class="text-break list-group-item">
                                        <a 
                                            class="text-reset text-decoration-none link-primary" 
                                            href="{{ route('companies.index') }}/{{ $employee->company->id }}">
                                            {{ $employee->company->name }}
                                        </a>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                
                </div> 
            </div>


        </div>
    </div>
</div>
@endsection
