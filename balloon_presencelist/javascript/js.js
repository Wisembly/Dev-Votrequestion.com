$(function() {
	
	$("#search").keyup(function(e){
			field = $(this);
			var content = field.val();
			$("#results_search").html();
			
			if (content.indexOf(" ") != -1)
			content = (content.split(" ")[0] + ";" + content.split(" ")[1]);

			if ( content.length > 1 ) {
				$.ajax({
				  data: 'search='+content,
				  url: 'search.php',
				  success: function (data) {
					$("#results_search").html(data);
				  },
				});	
			}else
				$("#results_search").html('');
			
		});
});