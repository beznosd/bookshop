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
			switch (form) {
				case 'registration_form':
					var data_to_send = $('#registration_form').serialize() + '&action='+form;
				break;
				case 'authorization_form':
					var data_to_send = $('#authorization_form').serialize() + '&action='+form;
				break;
			}
			//alert(data_to_send);
			$.ajax({
				method: request_type,
				url: 'http://localhost/bookshop/?r=site/index',
				data: data_to_send,
				success: function(data){
					data = $.parseJSON(data);
					//alert(data.action);
					switch( data.action ) {
						case 'registration_form':
							if ( data.success ) {
								$('.alert-success.alert-registration').text(data.msg).stop().fadeIn(500);
								document.getElementById('registration_form').reset();
								setTimeout(function(){
									$('#modal-reg').modal('hide');
									$('.alert-success.alert-registration').fadeOut(500);
								}, 2250);
							}
							else if( !data.success ) {
								for (var i = 0; i < data.err.err_num.length; i++) {
									if(data.err.err_num[i] == 0) {
										$('.alert-warning.alert-registration').text(data.err.err_text[i]).stop().fadeIn(500);

										setTimeout(function(){
											$('.alert-warning.alert-registration').fadeOut(500);
										}, 3000)
										break;
									}
									if (i == 0)
										$('.alert-danger.alert-registration').text(data.err.err_text[i]).stop().fadeIn(500);
									if (i != 0 && data.err.err_num.length > 1 && data.err.err_num[i] != data.err.err_num[i-1]){
										$('.alert-danger.alert-registration').clone().appendTo('.alerts').text(data.err.err_text[i]).stop().animate({opacity:1},500).addClass('clone');
									}
									setTimeout(function(){
										$('.alert-danger.alert-registration').fadeOut(500);
									}, 3000);
									setTimeout(function(){
										$('.clone').remove();
									}, 3500);
								}
							} else {
								alert('При ajax запросе произошла ошибка на сервере');
							}
						break;
						case 'authorization_form':
							if ( data.success ) {
								alert(data.yes);
							}
							else if( !data.success ) {
								alert('Error');
							} else {
								alert('При ajax запросе произошла ошибка на сервере');
							}
						break;
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