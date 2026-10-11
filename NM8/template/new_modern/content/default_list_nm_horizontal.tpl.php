<?php
/**
 * Template Name: LANG_NM_LS_HORIZONTAL
 * Template Type: content
 * New Modern: горизонтальные карточки: фото слева, текст справа
 * Опции стиля (JSON в «Опциях стилей списка» типа контента) — см. assets/nm_list.tpl.php
 */
require_once $this->getTemplateFileName('assets/nm_list');
$nm_data = get_defined_vars();
if (!nm_list_start($nm_data)) { return; }
$style = 'nm_horizontal';
$opt = nm_list_opt($list_opt ?? [], ['ratio' => '4x3', 'teaser_lines' => 3]);
$cls = $ctype['name'];
?>
<div class="nm-list nm-list--horizontal content_list <?php echo $cls; ?>_list"<?php echo nm_list_attrs($nm_data, $style, $opt); ?>>
    <div class="nm-stack" data-nm-items>
    <?php foreach ($items as $item) { $p = nm_list_item($item, $ctype, $opt); ?>
        <article class="nm-hz nm-item<?php if (!$p['image']) { ?> nm-hz--noimg<?php } ?> <?php echo $cls; ?>_list_item">
            <?php if ($p['image']) { nm_list_media($p, $opt, 'nm-hz__media'); } ?>
            <div class="nm-hz__body">
                <?php nm_list_cat($p, $opt); ?>
                <?php nm_list_title($item, $ctype, $p, 'h3', 'nm-hz__title'); ?>
                <?php if ($p['teaser']) { ?><p class="nm-teaser" style="--nm-lines:<?php echo (int) $opt['teaser_lines']; ?>"><?php html($p['teaser']); ?></p><?php } ?>
                <?php nm_list_tags($item, $ctype); ?>
                <?php if ($opt['meta']) { nm_list_meta($item, [], [], 'mt-auto'); } ?>
            </div>
        </article>
    <?php } ?>
    </div>
</div>
<?php nm_list_end($nm_data, $style, $opt); ?>
