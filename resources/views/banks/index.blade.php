@extends('layouts.dashboard')
@section('content')
        <div class="right_col" role="main">         
            <div class="page-title">
              <div class="title_left">
                <h3>Banks <small>Click Add Bank button to add new Bank</small></h3>
              </div>
              <div class="title_right">

                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

                  @if(!Auth::user()->hasRole(['Client','Service Provider','Brand Ambassador']))                  
                    <a onclick="addForm()" class="btn btn-primary">
                      <span class="glyphicon glyphicon-plus"></span>Add Bank
                    </a>                 
                  @endif  
                    
              </div>
            </div>

            <div class="clearfix"></div>

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>View All Banks</h2>                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    @include('inc.messages')

                    <table id="datatable-fixed-header" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Branch Code</th>
                          <th>Account Number</th>                          
                          <th>Date Added</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($banks as $bank)
                          <tr>
                            <td><a href="/banks/{{$bank->id}}"> {{ $bank->name}}</a></td>
                            <td>{{ $bank->branch_code}}</td> 
                            <td>{{ $bank->account_number}}</td>                          
                            <td>{{ $bank->created_at}}</td>
                            <td>
                              <a onclick="viewInfo({{$bank->id}})" class="btn btn-primary btn-xs view_{{$bank->id}}" 
                              data-name="{{$bank->name}}" data-account_number="{{$bank->account_number}}" data-branch_code="{{$bank->branch_code}}"><i class="fa fa-folder"></i> View </a>
                              <a onclick="editForm({{$bank->id}})" class="btn btn-info btn-xs edit_{{$bank->id}}" data-id="{{$bank->id}}"  data-branch_code="{{$bank->branch_code}}"
                              data-name="{{$bank->name}}" data-account_number="{{$bank->account_number}}"><i class="fa fa-pencil"></i> Edit </a>
                              @if(Auth::user()->hasRole(['System Admin','Chairman','Principal Officer']))
                              <a onclick="deleteData({{$bank->id}})" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Trash </a>
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
@include('banks.form')
<script type="text/javascript">

  //Function to open modal after button click to add new data
  function addForm() {
    
    save_method = 'add';
    $('input[name_method]').val('POST');
    $('#modal-form').modal('show');
    $('#modal-form form')[0].reset();
    $('#modal-title').text('Add Bank');
    $('#insertbutton').text('Submit');
  }

  //Function to open modal after button click to edit data
 function viewInfo(id){

      var k = ".view_"+id;
      var name = $(k).data('name');     
      $('#modal-view').modal('show');
      $('#modal-view form')[0].reset();
      $('#modal-title').text("Details for : " + name);
      $('#name-view').val(name);
      $('#account_number-view').val($(k).data('account_number'));
      $('#branch_code-view').val($(k).data('branch_code'));
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
      $('#branch_code').val($(k).data('branch_code'));
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
        branch_code: $('#branch_code').val(),
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
        branch_code: $('#branch_code').val(),
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
          buttons: true,
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
            swal("Cancelled");
          }
        });

}

</script>
@endsection
