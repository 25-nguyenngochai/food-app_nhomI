@extends('admin.master')
@section('content')

<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title" onclick="location.href='{{url('table-product')}}';" style="cursor: pointer;">Product
                Table</h3>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div style="float: right; padding-bottom: 35px;">
                            <form class="align-items-center h-100 flex justify-end" action="{{route('seach-product')}}"
                                method="get">
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                                        <i class="input-group-text border-0 mdi mdi-magnify"></i>
                                    </div>
                                    <input type="text" name="key" class="form-control bg-transparent border-0"
                                        placeholder="Search product">
                                </div>
                            </form>
                        </div>
                        <table class="table table-bordered" style="text-align: center;">
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th> Image </th>
                                    <th> Name </th>
                                    <th> <a href="{{url('add-product')}}" class="btn btn-danger btn-xs btn-theme02"><i
                                                class="mdi mdi-database-plus"></i> Add</a> </th>
                                </tr>
                            </thead>
                            @if($message = Session::get('success'))
                            <div class="alert alert-success" id="alert">
                                <p>{{$message}}</p>
                            </div>
                            @endif
                            <tbody>
                                @foreach($table_product as $value)
                                <tr>
                                    <td> {{$value->id}} </td>
                                    <td> <img class="img-fluid" src="{{asset('images/'.$value->image)}}" alt=""
                                            style="width: 90px; height: 70px;"> </td>
                                    <td> {{$value->name}} </td>
                                    <td>
                                        @include('admin.product.show-product')
                                        <a href="{{route('get_edit-product', $value->id)}}"
                                            class="btn btn-primary btn-xs"><i
                                                class="mdi mdi-pencil-box-outline"></i>Edit</a>
                                        <a onclick="return confirm('Are you sure you want to delete?')"
                                            href="{{route('get_delete-product', $value->id)}}"
                                            class="btn btn-primary btn-xs"><i class="mdi mdi-delete"></i>Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{$table_product->links('paginate.paginate')}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection