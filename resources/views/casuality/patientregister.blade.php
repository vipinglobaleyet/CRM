@extends('layouts.hmsmain')
@section('content')
<div class="container">
    <div class="py-5 text-center">
        @if(Session::has('patientregistered'))
            <div class="alert alert-dark" role="alert">
                {{ Session::get('patientregistered')}}
            </div>
        @endif
        <h2>Patient Register</h2>
        <hr class="mb-4">
    </div>
    @php
        if($_POST){
        echo "<script>
            if ( window.history.replaceState ) {
                window.history.replaceState( null, null, window.location.href );
            }
        </script>";}
    @endphp
    <div class="row">
        <div class="col-md-12 order-md-1">
            <meta name="csrf-token" content="{{ csrf_token() }}" />
                <form method="post" action="{{url('search_casu_pat')}}">
	                @csrf
                    <div class="row">
                        <div class="col-md-7 col-lg-7">
                            {{-- <label> patient name display</label>
                            <input type="text" id="display_pt_name" class="form-control" > --}}
                            {{-- <a href="#" class="edits" data-toggle="modal" id="patient_edit" data-bs-toggle="modal"
                            data-bs-target="#exampleModalLong"><i class="fas fa-book"></i></a> --}}
                        </div>
                        <div class="col-md-5 col-lg-5 text-end">
                            <a href="{{url('catuality_register')}}"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="">
                                Add Patient
                            </button></a>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="username">Patient Name</label>
                        <div class="input-group">
                            <div class="input-group-prepend"></div>
                                <input type="text" name="custName" class="form-control"> <br>
                                <button type="submit" class="btn btn-primary"> <span class="glyphicon glyphicon-search"></span>SEARCH</button>
                            </div>
                        </div>
                        <div class="pb-20">
                            <table class="table table-striped" id="countit">
                                <thead>
                                    @if(!empty($patient))
                                        @foreach ($patient as $pat)
                                            <tr>
                                                <th scope="row">Patient Id</th>
                                                <td scope="row">{{$pat->id}}</td>
                                                <th scope="row">Patient Name</th>
                                                <td scope="row">{{$pat->firstname}}</td>
                                                <th scope="row">Mobile No</th>
                                                <td scope="row">{{$pat->phoneno}}</td>
                                                <th scope="row">Address</th>
                                                <td scope="row">{{$pat->address}}</td>
                                                <th scope="row">Place</th>
                                                <td scope="row">{{$pat->place}}</td>
                                                <th scope="row">Gender</th>
                                                <td scope="row">{{$pat->gender}}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </thead>
                            </table>
                        </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <div class="mb-3">
                                <label>Casuality Type</label>
                                <select class="form-control" name="visiting" id="visiting">
                                    <option value="">Select</option>
                                    {{-- @foreach($casu_type as $type)
                                        <option  class="dropdown-item" value="{{$type->id}}" >{{$type->casu_name}}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>
                    </div>
          <div class="col-md-3 col-lg-3">
              <div class="mb-3">
              <label>Date</label>
              <div><input class="form-control" type="text" name="date" value="<?php echo date('d-m-Y'); ?>" /></div>
              <div class="invalid-feedback">
                Please enter date.
              </div>
          </div>
          </div>
          <div class="col-md-3 col-lg-3">
            <div class="mb-3">
              <?php
                date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
              ?>
            <label>Time</label>
            <div><input class="form-control" type="time" value="<?php echo date('H:i:s'); ?>" /></div>
            <div class="invalid-feedback">
              Please enter date.
            </div>
        </div>
        </div>
      </div>
        {{-- <div class="py-5 text-center">
        <h4>Bystander Details</h4>
        <hr class="mb-4">
        </div>

        <div class="row">
          <div class="col-md-4 col-md-4">
             <div class="mb-3">
            <label for="address">Bystander Name</label>
            <input type="text" class="form-control" name="b_name" id="username" placeholder="bystander name" required>
            <div class="invalid-feedback">
              Please enter name.
            </div>
          </div>
          </div>
          <div class="col-md-4 col-lg-4">
            <div class="mb-3">
                 <label for="email">Address <span class="text-muted"></span></label>
                 <input type="textarea" class="form-control" name="address" id="address" placeholder="address">
                 <div class="invalid-feedback">
                   Please enter address.
                 </div>
               </div>
         </div>
         <div class="col-md-4 col-lg-4">
          <div class="mb-3">
               <label for="email">Mobile No <span class="text-muted"></span></label>
               <input type="number" class="form-control" name="phoneno" id="email" placeholder="mobile no">
               <div class="invalid-feedback">
                 Please enter a valid phone no.
               </div>
             </div>
       </div>
          </div>

        <hr class="mb-4">

        <button type="submit" class="btn btn-primary btn-lg btn-block" type="submit">Register</button>

    </div>
  </div> --}}
  </form>
</div>
<div class="col-md-4 col-sm-12 mb-30">


  <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">

              <div class="modal-body">
                  <form id="add-event">
                      <div class="modal-body">
                          <h4 style="text-align:center;" class="text-blue h4 mb-10">Patient Details</h4>
                          <hr class="mb-4">
                          <div class="row">
                            <div class="col-md-9 col-lg-9">
                            </div>
                            <div class="col-md-3 col-lg-3">
                              <label>Patient Id</label>
                              <input type="text" id="display_pt_id" class="form-control" >
                              </div>
                        </div>
                          <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="mb-3">
                                <label>Patient Name</label>
                                <input type="text" id="display_pt_name" class="form-control" >
                                </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="mb-3">
                                <label>Address</label>
                                <input type="text" id="display_pt_address" class="form-control" >
                                </div>
                            </div>
                          </div>
                        <div class="row">
                          <div class="col-md-6 col-lg-6">
                              <div class="mb-3">
                              <label>Age</label>
                              <input type="text" id="display_pt_age" class="form-control" >
                          </div>
                          </div>
                          <div class="col-md-6 col-lg-6">
                            <div class="mb-3">
                            <label>Mobile No</label>
                            <input type="text" id="display_pt_mobile" class="form-control" >
                        </div>
                        </div>
                      </div>
                    </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                  </div>
              </form>
          </div>

      </div>
  </div>
</div>

</div>

<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>
<script>
  $(document).ready(function(){
           $('.searchingBook').select2();
  });

  function patient_data(val){
 var pt_id=val;
        $.ajax({
            url: '{{ url("patient_details") }}',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: "POST",
            data: {patient_id: pt_id},
            dataType: 'json',
            success: function (data) {
                console.log(data);
                $("#display_pt_id").val(data.id );
                $("#display_pt_name").val(data.firstname);
                $("#display_pt_address").val(data.address);
                $("#display_pt_age").val(data.age);
                $("#display_pt_mobile").val(data.phoneno);
            }
        })











  }
</script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
 <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
@endsection
