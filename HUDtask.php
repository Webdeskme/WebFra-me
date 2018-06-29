<h1>Task Manager</h1>
<p>Take a current snapshop of your current workstation setup and access it later.</p>
<div class="webdesk_row">
    <div class="webdesk_col-md-4">
        <form method="post" action="taskSub.php">
            <div class="webdesk_form-group">
                <div class="webdesk_input-group">
                    <input type="text" class="webdesk_form-control" name="title" value="<?php echo date("M j, Y g:ia"); ?>" placeholder="Name this snapshot" <?php echo (empty($_GET["app"])) ? "disabled" : "" ?> />
                    <div class="webdesk_input-group-append">
                        <input type="submit" class="webdesk_btn webdesk_btn-success" value="Add" <?php echo (empty($_GET["app"])) ? "disabled" : "" ?> />
                    </div>
                    
                </div>
                <small id="titleHelp" class="webdesk_form-text webdesk_text-<?php echo (empty($_GET["app"])) ? "danger" : "muted" ?>"><?php echo (empty($_GET["app"])) ? "You must have an app open to use Task Manager" : "" ?></small>
            </div>
            <input type="hidden" name="task" value="<?php echo $actual_link; ?>">
            <input type="hidden" name="app" value="<?php $app = test_input($_GET["app"]); echo $app; ?>">
            
        </form>
    </div>
</div>
<?php
if ($handle = opendir($wd_root . '/User/' . $_SESSION["user"] . '/Book/')) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
            echo file_get_contents($wd_root . '/User/' . $_SESSION["user"] . '/Book/' . $entry);
        }
    }
}
?>