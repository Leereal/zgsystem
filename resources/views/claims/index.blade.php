@extends('layouts.dashboard')
@section('content')
        <div class="right_col" role="main">         
            <div class="page-title">
              <div class="title_left">
                <h3>Claims</h3>
              </div>              
            </div>

            <div class="clearfix"></div>

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>View All Claims</h2>                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    @include('inc.messages')

                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Name</th> 
                          <th>Amount</th>                          
                          <th>Date Submitted</th>
                          <th>Claim Number</th>
                          <th>Client Name</th>    
                          <th>Medical Aid Number</th>                                                
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($claims as $claim)
                          <tr>
                            <td><a href="/claims/{{$claim->id}}"> {{ $claim->serviceprovider->name}}</a></td>
                            <td>{{ $claim->total_amount}}</td>
                            <td>{{ $claim->created_at}}</td>
                            <td>{{ $claim->claim_number}}</td>
                            <td>{{ $claim->client->name}} {{ $claim->client->name}}</td>                            
                            <td>{{ $claim->medical_aid_number}}</td>
                          </tr>
                        @endforeach                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
</div>
@endsection