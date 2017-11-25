<div class="row center-block">
  <form class="form-horizontal" method="post" action="">
    <fieldset>
      <!-- Form Name -->
      <div class="form-group">
        <label class="col-md-3 control-label"></label>
        <div class="col-md-6">
          <h3>Register Family to Event</h3>
          </hr>
        </div>
      </div>

      <?php if (validation_errors()) : ?>
      <!-- Error Box-->
      <div class="form-group">
        <label class="col-md-4 control-label"></label>
        <div class="col-md-4">
          <div class="alert alert-danger" role="alert">
            <span class="sr-only">Error:</span>
            <?php echo validation_errors(); ?>
          </div>
        </div>
      </div>
      <?php endif ?>

      <!-- Text input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="familyName">Family Name</label>
        <div class="col-md-4">
          <span class="help-block"><?php echo $family_name; ?></span>
        </div>
      </div>

      <!-- Registration Date-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="_submitButton">Registration Date</label>
        <div class="col-md-4">
          <input type="date" name="date_registered" value="<?php echo set_value('date_registered', $date_registered ); ?>">
        </div>
      </div>

      <!-- Dropdown-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="familyName">Event</label>
        <div class="col-md-4">
          <?php echo $event_list; ?>
        </div>
      </div>
      

      <!-- Button -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="_submitButton"></label>
        <div class="col-md-4">
          <button id="_submitButton" name="_submitButton" class="btn btn-primary">Register Family to Event</button>
        </div>
      </div>

       

    </fieldset>
  </form>

</div>