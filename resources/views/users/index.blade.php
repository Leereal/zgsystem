@extends('layouts.dashboard')
@section('content')
        <div class="right_col" role="main">
            <div class="page-title">
              <div class="title_left">
                <h3>Users</h3>
              </div>
            </div>

            <div class="clearfix"></div>

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>View All Users</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    @include('inc.messages')
                    <p id="text" style="display:none">Checkbox is CHECKED!</p>

                    <table id="datatable-fixed-header" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Full Name</th>
                          <th>Email</th>
                          <th>Roles</th>
                          <th>Branch</th>
                          <th>Current Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($users as $user)
                          <tr>
                            <td><a href="/users/{{$user->id}}"> {{ $user->name}}</a></td>
                            <td>{{ $user->email}}</td>
                            <td>
                              @foreach($user->roles as $role)
                                  <span class="label label-primary">{{ $role->name }}</span>
                              @endforeach
                            </td>
                            <td>{{!empty($user->branch->branch_name) ? $user->branch->branch_name:'No Branch' }}</td>
                            <td>
                              <div class="">
                                <label>
                                  <a href="/users/change/{{ $user->id}}">
                                  <input type="checkbox" id="switch" class="js-switch" {{ $user->status ? 'Checked' : 'Unchecked'}}/> {{ $user->status ? 'Active' : 'InActive'}}
                                  </a>
                                </label>

                              </div>
                            </td>
                            <td>
                              @if(Auth::user()->hasRole(['System Admin','Chairman','Principal Officer']))
                              <a href="/users/{{ $user->id }}/edit" class="btn btn-info btn-xs"><i class="fa fa-check"></i>Approve </a>
                              @endif
                              @if(Auth::user()->hasRole(['System Admin']))
                              <a onclick="deleteData({{$user->id}})" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Trash </a>
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
@include('users.form')
<script type="text/javascript">
  function approveData(id){

      var k = ".approve_"+id;
      var name = $(k).data('name');
      var email = $(k).data('email');
      $('input[name_method]').val('PATCH');
      $('#modal-approve').modal('show');
      $('#modal-approve form')[0].reset();
      $('#modal-title').text("Approve : " + name);
      $('#name').val(name);
      $('#email').val(email);
      $('#insertbutton').attr("onclick","saveData("+id+")");
    }

    function saveData(id) {

    //Load data to Ajax for submission
   $.ajax({
      url: "{{ url('users') }}" + '/' + id,
      method: 'PATCH',
      data: {
        branch: $('#branch').val(),
        role: $('#role').val(),
        _token: '{{csrf_token()}}'
      },
        success : function(data) {
          $('#modal-approve').modal('hide');
          swal({
            title: "Successfully Saved",
            text: "User Approved Successfully",
            icon: "success",
            button: "Done!"
          }).then(function(){window.location.reload();});
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
   function change($id)  {
   $.ajax({
        url : "{{ url('/users/change') }}" + '/' + id,
        type : "POST"
        data : {'_method' : 'PATCH','_token' : csrf_token},
        success : function(data) {
          swal({
            title: "Deleted Successfully",
            text: "You clicked delete button!",
            icon: "success",
            button: "Done",
          });
}

function deleteData(id){
    var url = "{{ url('users') }}" + '/' + id;
    del(url);
    }

</script>
@endsection
