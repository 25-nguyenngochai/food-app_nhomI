@extends('admin.master')
@section('content')

<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Edit Product </h3>
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
                        <form class="forms-sample" action="{{route('post_edit-product', $allProduct->id)}}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputName1">Name</label>
                                <input type="text" name="name" value="{{$allProduct->name}}" class="form-control"
                                    placeholder="Enter name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Price</label>
                                <input type="number" name="price" value="{{$allProduct->price}}" class="form-control"
                                    placeholder="Enter price">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword4">Category name</label>
                                <select name="category_id" class="form-control" id="exampleSelectGender">
                                    @foreach($allCategory as $value)
                                    <option @if($value->id == $allProduct->category_id) {{"selected"}} @endif
                                        value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea1">Description</label>
                                <textarea name="description" class="form-control" rows="4"
                                    placeholder="Enter description">{{$allProduct->description}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputCity1">Date added</label>
                                <input name="date_added" type="date" value="{{$allProduct->date_added}}"
                                    class="form-control" placeholder="Location">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputCity1">Expiration date</label>
                                <input name="expiration_date" type="date" value="{{$allProduct->expiration_date}}"
                                    class="form-control" placeholder="Location">
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <div class="col-sm-10">
                                    <input type="file" name="upload_image" id="inputImage" class="form-control">
                                    <br>
                                    <img id="hinh" class="img-fluid" src="{{asset('images/'.$allProduct->image)}}"
                                        alt="" style="width:150px">
                                    <input type="hidden" value="{{$allProduct->image}}" name="value_image">
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