<?php
/**
 * Template Name: LANG_NM_LS_MAGAZINE
 * Template Type: widget
 * New Modern: журнал: главная запись, колонка свежих и сетка
 * Для виджета «Список контента»: картинка, анонс и цена определяются по типам полей, подгрузки и фильтра нет
 */
require_once $this->getTemplateFileName('assets/nm_list');
nm_list_mode('widget');
$page    = 1;
$perpage = !empty($items) && is_array($items) ? count($items) : 0;
$nm_data = get_defined_vars();
if (!nm_list_start($nm_data)) { return; }
$style = 'nm_magazine';
$opt = nm_list_opt($list_opt ?? [], ['cols' => 3]);
$cls = $ctype['name'];
?>
<div class="nm-list nm-list--magazine content_list <?php echo $cls; ?>_list"<?php echo nm_list_attrs($nm_data, $style, $opt); ?>>
    <?php
    // Блок «главное» только на первой странице, подгружаемые страницы идут в сетку
    $lead = [];
    if ((int) $page === 1) { $lead = array_splice($items, 0, min(5, count($items))); }
    ?>
    <?php if ($lead) { $first = array_shift($lead); $p = nm_list_item($first, $ctype, $opt); ?>
    <div class="nm-mag<?php if (!$lead) { ?> nm-mag--single<?php } ?>">
        <article class="nm-ov nm-ov--lead nm-item <?php echo $cls; ?>_list_item">
            <?php nm_list_media($p, $opt, 'nm-ov__media', '4x3'); ?>
            <div class="nm-ov__body">
                <?php nm_list_cat($p, $opt, 'nm-cat--solid'); ?>
                <?php nm_list_title($first, $ctype, $p, 'h2', 'nm-ov__title nm-stretch'); ?>
                <?php if ($p['teaser']) { ?><p class="nm-ov__teaser"><?php html($p['teaser']); ?></p><?php } ?>
                <?php nm_list_meta($first, ['date_pub', 'user', 'comments'], [], 'nm-ov__meta'); ?>
            </div>
        </article>
        <?php if ($lead) { ?>
        <div class="nm-mag__side">
            <?php foreach ($lead as $item) { $p = nm_list_item($item, $ctype, $opt); ?>
                <article class="nm-mini nm-item <?php echo $cls; ?>_list_item">
                    <?php if ($p['image']) { nm_list_media($p, $opt, 'nm-mini__media', '1x1', 'small'); } ?>
                    <div class="nm-mini__body">
                        <?php nm_list_cat($p, $opt, 'nm-cat--text'); ?>
                        <?php nm_list_title($item, $ctype, $p, 'h4', 'nm-mini__title'); ?>
                        <?php nm_list_meta($item, ['date_pub', 'comments']); ?>
                    </div>
                </article>
            <?php } ?>
        </div>
        <?php } ?>
    </div>
    <?php } ?>
    <div class="nm-grid" style="--nm-cols:<?php echo $opt['cols']; ?>" data-nm-items>
    <?php foreach ($items as $item) { $p = nm_list_item($item, $ctype, $opt); ?>
        <article class="nm-card nm-item <?php echo $cls; ?>_list_item">
            <?php nm_list_media($p, $opt, 'nm-card__media'); ?>
            <div class="nm-card__body">
                <?php nm_list_cat($p, $opt, 'nm-cat--text'); ?>
                <?php nm_list_title($item, $ctype, $p, 'h3', 'nm-card__title'); ?>
                <?php if ($p['teaser']) { ?><p class="nm-teaser" style="--nm-lines:2"><?php html($p['teaser']); ?></p><?php } ?>
                <?php if ($opt['meta']) { nm_list_meta($item, ['date_pub', 'comments'], [], 'nm-card__meta'); } ?>
            </div>
        </article>
    <?php } ?>
    </div>
</div>
<?php nm_list_end($nm_data, $style, $opt); ?>
