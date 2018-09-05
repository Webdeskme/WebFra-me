<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
include_once("config.inc.php");
include("appHeader.php");

if(isset($_POST['nameP'])){
  $nameP = test_input($_POST['nameP']);
  file_put_contents("www/Pages/" . $nameP, "This is an empty page.");
  if(!file_exists("www/Pages/nav.json")){
  $obj = new stdClass;
  }
  else{
    $obj = file_get_contents("www/Pages/nav.json");
    $obj = json_decode($obj);
  }
  $pagen = array("par"=>"h", "pr"=>"9", "title"=>"New Page", "page"=>$nameP);
  $obj->$nameP = $pagen;
  $jobj = json_encode($obj);
  file_put_contents("www/Pages/nav.json", $jobj);
}
?>

<div id="NewP" class="webdesk_collapse">
  <form method="post" action="<?php wd_url($wd_type, $wd_app, 'start.php', ''); ?>">
    <label for="nameP">New Page Name: </label>
    <input type="text" name="nameP" for="nameP" class="form-control" placeholder="Enter the name of your new page." title="Enter the name of your new page.">
    <input type="submit" class="btn btn-success" value="Start">
    
  </form>
</div>
<br>

<div class="webdesk_container">
  
  <div class="webdesk_dropdown">
    <button class="webdesk_btn webdesk_btn-link webdesk_dropdown-toggle" type="button" id="fileSelectMenuButton" data-toggle="webdesk_dropdown" aria-haspopup="true" aria-expanded="false">
      Pages
    </button>
    <div class="webdesk_dropdown-menu" aria-labelledby="fileSelectMenuButton">
      
      <button class="webdesk_dropdown-item" data-toggle="webdesk_modal" data-target="#newPageModal"><i class="fa fa-plus fa-fw"></i> New Page</button>
      <button class="webdesk_dropdown-item" data-toggle="webdesk_modal" data-target="#newMediaUploadModal"><i class="fa fa-upload fa-fw"></i> Upload media</button>
      
    </div>
  </div>
  
  <table class="webdesk_table webdesk_table-hover" width="100%">
    <thead>
      <tr>
        <th>
          Name
        </th>
        <th>
          Last modified
        </th>
        <th>
          Size
        </th>
      </tr>
    </thead>
    <tbody>
    <?php
    $dir = 'www/Pages/';
    $contents = $wf_pagebuilder->get_directory_contents($dir);
    foreach ($contents as $entry){
      $file_size = $wf_pagebuilder->getFormattedFileSize($dir . $entry);
      ?>
      <tr>
        <td>
          <i class="fa fa-lg fa-file-code fa-fw"></i> 
          <a href="<?php wd_url($wd_type, $wd_app, 'page.php', '&page=' . $entry); ?>"><?php echo $entry; ?></a>
        </td>
        <td>
          <small><?php echo date("F j", filemtime($dir . $entry)) ?></small>
        </td>
        <td>
          <small><?php echo $file_size ?></small>
        </td>
      </tr>
      <?php
      
    }
    if(count($contents) == 0){
      ?>
      <tr>
        <td colspan="100" class="webdesk_text-center webdesk_text-muted webdesk_py-4">
          No files
        </td>
      </tr>
      <?php
    }
    ?>
    </tbody>
  </table>
      
</div>
<?php
include("appFooter.php");
?>