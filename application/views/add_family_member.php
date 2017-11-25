 <div class="row center-block">

  <form class="form-horizontal" method="post" action="">
    <fieldset>

      <!-- Form Name -->
      <legend>Add Family Member</legend>

      <!-- Error Box-->
      <div class="form-group">
        <div class="col-md-4">
         <?php echo validation_errors(); ?>
        </div>
      </div>

      <!-- Text input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="firstName">First Name</label>
        <div class="col-md-4">
          <input id="firstName" name="fname" type="text" placeholder="ex. Juan" class="form-control input-md" value="<?php echo set_value('fname', $fname ); ?>">
        </div>
      </div>

      <!-- Text input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="firstName">Last Name</label>
        <div class="col-md-4">
          <?php echo $family_name; ?>
        </div>
      </div>

      <!-- Dropdown -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="gender">Gender</label>
        <div class="col-md-4">
          <?php echo $gender; ?>
        </div>
      </div>

      <!-- Birthday -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="_submitButton">Birthday</label>
        <div class="col-md-4">
          <input type="date" name="birth_date" value="<?php echo set_value('birth_date', $birth_date ); ?>">
        </div>
      </div>

      <!-- Registration Date -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="_submitButton">Registration Date</label>
        <div class="col-md-4">
          <input type="date" name="date_registered" value="<?php echo set_value('date_registered', $date_registered ); ?>">
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