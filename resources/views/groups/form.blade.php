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
            <label class="control-label" for="name">Corporate Name <span class="required">*</span>
            </label>
            <div class="">
              <input id="name" class="form-control" data-validate-length-range="6" value="" name="name" placeholder="Enter Group Name" required="required"  type="text">
            </div>
          </div>

          <div class="item form-group">
            <label class="control-label" for="contact_person">Contact Person <span class="required">*</span>
            </label>
            <div class="">
              <input id="contact_person" class="form-control" data-validate-length-range="6" value="" name="contact_person" placeholder="Enter Contact Person" required="required"  type="text">
            </div>
          </div>

          <div class="item form-group">
            <label class="control-label" for="name">Email
            </label>
            <div class="">
              <input id="email" class="form-control" data-validate-length-range="6" value="" name="email" placeholder="Enter Email"  type="email">
            </div>
          </div> 

          <div class="item form-group">
            <label class="control-label" for="phone">Phone 
            </label>
            <div class="">
              <input id="phone" class="form-control" data-validate-length-range="6" value="" name="phone" placeholder="Enter Phone" type="text">
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
            <label class="control-label" for="name">Corporate Name 
            </label>
            <div class="">
              <input id="name-view" class="form-control" data-validate-length-range="6" value="" name="name-view" placeholder="N/A" required="required" disabled="disabled"  type="text">
            </div>
          </div> 
        </div>

        <div class="item form-group">
            <label class="control-label" for="contact_person">Contact Person <span class="required">*</span>
            </label>
            <div class="">
              <input id="contact_person-view" class="form-control" data-validate-length-range="6" value="" name="contact_person-view" placeholder="Enter Contact Person" disabled="disabled"  type="text">
            </div>
          </div>

          <div class="item form-group">
            <label class="control-label" for="name">Email
            </label>
            <div class="">
              <input id="email-view" class="form-control" data-validate-length-range="6" value="" name="email-view" placeholder="Enter Email" disabled="disabled"  type="email">
            </div>
          </div> 

          <div class="item form-group">
            <label class="control-label" for="phone">Phone 
            </label>
            <div class="">
              <input id="phone-view" class="form-control" data-validate-length-range="6" value="" name="phone-view" placeholder="Enter Phone" disabled="disabled"   type="text">
            </div>
          </div> 
        
      </form>

    </div>
  </div>
</div>