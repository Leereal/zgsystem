@extends('layouts.dashboard')
@section('content')
        <div class="right_col" role="main">         
            <div class="page-title">
              <div class="title_left">
                <h3>User</h3>
              </div>              
            </div>

            <div class="clearfix"></div>

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Approving User</h2>                    
                    <div class="clearfix"></div>
                  </div>
                  <!--Content for Branch-->
                  <div class="x_content">

                    <form class="form-horizontal form-label-left" method="POST" action="{{ route('users.update',$user->id) }}">
                      <input type="hidden" name="_method" value="PUT"> 
                      @csrf

                      <span class="section">User Info</span>

                      @include('inc.messages')


                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Full Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" name="name" value="{{$user->name}}"  disabled="disabled" required="required" type="text">
                        </div>
                      </div>                     

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="email" id="email" name="email" disabled="disabled" value="{{$user->email}}" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div> 
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Select Role: 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="select2_single form-control" name="role" required="required" tabindex="-1" id="role">
                          <option value="">{{old('role')}}</option>
                          @foreach($roles as $role)
                          <option value="{{ $role->id }}">{{ $role->name }}</option>
                          @endforeach                        
                        </select>
                        </div>
                      </div> 
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Select Branch 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="select2_single form-control" name="branch" required="required" tabindex="-1" id="branch"> 
                          <option value="">{{old('branch')}}</option>
                          @foreach($branches as $branch)
                          <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                          @endforeach                        
                        </select> 
                        </div>
                      </div> 
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <a href="/branches"><button  class="btn btn-primary">Cancel</button></a>
                          <button id="send" type="submit" class="btn btn-success">Approve</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!--Content for Branch-->
                  </div>
                </div>
              </div>
</div>
@endsection