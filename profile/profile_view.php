<?php include('../bin/logged_top.php'); ?>
	<img src="../img/user/<?php echo htmlspecialchars($profile_pic); ?>" alt="userpic" height="64" width="64" id="ppic">
	<h4>Profile of <?php print(htmlspecialchars($f_name) . ' ' . htmlspecialchars($l_name)); ?></h4>
<?php include('../bin/master_bottom.php'); ?>