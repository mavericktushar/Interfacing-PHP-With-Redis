<?php
	$redis = new Redis() or die('Cannot load Redis ...');

	if( $redis->connect('localhost', 6379) ) {
		//echo 'Connected to Redis ...';
	} else {
		echo 'Cannot connect to Redis ...';
	}

	/*echo*/ $pcnt = $redis->get('pcnt');
?>
<html>

<head>


	<link href="css/stripy-style.css" rel="stylesheet" type="text/css">
	
	
	<title>
		PHP With Redis - Stripy Players Tables
	</title>

</head>

<body>
	
	<div>
		<div style="width: 100%; float: left;">
			<p style="height: 30px; width: 220px; top: 2%; position: absolute; margin-left: 20%; background: url(images/table_header.jpg); border: solid 2px green; border-radius: 5px; padding-top: 5px; padding-left: 10px;">
				<a href="player.php" style="text-decoration: none; color: black;">View Players Information</a>
			</p>

			<p style="height: 30px; width: 220px; top: 2%; position: absolute; margin-left: 50%; background: url(images/table_header.jpg); border: solid 2px green; border-radius: 5px; padding-top: 5px; padding-left: 10px;">
				<a href="index.php" style="text-decoration: none; color: black;">Add Player</a>
			</p>
	
			<table class="stripy-table">
			
				<thead>
				
					<tr>
					
						<th scope="col">
						Player
						</th>
					
					
						<th scope="col">
						Team/Club
						</th>
						
						<th scope="col">
						Goals
						</th>
						
						<th scope="col">
						Currently Active
						</th>
						
					</tr>
				
				</thead>
				
				<tbody>
				
					<?php
						for($i = 1; $i <= $pcnt; $i++) {
							$plarr = $redis->hgetall('playerprofile:'.$i);

							if(!empty($plarr)) {
								//print_r($plarr);
					?>

					<tr>
						<td><?php echo $plarr['pname']; ?></td>
						<td><?php echo $plarr['pclub'].'/'.$plarr['pcountry']; ?></td>
						<td><?php echo $plarr['gfclub'].'/'.$plarr['gfcountry']; ?></td>
						<td style="text-align:center">
							<?php
								if($plarr['cactive']) {
							?>
									<img src="images/tick.gif" />
							<?php
								} else {
							?>
									<img src="images/cross.gif" />
							<?php
								}
							?>
						</td>
					</tr>

					<?php
							}
						}
					?>
					
				</tbody>
			
			</table>
		<div>

	    <div style="width: 100%; float: left;">
			
		</div>
	</div>
	
	<script type="text/javascript" src="stripy.js"></script>
	
</body>

</html>