<?php include('../bin/logged_top.php'); ?>
			<div id='loginForm'>
            <form action='index.php?action=update_profile' method='post'>
				<label>Update Info For: <strong></strong><?php echo $_SESSION['userdata']['alias']; ?></strong></label></br>
				<?php if( !empty($error_message)) { ?>
                    <p class="error"><?php echo $error_message ?></p><br>
                <?php } ?>
				
                <label>First Name:</label>
                <input type='text' name='firstname' value="<?php echo $_SESSION['userdata']['fname']; ?>"><br>
                
                <label>Last Name:</label>
                <input type='text' name='lastname' value="<?php echo $_SESSION['userdata']['lname']; ?>"><br>
                
                <label>Email Address:</label>
                <input type='email' name='emailaddress' value="<?php echo $_SESSION['userdata']['email']; ?>"><br>
				
				<label>Password:</label>
                <input type='password' name='password'><br> 

				<label>Confirm Password:</label>
                <input type='password' name='confirmpassword'><br>
				<label>Profile Picture:</label>
				<input type="file" name="img" accept="image/*"></br>
            </div>
			<input type="hidden" name="action" value="update_profile" />
            <div id='buttons'>
                <input type='submit' value='Update' />
            </div>
            </form>
<?php include('../bin/master_bottom.php');

?>
