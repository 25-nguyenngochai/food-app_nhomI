@extends('admin.master')
@section('content')

        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Category Table</h3>
            </div>
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div style="float: right;">
                      <form class="align-items-center h-100 flex justify-end" action="#">
                        <div class="input-group">
                          <div class="input-group-prepend bg-transparent">
                            <i class="input-group-text border-0 mdi mdi-magnify"></i>
                          </div>
                          <input type="text" class="form-control bg-transparent border-0" placeholder="Search category">
                        </div>
                      </form>
                    </div>
                    <table class="table table-striped">
                      <thead>
                        <tr>
                        <tr>
                          <th>Id</th>
                          <th>Name</th>
                          <th>
                            <a href="{{ url('/add-category')}}" class="btn btn-danger btn-xs btn-theme02"><i class="mdi mdi-database-plus"></i> Add</a>
                          </th>
                        </tr>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td> 1 </td>
                          <td> Herman Beck </td>
                          <td> 
                            <a href="{{ url('/edit-category')}}"
                            class="btn btn-primary btn-xs"><i class="mdi mdi-pencil-box-outline"></i>Edit</a>
                            <a href=""
                            class="btn btn-primary btn-xs"><i class="mdi mdi-delete"></i>Delete</a>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

@endsection