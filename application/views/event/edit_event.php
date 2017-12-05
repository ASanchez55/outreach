<div class="row center-block">
  <form class="form-horizontal" method="post" action="">
    <fieldset>
      <!-- Form Name -->
      <div class="form-group">
        <label class="col-md-3 control-label"></label>
        <div class="col-md-6">
          <h3>Update Event</h3>
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

      <?php 
      foreach ($this->data['event_details'] as $event_details) 
      {

      

      ?>

      <!-- Text input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="familyName">Event Name</label>
        <div class="col-md-4">
          <input id="familyName" name="event_name" type="text" placeholder="" class="form-control input-md" value="<?php echo set_value('event_name', $event_details['name']); ?>" >
          <span class="help-block"></span>
        </div>
      </div>

      <!-- Event Date-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="_submitButton">Event Date</label>
        <div class="col-md-4">
          <input type="date" name="event_date" value="<?php echo set_value('event_date', $event_details['event_date']); ?>" >
        </div>
      </div>

      <!-- Text input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="maxParticipants">Maximum Number of Participants</label>
        <div class="col-md-1">
          <input id="maxParticipants" name="max_participants" type="number" placeholder="ex. 100" class="form-control input-md" value="<?php echo set_value('max_participants', $event_details['max_participants']); ?>" >
          <span class="help-block"></span>
        </div>
      </div>

      <!-- Button -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="_submitButton"></label>
        <div class="col-md-4">
          <button id="_submitButton" name="_submitButton" class="btn btn-primary">Update Event</button>
        </div>
      </div>

      <input type="hidden" name="event_id" value="<?php echo $event_details['id'];?>">

      <?php } ?>

    </fieldset>
  </form>

</div>