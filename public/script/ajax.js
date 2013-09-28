function gettoken(){
	$("#messge").html("<img src='model/action.php?type=token'/> <span onclick='gettoken()'>刷新</sapn>")
	$("#messge").slideDown("slow");
}
function goin(){
	if($(".one").val() == ''){
		$("#messge").html("还没有填完!");
		$("#messge").slideDown("slow");
	}else{
		var con = "UserID="+$('#UserID').val()+"&UserPW="+$('#UserPW').val()+"&Token="+$('#Token').val();
		$.ajax({
			type:"POST",
			url:"model/action.php",
			data: con,
			success: function(data){
				if(data==''){
					$("#box").slideUp("slow");
					$.get("model/action.php?type=show",function(data){
						$("#messge").html(data);
						$("#messge").slideDown("slow");
					});
					update();
				}else{
					$("#messge").html(data);
					$("#messge").slideDown("slow");
				}
			}
		});
	}
}
function update(){
	var con = "UserID="+$('#UserID').val()+"&UserPW="+$('#UserPW').val()+"&Token="+$('#Token').val();
	$.ajax({
		type:"POST",
		url:"model/action.php?type=keep",
		data: con,
		success:function(data){
			if(data){
				$("#messge").html($("#messge").html()+"<p>"+data+"<p>");
			}
		}
	});
	setTimeout("update()",20000);
}
function updatetoken(){
	$("#box").slideDown("slow");
	setTimeout("updatetoken()",600000);
	gettoken();
}


$(document).ready(function(){
	updatetoken();
	$('.one').focusin(function(){
		$(this).animate({
			backgroundColor:'#DDD'
		},500)
	});
	$('.one').focusout(function(){
		$(this).animate({
			backgroundColor:'#EBEBEB'
		},500);
	});
	$('.submit').mouseover(function(){
		$(this).animate({
			backgroundColor:'#00DEF2'
		},500)
	});
	$('.submit').mouseout(function(){
		$(this).animate({
			backgroundColor:'#443'
		},500)
	});
	$('.submit').click(function(){goin()});
});