@extends('layouts.dashboard')
@section('content')
        <div class="right_col" role="main">         
            <div class="page-title">
              <div class="title_left">
                <h3><i class="glyphicon glyphicon-cog"></i>Settings</h3>
              </div>
            </div>

            <div class="clearfix"></div>

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Only System Admins are allowed to view this page.</h2>                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    @include('inc.messages')
                    <div class="well" style="overflow: auto">
                      <div class="col-md-8">
                        <div>
                          <h4>To update clients click the following button. This will update status from waiting period.</h4>
                        </div>
                      </div>                     
                      <div class="col-md-4">
                        <form method="POST" action="{{ route('updateStatus') }}">
                          <input type="hidden" name="_method" value="PATCH">
                          @csrf
                          <button type="submit" class="btn bg-primary"><i class="glyphicon glyphicon-play-circle">Run</i></button>
                        </form> 
                      </div>
                    </div>

                    <div class="well" style="overflow: auto">
                      <div class="col-md-8">
                        <div>
                          <h4>To back up database click following button.</h4>
                        </div>
                      </div>                     
                      <div class="col-md-4">
                        <form method="get" action="{{ route('backupdb') }}">
                          
                          <button type="submit" class="btn bg-primary"><i class="glyphicon glyphicon-play-circle">Run</i></button>
                        </form> 
                      </div>
                    </div>

                  </div>
                </div>
              </div>
        </div>
<script type="text/javascript">
  // function updateStatus() {
  //   swal({
  //         title: "Are you sure you?",
  //         text: "Are you sure you want to update records",
  //         icon: "warning",          
  //         button: true,
  //         dangerMode: true        
  //       }).then((willDelete)=>{
  //         if(willDelete){
  //           $.ajax({
  //               url: "{{ url('updateStatus') }}",
  //               method: 'PATCH',
  //               data: {                          
  //                 _token: '{{csrf_token()}}'           
  //               },
  //                 success : function(data) { 
  //                   swal({
  //                     title: "Successfully Updated",
  //                     text: "Record Updated Successfully",
  //                     icon: "success",
  //                     button: "Done!"                       
  //                   }).then(function(){$(location).attr('href', '/settings');});
  //                 },
  //                 error : function(data){        
  //                   swal({
  //                     title: "Ooops..., failed!",
  //                     text: data.responseJSON,          
  //                     icon: "error",          
  //                     timer : '6500'          
  //                   })        
  //                 }
  //             });      
  //         }
  //         else {
  //           swal("Cancelled");
  //         }
  //       });

  // }
</script>
@endsection