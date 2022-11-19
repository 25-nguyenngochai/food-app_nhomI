<!-- Show Product -->
<a class="btn btn-primary btn-xs" data-bs-toggle="modal" data-bs-target="#show-product-{{$value->id}}"><i
        class="mdi mdi-eye"></i> Show</a>
<div class="modal fade" id="show-product-{{$value->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-1">
                            <h5>Id: <span>{{$value->id}}</span></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <h5><span>Name: </span><span>{{$value->name}}</span></h5>
                            <h5><span>Price: </span><span>{{number_format($value->price)}} VND</span></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <h5><span>Image: </span><span><img class="img-fluid"
                                        src="{{asset('images/'.$value->image)}}" alt=""
                                        style="width: 100px; height: 90px;"></span></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1">
                            <h5>Description:</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <textarea style="border: none; width: 100%; height: 100%; font-size: 1rem;" rows="8"
                                disabled>{{$value->description}}</textarea>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-2">
                            <h5><span>Date Added:
                                </span><span>{{\Carbon\Carbon::parse($value->date_added)->format('d/m/Y')}}</span>
                            </h5>
                            <h5><span>Expiration Date:
                                </span><span>{{\Carbon\Carbon::parse($value->expiration_date)->format('d/m/Y')}}</span>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>