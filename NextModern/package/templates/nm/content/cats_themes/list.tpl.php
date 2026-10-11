<div class="list-group mt-m2">
<?php foreach($cats as $c){ ?>	

             <a href="<?php echo $c['list_params']['href']; ?>" class="list-group-item"><?php echo $c['title']; ?></a>
			 
<?php   }  ?>
</div>


		