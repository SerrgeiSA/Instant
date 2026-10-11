   
<div class="nm_sidemenu mt-n2">
<ul id="content_categories">
<li>
<a class="text-nowrap cursor-pointer not-link" href="<?php echo href_to($ctype['name']); ?>">                
<span class="nm_mobmenu-text not-link">
<?php if (empty($category['title'])){ ?>
Выбрать категорию
<?php }else{ ?>
Выбрать подкатегорию
<?php } ?>
</span>
 </a>
<ul class="submenu">
<?php foreach($cats as $c){ ?>	 
<li>
<a class="text-nowrap<?php if (!empty($category['title']) && $category['title'] == $c['title']){ ?> active<?php } ?>" href="<?php echo $c['list_params']['href']; ?>"><span class="nm_mobmenu-text"><?php echo $c['title']; ?></span></a>
</li>			
<?php }  ?>
</ul>
</li>
</ul>
</div>
		
<style>
	#content_categories{
		overflow:hidden;
	}
	#content_categories a{
		color:#000;
	}
#content_categories .dcjq-icon{
	cursor:pointer;
}
#content_categories .dcjq-icon:before,
#content_categories .dcjq-icon:after {
    background-color: var(--primary);
}
</style>
		
<?php ob_start(); ?>

	<script>
	
    $('#content_categories').dcAccordion({
    eventType: 'click',
    autoClose: true,
    saveState: false,
    disableLink: false,
    showCount: false,
    speed: 'fast'
    });
	
	$( '#content_categories a' ).click(function( event ) {		  
            if( $(event.target).hasClass('dcjq-icon') || $(event.target).hasClass('not-link') ){
				return false;
			}
	});
	
	</script>

<?php $this->addBottom(ob_get_clean()); ?>