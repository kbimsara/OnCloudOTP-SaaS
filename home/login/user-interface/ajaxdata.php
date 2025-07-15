<?php
require_once './config.php';

//User data
if (isset($_POST['groupID'])) {
	$groupID = $_POST['groupID'];
	$st = $_POST['st'];
	$split = preg_split("/:/", $groupID);
	// if($split){}
	if($st==""){
		$b=" ";
	}else{
		$b=" AND `otp_status`=$st";
	}

	if ($split[0] == "11") {
		$sql = "SELECT * FROM `c-group` JOIN `otp` ON `c-group`.`g_id`=`otp`.`g_id` WHERE `c-group`.`email`='$split[1]';";
	} else {
		$sql = "SELECT * FROM `otp` WHERE g_id='$groupID';";
	}

	$result = mysqli_query($Connector, $sql);
	$i = 0;
	while ($row = mysqli_fetch_array($result)) {
		$i++;
		$otp  = $row['otp'];
		$email  = $row['email'];
		$time  = $row['time'];
		$g_id  = $row['g_id'];
		$otp_status  = $row['otp_status'];
?>
		<tr>
			<th scope="row"><?php echo "$i"; ?></th>
			<td><?php echo "$otp"; ?></td>
			<td><?php echo "$email"; ?></td>
			<td><?php echo "$time"; ?></td>
			<td><?php echo "$g_id"; ?></td>
			<td><?php echo "$otp_status"; ?></td>
		</tr>
	<?php
	}
	if ($i < 1) {
	?>
		<tr style="text-align: center;">
			<td colspan="6">No Group Members Here !!</td>
		</tr>
	<?php
	}
} elseif (isset($_POST['st'])) {
	$st = $_POST['st'];
	$groupID = $_POST['g_id'];
	// echo "<script>alert(" . $groupID . ")</script>";

	$split = preg_split("/:/", $groupID);

	if ($split[0] == "11") {
		$sql = "SELECT * FROM `c-group` JOIN `otp` ON `c-group`.`g_id`=`otp`.`g_id` WHERE `c-group`.`email`='$split[1]' AND `otp`.`otp_status`='$st';";
	} else {
		$sql = "SELECT * FROM `otp` WHERE g_id='$groupID' AND otp_status='$st';";
	}

	$result = mysqli_query($Connector, $sql);
	$i = 0;
	while ($row = mysqli_fetch_array($result)) {
		$i++;
		$otp  = $row['otp'];
		$email  = $row['email'];
		$time  = $row['time'];
		$g_id  = $row['g_id'];
		$otp_status  = $row['otp_status'];
	?>
		<tr>
			<th scope="row"><?php echo "$i"; ?></th>
			<td><?php echo "$otp"; ?></td>
			<td><?php echo "$email"; ?></td>
			<td><?php echo "$time"; ?></td>
			<td><?php echo "$g_id"; ?></td>
			<td><?php echo "$otp_status"; ?></td>
		</tr>
	<?php
	}
	if ($i < 1) {
	?>
		<tr style="text-align: center;">
			<td colspan="6">No Group Members Here !!</td>
		</tr>
<?php
	}
}
