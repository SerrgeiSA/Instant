
        <?php $this->addTplJSName('jquery.youtube-background.min', true); ?>
		

<?php
       $parent_css = 'd-flex flex-column';
if(!empty($widget->options['style_css_parent'])){ 
       $parent_css.= ' '.$widget->options['style_css_parent']; 
}
if(!empty($widget->options['style_align'])){ 
       $parent_css.= ' '.$widget->options['style_align']; 
}
if(!empty($widget->options['style_valign'])){ 
       $parent_css.= ' '.$widget->options['style_valign']; 
}
if($parent_css){
	   $parent_css = ' class="'.$parent_css.'"';
}

 ?>

<<?php echo $widget->options['parent_tag']; ?><?php echo $parent_css; ?> id="wd_head_<?php echo $widget->bind_id; ?>">


		<?php if(!empty($widget->options['style_video'])){ ?><div data-vbg="<?php echo $widget->options['style_video']; ?>"></div><?php } ?>

<?php if(!empty($widget->options['link'])){ ?>
<a href="<?php echo $widget->options['link']; ?>"<?php if(!empty($widget->options['link_blank'])){ ?>  target="_blank"<?php } ?>>
<?php } ?>
			
		<?php if(!empty($widget->options['title'])){ ?>
		
        <<?php echo $widget->options['tag']; ?> class="wd_head_title"><?php echo $widget->options['title']; ?></<?php echo $widget->options['tag']; ?>>
		
		<?php } ?>
<?php if(!empty($widget->options['link'])){ ?>
</a>
<?php } ?>

<?php if(!empty($widget->options['teaser'])){ ?>
          <div class="wd_head_teaser<?php echo !empty($widget->options['teaser_css']) ? ' '.$widget->options['teaser_css'] : ''; ?>"><?php echo $widget->options['teaser']; ?></div>
<?php } ?>

<?php if(!empty($widget->options['button'])){ ?>
          <div class="wd_head_button"><a href="<?php echo $widget->options['button_link']; ?>" class="<?php echo $widget->options['button_class']; ?>"<?php if(!empty($widget->options['button_link_blank'])){ ?>  target="_blank"<?php } ?>><?php echo $widget->options['button']; ?></a></div>
<?php } ?>

</<?php echo $widget->options['parent_tag']; ?>>


<style>

#wd_head_<?php echo $widget->bind_id; ?>{
	
	   overflow:hidden;

       position:relative;
	   box-sizing:border-box;
	
<?php if(!empty($widget->options['style_radius'])){ ?>
       border-radius:<?php echo $widget->options['style_radius']; ?>px; 
<?php } ?>

<?php if(!empty($widget->options['style_height'])){ ?>
       min-height:<?php echo $widget->options['style_height']; ?>px; 
<?php } ?>

<?php if(!empty($widget->options['style_cover'])){ ?>
       background:url(/upload/<?php echo $widget->options['style_cover']['original']; ?>) center center no-repeat; 
	   background-size:cover;
<?php } ?>

<?php if(!empty($widget->options['style_padding_y'])){ ?>
       padding-top:<?php echo $widget->options['style_padding_y']; ?>px !important; 
       padding-bottom:<?php echo $widget->options['style_padding_y']; ?>px !important; 
<?php } ?>
<?php if(!empty($widget->options['style_padding_x'])){ ?>
       padding-left:<?php echo $widget->options['style_padding_x']; ?>px !important; 
       padding-right:<?php echo $widget->options['style_padding_x']; ?>px !important; 
<?php } ?>

}

#wd_head_<?php echo $widget->bind_id; ?> *{
	position:relative;
	z-index:3;
}

#wd_head_<?php echo $widget->bind_id; ?>:before{
	  content:"";
	  position:absolute;
	  top:0;
	  left:0;
	  right:0;
	  bottom:0;
	  display:block;
	  z-index:1;
<?php if(!empty($widget->options['style_bgcolor']) && empty($widget->options['style_bgcolor2'])){ ?>
       background:<?php echo $widget->options['style_bgcolor']; ?>; 
<?php }else if(!empty($widget->options['style_bgcolor']) && !empty($widget->options['style_bgcolor2'])){ ?>
       background:linear-gradient(<?php echo $widget->options['style_bgcolor']; ?>,<?php echo $widget->options['style_bgcolor2']; ?>); 
<?php } ?>
<?php if(!empty($widget->options['style_bg_opacity'])){ ?>
       opacity:<?php echo $widget->options['style_bg_opacity']; ?>%;
<?php } ?>

}

#wd_head_<?php echo $widget->bind_id; ?> .wd_head_title{
	margin:0 !important;
	padding:0 !important;
	
<?php if(!empty($widget->options['style_color'])){ ?>
       color:<?php echo $widget->options['style_color']; ?> !important; 
<?php } ?>
<?php if(!empty($widget->options['style_size'])){ ?>
       font-size:<?php echo $widget->options['style_size']; ?>px !important; 
<?php } ?>

}


#wd_head_<?php echo $widget->bind_id; ?> .wd_head_teaser{
	<?php if(!empty($widget->options['style_color_teaser'])){ ?>
       color:<?php echo $widget->options['style_color_teaser']; ?> !important; 
	<?php } ?>
	<?php if(!empty($widget->options['style_teaser_size'])){ ?>
       font-size:<?php echo $widget->options['style_teaser_size']; ?>px !important; 
	<?php } ?>
	<?php if(!empty($widget->options['teaser_mt'])){ ?>
       margin-top:<?php echo $widget->options['teaser_mt']; ?>px !important; 
	<?php } ?>
}


#wd_head_<?php echo $widget->bind_id; ?> .wd_head_button{
	<?php if(!empty($widget->options['button_mt'])){ ?>
       margin-top:<?php echo $widget->options['button_mt']; ?>px !important; 
	<?php } ?>
}
#wd_head_<?php echo $widget->bind_id; ?> .wd_head_button a{
	<?php if(!empty($widget->options['button_bgcolor'])){ ?>
       background:<?php echo $widget->options['button_bgcolor']; ?> !important; 
	<?php } ?>
	<?php if(!empty($widget->options['button_textcolor'])){ ?>
       color:<?php echo $widget->options['button_textcolor']; ?> !important; 
	<?php } ?>
	<?php if(!empty($widget->options['button_textsize'])){ ?>
       font-size:<?php echo $widget->options['button_textsize']; ?>px !important; 
	<?php } ?>
	<?php if(!empty($widget->options['button_padding'])){ ?>
       padding:<?php echo $widget->options['button_padding']; ?> !important; 
	<?php } ?>
	<?php if(!empty($widget->options['button_borders'])){ ?>
       border-radius:<?php echo $widget->options['button_borders']; ?>px !important; 
	<?php } ?>
	transition:all 0.3s auto;
}
#wd_head_<?php echo $widget->bind_id; ?> .wd_head_button a:hover{
	<?php if(!empty($widget->options['button_bgcolor_hover'])){ ?>
       background:<?php echo $widget->options['button_bgcolor_hover']; ?> !important; 
	<?php } ?>
}


	<?php if(!empty($widget->options['style_maxwidth'])){ ?>
	
#wd_head_<?php echo $widget->bind_id; ?> .wd_head_title,
#wd_head_<?php echo $widget->bind_id; ?> .wd_head_teaser{
       max-width:<?php echo $widget->options['style_maxwidth']; ?>px; 
	}
	
	<?php } ?>

	<?php if(!empty($widget->options['style_center'])){ ?>
	
#wd_head_<?php echo $widget->bind_id; ?> .wd_head_title,
#wd_head_<?php echo $widget->bind_id; ?> .wd_head_teaser{
       text-align:center; 
	}
	
	<?php } ?>








@media (max-width: 991px) {
	
	#wd_head_<?php echo $widget->bind_id; ?>{
<?php if(!empty($widget->options['style_height_mob'])){ ?>
       min-height:<?php echo $widget->options['style_height_mob']; ?>px !important; 
<?php } ?>
<?php if(!empty($widget->options['style_padding_mob'])){ ?>
       padding:<?php echo $widget->options['style_padding_mob']; ?>px !important; 
<?php } ?>
    }
	
	#wd_head_<?php echo $widget->bind_id; ?> .wd_head_title{
<?php if(!empty($widget->options['style_size_mob'])){ ?>
       font-size:<?php echo $widget->options['style_size_mob']; ?>px !important; 
<?php } ?>
    }
	
	
#wd_head_<?php echo $widget->bind_id; ?> .wd_head_teaser{
	<?php if(!empty($widget->options['style_teaser_size_mob'])){ ?>
       font-size:<?php echo $widget->options['style_teaser_size_mob']; ?>px !important; 
	<?php } ?>
	<?php if(!empty($widget->options['teaser_mt_mob'])){ ?>
       margin-top:<?php echo $widget->options['teaser_mt_mob']; ?>px !important; 
	<?php } ?>
}


#wd_head_<?php echo $widget->bind_id; ?> .wd_head_button a{
	<?php if(!empty($widget->options['button_textsize_mob'])){ ?>
       font-size:<?php echo $widget->options['button_textsize_mob']; ?>px !important; 
	<?php } ?>	
	<?php if(!empty($widget->options['button_padding_mob'])){ ?>
       padding:<?php echo $widget->options['button_padding_mob']; ?> !important; 
	<?php } ?>
}



}

    #wd_head_<?php echo $widget->bind_id; ?> div[data-vbg]{
	
	}
	#wd_head_<?php echo $widget->bind_id; ?> iframe {
			transition: opacity 500ms ease-in-out;
			transition-delay: 250ms;
		}
		
		
</style>

<?php ob_start(); ?>
<script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery('#wd_head_<?php echo $widget->bind_id; ?> [data-vbg]').youtube_background(
			{
				loop:true,
			}
			);
        });
</script>
    <?php $this->addBottom(ob_get_clean()); ?>	