<div class="modal fade" id="newPageModal" tabindex="-1" role="dialog" aria-labelledby="newPageModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content shadow">
      <div class="modal-header">
        <h5 class="modal-title" id="newPageModalLabel">Create a new page</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="<?php wd_url($wd_type, $wd_app, 'start.php', ''); ?>">
	      <div class="modal-body">
	        
			    <label for="nameP">New page name: </label>
			    <input type="text" name="nameP" for="nameP" class="form-control" placeholder="new_page.php" title="">
			    <!--<input type="submit" class="btn btn-success" value="Start">-->
				  
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
	        <button type="submit" class="btn btn-primary">Create page</button>
	      </div>
	    </form>
    </div>
  </div>
</div>
<div class="modal fade" id="newMediaUploadModal" tabindex="-1" role="dialog" aria-labelledby="newMediaUploadModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content shadow">
      <div class="modal-header">
        <h5 class="modal-title" id="newMediaUploadModalLabel">Upload media</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php wd_urlSub($wd_type, $wd_app, 'upload.php', ''); ?>" method="post" enctype="multipart/form-data">
	      <div class="modal-body">
	        <div class="custom-file">
				    
				    <input type="file" class="custom-file-input" name="fileToUpload" id="fileToUpload" />
				    <label class="custom-file-label" for="fileToUpload">Select file</label>
			    </div>
				  
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
	        <button type="submit" class="btn btn-primary">Upload</button>
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