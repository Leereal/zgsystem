@extends('layouts.dashboard')
@section('content')
        <div class="right_col" role="main">         
            <div class="page-title">
              <div class="title_left">
                <h3>Plans</h3>
              </div>              
            </div>

            <div class="clearfix"></div>

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Viewing Plan</h2>                    
                    <div class="clearfix"></div>
                  </div>
                  <!--Content for Plans-->
                  <div class="x_content">

                    <form class="form-horizontal form-label-left"  >
                      

                      <span class="section">Plan Info</span>

                      @include('inc.messages')


                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Plan Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12" disabled="disabled"  data-validate-length-range="6" value="{{$plan->name}}" name="name" required="required" type="text">
                        </div>
                      </div>                     

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="premium">Premium 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" disabled="disabled"  id="premiums" name="premiums" value="{{$plan->premium}}" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div> 

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dependent_premium">Dependent Premium 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" disabled="disabled"  id="dependent_premium" name="premiums" value="{{$plan->dependent_premium}}" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="corporate_premium">Corporate Premium 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="corporate_premium" disabled="disabled" name="corporate_premium" value="{{$plan->corporate_premium}}" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div> 

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="corporate_dependent_premium">Corporate Dependent Premium 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="corporate_dependent_premium" name="corporate_dependent_premium" value="{{$plan->corporate_dependent_premium}}" disabled="disabled" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>  

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pre">Pre-Code 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="pre" disabled="disabled" name="pre" value="{{$plan->pre}}" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last_number">Last Number
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="last_number" disabled="disabled" name="last_number" value="{{$plan->last_number}}" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="global_limit">Global Limit
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" disabled="disabled"  id="global_limit" name="global_limit" value="{{$plan->global_limit}}"  class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="hospitalization">Hospitalization
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" disabled="disabled"  id="hospitalization" name="hospitalization" value="{{$plan->hospitalization}}"  class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ward_admission">Ward Admission
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" disabled="disabled"  id="ward_admission" name="ward_admission" value="{{$plan->ward_admission}}"  class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>                      

                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="drugs">Drugs
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" disabled="disabled"  id="drugs" name="drugs" value="{{$plan->drugs}}"  class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dental">Dental
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" disabled="disabled"  id="dental" name="dental" value="{{$plan->dental}}"  class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="optical">Optical
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" disabled="disabled"  id="optical" name="optical" value="{{$plan->optical}}"  class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="oncology">Oncology
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" disabled="disabled"  id="oncology" name="oncology" value="{{$plan->oncology}}"  class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dialysis">Dialysis
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" disabled="disabled"  id="dialysis" name="dialysis" value="{{$plan->dialysis}}"  class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pathology">Pathology
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" disabled="disabled"  id="pathology" name="pathology" value="{{$plan->pathology}}"  class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="radiology">Radiology
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" disabled="disabled"  id="radiology" name="radiology" value="{{$plan->radiology}}"  class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="maternity">Maternity
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" disabled="disabled"  id="maternity" name="maternity" value="{{$plan->maternity}}"  class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="prosthesis">Prosthesis
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" disabled="disabled"  id="prosthesis" name="prosthesis" value="{{$plan->prosthesis}}"  class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="family_planning">Family Planning
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" disabled="disabled"  id="family_planning" name="family_planning" value="{{$plan->family_planning}}"  class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="physiotherapy">Physiotherapy
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" disabled="disabled"  id="physiotherapy" name="physiotherapy" value="{{$plan->physiotherapy}}"  class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="glucometer">Glucometer
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" disabled="disabled"  id="glucometer" name="glucometer" value="{{$plan->glucometer}}"  class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="funeral_grant">Funeral Grant
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" disabled="disabled"  id="funeral_grant" name="funeral_grant" value="{{$plan->funeral_grant}}"  class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="ln_solid"></div>
                      
                    </form>
                  </div>
                  <!--Content for Branch-->
                  </div>
                </div>
              </div>
</div>
@endsection