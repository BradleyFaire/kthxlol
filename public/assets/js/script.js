var content   = document.querySelector('.ckeditor');
var order     = document.querySelector('#order');
var orderform = document.querySelector('#orderform');
if(order){
	order.onchange = function(){
		orderform.submit();
	}
}

if(content){
	CKEDITOR.replace( 'content', {height: '350px'} );
}