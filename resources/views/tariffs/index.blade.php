@extends('layouts.dashboard')
@section('content')
        <div class="right_col" role="main">         
            <div class="page-title">
              <div class="title_left">
                <h3>Tariffs <small>Click Add Tariff button to add new tariff</small></h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

                  @if(!Auth::user()->hasRole(['Client','Service Provider']))
                  <div class="input-group">
                    <a href="/tariffs/create">
                      <button type="submit" class="btn btn-primary" >
                         <span class="glyphicon glyphicon-plus"></span> Add Tariff 
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
                    <h2>View All Tariffs</h2>                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    @include('inc.messages')

                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Code</th>                                                    
                          <th>Fee</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($tariffs as $tariff)
                          <tr>
                            <td><a href="/tariffs/{{$tariff->id}}"> {{ $tariff->code}}</a></td>                            
                            <td>{{ $tariff->fee}}</td>                          
                            <td><a href="/tariffs/{{$tariff->id}}" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
                              <a href="/tariffs/{{$tariff->id}}/edit" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                              <a onclick="deleteData({{$tariff->id}})" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Trash </a>
                              <form method="POST" action="">
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
<script type="text/javascript">
  function deleteData(id){
   swal({
          title: "Are you sure?",
          text: "You won't be able to recover this info",
          icon: "warning",          
          buttons: true,
          dangerMode: true        
        }).then((willDelete)=>{
          if(willDelete){
            $.ajax({
                url : "{{ url('tariffs') }}" + '/' + id ,
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