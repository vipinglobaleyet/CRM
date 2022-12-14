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
<body>

      <div class="box-header with-border">
        <h3 style="text-align:center"><b><u>Manufactuers Ledger Details</u></b></h3><br>
          <div class="box-tools pull-right">
          </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <!-- /.box-header -->
          @php
           $grand_total=0;
           $total_advance=0;
          $balance_total=0;
          @endphp
            <table  class="table table-bordered table-striped" id="allsupplier" style="width 100%">
              <thead>
                <tr>
                  <th class="text-center">Order No</th>
                  <th class="text-center">Date</th>
                  {{-- <th class="text-center">Manufacturer Name</th> --}}
                  <th class="text-center">Total</th>
                  <th class="text-center">Advance</th>
                  <th class="text-center">Balance</th>
                  <th class="text-center">Updated Amount</th>
                  <th class="text-center">View</th>
                </tr>
              </thead>
                <tbody  id="show_data">
                 <input type="hidden" name="purchase_id" value="" class="form-control">
                    <tr>
                        @foreach($ledger_details as $details)
                         <input type="hidden" name="id[]" id="" value="{{$details->id}}">
                        <tr>
                            <td  class="text-center" style="width:18%"><input type="text" value="{{$details->purchase_orderno}}"  name="expiry_date[]" class="form-control" required readonly></td>
                            <td  class="text-center" style="width:15%"><input type="text" value="{{$details->purchase_date}}"  name="expiry_date[]" class="form-control" required readonly></td>
                            {{-- <td  class="text-center" style="width:18%"><input type="text" value="{{$details->manufactuers_name}}"  name="expiry_date[]" class="form-control" required readonly></td> --}}
                            <td  class="text-center" style="width:10%"><input type="text" value="{{$details->grand_total}}"  name="expiry_date[]" class="form-control" required readonly>
                                @php
                                $grand_total += $details->grand_total;
                             @endphp
                            </td>
                            <td  class="text-center" style="width:10%"><input type="text" value="{{$details->advance_amount}}"  name="expiry_date[]" class="form-control" required readonly>
                                @php
                                $total_advance += $details->advance_amount;
                             @endphp
                            </td>
                            <td  class="text-center" style="width:10%"><input type="text" value="{{$details->pending_amount}}"  name="expiry_date[]" class="form-control" required readonly>
                                @php
                               $balance_total += $details->pending_amount;
                            @endphp
                            </td>
                            <td  class="text-center" style="width:15%">
                                <a type="button" class="btn btn-primary" style="" href="{{url('add_installment'.$details->id)}}"><b>Add Amount</b></a>
                            </td>
                             <td  class="text-center" style="width:15%">
                                <a type="button" class="btn btn-primary" style="" href="{{url('manufacturer_paid_details'.$details->id)}}"><b>Paid Details</b></a>
                            </td>
                            {{-- <td  class="text-center"> <a type="button" class="btn btn-primary" style="width:85%" href="{{url('supplier_payment_details'.$details->id)}}"><b>Payment</b></a></td> --}}
                        </tr>

                        @endforeach
                    </tr>

                </tbody>
            </table>
            <div class="row">
                <div class="col-sm">
                </div>
                <div class="col-sm">
                    <br>
                    <table class="table table-bordered">
                          <tr>
                            <td scope="col"><b>Grand Total</b></td>
                            <td> <input type="text"value="{{$grand_total}}"
                                name="quantity_available"  class="form-control" readonly>

                               </td>
                          </tr>
                          <tr>
                            <td scope="col"><b>Grand Advance Amount</b></td>
                            <td> <input type="text"value="{{$total_advance}}"
                                name="quantity_available"  class="form-control" readonly>

                               </td>
                          </tr>
                          <tr>
                            <td scope="col"><b>Grand Pending Amount</b></td>
                            <td> <input type="text"value="{{$balance_total}}"
                                name="quantity_available"  class="form-control" readonly>

                               </td>
                          </tr>
                        </table>
                      {{-- <div class="row">
                          <div class="col-md-6">
                            <button type="button" class="btn btn-primary text-white" onclick="window.history.back()" style="background-color:#1a3c62;width:100%;" >Close</button>
                           </div>
                            {{-- <div class="col-md-6">
                                <button type="submit" class="btn btn-primary" style="background-color:#1a3c62;width:100%;">Issued</button>
                            </div> --}}
                      {{-- </div> --}}
                      <br>

                </div>
            </div>
</div>
</div>
<script>
    $(function(){
      $("#allsupplier").dataTable();
    })
  </script>
<script src="{{ url('assets/js') }}/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>

@endsection



