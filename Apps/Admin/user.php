<?php
if(isset($_GET['user'])){
$user = test_input($_GET['user']);
if(file_exists($wd_root . '/User/' . $user . '/Admin/info.json')){
$obj = file_get_contents($wd_root . '/User/' . $user . '/Admin/info.json');
$obj = json_decode($obj);
}
?>
<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>
<br>
<a href="<?php wd_url($wd_type, $wd_app, 'ManageUsers.php', '') ?>"><button class="btn btn-primary">Back</button></a>
<br>
<form action="<?php wd_urlSub($wd_type, $wd_app, 'upload.php', ''); ?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="fileToUpload">Select image to upload:</label>
        <input type="file" name="fileToUpload" id="fileToUpload" class="btn btn-primary">
        <input type="hidden" name="user" value="<?php echo $user; ?>">
        <input type="submit" value="Upload Image" name="submit" class="btn btn-success">
    </div>
</form>
<form method="post" action="<?php wd_urlSub($wd_type, $wd_app, 'userSub.php', ''); ?>">
<div class="panel panel-primary form-group">
    <div class="panel-heading"><b><?php echo f_dec($user); ?></b></div>
    <div class="panel-body">
        <table>
            <tr>
                <th>Title</th>
                <th>Content</th>
            </tr>
            <tr>
                <td>First Name:</td>
                <td><input type="text" name="fn" placeholder="First Name" class="form-control" value="<?php if(file_exists($wd_root . '/User/' . $user . '/Admin/info.json')){echo $obj->fn;} ?>"></td>
            </tr>
            <tr>
                <td>Last Name:</td>
                <td><input type="text" name="ln" placeholder="Last Name" class="form-control" value="<?php if(file_exists($wd_root . '/User/' . $user . '/Admin/info.json')){echo $obj->ln;} ?>"></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input type="email" name="email" placeholder="Email" class="form-control" value="<?php if(file_exists($wd_root . '/User/' . $user . '/Admin/info.json')){echo $obj->email;} ?>"></td>
            </tr>
            <tr>
                <td>Contact Info:</td>
                <td><textarea name="contact" placeholder="Contact Info" class="form-control"><?php if(file_exists($wd_root . '/User/' . $user . '/Admin/info.json')){echo $obj->contact;} ?></textarea></td>
            </tr>
            <tr>
                <td>Notes:</td>
                <td><textarea name="notes" placeholder="Notes" class="form-control"><?php if(file_exists($wd_root . '/User/' . $user . '/Admin/info.json')){if(isset($obj->notes)){echo $obj->notes;}} ?></textarea></td>
            </tr>
            <tr>
                <td>Picture:</td>
                <td><img src="<?php if(file_exists($wd_root . '/User/' . $user . '/Admin/pic.jpg')){wd_image($wd_root . '/User/' . $user . '/Admin/pic.jpg');} ?>" style="width: 50%;" alt="<?php echo f_dec($user); ?>"> <input type="submit" name="delete" value="Delete" class="btn btn-danger"></td>
            </tr>
        </table>
    </div>
    <div class="panel-footer">
        <input type="hidden" name="user" value="<?php echo $user; ?>">
        <input type="submit" name="submit" value="Save" class="btn btn-success">
    </div>
</div>
</form>
<?php
}
?>