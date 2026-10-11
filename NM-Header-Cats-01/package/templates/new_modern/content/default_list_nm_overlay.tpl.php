<?php
/**
 * Template Name: LANG_NM_LS_OVERLAY
 * Template Type: content
 * New Modern: карточки с заголовком поверх фото
 * Опции стиля (JSON в «Опциях стилей списка» типа контента) — см. assets/nm_list.tpl.php
 */
require_once $this->getTemplateFileName('assets/nm_list');
$nm_data = get_defined_vars();
if (!nm_list_start($nm_data)) { return; }
$style = 'nm_overlay';
$opt = nm_list_opt($list_opt ?? [], ['cols' => 3, 'ratio' => '4x3']);
$cls = $ctype['name'];
?>
<div class="nm-list nm-list--overlay content_list <?php echo $cls; ?>_list"<?php echo nm_list_attrs($nm_data, $style, $opt); ?>>
    <div class="nm-grid" style="--nm-cols:<?php echo $opt['cols']; ?>" data-nm-items>
    <?php foreach ($items as $item) { $p = nm_list_item($item, $ctype, $opt); ?>
        <article class="nm-ov nm-item <?php echo $cls; ?>_list_item">
            <?php nm_list_media($p, $opt, 'nm-ov__media'); ?>
            <div class="nm-ov__body">
                <?php nm_list_cat($p, $opt, 'nm-cat--solid'); ?>
                <?php nm_list_title($item, $ctype, $p, 'h3', 'nm-ov__title nm-stretch'); ?>
                <?php if ($opt['meta']) { nm_list_meta($item, ['date_pub', 'user', 'comments'], [], 'nm-ov__meta'); } ?>
            </div>
        </article>
    <?php } ?>
    </div>
</div>
<?php nm_list_end($nm_data, $style, $opt); ?>
