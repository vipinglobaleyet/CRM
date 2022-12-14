@extends('layouts.hmsmain')
@section('content')
<head>
    <style>
    body {font-family: Arial;}

    /* Style the tab */
    .tab {
      overflow: hidden;
      border: 1px solid #ccc;
      background-color: #f1f1f1;
    }

    /* Style the buttons inside the tab */
    .tab button {
      background-color: inherit;
      float: left;
      border: none;
      outline: none;
      cursor: pointer;
      padding: 14px 16px;
      transition: 0.3s;
      font-size: 17px;
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
      background-color: #ddd;
    }

    /* Create an active/current tablink class */
    .tab button.active {
      background-color: #ccc;
    }

    /* Style the tab content */
    .tabcontent {
      display: none;
      padding: 6px 12px;
      -webkit-animation: fadeEffect 1s;
      animation: fadeEffect 1s;
    }
    .twitter-typeahead, .tt-hint, .tt-input, .tt-menu { width: 100%; }

    /* Fade in tabs */
    @-webkit-keyframes fadeEffect {
      from {opacity: 0;}
      to {opacity: 1;}
    }

    @keyframes fadeEffect {
      from {opacity: 0;}
      to {opacity: 1;}
    }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
            <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css">
            <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    </head>
    <div class="container">
        <h3 style="text-align:center"><b>Issued Item Details</b></h3><br>
       {{-- <button type="button" class="btn btn-primary" style="width:25%;"data-toggle="modal" data-target="#myModal"><b>Add Stock Details</b></button> --}}
       {{-- <button type="button" class="btn btn-primary" style="width:25%;"data-toggle="modal" data-target="#myModal-1"><b>Add New Item</b></button> --}}
       <div class="row clearfix">
        <div class="col-sm">
            <table class="table table-bordered" id="new-item">
                <thead>
                    <tr>
                        <th class="text-center">Id</th>
                        <th class="text-center">Issued Date</th>
                        <th class="text-center">Department</th>
                        <th class="text-center">Added By</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Details</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- {{dd($issued_details)}} --}}
                    @foreach ($issued_details as $row)
                        <tr id="data">
                            <td  scope="row" class="text-center">{{$row->id}}</td>
                            <td  scope="row" class="text-center" id="medicine_name_1">{{date('d-m-Y',strtotime($row->issued_date))}}</td>
                            <td  scope="row"class="text-center">{{$row->depname}}</td>
                            <td  scope="row"class="text-center">{{$row->name}}</td>
                            <td  scope="row"class="text-center">{{$row->request_statusname}}</td>
                                <td  scope="row"class="text-center"><a href="{{url('view_issued_details'.$row->id)}}"><i  id="add" class="btn btn-primary" aria-hidden="true" >View</i></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
      </div>
</div>
<script>
    $(document).ready( function () {
    $('#new-item').DataTable();
} );
</script>



@endsection

