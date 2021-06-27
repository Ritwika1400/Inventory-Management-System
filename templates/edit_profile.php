<!-- Modal -->
<div class="modal fade" id="form_user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
      <form id="user_form" onsubmit="return false">
      <div class="form-group">
        <label>Name</label>
        <input type="hidden" name="id" id="id" value="<?php echo $_SESSION["userid"];?>"/>
        <input type="text" class="form-control" name="user_name" id="user_name" value="<?php echo $_SESSION["username"]; ?>">
        <small id="user_error" class="form-text text-muted"></small>
      </div>

      <button type="submit" class="btn btn-primary">Add</button>
      </form>




      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>