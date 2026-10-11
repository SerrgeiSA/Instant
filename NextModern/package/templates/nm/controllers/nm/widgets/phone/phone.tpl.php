<a class="d-inline-flex align-items-center" href="tel:<?php echo $widget->options['link']; ?>" target="_blank" id="phone_<?php echo $widget->bind_id; ?>">
		
		<?php 
		$icon = !empty($widget->options['icon']) ? (mb_strstr($widget->options['icon'], ':') ? explode(':', $widget->options['icon']) : $widget->options['icon']) : false;	
		
		
		if($icon){ ?>
		<span>
		            <?php
						if(is_array($icon)){
						echo html_svg_icon($icon[0], $icon[1]);
						}else{
						echo html_svg_icon('solid', $icon);	
						} 
					?>
		</span>						
		<?php
		} 		
		?>
		
		<?php if(!empty($widget->options['phone'])){ ?>
		
        <span<?php if($icon){ ?> class="ml-2"<?php } ?>><?php echo $widget->options['phone']; ?></span>
		
		<?php } ?>

</a>

<?php if(!empty($widget->options['text-color'])){ ?>

<style>

#phone_<?php echo $widget->bind_id; ?>{
color:<?php echo $widget->options['text-color']; ?> !important;
}
#phone_<?php echo $widget->bind_id; ?> svg{
fill:<?php echo $widget->options['text-color']; ?> !important;
}

#phone_<?php echo $widget->bind_id; ?>:hover{
color:<?php echo $widget->options['text-color-hover']; ?> !important;
}
#phone_<?php echo $widget->bind_id; ?>:hover svg{
fill:<?php echo $widget->options['text-color-hover']; ?> !important;
}


</style>

<?php } ?>