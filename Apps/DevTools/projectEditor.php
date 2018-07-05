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
	if(is_array($app_info)){
		$app_title = $app_info["name"];
	}
}
?>
<div class="dt">
	<div class="webdesk_row webdesk_no-gutters" style="height: 70vh;">
		<div class="webdesk_col-md-3 webdesk_border-right webdesk_p-3">
			
			<h4><?php echo $app_title ?></h4>
			
			<ul class="project-files webdesk_list-unstyled">
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
	load_project_files: function(openDir){
		
		$(".dt .project-files .loader").show();
		
		if(openDir == null)
			openDir = "MyApps/<?php echo test_input($_GET["editApp"]); ?>";
		
		$.get("<?php echo $wd_type ?>/<?php echo $wd_app ?>/devTools.ajax.json.php", {f:"loadProjectFiles",dir: openDir}, function(data,textStatus){
			
			if(data.data.resultset == null)
				$(".dt .project-files").text("Error loading files");
			else{
				
				$(".dt .project-files .loader").hide();
				
				for(var x in data.data.resultset.files){
					
					var tfile = data.data.resultset.files[x];
						
					
					if(tfile.type == "file")
						$('<li class="file webdesk_px-2"><a href="#"><i class="fa fa-' + tfile.icon + ' fa-fw"></i> <span class="file-name">' + tfile.name + '</span></a></li>').appendTo(".dt .project-files");
					
				}
				
			}
			
			$(".dt .project-files .file a").click(function(){
				
				devTools.openEditor(data.data.directory + "/" + $(".file-name", this).text());
				
			});
			
		});
		
	},//load_project_files
	openEditor: function(projectFile){
		
		if(devTools.currTab > -1){
			/// CURRENT TAB NEEDS TO BE DUMPED TO USERFILE
			
			var saveContents = dt_codeMirror.doc.getValue();
			
			devTools.tabs[devTools.currTab].contents = saveContents;
			
			/// WE'RE HAVING PROBLEMS WITH THIS RIGHT NOW FOR SOME REASON
			// $.post("<?php echo $wd_type ?>/<?php echo $wd_app ?>/devTools.ajax.json.php", {f:"moveTabToSession",file: devTools.tabs[devTools.currTab].path,contents: saveContents}, function(data,textStatus){
				
				
			// 	if(data.result != "success")
			// 		console.error(data.msg);
			// 	else{
			// 		console.info("Success!");
			// 	}
				
			// });
				
		}
		
		/// CHECK FOR TAB OPEN ALREADY
		var exists = false;
		
		for(var x in devTools.tabs){
			if(projectFile == devTools.tabs[x].path){
				
				console.log("Opening " + projectFile + " from session in tab " + x);
				
				exists = true;
				devTools.currTab = x;
				dt_codeMirror.doc.setValue(devTools.tabs[x].contents);
				
				$(".webdesk_nav-link").removeClass("webdesk_active");
				$(".open-tabs .webdesk_nav-item[data-file='" + devTools.tabs[x].path + "'] .webdesk_nav-link").addClass("webdesk_active");
				
			}
		}
		if(!exists){
			
			console.log("Opening " + projectFile + " from server");
			$.get("<?php echo $wd_type ?>/<?php echo $wd_app ?>/devTools.ajax.json.php", {f:"loadFile",file: projectFile}, function(data,textStatus){
				
				var nIndex = devTools.tabs.length;
				
				$(".webdesk_nav-link").removeClass("webdesk_active");
				$('<li class="webdesk_nav-item" data-file="' + projectFile + '"><button class="webdesk_close" onclick="devTools.closeFile(this);">&times;</button><a href="#" class="webdesk_nav-link webdesk_active">' + projectFile.split("/")[projectFile.split("/").length-1] + ' <i class="fa fa-dot-circle fa-fw edited-icon fa-sm"></i></a></li>').click(function(){
					devTools.openEditor($(this).attr("data-file"));
				}).appendTo(".open-tabs");
				
				$(".codemirror-wrapper").show();
				devTools.tabs[nIndex] = data.data.file;
				devTools.currTab = nIndex;
				dt_codeMirror.doc.setValue(decodeHtml(data.data.file.contents));
					
			});
			
		}
		
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
			
			$(".open-tabs .webdesk_nav-item.edited[data-file='" + devTools.tabs[devTools.currTab].path + "'] .edited-icon").addClass("fa-dot-circle").removeClass("fa-circle-notch fa-spin");
				
			console.log(data);
			
			console.groupEnd();
			
		});
		
	},
	closeFile: function(tab){
		
		console.log("Closing file " + $(tab).parent().attr("data-file"));
		
		$(tab).parent().remove();
		for(var x in devTools.tabs){
			if($(tab).parent().attr("data-file") == devTools.tabs[x].path){
				devTools.tabs.splice(x,1);
				if(devTools.currTab == x){
					if(devTools.tabs[x+1] != null)
						devTools.currTab = x + 1;
					else
						devTools.currTab = x - 1;
						
					if(devTools.currTab > -1){
						devTools.openEditor(devTools.tabs[devTools.currTab].path);
					}
					else
						devTools.closeEditor();
				}
			}
		}
		
	},
	closeEditor: function(){
		
		dt_codeMirror.doc.setValue("");
		$(".codemirror-wrapper").hide();
		
	},
	setFileAsEdited: function(filePath){
		
		$(".open-tabs .webdesk_nav-item[data-file='" + filePath + "']").addClass("edited");
		
	}
	
};
var dt_codeMirror;
$(document).ready(function(){
	
	devTools.load_project_files();
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
	
	dt_codeMirror.on('change',function(e,t){
		if(t.origin != "setValue")
			devTools.setFileAsEdited(devTools.tabs[devTools.currTab].path);
	})
	
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