<?php
/**
 * Template Name: LANG_NM_WC_TILES
 * Template Type: widget
 * New Modern: плитки с картинками категорий (без картинки — значок папки)
 */
require_once $this->getTemplateFileName('assets/nm_cats');
if (empty($cats)) { return; }

$nm_ctype  = isset($ctype_name) ? $ctype_name : '';
$nm_counts = !empty($show_counts);
?>
<nav class="nm-cats nm-cats--tiles">
    <div class="nm-grid nm-grid--tight" style="--nm-cols:3">
    <?php foreach ($cats as $cat) { ?>
        <?php if (!empty($cat['is_hidden'])) { continue; } ?>
        <a class="nm-tile<?php if (!empty($cat['is_active'])) { ?> is-active<?php } ?>" href="<?php html(href_to($nm_ctype, $cat['slug'])); ?>">
            <span class="nm-tile__media nm-media nm-ratio-4x3">
                <?php if (!empty($cat['img_src'])) { ?>
                    <img src="<?php html($cat['img_src']); ?>" alt="<?php html($cat['title']); ?>" loading="lazy" decoding="async">
                <?php } else { ?>
                    <span class="nm-media__empty"><?php html_svg_icon('solid', 'folder', 32); ?></span>
                <?php } ?>
            </span>
            <span class="nm-tile__body">
                <span class="nm-tile__title"><?php html($cat['title']); ?></span>
                <?php echo nm_cats_count($cat, $nm_counts); ?>
            </span>
        </a>
    <?php } ?>
    </div>
</nav>
