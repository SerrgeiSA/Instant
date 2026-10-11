<?php
    $this->addTplJSName([
        'forms-constructor'
    ]);
?>
<div class="position-relative icms-forms__wrap nm_form" id="nm_form_order">
    <?php if($form_data['title'] && !empty($form_data['options']['show_title'])){ ?>
        <h4><?php echo $form_data['title']; ?></h4>
    <?php } ?>
    <?php if($form_data['description']){?>
        <?php echo $form_data['description']; ?>
    <?php } ?>
    <?php $this->renderForm($form, [], $form_data['params'], false); ?>
</div>

<?php ob_start(); ?>
<script>
		
$(function (){

$('#nm_form_order .buttons button').addClass('w-100');	
$('#nm_form_order .buttons button span').html('Заказать');

});
	
</script>
<?php $this->addBottom(ob_get_clean()); ?>