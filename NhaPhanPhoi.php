<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="Style/WebTemplate.css">
	<link rel="stylesheet" type="text/css" href="FontAwesome\css\all.css">
        <link rel="icon" href="Images\Logo.PNG" type="image/x-icon">
	<title>Supplier</title>
	<?php
        session_start();
           require __DIR__ . '.\common\configdb.php';
        //    require_once 'db.php';
	$conn = mysqli_connect($servername, $username, $password, $database);
     mysqli_set_charset($conn, "utf8");
     // Check connection
     if (!$conn) {
         die("Connection failed: " . mysqli_connect_error());
         exit();
     }
            $sql = "select * from suplier";
            $result = mysqli_query($conn, $sql);
            if(isset($_POST['btsaveinsert'])){
                $name = $_POST['txtsuppliername'];
                $addr = $_POST['txtaddress'];
                $phone = $_POST['txtphonenumber'];
                $email = $_POST['txtemail'];
		$id = $_POST['txtid'];
                if($name==""||$addr==""||$phone==""||$email=="")
                {
                    echo '<script language ="javascript">alert("The value must not be just space");</script>';
                    mysqli_close($conn);
                }
                else{
                $querry = mysqli_query($conn, "insert into suplier values('".$id."','".$name."', '".$addr."', '".$phone."', '".$email."')");
                if($querry){
                    echo 'Successfully';
					header("Location:NhaPhanPhoi.php");
                }
                else{
                    echo '<script language ="javascript">alert("Insert failed");</script>';
                }
                }
            }
            session_destroy();
            mysqli_close($conn);
    ?>
</head>
<body>
	<!-- popup section for insertion -->
   	<div class="popup" id="Insert">
   		<div class="content">
    	<div class="close-btn" onclick="togglePopupInsert()">×</div>     
		<h1>Insert new record</h1> 
		<form action="NhaPhanPhoi.php" method="post" name="forminsert"> 
			<table cellpadding="10" style="border: none;">
				<tr>
    				<td>
      					<label for="txtid">Supplier Id</label>
    			</td>
    				<td>
                        <div class="input-field"><input name="txtid" placeholder="Supplier name" class="validate" value=""></div>
    				</td>
  				</tr>
  				<tr>
    				<td>
      					<label for="txtsuppliername">Supplier Name</label>
    			</td>
    				<td>
                                    <div class="input-field"><input name="txtsuppliername" placeholder="Supplier name" class="validate" value=""></div>
    				</td>
  				</tr>
    			<tr>
    				<td>
      					<label for="txtaddress">Address</label>
    				</td>
    				<td>
                                    <div class="input-field"><input name="txtaddress" placeholder="Address" class="validate" value=""></div>
    				</td>
   	 			</tr>
    			<tr>
    				<td>
      					<label for="txtphonenumber">Phone Number</label>
    			</td>
    				<td>
                        <div class="input-field"><input name="txtphonenumber" placeholder="Phone number" class="validate" value=""></div>
    				</td>
    			</tr>
    			<tr>
    				<td>
      					<label for="txtemail">Email</label>
    				</td>
    				<td>
                        <div class="input-field"><input name="txtemail" placeholder="Email" class="validate" value=""></div>
    				</td>
  				</tr>

			</table>
                    <input style="cursor: pointer;" class="second-button" type="submit" name="btsaveinsert" value="Save">
		</form>
   		</div>
  	</div>
	<script>
 		function togglePopupInsert() {
 			document.getElementById("Insert").classList.toggle("active");
		}
	</script>
	<div id="container">
            <div id="menu">
		<ul>
                    <li><a href="TrangChu.php"><img src="Images\Logo.PNG" alt="Company's Logo" width="50px" height="50px"></a></li>
                    <li><a href="TrangChu.php"><i class="fa fa-home"></i> Home</a></li>
                    <li><a href="NhaPhanPhoi.php"><i class="fa fa-industry"></i> Supplier</a></li>
                    <li><a href="HangHoa.php"><i class="fa fa-clipboard-list"></i> Products</a></li>
                    <li><a href="Nhap.php"><i class="fa fa-arrow-alt-circle-down"></i> Import</a></li>
                    <li><a href="Xuat.php"><i class="fa fa-arrow-alt-circle-up"></i> Export</a></li>
                    
                    <li><a href="ThongKe.php"><i class="fa fa-chart-line"></i> Analyze</a></li>
                    <li><a href="Logout.php"><i class="fa fa-sign-out-alt"></i> Sign out</a></li>
		</ul>
            </div>
            <div id="content">
            	<div id="searcharea">
            		<div id="search">
            		<input style="background-color:whitesmoke; height: 30px; border: none; width: 250px;" type="search" name="ipsearch" name="ipsearch" placeholder="Search for id">
					<input id="buttonsearch" type="submit" name="btsearch" value="Search"/>
					<input id="buttonsearch" type="submit" name="btviewall" value="View all"/>
					<input id="buttonsearch" type="submit" name="btinsert" value="Insert" onclick="togglePopupInsert()"/>
            		</div>
            	</div>
			<div id="item">
				<div id="datatable">
				<table cellpadding="5" style="margin-bottom: 5%;">
                                        <tr style="background-color: aqua; color:black;">
                                            <td><label>Supplier ID</label></td>
                                            <td><label>Supplier Name</label></td>
                                            <td><label>Address</label></td>
                                            <td><label>Phone Number</label></td>
                                            <td><label>Email</label></td>
                                            <td style="text-align: center;">Tools</td>
										</tr>
										<?php 
                                            while ($row = mysqli_fetch_assoc($result))
                                                {
                                        ?>
										<tr>
                                            <td><?php echo $row['Id'] ?></td>
                                            <td><?php echo $row['SuplierName'] ?></td>
                                            <td><?php echo $row['Address'] ?></td>
                                            <td><?php echo $row['PhoneNumber'] ?></td>
                                            <td><?php echo $row['Email'] ?></td>
						<?php 
							echo"<td><a href='edit_supplier.php?id=".$row['Id']."'>Edit</a><a href='delete.php?id=".$row['Id']."&page=NhaPhanPhoi.php'>Delete</a></td>";
											?>
                                            
						</tr>
                                        <?php }?>
				</table>
				</div>
			</div>
		</div>
            <div id="contact">
                <p style="color: white; padding: 10px;">Powered by Group 14</p>
            </div>
        </div>
</body> 
</html>
