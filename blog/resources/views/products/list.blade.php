@extends('layouts.master')
@section('title', 'List product')
@section('small_title', 'show all product')

@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="card-title float-left">
                List product
                <small class="text-muted">show all product</small>
            </h3>
            <a href="/products/create" class="btn float-right"><i class="fas fa-plus-circle"></i> Create new</a>
            <div class="clearfix"></div>
            <div class="alert alert-success d-none" role="alert" id="messageSuccess"></div>
            <div class="alert alert-danger d-none" role="alert" id="messageError"></div>
            @if(count($list_products)>0)
            <table class="table table-striped">
                <thead>
                <tr class="row">
                    <th class="col-md-1"></th>
                    <th class="col-md-1">ID</th>
                    <th class="col-md-2">Thumbnail</th>
                    <th class="col-md-2">Name</th>
                    <th class="col-md-2">Description</th>
                    <th class="col-md-1">Price</th>
                    <th class="col-md-3">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($list_products as $item)
                    <tr id="{{$item->id}}" class="row">
                        <th class="col-md-1 form-group form-check text-center">
                            <input type="checkbox" class="form-check-input check-item" value="{{$item->id}}">
                        </th>
                        <th class="col-md-1">
                            {{$item->id}}
                        </th>
                        <th class="col-md-2">
                            <div class="card"
                                 style="background-image: url('{{$item->img_url}}'); background-size: cover; width: 60px; height: 60px;">
                            </div>
                            {{--<img src="{{$item->img_url}}" alt="" class="img-thumbnail rounded-circle w-50">--}}
                        </th>
                        <td class="col-md-2 product-name" id="name-{{$item->id}}">{{$item->name}}</td>
                        <td class="col-md-2 product-description">{!! $item->description !!}</td>
                        <td class="col-md-1 product-price">{{$item->price}}</td>
                        <td class="col-md-3">
                            <a href="#" class="btn btn-link btn-quick-edit">Quick Edit</a>
                            <a href="/products/{{$item->id}}/edit" class="btn btn-link">Edit</a>
                            <a href="#" id="delete-{{$item->id}}" class="btn btn-link btn-delete">Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="col-md-8 form-inline">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="checkAll">
                        <label class="form-check-label" for="defaultCheck1">
                            Check all
                        </label>
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <select id="actionSelectAll" class="form-control">
                            <option selected value="0">--Select action--</option>
                            <option value="1">Delete all checked</option>
                            <option value="2">Another action</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mb-2" id="btnApply">Apply</button>
                </div>
                <div class="col-md-4">
                    <div class="float-right">
                        {{ $list_products->links() }}
                    </div>
                </div>
            </div>
            @else
                <div class="alert alert-info" role="alert">
                    Have no products, click <a href="/products/create">here</a> to create new.
                </div>
            @endif
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Bạn có chắc muốn xoá?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modalContent">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="btnConfirmDelete">Sure</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="" class="form" id="formUpdate">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit product information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modalContent">
                        {{csrf_field()}}
                        <input type="hidden" value="1" id="isAjax" name="isAjax">
                        <input type="hidden" value="" id="idUpdate" name="id">
                        <input type="hidden" value="" id="imageUpdate" name="img_url">
                        <div class="form-group row">
                            <div class="col-md-9">
                                <label for="">Name</label>
                                <input type="text" class="form-control" name="name" id="nameUpdate">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label for="">Description</label>
                                <textarea class="form-control" name="description" id="descriptionUpdate"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="">Price</label>
                                <input type="text" class="form-control" name="price" id="priceUpdate">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" id="btnUpdateProduct">Update</button>
                </div>
            </div>
            </form>
        </div>
    </div>

    <script src="{{asset('js/list-product.js')}}"></script>
@endsection