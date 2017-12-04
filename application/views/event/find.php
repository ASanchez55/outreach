<div class="col-md-10 col-md-offset-1">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h3>Find Event</h3>
            <hr />
            <form class="form-horizontal">
                <div class="form-group">
                    <div class="col-md-2">
                        <label class="control-label">Event </label>
                    </div>
                    <div class="col-md-6">
                        <select class="form-control">
                            <optgroup label="Select an Event">
                            <?php foreach($this->data['events'] as $event) { ?>
                                <option value="<?php echo $event['id'] ?>"><?php echo $event['name']; ?></option>
                            <?php } ?>
                            </optgroup>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-2">
                        <label class="control-label"> </label>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-primary" type="button">View </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>