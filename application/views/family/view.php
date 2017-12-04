<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h3><?php echo $this->data['family_name']; ?></h3>
        <form class="form-horizontal">
            <div class="form-group">
                <div class="col-md-3">
                    <h4>Family ID : <?php echo $this->data['family_id'] ?></h4>
                </div>
            </div>
        </form>
        <a class="btn btn-success" type="button" href="<?php echo site_url("family/addFamilyMember/".$this->data['family_id']); ?>">Add Family Member</a>
        <a class="btn btn-primary" type="button" href="<?php echo site_url("event/register/".$this->data['family_id']); ?>">Register family to an event</a>
        <hr />
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID </th>
                        <th>Name </th>
                        <th>Gender </th>
                        <th>Birthday </th>
                        <th>Head of Family</th>
                        <th>Actions </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->data['family_members'] as $familyMember) {?>
                        <tr>
                        <td><?php echo $familyMember['id'] ?></td>
                        <td><?php echo $familyMember['name'] ?></td>
                        <td><?php echo $familyMember['gender'] ?></td>
                        <td><?php echo $familyMember['birthday'] ?></td>
                        <td><?php echo (boolval($familyMember['head_of_family']) ? 'Yes' : 'No') ?> </td>
                        <td>
                            <a class="btn btn-info" type="button" href="<?php echo site_url("familyMember/editFamilyMember/".$familyMember['id']); ?>">Edit</a>
                            <a class="btn btn-danger" type="button" href="<?php echo site_url("familyMember/deleteFamilyMember/".$familyMember['id']); ?>">Delete</a>
                        </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>