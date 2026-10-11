<?php $user = cmsUser::getInstance(); ?>
<?php $ctype = cmsModel::getCachedResult('current_ctype'); ?>
<?php $item = cmsModel::getCachedResult('current_ctype_item'); ?>

<div class="actions_sticky_navbar">

<div class="actions_sticky_navbar_toggler">
<a href="#" class="btn btn-primary"><svg class="icms-svg-icon w-16" fill="currentColor"><use xlink:href="/templates/modern/images/icons/solid.svg#ellipsis-v"></use></svg></a>
</div>

<div class="navbar navbar-default">
<ul class="menu navbar-nav m-0" role="navigation">

	<?php if($item && $user->is_logged){ ?> 
	<li class="nav-item">
    <a title="Добавить <?php echo $ctype['labels']['one']; ?>" class="nav-link text-nowrap" href="<?php echo href_to($ctype['name'],'add'); ?>">
    <svg class="icms-svg-icon w-16" fill="currentColor"><use xlink:href="/templates/modern/images/icons/solid.svg#plus-circle"></use></svg>                Добавить <?php echo $ctype['labels']['one']; ?></a>
    </li>
	 <?php } ?>
	 
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

        $css_classes = ['nav-item'];
        if ($item['level'] > 1) {
            $css_aclasses = ['dropdown-item text-nowrap'];
        } else {
            $css_aclasses = ['nav-link text-nowrap'];
        }
        if ($is_active) {
            $css_classes[] = 'is-active';
            $css_aclasses[] = 'active';
        }
        if ($item['childs_count'] > 0) {
            $css_classes[] = 'dropdown';
            $css_aclasses[] = 'dropdown-toggle';
            $item['attributes']['data-toggle'] = 'dropdown';
            if ($item['level'] >= 2){
                $css_classes[] = 'dropright';
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
            <span class="nav-link disabled"><?php html($item['title']); ?></span>
        <?php } else { ?>
            <a <?php if (!empty($item['title'])) {?>title="<?php echo html($item['title']); ?>"<?php } ?> class="<?php echo implode(' ', $css_aclasses); ?>" href="<?php echo !empty($item['url']) ? htmlspecialchars($item['url']) : 'javascript:void(0)'; ?>" <?php echo html_attr_str($item['attributes']); ?>>
                <?php if (!empty($item['options']['icon'])) {
                    $icon_params = explode(':', $item['options']['icon']);
                    if(!isset($icon_params[1])){ array_unshift($icon_params, 'solid'); }
                    html_svg_icon($icon_params[0], $icon_params[1]);
                } ?>
                <?php if (!empty($item['title'])) { echo $item['title']; } ?>
                <?php if (!empty($item['counter'])){ ?>
                    <span class="counter badge"><?php html($item['counter']); ?></span>
                <?php } ?>
            </a>
        <?php } ?>

        <?php if ($item['childs_count'] > 0) { ?><ul class="dropdown-menu"><?php } ?>

    <?php $last_level = $item['level']; ?>

<?php } ?>

<?php for ($i=0; $i<$last_level; $i++) { ?>
    </li></ul>
<?php } ?>



</div>
</div>




<?php ob_start(); ?>
<script>
 $('.actions_sticky_navbar_toggler a').click(function () {
	$(this).closest('.actions_sticky_navbar').toggleClass('opened').css({'left':'unset'});		 
	 return false;
});
</script>
<?php $this->addBottom(ob_get_clean()); ?>
