$(document).ready(function(){

	$('#comment-post-btn').click(function(){
		comment_post_btn_click();
	});

	add_delete_handlers();

});

function comment_post_btn_click(){
	var comment = $('#comment-post-text').val();
		var user_ID = $('#userID').val();
		var user_Name = $('#userName').val();


		if( comment.length > 0 && user_ID != null ){
			$('.comment-insert-container').css('border', '1px solid #e1e1e1');
			
				$.ajax({ 
					url: "comment_ajax.php",
				    method: "POST",
				    data: {
				     task : "comment_insert",
				     userID:user_ID,
				     commentText:comment 
				    },
				    dataType:"json",
				    success:function(data)
				    {
				    	comment_insert(data);
     					console.log("Response Text " + data);				    }
				   });﻿
		} else {
			$('.comment-insert-container').css('border', '1px solid #ff0000');
			alert("The textarea is empty!");
		}

		$('#comment-post-text').val("");
}

function add_delete_handlers(){
	$('.delete-btn').each(function(){
		var btn = this;
		$(btn).click(function(){
			comment_delete(btn.id);
		});
	});
}

function comment_delete(delid){
	if(confirm("Do you want Delete?")){
   window.location.href='commentDelete.php?del_id=' +delid+'';
   return true;}
}

function comment_insert( data ){

	var t = '';
	t += '<li class="comment-holder" id="'+data.comment_id+'">';
	t += '<div class="user-img">';
	t += '<img src="'+data.profile_img+'" class="user-img-pic"/>';
	t += '</div>';
	t += '<div class="comment-body">';
	t += '<p class="username-field">'+data.userName+'</p>';
	t += '<div class="comment-text">'+data.comment+'</div></div>';
	t += '<div class="date-text">'+data.comment_date+'</div>';
	t += '<div class="comment-buttons-holder">';
	t += '<ul>';
	t += '<li id="'+data.comment_id+'" class="delete-btn">';
	t += '<i class="fa fa-trash" aria-hidden="true"></i>';
	t += '</li>';
	t += '</ul>';
	t += '</div>';
	t += '</li>';

	$('.comments-holder-ul').prepend(t);
	add_delete_handlers();
}