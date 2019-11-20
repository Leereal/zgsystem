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
                    <h2>Viewing Service Provider</h2>                    
                    <div class="clearfix"></div>
                  </div>
                  <!--Content for Service Provider-->
                  <div class="x_content">

                    <form class="form-horizontal form-label-left">
                     
                      <span class="section">Service Provider Info</span>

                      @include('inc.messages')


                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Service Provider Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" value="{{$service_provider->name}}" name="name" disabled="disabled" required="required" type="text">
                        </div>
                      </div>                     

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="coverage">Coverage 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="coverage" name="coverage" disabled="disabled" value="{{$service_provider->coverage}}" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ahfoz_number">Ahfoz Number
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="ahfoz_number" name="ahfoz_number" readonly="readonly" value="{{$service_provider->ahfoz_number}}" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div> 

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category">Discipline</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="select2_multiple form-control" disabled="disabled" name="category[]" multiple="multiple">
                            @foreach($service_provider->categories as $cat)
                            <option value="{{ $cat->id }}" selected="selected">{{ $cat->name }}</option>
                            @endforeach                             
                          </select>
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contact_person">Contact Person
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="contact_person" name="contact_person" disabled="disabled" value="{{$service_provider->contact_person}}"  class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone_number">Telephone 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="tel" id="phone_number" name="phone_number" disabled="disabled" value="{{$service_provider->phone_number}}" data-validate-length-range="8,20" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cell_number">Cell Number
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="cell_number" name="cell_number" disabled="disabled" value="{{$service_provider->cell_number}}"  class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="email" id="email" name="email" disabled="disabled" value="{{$service_provider->email}}" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div> 

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Address
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="textarea"  name="address" disabled="disabled" class="form-control col-md-7 col-xs-12">{{$service_provider->address}}</textarea>
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bank">Bank 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="bank" name="bank" disabled="disabled" value="{{$service_provider->bank}}" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="branch_code">Branch Code 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="branch_code" name="branch_code" disabled="disabled" value="{{$service_provider->branch_code}}" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="account_number">Account Number 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="account_number" disabled="disabled" name="account_number" value="{{$service_provider->account_number}}" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="ln_solid"></div>                      
                    </form>
                  </div>
                  <!--Content for Service Provider-->
                  </div>
                </div>
              </div>
</div>
@endsection