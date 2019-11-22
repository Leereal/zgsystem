@extends('layouts.dashboard')
@section('content')
        <div class="right_col" role="main">
            <div class="page-title">
              <div class="title_left">
                <h3>Service Provider <small>Click Add Service Provider button to add</small></h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <a href="/service_providers/create">
                      <button type="submit" class="btn btn-primary" >
                         <span class="glyphicon glyphicon-plus"></span> Add Service Provider
                      </button>
                    </a>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>View All Service Providers</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    @include('inc.messages')

                    <table id="datatable-fixed-header" class="table table-striped table-responsive table-bordered dt-responsive nowrap">
                      <thead>
                        <tr>
                          <th>Service Provider</th>
                          <th>Coverage</th>
                          <th>Discipline</th>
                          <th>Cell Number</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($service_providers as $service_provider)
                          <tr>
                            <td><a href="/service_providers/{{$service_provider->id}}"> {{ $service_provider->name}}</a></td>
                            <td>{{ $service_provider->coverage}}</td>
                            <td>
                              @foreach($service_provider->categories as $category)
                                  <span class="label label-primary">{{ $category->name }}</span>
                              @endforeach
                            </td>
                            <td>{{ $service_provider->cell_number}}</td>
                            <td>
                              <a href="/service_providers/{{$service_provider->id}}" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
                              <a href="/service_providers/{{$service_provider->id}}/edit" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                              @if(Auth::user()->hasRole(['System Admin','Chairman']))
                              <a onclick="deleteData({{$service_provider->id}})" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Trash </a>
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
<script>
function deleteData(id){
    var url = "{{ url('service_providers') }}" + '/' + id;
    del(url);
    }
</script>
@endsection
