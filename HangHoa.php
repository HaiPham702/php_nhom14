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
    <link rel="stylesheet" href="./bootstrap//css//bootstrap.min.css">

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

   $textSearch = $_GET['textSearch'] ?? '';

   $limit = $_GET['limit'] ?? '20';

   $pageIndex = (int)$_GET['pageIndex'] ?? 0;

    $sql = "SELECT * FROM product p INNER JOIN unit u ON p.UnitId = u.Id  INNER JOIN stock s ON p.StockId = s.Id INNER JOIN suplier s1 ON p.SuplierId = s1.Id WHERE p.ProductName LIKE '%" . $textSearch . "%' LIMIT " . $limit . " OFFSET " . $limit * $pageIndex . ";";


    $result = mysqli_query($conn, $sql);

    // Lấy danh sách kho
    $sqlGetStock = "SELECT * FROM stock";
    $listStock = mysqli_query($conn, $sqlGetStock);


    // Lấy danh sách nhà cung cấp

    $sqlGetSuplier = "SELECT * FROM suplier";
    $listSuplier = mysqli_query($conn, $sqlGetSuplier);

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
                <form action="" method="GET" class="toolbar">
                    <div class="search">
                        <input class="c" type="text" name="textSearch" id="" placeholder="Nhập tên sản phẩm" value="<?php echo $textSearch ?>">
                        <img src="./Images/icons/magnifying-glass-solid.svg" class="icon">
                    </div>

                    <div class="group-control">
                        <!-- Nhà cung cấp -->
                        <div class="combobox-control" style="margin-right: 8px;">
                            <div class="combobox-lable">
                                Kho hàng
                            </div>
                            <select name="" id="">
                                <?php
                                while ($stock = mysqli_fetch_assoc($listStock)) {
                                ?>
                                    <option value='<?php echo $stock['Id'];  ?>'><?php echo $stock['StockName'];  ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <!-- Kho hàng -->
                        <div class="combobox-control" style="margin-right: 8px;">
                            <div class="combobox-lable">
                                Nhà cung cấp
                            </div>
                            <select name="" id="">
                                <?php
                                while ($suplier = mysqli_fetch_assoc($listSuplier)) {
                                ?>
                                    <option value='<?php echo $suplier['Id'];  ?>'><?php echo $suplier['SuplierName'];  ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <input type="submit" value="Tìm kiếm" name="search">                
                    </div>
                </form>
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

    <div class="paging">
    <nav aria-label="...">
  <ul class="pagination">
    <li class="page-item disabled">
      <span class="page-link">Previous</span>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item active">
      <span class="page-link">
        2
        <span class="sr-only">(current)</span>
      </span>
    </li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#">Next</a>
    </li>
  </ul>
</nav>
    </div>

    </div>
</body>
<script src="./bootstrap//js//bootstrap.min.js"></script>
<script src="./js//jquery.js"></script>
<script src="./js//hanghoa.js"></script>

</html>