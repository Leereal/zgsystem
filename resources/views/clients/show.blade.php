@extends('layouts.dashboard')
@section('content')
        <div class="right_col" role="main">         
            <div class="page-title">
              <div class="title_left">
                <h3>Client</h3>
              </div>              
            </div>

            <div class="clearfix"></div>

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Viewing Client</h2>                    
                    <div class="clearfix"></div>
                  </div>
                  <!--Content for Client-->
                  <div class="x_content">

                    <form class="form-horizontal form-label-left">                     

                      <span class="section">Client Info</span>

                      @include('inc.messages')


                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">First Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" value="{{$client->name}}" name="name" 
                         disabled="disabled" required="required" type="text">
                        </div>
                      </div> 

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="surname">Surname <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="surname" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" value="{{$client->surname}}" name="surname" disabled="disabled" required="required" type="text">
                        </div>
                      </div>                      

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_number">ID Number 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="id_number" name="id_number" disabled="disabled" value="{{$client->id_number}}" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div> 

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="date_joined">Date Joined
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="date_joined" name="date_joined" disabled="disabled" value="{{$client->date_joined}}"  class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="membership_number">Medical Aid Number
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="medical_aid_number" name="medical_aid_number" disabled="disabled" value="{{$client->medical_aid_number}}"  class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>                      

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cell_number">Cell Number
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="cell_number" name="cell_number" disabled="disabled" value="{{$client->cell_number}}"  class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="email" id="email" name="email" disabled="disabled" value="{{$client->email}}" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="membership_status">Membership Status 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="membership_status" name="membership_status" disabled="disabled" value="{{$client->membership_status}}" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="card_status">Card Status 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="card_status" name="card_status" disabled="disabled" value="{{$client->card_status}}" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>  

                      <!--<div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Address
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="textarea"  name="address" class="form-control col-md-7 col-xs-12">{{old('address')}}</textarea>
                        </div>
                      </div>-->

                      <div class="ln_solid"></div>                      
                    </form>
                  </div>
                  <!--Content for Service Provider-->
                  </div>
                </div>
              </div>
</div>
@endsection