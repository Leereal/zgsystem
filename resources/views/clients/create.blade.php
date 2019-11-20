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
        <h2>Adding New Client</h2>                    
        <div class="clearfix"></div>
      </div>

      <!--Content for Client-->
      <div class="x_content">
      {{--  Begining of second form --}}
      @include('inc.messages')
        <form data-parsley-validate class="form-horizontal form-label-left input_mask" method="POST" enctype="multipart/form-data" action="{{ route('clients.store') }}">
          @csrf
          <div class="row jumbotron">
          <h4>Employer Details and Plan</h4>
          <div class="row">           
            <div class="col-sm-6">              
              <div class="item form-group">
                <label class="control-label" for="plan">Select Plan<span class="required">*</span>
                </label>
                <select class="select2_single form-control" name="plan" required="required" tabindex="-1" id="plan"> 
                  <option value="">{{old('plan')}}</option>
                  @foreach($plans as $plan)
                  <option value="{{ $plan->id }}">{{ $plan->name }}</option>
                  @endforeach                        
                </select>                  
              </div>
            </div>
            <div class="col-sm-6">              
              <div class="item form-group">
                <label class="control-label" for="plan">Select Corporate
                </label>
                <select class="select2_single form-control" name="group" tabindex="-1" id="group"> 
                  <option value="">{{old('group')}}</option>
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
                  <option value="">{{old('title')}}</option>
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
                <input id="name" class="form-control" data-validate-length-range="6" value="{{old('name')}}" name="name" required="required" type="text">                
              </div> 
            </div>
            <div class="col-sm-4">              
              <div class="item form-group">
                <label class="control-label" for="surname">Surname <span class="required">*</span>
                </label>                
                <input id="surname" class="form-control" data-validate-length-range="6" value="{{old('surname')}}" name="surname" required="required" type="text">                
              </div>  
            </div>
          </div> 
          <hr>         
          <div class="row"> 
            <div class="col-sm-3">              
              <div class="item form-group">
                <label class="control-label" for="id_number">ID Number <span class="required">*</span></label>                
                <input  class="form-control" id="id_number" value="{{old('id_number')}}" required="required" name="id_number" placeholder="eg. 29-12345B66"   type="text">        
              </div>
            </div>
            <div class="col-sm-3">              
              <div class="item form-group">
                <label class="control-label" for="gender">Gender<span class="required">*</span>
                </label>
                <p>
                  Male:
                  <input title="Male" type="radio" class="flat" name="gender" id="genderM" value="Male" checked="" required /> 
                  Female:
                  <input type="radio" class="flat" name="gender" id="genderF" value="Female" />
                </p>
              </div>
            </div> 
            <div class="col-sm-3">              
              <div class="form-group">
                <label class="control-label">Date Of Birth (YYYY-MM-DD)</label>                  
                <input type="text" id="date_of_birth" name="date_of_birth" value="{{old('date_of_birth')}}" class="form-control"  data-inputmask="'mask': '9999-99-99'">                                 
              </div>
            </div> 
            <div class="col-sm-3">              
              <div class="item form-group">
                <label class="control-label" for="email">Email</label>                
                <input id="email" type="email" class="form-control" value="{{old('email')}}" name="email">                
              </div>  
            </div>                             
          </div>
          <hr>
          <div class="row"> 
            <div class="col-sm-3">              
              <div class="item form-group">
                <label class="control-label " for="textarea">Residential Address
                </label>               
                <textarea id="address"  name="address" class="form-control">{{old('address')}}</textarea>
              </div>
            </div>
            <div class="col-sm-3">              
              <div class="item form-group">
                <label class="control-label" for="business_telephone">Business Tel</label>
                <input id="business_telephone" class="form-control"  value="{{old('business_telephone')}}" name="business_telephone" placeholder="eg. 054 123456" type="text">
              </div>
            </div> 
            <div class="col-sm-3">              
              <div class="form-group">
                <label class="control-label" for="home_telephone">Home Tel</label>
                <input id="home_telephone" class="form-control"  value="{{old('home_telephone')}}" name="home_telephone" placeholder="eg. 054 123456" type="text">
              </div>
            </div>
            <div class="col-sm-3">              
              <div class="form-group">
                <label class="control-label" for="cellphone">Cellphone:</label>
                <input id="cellphone" class="form-control"  value="{{old('cellphone')}}" name="cellphone" placeholder="eg. 0773 546 878" type="text">
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
                <input id="bank" class="form-control" data-validate-length-range="6" value="{{old('bank')}}" name="bank" type="text">                
              </div> 
            </div>
            <div class="col-sm-3">              
              <div class="item form-group">
                <label class="control-label" for="branch">Branch
                </label>                
                <input id="branch" class="form-control" data-validate-length-range="6" value="{{old('branch')}}" name="branch" type="text">                
              </div>  
            </div>
            <div class="col-sm-3"> 
              <div class="item form-group">
                <label class="control-label" for="branch_code">Branch Code
                </label>                
                <input id="branch_code" class="form-control" data-validate-length-range="6" value="{{old('branch_code')}}" name="branch_code" type="text">                
              </div> 
            </div>
            <div class="col-sm-3">              
              <div class="item form-group">
                <label class="control-label" for="account_number">Account Number
                </label>                
                <input id="account_number" class="form-control" data-validate-length-range="6" value="{{old('account_number')}}" name="account_number" type="text">                
              </div>  
            </div>
          </div>  
          <hr>
          <div class="row">
            <div class="col-sm-4"> 
              <div class="item form-group">
                <label class="control-label" for="ecocash">Ecocash
                </label>                
                <input id="ecocash" class="form-control" data-validate-length-range="6" value="{{old('ecocash')}}" name="ecocash" type="text">                
              </div> 
            </div>
            <div class="col-sm-4">              
              <div class="item form-group">
                <label class="control-label" for="telecash">Telecash
                </label>                
                <input id="telecash" class="form-control" data-validate-length-range="6" value="{{old('telecash')}}" name="telecash" type="text">                
              </div>  
            </div>
            <div class="col-sm-4"> 
              <div class="item form-group">
                <label class="control-label" for="netcash">Netcash
                </label>                
                <input id="netcash" class="form-control" data-validate-length-range="6" value="{{old('netcash')}}" name="netcash" type="text">                
              </div> 
            </div>            
          </div>
          </div>

          <div class="row jumbotron">
          <h4>Medical History</h4>
          <div class="row">
            <div class="checkbox">
              <label>
                <input type="checkbox" name="cancer" value="Yes" class="flat" > Cancer
              </label>
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" name="renal_disease" value="Yes"  class="flat"> Renal Disease
              </label>
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" name="psychiatric_conditions" value="Yes"  class="flat"> Psychiatric Conditions
              </label>
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" name="cardio_vascular_problems" value="Yes"  class="flat"> Cardio-Vascular Problems
              </label>
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" name="hypertension" value="Yes"  class="flat"> Hypertension
              </label>
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" name="epilepsy" value="Yes"  class="flat"> Epilepsy
              </label>
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" name="diabetes" value="Yes"  class="flat"> Diabetes
              </label>
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" name="leprosy" value="Yes"  class="flat"> Leprosy
              </label>
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" name="asthma" value="Yes"  class="flat"> Asthma
              </label>
            </div>
            <div class="item form-group">
              <label class="control-label " for="textarea">Other
              </label>               
              <textarea id="other"  name="other" class="form-control">{{old('other')}}</textarea>
            </div>                       
            <div class="item form-group">
              <label class="control-label " for="textarea">Name and Address of Doctor
              </label>               
              <textarea id="doc_address"  name="doc_address" class="form-control">{{old('doc_address')}}</textarea>
            </div>            
          </div> 
          </div>

          <div class="row jumbotron">
          <h4>Uploads</h4>
          <div class="row">
            <div class="col-sm-6"> 
              <div class="item form-group">
                <label class="control-label" for="name">Profile Picture
                </label>                
                <input type="file" name="image" class="form-control">                
              </div> 
            </div>
            <div class="col-sm-6">              
              <div class="item form-group">
                <label class="control-label" for="employer_number">Documents
                </label>                
                <input type="file" name="docs[]" class="form-control" multiple="multiple">                
              </div>  
            </div>            
          </div>                   
          </div>           

          <div class="ln_solid"></div>
          <div class="form-group text-center">            
              <a href="{{url('clients')}}"><button   type="button" class="btn btn-primary">Cancel</button></a>
              <button id="send" type="submit" class="btn btn-success">Submit</button>           
          </div>        
        </form>
      </div>
    </div>
  </div> 
</div>

@endsection