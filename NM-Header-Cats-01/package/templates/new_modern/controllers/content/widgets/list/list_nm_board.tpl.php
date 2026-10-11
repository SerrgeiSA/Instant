<?php
/**
 * Template Name: LANG_NM_LS_BOARD
 * Template Type: widget
 * New Modern: объявления строками: фото, цена, описание, характеристики
 * Для виджета «Список контента»: картинка, анонс и цена определяются по типам полей, подгрузки и фильтра нет
 */
require_once $this->getTemplateFileName('assets/nm_list');
nm_list_mode('widget');
$page    = 1;
$perpage = !empty($items) && is_array($items) ? count($items) : 0;
$nm_data = get_defined_vars();
if (!nm_list_start($nm_data)) { return; }
$style = 'nm_board';
$opt = nm_list_opt($list_opt ?? [], ['ratio' => '4x3', 'teaser_lines' => 2]);
$cls = $ctype['name'];
?>
<div class="nm-list nm-list--board content_list <?php echo $cls; ?>_list"<?php echo nm_list_attrs($nm_data, $style, $opt); ?>>
    <div class="nm-stack nm-stack--tight" data-nm-items>
    <?php foreach ($items as $item) { $p = nm_list_item($item, $ctype, $opt); ?>
        <article class="nm-ad nm-item<?php if ($p['highlight']) { ?> is-highlight<?php } ?> <?php echo $cls; ?>_list_item">
            <?php nm_list_media($p, $opt, 'nm-ad__media'); ?>
            <div class="nm-ad__body">
                <div class="nm-ad__head">
                    <?php nm_list_title($item, $ctype, $p, 'h3', 'nm-ad__title'); ?>
                    <?php if ($p['has_price']) { ?><div class="nm-price nm-ad__price"><?php echo $p['price'] ?: '<span class="text-muted">' . LANG_NM_NO_PRICE . '</span>'; ?></div><?php } ?>
                </div>
                <?php if ($p['teaser']) { ?><p class="nm-teaser" style="--nm-lines:<?php echo (int) $opt['teaser_lines']; ?>"><?php html($p['teaser']); ?></p><?php } ?>
                <?php if ($p['props']) { ?>
                    <ul class="nm-props">
                    <?php foreach ($p['props'] as $prop) { ?>
                        <li><?php if ($prop['title']) { ?><span class="nm-props__k"><?php html($prop['title']); ?>:</span> <?php } ?><?php echo $prop['html']; ?></li>
                    <?php } ?>
                    </ul>
                <?php } ?>
                <div class="nm-ad__foot">
                    <?php if ($p['subtitle']) { ?><span class="nm-place"><?php html_svg_icon('solid', 'map-marker-alt', 12); ?> <?php html($p['subtitle']); ?></span><?php } ?>
                    <?php nm_list_cat($p, $opt, 'nm-cat--text'); ?>
                    <?php if ($opt['meta']) { nm_list_meta($item, [], ['user'], 'nm-ad__meta'); } ?>
                </div>
            </div>
        </article>
    <?php } ?>
    </div>
</div>
<?php nm_list_end($nm_data, $style, $opt); ?>
