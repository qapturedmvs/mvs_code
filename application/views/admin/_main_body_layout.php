<?php $this->load->view('admin/components/_page_head'); ?>
<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo $site_url; ?>admin/dashboard"><?php echo $this->config->item('mvs_site_name'); ?></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="<?php echo $site_url; ?>admin/movie/lister">Movies</a></li>
        <li><a href="#">Actors</a></li>
        <li><a href="#">Members</a></li>
        <li><a href="<?php echo $site_url; ?>admin/user">Admin Users</a></li>
        <li><a href="<?php echo $site_url; ?>admin/settings">Settings</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="<?php echo $site_url; ?>admin/user/logout">Logout</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<?php $this->load->view($subview); ?>

<?php $this->load->view('admin/components/_page_foot'); ?>