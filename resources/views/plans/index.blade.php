@extends('layouts.dashboard')
@section('content')
        <div class="right_col" role="main">         
            <div class="page-title">
              <div class="title_left">
                <h3>Plans <small>Click Add Plan button to add new plan</small></h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <a href="/plans/create">
                      <button type="submit" class="btn btn-primary" >
                         <span class="glyphicon glyphicon-plus"></span> Add Plan 
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
                    <h2>View All Plans</h2>                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    @include('inc.messages')

                    <table id="datatable-fixed-header" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Premium</th>
                          <th>Dependent Premium</th>
                          <th>Global Limit</th>
                          <th>Drugs</th>                                                  
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($plans as $plan)
                          <tr>
                            <td><a href="/plans/{{$plan->id}}"> {{ $plan->name}}</a></td>
                            <td>{{ $plan->premium}}</td>
                            <td>{{ $plan->dependent_premium}}</td>
                            <td>{{ $plan->global_limit}}</td>
                            <td>{{ $plan->drugs}}</td>                                                        
                            <td>
                              <a href="/plans/{{$plan->id}}" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
                              <a href="/plans/{{$plan->id}}/edit" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                              @if(Auth::user()->hasRole(['System Admin'])) 
                              <a href="#" onclick="$(this).parent().find('form').submit()" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                              <form method="POST" action="{{ route('plans.destroy',$plan->id) }}">
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
@endsection