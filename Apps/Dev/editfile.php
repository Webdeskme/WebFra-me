<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
include_once("config.inc.php");
include("appHeader.php");
?>
<form method="post" action="<?php wd_urlSub($wd_type, $wd_app, 'SaveFileSub.php', ''); ?>" style="height: 100%;">
  <input type="hidden" name="type" value="<?php echo $req["editType"]; ?>">
  <input type="hidden" name="nameA" value="<?php echo $req["editApp"]; ?>">
  <input type="hidden" name="nameP" value="<?php echo $req["file"]; ?>">
  
  
  
  <!--<div class="webdesk_bg-light webdesk_border-top webdesk_p-2">-->
  <!--  <h5>Editing <b><?php echo (!empty($req["file"])) ? $req["file"] : "" ?></b></h4>-->
  <!--</div>-->
  <nav aria-label="breadcrumb">
    <ol class="webdesk_breadcrumb webdesk_rounded-0">
      <li class="webdesk_breadcrumb-item"><a href="<?php echo wd_url($wd_type, $wd_app, 'start.php', ''); ?>"><?php echo $req['editType'] ?></a></li>
      <li class="webdesk_breadcrumb-item"><a href="<?php echo wd_url($wd_type, $wd_app, 'projectfiles.php', '&editType=' . $req['editType'] . '&editApp=' . $req['editApp']); ?>"><?php echo $req['editApp'] ?></a></li>
      <li class="webdesk_breadcrumb-item webdesk_active" aria-current="page"><?php echo (!empty($req["file"])) ? $req["file"] : "" ?></li>
    </ol>
  </nav>
  
  <div class="webdesk_row webdesk_no-gutters" style="height: 100%">
    <div class="webdesk_col-md-9" style="height: 100%">
      <textarea name="content" id="con" placeholder="Enter your content." title="Enter your content." style="width: 100%; height:50vh; background-color: #000000; color: #ffffff; font-weight: bold; font-size: 1.25em;"  autofocus><?php
        if(file_exists($req["editType"] . "/" . $req["editApp"] . "/" . $req["file"]))
          echo htmlspecialchars(file_get_contents($req["editType"] . "/" . $req["editApp"] . "/" . $req["file"]));
          ?>
      </textarea>
    </div>
    <div class="webdesk_col-md-3 webdesk_bg-light">
      <div class="webdesk_bg-light webdesk_py-3 webdesk_px-4 webdesk_sticky-top">
        <button type="submit" class="webdesk_shadow-sm webdesk_mt-4 webdesk_btn webdesk_btn-primary webdesk_btn-block" name="sp"><i class="fa fa-save fa-fw"></i> Save</button> 
        <button type="button" class="webdesk_shadow-sm webdesk_mt-4 webdesk_btn webdesk_btn-secondary webdesk_btn-block" data-toggle="webdesk_modal" data-target="#removeFileModal"><i class="fa fa-trash fa-fw"></i> Remove file</button> 
      </div>
    </div>
  </div>
    
</form>

<?php
include("appFooter.php");
?>
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
