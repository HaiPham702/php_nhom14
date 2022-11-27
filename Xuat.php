<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="Style/WebTemplate.css">
	<link rel="stylesheet" type="text/css" href="FontAwesome\css\all.css">
        <link rel="icon" href="Images\Logo.PNG" type="image/x-icon">
	<title>Export</title>
	<?php
        session_start();
            $_SESSION = session_id();
            require __DIR__ . '.\common\configdb.php';
	//$servername = "localhost";
          //  $database = "qlkho";
            //$username = "root";
            //$password = "v!nhMysqlpw$";
            // Create connection
            $conn = mysqli_connect($servername, $username, $password, $database);
            mysqli_set_charset($conn, "utf8");
            // Check connection
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
                exit();
            }
            
//            if(isset($_POST['btsave'])){
//                $name = $_POST['txtsuppliername'];
//                $addr = $_POST['txtaddress'];
//                $phone = $_POST['txtphonenumber'];
//                $email = $_POST['txtemail'];
//                $querry = mysqli_query($conn, "insert into suplier(SuplierName, Address, PhoneNumber, Email) values('".$name."', '".$addr."', '".$phone."', '".$email."')");
//                if($querry){
//                    echo 'Successfully';
//                }
//                else{
//                    echo '<script language ="javascript">alert("Insert failed");</script>';
//                }
//            }
                $sql = "select * from receipt where ReceiptType=1;";
                $result = mysqli_query($conn, $sql);
            if(isset($_POST['ipsearch'])||isset($_POST['btsearch'])){
                $id = $_POST['ipsearch'];
                $sql = "select * from receipt where Id = '".$id."';";
                $result = mysqli_query($conn, $sql);
                header("location: Xuat.php");
            }
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
      					<label for="txtsuppliername">Supplier Name</label>
    			</td>
    				<td>
                                    <div class="input-field"><input name="txtsuppliername" placeholder="Supplier name" class="validate" required></div>
    				</td>
  				</tr>
    			<tr>
    				<td>
      					<label for="txtaddress">Address</label>
    				</td>
    				<td>
      					<div class="input-field"><input name="txtaddress" placeholder="Address" class="validate" required></div>
    				</td>
   	 			</tr>
    			<tr>
    				<td>
      					<label for="txtphonenumber">Phone Number</label>
    			</td>
    				<td>
       					<div class="input-field"><input name="txtphonenumber" placeholder="Phone number" class="validate" required></div>
    				</td>
    			</tr>
    			<tr>
    				<td>
      					<label for="txtemail">Email</label>
    				</td>
    				<td>
       					<div class="input-field"><input name="txtemail" placeholder="Email" class="validate" required></div>
    				</td>
  				</tr>

			</table>
                    <input style="cursor: pointer;" class="second-button" type="submit" name="btsave" value="Save">
		</form>
   		</div>
  	</div>
	<script>
 		function togglePopupInsert() {
 			document.getElementById("Insert").classList.toggle("active");
		}
	</script>

	<!-- popup section for Editting -->
   	<div class="popup" id="Edit">
   		<div class="content">
    	<div class="close-btn" onclick="togglePopupEdit()">×</div>     
		<h1>Edit record</h1> 
		<form action="" method="post" name="formedit">
                    <table cellpadding="10" style="border: none">
  				<tr>
    				<td>
      					<label for="txtsuppliername">Supplier Name</label>
    			</td>
    				<td>
      					<div class="input-field"><input name="txtsuppliername" placeholder="Supplier name" class="validate" required></div>
    				</td>
  				</tr>
    			<tr>
    				<td>
      					<label for="txtaddress">Address</label>
    				</td>
    				<td>
      					<div class="input-field"><input name="txtaddress" placeholder="Address" class="validate" required></div>
    				</td>
   	 			</tr>
    			<tr>
    				<td>
      					<label for="txtphonenumber">Phone Number</label>
    			</td>
    				<td>
       					<div class="input-field"><input name="txtphonenumber" placeholder="Phone number" class="validate" required></div>
    				</td>
    			</tr>
    			<tr>
    				<td>
      					<label for="txtemail">Email</label>
    				</td>
    				<td>
       					<div class="input-field"><input name="txtemail" placeholder="Email" class="validate" required></div>
    				</td>
  				</tr>
			</table>
		</form>
                <input style="cursor: pointer;" class="second-button" type="submit" name="btsave" value="Save" onclick="redirect()">
   		</div>
  	</div>
	<script>
 		function togglePopupEdit() {
 			document.getElementById("Edit").classList.toggle("active");
		}
	</script>
        <script>
      function redirect() {
        window.location.href="NhaPhanPhoi.php";
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
                    <li><a href="NhanVien.php"><i class="fa fa-user"></i> Employee</a></li>
                    <li><a href="ThongKe.php"><i class="fa fa-chart-line"></i> Analyze</a></li>
                    <li><a href="Logout.php"><i class="fa fa-sign-out-alt"></i> Sign out</a></li>
		</ul>
            </div>
            <div id="content">
            	<div id="searcharea">
            		<div id="search">
                            <form action="Xuat.php" method="post">
            		<input style="background-color:whitesmoke; height: 30px; border: none; width: 250px;" type="search" name="ipsearch" name="ipsearch" placeholder="Search for id"><input id="buttonsearch" type="submit" name="btsearch" value="Search"><input id="buttonsearch" type="submit" name="btviewall" value="View All">
                            </form>
            		</div>
            	</div>
			<div id="item">
				<div id="datatable">
				<table cellpadding="5" style="margin-bottom: 5%;">
                                        <tr style="background-color: aqua; color:black;">
                                            <td><label>ID</label></td>
                                            <td><label>Stock ID</label></td>
                                            <td><label>Employee ID</label></td>
                                            <td><label>Stock Name</label></td>
                                            <td><label>Receipt Type</label></td>
                                            <td><label>Title</label></td>
                                            <td><label>Content</label></td>
                                            <td><label>Is Appect</label></td>
                                            <td><label>Create Date</label></td>
                                            <td style="text-align: center;">Tools</td>
					</tr>
					<?php 
                                            while ($row = mysqli_fetch_assoc($result))
                                                {
                                        ?>
					<tr>
                                            <td><?php echo $row['Id'] ?></td>
                                            <td><?php echo $row['StockId'] ?></td>
                                            <td><?php echo $row['EmployeeId'] ?></td>
                                            <td><?php echo $row['StockName'] ?></td>
                                            <td><?php echo 'Phieu Xuat' ?></td>
                                            <td><?php echo $row['Title'] ?></td>
                                            <td><?php echo $row['Content'] ?></td>
                                            <td><?php 
                                            if($row['IsAppect']==0){
                                                echo 'Chua xuat';
                                            }
                                            else{
                                                echo 'Da xuat';
                                            }
                                              ?></td>
                                            <td><?php echo $row['CreateDate'] ?></td>
                                            <td>
                                                <input id="tools" type="submit" name="btinsert" value="Insert" onclick="togglePopupInsert()"/><input id="tools" type="submit" name="btedit" value="Edit" onclick="togglePopupEdit()"/><input id="tools" type="submit" name="btdelete" value="Delete"/>
                                            </td>
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
