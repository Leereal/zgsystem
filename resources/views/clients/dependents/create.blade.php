@extends('layouts.dashboard')
@section('content')
<div class="right_col" role="main">         
  <div class="page-title">
    <div class="title_left">
      <h3>Dependent</h3>
    </div>              
  </div>

  <div class="clearfix"></div>

  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Adding Dependent for {{ $client->name }} {{ $client->surname }}</h2>                    
        <div class="clearfix"></div>
      </div>

      <!--Content for Client-->
      <div class="x_content">
      {{--  Begining of second form --}}
      @include('inc.messages')
        <form data-parsley-validate class="form-horizontal form-label-left input_mask" method="POST" action="{{ route('dependents.store') }}">
          @csrf
          <input type="hidden" name="id" value="{{ $client->id }}">
          <input type="hidden" name="plan_id" value="{{ $client->plan_id }}">
          <div class="row jumbotron">
          <h4>Principal Details</h4>
          <div class="row">
            <div class="col-sm-3"> 
              <div class="item form-group">
                <label class="control-label" for="name">Principal Name
                </label>                
                <input id="employer_name" class="form-control" readonly="readonly" data-validate-length-range="6" value="{{$client->name}}" name="employer_name" type="text">                
              </div> 
            </div>
            <div class="col-sm-3">              
              <div class="item form-group">
                <label class="control-label" for="employer_number">Principal Surname 
                </label>                
                <input id="employer_number" class="form-control" readonly="readonly" data-validate-length-range="6" value="{{$client->surname}}" name="employer_number" type="text">                
              </div>  
            </div>
            <div class="col-sm-3">              
              <div class="item form-group">
                <label class="control-label" for="principal_medical_aid_number">Principal Medical Aid Number
                </label>                
                <input id="principal_medical_aid_number" class="form-control" data-validate-length-range="6" readonly="readonly" value="{{$client->medical_aid_number}}" name="principal_medical_aid_number" type="text">
              </div>  
            </div>            
            <div class="col-sm-3">              
              <div class="item form-group">
                <label class="control-label" for="group_id">Corporate
                </label>                
                <input id="group_id" class="form-control" data-validate-length-range="6" readonly="readonly" value="{{!empty($client->group) ? $client->group->id:'No Group' }}" name="group_id" type="text">                
              </div>  
            </div>
          </div>                   
          </div>

          <div class="row jumbotron">
          <h4>Member Details</h4>
          <div class="row">  
            <div class="col-sm-6"> 
              <div class="item form-group">
                <label class="control-label" for="name">Fore Name(s) <span class="required">*</span>
                </label>                
                <input id="name" class="form-control" data-validate-length-range="6" value="{{old('name')}}" name="name" required="required" type="text">                
              </div> 
            </div>
            <div class="col-sm-6">              
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
                <label class="control-label" for="id_number">ID Number</label>                
                <input  class="form-control" id="id_number" value="{{old('id_number')}}" name="id_number" placeholder="eg. 29-12345B66"   type="text">        
              </div>
            </div>
            <div class="col-sm-4">              
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
            <div class="col-sm-4">              
              <div class="form-group">
                <label class="control-label">Date Of Birth (YYYY-MM-DD)</label>                  
                <input type="text" id="date_of_birth" name="date_of_birth" value="{{old('date_of_birth')}}" class="form-control"  data-inputmask="'mask': '9999-99-99'">                                 
              </div>
            </div> 
            {{-- <div class="col-sm-3">              
              <div class="item form-group">
                <label class="control-label" for="email">Email</label>                
                <input id="email" type="email" class="form-control" value="{{old('email')}}" name="email">                
              </div>  
            </div>  --}}                            
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