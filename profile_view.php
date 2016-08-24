<?php include('../bin/logged_top.php'); ?>
	<img src="../img/user/<?php echo $_SESSION['userdata']['profilepic'] ?>" alt="userpic" height="64" width="64" id="ppic">
	<h4>Profile of <?php print($_SESSION['userdata']['fname'] . ' ' . $_SESSION['userdata']['lname']); ?></h4>
<?php include('../bin/master_bottom.php'); ?>