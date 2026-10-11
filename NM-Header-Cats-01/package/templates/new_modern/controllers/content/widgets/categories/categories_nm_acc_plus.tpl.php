<?php
/**
 * Template Name: LANG_NM_WC_ACC_PLUS
 * Template Type: widget
 * New Modern: аккордеон с плюсом: ветки открываются независимо
 */
require_once $this->getTemplateFileName('assets/nm_cats');
if (empty($cats)) { return; }
$this->addJS('templates/new_modern/js/nm-cats.js');

$nm_ctype  = isset($ctype_name) ? $ctype_name : '';
$nm_counts = !empty($show_counts);
$nm_tree   = nm_cats_tree($cats);
?>
<nav class="nm-cats nm-cats--collapse nm-cats--plus">
    <?php echo nm_cats_render($nm_tree, $nm_ctype, ['skip_hidden' => false, 'toggle' => true, 'icon' => false, 'open_all' => false, 'counts' => $nm_counts]); ?>
</nav>
