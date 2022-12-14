@extends('layouts.hmsmain')
@section('content')
 <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{ url('assets/css') }}/sweetalert.css">

 <style>.swal-button {

        width:fit-content;

      }
    </style>

<div class="container">

	<br>
    <h2>Journal</h2>

        <a href="{{ url("create_transaction") }}"><button  class="btn btn-primary"> Create Transaction</button></a>

      <div class="table-responsive">
          <br>
          <table class="table table-striped ">
              <tr>
                  <form method="post" action="{{ url("journal")}}">
                      @csrf
                  <td>From Date</td>
                  <td><input type="date" value="{{ $journal_from }}"  name="journal_from" required  class="form-control"></td>
                  <td>To Date</td>
                  <td><input type="date" value="{{ $journal_to }}"   name="journal_to" required class="form-control"></td>
                  <td><button class="btn btn-primary" type="submit" value="search" style="width:fit-content;">Search</button></td>
                  {{--  <td><button class="btn btn-primary" type="button"  style="width:fit-content;">Refresh</button></td>  --}}
                </form>
              </tr>
          </table>
<table class="table table-striped" id="allpatients" style="margin-top: 40px; margin-bottom:0px; border-color:black; padding:0;">
  <thead>
    <tr>
      <th scope="col">Sl</th>
      <th scope="col">Date</th>
        <th>

         <table class="table  border-none shadow-none" style="margin-bottom:0px" >
      <tr>

      <th>Purticulars</th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th>Debit</th>

      <th>Credit</th>


      </tr>
      </table>



        </th>
      {{--  <th scope="col">Hospital</th>  --}}
      <th scope="col">Action</th>

    </tr>
       <tr>
      <th scope="col"></th>
      <th scope="col"></th>
        <th>

    <table class="table table" >

      </table>
        </th>
      <th scope="col"></th>
      <th scope="col"></th>

    </tr>
  </thead>
  <tbody>
@php
$no=1;
@endphp
 @foreach($journal_transaction as $jr)

    @php

         $journal_debit_items=DB::table('journal_items as q')
        ->Leftjoin('ledgeraccounts as a', 'a.id', '=', 'q.journal_transaction_account')
        ->Leftjoin('ledgeraccount_subcategories as z', 'z.id', '=', 'a.accounts_subcategory')
        ->Leftjoin('ledgeraccount_categories as b', 'b.id', '=', 'a.accounts_category')
        ->select('q.*','q.id as journal_id','b.ledgeraccount_categories as cat_name', 'a.accounts_name as from_name','a.id as from_id','z.ledgeraccount_subcategories as subcat_name')
        ->where('q.journal_items_transaction',$jr->transaction_id)
        ->orderBy('q.journal_items_type', 'desc')
        ->get();

            @endphp

           {{--  {{ dd($journal_debit_items)}}  --}}

      <tr class="product_data" class="data">
          <td id="name">{{ $no++ }}</td>
          <td >{{ date('d M Y',strtotime($jr->journal_date)) }}</td>
          <td>
                            <table class="table table" >
                            <tr>
                                    <th></th>
                                <th></th>
                                <th></th>

                                <th></th>

                            </tr>


                            @foreach($journal_debit_items as $key)
                                <tr>


                                <td>

                                @if($key->journal_items_type==1)
                                To  {{ucfirst($key->from_name." [ ".$key->cat_name." ] ")}} A/c &nbsp;   <br>
                                 @elseif($key->journal_items_type==2)
                                {{ucfirst($key->from_name." [ ".$key->cat_name." ] ")}} A/c &nbsp; Dr.<br>

                                @endif


                                </td>
                                <td>

                                    @if($key->journal_items_type==2)
                                    {{$key->journal_items_amount}}
                                    @endif

                                    </td>


                                <td>
                                @if($key->journal_items_type==1)

                                {{$key->journal_items_amount}}

                                @endif

                                </td>







                                </tr>
                                    @endforeach
                                </table>
                                <br>
                                {{ "( ".$jr->journal_narration." )" }}

          </td>
             {{--  <td>

                    {{ $jr->journal_hospital}}

                 </td>  --}}
                 <td>

                    <a href="{{ url('edit_journal/').$jr->transaction_id }}" class="edits" ><i class="fas fa-edit" ></i></a>
                   <a onclick="delete_journal({{$jr->transaction_id}})"><i class="fas fa-trash-alt"></i></a></td>
      </tr>
 @endforeach



  </tbody>

</table>


<div style="float:right; margin-top:10px;">
{!! $journal_transaction->links() !!}
{{--  {!! $journal_transaction->appends(['journal_from' => '10-12-2022',])->links() !!}  --}}
Showing {{ $journal_transaction->firstItem() }}???{{ $journal_transaction->lastItem() }} of {{ $journal_transaction->total() }} results
</div>

      </div>
</div>







 <script src="{{ url('assets/js') }}/jquery.min.js"></script>
<script src="{{ url('assets/js') }}/sweetalert.min.js"></script>

<script>
    $(function () {
  $('[data-toggle="popover"]').popover()
  })
  </script>

  <script>



      function delete_journal(value){

                            swal({
                    title: "Are you sure?",
                    text: "Once deleted,The complete datas in that trasnsaction will be deleted!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    })
                    .then((willDelete) => {
                    if (willDelete) {



                        swal("Poof! Transaction has been deleted!", {
                        icon: "success",
                        });

                        $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    });

                    $.ajax({
                    url:"{{ route('delete_full_journal_transaction') }}",
                    type:"POST",
                    data: {
                        journal_transaction_id: value,
                    },
                    success:function (data) {
                        //console.log(data);
                        if(data.response="success"){

                            swal({title: "Success!",
                            text: "You Deleted the Transaction!",
                            icon: "success",
                            button: "OK"})
                            .then((value) => {
                            window.location.reload();
                            });


                        }
                    }
                    })



                    } else {
                        swal("Not Deleted!");
                    }
                    });
      }
  </script>

@endsection



