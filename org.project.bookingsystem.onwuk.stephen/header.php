<div id="topWraper">
	<div id="userContainer">
		<div id="userIndicator">
			<img src="images/user.png" id="userIcon"><label id="lblUserName">
			<?php
			
if (isset ( $_SESSION ['loggedIn'] )) {
				echo $_SESSION ['userName'];
}
			
			?>
			</label>
		</div>
		<div id="login">
			<a href="logout.php" class="btnRegister">Log out</a>
		</div>
	</div>
	<div id="navMenu">
		<ul>
			<li><a href="findRoom.php?roomname=G107">Room Details</a></li>
		</ul>

		<ul>
			<li><a href="account.php?view=details">Account</a>
		
		</ul>
		<ul>
			<li><a href="#">Contact Us</a></li>

		</ul>
		<?php
		
if (isset ( $_SESSION ['loggedIn'] )) {
			if ($_SESSION ['accessLevel'] == "AL") {
				echo "<ul>
			<li><a href='admin.php'>ADMIN AREA</a></li>
		
		</ul>";
			}
		}
		?>
		
	</div>

</div>