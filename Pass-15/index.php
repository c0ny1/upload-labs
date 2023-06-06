<?php
include '../config.php';
include '../head.php';
include '../menu.php';

function isImage($filename){
    $types = '.jpeg|.png|.gif';
    if(file_exists($filename)){
        $info = getimagesize($filename);
        $ext = image_type_to_extension($info[2]);
        if(stripos($types,$ext)>=0){
            return $ext;
        }else{
            return false;
        }
    }else{
        return false;
    }
}

$is_upload = false;
$msg = null;
if(isset($_POST['submit'])){
    $temp_file = $_FILES['upload_file']['tmp_name'];
    $res = isImage($temp_file);
    if(!$res){
        $msg = "文件未知，上传失败！";
    }else{
        $img_path = UPLOAD_PATH."/".rand(10, 99).date("YmdHis").$res;
        if(move_uploaded_file($temp_file,$img_path)){
            $is_upload = true;
        } else {
            $msg = "Upload error!";
        }
    }
}
?>

<div id="upload_panel">
    <ol>
    <li>
            <h3>Task</h3>
            <p>Upload a <code>webshell</code> or <code>PHP backdoor</code> as an <code>image file</code> to the server.</p>
            <p>Notice:</p>
            <p>1. Ensure that the uploaded image file still contains a complete <code>webshell</code> or <code>PHP backdoor</code> code.</p>
            <p>2. Exploit the <a href="<?php echo INC_VUL_PATH;?>" target="_blank">file inclusion vulnerability</a> to execute the malicious code embedded in the image file.</p>
            <p>3. To pass the challenge, successfully upload the image file with any of the following extensions: <code>.jpg</code>, <code>.png</code>, <code>.gif</code>.</p>
        </li>
        <li>
            <h3>Upload area</h3>
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