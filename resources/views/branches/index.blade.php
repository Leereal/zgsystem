@extends('layouts.dashboard')
@section('content')
        <div class="right_col" role="main">         
            <div class="page-title">
              <div class="title_left">
                <h3>Branches <small>Click Add Branch button to add new branch</small></h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

                  @if(Auth::user()->hasRole(['System Admin','Chairman','Principal Officer']))
                  <div class="input-group">
                    <a href="/branches/create">
                      <button type="submit" class="btn btn-primary" >
                         <span class="glyphicon glyphicon-plus"></span> Add Branch 
                      </button>
                    </a>
                  </div>
                  @endif  
                    
              </div>
            </div>

            <div class="clearfix"></div>

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>View All Branches</h2>                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    @include('inc.messages')

                    <table id="datatable-fixed-header" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Address</th>
                          <th>Email</th>                          
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($branches as $branch)
                          <tr>
                            <td><a href="/branches/{{$branch->id}}"> {{ $branch->branch_name}}</a></td>
                            <td>{{ $branch->branch_address}}</td>
                            <td>{{ $branch->branch_email}}</td>                          
                            <td>
                              <a href="/branches/{{$branch->id}}" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
                              <a href="/branches/{{$branch->id}}/edit" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                              @if(Auth::user()->hasRole(['System Admin']))
                              <a onclick="deleteData({{$branch->id}})" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Trash </a>
                              <form method="POST" action="">
                                @method('DELETE')
                                @csrf                                
                              </form>
                              @endif
                            </td>                              
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
   swal({
          title: "Are you sure?",
          text: "Contact Developer before performing this action!",
          icon: "warning",          
          buttons: true,
          dangerMode: true        
        }).then((willDelete)=>{
          if(willDelete){
            $.ajax({
                url : "{{ url('branches') }}" + '/' + id ,
                type: 'POST',
                data: {
                  '_method' : 'DELETE',
                  _token: '{{csrf_token()}}'           
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