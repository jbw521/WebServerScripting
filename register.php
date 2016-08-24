<?php include('./bin/master_top.php'); ?>
			<div id='loginForm'>
            <form action='index.php' method='post'>
			
				<?php if( !empty($error_message)) { ?>
                    <p class="error"><?php echo $error_message ?></p><br>
                <?php } ?>
				
                <label>First Name:</label>
                <input type='text' name='firstname'><br>
                
                <label>Last Name:</label>
                <input type='text' name='lastname'><br>
				
				<label>UserName:</label>
                <input type='text' name='username'><br>
                
                <label>Email Address:</label>
                <input type='email' name='emailaddress'><br>
				
				<label>Password:</label>
                <input type='text' name='password'><br> 

				<label>Confirm Password:</label>
                <input type='text' name='confirmpassword'><br> 		

				<input type='hidden' name='action' value='register' />
            </div>
            <div id='buttons'>
                <input type='submit' value='Register' />
            </div>
            </form>
<?php include('./bin/master_bottom.php'); ?>