<div class="row center-block">
  <form class="form-horizontal" method="post" action="">
    <fieldset>
      <!-- Form Name -->
      <div class="form-group">
      <label class="col-md-3 control-label"></label>
      <div class="col-md-6">
       <!-- <h3>Add Family Member</h3>-->
        <hr />
      </div>
    </div>
      

      

      <!-- Output
      <div class="form-group">
        <div class="col-md-4">
         <?php echo $this->data['output'];?>
        </div>
      </div>-->

      <!-- Output-->
      <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="table-responsive">
              <table class="table">
                

                  <?php echo $this->data['output']; ?>
                
              </table>
            </div>
        </div>
      </div>

      <!-- Message-->
      <div class="form-group">
        <div class="col-md-4">
         <h3><?php echo $this->data['msg'];?></h3>
        </div>
      </div>

      <!-- Link-->
      <div class="form-group">
        <div class="col-md-4">
         <?php echo anchor($this->data['re_link'], $this->data['msg2']); ?>
        </div>
      </div>

      <!-- Link-->
      <div class="form-group">
        <div class="col-md-4">
        <?php echo anchor($this->data['re_link2'], $this->data['msg3']); ?>
        </div>
      </div>

     

    </fieldset>
  </form>

</div>