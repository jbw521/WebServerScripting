<?php include('./bin/master_top.php'); ?>
            <div id='loginForm'>
            <form action="index.php" method="post">
                
                <?php if( !empty($error_message)) { ?>
                    <p class="error"><?php echo $error_message ?></p><br>
                <?php } ?>
                    
                <label>Username:</label>
                <input type="text" name="username"><br>
                
                <label>Password:</label>
                <input type="password" name="password"><br>
				
				<input type="hidden" name="action" value="login" />
                
            </div>
            <div id='buttons'>
                <input type="submit" value="Log In" /> or <a href="index.php?action=reg">register</a>.
            </div>
            </form>
        </main>
<?php include('./bin/master_bottom.php'); ?>