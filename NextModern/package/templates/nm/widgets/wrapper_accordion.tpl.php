<?php

    if(!isset($widgets)){ $widgets = [$widget]; }

    $wrap_class = ['icms-widget__accordion'];
    $widget_links = [];
    $widgets_id = 'icms-widget__accordion';
	
	   $parent_title = false;
	if(strpos($widgets[0]['title'], '|') !== false){
		
		$wd_titles = explode('|',$widgets[0]['title']);
		$parent_title = $wd_titles[0];
		$widgets[0]['title'] = $wd_titles[1];
		
	}

    foreach($widgets as $widget) {
        $widgets_id .= '_'.$widget['id'];
        if ($widget['class_wrap'] && !in_array($widget['class_wrap'], $wrap_class)) {
            $wrap_class[] = $widget['class_wrap'];
        }
        if (!empty($widget['links'])) {
            $widget_links[] = [
                'id' => 'widget-links-'.$widget['id'],
                'links' => string_parse_list($widget['links'])
            ];
        }
    }

?>




<div class="card mb-3 mb-md-4 icms-widget__transparent" id="<?php echo $widgets_id; ?>">
  
<?php if($parent_title){ ?>
     <div class="wd-parent-title h5 card-header d-flex align-items-center<?php if (!empty($widgets[0]['class_title'])  && strpos($widgets[0]['class_title'], 'd-none') !== 0) { ?> d-none<?php } ?>">
	 <?php echo $parent_title; ?>
	 
	    <?php 
		$widget_links = !empty($widgets[0]['links']) ? string_parse_list($widgets[0]['links']) : false;
		if ($widget_links) { ?>
      
            <span class="links ml-auto">
                <?php foreach($widget_links as $link){ ?>
                    <a class="btn btn-outline-info btn-sm" href="<?php html((strpos($link['value'], 'http') === 0) ? $link['value'] : href_to($link['value'])); ?>">
                        <?php html($link['id']); ?>
                    </a>
                <?php } ?>
            </span>
  
        <?php } ?>
		
	 </div>
<?php } ?>

<div class="card-body accordion accordion_tabs<?php if (!empty($widgets[0]['class_title'])  && strpos($widgets[0]['class_title'], 'd-none') !== 0) { ?> pt-0<?php } ?>">
    
            <?php foreach($widgets as $index => $widget) { ?>
			
			<div id="widget-<?php echo $widget['id']; ?>" class="card<?php if ($widget['class_wrap']) { ?> <?php echo str_replace('accordion','',$widget['class_wrap']);  } ?><?php if (strpos($widget['class'], 'show') !== false) { echo ' active'; } ?>">
			
             
                    <div class="card-header h5 d-flex align-items-center justify-content-between<?php if ($widget['class_title']) { ?> <?php echo str_replace('d-none','',$widget['class_title']);  } ?>" data-toggle="collapse"
              data-target="#widget-<?php echo $widget['id']; ?>-body" aria-expanded="true" aria-controls="collapseOne">
                        <span><?php echo $widget['title'] ? string_replace_svg_icons($widget['title']) : ($index+1); ?></span>
						<span class="accordion-item-toggler"></span>
                    </div>
             
         
     
		
		    <div id="widget-<?php echo $widget['id']; ?>-body" data-parent="#<?php echo $widgets_id; ?>" class="card-body collapse<?php if ($widget['class']) { ?> <?php echo $widget['class'];  } ?>">
		  
                <?php echo $widget['body']; ?>
				
                <?php if(cmsUser::isAdmin()){ ?>
                    <?php $this->addTplJSName('widgets'); ?>
                    <?php include 'wrap_edit_links.tpl.php'; ?>
                <?php } ?>
            </div>
		  
		    </div>
		  
		  
		    <?php } ?>
			

</div>	

  
</div>