@extends('layouts.dashboard')
@section('content')
        <div class="right_col" role="main">         
            <div class="page-title">
              <div class="title_left">
                <h3>Dependents</h3>
              </div>
            </div>
            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                @if(!Auth::user()->hasRole(['Client','Service Provider','Brand Ambassador']))                  
                  <a href="/clients/dependents/{{$dependents[0]->client->id}}" class="btn btn-primary">
                    <span class="glyphicon glyphicon-plus"></span>Add Dependent
                  </a>                 
                @endif
              </div>
            </div>

            <div class="clearfix"></div>

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>View All Dependents</h2>                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                   {{--  @include('inc.messages') --}}
                    <div>
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>First Name</th>
                          <th>Surname</th>
                          <th>ID Number</th>                         
                          <th>Medical Aid Number</th>
                          <th>Plan</th> 
                          <th>Principal</th>
                          <th>Action</th>     
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($dependents as $dependent)
                          <tr>
                            <td><a href="/clients/dependents/{{$dependent->id}}"> {{ $dependent->name}}</a></td>
                            <td>{{ $dependent->surname}}</td>
                            <td>{{ $dependent->id_number}}</td>                           
                            <td>{{ $dependent->medical_aid_number}}</td>
                            <td>{{ $dependent->plan->name}}</td>
                            <td>{{ $dependent->client->name}}  {{ $dependent->client->surname}}</td>
                            <td>
                              <a href="/clients/dependents/{{$dependent->id}}/profile" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
                              <a href="/clients/dependents/{{$dependent->id}}/edit" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a> 
                              @if(Auth::user()->hasRole(['System Admin','Chairman','Principal Officer']))
                              <a href="#" onclick="$(this).parent().find('form').submit()" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                              <form method="POST" action="{{ route('dependents.destroy',$dependent->id) }}">
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
</div>
<script type="text/javascript">
function deleteData(id){
   swal({
          title: "Are you sure?",
          text: "After deleting you won't be able to undo!",
          icon: "warning",          
          button: true,
          dangerMode: true        
        }).then((willDelete)=>{
          if(willDelete){
            $.ajax({
                url : "{{ url('banks') }}" + '/' + id ,
                type: 'POST',
                data: {
                  '_method' : 'DELETE',                  
                  id : id,
                  name: $('#name').val(),
                  account_number: $('#account_number').val(),
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
            swal("Thanks for cancelling");
          }
        });

}

</script>
@endsection