@extends('layouts.admin')
@section('content')
    @include('partials.menu',[$flag])
    <div class="row">
        <div class="col-md-4 mb-4">
                <a href="{{ route('admin.home')}}" class="card-link">
                    <div class="card">
                        <div class="card-header">

                        </div>
                        <div class="card-body" >
                            <h2 class="card-text" style="text-align: center">{{ trans('company-management.module')." ".trans('company-management.salaries')}}</h2>
                        </div>
                    </div>
                </a>
            </div>
    </div>




@endsection
