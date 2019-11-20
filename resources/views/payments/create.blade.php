@extends('layouts.dashboard')
@section('content')
        <div class="right_col" role="main">         
            <div class="page-title">
              <div class="title_left">
                <h3>Clients <small>Search for client to make payment</small></h3>
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
                        @if($client->membership_status=='Lapsed')
                          <tr style="background-color: yellow">
                        @elseif($client->membership_status=='Active')
                          <tr>
                        @else
                       <tr style="background-color: red">
                        @endif
                            <td><a href="/clients/{{$client->id}}"> {{ $client->name}}</a></td>
                            <td>{{ $client->surname}}</td>
                            <td>{{ $client->medical_aid_number}}</td>
                            <td>{{ $client->plan->name}}</td>
                            <td>{{ $client->id_number}}</td>                                           
                            <td>
                              <a href="/clients/{{$client->id}}" class="btn btn-primary btn-xs" 
                              ><i class="glyphicon glyphicon-eye-open"></i> View Client </a>
                              <a href="/payments/view/{{$client->id}}" class="btn btn-info btn-xs"><i class="fa fa-folder"></i> More  Details... </a>
                              @if($client->membership_status=='Active' || $client->membership_status=='Lapsed'  )
                              <a onclick="addForm({{$client->id}})" class="btn btn-primary btn-xs pay_{{$client->id}}" data-name="{{$client->name}}" data-surname="{{$client->surname}}" data-id_number="{{$client->id_number}}" data-medical_aid_number="{{$client->medical_aid_number}}" data-plan_name="{{$client->plan->name}}" data-plan_id="{{$client->plan_id}}" data-amount="{{$client->total_premium}}"><i class="fa fa-money"></i> Make Payment</a>
                              @else
                              <a class="btn btn-danger btn-xs" disabled><i class="fa fa-times"></i>{{ $client->membership_status }}</a>
                              @endif
                              <form>                               
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
@include('payments.form')
<script type="text/javascript">

  //Function to open modal after button click to add new data
  function addForm(id) {

    var k = ".pay_"+id;
    var name = $(k).data('name') +" " +$(k).data('surname');
    save_method = 'add';
    $('input[name_method]').val('POST');
    $('#modal-form').modal('show');
    $('#modal-form form')[0].reset();
    $('#modal-title').text('Make Payment');
    $('#insertbutton').text('Submit');
    $('#name').val(name);
    $('#medical_aid_number').val($(k).data('medical_aid_number'));
    $('#id_number').val($(k).data('id_number'));
    $('#plan_name').val($(k).data('plan_name'));
    $('#plan_id').val($(k).data('plan_id'));
    $('#amount').val($(k).data('amount'));
    $('#client_id').val(id);
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

    var k = ".view_"+$('#client_id').val();

    var rn = new Date().getTime();
    //Load data to Ajax for submission
   $.ajax({
      url: "{{ url('payments') }}",
      method: 'POST',
      data: {
        amount: $('#amount').val(),
        ref_number: $('#ref_number').val(),
        client_id : $('#client_id').val(),
        m_o_p_id : $('#mop').val(),
        description : "Premium",
        receipt_number : rn,
        plan_id : $('#plan_id').val(), 
        _token: '{{csrf_token()}}'           
      },
      success : function(data) {
          $('#modal-form').modal('hide');
          
          swal({
            title: "Successfully Saved",
            text: "Payment Saved Successfully",
            icon: "success",
            button: "Done!"                       
          }).then(function(){window.location.href = "/payments/receipt/"+rn;});
        },
        
        error : function(data){        
          swal({
            title: "Ooops..., failed!",
            text: data.responseJSON.message,          
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