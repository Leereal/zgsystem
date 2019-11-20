@extends('layouts.dashboard')
@section('content')
        <div class="right_col" role="main">         
            <div class="page-title">
              <div class="title_left">
                <h3>Tariffs</h3>
              </div>              
            </div>

            <div class="clearfix"></div>

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Viewing Tariff</h2>                    
                    <div class="clearfix"></div>
                  </div>
                  <!--Content for Tariff-->
                  <div class="x_content">

                    <form class="form-horizontal form-label-left"  >
                      <span class="section">Tariff Info</span>

                      @include('inc.messages')


                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="code">Code <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="code" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" value="{{$tariff->code}}" name="code" placeholder="e.g 999999" disabled="disabled" type="text">
                        </div>
                      </div> 
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category">Discipline</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <select class="select2_multiple form-control" disabled="disabled" name="category[]" multiple="multiple">
                            @foreach($tariff->categories as $cat)
                            <option value="{{ $cat->id }}" selected="selected">{{ $cat->name }}</option>
                            @endforeach                             
                          </select>
                        </div>
                      </div>                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="code">Fee</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="fee" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" value="{{$tariff->fee}}" name="fee" placeholder="" disabled="disabled"  type="text">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                    </form>
                  </div>
                  <!--Content for Tariff-->
                  </div>
                </div>
              </div>
</div>
@endsection