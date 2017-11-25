<div class="row center-block">
  <form class="form-horizontal" method="post" action="">
    <fieldset>
      <!-- Form Name -->
      <legend>Create Family</legend>
      

      <!-- Error Box-->
      <div class="form-group">
        
         <h3><?php echo validation_errors(); ?></h3>
        
      </div>

      <!-- Text input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="familyName">Family Name</label>
        <div class="col-md-4">
          <input id="familyName" name="family_name" type="text" placeholder="ex. Dela Cruz" class="form-control input-md" value="<?php echo set_value('family_name', $family_name ); ?>">
          <span class="help-block">Last Name of the Family</span>
        </div>
      </div>

      <!-- Text input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="familyName">Address</label>
        <div class="col-md-4">
          <input id="familyName" name="comp_add" type="text" placeholder="ex. B1 L1, Street 1" class="form-control input-md" value="<?php echo set_value('comp_add', $comp_add ); ?>" >
          <span class="help-block">House Number, Building, and Street Name</span>
        </div>
      </div>

       <!-- Registration Date
      <div class="form-group">
        <label class="col-md-4 control-label" for="_submitButton">Registration Date</label>
        <div class="col-md-4">
          <input type="date" name="date_registered" value="<?php echo set_value('date_registered', $date_registered ); ?>">
        </div>
      </div>
      -->

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