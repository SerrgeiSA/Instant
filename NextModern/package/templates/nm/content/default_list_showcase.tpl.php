<?php
    if( $ctype['options']['list_show_filter'] ) {
        $this->renderAsset('ui/filter-panel', array(
            'css_prefix'   => $ctype['name'],
            'page_url'     => $page_url,
            'fields'       => $fields,
            'props_fields' => $props_fields,
            'props'        => $props,
            'filters'      => $filters,
			'ext_hidden_params' => $ext_hidden_params,
            'is_expanded'  => $ctype['options']['list_expand_filter']
        ));
    }

	if (isset($fields['fav'])){ $fav = 'fav'; } 
	if (isset($fields['revs'])){ $revs = 'revs'; } 
	
	foreach($fields as $field){
		if (!isset($fav) && $field['type'] == 'bookmarks'){ $fav = $field['name']; }
		if (!isset($revs) && $field['type'] == 'recommendstars'){ $revs = $field['name']; }
	}
	
	$showcase = cmsCore::getController('showcase');
	$list_pos = !empty($showcase->options['list_pos']) ? $showcase->options['list_pos'] : 'center';
	$list_height = !empty($showcase->options['list_height']) ? $showcase->options['list_height'] : 200;
	$list_bg = !empty($showcase->options['list_bg']) ? $showcase->options['list_bg'] : '#fff';

?>

<?php if ($items){ ?>

	<?php 
		$this->addCSS($this->getTplFilePath('controllers/showcase/css/list_grid.css', false));
		$this->addCSS($this->getTplFilePath('controllers/nm/addons/showcase/styles.css', false));
		$this->addJS($this->getTplFilePath('controllers/showcase/js/showcase.js', false));
		$this->addJS($this->getTplFilePath('controllers/showcase/js/showcase_nm.js', false));
		$this->addJS($this->getTplFilePath('controllers/showcase/js/imgLiquid.min.js', false));
	?>
	
	
	<?php $this->block('top_showcase_list'); ?>
	
	<?php ob_start(); ?>
	<script>
		var cart_data = {};
		var preorder_data = {};
	</script>
	<?php $this->addBottom(ob_get_clean()); ?>

	<div class="showcase_list_grid <?php echo $ctype['name']; ?>_list_grid" onload="icms.showcase.bulidListGrid(this)">
		<?php foreach($items as $item){ ?>
			<?php
				$item['ctype'] = $ctype;
                $item['ctype_name'] = $ctype['name'];
				$url = href_to($ctype['name'], $item['slug']) . '.html';
				$image = '/' . $this->getTplFilePath('controllers/showcase/img/nophoto_normal.png', false);
				$photo_class = false;
				if(isset($fields['photo']) && $fields['photo']['is_in_list'] && !empty($item['photo'])) {
					$image = html_image_src($item['photo'], $fields['photo']['options']['size_teaser'], true);
					$photo_class = 'sc_is_photo';
					$photos = is_array($item['photo']) ? $item['photo'] : cmsModel::yamlToArray($item['photo']);
				}
                $is_private = $item['is_private'] && $hide_except_title && !$item['user']['is_friend'];
                if ($is_private) {
                    $image = html_image_src(default_images('private', 'big'), $fields['photo']['options']['size_teaser'], true);
                    $url = 'javascript:void(0);';
                }
			?>			
			<div class="my_default_list_item<?php if (!empty($item['is_vip'])){ ?> is_vip<?php } ?>" id="sc_item_<?php html($item['id']); ?>">
				<div class="miw_preloader">
				<div class="spinner-grow" role="status">
  <span class="sr-only">Loading...</span>
</div>
				</div>
				<div class="my_item_wrap">
				
		
					
					<div class="miw_photo_block miwpb_<?php html($list_pos); ?>" style="background-color:<?php html($list_bg); ?>">
				
						<a href="<?php echo $url; ?>" class="miw_photo" style="width:288px; height:<?php html($list_height); ?>px">
							<img src="<?php html($image); ?>" alt="<?php html($item['title']); ?>" />
						</a>
						<?php if (!empty($item['variants']) && empty($showcase->options['variants_off'])){ ?>
							<?php
								$i = 1;
								$colors = false;
								if (!empty($fields['color'])){
									$colors = $fields['color']['handler']->getListItems(false);
								}
							?>
							<div class="sc_variants_selector">
							<?php if (empty($showcase->options['variants_list']) || $showcase->options['variants_list'] == 'box'){ ?>
								<?php foreach ($item['variants'] as $variant){ ?>
									<?php
										//if (empty($variant['in']) || $variant['in'] == 'none' || (int)$variant['in'] < 1){ continue; }
										if ($i == 4){ 
											echo '<a href="' . $url . '" class="sc_variant_selector scvs_count" data-sc-tip="Все варианты" rel="nofollow">+' . (count($item['variants']) - 3) . '</a>';
											break;
										}
										$photo = !empty($variant['photo']) ? html_image_src($variant['photo'], 'big', true) : 0;
									?>
									<div class="sc_variant_selector" <?php if (!empty($variant['color']) && !empty($colors[$variant['color']]['color'])){ ?>style="background:<?php html($colors[$variant['color']]['color']); ?>"<?php } ?> data-sc-tip="Вариант <?php html($i); ?>" data-title="<?php html($variant['title']); ?>" <?php if (isset($fields['price']) && $fields['price']['is_in_list'] && $this->controller->cms_user->isInGroups($fields['price']['groups_read']) && !empty($variant['price'])){ ?>data-price="<?php echo $showcase->getPriceFormat($variant['price']); ?>"<?php } ?> <?php if (isset($fields['sale']) && $fields['sale']['is_in_list'] && $this->controller->cms_user->isInGroups($fields['sale']['groups_read']) && !empty($variant['sale']) && $variant['sale'] > 0){ ?>data-sale="<?php echo $showcase->getPriceFormat($variant['sale']); ?>"<?php } ?> <?php if ($photo){ ?>data-photo="<?php html($photo); ?>"<?php } ?> data-url="<?php echo $url . '?&variant=' . $variant['id']; ?>" data-id="<?php html($variant['id']); ?>" data-in_stock="<?php echo (!empty($variant['in']) && $variant['in'] != 'none') ? $variant['in'] : 0; ?>" onClick="icms.showcase.setListVariant(this, <?php html($item['id']); ?>)"></div> 
									<?php $i++; ?>
								<?php } ?>
							<?php } else { ?>
								<select class="sc_variations_select" data-item_id="<?php html($item['id']); ?>">
									<option value="0">Выбрать вариант</option>
									<?php foreach ($item['variants'] as $variant){ ?>
										<?php
											//if (empty($variant['in']) || $variant['in'] == 'none' || (int)$variant['in'] < 1){ continue; }
											if ($i == 8){ 
												break;
											}
											$photo = !empty($variant['photo']) ? html_image_src($variant['photo'], 'big', true) : 0;
										?>
										<option value="<?php html($variant['id']); ?>" data-title="<?php html($variant['title']); ?>" <?php if (isset($fields['price']) && $fields['price']['is_in_list'] && $this->controller->cms_user->isInGroups($fields['price']['groups_read']) && !empty($variant['price'])){ ?>data-price="<?php echo $showcase->getPriceFormat($variant['price']); ?>"<?php } ?> <?php if (isset($fields['sale']) && $fields['sale']['is_in_list'] && $this->controller->cms_user->isInGroups($fields['sale']['groups_read']) && !empty($variant['sale']) && $variant['sale'] > 0){ ?>data-sale="<?php echo $showcase->getPriceFormat($variant['sale']); ?>"<?php } ?> <?php if ($photo){ ?>data-photo="<?php html($photo); ?>"<?php } ?> data-url="<?php echo $url . '?&variant=' . $variant['id']; ?>" <?php if (empty($variant['in']) || $variant['in'] == 'none' || (int)$variant['in'] < 1){ ?>disabled<?php } ?> data-in_stock="<?php echo (!empty($variant['in']) && $variant['in'] != 'none') ? $variant['in'] : 0; ?>"><?php html($variant['title']); ?></option>
										<?php $i++; ?>
									<?php } ?>
								</select>
							<?php } ?>
							</div>
						<?php } ?>
						<?php if (!empty($item['is_vip'])){ ?>
							<div class="miw_vip"><div class="miw_vip_text">vip</div></div>
						<?php } ?>
					</div>
					
					<?php if (!empty($item['label'])){ ?>
						<div class="miw_block_polosa">
							<div class="miw_polosa">
								<?php html(mb_strimwidth(strip_tags($item['label']), 0, 6)); ?>
							</div>
						</div>
					<?php } else if (!empty($item['sale']) && $item['sale'] > 0 || !empty($variant['sale']) && $variant['sale'] > 0){ ?>
						<div class="miw_block_polosa">
							<div class="miw_polosa is_sc_sale">Скидка</div>
						</div>
					<?php } ?>
					
					<div class="miw_description">
				
						
						<div class="miw_price_box mb-0">
							<?php if (isset($fields['price']) && $fields['price']['is_in_list'] && $this->controller->cms_user->isInGroups($fields['price']['groups_read']) && !empty($item['fields']['price'])){ ?>
								<div class="miw_price text-dark">
									<?php echo $fields['price']['handler']->setItem($item)->parseTeaser($item['price']); ?> 
								</div>
								<?php if (!empty($item['sale']) && $item['sale'] > 0 || !empty($variant['sale']) && $variant['sale'] > 0){ ?>
									<s class="sc_old_price"><?php echo $showcase->getPriceFormat($item['price']); ?></s>
								<?php } ?>
							<?php } else { ?>
								<div class="miw_price">&nbsp;</div>
							<?php } ?>
							<?php if (isset($revs) && $fields[$revs]['is_in_list']){ ?>
								<?php echo $item['fields'][$revs]['html']; ?>
							<?php } ?>
						</div>
						
						<h2>
							<a href="<?php echo $url; ?>" title="<?php html($item['title']); ?>" class="h6">
								<?php html($item['title']); ?>
							</a>
						</h2>
						
					<div class="sc_cart_btn_wrap mb-3 mt-2">	
					
					
					<a href="javascript:void(0)" class="more sc_cart_btn btn btn-primary" rel="nofollow" data-in_stock="<?php echo !empty($item['in_stock']) ? $item['in_stock'] : 0; ?>" data-item_id="<?php html($item['id']); ?>" data-variant="<?php echo !empty($item['seted_variant']) ? $item['seted_variant'] : 0; ?>">В корзину</a>
					
					<span class="sc_cart_btn_counts">
					<button class="btn btn-info sc_cart_btn_counts_minus" type="button" onclick="return icms.showcase.btnCartMinus(this);"><?php echo html_svg_icon('solid', 'minus'); ?></button>
					<span class="sc_cart_btn_counter btn"><span>1</span> шт</span>
					<input value="1" type="number" min="1"<?php if(!empty($item['in_stock'])){ ?> max="<?php echo $item['in_stock']; ?>"<?php } ?> class="form-control">
					<button class="btn btn-info sc_cart_btn_counts_plus" type="button" onclick="return icms.showcase.btnCartPlus(this);"><?php echo html_svg_icon('solid', 'plus'); ?></button>
					</span>
					
					<?php if(!empty($fields['in_stock']['is_in_list']) && !empty($item['in_stock'])){ ?><span class="sc_cart_btn_in_stock ml-4">В наличии: <?php echo $item['in_stock']; ?></span><?php } ?>
					
                    </div>					
				
					</div>
				
				</div>

            </div>
			
		<?php } ?>
	</div>
	
	<?php $this->block('bottom_showcase_list'); ?>
	
	<?php ob_start(); ?>
	<script>
		
		icms.showcase.list_pos = '<?php echo ($list_pos == 'contain') ? 'center' : $list_pos; ?>';
		icms.showcase.list_height = '<?php echo $list_height; ?>';
	
	</script>
	<?php $this->addBottom(ob_get_clean()); ?>

    <?php if ($perpage < $total) { ?>
        <?php echo html_pagebar($page, $perpage, $total, $page_url, array_merge($filters, $ext_hidden_params)); ?>
    <?php } ?>

<?php } else {

    if(!empty($ctype['labels']['many'])){
        echo sprintf(LANG_TARGET_LIST_EMPTY, $ctype['labels']['many']);
    } else {
        echo LANG_LIST_EMPTY;
    }

}