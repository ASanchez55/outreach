<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h1><?php echo $this->data['family_name']; ?></h1>
        <form class="form-horizontal">
            <div class="form-group">
                <div class="col-md-3">
                    <h3>Family ID :</h3></div>
                <div class="col-md-9">
                    <h3><?php echo $this->data['family_id'] ?></h3></div>
            </div>
        </form>
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
                        <td><?php echo $familyMember['head_of_family'] ?> </td>
                        <td>
                            <button class="btn btn-info" type="button">View </button>
                            <button class="btn btn-success" type="button">Edit </button>
                            <button class="btn btn-danger" type="button">Delete </button>
                        </td>
                        </tr>
                    <?php } ?>
                    <!-- <tr>
                        <td>1 </td>
                        <td>Homer Simpson</td>
                        <td>Male </td>
                        <td>2017-12-27 </td>
                        <td>Yes </td>
                        <td>
                            <button class="btn btn-info" type="button">View </button>
                            <button class="btn btn-success" type="button">Edit </button>
                            <button class="btn btn-danger" type="button">Delete </button>
                        </td>
                    </tr>
                    <tr></tr> -->
                </tbody>
            </table>
        </div>
    </div>
</div>