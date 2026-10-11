<?php if ($field->title) { ?><label for="<?php echo $field->id; ?>"><?php echo $field->title; ?></label><?php } ?>
<div class="hint text-muted">Каждая новая ссылка вводиться с новой строки</div>
<?php echo html_textarea($field->element_name, $value); ?>
<?php if($field->getOption('show_symbol_count')){ ob_start(); ?>

<?php $this->addBottom(ob_get_clean()); }
