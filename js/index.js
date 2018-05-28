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
		alert(data);
	}).error(function() {  
		alert("删除失败！");  
	}); 
}

 function get_prompt(){
	$.ajax({  
		type: 'get',  
		url: "helper.php?action=get_prompt", 
	}).success(function(data) {  
		alert(data);  
	}).error(function() {  
		alert("获取提示失败！");  
	}); 	
 }