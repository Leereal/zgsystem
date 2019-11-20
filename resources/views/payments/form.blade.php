<!-- Modal -->
<div class="modal fade " id="modal-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#2F4F4F; color: white;">
        <h3 class="modal-title text-center" id="modal-title"></h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" >&times;</span>
        </button>
      </div>

      <form method="POST">        
        <input type="hidden" value="{{csrf_token()}}">
        <input type="hidden" id="client_id" value="">
        <input type="hidden" id="plan_id" value="">          
        <div class="modal-body" style="height: 300px; overflow-y: auto" >        
          <div class="item form-group">
            <label class="control-label" for="name">Client Name <span class="required">*</span>
            </label>
            <div class="">
              <input id="name" class="form-control" data-validate-length-range="6" value="" name="name" placeholder="" required="required" disabled="disabled"  type="text">
            </div>
          </div>
          <div class="item form-group">
            <label class="control-label" for="account">Medical Aid Number</label>
            <div class="">
              <input id="medical_aid_number" class="form-control" data-validate-length-range="6" value="" name="medical_aid_number" placeholder="" disabled="disabled" type="text">
            </div>
          </div>
          <div class="item form-group">
            <label class="control-label" for="id_number">ID Number</label>
            <div class="">
              <input id="id_number" class="form-control" data-validate-length-range="6" value="" disabled="disabled" name="id_number" placeholder=""  type="text">
            </div>
          </div> 
          <div class="item form-group">
            <label class="control-label" for="plan">Plan</label>
            <div class="">
              <input id="plan_name" class="form-control" data-validate-length-range="6" value="" disabled="disabled" name="plan" placeholder=""  type="text">
            </div>
          </div>
          <div class="item form-group">
            <label class="control-label" for="amount">Amount</label>
            <div class="">
              <input id="amount" class="form-control" data-validate-length-range="6" disabled="disabled" value="" name="amount" placeholder="Amount To Pay"  type="number">
            </div>
          </div>
          <div class="item form-group">
            <label class="control-label" for="ref_number">Reference Number</label>
            <div class="">
              <input id="ref_number" class="form-control" data-validate-length-range="6" value="" name="ref_number" placeholder="Enter Ref Number"  type="text">
            </div>
          </div> 
          <div class="item form-group">
            <label class="control-label" for="mop">Mode Of Payment</label>
            <div class="">
              <select class="select2_single form-control" tabindex="-1" id="mop">
                <option></option>
                @foreach($mops as $mop)
                <option value="{{ $mop->id }}">{{ $mop->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="item form-group">
            <label class="control-label" for="month_paid_for">Month Paid For:</label>
            <div class="">
              <select class="select2_multiple form-control" name="month_paid_for" required="required" id="month_paid_for">
                <option></option>  
                <option>January</option>
                <option>February</option>
                <option>March</option>
                <option>April</option>
                <option>May</option>
                <option>June</option>
                <option>July</option>
                <option>August</option>
                <option>September</option>
                <option>October</option>
                <option>November</option>
                <option>December</option>                              
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer" style="background-color:#2F4F4F">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button id="insertbutton" type="button"  onclick="saveData()" class="btn btn-primary"></button>
        </div>
      </form>

    </div>
  </div>
</div>


<!-- Modal For View -->
<div class="modal fade" id="modal-view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="modal-title"></h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form>      
              
        <div class="modal-body">        
          <div class="item form-group">
            <label class="control-label" for="name">Bank Name 
            </label>
            <div class="">
              <input id="name-view" class="form-control" data-validate-length-range="6" value="" name="name-view" placeholder="N/A" required="required" disabled="disabled"  type="text">
            </div>
          </div>
          <div class="item form-group">
            <label class="control-label" for="account">Account Number</label>
            <div class="">
              <input id="account_number-view" class="form-control" data-validate-length-range="6" value="" name="account_number" placeholder="N/A" disabled="disabled"  type="text">
            </div>
          </div>     
          
        </div>
        
      </form>

    </div>
  </div>
</div>