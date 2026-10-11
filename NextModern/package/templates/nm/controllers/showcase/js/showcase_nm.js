icms.showcase.btnCartMinus = function(btn){
	wrap = $(btn).closest('.sc_cart_btn_wrap');
	input = wrap.find('input');
	new_val = parseInt(input.val())-1;
	input.val(new_val);	
	wrap.find('.sc_cart_btn_counter span').html(new_val);
	if(new_val == 0){
	wrap.find('.sc_cart_btn_counts').hide();
	wrap.find('.sc_cart_btn').show();
	}

}
icms.showcase.btnCartPlus = function(btn){
	wrap = $(btn).closest('.sc_cart_btn_wrap');
	input = wrap.find('input');
	new_val = parseInt(input.val())+1;	
	input.val(new_val);
	wrap.find('.sc_cart_btn_counter span').html(new_val);

}

icms.showcase.afterAddCart = function(btn, result){
	wrap = $(btn).closest('.sc_cart_btn_wrap');
	wrap.find('.sc_cart_btn_counts').show();
	wrap.find('.sc_cart_btn').hide();
	input = wrap.find('input').val(1);	
	wrap.find('.sc_cart_btn_counter span').html(1);
	//btn.next('.sc_cart_btn_counter').html('В корзине '+result.data.qty).show();
}