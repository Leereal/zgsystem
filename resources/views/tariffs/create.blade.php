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
                    <h2>Adding New Tariff</h2>                    
                    <div class="clearfix"></div>
                  </div>
                  <!--Content for Tariff-->
                  <div class="x_content">

                    <form class="form-horizontal form-label-left" method="POST" action="{{ route('tariffs.store') }}">
                      @csrf

                      <span class="section">Tariff Info</span>

                      @include('inc.messages')


                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="code">Code <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="code" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" value="{{old('code')}}" name="code" placeholder="e.g 999999" required="required" type="text">
                        </div>
                      </div>                       
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category">Discipline</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="select2_multiple form-control" name="category[]" multiple="multiple">
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="code">Fee</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="fee" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" value="{{old('fee')}}" name="fee" placeholder="" required="required"  type="text">
                        </div>
                      </div> 

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button type="submit" class="btn btn-primary">Cancel</button>
                          <button id="send" type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!--Content for Tariff-->
                  </div>
                </div>
              </div>
</div>
@endsection