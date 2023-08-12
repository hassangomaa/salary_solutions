@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.product.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.products.update", [$product->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="seller_id">{{ trans('cruds.product.fields.seller') }}</label>
                            <select class="form-control select2" name="seller_id" id="seller_id" required>
                                @foreach($sellers as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('seller_id') ? old('seller_id') : $product->seller->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('seller'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('seller') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.seller_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="title">{{ trans('cruds.product.fields.title') }}</label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ old('title', $product->title) }}" required>
                            @if($errors->has('title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.title_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="price">{{ trans('cruds.product.fields.price') }}</label>
                            <input class="form-control" type="number" name="price" id="price" value="{{ old('price', $product->price) }}" step="0.01" required>
                            @if($errors->has('price'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('price') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.price_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="category_id">{{ trans('cruds.product.fields.category') }}</label>
                            <select class="form-control select2" name="category_id" id="category_id">
                                @foreach($categories as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('category_id') ? old('category_id') : $product->category->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('category'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('category') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.category_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="best">{{ trans('cruds.product.fields.best') }}</label>
                            <input class="form-control" type="text" name="best" id="best" value="{{ old('best', $product->best) }}">
                            @if($errors->has('best'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('best') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.best_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.product.fields.featured') }}</label>
                            @foreach(App\Models\Product::FEATURED_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="featured_{{ $key }}" name="featured" value="{{ $key }}" {{ old('featured', $product->featured) === (string) $key ? 'checked' : '' }}>
                                    <label for="featured_{{ $key }}">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('featured'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('featured') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.featured_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection