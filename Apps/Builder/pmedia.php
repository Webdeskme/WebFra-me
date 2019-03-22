<?php
if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
include_once("config.inc.php");
include("appHeader.php");
?>

<div id="new" class="collapse">
  <form action="<?php wd_urlSub($wd_type, $wd_app, 'upload.php', ''); ?>" method="post" enctype="multipart/form-data">
    Select file to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" class="btn btn-success" value="Upload" name="submit">
  </form>
</div>
<br>
<div class="container">
  <div class="dropdown">
    <button class="btn btn-link dropdown-toggle" type="button" id="fileSelectMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Media
    </button>
    <div class="dropdown-menu" aria-labelledby="fileSelectMenuButton">
      
      <button class="dropdown-item" data-toggle="modal" data-target="#newMediaUploadModal"><span class="fa fa-upload fa-fw"></span> Upload</button>
      
    </div>
  </div>

  <!--<p>Copy and paste this url for the media directly into your html element.</p>-->
  
  <table class="table table-hover" width="100%">
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
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
    <?php
    $dir = 'www/Media/';
    $contents = $wf_pagebuilder->get_directory_contents($dir);
    foreach ($contents as $entry){
      $file_size = $wf_pagebuilder->getFormattedFileSize($dir . $entry);
      ?>
      <tr>
        <td>
          <i class="fa fa-lg fa-<?php echo $wf_pagebuilder->getFileIcon($entry) ?> fa-fw"></i> 
          <a href="www/Media/<?php echo $entry; ?>">www/Media/<?php echo $entry; ?></a>
        </td>
        <td>
          <small><?php echo date("F j", filemtime($dir . $entry)) ?></small>
        </td>
        <td>
          <small><?php echo $file_size ?></small>
        </td>
        <td class="text-right">
          <?php wd_confirm($wd_type, $wd_app, 'mediaDelete.php', '&media=' . $entry, $x, '<i class="fa fa-trash-alt fa-fw"></i>'); ?>
        </td>
      </tr>
      <?php
      
    }
    if(count($contents) == 0){
      ?>
      <tr>
        <td colspan="100" class="text-center text-muted py-4">
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