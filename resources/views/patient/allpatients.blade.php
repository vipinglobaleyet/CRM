@extends('layouts.hmsmain')
@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">  
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
<div class="spacer" style="height:40px;margin-top: 30px;"></div>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>View All Patient</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
            </div>
        </div>
    </div>
    <section class="section">
        <table class="table table-striped table-bordered" id="mydatatable">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Phone No</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Detailes</th>
                    <th>Appointment</th>
                    <th>Cross Consultation</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                @foreach($patients as $patient)
                    <tr class="table table-hover">
                        <td>{{$patient->id}}</td>
                        <td>{{$patient->firstname}}</td>
                        <td>{{$patient->phoneno}}</td>
                        <td>{{$patient->address}}</td>
                        <td>{{$patient->email}}</td>
                        <td><a href="{{url('detailpatient'.$patient->id)}}"><i class="fas fa-tasks"></i></a></td>
                        <td><a href="{{url('appointment'.$patient->id)}}"><i class="fas fa-eye"></i></a></td>
                        <td><a href="{{url('cross_consult'.$patient->id)}}"><i class="fas fa-exchange"></i></a></td>
                        <td><a href="{{url('editpatient'.$patient->id)}}"><i class="fas fa-edit"></i></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
</div>
<div class="modal fade" id="editpatientmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('addproduct')}}" method="post" enctype="multipart/form-data" >
                    @csrf
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Name</label>
                        <input type="text" name="productname" class="form-control" id="productname"  required="">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Price</label>
                        <input type="text" name="productprice" class="form-control" id="productprice"  required="">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Store</label>
                        <input type="text" name="productstore" class="form-control" id="productstore"  required="">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Image</label>
                        <input type="file"  class="form-control" id="productprice" name="productfile" required="" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" charset="utf8" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
<script>
    $('#mydatatable').dataTable({
        colReorder: true,
        order: [],
        pageLength: 0,
        lengthMenu: [10,20, 40, 60, 80, 90, 100],
    });
</script>
@endsection

