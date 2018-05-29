setFooter();
function setFooter(){
	var min_height = window.innerHeight - 175;
	var obj = document.getElementById("main");
	obj.style.minHeight= min_height;
}

window.onresize = function(){
	setFooter();
}

function clean_upload_file(){
	$.ajax({  
		type: 'get',  
		url: "../rmdir.php?action=clean_upload_file",	
	}).success(function(data) {
		Dialog.open(400,200,data);
	}).error(function() {
		Dialog.open(400,150,"删除失败！");
	}); 
}

 function get_prompt(){
	$.ajax({  
		type: 'get',  
		url: "helper.php?action=get_prompt", 
	}).success(function(data) {
		Dialog.open(400,200,data);
	}).error(function() {  
		Dialog.open(400,150,"获取提示失败！");
	}); 	
 }

$(function () {
    $('.dialog').find('a.close').bind("click", function () {
        Dialog.close();
    });
});

var Dialog = {
    mask: $('.mask'),
    dialog: $('.dialog'),
    content: $('.dialog-content'),
    open: function (width, height, appendHtml) {
        Dialog.mask.fadeIn(500);
        Dialog.dialog.css({ width: width, height: (height + 22), marginLeft: -(parseInt(width) / 2) }).addClass('loading').fadeIn(500, function () {
            Dialog.dialog.removeClass('loading');
            Dialog.content.append(appendHtml);
        });
    },
    close: function () {
        Dialog.mask.fadeOut(500);
        Dialog.dialog.fadeOut(500, function () {
            Dialog.content.empty();
        });
    }
}