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
            <form class="form-horizontal">
                <div class="form-group">
                    <div class="col-md-12">
                        <input type="text" placeholder="ex. Dela Cruz" class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <button class="btn btn-primary" type="button">Search </button>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Family ID</th>
                            <th>Family Name</th>
                            <th>Name </th>
                            <th>Actions </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1 </td>
                            <td>Simpson </td>
                            <td>Homer </td>
                            <td>
                                <button class="btn btn-success" type="button">Add Attendance</button>
                            </td>
                        </tr>
                        <tr>
                            <td>1 </td>
                            <td>Simpson </td>
                            <td>Bart </td>
                            <td>
                                <button class="btn btn-danger" type="button">Remove Attendance</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>