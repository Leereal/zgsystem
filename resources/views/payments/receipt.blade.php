@extends('layouts.dashboard')
@section('content')
<style type="text/css">
  @media print {
  body * {
    visibility: hidden;
  }
  #invoicePrint, #invoicePrint * {
    visibility: visible;
  }
  #invoicePrint {
    position: absolute;
    left: 0;
    top: 0;
  }
}
@page { size: auto;  margin: 0mm; }
</style>
        <div class="right_col" role="main">         
            <div class="page-title">
              <div class="title_left">
                <h3>Receipt</small></h3>
              </div>
            </div>

            <div class="clearfix"></div>

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Receipt For Premium Payment</h2>                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    @include('inc.messages')

                    <section class="content invoice" >
                      <!-- title row -->
                      <div id="invoicePrint">
                      <div class="row">
                        <div class="col-xs-12 invoice-header">
                          <span class="pull-left"><img src="{{asset('images/favicon.png')}}" alt="..." width="30" height="30" class="img-circle"></span>
                        <h3>
                             Zim General Medical Aid Fund
                            <small class="pull-right">Date: {{ $payment->created_at->format('d M Y')}}</small>
                        </h3>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                          From
                          <address>
                              <strong>{{ Auth::user()->branch->branch_name }}</strong>
                              <br>{{ Auth::user()->branch->branch_address }}                              
                              <br>Phone: {{ Auth::user()->branch->branch_phone}}
                              <br>Email: {{ Auth::user()->branch->branch_email }}
                          </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                          To
                          <address>
                              <strong>{{ $payment->client->title }} {{ $payment->client->name }} {{ $payment->client->surname }}</strong>
                              <br>{{ $payment->client->address}}                              
                              <br>Cell: {{ $payment->client->cellphone}}
                              <br>Email: {{ $payment->client->email}}
                          </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                          <b>Receipt Number {{ $payment->receipt_number}}</b>
                          <br>
                          <br>
                          <b>Done By:</b> {{ Auth::user()->name }}                                                  
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <!-- Table row -->
                      <div class="row">
                        <div class="col-xs-12 table">
                          <table class="table table-striped">
                            <thead>
                              <tr>                               
                                <th>Date</th>
                                <th>Medical Aid Number</th>
                                <th style="width: 50%">Medical Aid Plan</th>
                                <th>Subtotal</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>{{ $payment->created_at}}</td>
                                <td>{{ $payment->client->medical_aid_number}}</td>
                                <td>{{ $payment->plan->name}}</td>                               
                                <td>{{ $payment->amount}}</td>
                              </tr>                             
                            </tbody>
                          </table>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-xs-6">
                          <p class="lead">Payment Methods:</p>
                          <span>Ecocash |</span>
                          <span>Cash |</span>
                          <span>Swipe |</span>
                          <span>Bank Transfer</span>                          
                          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                           Thank you for your paymemnt!
                          </p>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-6">
                          <p class="lead">Amount Due 2/22/2014</p>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <th style="width:50%">Subtotal:</th>
                                  <td>{{ $payment->amount}}</td>
                                </tr>                                
                                <tr>
                                  <th>Total:</th>
                                  <td>{{ $payment->amount}}</td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->
                    </div>

                      <!-- this row will not appear when printing -->
                      <div class="row no-print">
                        <div class="col-xs-12">
                          <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                        </div>
                      </div>
                    </section>
                  </div>
                </div>
              </div>
</div>

@endsection