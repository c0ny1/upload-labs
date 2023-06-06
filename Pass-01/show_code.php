<li id="show_code">
    <h3>代码</h3>
<pre>
<code class="line-numbers language-javascript">function checkFile() {
    var file = document.getElementsByName('upload_file')[0].value;
    if (file == null || file == "") {
        alert("Please select a file to upload!");
        return false;
    }
    //定义允许上传的文件类型
    var allow_ext = ".jpg|.png|.gif";
    //提取上传文件的类型
    var ext_name = file.substring(file.lastIndexOf("."));
    //判断上传文件类型是否允许上传
    if (allow_ext.indexOf(ext_name + "|") == -1) {
        var errMsg = "The file is not allowed to upload, please upload" + allow_ext + "type of file, the current file type is：" + ext_name;
        alert(errMsg);
        return false;
    }
}
</code>
</pre>
</li>