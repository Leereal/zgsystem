<!-- Modal -->
<div class="modal fade" id="modal-approve" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <label class="control-label" for="name">Full Name<span class="required">*</span>
            </label>
            <div class="">
              <input id="name" class="form-control" data-validate-length-range="6" value="" name="name" disabled="disabled" type="text">
            </div>
          </div>
          <div class="item form-group">
            <label class="control-label" for="account">Email:</label>
            <div class="">
              <input id="email" class="form-control" data-validate-length-range="6" value="" name="email" disabled="disabled"  type="text">
            </div>
          </div>  

          <div class="item form-group">
            <label class="control-label" for="branch">Branch</label>
            <div class="">
              <select class="select2_single form-control" tabindex="-1" id="branch">
                <option></option>
                @foreach($branches as $branch)
                <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="item form-group">
            <label class="control-label" for="mop">Access Level</label>
            <div class="">
              <select class="select2_single form-control" tabindex="-1" id="role">
                <option></option>
                @foreach($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
              </select>
            </div>
          </div>   
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button id="insertbutton" type="button"  onclick="" class="btn btn-primary">Save Changes</button>
        </div>
      </form>

    </div>
  </div>
</div>


