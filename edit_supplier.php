<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="Style/form_edit.css">
	<link rel="stylesheet" type="text/css" href="FontAwesome\css\all.css">
        <link rel="icon" href="Images\Logo.PNG" type="image/x-icon">
	<title>Supplier</title>
	<?php
        session_start();
        require __DIR__ . '.\common\configdb.php';
       // require_once 'db.php';
	$conn = mysqli_connect($servername, $username, $password, $database);
     mysqli_set_charset($conn, "utf8");
     // Check connection
     if (!$conn) {
         die("Connection failed: " . mysqli_connect_error());
         exit();
     }
        $id = $_GET['id'];
        $query = mysqli_query($conn, "select * from suplier where Id = '$id'");
        if(isset($_POST['btedit'])){
            $eid = $_POST['txteid'];
            $esuppliername = $_POST['txtesuppliername'];
            $eaddr = $_POST['txteaddress'];
            $ephonenumber = $_POST['txtephonenumber'];
            $eemail = $_POST['txteemail'];
            $query = mysqli_query($conn,"update suplier set Id = '$eid', SuplierName='$esuppliername', Address='$eaddr', PhoneNumber = '$ephonenumber', Email = '$eemail' where Id = '$id'");
            header("location: NhaPhanPhoi.php");
        }
        mysqli_close($conn);
    ?>
</head>
<body>
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
                <div id = "header_area">
                    <h1>Edit record</h1>
                </div>
                <div id="item">
                    <div id="datatable">
                        <form action="" method = "post">
                    <table cellpadding="10" style="border: none">
                    <?php 
                        while ($row = mysqli_fetch_assoc($query))
                            {
                    ?>
				<tr>
    				<td>
      					<label for="txteid">Supplier id</label>
    			</td>
    				<td>
      					<input name="txteid" value="<?php echo $row['Id'] ?>"/>
    				</td>
  				</tr>
  				<tr>
    				<td>
      					<label for="txtesuppliername">Supplier Name</label>
    			</td>
    				<td>
      					<input name="txtesuppliername" value ="<?php echo $row['SuplierName'] ?>"/>
    				</td>
  				</tr>
    			<tr>
    				<td>
      					<label for="txteaddress">Address</label>
    				</td>
    				<td>
      					<input name="txteaddress" value ="<?php echo $row['Address'] ?>"/>
    				</td>
   	 			</tr>
    			<tr>
    				<td>
      					<label for="txtephonenumber">Phone Number</label>
    			</td>
    				<td>
       					<input name="txtephonenumber" value ="<?php echo $row['PhoneNumber'] ?>"/>
    				</td>
    			</tr>
    			<tr>
    				<td>
      					<label for="txteemail">Email</label>
    				</td>
    				<td>
       					<input name="txteemail" value ="<?php echo $row['Email'] ?>"/>
    				</td>
  				</tr>
                <?php }?>
			</table>
            <input id="save_button" type="submit" value="Save" name="btedit"/>
                </form>
                    </div>
                </div>
            </div>
            <div id="contact">
                <p style="color: white; padding: 10px;">Powered by Group 14</p>
            </div>
    </div>
</body> 
</html>
