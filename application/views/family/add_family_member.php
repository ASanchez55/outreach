<div class="row center-block">

  <form class="form-horizontal" method="post" action="">
    <fieldset>

      <!-- Form Name -->
      <div class="form-group">
      <label class="col-md-3 control-label"></label>
      <div class="col-md-6">
        <h3>Add Family Member</h3>
        <hr />
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
        <label class="col-md-4 control-label" for="firstName">First Name</label>
        <div class="col-md-4">
          <input id="firstName" name="fname" type="text" placeholder="ex. Juan" class="form-control input-md" value="<?php echo set_value('fname'); ?>">
        </div>
      </div>

      <!-- Text input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="lastName">Last Name</label>
        <div class="col-md-4">
          <input type="text" class="form-control" name="family_name" readonly value="<?php echo $this->data['family_name']; ?>"/>
        </div>
      </div>

      <!-- Dropdown -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="gender">Gender</label>
        <div class="col-md-4">
          <?php 
            $options = array(
                'Male'    => 'Male',
                'Female'  => 'Female'
            );
            $js = 'class="form-control"';
            echo form_dropdown('gender', $options, '',$js);
           ?>
        </div>
      </div>

      <!-- Birthday -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="_submitButton">Birthday</label>
        <div class="col-md-4">
          <input type="date" name="birth_date" value="<?php echo set_value('birth_date'); ?>">
        </div>
      </div>

      <!-- Radio Button -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="gender">Head of the Family</label>
        <div class="col-md-4">
          <div class="radio-inline">
              <label for="head-0">
                <?php 
                  $options = array(
                          'name'          => 'head_family',
                          'value'         => 1,
                          'checked'       => FALSE
                  );

                  echo form_radio($options);
                ?> Yes
              </label>
            </div>
            <div class="radio-inline">
              <label for="head-1">
                <?php 
                  $options = array(
                          'name'          => 'head_family',
                          'value'         => 0,
                          'checked'       => TRUE
                  );

                  echo form_radio($options);
                ?> No
              </label>
            </div>
          
        </div>
      </div>

      <!-- Button -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="_submitButton"></label>
        <div class="col-md-4">
          <button id="_submitButton" name="_submitButton" class="btn btn-primary">Add Family Member</button>
        </div>
      </div>

    </fieldset>
  </form>


</div>