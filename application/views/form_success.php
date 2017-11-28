<div class="row center-block">
  <div class="row">
      <div class="col-md-10 col-md-offset-1">
          <div class="row">
              <div class="col-md-12">
                  <div role="alert" class="alert alert-success"><span>Event successfully created!</span></div>
                  <hr />
                  <a href="<?php echo $this->data['re_link'], $this->data['msg2']?>">Add another event</a>
                  <hr />
                  <div class="table-responsive">
                      <table class="table">
                        <?php echo $this->data['output']; ?>
                      </table>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>