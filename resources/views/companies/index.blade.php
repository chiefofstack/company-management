@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Companies</h4>
                    <a href="{{URL::route('companies.create')}}" class="btn btn-primary">Add New Company</a>
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">Logo</th>
                                <th scope="col">Company Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Website</th>
                                <th scope="col">Created By</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($companies as $company)
                            <tr>
                                <td><img src="{{ asset('storage/uploaded/logos') }}/{{ $company->logo }}" alt="{{ $company->name }}"></td>
                                <td>{{ $company->name }}</td>
                                <td>{{ $company->email }}</td>
                                <td>{{ $company->website }}</td>
                                <td>Creator</td>
                                <td>
                                    <button type="button" class="btn btn-primary"><i class="far fa-eye"></i></button>
                                    <button type="button" class="btn btn-success"><i class="fas fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                </td>
                            </tr>
                            @empty
                                <p>No companies yet</p>
                            @endforelse     
                        </tbody>
                    </table>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
