<?php
	$this->addCSS($this->getTplFilePath('controllers/showcase/css/cart.css', false));
?>

<div class="wd_sc_cart sc_style_icon wd_sc_cart_nm<?php if(!empty($widget->options['title'])){ ?> has-title<?php } ?>">
	
	<?php ob_start(); ?><script>icms.showcase.cart_styles.icon = 1;</script><?php $this->addBottom(ob_get_clean()); ?>
	
	<a class="wd_sc_cart_icon ajax-modal" href="<?php echo href_to('showcase', 'cart') ?>" rel="nofollow"<?php if (!empty($widget->options['color'])){ ?> style="color:<?php html($widget->options['color']); ?>"<?php } ?>>
	

	<?php echo html_svg_icon('solid', !empty($widget->options['fa']) ? $widget->options['fa'] : 'shopping-cart'); ?>	
	
		<?php if(!empty($widget->options['title'])){ ?>	
		
		<span class="ml-2"><?php echo $widget->options['title']; ?></span>
		
		<?php } ?>
		

		<div class="sc_cart_counter"><?php echo (isset($count) && $count) ? $count : '0'; ?></div>
	</a>

</div>