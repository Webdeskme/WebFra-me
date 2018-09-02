<div class="webdesk_modal webdesk_fade" id="newFileModal" tabindex="-1" role="dialog" aria-labelledby="newFileModalLabel" aria-hidden="true">
  <div class="webdesk_modal-dialog" role="document">
    <div class="webdesk_modal-content webdesk_shadow">
      <div class="webdesk_modal-header">
        <h5 class="mwebdesk_odal-title" id="newFileModalLabel">Create a new file</h5>
        <button type="button" class="webdesk_close" data-dismiss="webdesk_modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="<?php wd_urlSub($wd_type, $wd_app, 'NewFileSub.php', ''); ?>">
      	<input type="hidden" name="nameA" value="<?php echo (!empty($req["editApp"])) ? $req["editApp"] : ""; ?>">
      	<input type="hidden" name="type" value="<?php echo (!empty($req["editType"])) ? $req["editType"] : ""; ?>">
	      <div class="webdesk_modal-body">
	        
			    <label for="nameP">New file name: </label>
			    <input type="text" name="nameP" for="nameP" class="webdesk_form-control" placeholder="new_page.php" title="">
			    <!--<input type="submit" class="btn btn-success" value="Start">-->
				  
	      </div>
	      <div class="webdesk_modal-footer">
	        <button type="button" class="webdesk_btn webdesk_btn-secondary" data-dismiss="webdesk_modal">Cancel</button>
	        <button type="submit" class="webdesk_btn webdesk_btn-primary">Create file</button>
	      </div>
	    </form>
    </div>
  </div>
</div>
<div class="webdesk_modal webdesk_fade" id="newFolderModal" tabindex="-1" role="dialog" aria-labelledby="newFolderModalLabel" aria-hidden="true">
  <div class="webdesk_modal-dialog" role="document">
    <div class="webdesk_modal-content webdesk_shadow">
      <div class="webdesk_modal-header">
        <h5 class="mwebdesk_odal-title" id="newFolderModalLabel">Create a new folder</h5>
        <button type="button" class="webdesk_close" data-dismiss="webdesk_modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="<?php wd_urlSub($wd_type, $wd_app, 'NewFolderSub.php', ''); ?>">
      	<input type="hidden" name="nameA" value="<?php echo (!empty($req["editApp"])) ? $req["editApp"] : ""; ?>">
      	<input type="hidden" name="type" value="<?php echo (!empty($req["editType"])) ? $req["editType"] : ""; ?>">
	      <div class="webdesk_modal-body">
	        
			    <label for="nameP">New folder name: </label>
			    <input type="text" name="nameP" for="nameP" class="webdesk_form-control" placeholder="" title="">
			    <!--<input type="submit" class="btn btn-success" value="Start">-->
				  
	      </div>
	      <div class="webdesk_modal-footer">
	        <button type="button" class="webdesk_btn webdesk_btn-secondary" data-dismiss="webdesk_modal">Cancel</button>
	        <button type="submit" class="webdesk_btn webdesk_btn-primary">Create folder</button>
	      </div>
	    </form>
    </div>
  </div>
</div>
<div class="webdesk_modal webdesk_fade" id="removeFileModal" tabindex="-1" role="dialog" aria-labelledby="removeFileModalLabel" aria-hidden="true">
  <div class="webdesk_modal-dialog" role="document">
    <div class="webdesk_modal-content webdesk_shadow">
      <div class="webdesk_modal-header">
        <h5 class="mwebdesk_odal-title" id="removeFileModalLabel">Remove file</h5>
        <button type="button" class="webdesk_close" data-dismiss="webdesk_modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="<?php wd_urlSub($wd_type, $wd_app, 'deleteFileSub.php', ''); ?>">
      	<input type="hidden" name="MyApp" value="<?php echo (!empty($req["editApp"])) ? $req["editApp"] : ""; ?>">
      	<input type="hidden" name="type" value="<?php echo (!empty($req["editType"])) ? $req["editType"] : ""; ?>">
      	<input type="hidden" name="MyPage" value="<?php echo (!empty($req["file"])) ? $req["file"] : ""; ?>">
	      <div class="webdesk_modal-body">
	        
			    <p class="lead">Are you sure you wish to delete this file? This action <b>CANNOT</b> be undone.</p>
				  
	      </div>
	      <div class="webdesk_modal-footer">
	        <button type="button" class="webdesk_btn webdesk_btn-secondary" data-dismiss="webdesk_modal">Cancel</button>
	        <button type="submit" class="webdesk_btn webdesk_btn-danger">Confirm delete</button>
	      </div>
	    </form>
    </div>
  </div>
</div>
<div class="webdesk_modal webdesk_fade" id="newMediaUploadModal" tabindex="-1" role="dialog" aria-labelledby="newMediaUploadModalLabel" aria-hidden="true">
  <div class="webdesk_modal-dialog" role="document">
    <div class="webdesk_modal-content webdesk_shadow">
      <div class="webdesk_modal-header">
        <h5 class="mwebdesk_odal-title" id="newMediaUploadModalLabel">Upload icon</h5>
        <button type="button" class="webdesk_close" data-dismiss="webdesk_modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php wd_urlSub($wd_type, $wd_app, 'upload.php', ''); ?>" method="post" enctype="multipart/form-data">
      	<input type="hidden" name="type" value="<?php echo $req["editType"]; ?>">
      	<input type="hidden" name="app" value="<?php echo $req["editApp"]; ?>">
	      <div class="webdesk_modal-body">
	        <div class="webdesk_custom-file">
				    
				    <input type="file" class="webdesk_custom-file-input" name="fileToUpload" id="fileToUpload" />
				    <label class="webdesk_custom-file-label" for="fileToUpload">Select file</label>
			    </div>
				  <small class="webdesk_form-text webdesk_text-muted">Select a PNG to upload as your icon</small>
	      </div>
	      <div class="webdesk_modal-footer">
	        <button type="button" class="webdesk_btn webdesk_btn-secondary" data-dismiss="webdesk_modal">Cancel</button>
	        <button type="submit" class="webdesk_btn webdesk_btn-primary">Upload</button>
	      </div>
	    </form>
    </div>
  </div>
</div>
<script>
	if($(":input[name='con']").length > 0){
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
	}
</script>
<?php include("FunctionHelp.php"); ?>