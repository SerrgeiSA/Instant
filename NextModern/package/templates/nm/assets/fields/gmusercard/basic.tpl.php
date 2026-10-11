<div class="nm_usercard_basic card border-0" style="background:<?php echo $this->options['bgcolor']; ?>;margin-top:<?php echo $this->options['card_mt']; ?>px;margin-bottom:<?php echo $this->options['card_mb']; ?>px;">

        <?php $url = href_to_profile($profile); ?>

     <div class="media p-4">

         
	
                <a href="<?php echo $url; ?>" class="icms-user-avatar mr-4 <?php if (!empty($profile['is_online'])){ ?>peer_online<?php } else { ?>peer_no_online<?php } ?>" title="<?php html($profile['nickname']); ?>">
                <?php if($profile['avatar']){ ?>
                    <?php echo html_avatar_image($profile['avatar'], $this->options['avatar_preset'], $profile['nickname']); ?>
                <?php } else { ?>
                    <?php echo html_avatar_image_empty($profile['nickname'], 'avatar__inlist'); ?>
                <?php } ?>
                </a>
        
      
		
                <div class="media-body">
				
                    <?php if (!empty($profile['nickname'])){ ?>
                        <<?php echo $this->options['title_tag']; ?> class="my-0">
                            <a href="<?php echo $url; ?>">
                                <?php html($profile['nickname']); ?>
                            </a>
                        </<?php echo $this->options['title_tag']; ?>>
                    <?php } ?>
					
					<p class="mt-2"><?php html($profile[$this->options['field_about']]); ?></p>
   
                </div>
         
     
	 
	 </div>

</div>

<style>

.nm_usercard_basic .icms-user-avatar>*{
	width:101px;
}

@media screen and (max-width: 768px) {
	
.nm_usercard_basic .media{
 flex-direction:column;
}
.nm_usercard_basic .icms-user-avatar{
	margin-bottom:0.5rem;
}
.nm_usercard_basic .icms-user-avatar>*{
	width:64px;
}

}
</style>