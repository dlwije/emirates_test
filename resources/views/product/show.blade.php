@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Product Edit
                        <div class="text-end">
                            <a href="{{ url()->previous() }}" class="btn btn-sm btn-success">Go Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{ route('product.update', ['id' => $product->id]) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text" class="form-control" id="pro_name" name="pro_name" value="{{ $product->Name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">SKU</label>
                                        <input type="text" class="form-control" id="pro_sku" name="pro_sku" value="{{ $product->sku }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Price</label>
                                        <input type="text" class="form-control" id="pro_price" name="pro_price" value="{{ $product->price }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Image</label>
                                        <input type="file" class="form-control" id="pro_image" name="pro_image">
                                    </div>

                                    <div class="form-group pt-4">
                                        <button type="submit" class="btn btn-primary btn-sm"> Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
