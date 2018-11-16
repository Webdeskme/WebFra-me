<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
include_once("config.inc.php");
include("appHeader.php");

$open_file = $req["editType"] . "/" . $req["editApp"] . ((!empty($req["dir"])) ? "/" . $req["dir"] : "") . "/" . $req["file"];

?>
<form method="post" action="<?php wd_urlSub($wd_type, $wd_app, 'editFileSub.php', ''); ?>" style="height: 100%;">
  <input type="hidden" name="f" value="saveFileContents" />
  <input type="hidden" name="editType" value="<?php echo $req["editType"]; ?>">
  <input type="hidden" name="editApp" value="<?php echo $req["editApp"]; ?>">
  <input type="hidden" name="dir" value="<?php echo (!empty($req["dir"])) ? $req["dir"] : ""; ?>">
  <input type="hidden" name="file" value="<?php echo $req["file"]; ?>">
  
  <nav aria-label="breadcrumb">
    <ol class="webdesk_breadcrumb webdesk_mb-0 webdesk_rounded-0">
      <li class="webdesk_breadcrumb-item"><a href="<?php echo wd_url($wd_type, $wd_app, 'start.php', ''); ?>"><?php echo $req['editType'] ?></a></li>
      <li class="webdesk_breadcrumb-item"><a href="<?php echo wd_url($wd_type, $wd_app, 'projectfiles.php', '&editType=' . $req['editType'] . '&editApp=' . $req['editApp']); ?>"><?php echo $req['editApp'] ?></a></li>
      <?php
      if(!empty($req["dir"])){
        $cwd = array();
        $dir = explode("/", $req["dir"]);
        foreach($dir as $dirkey => $dirname){
          $cwd[] = $dirname;
          ?>
          <li class="webdesk_breadcrumb-item"><a href="<?php echo wd_url($wd_type, $wd_app, 'projectfiles.php', '&editType=' . $req['editType'] . '&editApp=' . $req['editApp']) . '&dir=' . implode("/", $cwd); ?>"><?php echo $dirname ?></a></li>
          <?php
        }
      }
      ?>
      <li class="webdesk_breadcrumb-item webdesk_active" aria-current="page"><?php echo (!empty($req["file"])) ? $req["file"] : "" ?> &nbsp; <a href="#" data-toggle="webdesk_modal" data-target="#renameFileModal" class=""><i class="fa fa-edit fa-fw webdesk_text-dark"></i></a></li>
    </ol>
  </nav>
  
  <div class="webdesk_row webdesk_no-gutters" style="height: 100%">
    <div class="webdesk_col-md-10" style="height: 100%">
      
      <?php
      $content_type = mime_content_type($open_file);
      
      if(preg_match("/image/i", $content_type)){
        ?>
        <div class="webdesk_text-center webdesk_pt-4">
          <img src="<?php echo $req["editType"] . "/" . $req["editApp"] . "/" . $req["file"] ?>" class="webdesk_img-fluid webdesk_border webdesk_border-dark webdesk_shadow-lg" /><br />
          <?php
          $imagesize = getimagesize($open_file);
          
          ?>
        </div>
        <div class="webdesk_mt-4 webdesk_text-center">
          <small>
            <?php echo $imagesize["mime"] ?><br />
            <?php echo $imagesize[0] ?> x <?php echo $imagesize[1] ?><br />
            <?php echo $imagesize["bits"] ?> Bit
          </small>
        </div>
        
        <?php
      }else{
        ?>
        
        <textarea name="content" id="con" placeholder="Enter your content." title="Enter your content." style="width: 100%; height:100%; background-color: #000000; color: #ffffff; font-weight: bold; font-size: 1.25em;"  autofocus><?php
          if(file_exists($open_file))
            echo htmlspecialchars(file_get_contents($open_file));
            ?></textarea>
        <?php
      }
      ?>
    </div>
    <div class="webdesk_col-md-2 webdesk_bg-light webdesk_d-none webdesk_d-md-block">
      <div class="webdesk_bg-light webdesk_py-2 webdesk_px-3 webdesk_sticky-top">
        <div class="webdesk_btn-groupp">
          <?php
          if(preg_match("/image/i", $content_type)){
          
          }
          else{
            ?>
            <button id="saveEditorButton" type="submit" class="webdesk_shadow-sm webdesk_mt-4 webdesk_btn webdesk_btn-primary webdesk_btn-block" disabled name="sp"><i class="fa fa-save fa-fw"></i> Save</button> 
            <?php
          }
          ?>
          <button type="button" class="webdesk_shadow-sm webdesk_mt-4 webdesk_btn webdesk_btn-secondary webdesk_btn-block" data-toggle="webdesk_modal" data-target="#removeFileModal"><i class="fa fa-trash fa-fw"></i> Delete</button> 
        </div>
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
myCodeMirror.on("change", function(cm, change) { 

  $("#saveEditorButton").removeAttr("disabled");
  
});

</script>
