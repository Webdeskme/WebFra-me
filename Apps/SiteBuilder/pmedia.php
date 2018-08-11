<?php
if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
include_once("config.inc.php");
include("appHeader.php");
?>

<div id="new" class="webdesk_collapse">
  <form action="<?php wd_urlSub($wd_type, $wd_app, 'upload.php', ''); ?>" method="post" enctype="multipart/form-data">
    Select file to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" class="webdesk_btn webdesk_btn-success" value="Upload" name="submit">
  </form>
</div>
<br>
<div class="webdesk_container">
  <div class="webdesk_dropdown">
    <button class="webdesk_btn webdesk_btn-link webdesk_dropdown-toggle" type="button" id="fileSelectMenuButton" data-toggle="webdesk_dropdown" aria-haspopup="true" aria-expanded="false">
      Media
    </button>
    <div class="webdesk_dropdown-menu" aria-labelledby="fileSelectMenuButton">
      
      <button class="webdesk_dropdown-item" data-toggle="webdesk_modal" data-target="#newMediaUploadModal"><span class="fa fa-upload fa-fw"></span> Upload</button>
      
    </div>
  </div>

  <!--<p>Copy and paste this url for the media directly into your html element.</p>-->
  
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
        <td class="webdesk_text-right">
          <?php wd_confirm($wd_type, $wd_app, 'mediaDelete.php', '&media=' . $entry, $x, '<i class="fa fa-trash-alt fa-fw"></i>'); ?>
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