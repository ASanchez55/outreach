<div class="row center-block">
  <form class="form-horizontal" method="post" action="">
    <fieldset>
      <!-- Form Name -->
      <legend>User Login</legend>
      
      <!-- Error Box-->
      <div class="form-group">
        
        <div class="col-md-4">
         <?php echo $error_msg; ?>
          
        </div>
      </div>

      <!-- Text input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="familyName">Username</label>
        <div class="col-md-4">
          <input id="familyName" name="username" type="text" placeholder="" class="form-control input-md" required="">
        </div>
      </div>

      <!-- Text input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="familyName">Password</label>
        <div class="col-md-4">
          <input id="familyName" name="password" type="password" placeholder="" class="form-control input-md" required="">
        </div>
      </div>

      <!-- Button -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="_submitButton"></label>
        <div class="col-md-4">
          <button id="_submitButton" name="_submitButton" class="btn btn-primary">Login</button>
        </div>
      </div>

    </fieldset>
  </form>

</div>