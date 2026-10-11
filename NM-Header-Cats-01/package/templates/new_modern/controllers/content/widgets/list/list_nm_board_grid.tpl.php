<?php
/**
 * Template Name: LANG_NM_LS_BOARD_GRID
 * Template Type: widget
 * New Modern: объявления плиткой: фото, цена, заголовок, место, дата
 * Для виджета «Список контента»: картинка, анонс и цена определяются по типам полей, подгрузки и фильтра нет
 */
require_once $this->getTemplateFileName('assets/nm_list');
nm_list_mode('widget');
$page    = 1;
$perpage = !empty($items) && is_array($items) ? count($items) : 0;
$nm_data = get_defined_vars();
if (!nm_list_start($nm_data)) { return; }
$style = 'nm_board_grid';
$opt = nm_list_opt($list_opt ?? [], ['cols' => 4, 'ratio' => '4x3']);
$cls = $ctype['name'];
?>
<div class="nm-list nm-list--board-grid content_list <?php echo $cls; ?>_list"<?php echo nm_list_attrs($nm_data, $style, $opt); ?>>
    <div class="nm-grid nm-grid--tight" style="--nm-cols:<?php echo $opt['cols']; ?>" data-nm-items>
    <?php foreach ($items as $item) { $p = nm_list_item($item, $ctype, $opt); ?>
        <article class="nm-adt nm-item<?php if ($p['highlight']) { ?> is-highlight<?php } ?> <?php echo $cls; ?>_list_item">
            <?php nm_list_media($p, $opt, 'nm-adt__media'); ?>
            <div class="nm-adt__body">
                <?php if ($p['has_price']) { ?><div class="nm-price nm-adt__price"><?php echo $p['price'] ?: '<span class="text-muted">' . LANG_NM_NO_PRICE . '</span>'; ?></div><?php } ?>
                <?php nm_list_title($item, $ctype, $p, 'h3', 'nm-adt__title nm-stretch'); ?>
                <div class="nm-adt__info">
                    <?php if ($p['subtitle']) { ?><span><?php html($p['subtitle']); ?></span><?php } elseif ($p['category']) { ?><span><?php html($p['category']['title']); ?></span><?php } ?>
                    <span><?php echo html_date($item['date_pub']); ?></span>
                </div>
            </div>
        </article>
    <?php } ?>
    </div>
</div>
<?php nm_list_end($nm_data, $style, $opt); ?>
