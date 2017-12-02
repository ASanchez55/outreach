<div class="row">
<div class="col-md-10 col-md-offset-1">
    <h1>Search Family:</h1>
    <form>
        <div class="form-group">
            <input type="text" name="searchKeyword" placeholder="Last Name or Family Number" class="form-control" />
        </div>
        <div class="form-group">
            <button class="btn btn-primary" type="submit">Search </button>
        </div>
        <hr />
    </form>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ID </th>
                    <th>Family Name</th>
                    <th>Actions </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($this->data['families'] as $family) { ?>
                  <tr>
                    <td><?php echo $family['id'] ?></td>
                    <td><?php echo $family['name'] ?> </td>
                    <td>
                        <a class="btn btn-info" type="button" href="<?php echo "family/view/".$family['id'] ?>">View </a>
                        <a class="btn btn-primary" type="button" href="<?php echo "family/addFamilyMember/".$family['id'] ?>">Add Family Member</a>
                        <a class="btn btn-primary" type="button">Register Family to an Event</a>
                    </td>
                  </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
</div>