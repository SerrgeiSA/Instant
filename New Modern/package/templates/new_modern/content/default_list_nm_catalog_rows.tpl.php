<?php
/**
 * Template Name: LANG_NM_LS_CATALOG_ROWS
 * Template Type: content
 * New Modern: каталог строками: логотип, название, описание, рейтинг и кнопка
 * Опции стиля (JSON в «Опциях стилей списка» типа контента) — см. assets/nm_list.tpl.php
 */
require_once $this->getTemplateFileName('assets/nm_list');
$nm_data = get_defined_vars();
if (!nm_list_start($nm_data)) { return; }
$style = 'nm_catalog_rows';
$opt = nm_list_opt($list_opt ?? [], ['teaser_lines' => 2]);
$cls = $ctype['name'];
?>
<div class="nm-list nm-list--catalog-rows content_list <?php echo $cls; ?>_list"<?php echo nm_list_attrs($nm_data, $style, $opt); ?>>
    <div class="nm-stack nm-stack--tight" data-nm-items>
    <?php foreach ($items as $item) { $p = nm_list_item($item, $ctype, $opt); ?>
        <article class="nm-cor nm-item<?php if ($p['highlight']) { ?> is-highlight<?php } ?> <?php echo $cls; ?>_list_item">
            <?php nm_list_media($p, $opt, 'nm-co__logo nm-cor__logo', '1x1', 'small'); ?>
            <div class="nm-cor__main">
                <div class="nm-co__line">
                    <?php nm_list_title($item, $ctype, $p, 'h3', 'nm-co__title'); ?>
                    <?php if ($p['badge']) { ?><span class="nm-badge-ok" title="<?php echo LANG_NM_VERIFIED; ?>"><?php html_svg_icon('solid', 'check', 10); ?></span><?php } ?>
                </div>
                <div class="nm-co__sub">
                    <?php if ($p['subtitle']) { ?><span class="nm-place"><?php html_svg_icon('solid', 'map-marker-alt', 12); ?> <?php html($p['subtitle']); ?></span><?php } ?>
                    <?php nm_list_cat($p, $opt, 'nm-cat--text'); ?>
                </div>
                <?php if ($p['teaser']) { ?><p class="nm-teaser" style="--nm-lines:<?php echo (int) $opt['teaser_lines']; ?>"><?php html($p['teaser']); ?></p><?php } ?>
            </div>
            <div class="nm-cor__side">
                <?php nm_list_meta($item, ['rating', 'comments']); ?>
                <a class="btn btn-outline-primary btn-sm" href="<?php echo $p['url']; ?>"><?php echo LANG_NM_MORE_LINK; ?></a>
            </div>
        </article>
    <?php } ?>
    </div>
</div>
<?php nm_list_end($nm_data, $style, $opt); ?>
