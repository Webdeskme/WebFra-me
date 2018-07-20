<?php
/*
////////////////////////////////////////////////////////////
//
// PROJECT EDITOR
// AUTHOR: ANDREW MCCALLISTER
//
// DESCRIPTION: THE INDIVIDUAL PAGE FOR EACH PROJECT,
// ALLOWING USERS TO NAVIGATE THE FILE DIRECTORY AND
// EDIT FILES IN THE CODE EDITOR.
//
////////////////////////////////////////////////////////////
*/
if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
include_once("config.inc.php");
include("pageHeader.php");

$app_title = test_input($_GET["editApp"]);
if(file_exists("MyApps/" . test_input($_GET["editApp"]) . "/app.json")){
	$app_info = json_decode(file_get_contents("MyApps/" . test_input($_GET["editApp"]) . "/app.json"),true);
	if(is_array($app_info) && isset($app_info["name"])){
		$app_title = $app_info["name"];
	}
}
?>
<div class="dt">
	<div class="webdesk_row webdesk_no-gutters" style="height: 70vh;">
		<div class="webdesk_col-md-3 webdesk_border-right webdesk_p-3">
			
			<h4><?php echo $app_title ?></h4>
			
			<ul class="project-files files-directory webdesk_list-unstyled" data-file="<?php echo test_input($_GET["editType"])."/".test_input($_GET["editApp"]) ?>">
				<i class="fa fa-spinner fa-pulse fa-2x loader"></i>
			</ul>
		</div>
		<div class="webdesk_col-md-9"  style="height: 100%">
			<div class="webdesk_nav webdesk_nav-tabs open-tabs">
				
			</div>
			<div class="codemirror-wrapper">
				<textarea name="code" id="code_editor"></textarea>
			</div>
		</div>
	</div>
</div>
<script>

var devTools = {
	
	currTab: -1,
	tabs: [],
	fileClipBoard: null,
	ajaxEndpoint: "<?php echo wd_urlSub($wd_type, $wd_app, 'devTools.ajax.json.php', ''); ?>",
	load_project_files: function(openDir){
		
		$(".dt .files-directory[data-file='" + openDir + "']>.loader").show();
		$(".dt .files-directory[data-file='" + openDir + "'] .file").addClass("to-delete");
		
		if(openDir == null)
			openDir = "MyApps/<?php echo test_input($_GET["editApp"]); ?>";
		
		$.get("<?php echo $wd_type ?>/<?php echo $wd_app ?>/devTools.ajax.json.php", {f:"loadProjectFiles",dir: openDir}, function(data,textStatus){
			
			if(data.result != "success")
				console.error(data.msg);
			else{
			
				if(data.data.resultset == null)
					$(".dt .project-files").text("Error loading files");
				else{
					
					$(".dt .project-files .loader").hide();
					
					for(var x in data.data.resultset.files){
						
						var tfile = data.data.resultset.files[x];
						
						if(tfile.type == "file"){
							/// FILES
							if($(".project-files .file[data-file='" + tfile.path + '/' + tfile.name + "']").length == 0){
								
								$('<li class="file webdesk_px-2" data-file="' + tfile.path + '/' + tfile.name + '"><a href="#"><i class="open-icon fa fa-circle fa-fw" data-fa-transform="shrink-7"></i><i class="fa fa-' + tfile.icon + ' fa-fw"></i> <span class="file-name">' + tfile.name + '</span></a></li>').appendTo(".files-directory[data-file='" + data.data.directory + "']");
								$(".project-files .file[data-file='" + tfile.path + '/' + tfile.name + "'] a").click(function(){
						
									devTools.openEditor(data.data.directory + "/" + $(".file-name", this).text());
									
								});
								if($(".open-tabs [data-file='" + tfile.path + '/' + tfile.name + "']").length > 0)
									$(".project-files .file[data-file='" + tfile.path + '/' + tfile.name + "']").addClass("open");
							}
							else{
								$(".project-files .file[data-file='" + tfile.path + '/' + tfile.name + "']").removeClass("to-delete");
							}
							
						}
						else if(tfile.type == "dir"){
							/// DIRECTORIES
							
							if($(".project-files .dir[data-file='" + tfile.path + '/' + tfile.name + "']").length == 0){
							
								$('<li class="dir webdesk_px-2" data-file="' + tfile.path + '/' + tfile.name + '"><i class="fa fa-spinner fa-pulse webdesk_float-right loader hide"></i><a href="#"><i class="open-icon fa fa-caret-right fa-fw" data-fa-transform=""></i><i class="fa fa-' + tfile.icon + ' fa-fw"></i> <span class="dir-name">' + tfile.name + '</span></a><ul class="files-directory webdesk_list-unstyled webdesk_ml-2" data-file="' + tfile.path + '/' + tfile.name + '"></ul></li>').appendTo(".files-directory[data-file='" + data.data.directory + "']");
								$(".project-files .dir[data-file='" + tfile.path + '/' + tfile.name + "'] a").click(function(){
						
									if($(this).parent(".open").length == 0){
									
										$(this).parent(".dir").addClass("open");
										devTools.load_project_files(data.data.directory + "/" + $(".dir-name",this).text());
										$(this).next(".files-directory").show();
										$(".open-icon",this).removeClass("fa-caret-right").addClass("fa-caret-down");
										
									}
									else{
										
										$(this).parent(".dir").removeClass("open");
										$(this).next(".files-directory").hide();
										$(".open-icon",this).addClass("fa-caret-right").removeClass("fa-caret-down");
										
									}
									
								});
								
							}
							else{
								$(".project-files .dir[data-file='" + tfile.path + '/' + tfile.name + "']").removeClass("to-delete");
							}
								
						}
						
					}
					
					$(".dt .project-files .file.to-delete").remove();
					
				}
			
			}
			
		});
		
	},//load_project_files
	openEditor: function(projectFile, moveCurrentViewToSession){
		
		console.group("Opening " + projectFile + " into editor");
		
		if(moveCurrentViewToSession == null)
			moveCurrentViewToSession = true;
		
		if( (devTools.currTab > -1) && moveCurrentViewToSession){
			/// CURRENT TAB NEEDS TO BE DUMPED TO SESSION
			
			devTools.tabs[devTools.currTab].contents = dt_codeMirror.doc.getValue();
			devTools.tabs[devTools.currTab].cursorPos = dt_codeMirror.doc.getCursor();
			devTools.tabs[devTools.currTab].selectionText = dt_codeMirror.doc.getSelection();
				
		}
		
		var nIndex = devTools.tabs.length;
		
		/// CHECK IF THIS FILE IS OPEN IN OUR TABS SESSION ALREADY
		var exists = false;
		for(var x in devTools.tabs){
			if( (projectFile == devTools.tabs[x].path) && (devTools.tabs[x].contents != null) ){
				
				console.info("File will be pulled from tab " + x);;
				
				exists = true;
				devTools.currTab = x;
				
				dt_codeMirror.doc.setValue(devTools.tabs[x].contents);
				if(devTools.tabs[x].currPos != null)
					dt_codeMirror.doc.setCursor(devTools.tabs[x].cursorPos);
					
				$(".webdesk_nav-link").removeClass("webdesk_active");
				$(".open-tabs .webdesk_nav-item[data-file='" + devTools.tabs[x].path + "'] .webdesk_nav-link").addClass("webdesk_active");
				
			}
			else if(projectFile == devTools.tabs[x].path){
				console.info("File found in tab session, but contents will need to be pulled from server");
				nIndex = x;
			}
			
		}
		/// TAB DOESN'T EXIST, OPEN IT FROM THE SERVER
		if(!exists){
			
			console.info("File will be pulled from server and loaded into tab " + nIndex);
			
			$.get("<?php echo $wd_type ?>/<?php echo $wd_app ?>/devTools.ajax.json.php", {f:"loadFile",file: projectFile}, function(data,textStatus){
				
				if(data.result != "success")
					console.error(data.msg);
				else{
					
					
					
					$(".webdesk_nav-link").removeClass("webdesk_active");
					if($(".open-tabs .webdesk_nav-item[data-file='" + projectFile + "']").length == 0){
						
						console.info("New tab is being created");
						
						$('<li class="webdesk_nav-item" data-file="' + projectFile + '"><button class="webdesk_close" onclick="devTools.closeFile(this);">&times;</button><a href="#" class="webdesk_nav-link webdesk_active">' + projectFile.split("/")[projectFile.split("/").length-1] + ' <i class="fa fa-dot-circle fa-fw edited-icon fa-sm"></i></a></li>').click(function(){
							devTools.openEditor($(this).attr("data-file"));
						}).appendTo(".open-tabs");
						$(".codemirror-wrapper").show();	
						data.data.file.contents = decodeHtml(data.data.file.contents);
						devTools.tabs[nIndex] = data.data.file;
						devTools.currTab = nIndex;
						dt_codeMirror.doc.setValue(data.data.file.contents);
						
					}
					else{
						$(".open-tabs .webdesk_nav-item[data-file='" + projectFile + "'] a").addClass("webdesk_active");
					}
					
					
					
					$(".file[data-file='" + projectFile + "']").addClass("open");
					
					if(moveCurrentViewToSession){
						devTools.saveTabsToSession();
					}
					
				}
					
			});
			
		}
		
		console.groupEnd();
		
	},
	saveFile: function(){
		
		console.group("Saving file " + devTools.tabs[devTools.currTab].path);
		
		var saveContents = dt_codeMirror.doc.getValue();
		
		$(".open-tabs .webdesk_nav-item.edited").addClass("edited");
		$(".open-tabs .webdesk_nav-item.edited[data-file='" + devTools.tabs[devTools.currTab].path + "'] .edited-icon").removeClass("fa-dot-circle").addClass("fa-circle-notch fa-spin");
		
		$.post("<?php echo $wd_type ?>/<?php echo $wd_app ?>/devTools.ajax.json.php", {f:"saveFile",file: devTools.tabs[devTools.currTab].path,contents: saveContents}, function(data,textStatus){
			
			if(data.result != "success")
				console.error(data.msg);
			else{
				console.info("Success!");
				$(".open-tabs .webdesk_nav-item.edited").removeClass("edited");
			}
			
			$(".open-tabs .webdesk_nav-item[data-file='" + devTools.tabs[devTools.currTab].path + "'] .edited-icon").addClass("fa-dot-circle").removeClass("fa-circle-notch fa-spin");
				
			//console.log(data);
			
			console.groupEnd();
			
		});
		
	},
	closeFile: function(tab){
		
		console.log("Closing file " + $(tab).parent().attr("data-file"));
		
		$(tab).parent().remove();
		for(var x in devTools.tabs){
			if($(tab).parent().attr("data-file") == devTools.tabs[x].path){
				
				$(".file[data-file='" + devTools.tabs[x].path + "']").removeClass("open");
				devTools.tabs.splice(x,1);
				
				if(devTools.currTab == x){
					if(devTools.tabs[x+1] != null)
						devTools.currTab = x + 1;
					else
						devTools.currTab = x - 1;
						
					if(devTools.currTab > -1){
						devTools.openEditor(devTools.tabs[devTools.currTab].path,false);
					}
					else
						devTools.closeEditor();
				}
				else if(devTools.currTab > x)
					devTools.currTab --;
			}
		}
		
		devTools.saveTabsToSession();
		
	},
	closeEditor: function(){
		
		if(dt_codeMirror != null)
			dt_codeMirror.doc.setValue("");
		
		$(".codemirror-wrapper").hide();
		
	},
	setFileAsEdited: function(filePath){
		
		$(".open-tabs .webdesk_nav-item[data-file='" + filePath + "']").addClass("edited");
		
	},
	newFile: function(form){
		
		var fileName = $(":input[name='file_name']",form).val();
		var filePath = $(":input[name='path']",form).val();
		var fileType = $(":input[name='type']",form).val();
		
		console.log("Creating a new file " + fileName);
		$.get("<?php echo $wd_type ?>/<?php echo $wd_app ?>/devTools.ajax.json.php", {f:"newFile", file: fileName, path: "<?php echo test_input($_GET["editType"]) . "/" . test_input($_GET["editApp"]) ?>/" + filePath, type: fileType}, function(data,textStatus){
			
			if(data.result != "success")
				console.error(data.msg);
			else{
				
				$("#newFileModal,#newFolderModal").modal('hide');
				
				if(data.data.type != "folder")
					devTools.openEditor(data.data.file);
				
				devTools.load_project_files();
				
				devTools.saveTabsToSession();
				
			}
			
		});
	
	},
	deleteFileConfirm: function(filePath){
		
		console.log("Showing confirm delete for " + filePath);
		$("#deleteConfirmModal .file").text(filePath);
		$("#deleteConfirmModal :input[name='file']").val(filePath);
		$("#deleteConfirmModal").modal('show');
		
	},
	deleteFile: function(form){
		
		var deleteFile = $(":input[name='file']",form).val();
		
		$.get("<?php echo $wd_type ?>/<?php echo $wd_app ?>/devTools.ajax.json.php", {f:"deleteFile", file: deleteFile}, function(data,textStatus){
			
			if(data.result != "success")
				console.error(data.msg);
			else{
				
				$("#deleteConfirmModal").modal('hide');
				$(".open-tabs [data-file='" + data.data.file_deleted + "']").remove();
				$(".project-files [data-file='" + data.data.file_deleted + "']").addClass("to-delete").hide();
				
				//devTools.load_project_files();
				
				devTools.saveTabsToSession();
				
			}
			
		});
		
	},
	saveTabsToSession: function(){
		
		console.log("Saving tab session to server");
		var temp = JSON.stringify(devTools.tabs);
		var savetabs = JSON.parse(temp);
		
		for(var x in savetabs){
			savetabs[x].contents = null;
			if(devTools.currTab == x)
				savetabs[x].isCurrTab = true;
			else
				savetabs[x].isCurrTab = false;
		}
		
		$.post("<?php echo $wd_type ?>/<?php echo $wd_app ?>/devTools.ajax.json.php", {f:"saveTabsToSession", tabs: JSON.stringify(savetabs), savePath: "<?php echo $wd_appFile ?>"}, function(data,textStatus){
			
			if(data.result != "success")
				console.error(data.msg);
	
		});
		
	},
	getTabsFromSession: function(){
		
		console.log("Retrieving tab session from server");
		$.get("<?php echo $wd_type ?>/<?php echo $wd_app ?>/devTools.ajax.json.php", {f:"getTabsFromSession", savePath: "<?php echo $wd_appFile ?>"}, function(data,textStatus){
			
			if(data.result == "success"){
				
				if(data.data.opentabs != null){
					
					var currTab = 0;
					
					var loadtabs = JSON.parse(data.data.opentabs);
					
					for(var x in loadtabs){
						
						//devTools.openEditor(loadtabs[x].path,false);
						
						if(loadtabs[x].isCurrTab){
							currTab = x;
						}
						
					}
					
					if( (loadtabs.length > 0) && (loadtabs[currTab].path != null) ){
						//devTools.openEditor(loadtabs[currTab].path,true);
					}
						
				}
				
			}
	
		});
		
	},
	copyFile: function(fileToCopy, copyToPath){
		
		console.log("Copying file to location");
		$.get("<?php echo $wd_type ?>/<?php echo $wd_app ?>/devTools.ajax.json.php", {f:"copyFile", file: fileToCopy, path: copyToPath}, function(data,textStatus){
			
			if(data.result != "success")
				console.error(data.msg);
			else{
				
				devTools.load_project_files(data.data.path);
				
			}
	
		});
		
	}
	
};
var dt_codeMirror;
$( document ).ajaxError(function( event, request, settings ) {
  console.error(request.responseText);
});
$(document).ready(function(){
	
	devTools.load_project_files();
	devTools.getTabsFromSession();
	$("#dt_editor-saveButton").click(function(){
		devTools.saveFile();
	});
	
	dt_codeMirror = CodeMirror.fromTextArea(code_editor,{
		lineNumbers: true,
		mode: 'php',
		matchBrackets: true,
		matchTags: {
			bothTags: true
		},
		lineWrapping: true,
		foldGutter: true,
		gutters: ["CodeMirror-linenumbers", "CodeMirror-foldgutter", "CodeMirror-lint-markers"],
		lint: true,
		extraKeys: {
			"Ctrl-Space": "autocomplete",
			"F11": function(cm) {
        cm.setOption("fullScreen", !cm.getOption("fullScreen"));
      },
      "Esc": function(cm) {
        if (cm.getOption("fullScreen")) cm.setOption("fullScreen", false);
      },
			"Ctrl-J": "toMatchingTag",
			"Ctrl-S": "devTools.saveFile"
		}
	});
	
	$(".codemirror-wrapper").hide();
	
	dt_codeMirror.on('change',function(e,t){
		if(t.origin != "setValue"){
			devTools.setFileAsEdited(devTools.tabs[devTools.currTab].path);
			devTools.tabs[devTools.currTab].cursorPos = dt_codeMirror.doc.getCursor();
			devTools.tabs[devTools.currTab].selectionText = dt_codeMirror.doc.getSelection();
		}
	})
	
	$.contextMenu({
	  // define which elements trigger this menu
	  selector: ".project-files .file",
	  // define the elements of the menu
	  items: {
	  	open: {name: "Open", callback: function(key, opt){ devTools.openEditor($(this).attr("data-file")); }},
	  	copy: {name: "Copy", callback: function(key, opt){ devTools.fileClipBoard = $(this).attr("data-file"); console.info("Copied file " + $(this).attr("data-file")); }},
	  	duplicate: {name: "Duplicate", callback: function(key, opt){ devTools.copyFile($(this).attr("data-file"),$(this).parent("ul").attr("data-file")) }},
	  	separator1: { "type": "cm_separator" },
      rename: {name: "Rename", callback: function(key, opt){ alert("Doesn't work yet"); }},
      delete: {name: "Delete", callback: function(key, opt){ devTools.deleteFileConfirm($(this).attr("data-file")); }}
	  }
	  // there's more, have a look at the demos and docs...
	});
	$.contextMenu({
	  // define which elements trigger this menu
	  selector: ".project-files .dir",
	  // define the elements of the menu
	  items: {
	  	open: {name: "Open", callback: function(key, opt){ devTools.openEditor($(this).attr("data-file")); }},
	  	copy: {name: "Copy", callback: function(key, opt){ devTools.fileClipBoard = $(this).attr("data-file"); console.info("Copied file " + $(this).attr("data-file")); }},
	  	paste: {name: "Paste", callback: function(key, opt){ devTools.copyFile(devTools.fileClipBoard,$(this).attr("data-file")) }},
	  	duplicate: {name: "Duplicate", callback: function(key, opt){ devTools.copyFile($(this).attr("data-file"),$(this).parent("ul").attr("data-file")) }},
	  	separator1: { "type": "cm_separator" },
      rename: {name: "Rename", callback: function(key, opt){ alert("Doesn't work yet"); }},
      delete: {name: "Delete", callback: function(key, opt){ devTools.deleteFileConfirm($(this).attr("data-file"));}},
      separator2: { "type": "cm_separator" },
      newFile: {name: "New File", callback: function(key, opt){ $("#newFileModal").modal('show'); $("#newFileModal form :input[name='path']").val($(this).attr("data-file").replace("<?php echo test_input($_GET["editType"])."/".test_input($_GET["editApp"])."/" ?>","")); }},
      newFolder: {name: "New Folder", callback: function(key, opt){ $("#newFolderModal").modal('show'); $("#newFolderModal form :input[name='path']").val($(this).attr("data-file").replace("<?php echo test_input($_GET["editType"])."/".test_input($_GET["editApp"])."/" ?>","")); }}
	  }
	  // there's more, have a look at the demos and docs...
	});
	
});
function decodeHtml(str)
{
    var map =
    {
        '&amp;': '&',
        '&lt;': '<',
        '&gt;': '>',
        '&quot;': '"',
        '&#039;': "'"
    };
    return str.replace(/&amp;|&lt;|&gt;|&quot;|&#039;/g, function(m) {return map[m];});
}
</script>