@extends('layouts.dashboard')
@section('content')
        <div class="right_col" role="main">         
            <div class="page-title">
              <div class="title_left">
                <h3>Service Provider</h3>
              </div>              
            </div>

            <div class="clearfix"></div>

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Adding New Service Provider</h2>                    
                    <div class="clearfix"></div>
                  </div>
                  <!--Content for Service Provider-->
                  <div class="x_content">

                    <form class="form-horizontal form-label-left" method="POST" action="{{ route('service_providers.store') }}">
                      @csrf

                      <span class="section">Service Provider Info</span>

                      @include('inc.messages')


                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Service Provider Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" value="{{old('name')}}" name="name" required="required" type="text">
                        </div>
                      </div>                     

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ahfoz_number">Ahfoz Number
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="ahfoz_number" name="ahfoz_number" value="{{old('ahfoz_number')}}" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div> 

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="coverage">Coverage 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="coverage" name="coverage" value="{{old('coverage')}}" class="form-control col-md-7 col-xs-12">
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contact_person">Contact Person
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="contact_person" name="contact_person" value="{{old('contact_person')}}"  class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone_number">Telephone 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="tel" id="phone_number" name="phone_number" value="{{old('phone_number')}}" data-validate-length-range="8,20" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cell_number">Cell Number
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="cell_number" name="cell_number" value="{{old('cell_number')}}"  class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="email" id="email" name="email" value="{{old('email')}}" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div> 

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Address
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="textarea"  name="address" class="form-control col-md-7 col-xs-12">{{old('address')}}</textarea>
                        </div>
                      </div>

                      <hr>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bank">Bank 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="bank" name="bank" value="{{old('bank')}}" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="branch_code">Branch Code 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="branch_code" name="branch_code" value="{{old('branch_code')}}" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="account_number">Account Number 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="account_number" name="account_number" value="{{old('account_number')}}" class="form-control col-md-7 col-xs-12">
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
                  <!--Content for Service Provider-->
                  </div>
                </div>
              </div>
</div>
@endsection