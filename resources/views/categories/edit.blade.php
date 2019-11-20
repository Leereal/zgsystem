@extends('layouts.dashboard')
@section('content')
        <div class="right_col" role="main">         
            <div class="page-title">
              <div class="title_left">
                <h3>Discipline</h3>
              </div>              
            </div>

            <div class="clearfix"></div>

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Editing Discipline</h2>                    
                    <div class="clearfix"></div>
                  </div>
                  <!--Discipline-->
                  <div class="x_content">

                    <form class="form-horizontal form-label-left" method="POST" action="{{ route('categories.update',$category->id) }}">
                      @csrf
                      <input type="hidden" name="_method" value="PUT"> 
                      

                      <span class="section">Discipline Info</span>

                      @include('inc.messages')


                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Discipline <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" value="{{$category->name}}" name="name" placeholder="e.g Dentist" required="required" type="text">
                        </div>
                      </div> 
                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <a href="{{url('categories')}}"><button  class="btn btn-primary">Cancel</button></a>
                          <button id="send" type="submit" class="btn btn-success">Update</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!--Content for Category-->
                  </div>
                </div>
              </div>
</div>
@endsection