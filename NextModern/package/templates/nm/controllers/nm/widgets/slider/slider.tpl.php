<div class="<?php echo $widget->options['wrap_class']; ?> wd-icons-<?php echo $widget->bind_id; ?> 
<?php $cols = !empty($widget->options['style']) && $widget->options['style'] !== 'list' ? str_replace(array('cols','tiles'),array('',''),$widget->options['style']) : false; ?>
<?php $cols_md = !empty($widget->options['style_md']) ? str_replace(array('cols','tiles'),array('',''),$widget->options['style_md']) : 2; ?>
<?php $cols_sm = !empty($widget->options['style_sm']) ? str_replace(array('cols','tiles'),array('',''),$widget->options['style_sm']) : 1; ?>
<?php if(!empty($widget->options['style']) && !empty($cols)){ ?>
row row-cols-<?php echo $cols_sm; ?> row-cols-md-<?php echo $cols_md; ?> row-cols-lg-<?php echo $cols; ?>
<?php } ?>
">

<?php foreach($widget->options['list'] as $item){ ?>

<?php if(!empty($item['is_hidden'])){ continue; } ?>

	<?php 
    $title  = !empty($item['title']) ? $item['title'] : '';
    $teaser  = !empty($item['teaser']) ? $item['teaser'] : '';
	$link  = !empty($item['link']) ? $item['link'] : '';
	$hint  = !empty($item['title']) ? ' title="'.$item['title'].'"' : '';
	$link_blank  = !empty($item['link_target']) && $item['link_target'] =='blank' ? ' target="_blank"' : '';
	
	$style_class = $cols ? 'col ' : ''; 
	
	$class  = !empty($item['class']) ? ' class="'.$style_class.'list-item '.$widget->options['buttons_class'].' '.$item['class'].'"' :  (!empty($widget->options['buttons_class']) ? ' class="'.$style_class.'list-item '.$widget->options['buttons_class'].'"' : '');
   
   $icon = !empty($item['icon']) ? (mb_strstr($item['icon'], ':') ? explode(':', $item['icon']) : $item['icon']) : false;	
	$svg = !empty($item['svg']) ? $item['svg'] : false;
	
	?>
	
	<?php if($link){ ?>
	<a href="<?php echo $link; ?>"<?php echo $link_blank; ?><?php echo $class; ?><?php echo $hint; ?>>
	<?php }else{ ?>
	<div<?php echo $class; ?>>
	<?php } ?>
	
	<?php if($icon || $svg){ ?>

		    <span<?php echo !empty($widget->options['icon_wrap_class']) ? ' class="list-icon '.$widget->options['icon_wrap_class'].'"' : ' class="list-icon"'; ?>>
			<?php echo $icon ? html_svg_icon($icon[0], $icon[1]) : $svg; ?>
			</span>

    <?php } ?>
	
	<?php if(!empty($item['show_title']) && $title){ ?>	 
	        <div>
		    <span<?php echo !empty($widget->options['title_class']) ? ' class="list-title '.$widget->options['title_class'].'"' : ' class="list-title"'; ?>>
			<?php echo $title; ?>			
			</span>
	<?php if(!empty($item['show_teaser']) && $teaser){ ?>	 
		    <p<?php echo !empty($widget->options['teaser_class']) ? ' class="list-teaser '.$widget->options['teaser_class'].'"' : ' class="list-teaser"'; ?>><?php echo $teaser; ?></p>
	<?php } ?>
			</div>
	<?php } ?>
	
	<?php if($link){ ?>
	</a>
	<?php }else{ ?>
	</div>
	<?php } ?>

<?php } ?>

</div>

<style>

<?php if(!empty($widget->options['style']) && $widget->options['style'] == 'list'){ ?>
.wd-icons-<?php echo $widget->bind_id; ?>{
	display:block !important;
}
<?php } ?>
.wd-icons-<?php echo $widget->bind_id; ?> div.btn{
	cursor:default !important;
}

.wd-icons-<?php echo $widget->bind_id; ?> svg{
	width:<?php echo $widget->options['buttons_size']; ?>px;
	height:<?php echo $widget->options['buttons_size']; ?>px;
	<?php if(!empty($widget->options['svg_color'])){ ?>
	fill:<?php echo $widget->options['svg_color']; ?> !important;
	<?php } ?>
}

	<?php if(!empty($widget->options['title_color'])){ ?>
.wd-icons-<?php echo $widget->bind_id; ?> .list-title{	
	color:<?php echo $widget->options['title_color']; ?> !important;
}
	<?php } ?>
	
	<?php if(!empty($widget->options['teaser_color'])){ ?>
.wd-icons-<?php echo $widget->bind_id; ?> .list-teaser{	
	color:<?php echo $widget->options['teaser_color']; ?> !important;
}
	<?php } ?>
	
	<?php if(!empty($widget->options['content_align']) && $widget->options['content_align']=='left'){ ?>

.wd-icons-<?php echo $widget->bind_id; ?> .list-item{
	align-items:start !important;
}
.wd-icons-<?php echo $widget->bind_id; ?> .list-item,
.wd-icons-<?php echo $widget->bind_id; ?> .list-item *{
	text-align:left !important;
}

    <?php } ?>
	
	<?php if(!empty($widget->options['icon_pos']) && $widget->options['icon_pos']=='top'){ ?>

.wd-icons-<?php echo $widget->bind_id; ?> .list-item{
	flex-direction:column !important;
}

    <?php } ?>
	
	<?php if(!empty($widget->options['svg_color_hover'])){ ?>
	.wd-icons-<?php echo $widget->bind_id; ?> .list-item:hover svg{
		fill:<?php echo $widget->options['svg_color_hover']; ?> !important;
        
	}
	<?php } ?>
	
	<?php if(!empty($widget->options['title_color_hover'])){ ?>
	.wd-icons-<?php echo $widget->bind_id; ?> .list-item:hover .list-title{
		color:<?php echo $widget->options['title_color_hover']; ?> !important;
        
	}
	<?php } ?>
	
	<?php if(!empty($widget->options['teaser_color_hover'])){ ?>
	.wd-icons-<?php echo $widget->bind_id; ?> .list-item:hover .list-teaser{
		color:<?php echo $widget->options['teaser_color_hover']; ?> !important;
        
	}
	<?php } ?>
	
</style>

