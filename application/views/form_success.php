<div class="row center-block">
  <form class="form-horizontal" method="post" action="">
    <fieldset>
      <!-- Form Name -->
      <legend>Success</legend>
      

      <!-- Message-->
      <div class="form-group">
        <div class="col-md-4">
         <h3><?php echo $msg;?></h3>
        </div>
      </div>

      <!-- Output-->
      <div class="form-group">
        <div class="col-md-4">
         <?php echo $output;?>
        </div>
      </div>

      <!-- Link-->
      <div class="form-group">
        <div class="col-md-4">
         <?php echo anchor($re_link, $msg2); ?>
        </div>
      </div>

      <!-- Link-->
      <div class="form-group">
        <div class="col-md-4">
        <?php echo anchor($re_link2, $msg3); ?>
        </div>
      </div>

     

    </fieldset>
  </form>

</div>