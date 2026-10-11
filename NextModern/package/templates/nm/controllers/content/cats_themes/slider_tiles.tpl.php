
<?php $this->addTplJSNameFromContext('vendors/slick/slick.min'); ?>
<?php $this->addTplCSSNameFromContext('slick'); ?>
<?php 
    
    $rdiv ='bg-light';
    
?>

<div class="h_slider_wrap">
        <div class="d-flex flex-nowrap nm_media_tiles h_slider mt-n2" id="cats_cards_slider">
            <?php foreach($cats as $c){ ?>
                    <div class="card border-0 bg-light<?php if (!empty($category['title']) && $category['title'] == $c['title']){ ?> is-active<?php }else if(empty($category['title']) && $c==reset($cats)){ ?> is-active<?php } ?>">
					
<div class="card-image">
                        <?php if($c['list_params']['cover_img']){ ?>
							    <a href="<?php echo $c['list_params']['href']; ?>" class="card-image-img style-image-overlay" style="background:url(<?php echo $c['list_params']['cover_img']; ?>)"></a>
                        <?php }else{ ?>
						   <div class="card-image-img <?php echo $rdiv; ?>"></div>
						<?php } ?>
                 
                           <a href="<?php echo $c['list_params']['href']; ?>" class="fields d-flex align-items-end h-100 p-3"><h2 class="h6 card-title m-0 p-0<?php if($c['list_params']['cover_img']){ ?> text-white<?php } ?>"><?php echo $c['title']; ?></h2></a>
                               
                         
</div>						
                    </div>
       
            <?php } ?>
        </div>
</div>

<?php ob_start(); ?>
<script>
if(typeof catssslick === 'undefined'){
    var catssslick = icms.menu.initSwipe('#cats_cards_slider', {
		variableWidth: true, 
		arrows: true,
        nextArrow: '<button class="btn arrow-ext"><span class="btn bg-white rounded-circle"><?php echo html_svg_icon('solid','arrow-right'); ?></span></button>',
        prevArrow: '<button class="btn arrow-ext"><span class="btn bg-white rounded-circle"><?php echo html_svg_icon('solid','arrow-left'); ?></span></button>',
		responsive: [
                {breakpoint: 1024, settings:{slidesToShow: 6, slidesToScroll: 6}},
                {breakpoint: 650, settings: {slidesToShow: 3, slidesToScroll: 3}},
                {breakpoint: 320, settings: {slidesToShow: 2, slidesToScroll: 2}}
            ], initialSlide: $('#cats_cards_slider > .is-active').index()});
}
</script>
<?php $this->addBottom(ob_get_clean()); ?>	

<style>
#cats_cards_slider .card-title {
  text-overflow:ellipsis;
  overflow:hidden;
  display: -webkit-box !important;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  white-space: normal;
}
</style> 	 
   
