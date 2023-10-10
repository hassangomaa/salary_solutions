@extends('layouts.admin')
@section('content')
    @include('partials.menu',[$flag])



    <h2>{{ trans('cruds.safe.transaction') }}</h2>
{{-- {{ $safe_transactions }} --}}
<table class="table table-striped">
    <thead class="thead-dark">
        <tr>
            <th>{{ trans('safe') }}</th>
            <td>{{ $safe_transactions->name }}</td>
        </tr>
        <tr>
            <th>{{ trans('Type') }}</th>
            <td>{{ $safe_transactions->type }}</td>
        </tr>
        <tr>
            <th>{{ trans('Balance') }}</th>
            <td>{{ $safe_transactions->value }}</td>
        </tr>
      <tr>
        </thead>
</table>
<hr>
<table class="table table-striped">
    <thead>

        <th scope="col">{{ trans('cruds.safe.amount') }}</th>
        <th scope="col">{{ trans('cruds.safe.details') }}</th>
        <th> {{ trans('cruds.safe.created_at') }}</th>
      </tr>
    </thead>
    <tbody>

        @foreach ($safe_transactions->transactions as $item )
            <tr>
                {{-- <td>{{  }}</td> --}}
                <td>{{ $item->value }}</td>
{{--                @dd($item)--}}
                <td>{{ $item->details}} {{ ($item->reasonable_type==$user)?$item->user->name??'':''}} </td>
                <td>{{ $item->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
  </table>
@endsection

