<?php include('./bin/master_top.php'); ?>
			<div id='loginForm'>
			
				<?php if( !empty($error_message)) { ?>
                    <p class="error"><?php echo $error_message ?></p><br>
                <?php } ?>
				

				<input type='hidden' name='action' value='register' />
<?php include('./bin/master_bottom.php'); ?>