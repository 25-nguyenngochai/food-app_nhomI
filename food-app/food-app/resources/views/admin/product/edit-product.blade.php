@extends('admin.master')
@section('content')

        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Edit Product </h3>
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
                      <div class="form-group">
                        <label for="exampleInputEmail3">Price</label>
                        <input type="email" name="price" class="form-control" id="exampleInputEmail3" placeholder="Enter price">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword4">Category name</label>
                          <select name="catalog_id" class="form-control" id="exampleSelectGender">
                            <option>Male</option>
                            <option>Female</option>
                          </select>                      
                        </div>
                      <div class="form-group">
                        <label for="exampleTextarea1">Description</label>
                        <textarea name="description" class="form-control" id="exampleTextarea1" rows="4" placeholder="Enter description"></textarea>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputCity1">Date added</label>
                        <input name="date_added" type="date" class="form-control" id="exampleInputCity1" placeholder="Location">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputCity1">Expiration date</label>
                        <input name="expiration_date" type="date" class="form-control" id="exampleInputCity1" placeholder="Location">
                      </div>
                      <div class="form-group">
                            <label>Image</label>
                            <div class="col-sm-10">
                                <input type="file" name="upload_image" id="inputImage" class="form-control">
                                <br>
                                <img id="hinh" alt="" style="width:150px">
                            </div>
                      </div>
                      <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                      <a onclick="return confirm('Are you sure you want to delete?')" class="btn btn-light" href="{{ url('/table-product')}}">Cancel</a>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
         
@endsection