<?php $this->addTplJSNameFromContext('vendors/slick/slick.min'); ?>
<?php $this->addTplCSSNameFromContext('slick'); ?>


<div class="h_slider_wrap">
  <div class="d-flex flex-nowrap h_slider h_slider_inline mt-n2" id="wd_cats_slider">
            <?php foreach($cats as $idx=>$c){ if($c['parent_id']==1){  ?>
			
             <?php if ($c['is_active'] || !$c['is_active'] && $c==reset($cats)){ ?>
                    <a href="<?php echo href_to($ctype_name, $c['slug']); ?>" class="btn btn-primary text-truncate is-active"><?php echo $c['title']; ?>
                    </a>
             <?php }else{ ?>
			       <a href="<?php echo href_to($ctype_name, $c['slug']); ?>" class="btn btn-light text-truncate"><?php echo $c['title']; ?>
                    </a>
			 <?php } ?>
			 
            <?php } } ?>
    </div>
</div>	

<?php ob_start(); ?>
<script>
if(typeof catssslick === 'undefined'){
    var catssslick = icms.menu.initSwipe('#wd_cats_slider', {
		
		variableWidth: true, 
		
		arrows: true,
        nextArrow: '<button class="btn arrow-ext"><span class="btn bg-white rounded-circle"><?php echo html_svg_icon('solid','arrow-right'); ?></span></button>',
        prevArrow: '<button class="btn arrow-ext"><span class="btn bg-white rounded-circle"><?php echo html_svg_icon('solid','arrow-left'); ?></span></button>',
		
		responsive: [
                {breakpoint: 1024, settings:{slidesToShow: 6, slidesToScroll: 6}},
                {breakpoint: 650, settings: {slidesToShow: 3, slidesToScroll: 3}},
                {breakpoint: 320, settings: {slidesToShow: 2, slidesToScroll: 2}}
            ], initialSlide: $('#wd_cats_slider > .is-active').index()});
}
</script>
<?php $this->addBottom(ob_get_clean()); ?>		

   
