$(document).ready(function(){
	$(".ajax_link").click(function(){
		//alert($(this).attr('href'));
		var request_type = ( $(this).attr('request-type') ) ? $(this).attr('request-type').toUpperCase() : 'GET';
		if (request_type == 'GET') {
			$.ajax({
				method: request_type,
				url: $(this).attr('href'),
				success: function(data){
					data = $.parseJSON(data);
					if ( data.success ) {
						switch( data.action ) {
							case 'to_cart':
								$('#cart_count_top').text(data.cart_count);
								break;
						}
					}
					else {
						alert('При ajax запросе произошла ошибка на сервере');
					}
				},
				error: function(){
					alert('Lost connection with the server!');
				}
			});
		}
		else {
			var form = $(this).attr('form');
			var data_to_send = $('#registration_form').serialize() + '&action='+form;
			//alert(data_to_send);
			$.ajax({
				method: request_type,
				url: 'http://localhost/bookshop/?r=site/index',
				data: data_to_send,
				success: function(data){
					data = $.parseJSON(data);
					if ( data.success ) {
						switch( data.action ) {
							case 'registration_form':
								alert(data.action);
								break;
						}
					}
					else {
						alert('При ajax запросе произошла ошибка на сервере');
					}
				},
				error: function(){
					alert('Lost connection with the server!');
				}
			});
		}
		return false;
	});
});