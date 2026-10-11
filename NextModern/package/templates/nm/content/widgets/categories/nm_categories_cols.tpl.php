
<?php
    //Включает цветные блоки
    $is_colors_avatars = $cover_preset;
    
	//Стили для блоков одного цвета
    $rdiv = array(
	'bg-primary text-white');
    
?>
<div class="cats_cols row">

  
	   
	  <?php 
	  
	  
	  foreach($cats as $c){ if($c['parent_id']==1){ ?>	

<?php
$rand_keys = array_rand($rdiv, 1); 
 ?>	  
	  
<div class="cats_cols__col col-sm-12 col-md-6 col-xl-4">	
<h6 class="d-flex align-items-center">

                        <?php if($c['img_src']){ ?>
						<a href="<?php echo href_to($ctype_name, $c['slug']); ?>" class="cats_cols-image mr-2 d-flex align-items-center"><img src="<?php echo $c['img_src']; ?>" alt="<?php echo $c['title']; ?>"></a>
                        <?php }else{ ?>
						   <div class="cats_cols-image d-flex align-items-center justify-content-center mr-2<?php echo !$is_colors_avatars ? ' '.$rdiv[$rand_keys] : ''; ?>"><?php echo $is_colors_avatars ? html_avatar_image_empty($c['title']) : htmlspecialchars(mb_substr($c['title'], 0, 1)); ?></div>
						<?php } ?>
						
             <a href="<?php echo href_to($ctype_name, $c['slug']); ?>" class="cats_cols-title d-flex h6" title="<?php echo $c['title']; ?>"><span><?php echo $c['title']; ?></span></a>
</h4>			 
</div>   
    
	<?php
        } }
    ?>



</div>

		
<style>
.cats_cols-image{
	min-width:48px;
	width:48px;
	height:48px;
}
.cats_cols-title {
  text-overflow:ellipsis;
  overflow:hidden;
  display: -webkit-box !important;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  white-space: normal;
}
</style>
