<?php
/**
 * Template Name: LANG_NM_LS_TOP
 * Template Type: content
 * New Modern: нумерованный топ: место, миниатюра, заголовок, мета
 * Опции стиля (JSON в «Опциях стилей списка» типа контента) — см. assets/nm_list.tpl.php
 */
require_once $this->getTemplateFileName('assets/nm_list');
$nm_data = get_defined_vars();
if (!nm_list_start($nm_data)) { return; }
$style = 'nm_top';
$opt = nm_list_opt($list_opt ?? [], ['teaser_lines' => 1]);
$cls = $ctype['name'];
?>
<div class="nm-list nm-list--top content_list <?php echo $cls; ?>_list"<?php echo nm_list_attrs($nm_data, $style, $opt); ?>>
    <div class="nm-rows" data-nm-items>
    <?php $num = ((int) $page - 1) * (int) $perpage; foreach ($items as $item) { $num++; $p = nm_list_item($item, $ctype, $opt); ?>
        <article class="nm-top nm-item<?php if ($num <= 3) { ?> nm-top--best<?php } ?> <?php echo $cls; ?>_list_item">
            <span class="nm-top__num"><?php echo $num; ?></span>
            <?php if ($p['image']) { nm_list_media($p, $opt, 'nm-top__media', '1x1', 'small'); } ?>
            <div class="nm-top__body">
                <?php nm_list_title($item, $ctype, $p, 'h3', 'nm-top__title'); ?>
                <?php if ($p['teaser']) { ?><p class="nm-teaser" style="--nm-lines:<?php echo (int) $opt['teaser_lines']; ?>"><?php html($p['teaser']); ?></p><?php } ?>
                <?php if ($opt['meta']) { nm_list_meta($item); } ?>
            </div>
        </article>
    <?php } ?>
    </div>
</div>
<?php nm_list_end($nm_data, $style, $opt); ?>
