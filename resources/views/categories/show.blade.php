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
                    <h2>View Discipline</h2>                    
                    <div class="clearfix"></div>
                  </div>
                  <!--Content for Discipline-->
                  <div class="x_content">

                    <form class="form-horizontal form-label-left" method="POST" >                      

                      <span class="section">Discipline Info</span>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Discipline <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" value="{{$category->name}}" name="name" placeholder="e.g Dentist" required="required" disabled="disabled" type="text">
                        </div>
                      </div>                    
                      
                    </form>
                  </div>
                  <!--Content for Discipline-->
                  </div>
                </div>
              </div>
</div>
@endsection