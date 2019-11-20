@extends('layouts.dashboard')
@section('content')
<style type="text/css">
  .jumbotron{
    padding: 5px;
    margin: 5px;    
  }
  .hr{
    margin: 0; 
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
        <h2>Editing Client</h2>                    
        <div class="clearfix"></div>
      </div>

      <!--Content for Client-->
      <div class="x_content">
      {{--  Begining of second form --}}
      @include('inc.messages')
        <form data-parsley-validate class="form-horizontal form-label-left input_mask" method="POST" enctype="multipart/form-data" action="{{ route('clients.update',$client->id) }}">
          <input type="hidden" name="_method" value="PUT">
          @csrf
          <div class="row jumbotron">
          <h4>Employer Details and Plan</h4>
          <div class="row">            
            <div class="col-sm-6">              
              <div class="item form-group">
                <label class="control-label" for="plan">Select Plan<span class="required">*</span>
                </label>
                <select class="select2_single form-control" name="plan" required="required" tabindex="-1" id="plan"> 
                  <option value="{{$client->plan->id}}">{{$client->plan->name}}</option>
                  @foreach($plans as $plan)
                  <option value="{{ $plan->id }}">{{ $plan->name }}</option>
                  @endforeach                        
                </select>                  
              </div>
            </div>
            <div class="col-sm-6">              
              <div class="item form-group">
                <label class="control-label" for="plan">Select Group
                </label>
                <select class="select2_single form-control" name="group" tabindex="-1" id="group"> 
                  <option value="{{!empty($client->group->id) ? $client->group->id:''}}">{{!empty($client->group->name) ? $client->group->name:''}}</option>
                  @foreach($groups as $group)
                  <option value="{{!empty($group->id) ? $group->id:'' }}">{{!empty($group->name) ? $group->name:'' }}</option>
                  @endforeach                        
                </select>                  
              </div>
            </div>
          </div>                   
          </div>

          <div class="row jumbotron">
          <h4>Member Details</h4>
          <div class="row">             
            <div class="col-sm-4">              
              <div class="item form-group">
                <label class="control-label" for="title">Title<span class="required">*</span>
                </label>
                <select class="select2_single form-control" required="required"  name="title" tabindex="-1" id="title"> 
                  <option value="{{$client->title}}">{{$client->title}}</option>
                  <option value="Mr">Mr</option>
                  <option value="Mrs">Mrs</option>
                  <option value="Ms">Ms</option>
                  <option value="Dr">Dr</option>
                  <option value="Prof">Prof</option>                        
                </select>                  
              </div>
            </div>
            <div class="col-sm-4"> 
              <div class="item form-group">
                <label class="control-label" for="name">Fore Name(s) <span class="required">*</span>
                </label>                
                <input id="name" class="form-control" data-validate-length-range="6" value="{{$client->name}}" name="name" required="required" type="text">                
              </div> 
            </div>
            <div class="col-sm-4">              
              <div class="item form-group">
                <label class="control-label" for="surname">Surname <span class="required">*</span>
                </label>                
                <input id="surname" class="form-control" data-validate-length-range="6" value="{{$client->surname}}" name="surname" required="required" type="text">                
              </div>  
            </div>
          </div> 
          <hr>         
          <div class="row"> 
            <div class="col-sm-3">              
              <div class="item form-group">
                <label class="control-label" for="id_number">ID Number <span class="required">*</span></label>                
                <input  class="form-control" id="id_number" value="{{$client->id_number}}" required="required" name="id_number" placeholder="eg. 29-12345B66"   type="text">        
              </div>
            </div>
            <div class="col-sm-3">              
              <div class="item form-group">
                <label class="control-label" for="gender">Gender<span class="required">*</span>
                </label>
                <p>
                  Male:
                  <input title="Male" type="radio" class="flat" name="gender" id="genderM" value="Male" checked="{{ $client->gender=='Male' ? 'Checked' : ''}}" required /> 
                  Female:
                  <input type="radio" class="flat" name="gender" id="genderF" value="Female" checked="{{ $client->gender=='Female' ? 'Checked' : ''}}" />
                </p>
              </div>
            </div> 
            <div class="col-sm-3">              
              <div class="form-group">
                <label class="control-label">Date Of Birth (YYYY-MM-DD)</label>                  
                <input type="text" id="date_of_birth" name="date_of_birth" value="{{$client->date_of_birth}}" class="form-control"  data-inputmask="'mask': '9999-99-99'">                                 
              </div>
            </div> 
            <div class="col-sm-3">              
              <div class="item form-group">
                <label class="control-label" for="email">Email</label>                
                <input id="email" type="email" class="form-control" value="{{$client->email}}" name="email">                
              </div>  
            </div>                             
          </div>
          <hr>
          <div class="row"> 
            <div class="col-sm-3">              
              <div class="item form-group">
                <label class="control-label " for="textarea">Residential Address
                </label>               
                <textarea id="address"  name="address" class="form-control">{{$client->address}}</textarea>
              </div>
            </div>
            <div class="col-sm-3">              
              <div class="item form-group">
                <label class="control-label" for="business_telephone">Business Tel</label>
                <input id="business_telephone" class="form-control"  value="{{$client->business_telephone}}" name="business_telephone" placeholder="eg. 054 123456" type="text">
              </div>
            </div> 
            <div class="col-sm-3">              
              <div class="form-group">
                <label class="control-label" for="home_telephone">Home Tel</label>
                <input id="home_telephone" class="form-control"  value="{{$client->home_telephone}}" name="home_telephone" placeholder="eg. 054 123456" type="text">
              </div>
            </div>
            <div class="col-sm-3">              
              <div class="form-group">
                <label class="control-label" for="cellphone">Cellphone:</label>
                <input id="cellphone" class="form-control"  value="{{$client->cellphone}}" name="cellphone" placeholder="eg. 0773 546 878" type="text">
              </div>
            </div>                               
          </div>
          </div>

          <div class="row jumbotron">
          <h4>Electronic Funds Transfer</h4>
          <div class="row">
            <div class="col-sm-3"> 
              <div class="item form-group">
                <label class="control-label" for="bank">Bank
                </label>                
                <input id="bank" class="form-control" data-validate-length-range="6" value="{{$client->bank}}" name="bank" type="text">                
              </div> 
            </div>
            <div class="col-sm-3">              
              <div class="item form-group">
                <label class="control-label" for="branch">Branch
                </label>                
                <input id="branch" class="form-control" data-validate-length-range="6" value="{{$client->branch}}" name="branch" type="text">                
              </div>  
            </div>
            <div class="col-sm-3"> 
              <div class="item form-group">
                <label class="control-label" for="branch_code">Branch Code
                </label>                
                <input id="branch_code" class="form-control" data-validate-length-range="6" value="{{$client->branch_code}}" name="branch_code" type="text">                
              </div> 
            </div>
            <div class="col-sm-3">              
              <div class="item form-group">
                <label class="control-label" for="account_number">Account Number
                </label>                
                <input id="account_number" class="form-control" data-validate-length-range="6" value="{{$client->account_number}}" name="account_number" type="text">                
              </div>  
            </div>
          </div>  
          <hr>
          <div class="row">
            <div class="col-sm-4"> 
              <div class="item form-group">
                <label class="control-label" for="ecocash">Ecocash
                </label>                
                <input id="ecocash" class="form-control" data-validate-length-range="6" value="{{$client->ecocash}}" name="ecocash" type="text">                
              </div> 
            </div>
            <div class="col-sm-4">              
              <div class="item form-group">
                <label class="control-label" for="telecash">Telecash
                </label>                
                <input id="telecash" class="form-control" data-validate-length-range="6" value="{{$client->telecash}}" name="telecash" type="text">                
              </div>  
            </div>
            <div class="col-sm-4"> 
              <div class="item form-group">
                <label class="control-label" for="netcash">Netcash
                </label>                
                <input id="netcash" class="form-control" data-validate-length-range="6" value="{{$client->netcash}}" name="netcash" type="text">                
              </div> 
            </div>            
          </div>
          </div>

          <div class="row jumbotron">
          <h4>Medical History</h4>
          <div class="row">
            <div class="checkbox">
              <label>
                <input type="checkbox" name="cancer" value="Yes" class="flat" checked="{{ $client->cancer=='Yes' ? 'Checked' : ''}}" > Cancer
              </label>
            </div>           
            <div class="checkbox">
              <label>
                <input type="checkbox" name="renal_disease" value="Yes"  class="flat" checked="{{ $client->renal_disease=='Yes' ? 'Checked' : ''}}"> Renal Disease
              </label>
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" name="psychiatric_conditions" value="Yes"  class="flat" checked="{{ $client->psychiatric_conditions=='Yes' ? 'Checked' : ''}}"> Psychiatric Conditions
              </label>
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" name="cardio_vascular_problems" value="Yes"  class="flat" checked="{{ $client->cardio_vascular_problems=='Yes' ? 'Checked' : ''}}"> Cardio-Vascular Problems
              </label>
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" name="hypertension" value="Yes"  class="flat" checked="{{ $client->hypertension=='Yes' ? 'Checked' : ''}}"> Hypertension
              </label>
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" name="epilepsy" value="Yes"  class="flat" checked="{{ $client->epilepsy=='Yes' ? 'Checked' : ''}}"> Epilepsy
              </label>
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" name="diabetes" value="Yes"  class="flat" checked="{{ $client->diabetes=='Yes' ? 'Checked' : ''}}"> Diabetes
              </label>
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" name="leprosy" value="Yes"  class="flat" checked="{{ $client->leprosy=='Yes' ? 'Checked' : ''}}"> Leprosy
              </label>
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" name="asthma" value="Yes"  class="flat" checked="{{ $client->asthma=='Yes' ? 'Checked' : ''}}"> Asthma
              </label>
            </div>
            <div class="item form-group">
              <label class="control-label " for="textarea">Other
              </label>               
              <textarea id="other"  name="other" class="form-control">{{$client->other}}</textarea>
            </div>                       
            <div class="item form-group">
              <label class="control-label " for="textarea">Name and Address of Doctor
              </label>               
              <textarea id="doc_address"  name="doc_address" class="form-control">{{$client->doc_address}}</textarea>
            </div>            
          </div> 
          </div>               

          <div class="ln_solid"></div>
          <div class="form-group text-center">            
              <a href="{{url('clients')}}"><button   type="button" class="btn btn-primary">Cancel</button></a>
              <button id="send" type="submit" class="btn btn-success">Update</button>           
          </div>        
        </form>
      </div>
    </div>
  </div> 
</div>

@endsection