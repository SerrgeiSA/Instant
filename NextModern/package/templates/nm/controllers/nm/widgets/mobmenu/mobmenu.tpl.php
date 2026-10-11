<?php $user = $this->controller->cms_user; ?>
<?php $core = cmsCore::getInstance(); ?>
<?php $tm_options = cmsTemplate::getInstance()->options; ?>
<?php 
$logo = !empty($tm_options['logo']['original']) ? '/upload/'.$tm_options['logo']['original'] : (!empty($tm_options['logo_svg']['path']) ? '/upload/'.$tm_options['logo_svg']['path'] : '/templates/nm/images/logo.png');
$logo_sm = !empty($tm_options['logo_small']['original']) ? '/upload/'.$tm_options['logo_small']['original'] : (!empty($tm_options['logo_small_svg']['path']) ? '/upload/'.$tm_options['logo_small_svg']['path'] : '/templates/nm/images/small_logo.png');
 ?>


    <?php
        $nav_class = ['navbar p-0'];
    
        $site_name = html(cmsConfig::get('sitename'), false);
    ?>
    <nav class="<?php echo implode(' ', $nav_class); ?>" id="navbar_<?php echo $widget->bind_id; ?>">
        <?php if ($widget->options['toggler_icon']) { ?>
            <?php if ($widget->options['toggler_show_sitename'] && empty($widget->options['toggler_show_logo'])) { ?>
                <span class="navbar-brand icms-navbar-brand__show_on_hide">
                    <?php echo $site_name; ?>
                </span>
            <?php } ?>
            <?php if (!empty($widget->options['toggler_show_logo'])) { ?>
                <<?php if($core->uri) { ?>a href="<?php echo href_to_home(); ?>"<?php } else { ?>span<?php } ?> class="navbar-brand flex-shrink-0">
                    <img src="<?php echo $logo_sm; ?>" class="d-sm-none" alt="<?php echo $site_name; ?>">
                    <img src="<?php echo $logo; ?>" class="d-none d-sm-block" alt="<?php echo $site_name; ?>">
                    <?php if ($widget->options['toggler_show_sitename']) { ?>
                        <?php echo $site_name; ?>
                    <?php } ?>
                </<?php if($core->uri) { ?>a<?php } else { ?>span<?php } ?>>
            <?php } ?>
			
			
			<button class="btn nm-usermenu-toggle-btn morphing-icons d-none" type="button">
			
			<?php if($user->id) { ?>			
			 <i style="top:calc(50% - 16px) !important"><?php echo html_avatar_image($user->avatar, 'micro', $user->nickname); ?></i>
			<?php }else{ ?>
			 <i><?php echo html_svg_icon('solid', 'user-circle'); ?></i>
			<?php } ?>
			 
    <i><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
width="24" height="24"
viewBox="0 0 50 50"
style="fill:#fff;"><path d="M 9.15625 6.3125 L 6.3125 9.15625 L 22.15625 25 L 6.21875 40.96875 L 9.03125 43.78125 L 25 27.84375 L 40.9375 43.78125 L 43.78125 40.9375 L 27.84375 25 L 43.6875 9.15625 L 40.84375 6.3125 L 25 22.15625 Z"></path></svg></i>  
            </button>
			
            <?php if ($widget->options['show_search_form']) { ?>
			<button class="btn nm-search-toggle-btn morphing-icons d-none" type="button">
			 <i><svg xmlns="http://www.w3.org/2000/svg" class="w-24" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg></i>
    <i><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
width="24" height="24"
viewBox="0 0 50 50"><path d="M 9.15625 6.3125 L 6.3125 9.15625 L 22.15625 25 L 6.21875 40.96875 L 9.03125 43.78125 L 25 27.84375 L 40.9375 43.78125 L 43.78125 40.9375 L 27.84375 25 L 43.6875 9.15625 L 40.84375 6.3125 L 25 22.15625 Z"></path></svg></i>  
            </button>
			<?php } ?>
			
            <button class="navbar-toggler nm-toggle-btn collapsed" type="button" aria-label="<?php echo LANG_MENU; ?>" data-toggle="collapse" data-target="#target-<?php echo $widget->options['menu']; ?>">
               <span class="icon-left"></span>
                        <span class="icon-right"></span>
            </button>
        <?php } ?>
        <div class="collapse<?php if (!empty($widget->options['toggler_right_menu'])) { ?> ml-auto flex-grow-0<?php } ?> navbar-collapse<?php if (!$widget->options['navbar_expand']) { ?> show<?php } ?>" id="target-<?php echo $widget->options['menu']; ?>">
            <?php
                $navbar_class = ['navbar-nav'];
                if (!empty($widget->options['menu_nav_style'])) {
                    $navbar_class[] = $widget->options['menu_nav_style']. ' w-100';
                }
                if (!empty($widget->options['menu_nav_style_add'])) {
                    $navbar_class[] = $widget->options['menu_nav_style_add'];
                }
                if (!empty($widget->options['class'])) {
                    $navbar_class[] = $widget->options['class'];
                }
                if (empty($widget->options['navbar_expand'])) {
                    $navbar_class[] = 'flex-row icms-navbar-expanded';
                }

                $this->menu(
                    $widget->options['menu'],
                    $widget->options['is_detect'],
                    implode(' ', $navbar_class),
                    $widget->options['max_items'], empty($widget->options['is_detect_strict']),
                    'mainmenu_mob',
                    $widget->title
                );
            ?>
            <?php if ($widget->options['show_search_form']) { ?>
			<div class="d-flex align-items-center form_search_wrap">
			<button class="btn nm-nav-search-toggle-btn morphing-icons" type="button">	
  <i><svg xmlns="http://www.w3.org/2000/svg" class="w-24" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg></i>
    <i><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
width="24" height="24"
viewBox="0 0 50 50"><path d="M 9.15625 6.3125 L 6.3125 9.15625 L 22.15625 25 L 6.21875 40.96875 L 9.03125 43.78125 L 25 27.84375 L 40.9375 43.78125 L 43.78125 40.9375 L 27.84375 25 L 43.6875 9.15625 L 40.84375 6.3125 L 25 22.15625 Z"></path></svg></i>  
            </button>
		
                <form class="form-inline<?php if ($widget->options['show_search_form'] == 2) { ?> icms-navbar-form__show_on_hide<?php } ?>" action="<?php echo href_to('search'); ?>" method="get">
                
                        <?php echo html_input('text', 'q', '', ['placeholder'=>ERR_SEARCH_TITLE, 'autocomplete' => 'off']); ?>
                     
                            <button class="btn" type="submit"></button>
                     
              
                </form>
			</div>					
            <?php } ?>
        </div>
    </nav>

	
	
	<?php $styles = ''; ?>
	
	<?php 
	 $styles.= '#navbar_'.$widget->bind_id.' form[action="/search"] .form-control{background:none;}';	
	?>
	
	<?php if (!empty($widget->options['m_bg_color'])) { 
	 $styles.= '#navbar_'.$widget->bind_id.'{		
	    background:'.$widget->options['m_bg_color'].';				
	}';	
	 }  ?>
	
	<?php if (!empty($widget->options['m_links_color'])) {  
	$styles.= '#navbar_'.$widget->bind_id.' .navbar-nav > li > a, 
	#navbar_'.$widget->bind_id.' .form-control{
		color:'.$widget->options['m_links_color'].' !important;	
	}'; 
	$styles.= '#navbar_'.$widget->bind_id.' .navbar-nav > .nav-item > a   .nav-item-toggler:before, #navbar_'.$widget->bind_id.' .navbar-nav > .nav-item > a .nav-item-toggler:after{
		background-color:'.$widget->options['m_links_color'].';	
	}';
	$styles.= '#navbar_'.$widget->bind_id.' svg{			
	    fill:'.$widget->options['m_links_color'].' !important;			
	}';
	$styles.= '#navbar_'.$widget->bind_id.' svg[fill="none"]{			
	    fill:none !important;		
	    stroke:'.$widget->options['m_links_color'].' !important;			
	}';
    $styles.= '#navbar_'.$widget->bind_id.' .form-control::placeholder {
    color: '.$widget->options['m_links_color'].'; opacity:0.7; }';
	
    $styles.= '#navbar_'.$widget->bind_id.' .nm-toggle-btn.collapsed .icon-left,#navbar_'.$widget->bind_id.' .nm-toggle-btn.collapsed .icon-right, #navbar_'.$widget->bind_id.' .nm-toggle-btn .icon-left:before, #navbar_'.$widget->bind_id.' .nm-toggle-btn .icon-left:after, #navbar_'.$widget->bind_id.' .nm-toggle-btn .icon-right:before, #navbar_'.$widget->bind_id.' .nm-toggle-btn .icon-right:after {
    background-color: '.$widget->options['m_links_color'].'; }';
	
	} ?>
	
	
	
	
	
	
	<?php 
	// активные
	if (!empty($widget->options['m_active_color'])) {
		
	$styles.= '#navbar_'. $widget->bind_id.' .navbar-nav > li.is-active > a{';			
	 if (!empty($widget->options['m_active_color'])) { 
	    $styles.= 'color:'.$widget->options['m_active_color'].' !important;';	
        } 		
	 if (!empty($widget->options['m_active_bgcolor'])) {
	    $styles.= 'background:'.$widget->options['m_active_bgcolor'].' !important;';	
        } 	
	$styles.= '}';
	$styles.= '#navbar_'.$widget->bind_id.' .navbar-nav > .nav-item.is-active > a  .nav-item-toggler:before, #navbar_'.$widget->bind_id.' .navbar-nav > .nav-item.is-active > a .nav-item-toggler:after{
		background-color:'.$widget->options['m_active_color'].' !important;}';
	
   } ?>
	
	
	
	
	<?php //// подменю //// ?>
	
	<?php if (!empty($widget->options['m2_bg_color'])) { 
	$styles.= '#navbar_'.$widget->bind_id.' ul ul{		
	    background:'.$widget->options['m2_bg_color'].' !important;		
	}';	
	$styles.= '.nm_mobmenu{		
	    background:'.$widget->options['m2_bg_color'].' !important;		
	}';	
	 } ?>	
	
	<?php if (!empty($widget->options['m2_links_color'])) { 
	
	
	$styles.= '.nm_mobmenu ul a, .nm-nav-usermenu .text-white, .nm-nav-usermenu *:not(.btn){
		color:'.$widget->options['m2_links_color'].' !important;	
	}';
	$styles.= '.nm_mobmenu .dcjq-icon:before, .nm_mobmenu .dcjq-icon:after{
		background-color:'.$widget->options['m2_links_color'].' !important;	
	}';
	$styles.= '.nm_mobmenu ul svg{			
	    fill:'.$widget->options['m2_links_color'].' !important;			
	}';
	 } ?>
	

	<?php if (!empty($widget->options['m2_active_color'])) {
	$styles.= '.nm_mobmenu ul li.is-active > a{';			
		 if (!empty($widget->options['m2_active_color'])) { 
	    $styles.= 'color:'.$widget->options['m2_active_color'].' !important;';	
         } 	
		 if (!empty($widget->options['m2_active_bgcolor'])) {
	    $styles.= 'background:'.$widget->options['m2_active_bgcolor'].' !important;';	
        } 	
	$styles.= '}';
	 } ?>
	

	
	
	<?php if($styles){ $this->addHead('<style>'.$styles.'</style>'); } ?>
	
	
