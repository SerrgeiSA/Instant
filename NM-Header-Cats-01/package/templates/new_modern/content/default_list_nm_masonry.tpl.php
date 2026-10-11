<?php
/**
 * Template Name: LANG_NM_LS_MASONRY
 * Template Type: content
 * New Modern: кирпичная кладка: фото в исходных пропорциях
 * Опции стиля (JSON в «Опциях стилей списка» типа контента) — см. assets/nm_list.tpl.php
 */
require_once $this->getTemplateFileName('assets/nm_list');
$nm_data = get_defined_vars();
if (!nm_list_start($nm_data)) { return; }
$style = 'nm_masonry';
$opt = nm_list_opt($list_opt ?? [], ['cols' => 3, 'teaser_lines' => 4]);
$cls = $ctype['name'];
?>
<div class="nm-list nm-list--masonry content_list <?php echo $cls; ?>_list"<?php echo nm_list_attrs($nm_data, $style, $opt); ?>>
    <div class="nm-masonry" style="--nm-cols:<?php echo $opt['cols']; ?>" data-nm-items>
    <?php foreach ($items as $item) { $p = nm_list_item($item, $ctype, $opt); ?>
        <article class="nm-card nm-item <?php echo $cls; ?>_list_item">
            <?php if ($p['image']) { ?>
                <a class="nm-media nm-media--natural nm-card__media" href="<?php echo $p['url']; ?>" tabindex="-1" aria-hidden="true"><img src="<?php html($p['image']['src']); ?>" alt="<?php html($p['title']); ?>" loading="lazy" decoding="async"></a>
            <?php } ?>
            <div class="nm-card__body">
                <?php nm_list_cat($p, $opt); ?>
                <?php nm_list_title($item, $ctype, $p, 'h3', 'nm-card__title'); ?>
                <?php if ($p['teaser']) { ?><p class="nm-teaser" style="--nm-lines:<?php echo (int) $opt['teaser_lines']; ?>"><?php html($p['teaser']); ?></p><?php } ?>
                <?php if ($opt['meta']) { nm_list_meta($item, [], [], 'nm-card__meta'); } ?>
            </div>
        </article>
    <?php } ?>
    </div>
</div>
<?php nm_list_end($nm_data, $style, $opt); ?>
