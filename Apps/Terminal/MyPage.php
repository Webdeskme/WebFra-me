<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }

if(isset($_GET['dir'])){
  $dir = test_input($_GET['dir']); 
  if(isset($_GET['file']))
    $file = test_input($_GET['file']);
}
else{ $dir = ""; $file=""; }
if($dir != "" && $dir != '/'){
  $ndir = '&dir=' . rtrim($dir, '/');
}
else{
  $ndir = "";
}
$OldDir = $dir;
$dir = $dir . $file;
?>
<nav class="navbar navbar-expand-md bg-light">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand text-dark" href="<?php wd_url($wd_type, $wd_app, 'start.php', ''); ?>"><img src="//<?php echo $_SERVER["HTTP_HOST"] ?>/Apps/Terminal/ic.png" width="24" class="img" /> Terminal Portal</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#terminalNavbar" aria-controls="terminalNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa fa-bars fa-fw"></i>
      </button>
    </div>
    <div class="" id="myNavbar">
      <ul class="navbar-nav justify-content-end">
        <!--<li class="nav-item"><a href="#" data-toggle="modal" data-target="#functionsHelpModal" class="btn btn-link"><i class="fa fa-code fa-fw"></i> WD Functions</a></li>-->
        <!--<li class="nav-item"><a href="<?php wd_urlSub($wd_type, $wd_app, 'view.php', '&dir=' . $OldDir . '&file=' . $file); ?>" target="_blank" class="btn btn-link"><span class="fa fa-file fa-fw"></span> View</a></li>-->
        <!--<li class="nav-item"></li>-->
      </ul>
    </div>
  </div>
</nav>
<div class="bg-secondary text-white px-4 py-3">
  <a href="<?php wd_urlSub($wd_type, $wd_app, 'view.php', '&dir=' . $OldDir . '&file=' . $file); ?>" target="_blank" class="btn btn-light float-right"><span class="fa fa-eye fa-fw"></span> View</a>
  <h4>Editing: <?php echo $dir ?></h4>
</div>
<div class="px-4 py-3">
  
  <div class="row">
    <div class="col">
      <div class="mb-3">
        <form name="updatePageForm" method="post" action="<?php wd_urlSub($wd_type, $wd_app, 'MyPageSub.php', ''); ?>" style="height: 40vh;">
          <input type="hidden" name="dir" value="<?php echo $OldDir; ?>">
          <input type="hidden" name="file" value="<?php echo $file; ?>">
          <div class="row">
            <div class="col">
              <label for="con">Page Content: </label>
            </div>
            <div class="col text-right">
              <a href="#" data-toggle="modal" data-target="#functionsHelpModal" class="btn btn-link"><i class="fa fa-code fa-fw"></i> WD Functions</a>
            </div>
          </div>
          
          <textarea id="con" name="con" for="con" class="form-control" placeholder="Enter your content." title="Enter your content." style="width: 100%; height: 100%; background-color: #000000; color: #ffffff; font-weight: bold; font-size: 1.25em;" autofocus><?php echo (file_exists($dir)) ? htmlspecialchars(file_get_contents($dir)) : ""; ?></textarea>
          <br />
          <div class="btn-group">
            <button type="submit" class="btn btn-success"><i class="fa fa-save fa-fw"></i> Save changes</button>
            <a href="<?php wd_url($wd_type, $wd_app, 'MyPage.php', '&dir=' . $_GET["dir"] . '&file=' . $file); ?>" class="btn btn-secondary text-white"><i class="fa fa-ban fa-fw"></i> Revert changes</a>
            <?php wd_confirm($wd_type, $wd_app, 'MyPageSubDelete.php', '&dir=' . $OldDir . '&file=' . $file, '1', '<i class="fa fa-trash fa-fw"></i> Delete file'); ?>
          </div>
        </form>
      </div>
    </div>
  </div>
  
  <?php include("FunctionHelp.php"); ?>
  <script>
  $(document).ready(function(){
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
  });
  </script>
  <br><br><br>
</div>