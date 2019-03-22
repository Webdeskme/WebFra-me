<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
include_once("config.inc.php");
include("appHeader.php");

?>

<div class="container my-5">
  <div class="card">
    <div class="card-header "><b>Choose Plugins</b></div>
    <div class="card-body">
    <?php
      $dir = scandir("www/Plugins/");
      foreach($dir as $theme){
        if($theme != "." && $theme != ".."){
          ?>
          <span <?php if(file_exists("www/dtheme.txt")){
            $dtheme = test_input(file_get_contents("www/dtheme.txt"));
            if($theme == $dtheme){
              echo 'style="background-color: #99ff99;" data-toggle="popover" title="Active" data-content="This theme is currently set to active."';
            }
          } 
          ?>>
          <a class="btn btn-primary text-white" href="<?php wd_urlSub($wd_type, $wd_app, 'ppluginsSub.php', '&theme=' . $theme); ?>" data-toggle="tooltip" title="<?php if(file_exists("www/Themes/" . $theme . "/tell.txt")){
            echo test_input(file_get_contents("www/Themes/" . $theme . "/tell.txt"));
          }
         else{
           echo "Sorry! No description is available.";
         }
         ?>"><?php echo $theme; ?></a>
      </span>
      <?php
        }
      }
      ?>
    </div>
  </div>
</div>
<?php
include("appFooter.php");
?>