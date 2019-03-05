<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
include_once("config.inc.php");
include("appHeader.php");

if(isset($_GET['page'])){
  $page = test_input($_GET['page']);
}
else{
  $page = "";
}
if(isset($_POST['con']) && isset($_POST['par']) && isset($_POST['pr']) && isset($_POST['title'])){
  //require "Plugins/php-html-css-js-minifier.php";
  //$theme = test_input(file_get_contents($wd_root . "/Admin/dtheme.txt"));
  //$cache_file = $wd_root . '/Cache/' . $page;
  //$url = 'http://' . $_SERVER['HTTP_HOST'] . '/cache.php?page=' . $page . '&wd_no-cache=' . $theme;

  $con = htmlspecialchars_decode($wd_POST["con"], ENT_QUOTES);
  $par = test_input($_POST['par']);
  $pr = test_input($_POST['pr']);
  $title = test_input($_POST['title']);
  file_put_contents($wd_www . $page, $con);
  //$string = file_get_contents($url);
  //$string = fn_minify_html($string);
  //file_put_contents($cache_file, $string);
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
  // if($_POST['sp'] == 'Save/Publish'){
  //   require "Plugins/php-html-css-js-minifier.php";
  //   function get_and_write($url, $cache_file) {
  //     $string = file_get_contents($url);
  //     $string = fn_minify_html($string);
  //     $f = fopen($cache_file, 'w');
  //     fwrite ($f, $string, strlen($string));
  //     fclose($f);
  //   }
  //   $theme = test_input(file_get_contents($wd_root . "/Admin/dtheme.txt"));
  //   $cache_file = $wd_root . '/Cache/' . $page;
  //   $url = 'http://' . $_SERVER['HTTP_HOST'] . '/cache.php?page=' . $page . '&wd_no-cache=' . $theme;
  //   get_and_write($url, $cache_file);
  // }
}

if(file_exists($wd_www . "nav.json"))
  $navigation = json_decode(file_get_contents($wd_www . "nav.json"));
  
$page_title = (isset($navigation->$page) && isset($navigation->$page->title)) ? $navigation->$page->title : "";
  
?>
<form method="post" action="<?php wd_url($wd_type, $wd_app, 'page.php', '&page=' . $page); ?>">
  <div class="webdesk_row webdesk_no-gutters">
    <div class="webdesk_col-md-9">
      <textarea name="con" id="con2" placeholder="Enter your content" title="Enter your content" style="width: 100%; height:100%; background-color: #000000; color: #ffffff; font-weight: bold; font-size: 1.25em;"><?php
  echo (isset($_GET['page']) && file_exists($wd_www . $page)) ? htmlspecialchars(file_get_contents($wd_www . $page)) : ""; ?></textarea>
  
      <script>
      tinymce.init({
          selector: '#con2',
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
  
    </div>
    <div class="webdesk_col-md-3 webdesk_bg-light">
      <div class="webdesk_bg-light webdesk_py-3 webdesk_px-4 webdesk_sticky-top">
        <div class="webdesk_form-group">
          <label for="pageTitle">Page Title</label>
          <input id="pageTitle" name="title" class="webdesk_rounded-0 webdesk_form-control" value="<?php echo $page_title ?>" placeholder="Page title" required>
        </div>
        <div class="webdesk_form-group">
          <label for="parent">Parent</label>
          <select id="parent" name="par" class="webdesk_custom-select">
            <option value="h" <?php echo (isset($navigation->$page) && isset($navigation->$page->par) && $navigation->$page->par == "h") ? "selected" : ""; ?>>Hide Page</option>
            <option value="np" <?php echo (isset($navigation->$page->par) && $navigation->$page->par == "np") ? "selected" : ""; ?>>No Parent</option>
            <?php
            if(file_exists($wd_www . "nav.json")){
              foreach($navigation as $opage){
                if($opage->page != $_GET["page"]){
                  ?>
                  <option value="<?php echo $opage->page; ?>" <?php echo (isset($navigation->$page) && ($navigation->$page->par == $opage->page)) ? "selected" : ""; ?>><?php echo $opage->title; ?></option>
                  <?php
                }
              }
            }
            ?>
          </select>
        </div>
        <div class="webdesk_form-group">
          <label for="priority">Priority</label>
          <select id="priority" name="pr" class="webdesk_custom-select">
            <?php
            $i = 9;
            while($i >= 1){
            ?>
            <option value="<?php echo $i; ?>"<?php if(file_exists($wd_www . "nav.json") && isset($navigation->$page->pr) && $navigation->$page->pr == $i){ echo " selected";} ?>><?php echo $i; ?></option>
            <?php
            $i = $i - 1;
            }
              ?>
          </select>
        </div>
        <button type="submit" class="webdesk_shadow-sm webdesk_mt-4 webdesk_btn webdesk_btn-primary webdesk_btn-block" name="sp"><i class="fa fa-save fa-fw"></i> Update</button> 
        <a href="<?php wd_www($_GET["page"],"&wd_dev=on") ?>" target="_blank" type="submit" class="webdesk_shadow-sm webdesk_btn webdesk_btn-secondary webdesk_btn-block" name="sp"><i class="fa fa-eye fa-fw"></i> Preview</a> 
        
        <br />
        <?php wd_confirm($wd_type, $wd_app, 'pageSubDelete.php', '&page=' . $page, '1101', '<i class="fa fa-trash-alt fa-fw"></i> Remove Page','danger webdesk_btn-block'); ?>
        <!--<input type="submit" class="btn btn-warning" name="sp" value="Save/Publish">-->
      </div>
    </div>
  </div>
</form>

<?php
/*
<form method="post" action="<?php wd_url($wd_type, $wd_app, 'page.php', '&page=' . $page); ?>" style="width: 90%; height: 70%;">
  <div class="webdesk_form-group">
    <div class="webdesk_input-group">
      <div class="webdesk_input-group-prepend">
        <span class="webdesk_input-group-text"><label class="webdesk_m-0" for="pageTitle">Page Title</label></span>
      </div>
      <input id="pageTitle" name="title" class="webdesk_form-control" value="<?php
      if(file_exists($wd_www . "nav.json")){
        $obj = file_get_contents($wd_www . "nav.json");
        $obj = json_decode($obj);
        if(isset($obj->$page->title)){
          echo $obj->$page->title;
        }
      }?>" placeholder="Page title" required>
    </div>
  </div>
  <label for="pageContent">Page Content: </label>
  <textarea name="con" id="pageContent2" placeholder="Enter your content" title="Enter your content" style="width: 100%; height:100%; background-color: #000000; color: #ffffff; font-weight: bold; font-size: 1.25em;"><?php
echo (isset($_GET['page']) && file_exists($wd_www . $page)) ? htmlspecialchars(file_get_contents($wd_www . $page)) : ""; ?></textarea>
  <div class="webdesk_form-group">
    <label for="parent">Parent</label>
    <select id="parent" name="par" class="webdesk_custom-select">
      <option value="h" <?php echo (isset($obj->$page->par) && $obj->$page->par == "h") ? "selected" : ""; ?>>Hide Page</option>
      <option value="np" <?php echo (isset($obj->$page->par) && $obj->$page->par == "np") ? "selected" : ""; ?>>No Parent</option>
      <?php
      if(file_exists($wd_www . "nav.json")){
        foreach($obj as $opage){
          ?>
          <option value="<?php echo $opage->page; ?>" <?php echo ($obj->$page->par == $opage->page) ? "selected" : ""; ?>><?php echo $opage->title; ?></option>
          <?php
        }
      }
      ?>
    </select>
  </div>
  <span class="form-group">
    <label for="priority">Priority</label>
    <select id="priority" name="pr">
      <?php
      $i = 9;
      while($i >= 1){
      ?>
      <option value="<?php echo $i; ?>"<?php if(file_exists($wd_www . "nav.json") && isset($obj->$page->pr) && $obj->$page->pr == $i){ echo " selected";} ?>><?php echo $i; ?></option>
      <?php
      $i = $i - 1;
      }
        ?>
    </select>
  </span>
    <br>
    <input type="submit" class="btn btn-success" name="sp" value="Save"> <input type="submit" class="btn btn-warning" name="sp" value="Save/Publish">
  <br />
</form>
<br>
<script>
var myCodeMirror = CodeMirror.fromTextArea(pageContent, {
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
  
<br>
<div>
  <?php
  if(file_exists('www/Themes/' . $theme . '/page_edit.php')){
    include 'www/Themes/' . $theme . '/page_edit.php';
  }
  if(file_exists("index.php?page=" . $page)){
    ?>
    <iframe src="index.php?page=<?php echo $page; ?>" width="90%;" height="600px;"></iframe>
    <?php
  }
  ?>
</div>
*/
?>
<?php
include("appFooter.php");
?>