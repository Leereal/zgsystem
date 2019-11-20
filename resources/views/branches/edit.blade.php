@extends('layouts.dashboard')
@section('content')
        <div class="right_col" role="main">         
            <div class="page-title">
              <div class="title_left">
                <h3>Branches</h3>
              </div>              
            </div>

            <div class="clearfix"></div>

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Editing Branch</h2>                    
                    <div class="clearfix"></div>
                  </div>
                  <!--Content for Branch-->
                  <div class="x_content">

                    <form class="form-horizontal form-label-left" method="POST" action="{{ route('branches.update',$branch->id) }}">
                      <input type="hidden" name="_method" value="PUT"> 
                      @csrf

                      <span class="section">Branch Info</span>

                      @include('inc.messages')


                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Branch Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" name="name" value="{{$branch->branch_name}}" placeholder="e.g Harare" required="required" type="text">
                        </div>
                      </div>                     

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="email" id="email" name="email" value="{{$branch->branch_email}}" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div> 

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telephone">Telephone 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="tel" id="telephone" name="phone" value="{{$branch->branch_phone}}" data-validate-length-range="8,20" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Address 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="textarea"  name="address" class="form-control col-md-7 col-xs-12"> {{$branch->branch_name}}</textarea>
                        </div>
                      </div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <a href="/branches"><button  class="btn btn-primary">Cancel</button></a>
                          <button id="send" type="submit" class="btn btn-success">Update</button>
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