<?php
/*if(isset($_GET['page'])){
  $page = test_input($_GET['page']);
}
else{
  $page = "";
}
*/
if(isset($_POST['con']) && isset($_POST['title'])){
  $title = test_input($_POST['title']);
  $con = test_input($_POST["con"], ENT_QUOTES);
  if(!file_exists("www/Pages/feed.json")){
    $obj = new stdClass;
  }
  else{
    $obj = file_get_contents("www/Pages/feed.json");
    $obj = json_decode($obj);
  }
  if(isset($_GET['id']) && $_GET['id'] != ""){
  $id = test_input($_GET['id']);
}
else{
  $id = date("YmdHis");
}
     $post = array("title" => $title, "con" => $con);
     $obj->$id = $post;
     $nObj = json_encode($obj);
     file_put_contents("www/Pages/feed.json", $nObj);
if (isset($_SERVER['HTTPS']) &&
    ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
    isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
    $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
    $protocol = 'https://';
  }
else {
  $protocol = 'http://';
}
$feed = '<?xml version="1.0" encoding="UTF-8" ?>
<rss version="2.0">
<channel>
  <title>' . $_SERVER["SERVER_NAME"] . '</title>
  <link>' . $protocol . $_SERVER["SERVER_NAME"] . '</link>
  <description>' . $_SERVER["SERVER_NAME"] . ' site feed</description>';
if(file_exists("www/Pages/feed.json")){
  $obj = file_get_contents("www/Pages/feed.json");
  $obj = json_decode($obj, TRUE);
  foreach($obj as $post){
    $title = $post["title"];
    $con = htmlspecialchars_decode ($post["con"]);
  $feed = $feed . '<item>
    <title>' . (string)$title . '</title>
    <link>' . $protocol . $_SERVER["SERVER_NAME"] . '</link>
    <description><![CDATA[' . (string)$con . ']]></description>
  </item>';
  }
}
 $feed = $feed . '</channel>
</rss>';
file_put_contents("feed.xml", $feed);
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
        <li><a href="<?php wd_url($wd_type, $wd_app, 'start.php', ''); ?>">Pages</a></li>
        <li class="active"><a href="<?php wd_url($wd_type, $wd_app, 'ppost.php', ''); ?>">Post</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'pcss.php', ''); ?>">CSS</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'pheader.php', ''); ?>">Header</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'pmedia.php', ''); ?>">Media</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'pbanner.php', ''); ?>">Banner</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'pfooter.php', ''); ?>">Footer</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'psettings.php', ''); ?>">Settings</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'pplugins.php', ''); ?>">Plugins</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'pthemes.php', ''); ?>">Themes</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="<?php wd_url($wd_type, $wd_app, 'page.php', '&page=' . $page); ?>"><span class="glyphicon glyphicon-pencil"></span> Code Editor</a></li>
        <li><a href="index.php?page=<?php echo $page; ?>" target="_blank"><span class="glyphicon glyphicon-sunglasses"></span> View Page</a></li>
        <li><?php wd_confirm($wd_type, $wd_app, 'pageSubDelete.php', '&page=' . $page, '1', '<i class="glyphicon glyphicon-trash"> Delete</i>'); ?></li>
      </ul>
    </div>
  </div>
</nav>
<form method="post" action="<?php wd_url($wd_type, $wd_app, 'ppost.php', ''); ?>" style="width: 90%; height: 70%;">
    <label for="title">Post Title: </label><br>
    <input id="title" name="title" title="The Title" placeholder="The Title" value="">
  <br>
    <label for="con">Post Content: </label><br>
    <textarea name="con" id="con" for="con" placeholder="Enter your content." title="Enter your content." style="width: 100%; height:100%;"  autofocus><?php 
/*if(isset($_GET['page']) && file_exists("www/Pages/" . $page)){
    echo htmlspecialchars(file_get_contents("www/Pages/" . $page));
} */
?></textarea>
    <br>
    <input type="submit" class="btn btn-success" value="Save">
</form>
<br>