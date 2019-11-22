@extends('layouts.dashboard')
@section('content')
        <div class="right_col" role="main">
            <div class="page-title">
              <div class="title_left">
                <h3>Corporates <small>Click Add Corporate button to add new group</small></h3>
              </div>
              <div class="title_right">

                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

                  @if(!Auth::user()->hasRole(['Client','Service Provider','Brand Ambassador']))
                    <a onclick="addForm()" class="btn btn-primary">
                      <span class="glyphicon glyphicon-plus"></span>Add Corporate
                    </a>
                  @endif

              </div>
            </div>

            <div class="clearfix"></div>

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>View All Corporates</h2>
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
                        @foreach ($groups as $group)
                          <tr>
                            <td><a href="/groups/{{$group->id}}"> {{ $group->name}}</a></td>
                            <td>{{ $group->created_at}}</td>
                            <td>
                              <a onclick="viewInfo({{$group->id}})" class="btn btn-primary btn-xs view_{{$group->id}}"
                              data-name="{{$group->name}}" data-contact_person="{{$group->contact_person}}" data-email="{{$group->email}}" data-phone="{{$group->phone}}"  ><i class="fa fa-folder"></i> View </a>
                              <a onclick="editForm({{$group->id}})" class="btn btn-info btn-xs edit_{{$group->id}}" data-id="{{$group->id}}"
                              data-name="{{$group->name}}" data-contact_person="{{$group->contact_person}}" data-email="{{$group->email}}" data-phone="{{$group->phone}}" ><i class="fa fa-pencil"></i> Edit </a>
                              @if(Auth::user()->hasRole(['System Admin']))
                              <a onclick="deleteData({{$group->id}})" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Trash </a>
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
@include('groups.form')
<script type="text/javascript">

  //Function to open modal after button click to add new data
  function addForm() {

    save_method = 'add';
    $('input[name_method]').val('POST');
    $('#modal-form').modal('show');
    $('#modal-form form')[0].reset();
    $('#modal-title').text('Add Group');
    $('#insertbutton').text('Submit');
  }

  //Function to open modal after button click to edit data
 function viewInfo(id){

      var k = ".view_"+id;
      var name = $(k).data('name');
      var contact_person = $(k).data('contact_person');
      var email = $(k).data('email');
      var phone = $(k).data('phone');
      $('#modal-view').modal('show');
      $('#modal-view form')[0].reset();
      $('#modal-title').text("Details for : " + name);
      $('#name-view').val(name);
      $('#contact_person-view').val(contact_person);
      $('#email-view').val(email);
      $('#phone-view').val(phone);
    }

    //Function to open modal after button click to view data
 function editForm(id){

      var k = ".edit_"+id;
      var name = $(k).data('name');
      var contact_person = $(k).data('contact_person');
      var email = $(k).data('email');
      var phone = $(k).data('phone');
      $('input[name_method]').val('PATCH');
      $('#modal-form').modal('show');
      $('#modal-form form')[0].reset();
      $('#modal-title').text("Edit Group : " + name);
      $('#record_id').val($(k).data('id'));
      $('#name').val(name);
      $('#contact_person').val(contact_person);
      $('#email').val(email);
      $('#phone').val(phone);
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
      url: "{{ url('groups') }}",
      method: 'POST',
      data: {
        name: $('#name').val(),
        contact_person: $('#contact_person').val(),
        email: $('#email').val(),
        phone: $('#phone').val(),
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

  function editData(id) {

    //Load data to Ajax for submission
   $.ajax({
      url: "{{ url('groups') }}" + '/' + id,
      method: 'PATCH',
      data: {
        name: $('#name').val(),
        contact_person: $('#contact_person').val(),
        email: $('#email').val(),
        phone: $('#phone').val(),
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
    var url = "{{ url('groups') }}" + '/' + id;
    del(url);
    }
</script>
@endsection
