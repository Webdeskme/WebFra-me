<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
if(isset($_GET['page'])){
  $page = test_input($_GET['page']);
}
else{
  $page = "";
}
if(isset($_POST['con']) && isset($_POST['par']) && isset($_POST['pr']) && isset($_POST['title'])){
  $con = htmlspecialchars_decode($wd_POST["con"], ENT_QUOTES);
  $par = test_input($_POST['par']);
  $pr = test_input($_POST['pr']);
  $title = test_input($_POST['title']);
  file_put_contents($wd_www . $page, $con);
  if(!file_exists($wd_www . "nav.json")){
    $obj = new stdClass;
  }
  else{
    $obj = file_get_contents($wd_www . "nav.json");
    $obj = json_decode($obj);
  }
  $pagen = array("par"=>$par, "pr"=>$pr, "title"=>$title, "page"=>$page);
  $obj->$page = $pagen;
  $jobj = json_encode($obj);
  file_put_contents($wd_www . "nav.json", $jobj);
}
?>
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
        <li><a href="<?php wd_url($wd_type, $wd_app, 'ppost.php', ''); ?>">Post</a></li>
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
        <li><a href="<?php wd_url($wd_type, $wd_app, 'pageB.php', '&page=' . $page); ?>"><span class="glyphicon glyphicon-pencil"></span> Basic Editor</a></li>
        <li><a href="index.php?page=<?php echo $page; ?>&wd_dev=on" target="_blank"><span class="glyphicon glyphicon-sunglasses"></span> View Page</a></li>
        <li><?php wd_confirm($wd_type, $wd_app, 'pageSubDelete.php', '&page=' . $page, '1', '<i class="glyphicon glyphicon-trash"> Delete</i>'); ?></li>
      </ul>
    </div>
  </div>
</nav>
<div>
<form method="post" action="<?php wd_url($wd_type, $wd_app, 'page.php', '&page=' . $page); ?>" style="width: 90%; height: 70%;">
  <div class="form-group">
    <label for="title">Page Title</label>
    <input id="title" name="title" class="form-control" value="<?php
    if(file_exists($wd_www . "nav.json")){
      $obj = file_get_contents($wd_www . "nav.json");
      $obj = json_decode($obj);
      echo $obj->$page->title;
    }
                                                               ?>" placeholder="Page title" required>
  </div>
    <label for="con">Page Content: </label>
    <textarea name="con" id="con" for="con" placeholder="Enter your content." title="Enter your content." style="width: 100%; height:100%; background-color: #000000; color: #ffffff; font-weight: bold; font-size: 1.25em;"  autofocus><?php
if(isset($_GET['page']) && file_exists($wd_www . $page)){
    echo htmlspecialchars(file_get_contents($wd_www . $page));}
?></textarea>
  <span class="form-group">
    <label for="parrent">Parrent</label>
    <select id="parrent" name="par">
      <option value="h"<?php if($obj->$page->par == "h"){ echo " selected";} ?>>Hide Page</option>
      <option value="np"<?php if($obj->$page->par == "np"){ echo " selected";} ?>>No Parrent</option>
      <?php
      if(file_exists($wd_www . "nav.json")){
       foreach($obj as $opage){
         ?>
         <option value="<?php echo $opage->page; ?>"<?php if($obj->$page->par == $opage->page){ echo " selected";} ?>><?php echo $opage->title; ?></option>
      <?php
       }
      }
      ?>
    </select>
  </span>
  <span class="form-group">
    <label for="priority">Priority</label>
    <select id="priority" name="pr">
      <?php
      $i = 9;
      while($i >= 1){
      ?>
      <option value="<?php echo $i; ?>"<?php if(file_exists($wd_www . "nav.json") && $obj->$page->pr == $i){ echo " selected";} ?>><?php echo $i; ?></option>
      <?php
      $i = $i - 1;
      }
        ?>
    </select>
  </span>
    <br>
    <input type="submit" class="btn btn-success" value="Save">
  <br>
</form>
<br>
<script>
var myCodeMirror = CodeMirror.fromTextArea(con, {
lineNumbers: true,
  mode:  "php",
  theme: "abcdef",
matchBrackets: true,
matchTags: {bothTags: true},
lineWrapping: true,
foldGutter: true,
gutters: ["CodeMirror-linenumbers", "CodeMirror-foldgutter", "CodeMirror-lint-markers"],
lint: true,
extraKeys: {"Ctrl-Space": "autocomplete",
"F11": function(cm) {
          cm.setOption("fullScreen", !cm.getOption("fullScreen"));
        },
        "Esc": function(cm) {
          if (cm.getOption("fullScreen")) cm.setOption("fullScreen", false);
        },
"Ctrl-J": "toMatchingTag"
}
});
</script>
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
<br>
