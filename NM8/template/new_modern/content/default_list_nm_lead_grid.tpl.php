<?php
/**
 * Template Name: LANG_NM_LS_LEAD_GRID
 * Template Type: content
 * New Modern: крупная первая запись с заголовком и анонсом поверх фото и сетка карточек ниже
 * Опции стиля (JSON в «Опциях стилей списка» типа контента) — см. assets/nm_list.tpl.php; здесь также lead — число крупных записей
 */
require_once $this->getTemplateFileName('assets/nm_list');
$nm_data = get_defined_vars();
if (!nm_list_start($nm_data)) { return; }
$style = 'nm_lead_grid';
$opt = nm_list_opt($list_opt ?? [], ['cols' => 2, 'lead' => 1]);
$cls = $ctype['name'];

// Крупные записи только на первой странице: подгружаемые страницы дописывают карточки в сетку
$lead = [];
if ((int) $page === 1) { $lead = array_splice($items, 0, max(0, min((int) $opt['lead'], count($items)))); }
?>
<div class="nm-list nm-list--leadgrid content_list <?php echo $cls; ?>_list"<?php echo nm_list_attrs($nm_data, $style, $opt); ?>>
    <?php foreach ($lead as $item) { $p = nm_list_item($item, $ctype, $opt); ?>
        <article class="nm-ov nm-ov--lead nm-ov--wide nm-item <?php echo $cls; ?>_list_item">
            <?php nm_list_media($p, $opt, 'nm-ov__media', '16x9'); ?>
            <div class="nm-ov__body">
                <?php nm_list_cat($p, $opt, 'nm-cat--solid'); ?>
                <?php nm_list_title($item, $ctype, $p, 'h2', 'nm-ov__title nm-stretch'); ?>
                <?php if ($p['teaser']) { ?><p class="nm-ov__teaser"><?php html($p['teaser']); ?></p><?php } ?>
                <?php if ($opt['meta']) { nm_list_meta($item, ['date_pub', 'user', 'comments'], [], 'nm-ov__meta'); } ?>
            </div>
        </article>
    <?php } ?>
    <div class="nm-grid" style="--nm-cols:<?php echo $opt['cols']; ?>" data-nm-items>
    <?php foreach ($items as $item) { $p = nm_list_item($item, $ctype, $opt); ?>
        <article class="nm-card nm-item <?php echo $cls; ?>_list_item">
            <?php nm_list_media($p, $opt, 'nm-card__media'); ?>
            <div class="nm-card__body">
                <?php nm_list_cat($p, $opt, 'nm-cat--text'); ?>
                <?php nm_list_title($item, $ctype, $p, 'h3', 'nm-card__title'); ?>
                <?php if ($opt['meta']) { nm_list_meta($item, [], [], 'nm-card__meta'); } ?>
            </div>
        </article>
    <?php } ?>
    </div>
</div>
<?php nm_list_end($nm_data, $style, $opt); ?>
