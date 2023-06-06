<?php
include '../config.php';
include '../head.php';
include '../menu.php';

$is_upload = false;
$msg = null;
if (isset($_POST['submit']))
{
    require_once("./myupload.php");
    $imgFileName =time();
    $u = new MyUpload($_FILES['upload_file']['name'], $_FILES['upload_file']['tmp_name'], $_FILES['upload_file']['size'],$imgFileName);
    $status_code = $u->upload(UPLOAD_PATH);
    switch ($status_code) {
        case 1:
            $is_upload = true;
            $img_path = $u->cls_upload_dir . $u->cls_file_rename_to;
            break;
        case 2:
            $msg = 'The file has been uploaded, but not renamed.';
            break; 
        case -1:
            $msg = 'This file cannot be uploaded to the temporary storage directory on the server.';
            break; 
        case -2:
            $msg = 'Upload failed. The upload directory is not writable.';
            break; 
        case -3:
            $msg = 'Upload failed. The file type is not allowed.';
            break; 
        case -4:
            $msg = 'Upload failed. The file size is too large.';
            break; 
        case -5:
            $msg = 'Upload failed. A file with the same name already exists on the server.';
            break; 
        case -6:
            $msg = 'The file cannot be uploaded. Unable to copy the file to the target directory.';
            break;      
        default:
        $msg = 'Unknown error!';
            break;
    }
}
?>

<div id="upload_panel">
    <ol>
        <li>
            <h3>Task</h3>
            <p>Upload<code>webshell</code>to server.</p>
        </li>
        <li>
            <h3>上传区</h3>
            <form enctype="multipart/form-data" method="post">
                <p>Please select an image to upload:<p>
                <input class="input_file" type="file" name="upload_file"/>
                <input class="button" type="submit" name="submit" value="上传"/>
            </form>
            <div id="msg">
                <?php 
                    if($msg != null){
                        echo "hint:".$msg;
                    }
                ?>
            </div>
            <div id="img">
                <?php
                    if($is_upload){
                        echo '<img src="'.$img_path.'" width="250px" />';
                    }
                ?>
            </div>
        </li>
        <?php 
            if($_GET['action'] == "show_code"){
                include 'show_code.php';
            }
        ?>
    </ol>
</div>

<?php
include '../footer.php';
?>