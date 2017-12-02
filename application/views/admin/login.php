<div class="center-block">
  <div class="col-md-12">
    <div class="row">
    <form class="form-horizontal" method="post" action="">
    <fieldset>

      <!-- Form Name -->
      <div class="form-group">
        <label class="col-md-3 control-label"></label>
        <div class="col-md-6">
          <h2>Login</h2>
          </hr>
        </div>
      </div>
      
      <!-- Error Box-->
      <?php if ($error_message) : ?>
      <div class="form-group">
        <label class="col-md-4 control-label"></label>
        <div class="col-md-4">
          <div class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            <?php echo $error_message; ?>
          </div>
        </div>
      </div>
      <?php endif; ?>

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
  </div>
</div>
 