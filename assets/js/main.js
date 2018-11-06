$(document).ready(function() {

	//Button for profile post
	$('#submit_profile_post').click(function(){

		$.ajax({
			type: "POST",
			url: "includes/handlers/ajax_submit_profile_post.php",
			data: $('form.profile_post').serialize(),
			success: function(msg) {
				$("#post_form").modal('hide');
				location.reload();
			},
			error: function() {
				alert('Failure');
			}
		});
	});
});

function getUsers(value, user) {
	$.post("includes/handlers/ajax_friend_search.php", {query:value, userLoggedIn:user}, function(data) {
		$(".results").html(data);
	});
}

function getDropdownData(user, type) {
	if ($(".dropdown_data_window").css("height") == "0px") { // checking the css height value if 0
		var pageName;

		if (type == 'notification'){

		} else if (type == 'message') {
			pagename = "ajax_load_messages.php";
			$("span").remove("#unread_message");
		}


	}
}