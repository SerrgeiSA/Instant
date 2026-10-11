<?php $this->addTplJSNameFromContext('vendors/slick/slick.min'); ?>
<?php $this->addTplCSSNameFromContext('slick'); ?>


<div class="h_slider_wrap">
  <div class="d-flex flex-nowrap h_slider h_slider_inline mt-n2" id="cats_slider">
            <?php foreach($cats as $idx=>$c){ ?>
             
                    <a href="<?php echo $c['list_params']['href']; ?>" class="btn btn-light <?php if (!empty($category['title']) && $category['title'] == $c['title']){ ?> is-active<?php }else if(empty($category['title']) && $c==reset($cats)){ ?> is-active<?php } ?>  text-truncate"><?php echo $c['title']; ?>
                    </a>
             
            <?php } ?>
    </div>
</div>	

<?php ob_start(); ?>
<script>
if(typeof catssslick === 'undefined'){
    var catssslick = icms.menu.initSwipe('#cats_slider', {
		
		variableWidth: true, 
		
		arrows: true,
        nextArrow: '<button class="btn arrow-ext"><span class="btn bg-white rounded-circle"><?php echo html_svg_icon('solid','arrow-right'); ?></span></button>',
        prevArrow: '<button class="btn arrow-ext"><span class="btn bg-white rounded-circle"><?php echo html_svg_icon('solid','arrow-left'); ?></span></button>',
		
		responsive: [
                {breakpoint: 1024, settings:{slidesToShow: 6, slidesToScroll: 6}},
                {breakpoint: 650, settings: {slidesToShow: 3, slidesToScroll: 3}},
                {breakpoint: 320, settings: {slidesToShow: 2, slidesToScroll: 2}}
            ], initialSlide: $('#cats_slider > .is-active').index()});
}
</script>
<?php $this->addBottom(ob_get_clean()); ?>		 
   
