<?php $animate_classes = ''; $animate_attr = ''; ?>
<?php
$widget_options = $widget['options'] ?? [];
if (is_string($widget_options)) {
    $widget_options = cmsModel::yamlToArray($widget_options);
}
$nm_options = is_array($widget_options) ? ($widget_options['nm'] ?? []) : [];
$widget['nm_options'] = is_array($nm_options) ? $nm_options : [];
$animate = !empty($widget['nm_options']['animate']) ? true : false;
?>
<?php if($animate){ ?>
<?php $animate_classes = " {$widget['nm_options']['animate']} wow"; ?>
<?php $animate_attr = ' data-wow-duration="'.$widget['nm_options']['animation_duration'].'" data-wow-delay="'.$widget['nm_options']['animation_delay'].'" data-wow-offset="'.$widget['nm_options']['animation_offset'].'" data-wow-iteration="'.$widget['nm_options']['animation_iteration'].'"'; ?>
<?php } ?>

<div class="icms-widget mb-3 mb-md-4<?php if ($widget['class_wrap']) { ?> <?php echo $widget['class_wrap'];  } ?> icms_widget_<?php echo $widget['bind_id']; ?><?php echo $animate_classes; ?>" id="widget_wrapper_<?php echo $widget['id']; ?>"<?php echo $animate_attr; ?>>
    <?php echo $widget['body']; ?>
</div>


<?php if(!empty( $widget['nm_options'] )){ ?>
<?php $op = $widget['nm_options']; ?>
<style>
.icms_widget_<?php echo $widget['bind_id']; ?>{
<?php if(!empty( $op['bgcolor'] )){ ?>
        background-color:<?php echo $op['bgcolor']; ?> !important;
<?php } ?>
<?php if(!empty( $op['bg'] )){ ?>
        background-image:url(/upload/<?php echo $op['bg']['original']; ?>) !important;
		background-position:center center !important;
		background-size:cover !important;
		background-repeat:no-repeat !important;
<?php } ?>
<?php if(!empty( $op['bg_fixed'] )){ ?>
        background-attachment:fixed !important;
<?php } ?>
<?php if(!empty( $op['padding'] )){ ?>
        padding:<?php echo $op['padding']; ?>rem !important;
<?php } ?>
}
<?php if(!empty( $op['textscolor'] )){ ?>
.icms_widget_<?php echo $widget['bind_id']; ?> *{
        color:<?php echo $op['textscolor']; ?> !important;
}
<?php } ?>
<?php if(!empty( $op['linkscolor'] )){ ?>
.icms_widget_<?php echo $widget['bind_id']; ?> a{
        color:<?php echo $op['linkscolor']; ?> !important;
}
<?php } ?>

<?php if(!empty( $op['btncolor'] ) || !empty( $op['btnbgcolor'] )){ ?>
.icms_widget_<?php echo $widget['bind_id']; ?> .btn{
<?php if(!empty( $op['btnbgcolor'] )){ ?>
        background:<?php echo $op['btnbgcolor']; ?> !important;
        border-color:<?php echo $op['btnbgcolor']; ?> !important;
<?php } ?>		
<?php if(!empty( $op['btncolor'] )){ ?>
        color:<?php echo $op['btncolor']; ?> !important;
<?php } ?>		
}

<?php } ?>


<?php if (!empty($op['bgoverlay'])) { ?> 
.icms_widget_<?php echo $widget['bind_id']; ?>:before{
	background:<?php echo $op['bgoverlay']; ?>;
	content:"";
	display:block;
	top:0;
	left:0;
	right:0;
	bottom:0;
	position:absolute;
	z-index:1;	
}
<?php } ?>
.icms_widget_<?php echo $widget['bind_id']; ?> > *{	
    position:relative;
	z-index:3;
}

</style>
<?php } ?>