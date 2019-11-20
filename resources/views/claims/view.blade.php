@extends('layouts.dashboard')
@section('content')
        <div class="right_col" role="main">         
            <div class="page-title">
              <div class="title_left">
                <h3>Clients <small>Search for client to Add Claim</small></h3>
              </div>
            </div>

            <div class="clearfix"></div>

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Search For Clients To Make Payment</h2>                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    @include('inc.messages')

                    <table id="datatable-fixed-header" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>                          
                          <th>First Name</th>
                          <th>Surname</th>
                          <th>Medical Aid number</th>
                          <th>Plan</th>
                          <th>ID Number</th>                             
                          <th>Action</th>                                                
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($clients as $client)
                          <tr>                            
                            <td><a href="/clients/{{$client->id}}"> {{ $client->name}}</a></td>
                            <td>{{ $client->surname}}</td>
                            <td>{{ $client->medical_aid_number}}</td>
                            <td>{{ $client->plan->name}}</td>
                            <td>{{ $client->id_number}}</td>                                           
                            <td>
                              <a href="/clients/{{$client->id}}" class="btn btn-primary btn-xs" 
                              ><i class="glyphicon glyphicon-eye-open"></i> View Client </a>
                              <a href="/claims/{{$client->id}}" class="btn btn-info btn-xs"><i class="fa fa-plus"></i>Add Claim</a>
                            </td>                              
                          </tr>                          
                        @endforeach                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
</div>
@endsection