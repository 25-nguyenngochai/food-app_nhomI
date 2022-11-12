@extends('admin.master')
@section('content')

        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Edit Category </h3>
            </div>
            <div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <form class="forms-sample">
                      <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                        <input type="text" name="name" class="form-control" id="exampleInputName1" placeholder="Enter name">
                      </div>
                      <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                      <a onclick="return confirm('Are you sure you want to delete?')" class="btn btn-light" href="{{ url('/table-category')}}">Cancel</a>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
         
@endsection