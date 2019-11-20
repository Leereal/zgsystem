@extends('layouts.dashboard')
@section('content')
        <div class="right_col" role="main">         
            <div class="page-title">
              <div class="title_left">
                <h3>Requests</h3>
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
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0">
                      <thead>
                        <tr>
                          <th>First Name</th>
                          <th>Surname</th>
                          <th>Medical Aid number</th>
                          <th>Service Provider</th>                                                     
                          @if(Auth::user()->hasRole(['Team Leader','Principal Officer','System Admin','Chairman']))
                          <th>Action</th>
                          @endif                                                                     
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($checkrequests as $checkrequest)
                          <tr>
                            <td>{{ $checkrequest->client->name ? $checkrequest->client->name : $checkrequest->dependent->name }}</td>
                            <td>{{ $checkrequest->client->surname ? $checkrequest->client->surname : $checkrequest->dependent->surname }}</td>
                            <td>{{ $checkrequest->medical_aid_number}}</td>
                            <td>{{ $checkrequest->service_provider->name}}</td>     
                            @if(Auth::user()->hasRole(['Team Leader','Principal Officer','System Admin','Chairman']))
                            <td>
                              @if($checkrequest->approved==2)
                              <a onclick="approveData({{$checkrequest->id}})" class="btn btn-success btn-xs"><i class="fa fa-check"></i>Approve</a>
                              <a onclick="rejectData({{$checkrequest->id}})" class="btn btn-danger btn-xs"><i class="fa fa-ban"></i>Reject</a> 
                              @else
                              @if($checkrequest->approved==1) 
                              <span class="label label-success">Approved : {{$checkrequest->pre_code}}</span>
                              @else
                              <span class="label label-danger">Rejected</span>
                              @endif
                              &nbsp <a onclick="deleteData({{$checkrequest->id}})" class="btn btn-danger btn-xs"><i class="fa fa-times"></i>Remove</a>
                              @endif            
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
  function approveData(id){
   swal({
          title: "Are you sure?",
          text: "You won't be able to undo this action!!",
          icon: "warning",          
          buttons: true,
          dangerMode: true        
        }).then((willDelete)=>{
          if(willDelete){
           
            $.ajax({
                url : "{{ url('requests') }}" + '/' + id ,
                type: 'PATCH',
                data: {
                  '_method' : 'PATCH',
                  _token: '{{csrf_token()}}',
                  approved: '1',
                  pre_code: "PRE" + new Date().getTime()           
                },
                  success : function(data) {                                        
                    swal({
                      title: "Deleted Successfully",
                      text: "Record deleted successfully",
                      icon: "success",
                      button: "Done!"                       
                    }).then(function(){window.location.reload();});
                  },
                  error : function(data){        
                    swal({
                      title: "Ooops..., failed!",
                      text: "Failed",         
                      icon: "error",          
                      timer : '6500'          
                    });        
                  }
              });      
          }
          else {
            swal("Cancelled");
          }
        });

}
function rejectData(id){
   swal({
          title: "Are you sure?",
          text: "You won't be able to undo this action!!",
          icon: "warning",          
          buttons: true,
          dangerMode: true        
        }).then((willDelete)=>{
          if(willDelete){
            $.ajax({
                url : "{{ url('requests') }}" + '/' + id ,
                type: 'PATCH',
                data: {
                  '_method' : 'PATCH',
                  _token: '{{csrf_token()}}',
                  approved: '0'          
                },
                  success : function(data) {                                        
                    swal({
                      title: "Deleted Successfully",
                      text: "Record deleted successfully",
                      icon: "success",
                      button: "Done!"                       
                    }).then(function(){window.location.reload();});
                  },
                  error : function(data){        
                    swal({
                      title: "Ooops..., failed!",
                      text: "Failed",         
                      icon: "error",          
                      timer : '6500'          
                    });        
                  }
              });      
          }
          else {
            swal("Cancelled");
          }
        });

}

 function deleteData(id){
   swal({
          title: "Are you sure?",
          text: "You won't be able to undo this action!!",
          icon: "warning",          
          buttons: true,
          dangerMode: true        
        }).then((willDelete)=>{
          if(willDelete){
            $.ajax({
                url : "{{ url('requests') }}" + '/' + id ,
                type: 'POST',
                data: {
                  '_method' : 'DELETE',
                  _token: '{{csrf_token()}}',                          
                },
                  success : function(data) {                                        
                    swal({
                      title: "Deleted Successfully",
                      text: "Record deleted successfully",
                      icon: "success",
                      button: "Done!"                       
                    }).then(function(){window.location.reload();});
                  },
                  error : function(data){        
                    swal({
                      title: "Ooops..., failed!",
                      text: "Failed",         
                      icon: "error",          
                      timer : '6500'          
                    });        
                  }
              });      
          }
          else {
            swal("Cancelled");
          }
        });

}
</script>

@endsection