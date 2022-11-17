@extends('admin.master')
@section('content')

<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Add Product </h3>
        </div>
        @if($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" action="{{route('add_product')}}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputName1">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Price</label>
                                <input type="number" name="price" class="form-control" placeholder="Enter price">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword4">Category name</label>
                                <select name="category_id" class="form-control form-control-sm">
                                    @foreach($allCategory as $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea1">Description</label>
                                <textarea name="description" class="form-control" rows="4"
                                    placeholder="Enter description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputCity1">Date added</label>
                                <input name="date_added" type="date" class="form-control" placeholder="Location">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputCity1">Expiration date</label>
                                <input name="expiration_date" type="date" class="form-control" placeholder="Location">
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <div class="col-sm-10">
                                    <input type="file" name="upload_image" id="inputImage" class="form-control">
                                    <br>
                                    <img id="hinh" alt="" style="width:150px">
                                </div>
                            </div>
                            <script>
                            const inputPro_image = document.querySelector('#inputImage');
                            const hinh = document.querySelector('#hinh');
                            inputImage.onchange = evt => {
                                const [file] = inputImage.files
                                if (file) {
                                    hinh.src = URL.createObjectURL(file)
                                }
                            }
                            </script>
                            <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                            <a onclick="return confirm('Are you sure you want to delete?')" class="btn btn-light"
                                href="{{ url('/table-product')}}">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection