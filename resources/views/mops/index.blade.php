@extends('layouts.dashboard')
@section('content')
        <div class="right_col" role="main">
            <div class="page-title">
              <div class="title_left">
                <h3>Mode Of Payments <small>Click Add Mode Of Payment button to Add New</small></h3>
              </div>
              <div class="title_right">

                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

                  @if(!Auth::user()->hasRole(['Client','Service Provider','Brand Ambassador']))
                    <a onclick="addForm()" class="btn btn-primary">
                      <span class="glyphicon glyphicon-plus"></span>Add Mode Of Payment
                    </a>
                  @endif

              </div>
            </div>

            <div class="clearfix"></div>

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>View All Mode Of Payments</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    @include('inc.messages')

                    <table id="datatable-fixed-header" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Date Added</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($mops as $mop)
                          <tr>
                            <td><a onclick="viewInfo({{$mop->id}})"> {{ $mop->name}}</a></td>
                            <td>{{ $mop->created_at}}</td>
                            <td>
                              <a onclick="viewInfo({{$mop->id}})" class="btn btn-primary btn-xs view_{{$mop->id}}"
                              data-name="{{$mop->name}}"><i class="fa fa-folder"></i> View </a>
                              <a onclick="editForm({{$mop->id}})" class="btn btn-info btn-xs edit_{{$mop->id}}" data-id="{{$mop->id}}"
                              data-name="{{$mop->name}}"><i class="fa fa-pencil"></i> Edit </a>
                              <a onclick="deleteData({{$mop->id}})" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Trash </a>
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
@include('mops.form')
<script type="text/javascript">

  //Function to open modal after button click to add new data
  function addForm() {
    $('input[name_method]').val('POST');
    $('#modal-form').modal('show');
    $('#modal-form form')[0].reset();
    $('#modal-title').text('Add Mode Of Payment');
    $('#insertbutton').text('Submit');
  }

  //Function to open modal after button click to view data
 function viewInfo(id){
      var k = ".view_"+id;
      var name = $(k).data('name');
      $('#modal-view').modal('show');
      $('#modal-view form')[0].reset();
      $('#modal-title').text("Details for : " + name);
      $('#name-view').val(name);
    }

    //Function to open modal after button click to edit data
 function editForm(id){

      var k = ".edit_"+id;
      var name = $(k).data('name');
      $('input[name_method]').val('PATCH');
      $('#modal-form').modal('show');
      $('#modal-form form')[0].reset();
      $('#modal-title').text("Edit MOP : " + name);
      $('#name').val(name);
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
      url: "{{ url('mops') }}",
      method: 'POST',
      data: {
        name: $('#name').val(),
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
      url: "{{ url('mops') }}" + '/' + id,
      method: 'PATCH',
      data: {
        name: $('#name').val(),
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
    //Close of Ajax Dataa
  }
  function deleteData(id){
    var url = "{{ url('mops') }}" + '/' + id;
    del(url);
    }
</script>
@endsection
