
<div id="youtube_grid">

<?php $items = explode("\n", $value); ?>

<?php if(!empty($items)){ ?>

<?php foreach($items as $item){ ?>
<div>
 <div class="js-lazyYT" data-youtube-id="<?php echo str_replace('https://youtu.be/', '', $item); ?>"></div>
</div>
<?php } ?>

<?php } ?>


</div>


<style>

<?php if(count($items) > 1){ ?>

#youtube_grid .html5-info-bar{
	display:none !important;
}
#youtube_grid{
	display:flex;
	flex-wrap:wrap;
	width:calc(100% + 15px);
}
#youtube_grid > div{
	padding:15px;
	min-width:50%;
	max-width:50%;	
	overflow:hidden;
	box-sizing:border-box;
}


@media (max-width: 992px) {
#youtube_grid{
	width:100%;
}	
#youtube_grid > div{
	padding:10px 0;
	min-width:100%;
	max-width:100%;	
}


	
}

<?php } ?>
</style>

	<?php ob_start(); ?>
	<script>
		 $( document ).ready(function() {
      
            $('#youtube_grid .js-lazyYT').lazyYT({
              loading_text: '',
              default_ratio: '16:9'
            });
        });
	</script>
	<?php $template->addBottom(ob_get_clean()); ?>
