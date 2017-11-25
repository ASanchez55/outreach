<div class="row center-block">
  <form class="form-horizontal" method="post" action="">
    <fieldset>
      <!-- Form Name -->
      <div class="form-group">
        <label class="col-md-3 control-label"></label>
        <div class="col-md-6">
          <h3>Create Family</h3>
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
          <input id="familyName" name="family_name" type="text" placeholder="ex. Dela Cruz" class="form-control input-md" value="<?php echo set_value('family_name', $this->data['family_name'] ); ?>">
          <span class="help-block">Last Name of the Family</span>
        </div>
      </div>

      <!-- Text input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="familyName">Address</label>
        <div class="col-md-4">
          <input id="familyName" name="comp_add" type="text" placeholder="ex. MUNTINDILAW" class="form-control input-md" value="<?php echo set_value('comp_add', $this->data['comp_add'] ); ?>" >
          <span class="help-block"></span>
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
        <label class="col-md-4 control-label" for="familyName">Address</label>
        <div class="col-md-4">
          <?php echo $event_list; ?>
          <span class="help-block">House Number, Building, and Street Name</span>
        </div>
      </div>
      

      <!-- Button -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="_submitButton"></label>
        <div class="col-md-4">
          <button id="_submitButton" name="_submitButton" class="btn btn-primary">Create Family</button>
        </div>
      </div>

       

    </fieldset>
  </form>

</div>