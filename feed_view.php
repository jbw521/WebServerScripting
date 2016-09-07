<?php include('../bin/logged_top.php'); ?>
	<h3>FEED ME</h3>
	<iframe width="560" height="315" src="https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=0" frameborder="0" allowfullscreen></iframe>
	
	<div id="rightColumnUsers">
		<form id="userSidebarForm" method="POST" action=".">
			<input type="radio" name="userListType" value="all" checked />All</br>
			<input type="radio" name="userListType" value="newest" />Newest</br>
			<input type="radio" name="userListType" value="mostComments" />Most Comments</br>
			<input type="hidden" name="action" value="changeUserListType" />
			<input type="submit" value="Filter" />
		</form>
		<table>
		<?php foreach($users_sidebar as $list_user): ?>
			<tr>
				<td><a href=".?action=profile&alias=<?php echo htmlspecialchars($list_user['alias']); ?>"><?php echo htmlspecialchars($list_user['alias']); ?></a></td>
				<td><?php echo htmlspecialchars($list_user['fname']); ?></td>
				<td><?php echo htmlspecialchars($list_user['lname']); ?></td>
			</tr>
		<?php endforeach; ?>
		</table>
	</div>
<?php include('../bin/master_bottom.php'); ?>