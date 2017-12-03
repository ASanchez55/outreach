<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false"
          aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo base_url(); ?>">Outreach</a>
      </div>
      <div id="navbar" class="collapse navbar-collapse">
        <?php if ($this->session->has_userdata('logged_in')) : ?>
        <ul class="nav navbar-nav">
          <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Family <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="<?php echo site_url('family/add') ?>">Add Family</a></li>
                  <!-- <li><a href="<?php echo site_url('family/addFamilyMember') ?>">Add Family Member</a></li> -->
                  <li role="separator" class="divider"></li>
                  <li><a href="<?php echo site_url('family') ?>">Search Family</a></li>
                </ul>
          </li>
          <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Events <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="<?php echo site_url('event/create') ?>">Create Event</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="#">Search Events</a></li>
                </ul>
          </li>
          <li>
            <a href="#contact">Reports</a>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo site_url('admin/logout'); ?>">Sign-out</a></li>
        </ul>
        <?php endif; ?>
      </div>
      <!--/.nav-collapse -->
    </div>
  </nav>