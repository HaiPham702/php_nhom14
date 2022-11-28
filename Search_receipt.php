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
//            require __DIR__ . '.\common\configdb.php';
        	require_once 'db.php';
            $searchid = $_GET['search_id'];
			$result = mysqli_query($conn, "select * from receipt where Id = '$searchid'");
            if(isset($_POST['btsaveinsert'])){
                $id = $_POST['txtid'];
                $stockid = $_POST['txtstockid'];
                $empid = $_POST['txtemployeeid'];
                $stockname = $_POST['txtstockname'];
				$receipttype = $_POST['txtreceipttype'];
				$title = $_POST['txttitle'];
				$content = $_POST['txtcontent'];
				$isappect = $_POST['txtisaspect'];
				$date = $_POST['txtcreatedate'];
                if($id==""||$stockid==""||$empid==""||$stockname==""||$receipttype==""||$title==""||$content==""||$isappect==""||$date=="")
                {
                    echo '<script language ="javascript">alert("The value must not be just space");</script>';
                    mysqli_close($conn);
                }
                else{
                $querry = mysqli_query($conn, "insert into receipt values('".$id."','".$stockid."', '".$empid."', '".$stockname."', '".$receipttype."','".$title."','".$content."', '".$isappect."', '".$date."')");
                if($querry){
                    echo 'Successfully';
					header("Location:Xuat.php");
                }
                else{
                    echo '<script language ="javascript">alert("Insert failed");</script>';
                }
                }
            }
            if(isset($_POST['btviewall'])){
				header("location: Xuat.php");
			}if(isset($_POST['btsearch'])){
				$searchid = $_POST['ipsearch'];
				header("location: Search_receipt.php?search_id=$searchid");
			}
            session_destroy();
            mysqli_close($conn);
    ?>
</head>
<body>
<div class="popup" id="Insert">
   		<div class="content" style="width: 70%;">
    	<div class="close-btn" onclick="togglePopupInsert()">×</div>     
		<h1>Insert new record</h1> 
		<form action="NhaPhanPhoi.php" method="post" name="forminsert"> 
			<table cellpadding="10" style="border: none;">
				<tr>
    				<td>
      					<label for="txtid">Id</label>
    				</td>
    				<td>
                        <div class="input-field"><input name="txtid" placeholder="Id" class="validate" value="" required></div>
    				</td>
					<td>
      					<label for="txtstockid">Stock Id</label>
    				</td>
    				<td>
                        <div class="input-field"><input name="txtstockid" placeholder="Stock Id" class="validate" value="" required></div>
    				</td>
  				</tr>
				  <tr>
    				<td>
      					<label for="txtemployeeid">Employee Id</label>
    			</td>
    				<td>
                        <div class="input-field"><input name="txtemployeeid" placeholder="Employee Id" class="validate" value="" required></div>
    				</td>
					<td>
      					<label for="txtstockname">Stock Name</label>
    				</td>
    				<td>
                        <div class="input-field"><input name="txtstockname" placeholder="Stock Name" class="validate" value="" required></div>
    				</td>
  				</tr>
				  <tr>
    				<td>
      					<label for="txtreceipttype">Receipt Type</label>
    			</td>
    				<td>
                        <div class="input-field"><input name="txtreceipttype" placeholder="Receipt Type" class="validate" value="" required></div>
    				</td>
					<td>
      					<label for="txttitle">Title</label>
    			</td>
    				<td>
                        <div class="input-field"><input name="txttitle" placeholder="Title" class="validate" value="" required></div>
    				</td>
  				</tr>
				  <tr>
    				<td>
      					<label for="txtcontent">Content</label>
    				</td>
    				<td>
                        <div class="input-field"><input name="txtcontent" placeholder="Content" class="validate" value="" required></div>
    				</td>
					<td>
      					<label for="txtisappect">Is Aspect</label>
    			</td>
    				<td>
                        <div class="input-field"><input name="txtisappect" placeholder="Is Appect" class="validate" value="" required></div>
    				</td>
  				</tr>
				  <tr>
    				<td>
      					<label for="txtcreatedate">Create Date</label>
    			</td>
    				<td>
                        <div class="input-field"><input name="txtcreatedate" placeholder="Create Date" class="validate" value="" required></div>
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
                    <li><a href="NhanVien.php"><i class="fa fa-user"></i> Employee</a></li>
                    <li><a href="ThongKe.php"><i class="fa fa-chart-line"></i> Analyze</a></li>
                    <li><a href="Logout.php"><i class="fa fa-sign-out-alt"></i> Sign out</a></li>
		</ul>
            </div>
            <div id="content">
                <form id="searcharea" action="" method="post">
            		<div id="search">
            		<input style="background-color:whitesmoke; height: 30px; border: none; width: 250px;" type="search" name="ipsearch" placeholder="Search for id">
					<input id="buttonsearch" type="submit" name="btsearch" value="Search"/>
					<input id="buttonsearch" type="submit" name="btviewall" value="View all"/>
            		</div>
				</form>
			<div id="item">
				<div id="datatable">
				<table cellpadding="5" style="margin-bottom: 5%;">
                                        <tr style="background-color: aqua; color:black;">
                                            <td><label>ID</label></td>
                                            <td><label>Stock Id</label></td>
                                            <td><label>Employee Id</label></td>
                                            <td><label>StockName</label></td>
                                            <td><label>Receipt Type</label></td>
											<td><label>Title</label></td>
											<td><label>Content</label></td>
											<td><label>Is Appect</label></td>
											<td><label>Create Date</label></td>
                                            <td style="text-align: center;"><div><input id="buttonsearch" type="submit" name="btinsert" value="Insert" onclick="togglePopupInsert()"/><div></td>
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
                                            <td><?php echo $row['ReceiptType'] ?></td>
											<td><?php echo $row['Title'] ?></td>
											<td><?php echo $row['Content'] ?></td>
											<td><?php echo $row['IsAppect'] ?></td>
											<td><?php echo $row['CreateDate'] ?></td>
											<?php 
												echo"<td><a href='edit_export_receipt.php?id=".$row['Id']."'>Edit</a><a href='delete.php?id=".$row['Id']."&page=Xuat.php'>Delete</a></td>";
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