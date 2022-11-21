<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="Style\WebTemplate.css">
    <link rel="stylesheet" type="text/css" href="FontAwesome\css\all.css">
    <link rel="icon" href="Images\Logo.PNG" type="image/x-icon">
    <link rel="stylesheet" href="./Style/style.css">
    <link rel="stylesheet" href="./Style//page/index.css">
    <link rel="stylesheet" href="./Style/page/hanghoa.css">

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
    $sql = "SELECT * FROM product p INNER JOIN unit u ON p.UnitId = u.Id INNER JOIN stock s ON p.StockId = s.Id INNER JOIN suplier s1 ON p.SuplierId = s1.Id";
    $result = mysqli_query($conn, $sql);

    // Lấy danh sách 
    $sqlGetStock = "SELECT * FROM stock";
    $listStock = mysqli_query($conn, $sqlGetStock);

    mysqli_close($conn);
    ?>
</head>

<body>
    <div id="container">
        <!-- header  -->
        <div id="menu">
            <ul>
                <li><a href="TrangChu.php"><img src="Images\Logo.PNG" alt="Company's Logo"></a></li>
                <li><a href="TrangChu.php"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="NhaPhanPhoi.php"><i class="fa fa-industry"></i> Supplier</a></li>
                <li><a href="HangHoa.php" class="active"><i class="fa fa-clipboard-list"></i> Products</a></li>
                <li><a href="Kho.php"><i class="fa fa-arrow-alt-circle-down"></i> Warehouse</a></li>

                <li><a href="Nhap.php"><i class="fa fa-arrow-alt-circle-down"></i> Import</a></li>
                <li><a href="Xuat.php"><i class="fa fa-arrow-alt-circle-up"></i> Export</a></li>
                <li><a href="NhanVien.php"><i class="fa fa-user"></i> Employee</a></li>
                <li><a href="ThongKe.php"><i class="fa fa-chart-line"></i> Analyze</a></li>
                <li><a href="Logout.php"><i class="fa fa-sign-out-alt"></i> Sign out</a></li>
            </ul>
        </div>
        <!-- content -->
        <div class="container-product-page">
            <div class="toolbar">
                <div class="search">
                    <input type="text" name="" id="" placeholder="Nhập để tìm kiếm">
                    <img src="./Images/icons/magnifying-glass-solid.svg" class="icon">
                </div>

                <div class="group-control">
                    <div class="combobox-control">
                        <select name="" id="">
                            <?php
                            while ($stock = mysqli_fetch_assoc($listStock)) {
                            ?>
                                <option value='<?php echo $stock['Id'];  ?>'><?php echo $stock['StockName'];  ?></option>
                            <?php } ?>
                        </select>
                    </div>

                </div>
            </div>
            <!-- table -->
            <div>
                <table cellpadding="5">
                    <tr style="background-color: #bcbcbc; color:black;">
                        <td>STT</td>
                        <td>Tên sản phẩm</td>
                        <td>Đơn vị tính</td>
                        <td>Mô tả</td>
                        <td>Nhà cung cấp</td>
                        <td>Kho</td>
                        <td>Giá bán</td>
                    </tr>
                    <?php
                    $stt = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $stt++
                    ?>
                        <tr>
                            <td><?php echo $stt; ?></td>
                            <td class="col-product-name">
                                <?php echo $row['ProductName']; ?>
                            </td>
            </div>
            <td><?php echo $row['UnitName']; ?></td>

            <td>
                <?php echo '<div class="col-description" title="' . $row['Description'] . '" .> '
                            . $row['Description'] .
                            '</div> ';
                ?>
            </td>
            <td><?php echo $row['StockName']; ?></td>
            <td><?php echo $row['SuplierName']; ?></td>

            <td><?php echo number_format($row['UnitPrice'], 0, '', ',') . ' VND'; ?></td>

            </tr>
        <?php } ?>
        </table>
        </div>
    </div>

    </div>
</body>
<script src="./js//hanghoa.js"></script>

</html>