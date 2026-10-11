<div id="field_gm_images_<?php echo $this->name; ?>">

<?php  if($has_first_image){ ?>
<div class="gm_images_first owl-carousel owl-theme nm-owl mb-1">  
   <?php
		   
		foreach($images as $key => $paths){

            if (!isset($paths[$normal_preset])){ continue; }

            $title = (empty($this->item['title']) ? $this->name : $this->item['title']);

      

            if(!empty($paths['original']) &&  strtolower(pathinfo($paths['original'], PATHINFO_EXTENSION)) === 'gif'){
                echo html_gif_image($paths, 'small', $title.' '.$key, array('class'=>'gm_images_first_img-'.$this->getName()));
            } else {
                echo '<a title="'.html($title, false).'" class="gm_images_first_img-'.$this->getName().'" href="'.html_image_src($paths, $normal_preset, true).'">'.html_image($paths, $small_preset, $title.' '.$key, ['class' => 'gm_images_first-thumbnail']).'</a>';
            }

        }
		
			
	?>
</div>
<?php } ?>

<div class="gm_images_list owl-carousel owl-theme nm-owl">
	<?php            

        foreach($images as $key => $paths){

            if (!isset($paths[$normal_preset])){ continue; }

            $title = (empty($this->item['title']) ? $this->name : $this->item['title']);

      

            if(!empty($paths['original']) &&  strtolower(pathinfo($paths['original'], PATHINFO_EXTENSION)) === 'gif'){
                echo html_gif_image($paths, 'small', $title.' '.$key, array('class'=>'gm_images_list_img-'.$this->getName()));
            } else {
                echo '<a title="'.html($title, false).'" class="gm_images_list_img-'.$this->getName().'" href="'.html_image_src($paths, $normal_preset, true).'">'.html_image($paths, $small_preset, $title.' '.$key, ['class' => 'gm_images_list-thumbnail']).'</a>';
            }

        }
		
    ?>
</div>

</div>


<style>
.gm_images_list .owl-item.active.current{
	opacity:0.4;
}
</style>


<?php ob_start(); ?>

<script>

  var slidesPerPage = 5; 
  
<?php  if($has_first_image){ ?>

  var sync1 = $('#field_gm_images_<?php echo $this->name; ?> .gm_images_first');
  var sync2 = $('#field_gm_images_<?php echo $this->name; ?> .gm_images_list');
  var syncedSecondary = true;


    sync1.owlCarousel({
        items: 1,
        slideSpeed: 2000,
        nav: true,
        autoplay: false, 
        dots: false,
        loop: true,
        responsiveRefreshRate: 200,
        navText: ['<svg width="100%" height="100%" viewBox="0 0 11 20"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M9.554,1.001l-8.607,8.607l8.607,8.606"/></svg>', '<svg width="100%" height="100%" viewBox="0 0 11 20" version="1.1"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M1.054,18.214l8.606,-8.606l-8.606,-8.607"/></svg>'],
    }).on('changed.owl.carousel', syncPosition);

    sync2
        .on('initialized.owl.carousel', function() {
            sync2.find(".owl-item").eq(0).addClass("current");
        })
        .owlCarousel({
            items: slidesPerPage,
            dots: false,
            nav: true,
            smartSpeed: 200,
            slideSpeed: 500,
            slideBy: slidesPerPage, 
            responsiveRefreshRate: 100,    
			margin:1,
			   navText: ['<svg width="100%" height="100%" viewBox="0 0 11 20"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M9.554,1.001l-8.607,8.607l8.607,8.606"/></svg>', '<svg width="100%" height="100%" viewBox="0 0 11 20" version="1.1"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M1.054,18.214l8.606,-8.606l-8.606,-8.607"/></svg>'],

            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 3			
                },
                768: {
                    items: 3
                },
                992: {
                    items: 4
                },
                1200: {
                    items: slidesPerPage
                }
			}
        }).on('changed.owl.carousel', syncPosition2);

    function syncPosition(el) {
        //if you set loop to false, you have to restore this next line
        //var current = el.item.index;

        //if you disable loop you have to comment this block
        var count = el.item.count - 1;
        var current = Math.round(el.item.index - (el.item.count / 2) - .5);

        if (current < 0) {
            current = count;
        }
        if (current > count) {
            current = 0;
        }

        //end block

        sync2
            .find(".owl-item")
            .removeClass("current")
            .eq(current)
            .addClass("current");
        var onscreen = sync2.find('.owl-item.active').length - 1;
        var start = sync2.find('.owl-item.active').first().index();
        var end = sync2.find('.owl-item.active').last().index();

        if (current > end) {
            sync2.data('owl.carousel').to(current, 100, true);
        }
        if (current < start) {
            sync2.data('owl.carousel').to(current - onscreen, 100, true);
        }
    }

    function syncPosition2(el) {
        if (syncedSecondary) {
            var number = el.item.index;
            sync1.data('owl.carousel').to(number, 100, true);
        }
    }

    sync2.on("click", ".owl-item", function(e) {
        e.preventDefault();
        var number = $(this).index();
        sync1.data('owl.carousel').to(number, 300, true);
    });
	


<?php }else{ ?>

		$('#field_gm_images_<?php echo $this->name; ?> .gm_images_list').owlCarousel({
			
	        smartSpeed:1000,
			autoplay:false,
            loop: false,			
            rewind : 1,
            margin:1,
            dots: false,      
            nav: 1,            
            items:slidesPerPage,
      navText: ['<svg width="100%" height="100%" viewBox="0 0 11 20"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M9.554,1.001l-8.607,8.607l8.607,8.606"/></svg>', '<svg width="100%" height="100%" viewBox="0 0 11 20" version="1.1"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M1.054,18.214l8.606,-8.606l-8.606,-8.607"/></svg>'],

	
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2			
                },
                768: {
                    items: 3
                },
                992: {
                    items: 4
                },
                1200: {
                    items: slidesPerPage
                }
			}

		  
        });
		
		
		
<?php } ?>		
		
</script>


<?php $template->addBottom(ob_get_clean()); ?>