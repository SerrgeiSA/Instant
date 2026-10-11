<?php
/**
 * Template Name: LANG_NM_LS_LEAD_LIST
 * Template Type: widget
 * New Modern: крупная первая запись (фото, заголовок, дата) и компактный список с миниатюрами
 * Для виджета «Список контента»: картинка, анонс и цена определяются по типам полей, подгрузки и фильтра нет
 */
require_once $this->getTemplateFileName('assets/nm_list');
nm_list_mode('widget');
$page    = 1;
$perpage = !empty($items) && is_array($items) ? count($items) : 0;
$nm_data = get_defined_vars();
if (!nm_list_start($nm_data)) { return; }
$style = 'nm_lead_list';
$opt = nm_list_opt($list_opt ?? [], ['ratio' => '16x9', 'lead' => 1]);
$cls = $ctype['name'];

// Крупные записи только на первой странице: подгружаемые страницы дописывают компактные строки
$lead = [];
if ((int) $page === 1) { $lead = array_splice($items, 0, max(0, min((int) $opt['lead'], count($items)))); }
?>
<div class="nm-list nm-list--leadlist content_list <?php echo $cls; ?>_list"<?php echo nm_list_attrs($nm_data, $style, $opt); ?>>
    <?php foreach ($lead as $item) { $p = nm_list_item($item, $ctype, $opt); ?>
        <article class="nm-lead nm-item <?php echo $cls; ?>_list_item">
            <?php nm_list_media($p, $opt, 'nm-lead__media'); ?>
            <div class="nm-lead__body">
                <?php nm_list_cat($p, $opt, 'nm-cat--text'); ?>
                <?php nm_list_title($item, $ctype, $p, 'h3', 'nm-lead__title'); ?>
                <?php if ($opt['meta']) { nm_list_meta($item, ['date_pub', 'user', 'comments']); } ?>
            </div>
        </article>
    <?php } ?>
    <div class="nm-rows" data-nm-items>
    <?php foreach ($items as $item) { $p = nm_list_item($item, $ctype, $opt); ?>
        <article class="nm-row nm-item<?php if (!$p['image']) { ?> nm-row--noimg<?php } ?> <?php echo $cls; ?>_list_item">
            <?php if ($p['image']) { nm_list_media($p, $opt, 'nm-row__media', '16x9', 'large'); } ?>
            <div class="nm-row__body">
                <?php nm_list_title($item, $ctype, $p, 'h4', 'nm-row__title'); ?>
                <?php if ($opt['meta']) { nm_list_meta($item, ['date_pub']); } ?>
            </div>
        </article>
    <?php } ?>
    </div>
</div>
<?php nm_list_end($nm_data, $style, $opt); ?>
