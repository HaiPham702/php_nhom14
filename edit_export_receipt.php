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
//            require __DIR__ . '.\common\configdb.php';
        require_once 'db.php';
        $id = $_GET['id'];
        $query = mysqli_query($conn, "select * from receipt where Id = '$id'");
        if(isset($_POST['btedit'])){
            $eid = $_POST['txteid'];
            $estockid = $_POST['txtestockid'];
            $eemployeeid = $_POST['txteemployeeid'];
            $estockname = $_POST['txtestockname'];
            $ereceipttype = $_POST['txtereceipttype'];
			$etitle = $_POST['txtetitle'];
			$econtent = $_POST['txtecontent'];
			$eisappect = $_POST['txteisappect'];
			$ecreatedate = $_POST['txtecreatedate'];
            $query = mysqli_query($conn,"update receipt set Id = '$eid', StockId='$estockid', EmployeeId='$eemployeeid', StockName = '$estockname' , ReceiptType = '$ereceipttype', Title = '$etitle', Content = '$econtent', IsAppect = '$eisappect', CreateDate = '$ecreatedate' where Id = '$id'");
            header("location: Xuat.php");
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
                    <table cellpadding="10" style="border: none;">
                    <?php 
                        while ($row = mysqli_fetch_assoc($query))
                            {
                    ?>
				<tr>
    				<td>
      					<label for="txteid">Id</label>
    			</td>
    				<td>
      					<input name="txteid" value="<?php echo $row['Id'] ?>"/>
    				</td>
					<td>
      					<label for="txtestockid">Stock Id</label>
    			</td>
    				<td>
      					<input name="txtestockid" value ="<?php echo $row['StockId'] ?>"/>
    				</td>
  				</tr>
    			<tr>
    				<td>
      					<label for="txteemployeeid">Employee Id</label>
    				</td>
    				<td>
      					<input name="txteemployeeid" value ="<?php echo $row['EmployeeId'] ?>"/>
    				</td>
					<td>
      					<label for="txtestockname">Stock Name</label>
    			</td>
    				<td>
       					<input name="txtestockname" value ="<?php echo $row['StockName'] ?>"/>
    				</td>
   	 			</tr>
    			<tr>
    				<td>
      					<label for="txtereceipttype">Receipt Type</label>
    				</td>
    				<td>
       					<input name="txtereceipttype" value ="<?php echo $row['ReceiptType'] ?>"/>
    				</td>
					<td>
      					<label for="txtetitle">Title</label>
    				</td>
    				<td>
       					<input name="txtetitle" value ="<?php echo $row['Title'] ?>"/>
    				</td>
  				</tr>
				  <tr>
    				<td>
      					<label for="txtecontent">Content</label>
    				</td>
    				<td>
       					<input name="txtecontent" value ="<?php echo $row['Content'] ?>"/>
    				</td>
					<td>
      					<label for="txteisappect">Is Appect</label>
    				</td>
    				<td>
       					<input name="txteisappect" value ="<?php echo $row['IsAppect'] ?>"/>
    				</td>
  				</tr>
				  <tr>
    				<td>
      					<label for="txtecreatedate">Create Date</label>
    				</td>
    				<td>
       					<input name="txtecreatedate" value ="<?php echo $row['CreateDate'] ?>"/>
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