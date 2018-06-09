<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; } ?>
<div>
  <div>
    <div>
      <div>
        <h4 class="modal-title">Contact Us</h4>
      </div>
      <div>
        <form method="post" action="indexSub.php?page=contactSub.php">
          <div class="form-group">
            <label for="name">Name:</label>
            <div class="input-group margin-bottom-sm">
  <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
            <input type="text" id="name" name="name"  class="form-control" data-toggle="tooltip" title="Your name." placeholder="Your name" required>
            </div>
          </div>
          <div class="form-group">
            <label for="email">Email:</label>
            <div class="input-group margin-bottom-sm">
  <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i></span>
            <input type="email" id="email" name="email"  class="form-control" data-toggle="tooltip" title="Your email." placeholder="Your email" required>
            </div>
          </div>
          <div class="form-group">
            <label for="subject">Subject:</label>
            <div class="input-group margin-bottom-sm">
  <span class="input-group-addon"><i class="fa fa-pencil" aria-hidden="true"></i></span>
            <input type="text" id="subject" name="subject"  class="form-control" data-toggle="tooltip" title="Your subject." placeholder="Your subject" required>
              </div>
          </div>
          <div class="form-group">
            <label for="con">Content:</label>
            <textarea id="con" name="con"  class="form-control" data-toggle="tooltip" title="Your content." placeholder="Your content" required></textarea>
          </div>
          <input type="submit" id="submit" value="send" class="btn btn-success"> <span id="bcontact"></span>
        </form>
      </div>
    </div>
  </div>
</div>
