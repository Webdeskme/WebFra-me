
<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; } 
?>

<link rel="stylesheet" href="Plugins/codemirror/lib/codemirror.css">
<link rel="stylesheet" href="Plugins/codemirror/addon/hint/show-hint.css">
<link rel="stylesheet" href="Plugins/codemirror/addon/dialog/dialog.css">
<link rel="stylesheet" href="Plugins/codemirror/addon/lint/lint.css">
<link rel="stylesheet" href="Plugins/codemirror/addon/display/fullscreen.css">
<link rel="stylesheet" href="Plugins/codemirror/addon/fold/foldgutter.css">

<script src="Plugins/codemirror/lib/codemirror.js"></script>
<script src="Plugins/codemirror/mode/php/php.js"></script>
<script src="Plugins/codemirror/mode/xml/xml.js"></script>
<script src="Plugins/codemirror/mode/htmlmixed/htmlmixed.js"></script>
<script src="Plugins/codemirror/mode/javascript/javascript.js"></script>
<script src="Plugins/codemirror/mode/css/css.js"></script>
<script src="Plugins/codemirror/mode/clike/clike.js"></script>
<script src="Plugins/codemirror/addon/hint/show-hint.js" type="text/javascript"></script>
<script src="Plugins/codemirror/addon/hint/javascript-hint.js" type="text/javascript"></script>
<script src="Plugins/codemirror/addon/hint/xml-hint.js" type="text/javascript"></script>
<script src="Plugins/codemirror/addon/hint/html-hint.js" type="text/javascript"></script>
<script src="Plugins/codemirror/addon/hint/css-hint.js" type="text/javascript"></script>
<script src="Plugins/codemirror/addon/search/search.js" type="text/javascript"></script>
<script src="Plugins/codemirror/addon/search/searchcursor.js" type="text/javascript"></script>
<script src="Plugins/codemirror/addon/search/jump-to-line.js" type="text/javascript"></script>
<script src="Plugins/codemirror/addon/dialog/dialog.js" type="text/javascript"></script>
<script src="Plugins/codemirror/addon/edit/matchbrackets.js" type="text/javascript"></script>
<script src="Plugins/codemirror/addon/display/fullscreen.js" type="text/javascript"></script>
<script src="Plugins/codemirror/addon/fold/xml-fold.js" type="text/javascript"></script>
<script src="Plugins/codemirror/addon/edit/matchtags.js" type="text/javascript"></script>
<!--<script src="Plugins/codemirror/addon/lint/lint.js" type="text/javascript"></script>-->
<!--<script src="Plugins/codemirror/addon/lint/css-lint.js" type="text/javascript"></script>-->
<!--<script src="Plugins/codemirror/addon/lint/html-lint.js" type="text/javascript"></script>-->
<!--<script src="Plugins/codemirror/addon/lint/javascript-lint.js" type="text/javascript"></script>-->
<!--<script src="Plugins/codemirror/addon/lint/json-lint.js" type="text/javascript"></script>-->
<script src="Plugins/codemirror/addon/fold/brace-fold.js" type="text/javascript"></script>
<script src="Plugins/codemirror/addon/fold/foldcode.js" type="text/javascript"></script>
<script src="Plugins/codemirror/addon/fold/comment-fold.js" type="text/javascript"></script>
<script src="Plugins/codemirror/addon/fold/foldgutter.js" type="text/javascript"></script>
<script src="Plugins/codemirror/addon/fold/indent-fold.js" type="text/javascript"></script>
<script src="Plugins/codemirror/addon/fold/markdown-fold.js" type="text/javascript"></script>
<script src="Plugins/codemirror/addon/fold/xml-fold.js" type="text/javascript"></script>

<link rel="stylesheet" href="<?php echo $wd_type ?>/<?php echo $wd_app ?>/js/contextMenu/jquery.contextMenu.min.css">
<script src="<?php echo $wd_type ?>/<?php echo $wd_app ?>/js/contextMenu/jquery.contextMenu.min.js" type="text/javascript"></script>

<style>
html,body,.dt .CodeMirror{
	height: 100%;
}
.hide{
	display: none;
}
.dt .project-files .file:hover{
	background-color: #f8f9fa;
}
.dt .project-files .file a{
	display: block;
}
.webdesk_nav-link.webdesk_active{
	border-color: #dee2e6 #dee2e6 #fff;
	background-color: #dee2e6;
}
.webdesk_nav-item .webdesk_close{
	padding: 3px 4px 0 0;
}
.codemirror-wrapper{
	/*display: none;*/
	height: 100%;
}
.webdesk_nav-item .edited-icon{
	opacity: 0;
}
.webdesk_nav-item.edited .edited-icon{
	opacity: 1;
}
.file .open-icon{
	opacity: 0;
}
.file.open .open-icon{
	opacity: 1;
}
.app-card a:hover{
	text-decoration: none;
}
</style>