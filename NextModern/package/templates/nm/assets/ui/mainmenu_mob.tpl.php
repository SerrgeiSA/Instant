
<div class="nm_mobmenu">
		
<ul id="nm_mobmenu">

<?php $last_level = 0; ?>

<?php foreach ($menu as $id => $item) { ?>

    <?php for ($i=0; $i<($last_level - $item['level']); $i++) { ?>
        </li></ul>
    <?php } ?>

    <?php if ($item['level'] <= $last_level) { ?>
        </li>
    <?php } ?>

    <?php

        $is_active = in_array($id, $active_ids);

        $css_classes = [];
        if ($item['level'] > 1) {
            $css_aclasses = ['text-nowrap'];
        } else {
            $css_aclasses = ['text-nowrap'];
        }
        if ($is_active) {
            $css_classes[] = 'active';
            $css_aclasses[] = '';
        }
        if ($item['childs_count'] > 0) {
           // $css_classes[] = 'dropdown';
          //  $css_aclasses[] = 'dropdown-toggle';
           // $item['attributes']['data-toggle'] = 'dropdown';
            if ($item['level'] >= 2){
              //  $css_classes[] = 'dropright';
            }
        }
        if (!empty($item['options']['class'])) {
            $css_classes[] = $item['options']['class'];
        }
		
			
		if(@strpos($item['url'], '/#') === 0){
			$item['url'] = substr_replace($item['url'], '', 0, 1);
		}

    ?>

    <li <?php if ($css_classes) { ?>class="<?php echo implode(' ', $css_classes); ?>"<?php } ?>>
        <?php if ($item['disabled']) { ?>
            <span class="disabled"><?php html($item['title']); ?></span>
        <?php } else { ?>
		
            <a <?php if (!empty($item['title'])) {?>title="<?php echo html($item['title']); ?>"<?php } ?> class="<?php echo implode(' ', $css_aclasses); ?>" href="<?php echo !empty($item['url']) ? html($item['url'], false) : 'javascript:void(0)'; ?>" <?php echo html_attr_str($item['attributes']); ?>>
			
		
			
                <?php if (!empty($item['options']['icon'])) {
                    $icon_params = explode(':', $item['options']['icon']);
                    if(!isset($icon_params[1])){ array_unshift($icon_params, 'solid'); }
                    html_svg_icon($icon_params[0], $icon_params[1]);
                } ?>              
			  <?php if (!empty($item['title']) && empty($item['options']['hide_title'])) { ?>
                    <span class="nm_mobmenu-text"><?php echo $item['title']; ?></span>
                <?php } ?>
                <?php if (!empty($item['counter'])){ ?>
                    <span class="nm_mobmenu-counter"><?php html($item['counter']); ?></span>
                <?php } ?>
				
		
			
            </a>
			
		
			
		
			
        <?php } ?>

        <?php if ($item['childs_count'] > 0) { ?><ul class="submenu"><?php } ?>

    <?php $last_level = $item['level']; ?>

<?php } ?>

<?php for ($i=0; $i<$last_level; $i++) { ?>
    </li></ul>
<?php } ?>

	
			</div>