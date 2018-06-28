<style>
.mce-tinymce, .mce-container-body, #code_ifr {
    min-width: 100% !important;
}
</style>
<script>
tinymce.init({
    selector: '#wd_dashAlert',
    menubar: false,
    resize: false,
    theme: 'modern',
    plugins: [
      'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
      'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
      'save table contextmenu directionality emoticons template paste textcolor toc autoresize hr insertdatetime pagebreak autosave save searchreplace help tabfocus'
    ],
    content_css: 'css/content.css',
    toolbar: 'insertfile undo redo | styleselect | bold italic | charmap | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | media | forecolor backcolor emoticons | insertdatetime | code | help'
  });
  </script>
<h1>Message Center</h1>
<!--<div class="well">
    <form method="post" action="notfySub.php">
      <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-edit"></i></span>
        <input type="text" name="post" placeholder="Post a note." style="width: 80%;">
        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span> Note</button>
      </div>
    </form>
  </div>-->
<div class="well">
    <form method="post" action="notfySub.php" id="wd_alertForm">
      <div class="webdesk_input-group">
        <span class="webdesk_input-group-addon"><i class="fa fa-user"></i></span>
          <input class="webdesk_form-control" id="user" name="user" type="text" list="wd_users" placeholder="To: Username" required>
          <datalist id="wd_users">
          <?php
          $wd_users = scandir($wd_root . '/User/');
          foreach($wd_users as $wd_key){
            if($wd_key != '.' && $wd_key != '..'){
          ?>
          <option value="<?php echo f_dec($wd_key); ?>">
            <?php
            }
            }
            ?>
          </datalist>
        </div>
        <div class="webdesk_input-group">
          <span class="webdesk_input-group-addon"><i class="fa fa-edit"></i></span>
          <input class="webdesk_form-control" id="sub" name="sub" type="text" placeholder="Subject: " required>
        </div>
        <div class="webdesk_input-group">
        <span class="webdesk_input-group-addon"><i class="fa fa-envelope"></i></span>
        <textarea type="text" id="wd_dashAlert" name="post" placeholder="Send alert." style="width: 80%;"></textarea>
        </div>
      
          <!--<input type="hidden" name="">-->
        <button type="submit" class="webdesk_btn webdesk_btn-success"><b><i class="fa fa-envelope"></i> Post</b></button>
      
    </form>
  </div>
<hr>
<script type='text/javascript'>
  var ed = tinyMCE.get('wd_dashAlert');
    /* attach a submit handler to the form */
    $("#wd_alertForm").submit(function(event) {
      /* stop form from submitting normally */
      event.preventDefault();
      /* get the action attribute from the <form action=""> element */
      var $form = $( this ),
          url = $form.attr( 'action' );
      /* Send the data using post with element id name and name2*/
      var posting = $.post( url, { user: $('#user').val(), sub: $('#sub').val(), post:  tinymce.get('wd_dashAlert').getContent() }  );
      /* Alerts the results */
      posting.done(function( data ) {
        //alert('Posted');
        $("#wd_alertList").load("notfyList.php"); 
      });
    });
  $(document).ready(function(){
  $("#wd_alertList").load("notfyList.php");
  });
</script>
<div id="wd_alertList"></div>
