<!-- Modal -->
<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="modal-title"></h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form method="POST">        
        <input type="hidden" value="{{csrf_token()}}">        
        <div class="modal-body">        
          <div class="item form-group">
            <label class="control-label" for="name">Bank Name <span class="required">*</span>
            </label>
            <div class="">
              <input id="name" class="form-control" data-validate-length-range="6" value="" name="name" placeholder="Enter Bank Name" required="required"  type="text">
            </div>
          </div>
          <div class="item form-group">
            <label class="control-label" for="branch_code">Branch Code</label>
            <div class="">
              <input id="branch_code" class="form-control" data-validate-length-range="6" value="" name="branch_code" placeholder="Enter Branch Code"  type="text">
            </div>
          </div>
          <div class="item form-group">
            <label class="control-label" for="account">Account Number</label>
            <div class="">
              <input id="account_number" class="form-control" data-validate-length-range="6" value="" name="account_number" placeholder="Enter Account Number"  type="text">
            </div>
          </div>     
          
        </div>
        <div class="modal-footer">
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
            <label class="control-label" for="branch_code">Branch Code</label>
            <div class="">
              <input id="branch_code-view" class="form-control" data-validate-length-range="6" value="" name="branch_code" placeholder="N/A" disabled="disabled"  type="text">
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