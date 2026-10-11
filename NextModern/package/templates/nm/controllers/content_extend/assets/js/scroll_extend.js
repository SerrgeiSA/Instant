$(function() {

    var win = $(window),
    	block = $(scroll_css_selector),
    	lastid = $('.scroll-post[data-lastid]',block).first().data('lastid'),
    	isAjaxBusy = false;

    win.on('scroll', function(e) {

    	if(isAjaxBusy) {
    		return false;
    	}
		
	//alert($('.scroll-post').last().data('id') );
		
		//if( $('.scroll-post[data-id="'+lastid+'"]', block).length == 0 ){
		

       if ((block.offset().top + block.outerHeight() - 800) < win.scrollTop()) {
            var last_block = $('.scroll-post').last(),
                data = last_block.data();
		
				
            block.append('<div class="cssload-container"><div class="cssload-loading"><i></i><i></i><i></i><i></i></div></div>');
            $.ajax({
                url: '/content_extend/post',
                data: { id: data.id, ctype: data.ctype },
                dataType: 'html',
                beforeSend: function() {
    				if(isAjaxBusy) {
  						return false;
  					} else {
  						isAjaxBusy = true;
  					}
  				},
                success: function(html) {
                	isAjaxBusy = false;
                	$('.cssload-container').remove();
                    block.append(html);
                },
                error: function() {
                    isAjaxBusy = false;
                    $('.cssload-container').remove();
                }
            });
			
	
		
     

        $('.scroll-post').each(function() {
            let _this = $(this);
            if (_this.offset().top < window.scrollY + 100 && _this.offset().top + _this.height() > window.scrollY + 100) {
                let url = _this.data('url');
                $(document).prop('title', _this.data('page_title'));
                window.history.pushState({"html":'',"pageTitle":''},'', url);
            }
        });
		
		
		}
		
    });
});
