<?php if(is_file("wd_protect.php")){ include_once "wd_protect.php"; } ?>
<!-- Modal -->
<div class="webdesk_modal webdesk_fade" id="functionsHelpModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="webdesk_modal-content">
      <div class="webdesk_modal-header">
        <button type="button" class="close" data-dismiss="webdesk_modal">&times;</button>
        <h4 class="webdesk_modal-title"><i class="fa fa-code"></i> WD Functions</h4>
      </div>
      <div class="webdesk_modal-body">
        <p>This is the list of all public WD Variables & Functions.</p>
        <h3>Variables</h3>
        <p>
          <b>$_GET['type']:</b> lets Webdesk know if you are opening the MyApps or the Apps directory.<br>
          <b>$_GET['app']:</b>lets Webdesk know what App to open.<br>
          <b>$_GET['sec']:</b>lets Webdesk know what page of the App to open.<br>
          <b>$_GET['wd_as']:</b> posts a success alert.<br>
          <b>$_GET['wd_ai']:</b> posts a info alert.<br>
          <b>$_GET['wd_as']:</b> posts a warning alert.<br>
          <b>$_GET['wd_as']:</b> posts a danger alert.<br>
          <b>$wd_type:</b> is a sanitized version of $_GET['type']<br>
          <b>$wd_app:</b> is a sanitized version of $_GET['app']<br>
          <b>$wd:</b> is a random variable used for various tasks by WebDesk.<br>
          <b>$back:</b> desktop background color.<br>
          <b>$color:</b> desktop page color.<br>
          <b>$pcolor:</b> desktop default page color.<br>
          <b>$wd_file:</b> Root directory to user files.<br>
          <b>$wd_appFile:</b> Root directory to app files (not app pages).<br>
          <b>$_SESSION["Login"]:</b> Used to tell if a user is logged in.<br>
        </p>
        <h3>Security Functions</h3>
        <p>
          <b>test_input():</b> Standard sanitation of input.<br>
        </p>
        <h3>ID's and Classes</h3>
        <p>
          <b>id="wd_confirm":</b> adds a basic confirm box when element is clicked.<br>
        </p>
      </div>
      <div class="webdesk_modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="webdesk_modal">Close</button>
      </div>
    </div>

  </div>
</div>
