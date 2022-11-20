<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="Style\WebTemplate.css">
	<link rel="stylesheet" type="text/css" href="FontAwesome\css\all.css">
        <link rel="icon" href="Images\Logo.PNG" type="image/x-icon">
        <link rel="stylesheet" href=".\Style\style.css">

	<title>Home</title>
        <?php
        session_start();
            $_SESSION = session_id();
            require __DIR__ . '.\common\configdb.php';
      
            // Create connection
            $conn = mysqli_connect($servername, $username, $password, $database);
            mysqli_set_charset($conn, "utf8");
            // Check connection
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
                exit();
            }
            $sql = "SELECT * FROM employee e INNER JOIN employeerole e1 ON e.RoleId = e1.Id";
            $result = mysqli_query($conn, $sql);
            mysqli_close($conn);
        ?>
</head>
<body>
	<div id="container">
            <div id="menu">
		<ul>
                    <li><a href="TrangChu.php"><img src="Images\Logo.PNG" alt="Company's Logo"></a></li>
                    <li><a href="TrangChu.php" class="active"><i class="fa fa-home"></i> Home</a></li>
                    <li><a href="NhaPhanPhoi.php"><i class="fa fa-industry"></i> Supplier</a></li>
                    <li><a href="HangHoa.php"><i class="fa fa-clipboard-list"></i> Products</a></li>                    <li><a href="Kho.php"><i class="fa fa-arrow-alt-circle-down"></i> Warehouse</a></li>

                    <li><a href="Nhap.php"><i class="fa fa-arrow-alt-circle-down"></i> Import</a></li>
                    <li><a href="Xuat.php"><i class="fa fa-arrow-alt-circle-up"></i> Export</a></li>
                    <li><a href="NhanVien.php"><i class="fa fa-user"></i> Employee</a></li>
                    <li><a href="ThongKe.php"><i class="fa fa-chart-line"></i> Analyze</a></li>
                    <li><a href="Logout.php"><i class="fa fa-sign-out-alt"></i> Sign out</a></li>
		</ul>
            </div>
            <div id="content">
			<div>
				<table cellpadding="5">
					<tr style="background-color: aqua; color:black;">
						<td>Tên tài khoản</td>
						<td>Mật khẩu</td>
						<td>Họ và tên</td>
						<td>Chức vụ</td>
						<td>Giới tính</td>
						<td>Email</td>
						<td>Số điện thoại</td>
						<td>Ngày sinh</td>
						<td>Lương</td>

					</tr>
                                        <?php 
                                                while ($row = mysqli_fetch_assoc($result))
                                                {
                                        ?>
					<tr>
						<td><?php echo $row['UserName']; ?></td>
						<td><?php echo $row['Password']; ?></td>
                                                <td><?php echo $row['FullName']; ?></td>
                                                <td><?php echo $row['RoleName']; ?></td>
                                                <td><?php $gender = $row['Gender'];
                                                        if($gender == 1) {
                                                                echo 'Nam';
                                                        }else {
                                                                echo 'Nữ';
                                                        }
                                                ?></td>
						<td><?php echo $row['Email']; ?></td>
						<td><?php echo $row['Phone']; ?></td>
						<td><?php echo $row['Birthday']; ?></td>
						<td><?php echo $row['Salary']; ?></td>

					</tr>
                                                <?php }?>
				</table>
			</div>
		</div>
            <div id="contact">
                <p style="color: white; padding: 10px;">Powered by Group 14</p>
            </div>
        </div>
</body> 
</html>