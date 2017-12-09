<div class="col-md-11 col-md-offset-0">
    <div class="row">
        <div class="col-md-11 col-md-offset-1 col-sm-10 col-sm-offset-1">
            <h3><?php echo $this->data['event']['name'] ?></h3>
            <form>
                <div class="form-group">
                    <div class="col-md-12">
                        <span>Registered Families : <strong><?php echo $this->data['number_of_families_registered'] ?> / <?php echo $this->data['event']['max_participants'] ?></strong></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <span>Families Attending : <strong><?php echo $this->data['number_of_families_attending']; ?></strong></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <span>Family Members Attendees : <strong><?php echo $this->data['number_of_family_members_attending']; ?></strong></span>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-11 col-md-offset-1 col-sm-10 col-sm-offset-1">
            <h3>Search Registered Families</h3>
            <form class="form-horizontal" method="get" action="" >
                <div class="form-group">
                    <div class="col-md-12">
                        <input type="text" name="family_name" placeholder="ex. Dela Cruz" class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <button class="btn btn-primary" type="submit">Search </button>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Family ID</th>
                            <th>Family Name</th>
                            <th>Family Member ID </th>
                            <th>Name </th>
                            <th>Actions </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($this->data['families'] as $family) { ?>
                            <?php foreach($family['family_members'] as $familyMember) { ?>
                                <tr>
                                    <td><?php echo $family['family_id'] ?></td>
                                    <td><?php echo $family['name'] ?> </td>
                                    <td><?php echo $familyMember['id'] ?></td>
                                    <td><?php echo $familyMember['name'] ?> </td>
                                    <td>
                                        <?php if (($familyMember['attending'] == NULL) OR ($familyMember['attending'] == FALSE) ) { ?>
                                        <a class="btn btn-success" type="button" href="<?php echo site_url("event/registerFamilyMemberToEvent?family_id=".$family['family_id']."&family_member_id=".$familyMember['id']."&event_id=".$this->data['event']['id']."&family_name=".$this->data['familyName']); ?>">Add Attendance</a>
                                        <?php } else{ ?>
                                        <a class="btn btn-danger" type="button" href="<?php echo site_url("event/removeFamilyMemberToEvent?family_member_id=".$familyMember['id']."&event_id=".$this->data['event']['id']."&family_name=".$this->data['familyName']); ?>">Remove Attendance</a>
                                        <?php }  ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } //var_dump($this->data['families']) ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>