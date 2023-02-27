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
                    <h4 class="mb-0">Companies</h4>
                    <a href="{{ route('companies.create')}}" class="btn btn-primary">Add New Company</a>
                </div>

                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <form action="{{ route('companies.index') }}" method="get">                                    
                                    <div class="search-form">
                                        <div class="form-group">
                                            <input 
                                                type="text" 
                                                id="search" 
                                                name="search" 
                                                class="input-field error" 
                                                value="{{ request('search') }}" 
                                                placeholder="Enter name, email or website"
                                            >
                                            <span class="form-message">{{ $companies->total() > 1 ? "There are" : "There is" }} {{ $companies->total() }} {{ $companies->total() > 1 ? "companies" : "company" }} {{ request('search') !== NULL ? "matching '".request('search')."' " : "" }}  </span>
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
                                            <th scope="col">Logo</th>
                                            <th scope="col">Company Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Website</th>
                                            <th scope="col">No of Employees</th>
                                            <th scope="col">Created By</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($companies as $company)
                                        <tr>
                                            
                                            <td>
                                                <a href="{{ route('companies.index').'/'.$company->id}}" class="thumbnail">
                                                    @if($company->logo != NULL)
                                                        <img src="{{ asset('storage/uploaded/logos') }}/{{ $company->logo }}" alt="{{ $company->name }}">
                                                    @else
                                                        <img src="{{ asset('images/no-photo.jpg') }}" alt="{{ $company->name }}">
                                                    @endif
                                                </a>    
                                            </td>
                                            <td>
                                                <a href="{{ route('companies.index').'/'.$company->id}}">
                                                    {{ $company->name  ?? ''}}
                                                </a>
                                            </td>
                                            <td>
                                                @if($company->email != NULL)
                                                <a href="mailto:{{ $company->email }}">
                                                    {{ $company->email  ?? ''}}
                                                </a>
                                                @endif
                                            </td>
                                            <td>
                                                @if($company->website != NULL)
                                                <a href="{{ $company->website }}" target="_blank">
                                                    {{ $company->website  ?? ''}}
                                                </a>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('companies.index').'/'.$company->id}}">
                                                    {{ $company->employees->count()  ?? ''}}
                                                </a>
                                            </td>
                                            <td>{{ $company->creator->name }}</td>
                                            
                                            <td>
                                                <div class="col-actions">
                                                    <a href="{{ route('companies.index').'/'.$company->id }}" type="button" class="btn btn-primary"><i class="far fa-eye"></i></a>
                                                    <a href="{{ route('companies.index').'/'.$company->id.'/edit' }}"  type="button" class="btn btn-success"><i class="fas fa-edit"></i></a>
                                                    <form method="POST" action="{{ route('companies.destroy', $company) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger" value="delete"><i class="far fa-trash-alt"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6"><p>No companies to display</p></td>
                                        </tr>
                                            
                                        @endforelse     
            
                                    </tbody>
                                </table>                    
                                {{ $companies->links() }}
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
