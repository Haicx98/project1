@extends('layouts.master')
@section('title', 'Create new product')
@section('small_title', 'Enter product information')

@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="card-title float-left">
                Create Product
                <small class="text-muted">Enter product information</small>
            </h3>
            <a href="/products" class="btn float-right"><i class="fas fa-list-ul"></i> List product</a>
            <div class="clearfix"></div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{$action}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                @if($method == "PUT")
                    <input name="_method" type="hidden" value="PUT">
                @endif
                <div class="form-group row">
                    <div class="col-md-5">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control form-control" value="{{$product->name}}">
                        <small class="text-danger">{{$errors->first('name')}}</small>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea class="form-control" name="description" cols="30" rows="10"
                              id="summary-ckeditor">{{$product->description}}</textarea>
                    <small class="text-danger">{{$errors->first('description')}}</small>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="">Image</label>
                        <input type="file" name="img_url">
                        <small class="text-danger">{{$errors->first('img_url')}}</small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="">Price</label>
                        <input type="number" name="price" class="form-control form-control-sm"
                               value="{{$product->price}}">
                        <small class="text-danger">{{$errors->first('price')}}</small>
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" value="Submit" class="btn btn-dark">
                    <input type="reset" value="Reset" class="btn btn-dark">
                </div>
            </form>
        </div>
    </div>
    <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('summary-ckeditor');
    </script>
@endsection