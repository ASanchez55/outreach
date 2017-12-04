<div class="col-md-11 col-md-offset-0">
    <div class="row">
        <div class="col-md-11 col-md-offset-1 col-sm-10 col-sm-offset-1">
            <h3><?php echo $this->data['event']['name'] ?></h3>
            <form class="form-horizontal">
                <div class="form-group">
                    <div class="col-md-11"><span>Number of Registered Families : <strong><?php echo $this->data['number_of_families_registered'] ?> / <?php echo $this->data['event']['max_participants'] ?></strong></span></div>
                </div>
            </form>
        </div>
        <div class="col-md-11 col-md-offset-1 col-sm-10 col-sm-offset-1">
            <h3>Search Registered Families</h3>
            <form class="form-horizontal" method="post" action="" >
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
                                    <td><?php echo $family['id'] ?></td>
                                    <td><?php echo $family['name'] ?> </td>
                                    <td><?php echo $familyMember['id'] ?></td>
                                    <td><?php echo $familyMember['name'] ?> </td>
                                    <td>
                                        <button class="btn btn-success" type="button">Add Attendance</button>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>