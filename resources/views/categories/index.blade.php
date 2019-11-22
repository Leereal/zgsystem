@extends('layouts.dashboard')
@section('content')
        <div class="right_col" role="main">
            <div class="page-title">
              <div class="title_left">
                <h3>Disciplines <small>Click Add Discipline button to add new branch</small></h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

                  @if(!Auth::user()->hasRole(['Client','Service Provider','Brand Ambassador']))
                  <div class="input-group">
                    <a href="/categories/create">
                      <button type="submit" class="btn btn-primary" >
                         <span class="glyphicon glyphicon-plus"></span> Add Discipline
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
                    <h2>View All Disciplines</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    @include('inc.messages')

                    <table id="table1" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($categories as $category)
                          <tr>
                            <td><a href="/categories/{{$category->id}}"> {{ $category->id}}</a></td>
                            <td>{{ $category->name}}</td>
                            <td>
                              <a href="/categories/{{$category->id}}" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
                              <a href="/categories/{{$category->id}}/edit" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                              @if(Auth::user()->hasRole(['System Admin','Chairman','Team Leader','Principal Officer']))
                              <a onclick="deleteData({{$category->id}})" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Trash </a>
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
    var url = "{{ url('categories') }}" + '/' + id;
    del(url);
    }
</script>
@endsection
