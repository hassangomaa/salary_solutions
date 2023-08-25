@extends('layouts.admin')
@section('content')
    @include('partials.menu',[$flag])
    <div class="row">
        @foreach ($companies as $company)
            <div class="col-md-4 mb-4">
                <a href="{{ route('company.clickOnCompany',$company->id)}}" class="card-link">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">{{ $company->name }}</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{trans('company-management.company_credit')}}: {{ $company->credit }}</p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>




@endsection
