@extends('layouts.dashboard')
@section('content')
        <div class="right_col" role="main">         
            <div class="page-title">
              <div class="title_left">
                <h3>Clients <small>Click Add Client button to add new client</small></h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  @if(!Auth::user()->hasRole(['Client','Service Provider','Brand Ambassador']))                  
                    <a href="/clients/create" class="btn btn-primary">
                      <span class="glyphicon glyphicon-plus"></span>Add Client
                    </a>                 
                  @endif
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>View All Clients</h2>                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    @include('inc.messages')
                    <div>
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th></th>
                          <th>First Name</th>
                          <th>Surname</th>
                          <th>ID Number</th>                         
                          <th>Medical Aid Number</th>
                          <th>Plan</th>                          
                          <th>Action</th>                          
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($clients as $client)
                          <tr>
                            <td><button>+</button></td>
                            <td><a href="/clients/{{$client->id}}"> {{ $client->name}}</a></td>
                            <td>{{ $client->surname}}</td>
                            <td>{{ $client->id_number}}</td>                           
                            <td>{{ $client->medical_aid_number}}</td> 
                            <td>{{ $client->plan->name}}</td>                    
                            <td>
                              <a href="/clients/{{$client->id}}" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
                              <a href="/clients/{{$client->id}}/edit" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                              @if(!$client->dependents_count)
                              <a href="/clients/dependents/{{$client->id}}" class="btn btn-info btn-xs"><i class="fa fa-plus"></i> Dependent</a>
                              @else
                              <a href="/clients/dependents/view/{{$client->id}}" class="btn btn-info btn-xs"><strong style="color:red">{{ $client->dependents_count }}</strong> Dependent(s)</a>
                              @endif
                              @if(Auth::user()->hasRole(['System Admin']))
                              <a href="#" onclick="$(this).parent().find('form').submit()" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                              <form method="POST" action="{{ route('clients.destroy',$client->id) }}">
                                @method('DELETE')
                                @csrf                                
                              </form>
                              @endif
                            </td>                              
                          </tr>
                          @foreach($client->dependents as $dependent)
                          <tr>
                            <td><button>+</button></td>
                            <td><a href="/clients/dependents/{{$dependent->id}}"> {{ $dependent->name}}</a></td>
                            <td>{{ $dependent->surname}}</td>
                            <td>{{ $dependent->id_number}}</td>                           
                            <td>{{ $dependent->medical_aid_number}}</td> 
                            <td>{{ $dependent->plan->name}}</td>                    
                            <td>
                              <a href="/clients/dependent/{{$dependent->id}}" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
                              <a href="/clients/dependent/{{$dependent->id}}/edit" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>                             
                              
                            </td>                              
                          </tr>
                          @endforeach
                        @endforeach                        
                      </tbody>
                    </table>
                  </div>
                  </div>
                </div>
              </div>
</div>
<script type="text/javascript">

  //Function to open modal after button click to add new data
  function addForm() {   
    $('input[name_method]').val('POST');
    $('#modal-form').modal('show');
    $('#modal-form form')[0].reset();
    $('#modal-title').text('Add New Client');
    $('#insertbutton').text('Submit');
  }

  //Function to open modal after button click to edit data
 function viewInfo(id){

      var k = ".view_"+id;
      var name = $(k).data('name'); 
      var md =    
      $('#modal-view').modal('show');
      $('#modal-view form')[0].reset();
      $('#modal-title').text("Details for : " + name + " (" + $('#medical_aid_number').val($(k).data('medical_aid_number')));
      $('#name').val(name);
      $('#surname').val($('#surname').val($(k).data('surname')));
      $('#id_number').val($('#id_number').val($(k).data('id_number')));
      $('#title').val($('#title').val($(k).data('title')));
      $('#employer_number').val($('#employer_number').val($(k).data('employer_number')));
      $('#employer_name').val($('#employer_name').val($(k).data('employer_name')));
      $('#cellphone').val($('#cellphone').val($(k).data('cellphone')));
      $('#home_telephone').val($('#home_telephone').val($(k).data('home_telephone')));
      $('#business_telephone').val($('#business_telephone').val($(k).data('business_telephone')));
      $('#home_telephone').val($('#home_telephone').val($(k).data('home_telephone')));
      $('#plan').val($('#plan').val($(k).data('plan')));
      $('#user').val($('#user').val($(k).data('user')));
      $('#branch').val($('#branch').val($(k).data('branch')));
      $('#email').val($('#email').val($(k).data('email')));
      $('#address').val($('#address').val($(k).data('address')));
      $('#period_status').val($('#period_status').val($(k).data('period_status')));     
    }

    //Function to open modal after button click to view data
 function editForm(id){
  
      var k = ".edit_"+id;
      var name = $(k).data('name');
      $('input[name_method]').val('PATCH');
      $('#modal-form').modal('show');
      $('#modal-form form')[0].reset();
      $('#modal-title').text("Edit Bank : " + name);      
      $('#record_id').val($(k).data('id'));           
      $('#name').val(name);
      $('#account_number').val($(k).data('account_number'));
      $('#insertbutton').text('Save Changes');
      $('#insertbutton').attr("onclick","editData("+id+")");  
    }

  //================Function to save data================//
  function saveData(e) {
    //Prevent default page loading by link click
    e = e || window.event;
    e.preventDefault();

    //Load data to Ajax for submission
   $.ajax({
      url: "{{ url('banks') }}",
      method: 'POST',
      data: {
        name: $('#name').val(),
        account_number: $('#account_number').val(),
        _token: '{{csrf_token()}}'           
      },
        success : function(data) {
          $('#modal-form').modal('hide');
          
          swal({
            title: "Successfully Saved",
            text: "Record Saved Successfully",
            icon: "success",
            button: "Done!"                       
          }).then(function(){window.location.reload();});
        },
        error : function(data){        
          swal({
            title: "Ooops..., failed!",
            text: data.responseJSON.errors.name[0],          
            icon: "error",          
            timer : '6500'          
          })        
        }
    });
    //Close of Ajax Data

  }

  function editData(id) {
   
    //Load data to Ajax for submission
   $.ajax({
      url: "{{ url('banks') }}" + '/' + id,
      method: 'PATCH',
      data: {
        name: $('#name').val(),
        account_number: $('#account_number').val(),
        _token: '{{csrf_token()}}'           
      },
        success : function(data) {
          $('#modal-form').modal('hide');
          
          swal({
            title: "Successfully Saved",
            text: "Record Saved Successfully",
            icon: "success",
            button: "Done!"                       
          }).then(function(){window.location.reload();});
        },
        error : function(data){        
          swal({
            title: "Ooops..., failed!",
            text: data.responseJSON,          
            icon: "error",          
            timer : '6500'          
          })        
        }
    });
    //Close of Ajax Data
  } 
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