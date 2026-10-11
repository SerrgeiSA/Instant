<?php
/**
 * Template Name: LANG_NM_LS_NEWS
 * Template Type: content
 * New Modern: лента новостей с группировкой по дням и временем
 * Опции стиля (JSON в «Опциях стилей списка» типа контента) — см. assets/nm_list.tpl.php
 */
require_once $this->getTemplateFileName('assets/nm_list');
$nm_data = get_defined_vars();
if (!nm_list_start($nm_data)) { return; }
$style = 'nm_news';
$opt = nm_list_opt($list_opt ?? [], ['teaser_lines' => 2]);
$cls = $ctype['name'];
?>
<div class="nm-list nm-list--news content_list <?php echo $cls; ?>_list"<?php echo nm_list_attrs($nm_data, $style, $opt); ?>>
    <div class="nm-feed" data-nm-items>
    <?php $day_key = null; foreach ($items as $item) { $p = nm_list_item($item, $ctype, $opt); $day = nm_list_day($item['date_pub']); ?>
        <?php if ($day['key'] !== $day_key) { $day_key = $day['key']; ?>
            <div class="nm-day" data-nm-day="<?php echo $day['key']; ?>" data-nm-day-head><?php echo $day['title']; ?></div>
        <?php } ?>
        <article class="nm-news nm-item <?php echo $cls; ?>_list_item">
            <time class="nm-news__time" datetime="<?php echo date('c', strtotime($item['date_pub'])); ?>"><?php echo date('H:i', strtotime($item['date_pub'])); ?></time>
            <div class="nm-news__body">
                <?php nm_list_title($item, $ctype, $p, 'h3', 'nm-news__title'); ?>
                <?php if ($p['teaser']) { ?><p class="nm-teaser" style="--nm-lines:<?php echo (int) $opt['teaser_lines']; ?>"><?php html($p['teaser']); ?></p><?php } ?>
                <div class="nm-news__foot">
                    <?php nm_list_cat($p, $opt, 'nm-cat--text'); ?>
                    <?php if ($opt['meta']) { nm_list_meta($item, [], ['date_pub']); } ?>
                </div>
            </div>
            <?php if ($p['image']) { nm_list_media($p, $opt, 'nm-news__media', '4x3', 'small'); } ?>
        </article>
    <?php } ?>
    </div>
</div>
<?php nm_list_end($nm_data, $style, $opt); ?>
