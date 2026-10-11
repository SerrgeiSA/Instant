    $( document ).ready(function() { 
	
	$('body').append('<input id="wd_import" type="file" name="file" style="display:none" />')
	
	setTimeout(function(){

    $( "li[data-widget-id]", "#cp-widgets-layout" ).each(function( index ) {
		
		$(this).find('.actions').prepend('<a class="wd-import mr-3" href="#" title="Загрузить настройки"><svg class="icms-svg-icon w-16" fill="currentColor"><use href="/templates/nm/images/icons/solid.svg#upload"></use></svg></a><a class="wd-export mr-3" href="#" title="Скачать настройки"><svg class="icms-svg-icon w-16" fill="currentColor"><use href="/templates/nm/images/icons/solid.svg#download"></use></svg></a>');
		
    });
	
	
	}, 500);


	 
listenCookieChange('icms[widgets_tree_path]', function() {
           
		    var path = $.cookie('icms[widgets_tree_path]');
            if (!path) {path = '/core/core.0';}
			page_id = parseInt(path.match(/\d+/));
			
        var form_data = new FormData();
        form_data.append("page_id",page_id);		
					
		 $.ajax({
          url:'/nm/get_page_ajax',
          method:'POST',
          data:form_data,
          contentType:false,
          cache:false,
          processData:false,
          beforeSend:function(){
            
          },
          success:function(result){
          		
				$('select.page_theme_select[data-device="desktop"]').find('option[value="' + result.data.theme_desktop + '"]').prop('selected', true);
			

          }
        });
});

		
	    $(document).on("change",'select.page_theme_select',function() {
			
			var path = $.cookie('icms[widgets_tree_path]');
            if (!path) {path = '/core/core.0';}
			page_id = parseInt(path.match(/\d+/));
	
		
        var form_data = new FormData();
        form_data.append("theme",$(this).val());
        form_data.append("device",$(this).data('device'));
        form_data.append("page_id",page_id);
		
		 $.ajax({
          url:'/nm/bind_page_theme',
          method:'POST',
          data:form_data,
          contentType:false,
          cache:false,
          processData:false,
          beforeSend:function(){
            
          },
          success:function(data){
          		
			toastr.success('Для текущей страницывыбран шаблон '+name);

          }
        });
		
	    return false;
		   
		});

		
	    $(document).on("click",".wd-export",function() {
			
		
		bind_id = $(this).closest('li[data-widget-id]').attr('bind-id');

        window.location.href = '/nm/widget_export/'+bind_id;
   	
	    return false;
		   
		});
		
		
		$(document).on("click",".wd-import",function() {
			
		bind_id = $(this).closest('li[data-widget-id]').attr('bind-id');
		
		$('#wd_import').click();
		$(document).on('change','#wd_import',function(){
			
        var file = document.getElementById('wd_import').files[0]; 
			
        var form_data = new FormData();
        form_data.append("file",file);
		
		
		 $.ajax({
          url:'/nm/widget_import?bind_id='+bind_id,
          method:'POST',
          data:form_data,
          contentType:false,
          cache:false,
          processData:false,
          beforeSend:function(){
            
          },
          success:function(data){
          		
			toastr.success('Загружены настройки для виджета '+$(this).closest('li[data-widget-id]').find('.title').text()+'');

          }
        });

			
	
		
		});
	    
	
	    return false;
		   
		});
		
		
		
	});
	
	
	
	
	
	
	
	// basic functions from the excellent http://www.quirksmode.org/js/cookies.html
function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

/////////////////////////////////
// ACTUAL FUN STUFF BELOW
/////////////////////////////////

var cookieRegistry = [];

function listenCookieChange(cookieName, callback) {
    setInterval(function() {
        if (cookieRegistry[cookieName]) {
            if (readCookie(cookieName) != cookieRegistry[cookieName]) { 
                // update registry so we dont get triggered again
                cookieRegistry[cookieName] = readCookie(cookieName); 
                return callback();
            } 
        } else {
            cookieRegistry[cookieName] = readCookie(cookieName);
        }
    }, 100);
}