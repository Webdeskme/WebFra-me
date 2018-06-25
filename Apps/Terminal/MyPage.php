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
<nav class="webdesk_navbar webdesk_navbar-expand-md webdesk_bg-light">
  <div class="webdesk_container-fluid">
    <div class="webdesk_navbar-header">
      <a class="webdesk_navbar-brand" href="<?php wd_url($wd_type, $wd_app, 'start.php', ''); ?>">Terminal Portal</a>
      <button class="webdesk_navbar-toggler" type="button" data-toggle="webdesk_collapse" data-target="#terminalNavbar" aria-controls="terminalNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa fa-bars fa-fw"></i>
      </button>
    </div>
    <div class="webdesk_collapse webdesk_navbar-collapse" id="myNavbar">
      <ul class="webdesk_navbar-nav webdesk_justify-content-end">
        <li><a href="#" data-toggle="webdesk_modal" data-target="#functionsHelpModal" class="webdesk_btn webdesk_btn-link"><i class="fa fa-code fa-fw"></i> WD Functions</a></li>
        <li><a href="<?php wd_urlSub($wd_type, $wd_app, 'view.php', '&dir=' . $OldDir . '&file=' . $file); ?>" target="_blank" class="webdesk_btn webdesk_btn-link"><span class="fa fa-file fa-fw"></span> View</a></li>
        <li><?php wd_confirm($wd_type, $wd_app, 'MyPageSubDelete.php', '&dir=' . $OldDir . '&file=' . $file, '1', '<i class="fa fa-trash fa-fw"></i> Delete'); ?></li>
      </ul>
    </div>
  </div>
</nav>
<div class="px-3">
  <h2><?php echo $dir ?></h2>
  <div class="webdesk_row">
    <div class="webdesk_col-md-9">
      <div class="mb-3">
        <form name="updatePageForm" method="post" action="<?php wd_urlSub($wd_type, $wd_app, 'MyPageSub.php', ''); ?>"  style="width: 90%; height: 60%;">
          <input type="hidden" name="dir" value="<?php echo $OldDir; ?>">
          <input type="hidden" name="file" value="<?php echo $file; ?>">
          <label for="con">Page Content: </label>
          <textarea id="con" name="con" for="con" class="form-control" placeholder="Enter your content." title="Enter your content." style="width: 100%; height: 100%; background-color: #000000; color: #ffffff; font-weight: bold; font-size: 1.25em;" autofocus><?php echo (file_exists($dir)) ? htmlspecialchars(file_get_contents($dir)) : ""; ?></textarea>
          <br />
          <input type="submit" class="webdesk_btn webdesk_btn-success" value="Save">
        </form>
      </div>
    </div>
    <div class="webdesk_col">
      <a href="#" data-toggle="webdesk_collapse" href="#wd_functions_collapse" role="button" aria-expanded="false" aria-controls="wd_functions_collapse"><i class="fa fa-code fa-fw"></i> WD Functions</a>
      <div class="webdesk_collabse" id="wd_functions_collapse">
        
      </div>
    </div>
  </div>
  
  <?php include("FunctionHelp.php"); ?>
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
  <br><br><br>
</div>