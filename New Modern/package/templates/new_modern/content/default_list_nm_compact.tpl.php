<?php
/**
 * Template Name: LANG_NM_LS_COMPACT
 * Template Type: content
 * New Modern: компактный список заголовков с датой и счётчиками
 * Опции стиля (JSON в «Опциях стилей списка» типа контента) — см. assets/nm_list.tpl.php
 */
require_once $this->getTemplateFileName('assets/nm_list');
$nm_data = get_defined_vars();
if (!nm_list_start($nm_data)) { return; }
$style = 'nm_compact';
$opt = nm_list_opt($list_opt ?? [], ['thumb' => 0]);
$cls = $ctype['name'];
?>
<div class="nm-list nm-list--compact content_list <?php echo $cls; ?>_list"<?php echo nm_list_attrs($nm_data, $style, $opt); ?>>
    <div class="nm-rows" data-nm-items>
    <?php foreach ($items as $item) { $p = nm_list_item($item, $ctype, $opt); ?>
        <article class="nm-row nm-item <?php echo $cls; ?>_list_item">
            <time class="nm-row__date" datetime="<?php echo date('c', strtotime($item['date_pub'])); ?>"><?php echo html_date($item['date_pub']); ?></time>
            <?php if (!empty($opt['thumb']) && $p['image']) { nm_list_media($p, $opt, 'nm-row__media', '1x1', 'small'); } ?>
            <?php nm_list_title($item, $ctype, $p, 'h3', 'nm-row__title'); ?>
            <?php nm_list_cat($p, $opt, 'nm-cat--text nm-row__cat'); ?>
            <?php if ($opt['meta']) { nm_list_meta($item, ['comments', 'rating'], [], 'nm-row__meta'); } ?>
        </article>
    <?php } ?>
    </div>
</div>
<?php nm_list_end($nm_data, $style, $opt); ?>
