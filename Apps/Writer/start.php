<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
if(isset($_GET["title"])){$title = $_GET["title"]; $title=explode(".", $title); $title = $title[0];}
else{
	$cdate = date("M_j_Y--g_i_a");
	$title = $cdate;
}
?>
<script>
tinymce.init({
    selector: '#myTextarea',
    theme: 'modern',
    plugins: [
      'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
      'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
      'save table contextmenu directionality emoticons template paste textcolor toc autoresize hr insertdatetime pagebreak autosave save searchreplace'
    ],
    content_css: 'css/content.css',
    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons | fullscreen | toc | insertdatetime | pagebreak | restoredraft | save | template | searchreplace',
    templates : [
    {
      title: "Blank",
      url: "<?php echo $type; ?>/Writer/Temp0.html",
      description: "Blank Doc"
    },
    {
      title: "Two Columns",
      url: "<?php echo $type; ?>/Writer/Temp1.html",
      description: "Adds two columns."
    },
    {
      title: "Four Columns",
      url: "<?php echo $type; ?>/Writer/Temp2.html",
      description: "Adds four columns."
    }
  ]
  });
  </script>

<form method="POST" action="<?php wd_urlSub($wd_type, 'Writer', 'startSub.php', ''); ?>" style="height: 100%;">
  <a href="<?php wd_url('Apps', 'Files', 'start.php', '&prog=' . $wd_app . '&ptype=' . $wd_type . '&psec=start.php'); ?>">Open File</a>
  <input type="text" name="title" id="title" placeholder="Title your document." title="Title your document." value="<?php echo $title; ?>">
  <span id="Saving" style="color: red;">Saved: </span>
  <?php if(isset($_GET['date'])){echo test_input($_GET['date']);} else{ echo 'Not Yet!';} ?>
  <a href="<?php wd_urlSub($wd_type, $wd_app, 'exportSub.php', '&title=' . $title); ?>" target="_blank" style="float: right;">Export to HTML</a>
  <textarea id="myTextarea" name="content" autofocus="autofocus" style="width: 100%; height: 75%;"><?php if(isset($_GET["title"])){ $f = fopen($wd_file . $title . '.wd_writer', "r");
	while(!feof($f)) {
	    echo fgets($f);
	}
	fclose($f);} ?></textarea>
  <!--<input type="submit" value="Save"> -->
</form>
