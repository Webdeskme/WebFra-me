<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; } ?>
<nav class="webdesk_navbar webdesk_navbar-expand-sm webdesk_text-white webdesk_fixed-bottom">
  <div class="webdesk_container-fluid">
    <button class="webdesk_navbar-toggler" type="button" data-toggle="webdesk_collapse" data-target="#footNavbar" aria-controls="footNavbar" aria-expanded="false" aria-label="Toggle navigation">
      <!--span class="navbar-toggler-icon"></span-->
      <i class="fa fa-bars fa-fw fa-lg text-white"></i>
    </button>
    <div class="webdesk_collapse webdesk_navbar-collapse" id="footNavbar">
    <ul class="webdesk_nav">
      <li class="webdesk_nav-item"><a class="webdesk_nav-link webdesk_text-white" href="https://www.copyright.gov/title17/" target="_blank" rel="noopener"><i class="fa fa-copyright" aria-hidden="true"></i> <?php echo date("Y") . ' ' . $wd_Title; ?>, All Rights Reserved
</a></li>
      <li class="webdesk_nav-item"><a class="webdesk_nav-link webdesk_text-white" href="<?php wd_www('Terms.php', ''); ?>">Terms Of Use</a></li>
      <li class="webdesk_nav-item"><a class="webdesk_nav-link webdesk_text-white" href="<?php wd_www('Privacy.php', ''); ?>">Privacy Policy</a></li>
      <li class="webdesk_nav-item"><a class="webdesk_nav-link webdesk_text-white" href="<?php wd_www('community-covenant.php', ''); ?>">Community Covenant</a></li>
      <li class="webdesk_nav-item"><a class="webdesk_nav-link webdesk_text-white" href="<?php wd_www('blog.php', ''); ?>">Blog</a></li>
      <li class="webdesk_nav-item"><a class="webdesk_nav-link webdesk_text-white" href="feed.php" target="_blank" rel="noopener">RSS Feed <i class="fas fa-rss"></i></a></li>
    </ul>
    <ul class="webdesk_nav webdesk_navbar-nav webdesk_navbar-right">
      <li><a class="webdesk_nav-link webdesk_text-white" href="http://webfra.me" target="_blank" rel="noopener">Proudly powerd by WebFrame</a></li>
    </ul>
    </div>
  </div>
</nav>
