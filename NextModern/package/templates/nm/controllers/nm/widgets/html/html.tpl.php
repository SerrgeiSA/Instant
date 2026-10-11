<?php echo $html; ?>

<?php $this->addBottom($widget->options['styles']); ?>
<?php $this->addBottom($widget->options['scripts']); ?>

<?php $this->addBottom('<style>'.$widget->options['css'].'</style>'); ?>
<?php $this->addBottom('<script type="text/javascript">'.$widget->options['js'].'</script>'); ?>
	
	
