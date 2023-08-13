@extends('layouts.admin')
@section('content')
    <div class="row">
        @foreach ($companies as $company)
            <div class="col-md-4 mb-4">
                <a href="{{ route('company.show',  $company->id) }}" class="card-link">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">{{ $company->name }}</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Company Credit: {{ $company->credit }}</p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>




@endsection
