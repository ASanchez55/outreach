<div class="col-md-10 col-md-offset-1">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h3>Find Event</h3>
            <hr />
            <form id="form1" class="form-horizontal" method="post" >
                <div class="form-group">
                    <div class="col-md-2">
                        <label class="control-label">Event </label>
                    </div>
                    <div class="col-md-6">
                        <select name="event_id_selected" class="form-control">
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
                        <button class="btn btn-primary" onclick="submitForm('findSubmit')" type="submit">View </button>
                        <button class="btn btn-info" onclick="submitForm('editEvent')" type="submit">Edit </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    
    function submitForm(action) 
    {
        var form = document.getElementById('form1');
        form.action = action;
        form.submit();
    }
</script>