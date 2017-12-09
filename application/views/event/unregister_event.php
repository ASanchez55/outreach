<div class="col-md-10 col-md-offset-1">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h3>Unregister Family To Event</h3>
            <hr />
            <form class="form-horizontal" method="post" action="<?php echo site_url('event/unregisterConfirmFamily') ?>">
                <div class="form-group">
                    <div class="col-md-2">
                        <label class="control-label">Event </label>
                    </div>
                    <div class="col-md-6">
                        <select name="event_id" class="form-control">
                            <optgroup label="Select an Event">
                            <?php foreach($this->data['events'] as $event) { ?>
                                <option value="<?php echo $event['event_id'] ?>"><?php echo $event['event_name']; ?></option>
                            <?php } ?>
                            </optgroup>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-2">
                        <label class="control-label">Family ID</label>
                    </div>
                    <div class="col-md-2 col-md-offset-0">
                        <input type="text" name="family_id" readonly class="form-control" value="<?php echo $this->data['familyId'] ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-2">
                        <label class="control-label">Family Name</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" readonly value="<?php echo $event['family_name'] ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-2">
                        <label class="control-label"> </label>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-primary" type="submit">Unregister </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>