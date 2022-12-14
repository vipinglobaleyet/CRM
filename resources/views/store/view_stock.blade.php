@extends('layouts.hmsmain')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

  {{-- <div class="spacer" style="height:40px;margin-top: 30px;"> --}}


</head>

<body>
    <div class="container">
        <h4 style="text-align:center"><b>Add Stock</b></h4>
       {{-- <button type="button" class="btn btn-primary" style="width:25%;"data-toggle="modal" data-target="#myModal"><b>Add Stock Details</b></button> --}}
       {{-- <button type="button" class="btn btn-primary" style="width:25%;"data-toggle="modal" data-target="#myModal-1"><b>Add New Item</b></button> --}}
       <div class="row clearfix">
        <div class="col-sm">
            <table class="table table-bordered" id="new-item">
                <thead>
                    <tr>
                        <th class="text-center">Id</th>
                        <th class="text-center">Purchase Date</th>
                        {{-- <th class="text-center">Medicine Image</th> --}}
                        <th class="text-center">Purchase Order No</th>
                        {{-- <th class="text-center">Order Status</th> --}}
                        <th class="text-center">Add Stock</th>
                        <th class="text-center">View</th>


                    </tr>
                </thead>
                <tbody>
                    @foreach ( $purchase1 as $row)
                        <tr id="data">
                            <td  scope="row" class="text-center">{{$row->id}}</td>
                            <td  scope="row" class="text-center" id="medicine_name_1">{{$row->purchase_date}}</td>
                            <td  scope="row"class="text-center">{{$row->purchase_orderno}}</td>
                            {{-- <td  scope="row"class="text-center">{{$row->status}}</td> --}}
                            <td  scope="row"class="text-center"><a href="{{url('create_stock'.$row->id)}}"><i  id="add" class="btn btn-primary" aria-hidden="true" >Add Stock</i></td>
                            <td  scope="row"class="text-center"><a href="{{url('view_add_stock_details'.$row->id)}}"><i  style="color:#435ebe;" class="fa fa-eye" aria-hidden="true"></i></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
      </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
    $('#new-item').DataTable();
} );
</script>

@endsection



