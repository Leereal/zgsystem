@extends('layouts.dashboard')
@section('content')
<style type="text/css">
  .dataTables_wrapper .dt-buttons {
  float:none;
  text-align:center;
}
</style>
<link href="https://cdn.datatables.net/buttons/1.6.0/css/buttons.dataTables.min.css" rel="stylesheet">
        <div class="right_col" role="main">
            <div class="page-title">
              <div class="title_left">
                <h3>Payments <small>Click Add Payment to make payment</small></h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <a href="/payments/create">
                      <button type="submit" class="btn btn-primary" >
                         <span class="glyphicon glyphicon-plus"></span> Add Payment
                      </button>
                    </a>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>View All Payments</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    @include('inc.messages')
                    <div class="well " style="overflow: auto">
                      <form  method="GET" action="{{ route('payments.index') }}">
                        <div class="col-sm-3">
                          <div id="reportrange_right" class="pull-left" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                            <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="item form-group">
                            <div class="">
                              <select class="select2_single form-control" tabindex="-1" id="mop">
                                <option value="">--Mode Of Payment--</option>
                                @foreach($mops as $mop)
                                <option value="{{ $mop->id }}">{{ $mop->name }}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="item form-group">
                          <div class="">
                            <select class="select2_single form-control" tabindex="-1" id="plan">
                              <option value="">--Plans--</option>
                              @foreach($plans as $plan)
                              <option value="{{ $plan->id }}">{{ $plan->name }}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="item form-group">
                            <button onclick="filter()" class="btn btn-success">Filter</button>
                          </div>
                        </div>
                      </form>
                    </div>

                    <table id="table1" class="table-striped table-bordered display nowrap" style="width:100%">
                      <thead>
                        <tr>
                          <th>First Name</th>
                          <th>Surname</th>
                          <th>Medical Aid number</th>
                          <th>Amount</th>
                          <th>Mode Of Payment</th>
                          <th>Plan</th>
                          <th>Date Of Payment</th>
                          <th>Receipt Number</th>
                          @if(Auth::user()->hasRole(['Team Leader','Principal Officer','System Admin','Chairman']))
                          <th>Action</th>
                          @endif
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($payments as $payment)
                          <tr>
                            <td><a href="/payments/{{$payment->id}}"> {{ $payment->client->name}}</a></td>
                            <td>{{ $payment->client->surname}}</td>
                            <td>{{ $payment->client->medical_aid_number}}</td>
                            <td>{{ $payment->amount}}</td>
                            <td>{{ $payment->mop->name}}</td>
                            <td>{{ $payment->plan->name}}</td>
                            <td>{{ $payment->created_at}}</td>
                            <td>{{ $payment->receipt_number}}</td>
                            @if(Auth::user()->hasRole(['Team Leader','Principal Officer','System Admin','Chairman']))
                            <td>
                              <a onclick="deleteData({{$payment->id}})" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-backward"></i> Reverse</a>
                            </td>
                            @endif
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
</div>

<script type="text/javascript">

function deleteData(id){
    var url = "{{ url('payments') }}" + '/' + id;
    del(url);
    }

</script>

@endsection
