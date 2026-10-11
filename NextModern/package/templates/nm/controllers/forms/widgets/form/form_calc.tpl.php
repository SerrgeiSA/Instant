
<div class="position-relative icms-forms__wrap pl-3 pr-3" id="form_calc">
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
			
		   $('#form_calc .buttons .btn').addClass('d-flex align-items-center theme-btn-lg-wide rounded-pill');
		   $('#form_calc .buttons .btn span').html('Заказать фон');
		   $('#form_calc .buttons').before('<div id="form_calc_summ" class="d-flex h4"><div class="mr-2">Итого:</div><span class="mr-1">0</span>₽</div>');
		   
		   $('#form_calc .buttons').after('<div class="text-muted theme-text-normal mt-4">После отправки формы я свяжусь с Вами в течении 15 минут</div>');
		   
		   $('#form_calc .input-number').attr('min','0').attr('type','number').val('');
		   
		   var form_calc_summ_div = $('#form_calc_summ span');	
		   var form_calc_summ_target = $('#form_calc_summ span');	
		   var form_id = $("#form_calc form").attr('id');
			
		    $("#form_calc form .input-number").on("input, keyup", function(ths){		
			
				  if(
				  $(this).attr('id')==form_id+'_fon_desktop'
				  ||
				  $(this).attr('id')==form_id+'_logos'
			      ||
				  $(this).attr('id')==form_id+'_images'
				  ){
					  
					 	formCalc($(this)); 
					}
					
			
			});	
			
		    $("#form_calc form .input-checkbox").on("change", function(ths){		
			
				  if(
				  $(this).attr('id')==form_id+'_fon_desktop'
				  ||
				  $(this).attr('id')==form_id+'_logos'
			      ||
				  $(this).attr('id')==form_id+'_images'
				  ){
					  
					 	formCalc($(this)); 
					}
					
			
			});
			
	
		
			function formCalc(ths){
				
			    var current_summ = parseInt(form_calc_summ_target);
				var new_summ = 0;
				var sum = 0;
				
				$("#form_calc form .input-number, #form_calc form .input-checkbox").each(function() {
					
				
					if($(this).attr('id')==form_id+'_fon_desktop' && $(this).prop('checked')==true){
					    new_summ += 2000;						
					}
					if($(this).attr('id')==form_id+'_logos' && parseInt($(this).val()) > 0){
					    new_summ += 300 * parseInt(ths.val());
					}
					if($(this).attr('id')==form_id+'_images' && parseInt($(this).val()) > 0){
						new_summ += 50 * parseInt($(this).val());
					}
			
				
					
                });
				 
				form_calc_summ_target.html(new_summ);
			
				
				
			}
			
		});
			
			
		</script>
<?php $this->addBottom(ob_get_clean()); ?>