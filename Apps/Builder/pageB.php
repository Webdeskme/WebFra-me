<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
if(isset($_GET['page'])){
  $page = test_input($_GET['page']);
}
else{
  $page = "";
}
if(isset($_POST['con'])){
  $con = htmlspecialchars_decode($wd_POST["con"], ENT_QUOTES);
  file_put_contents($wd_www . $page, $con);
}
?>
<script>
tinymce.init({
    selector: '#con',
    theme: 'modern',
    plugins: [
      'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
      'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
      'save table contextmenu directionality emoticons template paste textcolor toc autoresize hr insertdatetime pagebreak autosave save searchreplace'
    ],
    content_css: 'css/content.css',
    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons | fullscreen | toc | insertdatetime | pagebreak | restoredraft | save | template | searchreplace',
    templates : [
    {
      title: "Blank",
      url: "<?php echo $type; ?>/Writer/Temp0.html",
      description: "Blank Doc"
    },
    {
      title: "Two Columns",
      url: "<?php echo $type; ?>/Writer/Temp1.html",
      description: "Adds two columns."
    },
    {
      title: "Four Columns",
      url: "<?php echo $type; ?>/Writer/Temp2.html",
      description: "Adds four columns."
    }
  ]
  });
</script>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php wd_url($wd_type, $wd_app, 'start.php', ''); ?>">WebSite Builder</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="<?php wd_url($wd_type, $wd_app, 'start.php', ''); ?>">Pages</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'pcss.php', ''); ?>">CSS</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'pheader.php', ''); ?>">Header</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'pmedia.php', ''); ?>">Media</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'pbanner.php', ''); ?>">Banner</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'pfooter.php', ''); ?>">Footer</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'psettings.php', ''); ?>">Settings</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'pplugins.php', ''); ?>">Plugins</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'pthemes.php', ''); ?>">Themes</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'stats.php', ''); ?>">Stats</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'log.php', ''); ?>">Log</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="<?php wd_url($wd_type, $wd_app, 'page.php', '&page=' . $page); ?>"><span class="glyphicon glyphicon-pencil"></span> Code Editor</a></li>
        <li><a href="index.php?page=<?php echo $page; ?>" target="_blank"><span class="glyphicon glyphicon-sunglasses"></span> View Page</a></li>
        <li><?php wd_confirm($wd_type, $wd_app, 'pageSubDelete.php', '&page=' . $page, '1', '<i class="glyphicon glyphicon-trash"> Delete</i>'); ?></li>
      </ul>
    </div>
  </div>
</nav>
<div>
<form method="post" action="<?php wd_url($wd_type, $wd_app, 'pageB.php', '&page=' . $page); ?>" style="width: 90%; height: 70%;">
    <label for="con">Page Content: </label><br>
    <textarea name="con" id="con" for="con" placeholder="Enter your content." title="Enter your content." style="width: 100%; height:100%;"  autofocus><?php
if(isset($_GET['page']) && file_exists($wd_www . $page)){
    echo htmlspecialchars(file_get_contents($wd_www . $page));
//$f = fopen("www/Pages/" . $page, "r");
//  while(!feof($f)) {
//	    echo fgets($f);
//	}
//	fclose($f);
}
?></textarea>
    <br>
    <input type="submit" class="btn btn-success" value="Save">
</form>
</div>
<br>
<div>
  <?php
  if(file_exists("index.php?page=" . $page)){
  ?>
  <iframe src="index.php?page=<?php echo $page; ?>" width="90%;" height="600px;"></iframe>
  <?php
  }
    ?>
</div>
