<?php
/**
 * Template Name: LANG_NM_LS_CATALOG
 * Template Type: widget
 * New Modern: каталог (компании, сервисы): логотип, подзаголовок, описание, рейтинг
 * Для виджета «Список контента»: картинка, анонс и цена определяются по типам полей, подгрузки и фильтра нет
 */
require_once $this->getTemplateFileName('assets/nm_list');
nm_list_mode('widget');
$page    = 1;
$perpage = !empty($items) && is_array($items) ? count($items) : 0;
$nm_data = get_defined_vars();
if (!nm_list_start($nm_data)) { return; }
$style = 'nm_catalog';
$opt = nm_list_opt($list_opt ?? [], ['cols' => 2, 'teaser_lines' => 3]);
$cls = $ctype['name'];
?>
<div class="nm-list nm-list--catalog content_list <?php echo $cls; ?>_list"<?php echo nm_list_attrs($nm_data, $style, $opt); ?>>
    <div class="nm-grid" style="--nm-cols:<?php echo $opt['cols']; ?>" data-nm-items>
    <?php foreach ($items as $item) { $p = nm_list_item($item, $ctype, $opt); ?>
        <article class="nm-co nm-item<?php if ($p['highlight']) { ?> is-highlight<?php } ?> <?php echo $cls; ?>_list_item">
            <div class="nm-co__head">
                <?php nm_list_media($p, $opt, 'nm-co__logo', '1x1', 'small'); ?>
                <div class="nm-co__name">
                    <div class="nm-co__line">
                        <?php nm_list_title($item, $ctype, $p, 'h3', 'nm-co__title'); ?>
                        <?php if ($p['badge']) { ?><span class="nm-badge-ok" title="<?php echo LANG_NM_VERIFIED; ?>"><?php html_svg_icon('solid', 'check', 10); ?></span><?php } ?>
                    </div>
                    <div class="nm-co__sub">
                        <?php if ($p['subtitle']) { ?><span class="nm-place"><?php html_svg_icon('solid', 'map-marker-alt', 12); ?> <?php html($p['subtitle']); ?></span><?php } ?>
                        <?php nm_list_cat($p, $opt, 'nm-cat--text'); ?>
                    </div>
                </div>
            </div>
            <?php if ($p['teaser']) { ?><p class="nm-teaser" style="--nm-lines:<?php echo (int) $opt['teaser_lines']; ?>"><?php html($p['teaser']); ?></p><?php } ?>
            <div class="nm-co__foot">
                <?php nm_list_meta($item, ['rating', 'comments']); ?>
                <a class="nm-co__more" href="<?php echo $p['url']; ?>"><?php echo LANG_NM_MORE_LINK; ?> <?php html_svg_icon('solid', 'arrow-right', 12); ?></a>
            </div>
        </article>
    <?php } ?>
    </div>
</div>
<?php nm_list_end($nm_data, $style, $opt); ?>
