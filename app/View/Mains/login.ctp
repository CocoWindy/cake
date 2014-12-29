<?php 
	if(!empty($User))
	{
		echo 'welcome '.$User['User']['name'];
		echo '<br>';
		echo '<form method="post"><button type="submit">logout</button></form>';
	}
	else
	{
		echo '<form method="post">
				<input type="text" placeholder="input your username" name="username">
				<input type="password" placeholder="input your password" name="password">
				<button type="submit">login</button>
				</form>';
	}
?>
