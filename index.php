<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		$redis = new Redis() or die('Cannot load Redis ...');

		$pname = $_POST['pname'];
		$pclub = $_POST['pclub'];
		$pcountry = $_POST['pcountry'];
		$gfclub = $_POST['gfclub'];
		$gfcountry = $_POST['gfcountry'];

		if(isset($_POST['cactive'])) {
			$cactive = 1;
		} else {
			$cactive = 0;
		}

		if( $redis->connect('localhost', 6379) ) {
			//echo 'Connected to Redis ...';
		} else {
			echo 'Cannot connect to Redis ...';
		}

		$redis->incr('pcnt');
		$key = 'playerprofile:'.$redis->get('pcnt');
		//echo $key;
		$redis->hmset(
			$key, 
			array(
				"pname" => $pname,
				"pclub" => $pclub,
				"pcountry" => $pcountry,
				"gfclub" => $gfclub,
				"gfcountry" => $gfcountry,
				"cactive" => $cactive
				)
		);
	} else {
		//echo 'Enter player information';
	}
?>
<html>
	<head>
		<title>PHP With Redis - Add Players</title>
	</head>

	<body style="background: url(images/polka_dots.gif);">
		<p style="height: 30px; width: 220px; top: 4%; position: absolute; margin-left: 20%; background: url(images/table_header.jpg); border: solid 2px green; border-radius: 5px; padding-top: 5px; padding-left: 10px;">
				<a href="player.php" style="text-decoration: none; color: black;">View Players Information</a>
		</p>

		<p style="height: 30px; width: 220px; top: 2%; position: absolute; margin-left: 50%; background: url(images/table_header.jpg); border: solid 2px green; border-radius: 5px; padding-top: 5px; padding-left: 10px;">
			<a href="index.php" style="text-decoration: none; color: black;">Add Player</a>
		</p>

		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<fieldset style="width: 440px; left: 30%; top: 10%; position: absolute; background: url(images/table_header.jpg)">
				<legend align="right">Player Profile</legend>
				<table>
					<tr>
						<td>
							Player Name
						</td>

						<td>
							<input type="text" name="pname" />
						</td>
					</tr>

					<tr>
						<td>
							Club
						</td>

						<td>
							<input type="text" name="pclub" />
						</td>
					</tr>

					<tr>
						<td>
							Country
						</td>

						<td>
							<input type="text" name="pcountry" />
						</td>
					</tr>

					<tr>
						<td>
							Goals for Club
						</td>

						<td>
							<input type="text" name="gfclub" />
						</td>
					</tr>

					<tr>
						<td>
							Goals for Country
						</td>

						<td>
							<input type="text" name="gfcountry" />
						</td>
					</tr>

					<tr>
						<td>
							Currently Active
						</td>

						<td>
							<input type="checkbox" name="cactive" />
						</td>
					</tr>

					<tr>
						<td colspan="2" align="right">
							<input type="submit" value="Submit Profile" />
						</td>
					</tr>
				</table>
			</fieldset>
		</form>

	</body>
</html>