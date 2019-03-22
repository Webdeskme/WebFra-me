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
    <ol class="breadcrumb mb-0 rounded-0">
      <li class="breadcrumb-item"><a href="<?php echo wd_url($wd_type, $wd_app, 'start.php', ''); ?>"><?php echo $req['editType'] ?></a></li>
      <li class="breadcrumb-item"><a href="<?php echo wd_url($wd_type, $wd_app, 'projectfiles.php', '&editType=' . $req['editType'] . '&editApp=' . $req['editApp']); ?>"><?php echo $req['editApp'] ?></a></li>
      <?php
      if(!empty($req["dir"])){
        $cwd = array();
        $dir = explode("/", $req["dir"]);
        foreach($dir as $dirkey => $dirname){
          $cwd[] = $dirname;
          ?>
          <li class="breadcrumb-item"><a href="<?php echo wd_url($wd_type, $wd_app, 'projectfiles.php', '&editType=' . $req['editType'] . '&editApp=' . $req['editApp']) . '&dir=' . implode("/", $cwd); ?>"><?php echo $dirname ?></a></li>
          <?php
        }
      }
      ?>
      <li class="breadcrumb-item active" aria-current="page"><?php echo (!empty($req["file"])) ? $req["file"] : "" ?> &nbsp; <a href="#" data-toggle="modal" data-target="#renameFileModal" class=""><i class="fa fa-edit fa-fw text-dark"></i></a></li>
    </ol>
  </nav>
  
  <div class="row no-gutters" style="height: 100%">
    <div class="col-md-10" style="height: 100%">
      
      <?php
      $content_type = mime_content_type($open_file);
      
      if(preg_match("/image/i", $content_type)){
        ?>
        <div class="text-center pt-4">
          <img src="<?php echo $req["editType"] . "/" . $req["editApp"] . "/" . $req["file"] ?>" class="img-fluid border border-dark shadow-lg" /><br />
          <?php
          $imagesize = getimagesize($open_file);
          
          ?>
        </div>
        <div class="mt-4 text-center">
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
    <div class="col-md-2 bg-light d-none d-md-block">
      <div class="bg-light py-2 px-3 sticky-top">
        <div class="btn-groupp">
          <?php
          if(preg_match("/image/i", $content_type)){
          
          }
          else{
            ?>
            <button id="saveEditorButton" type="submit" class="shadow-sm mt-4 btn btn-primary btn-block" disabled name="sp"><i class="fa fa-save fa-fw"></i> Save</button> 
            <?php
          }
          ?>
          <button type="button" class="shadow-sm mt-4 btn btn-secondary btn-block" data-toggle="modal" data-target="#removeFileModal"><i class="fa fa-trash fa-fw"></i> Delete</button> 
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
