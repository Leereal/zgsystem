@extends('layouts.dashboard')
@section('content')
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
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0">
                      <thead>
                        <tr>
                          <th>First Name</th>
                          <th>Surname</th>                          
                          <th>Amount</th>
                          <th>Mode Of Payment</th>
                          <th>Date Of Payment</th>
                          <th>Receipt Number</th>
                          <th>Reversed On</th>                                                                          
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($payments as $payment)
                          <tr>
                            <td><a href="/payments/{{$payment->id}}"> {{ $payment->client->name}}</a></td>
                            <td>{{ $payment->client->surname}}</td>                           
                            <td>{{ $payment->amount}}</td>
                            <td>{{ $payment->mop->name}}</td>
                            <td>{{ $payment->created_at}}</td>
                            <td>{{ $payment->receipt_number}}</td>
                            <td>{{ $payment->deleted_at}}</td>
                          </tr>
                        @endforeach                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
</div>
@endsection