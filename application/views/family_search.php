<div class="row center-block">
      <div class ="row">
        <div class="col-md-10 col-md-offset-1">
          <form>
            <div class="form-group">
              <label class="control-label">Search Last Name:</label>
              <input class="form-control" type="text" name="search_value" />
            </div>
            <div class="form-group">
              <button class="btn btn-primary" type="submit">Search</button>
            </div>
          </form>
      </div>

      <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Family Name</th>
                    <th>First Name</th>
                    <th>Add Family Member</th>
                  </tr>
                </thead>
                <tbody>

                  <?php echo $this->data['output']; ?>
                </tbody>
              </table>
            </div>
        </div>
      </div>


    </div>
<div>