   
<div class="nm_sidemenu">

   <ul id="nm_categories_<?php echo $widget->bind_id; ?>">

        <?php $last_level = 0; ?>

        <?php foreach($cats as $item){ ?>

            <?php for ($i=0; $i<($last_level - $item['ns_level']); $i++) { ?>
                </li></ul>
            <?php } ?>

            <?php if ($item['ns_level'] <= $last_level) { ?>
                </li>
            <?php } ?>

            <li class="<?php if ($item['is_hidden']) { ?> d-none<?php } ?>">

                <a class="<?php if ($item['is_active']) { ?>active<?php } ?>" href="<?php echo href_to($ctype_name, $item['slug']); ?>">                
                       <span class="nm_mobmenu-text"><?php echo html($item['title']); ?></span>
			
				
                </a>

                <?php if ($item['childs_count']) { ?><ul class="submenu"><?php } ?>

                <?php $last_level = $item['ns_level']; ?>

        <?php } ?>

    <?php for ($i=0; $i<$last_level; $i++) { ?>
        </li></ul>
    <?php } ?>
	
</div>


<style>
	#nm_categories_<?php echo $widget->bind_id; ?> a{
		color:var(--nm-links-color);
	}
#nm_categories_<?php echo $widget->bind_id; ?> .dcjq-icon:before,
#nm_categories_<?php echo $widget->bind_id; ?> .dcjq-icon:after {
    background-color: var(--primary);
}
</style>
	
<?php ob_start(); ?>

	<script>
	
    $('#nm_categories_<?php echo $widget->bind_id; ?>').dcAccordion({
    eventType: 'click',
    autoClose: true,
    saveState: false,
    disableLink: false,
    showCount: false,
    speed: 'fast'
    });
	
	$( '#nm_categories_<?php echo $widget->bind_id; ?> a' ).click(function( event ) {		  
            if( $(event.target).hasClass('dcjq-icon') ){
				return false;
			}
	});
	
	</script>

<?php $this->addBottom(ob_get_clean()); ?>