@extends('layouts.dashboard')
@section('content')
        <div class="right_col" role="main">         
            <div class="page-title">
              <div class="title_left">
                <h3>Requests to Verify</h3>
              </div>              
            </div>

            <div class="clearfix"></div>

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>View All Requests</h2>                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    @include('inc.messages')

                    <table id="datatable-fixed-header" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Name</th> 
                          <th>Surname</th>
                          <th>Medical Aid Number</th>
                          <th>Service Provider</th>
                          <th>Branch</th>
                          <th>Payment Status</th>    
                          <th>Action</th>                                                
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($claims as $claim)
                          <tr>
                            <td><a href="/claims/{{$claim->id}}"> {{ $claim->serviceprovider->name}}</a></td>
                            <td>{{ $claim->amount}}</td>
                            <td>{{ $claim->mod}}</td>
                            <td>{{ $claim->dop}}</td>
                            <td>{{ $claim->branch['branch_name']}}</td>                            
                            <td>{{ $claim->active_status ? 'Active' : 'InActive'}}</td>                                                     
                            <td>
                              <a href="/claims/{{$claim->id}}" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
                              <a href="/claims/{{$claim->id}}/edit" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                              <a href="#" onclick="$(this).parent().find('form').submit()" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                              <form method="POST" action="{{ route('claims.destroy',$claim->id) }}">
                                @method('DELETE')
                                @csrf                                
                              </form>
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