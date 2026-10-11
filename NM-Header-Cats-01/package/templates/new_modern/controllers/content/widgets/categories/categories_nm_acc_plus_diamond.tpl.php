<?php
/**
 * Template Name: Аккордеон с плюсом · ромб
 * Template Type: widget
 * New Modern: ветки открываются независимо; маркер категории: ромб
 */
require_once $this->getTemplateFileName('assets/nm_cats');
if (empty($cats)) { return; }
$this->addJS('templates/new_modern/js/nm-cats.js');

$nm_ctype  = isset($ctype_name) ? $ctype_name : '';
$nm_counts = !empty($show_counts);
$nm_tree   = nm_cats_tree($cats);
?>
<nav class="nm-cats nm-cats--collapse nm-cats--plus">
    <?php echo nm_cats_render($nm_tree, $nm_ctype, ['skip_hidden' => false, 'toggle' => true, 'icon' => true, 'mark' => 'diamond', 'open_all' => false, 'counts' => $nm_counts]); ?>
</nav>
