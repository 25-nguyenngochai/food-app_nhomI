@extends('admin.master')
@section('content')

<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Edit Category </h3>
        </div>
<<<<<<< HEAD
=======
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
>>>>>>> tho_editCategory
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
<<<<<<< HEAD
                        <form class="forms-sample">
                            <div class="form-group">
                                <label for="exampleInputName1">Name</label>
                                <input type="text" name="name" class="form-control" id="exampleInputName1"
                                    placeholder="Enter name">
                            </div>
                            <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                            <a onclick="return confirm('Want to exit the Edit Category page??')" class="btn btn-light"
=======
                        <form class="forms-sample" action="{{route('post_edit-category', $allCategory->id)}}"
                            method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputName1">Name</label>
                                <input type="text" name="name" value="{{$allCategory->name}}" class="form-control"
                                    placeholder="Enter name">
                            </div>
                            <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                            <a onclick="return confirm('Want to exit the Edit Category page?')" class="btn btn-light"
>>>>>>> tho_editCategory
                                href="{{ url('/table-category')}}">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<<<<<<< HEAD

    @endsection
=======
</div>

@endsection
>>>>>>> tho_editCategory
