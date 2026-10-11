<?php
/**
 * Template Name: LANG_NM_LS_CARDS
 * Template Type: content
 * New Modern: карточки сеткой: фото, категория, заголовок, анонс, мета
 * Опции стиля (JSON в «Опциях стилей списка» типа контента) — см. assets/nm_list.tpl.php
 */
require_once $this->getTemplateFileName('assets/nm_list');
$nm_data = get_defined_vars();
if (!nm_list_start($nm_data)) { return; }
$style = 'nm_cards';
$opt = nm_list_opt($list_opt ?? [], ['cols' => 3]);
$cls = $ctype['name'];
?>
<div class="nm-list nm-list--cards content_list <?php echo $cls; ?>_list"<?php echo nm_list_attrs($nm_data, $style, $opt); ?>>
    <div class="nm-grid" style="--nm-cols:<?php echo $opt['cols']; ?>" data-nm-items>
    <?php foreach ($items as $item) { $p = nm_list_item($item, $ctype, $opt); ?>
        <article class="nm-card nm-item<?php if ($p['highlight']) { ?> is-highlight<?php } ?> <?php echo $cls; ?>_list_item">
            <?php if ($p['image']) { nm_list_media($p, $opt, 'nm-card__media'); } ?>
            <div class="nm-card__body">
                <?php nm_list_cat($p, $opt); ?>
                <?php nm_list_title($item, $ctype, $p, 'h3', 'nm-card__title'); ?>
                <?php if ($p['price']) { ?><div class="nm-price"><?php echo $p['price']; ?></div><?php } ?>
                <?php if ($p['teaser']) { ?><p class="nm-teaser" style="--nm-lines:<?php echo (int) $opt['teaser_lines']; ?>"><?php html($p['teaser']); ?></p><?php } ?>
                <?php nm_list_tags($item, $ctype); ?>
                <?php if ($opt['meta']) { nm_list_meta($item, [], [], 'nm-card__meta'); } ?>
            </div>
        </article>
    <?php } ?>
    </div>
</div>
<?php nm_list_end($nm_data, $style, $opt); ?>
