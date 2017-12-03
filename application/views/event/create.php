<div class="row center-block">
  <form class="form-horizontal" method="post" action="">
    <fieldset>
      <!-- Form Name -->
      <div class="form-group">
        <label class="col-md-3 control-label"></label>
        <div class="col-md-6">
          <h3>Create Event</h3>
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
        <label class="col-md-4 control-label" for="familyName">Event Name</label>
        <div class="col-md-4">
          <input id="familyName" name="event_name" type="text" placeholder="" class="form-control input-md" value="<?php echo set_value('event_name', $this->data['event_name'] ); ?>">
          <span class="help-block"></span>
        </div>
      </div>

      <!-- Event Date-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="_submitButton">Event Date</label>
        <div class="col-md-4">
          <input type="date" name="date" value="<?php echo set_value('date', $date ); ?>">
        </div>
      </div>
      

      <!-- Button -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="_submitButton"></label>
        <div class="col-md-4">
          <button id="_submitButton" name="_submitButton" class="btn btn-primary">Create Event</button>
        </div>
      </div>

       

    </fieldset>
  </form>

</div>