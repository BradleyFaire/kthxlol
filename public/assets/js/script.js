var order     = document.querySelector('#order');
var orderform = document.querySelector('#orderform');
if(order){
	order.onchange = function(){
		orderform.submit();
	}
}