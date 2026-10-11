<?php 
    
    $rdiv = array(
	'bg-light');
    
?>
        <div class="mb-n2 mt-n2 row row-cols-2 row-cols-md-3 row-cols-lg-4 nm_media_tiles">
            <?php foreach($cats as $c){ ?>
<?php $rand_keys = array_rand($rdiv, 1);  ?>
                <div class="col mb-2 pl-2 pr-2 <?php echo $c['list_params']['class']; ?>">
                    <div class="card border-0 h-100 bg-light">
					
<div class="card-image">
                        <?php if($c['img_src']){ ?>
							    <a href="<?php echo href_to($ctype_name, $c['slug']); ?>" class="card-image-img style-image-overlay" style="background:url(<?php echo $c['img_src']; ?>)"></a>
                        <?php }else{ ?>
						   <div class="card-image-img <?php echo $rdiv[$rand_keys]; ?>"></div>
						<?php } ?>
                 
                           <a href="<?php echo href_to($ctype_name, $c['slug']); ?>" class="fields d-flex align-items-end h-100 p-3"><h2 class="h5 card-title m-0 p-0<?php if($c['img_src']){ ?> text-white<?php } ?>"><?php echo $c['title']; ?></h2></a>
                               
                         
</div>						
                    </div>
                </div>
            <?php } ?>
        </div>