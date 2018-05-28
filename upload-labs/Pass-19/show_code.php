<li id="show_code">
    <h3>代码</h3>
<pre>
<code class="line-numbers language-php">$is_upload = false;
$msg = null;
if (isset($_POST['submit'])) {
    if (file_exists($UPLOAD_ADDR)) {
        $deny_ext = array("php","php5","php4","php3","php2","html","htm","phtml","pht","jsp","jspa","jspx","jsw","jsv","jspf","jtml","asp","aspx","asa","asax","ascx","ashx","asmx","cer","swf","htaccess");

        $file_name = $_POST['save_name'];
        $file_ext = pathinfo($file_name,PATHINFO_EXTENSION);

        if(!in_array($file_ext,$deny_ext)) {
            $img_path = $UPLOAD_ADDR . '/' .$file_name;
            if (move_uploaded_file($_FILES['upload_file']['tmp_name'], $img_path)) { 
                $is_upload = true;
            }else{
                $msg = '上传失败！';
            }
        }else{
            $msg = '禁止保存为该类型文件！';
        }

    } else {
        $msg = $UPLOAD_ADDR . '文件夹不存在,请手工创建！';
    }
}
</code>
</pre>
</li>