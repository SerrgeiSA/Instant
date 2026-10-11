<?php
/**
 * Template Name: LANG_NM_WC_CHIPS
 * Template Type: widget
 * New Modern: категории кнопками-метками в несколько строк
 */
require_once $this->getTemplateFileName('assets/nm_cats');
if (empty($cats)) { return; }

$nm_ctype  = isset($ctype_name) ? $ctype_name : '';
$nm_counts = !empty($show_counts);
?>
<nav class="nm-cats nm-cats--chips">
    <ul class="nm-cats__chips">
    <?php foreach ($cats as $cat) { ?>
        <?php if (!empty($cat['is_hidden'])) { continue; } ?>
        <li>
            <a class="nm-cats__chip<?php if (!empty($cat['is_active'])) { ?> is-active<?php } ?>" href="<?php html(href_to($nm_ctype, $cat['slug'])); ?>">
                <span><?php html($cat['title']); ?></span>
                <?php echo nm_cats_count($cat, $nm_counts); ?>
            </a>
        </li>
    <?php } ?>
    </ul>
</nav>
