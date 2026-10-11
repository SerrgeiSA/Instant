<?php
/**
 * Template Name: LANG_NM_LS_TIMELINE
 * Template Type: widget
 * New Modern: хронология: вертикальная линия с датами
 * Для виджета «Список контента»: картинка, анонс и цена определяются по типам полей, подгрузки и фильтра нет
 */
require_once $this->getTemplateFileName('assets/nm_list');
nm_list_mode('widget');
$page    = 1;
$perpage = !empty($items) && is_array($items) ? count($items) : 0;
$nm_data = get_defined_vars();
if (!nm_list_start($nm_data)) { return; }
$style = 'nm_timeline';
$opt = nm_list_opt($list_opt ?? [], ['ratio' => '16x9', 'teaser_lines' => 3]);
$cls = $ctype['name'];
?>
<div class="nm-list nm-list--timeline content_list <?php echo $cls; ?>_list"<?php echo nm_list_attrs($nm_data, $style, $opt); ?>>
    <div class="nm-tl" data-nm-items>
    <?php foreach ($items as $item) { $p = nm_list_item($item, $ctype, $opt); ?>
        <article class="nm-tl__item nm-item <?php echo $cls; ?>_list_item">
            <time class="nm-tl__date" datetime="<?php echo date('c', strtotime($item['date_pub'])); ?>"><?php echo html_date($item['date_pub']); ?> <span><?php echo date('H:i', strtotime($item['date_pub'])); ?></span></time>
            <div class="nm-tl__card">
                <?php if ($p['image']) { nm_list_media($p, $opt, 'nm-tl__media'); } ?>
                <div class="nm-tl__body">
                    <?php nm_list_cat($p, $opt, 'nm-cat--text'); ?>
                    <?php nm_list_title($item, $ctype, $p, 'h3', 'nm-tl__title'); ?>
                    <?php if ($p['teaser']) { ?><p class="nm-teaser" style="--nm-lines:<?php echo (int) $opt['teaser_lines']; ?>"><?php html($p['teaser']); ?></p><?php } ?>
                    <?php if ($opt['meta']) { nm_list_meta($item, [], ['date_pub']); } ?>
                </div>
            </div>
        </article>
    <?php } ?>
    </div>
</div>
<?php nm_list_end($nm_data, $style, $opt); ?>
