<div class="nm_sidemenu mt-n2">
<ul id="wd_content_categories">
<li>
<a class="text-nowrap cursor-pointer not-link" href="<?php echo href_to($ctype['name']); ?>">                
<span class="nm_mobmenu-text not-link">
<?php if (empty($active_cat['title'])){ ?>
Выбрать категорию
<?php }else{ ?>
<?php echo $active_cat['title']; ?>
<?php } ?>
</span>
 </a>
<ul class="submenu">
<?php foreach($cats as $c){ ?>	 
<li>
<a class="text-nowrap<?php if ($c['is_active']){ ?> active<?php } ?>" href="<?php echo href_to($ctype_name, $c['slug']); ?>"><span class="nm_mobmenu-text"><?php echo $c['title']; ?></span></a>
</li>			
<?php }  ?>
</ul>
</li>
</ul>
</div>
		
<style>
	#wd_content_categories{
		overflow:hidden;
	}
	#wd_content_categories a{
		color:#000;
	}
#wd_content_categories .dcjq-icon{
	cursor:pointer;
}
#wd_content_categories .dcjq-icon:before,
#wd_content_categories .dcjq-icon:after {
    background-color: var(--primary);
}
</style>
		
<?php ob_start(); ?>

	<script>
	
    $('#wd_content_categories').dcAccordion({
    eventType: 'click',
    autoClose: true,
    saveState: false,
    disableLink: false,
    showCount: false,
    speed: 'fast'
    });
	
	$( '#wd_content_categories a' ).click(function( event ) {		  
            if( $(event.target).hasClass('dcjq-icon') || $(event.target).hasClass('not-link') ){
				return false;
			}
	});
	
	</script>

<?php $this->addBottom(ob_get_clean()); ?>