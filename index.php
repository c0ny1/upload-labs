<?php
include 'config.php';
include 'head.php';
include 'menu.php';
?>
<style type="text/css">
#head_menu a{
	display: none;
}
</style>

<div id="upload_panel">
    <ol>
        <li>
            <h3>Introduction</h3>
            <p><code>upload-labs</code> is a vulnerable web application written in PHP, specifically designed to collect various types of file upload vulnerabilities encountered in penetration testing and CTF challenges. Its purpose is to provide a comprehensive understanding of file upload vulnerabilities. Currently, there are a total of 21 levels, each of which includes different upload methods.</p>
        </li>
        <li>
            <h3>Notes</h3>
            <p>1. There is no fixed method to complete each level, so do not limit your thinking!</p>
            <p>2. The provided writeups are only for reference. It is encouraged to share your own approaches to solve the challenges.</p>
            <p>3. If you are stuck and need hints, you can click on "View Hints".</p>
            <p>4. If you are unable to solve a level even after using the hints, you can click on "View Source Code" (in black box scenarios).</p>
        </li>
        <li>
            <h3>Future Updates</h3>
            <p>If a new type of file upload vulnerability is encountered during actual penetration testing, it will be added to the upload-labs. If you would like to contribute to this project, you are welcome to submit pull requests.</p>
            <p>Project Repository: <code>https://github.com/c0ny1/upload-labs</code></p>
        </li>
	</ol>
</div>


<?php
include 'footer.php'
?>
