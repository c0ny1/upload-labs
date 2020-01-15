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
            <h3>简介</h3>
            <p><code>upload-labs</code>是一个使用<code>php</code>语言编写的，专门收集渗透测试和CTF中遇到的各种上传漏洞的靶场。旨在帮助大家对上传漏洞有一个全面的了解。目前一共21关，每一关都包含着不同上传方式。</p>
        </li>
        <li>
            <h3>注意</h3>
            <p>1.每一关没有固定的通关方法，大家不要自限思维！</p>
            <p>2.本项目提供的<code>writeup</code>只是起一个参考作用，希望大家可以分享出自己的通关思路。</p>
            <p>3.实在没有思路时，可以点击<code>查看提示</code>。</p>
            <p>4.如果黑盒情况下，实在做不出，可以点击<code>查看源码</code>。</p>
        </li>
        <li>
            <h3>后续</h3>
            <p>如在渗透测试实战中遇到新的上传漏洞类型，会更新到<code>upload-labs</code>中。当然如果你也希望参加到这个工作当中，欢迎<code>pull requests</code>给我!</p>
            <p>项目地址：<code>https://github.com/c0ny1/upload-labs</code></p>
        </li>
	</ol>
</div>


<?php
include 'footer.php'
?>
