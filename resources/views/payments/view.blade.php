@extends('layouts.dashboard')
@section('content')
        <div class="right_col" role="main">         
            <div class="page-title">
              <div class="title_left">
                <h3>Payments</h3>
              </div>             
            </div>

            <div class="clearfix"></div>

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>View All Payments For @if (!empty($payments[0]->client->name)){{ $payments[0]->client->name }} {{ $payments[0]->client->surname }} @endif</h2>                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    @include('inc.messages')                   
                    <table id="datatable-buttons" class="data table table-striped no-margin">
                      <thead>
                        <tr>                          
                          <th>Date</th>
                          <th>Description</th>
                          <th>Amount</th>
                          <th>Receipt Number</th>
                          <th>MOP</th>
                          <th>Done By</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($payments as $payment)
                        <tr>
                          <td>{{ $payment->created_at }}</td>
                          <td>{{ $payment->description }}</td>
                          <td>{{ $payment->amount }}</td>
                          <td>{{ $payment->receipt_number }}</td>
                          <td>{{ $payment->mop->name }}</td>
                          <td>{{ $payment->user->name }}</td>                         
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
</div>

@endsection