<h1>Task Manager</h1>
    <form method="post" action="taskSub.php">
        <input type="text" name="title" value="<?php echo date("m-d-Y h:i-sa"); ?>" placeholder="Add Task Title">
        <input type="hidden" name="task" value="<?php echo $actual_link; ?>">
        <input type="hidden" name="app" value="<?php $app = test_input($_GET["app"]); echo $app; ?>">
        <input type="submit" class="btn btn-success" value="Add">
    </form>
<?php
    if ($handle = opendir($wd_root . '/User/' . $_SESSION["user"] . '/Book/')) {
                while (false !== ($entry = readdir($handle))) {
                    if ($entry != "." && $entry != "..") {
                        echo file_get_contents($wd_root . '/User/' . $_SESSION["user"] . '/Book/' . $entry);
                    }}}
?>