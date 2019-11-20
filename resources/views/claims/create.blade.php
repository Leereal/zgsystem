@extends('layouts.dashboard')
@section('content')
<style type="text/css">
  .jumbotron{
    padding: 0;
  }
</style>
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
        <h2>Adding New Claim</h2>                    
        <div class="clearfix"></div>
      </div>

      <!--Content for Client-->
      <div class="x_content">
      
        @include('inc.messages')
        <form data-parsley-validate class="form-horizontal form-label-left input_mask" method="POST" action="{{ route('claims.store') }}">
          @csrf
          <input type="hidden" id="medical_aid_number" name="medical_aid_number" value="{{ $client->medical_aid_number }}">
          <div class="jumbotron">
            <table class="table table-striped">
              <tbody>
                <tr>                 
                  <td><strong>Client Name:</strong></td>
                  <td>{{ $client->name }}</td>
                  <td>{{ $client->surname }}</td>
                </tr>
                <tr>                 
                  <td><strong>Medical Aid Number:</strong></td>
                  <td colspan="2">{{ $client->medical_aid_number }}</td> 
                </tr>
                <tr>                  
                  <td><strong>Plan:</strong></td>
                  <td colspan="2">{{ $client->plan->name }}</td>                  
                </tr>
                <tr>                  
                  <td><strong>Contact:</strong></td>
                  <td colspan="2">{{ $client->cellphone }}</td>                  
                </tr>
                
                <tr>                 
                  <td><strong>ID Number:</strong></td>
                  <td colspan="2">{{ $client->id_number }}</td> 
                </tr>
              </tbody>
            </table>            
          </div>

          <div class="row jumbotron">
            <h4>For Completion by Service Provider</h4>
            <div class="row"> 
              <div class="col-sm-4">
                <div class=" item form-group">
                  <label class="control-label">Pre-Authorization Code</label>                  
                  <input type="text" id="pre_authorization_code" name="pre_authorization_code"  value="{{old('pre_authorization_code')}}" class="form-control">                                 
                </div>              
                <div class=" item form-group">
                  <label class="control-label">Claim Number</label>                  
                  <input type="text" id="claim_number" name="claim_number"  value="{{old('claim_number')}}" class="form-control">                                 
                </div>                
              </div>
              <div class="col-sm-4">
                <div class=" item form-group">
                  <label class="control-label">Date Claim Closed</label>                  
                  <input type="text" id="date_claim_closed" name="date_claim_closed" data-inputmask="'mask': '9999-99-99'" value="{{old('date_claim_closed')}}" class="form-control">                                 
                </div>
                <div class="item form-group">
                  <label class="control-label" for="service_provider">Select Service Provider<span class="required">*</span>
                  </label>
                  <select class="select2_single form-control" name="service_provider" required="required" tabindex="-1" id="service_provider"> 
                    <option value="">{{old('service_provider')}}</option>
                    @foreach($service_providers as $service_provider)
                    <option value="{{ $service_provider->id }}">{{ $service_provider->name }}</option>
                    @endforeach                        
                  </select>                  
                </div>
              </div>
              <div class="col-sm-4">               
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="accident" value="Road Traffic Accident" class="flat" > Road Traffic Accident
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="accident" value="Accident At Work" class="flat" > Accident At Work
                  </label>
                </div>              
                <div class="item form-group">
                  <label class="control-label " for="accident">Other:
                  </label>               
                  <textarea id="accident"  name="accident" class="form-control">{{old('accident')}}</textarea>
                </div>
              </div>                        
            </div>
            <hr>
            <div class="row">                                    
              <div class="col-sm-4">              
                <div class="item form-group">
                  <label class="control-label " for="name_of_referring_practitioner">Name Of Referring Practitioner (If Any)
                  </label>               
                  <textarea id="name_of_referring_practitioner"  name="name_of_referring_practitioner" class="form-control">{{old('name_of_referring_practitioner')}}</textarea>
                </div>      
                <div class="form-group">
                  <label class="control-label">AHFOZ Number</label>                  
                  <input type="text" id="referring_practitioner_ahfoz_number" name="referring_practitioner_ahfoz_number" value="{{old('referring_practitioner_ahfoz_number')}}" class="form-control">                                 
                </div>
              </div>                          
              <div class="col-sm-4">              
                <div class="item form-group">
                  <label class="control-label " for="name_of_anaesthesist">Name Of Referring Anaesthetist (If Any)
                  </label>               
                  <textarea id="name_of_anaesthesist"  name="name_of_anaesthesist" class="form-control">{{old('name_of_anaesthesist')}}</textarea>
                </div>
                <div class="form-group">
                  <label class="control-label">AHFOZ Number</label>                  
                  <input type="text" id="anaesthesist_ahfoz_number" name="anaesthesist_ahfoz_number" value="{{old('anaesthesist_ahfoz_number')}}" class="form-control">                                 
                </div>
              </div>                     
              <div class="col-sm-4">              
                <div class="item form-group">
                  <label class="control-label " for="name_of_surgical_assistant">Name Of Surgical Assistant (If Any)
                  </label>               
                  <textarea id="name_of_surgical_assistant"  name="name_of_surgical_assistant" class="form-control">{{old('name_of_surgical_assistant')}}</textarea>
                </div>    
                <div class="form-group">
                  <label class="control-label">AHFOZ Number</label>                  
                  <input type="text" id="surgical_assistant_ahfoz_number" name="surgical_assistant_ahfoz_number" value="{{old('surgical_assistant_ahfoz_number')}}" class="form-control">                                 
                </div>
              </div>                       
            </div>                   
          </div> 
          <div class="jumbotron">
            <div class="row">
              <table class="table after-add-more table-striped" >
               <thead>
                 <tr >
                   <th>Tariff Code</th>
                   <th>MODS</th>
                   <th>Quantity</th>
                   <th>YYYY-MM</th>
                   <th>Days</th>
                   <th>Fee Charged</th>
                   <th>Action</th>
                 </tr>
                </thead>

                 <tr>
                   <td>
                     <select class="select2_single form-control" name="tariff[]" required="required" tabindex="-1" id="tariff_id">
                        <option>-SELECT-</option> 
                        <option value=""></option>
                        @foreach($tariffs as $tariff)
                        <option value="{{ $tariff->id }}">{{ $tariff->code }}</option>
                        @endforeach                        
                      </select>
                   </td>
                   <td>
                     <input type="text" id="mods" name="mods[]" value="" class="form-control">
                   </td>
                   <td>
                     <input type="text"  name="quantity[]" value="" class="form-control">
                   </td>
                   <td>
                     <input type="text" id="year_month" name="year_month[]" value="" class="form-control"  data-inputmask="'mask': '9999-99'"> 
                   </td>
                   <td>
                     <input type="number" id="days" name="days[]" value="" class="form-control">
                   </td>
                   <td>
                     <input id="amount" class="form-control" data-validate-length-range="6" value="" name="amount[]" type="text">
                   </td>
                   <td>
                     <button class="btn btn-success add-more"  onclick="addMore()" type="button"><i class="glyphicon glyphicon-plus"></i> Add</button>
                   </td>
                 </tr>
              </table> 

                   <!---Removable row-->
                <table class="copy hide" id="removable">
                 <tr >
                   <td>
                     <select class="select2_single form-control" name="tariff[]" required="required" tabindex="-1" id="tariff_id">
                        <option>-SELECT-</option> 
                        <option value=""></option>
                        @foreach($tariffs as $tariff)
                        <option value="{{ $tariff->id }}">{{ $tariff->code }}</option>
                        @endforeach                        
                      </select>
                   </td>
                   <td>
                     <input type="text" id="mods" name="mods[]" value="" class="form-control">
                   </td>
                   <td>
                     <input type="text"  name="quantity[]" value="" class="form-control">
                   </td>
                   <td>
                     <input type="text" id="year_month" name="year_month[]" value="" class="form-control"  data-inputmask="'mask': '9999-99'"> 
                   </td>
                   <td>
                     <input type="number" id="days" name="days[]" value="" class="form-control">
                   </td>
                   <td>
                     <input id="amount" class="form-control" data-validate-length-range="6" value="" name="amount[]" type="text">
                   </td>
                   <td>
                     <button class="btn btn-danger add-more" id="removeButton" onclick="removeInputs()"  type="button"><i class="glyphicon glyphicon-minus"></i> Remove</button>
                   </td>
                 </tr>
                </table> 
                 <!---Removable row-->             
            </div>
          </div>     
            
          <hr>
          <div class="row jumbotron">          
          <div class="row">                                    
            <div class="col-sm-6">              
              <div class="item form-group">
                <label class="control-label " for="diagnosis">Diagnosis
                </label>               
                <textarea id="diagnosis"  name="diagnosis" class="form-control">{{old('diagnosis')}}</textarea>
              </div>
            </div>            
            <div class="col-sm-6">              
              <div class="form-group">
                <label class="control-label">Date For Claim (YYYY-MM-DD)</label>                  
                <input type="text" id="dat" readonly="readonly" name="dat" value="{{now()}}" class="form-control"  data-inputmask="'mask': '9999-99-99'">                                 
              </div>
            </div>                      
          </div>
         
               

          <div class="ln_solid"></div>
          <div class="form-group text-center">            
              <a href="{{url('clients')}}"><button   type="button" class="btn btn-primary">Cancel</button></a>
              <button id="send" type="submit" class="btn btn-success">Submit</button>
              <p id="demo">
                
              </p>           
          </div>        
        </form>

      </div>
    </div>
  </div> 
</div>
<script src="{{ asset('vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js') }}"></script>
<script type="text/javascript">
//Autocomplete
var countries =["Zimbabwe","Canada"];

$('#autocomplete').autocomplete({
    lookup: countries
});


  function addMore() {
    var html = $(".copy").html();
    $(".after-add-more").after(html);
  }
  function removeInputs() {
    $("#removeButton").parents("tr").remove();
  }
$(document).ready(function(){
  var count=1;
});
</script>
@endsection 