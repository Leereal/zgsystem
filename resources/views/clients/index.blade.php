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
                    <table id="table1" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
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
                          <!-- @foreach($client->dependents as $dependent)
                          <tr class="datarow">
                            <td></td>
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
                          @endforeach -->
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  </div>
                </div>
              </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $(".datarow").hide();
    $(".breakrow").click(function(){
        $(this).nextUntil('tr.breakrow').toggle();
        console.log("Thanks");
    })
});
</script>
@endsection
