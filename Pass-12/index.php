<?php
include '../config.php';
include '../head.php';
include '../menu.php';

$is_upload = false;
$msg = null;
if(isset($_POST['submit'])){
    $ext_arr = array('jpg','png','gif');
    $file_ext = substr($_FILES['upload_file']['name'],strrpos($_FILES['upload_file']['name'],".")+1);
    if(in_array($file_ext,$ext_arr)){
        $temp_file = $_FILES['upload_file']['tmp_name'];
        $img_path = $_GET['save_path']."/".rand(10, 99).date("YmdHis").".".$file_ext;

        if(move_uploaded_file($temp_file,$img_path)){
            $is_upload = true;
        } else {
            $msg = 'Upload error!';
        }
    } else{
        $msg = "Upload only.jpg|.png|.gif type file！";
    }
    $msg = $msg . '<br>' . 'Filename: ' . $file_name . ' | File extension: ' . $file_ext;
}
?>

<div id="upload_panel">
    <ol>
        <li>
            <h3>Task</h3>
            <p>Upload<code>webshell</code>to server.</p>
        </li>
        <li>
            <h3>Upload area</h3>
            <form action="?save_path=../upload/" enctype="multipart/form-data" method="post">
                <p>Please select an image to upload:<p>
                <input class="input_file" type="file" name="upload_file"/>
                <input class="button" type="submit" name="submit" value="Upload"/>
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
