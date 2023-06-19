@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(isset($errors)) {{ $errors }}@endif
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Product List
                        <div class="text-end">
                            <a href="{{ route('product.create') }}" class="btn btn-sm btn-success">Add new</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Actions</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">SKU</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($allProducts AS $pro_list)
                                        <tr>
                                            <td>
                                                <a href="{{ url('product-show/').'/'.$pro_list->id }}">Edit</a>
                                                <form method="POST" action="/product-delete/{{$pro_list->id}}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}

                                                    <div class="form-group">
                                                        <input type="submit" class="btn btn-danger btn-sm" value="Delete">
                                                    </div>
                                                </form>
                                            </td>
                                            <td>{{ $pro_list->Name }}</td>
                                            <td>{{ $pro_list->sku }}</td>
                                            <td style="text-align: right;">{{ number_format($pro_list->price,2) }}</td>
                                            <td>@if($pro_list->status) Active @else Inactive @endif</td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
