<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; } ?>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Admin Panel</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="<?php wd_url($wd_type, $wd_app, 'start.php', ''); ?>">Dashboard</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'LoginLog.php', ''); ?>">Monthly Login Log</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'LoginFLog.php', ''); ?>">Monthly Failed Login Log</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'ManageUsers.php', ''); ?>">Manage Users</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'Permissions.php', ''); ?>">Permissions</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'CSV_UP.php', ''); ?>">CSV Uplode</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'Fpath.php', ''); ?>">File Path</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
      </ul>
    </div>
  </div>
</nav>
