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
                    <th>Head of Family</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- <tr></tr>
                  <tr>
                    <td>
                      1
                    </td>
                    <td>
                      Luffy
                    </td>
                    <td>
                      Monkey
                    </td>
                    <td>
                      Y
                    </td>
                    <td>
                      <div class="" role="group">
                        <button class="btn btn-primary" type="button">Add Family Member</button>
                        <button class="btn btn-primary" type="button">Participate Family</button>
                      </div>
                    </td>
                  </tr> -->
                </tbody>
              </table>
            </div>
        </div>
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



<!-- 
<div class="container pagecont">
  <div class="row"> 	
    
    <br>
    <br>
    
      <div class="card text-center" style="width: 100%;">
     <div class="card-body"> <br>
      <div class="pull-right">
     
      </div>
                                         
   
        <h3> Family search</h3>
        
        
        <form action="" method="get">
        <p> <input type="text" name="search_value"/> </p>
        <p> <input type="submit"/> </p> 
        <p> <?php echo $this->data['output']; ?> </p>
        </form>
      
     </div>
	</div>
                                
     
</div>
</div> -->