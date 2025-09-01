define(['jquery'], function($){
	
	function init(rootpath){
		$('.activity-link').click(function(){
			console.log('click en .activity-link:', $(this).attr('data-target'));
			var params = {
				data: $(this).attr('data-info'),
			}
			$.post(rootpath + '/mod/ucicbootstrap/check.php', params, function(response){
				console.log(response);
			});
		});
	}
	
	return{
		init: init
	}
	
});