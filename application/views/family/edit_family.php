<div class="row center-block">

  
  <form class="form-horizontal" method="post" action="">
    <fieldset>

      <!-- Form Name -->
      <div class="form-group">
      <label class="col-md-3 control-label"></label>
      <div class="col-md-6">
        <h3>Edit Family</h3>
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

    <?php 
      foreach ($this->data['family_details'] as $family_details) 
      {
        //separate the string 
       

    ?>

      <!-- Text input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="firstName">Family ID</label>
        <div class="col-md-4">
          <input id="firstName" name="family_id" type="text"  class="form-control input-md" readonly value="<?php echo $family_details['id']; ?>">
        </div>
      </div>

      <!-- Text input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="firstName">Name</label>
        <div class="col-md-4">
          <input id="firstName" name="name" type="text" placeholder="ex. Juan" class="form-control input-md" value="<?php echo set_value('name', $family_details['name'] ); ?>">
        </div>
      </div>

      <!-- Text input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="lastName">Address</label>
        <div class="col-md-4">
          <input type="text" class="form-control" name="address"  value="<?php echo set_value('address', $family_details['address'] ); ?>"/>
        </div>
      </div>

      

      <!-- Button -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="_submitButton"></label>
        <div class="col-md-4">
          <button id="_submitButton" name="_submitButton" class="btn btn-primary">Update Family Details</button>
        </div>
      </div>

    <?php } ?>

    </fieldset>

  </form>
  

</div>