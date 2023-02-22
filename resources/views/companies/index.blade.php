@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @forelse ($companies as $company)
                    <a href="{{ $company->path() }}">{{ $company->name }}</a>
                        
                        
                    @empty
                        <p>No companies yet</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
