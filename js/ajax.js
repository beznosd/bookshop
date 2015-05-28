$(document).ready(function(){
	$(".ajax_link").click(function(){
		//alert($(this).attr('href'));
		$.ajax({
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
		return false;
	});
});