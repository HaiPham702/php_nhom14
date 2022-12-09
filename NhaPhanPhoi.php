<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="Style\WebTemplate.css">
    <link rel="stylesheet" type="text/css" href="FontAwesome/css/all.css">
    <link rel="icon" href="Images\Logo.PNG" type="image/x-icon">
    <link rel="stylesheet" href="./Style/style.css">
    <link rel="stylesheet" href="./Style/page/index.css">
    <link rel="stylesheet" href="./Style/page/xuat.css">
    <link rel="stylesheet" href="./bootstrap/css//bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
    $receiptID = $_GET['receiptID'] ?? -1;
    $stockId = $_GET['StockId'] ?? -1;

    $sql = "SELECT * FROM receipt r INNER JOIN employee e ON r.EmployeeId = e.Id WHERE ReceiptType=0 ORDER BY CreateDate";
    $sqlTotal = "SELECT COUNT(*) AS Total FROM receipt WHERE ReceiptType=0";


    $total = mysqli_fetch_array(mysqli_query($conn, $sqlTotal))[0];

    $result = mysqli_query($conn, $sql);

    // Lấy danh sách kho
    $sqlGetStock = "SELECT * FROM stock";
    $listStock = mysqli_query($conn, $sqlGetStock);
    $listStockForm = mysqli_query($conn, $sqlGetStock);

    // Lấy danh sách phiếu
	$sqlGetReceipt = "SELECT * FROM receipt";
	$listReceipt = mysqli_query($conn, $sqlGetReceipt);
    $IsCheck = mysqli_query($conn,"SELECT DISTINCT IsAppect FROM receipt");
	$listDate = mysqli_query($conn, "SELECT DISTINCT CreateDate FROM receipt");

    //
    $sqlGetEmployee = "SELECT * FROM employee";
    $listEmployeeName = mysqli_query($conn, "SELECT DISTINCT FullName FROM employee");

    if (count($_GET) > 0) {
        $a =  $_GET["Id"] ?? null ;
        if ($a) {

            $sqlDelete = "DELETE FROM receipt WHERE Id = " . $_GET["Id"] ."";
            echo $sqlDelete;
            mysqli_query($conn, $sqlDelete);

            $total = mysqli_fetch_array(mysqli_query($conn, $sqlTotal))[0];

            $result = mysqli_query($conn, $sql);
        }
    }



    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $typeForm =  $_COOKIE['typeForm'];
        $result;
        if ($typeForm == 'update') {
            $sqlUpdate = "UPDATE product p SET  StockId = " . $_POST['StockIdFrom'] . ", SuplierId = " . $_POST['subpierIDForm'] . ", UnitId = " . $_POST['unit'] . ", Description = '" . $_POST['description'] . "', ProductName = '" . $_POST['productName'] . "', Quantity = " . $_POST['quantity'] . ",  UnitDisplay = '', UnitPrice = " . $_POST['price'] . "  WHERE Id = " . $_POST['productId'] . " AND StockId = " . $_POST['StockIdFrom'] . ";";
            mysqli_query($conn, $sqlUpdate);
        } else if ($typeForm == 'insert') {
            //$newId = mysqli_fetch_array(mysqli_query($conn, "SELECT MAX(Id) + 1 FROM product"))[0];

            $sqlInsert = "INSERT INTO receipt (StockId, EmployeeId, StockName, ReceiptType, Title, Content, IsAppect, CreateDate) VALUES (" . $_POST['StockIdFrom'] . ", " . $_POST['subpierIDForm'] . ", " . $_POST['unit'] . ", '" . $_POST['description'] . "', '" . $_POST['productName'] . "', " . $_POST['quantity'] . ", '', " . $_POST['price'] . ");";
            echo $sqlInsert;
            mysqli_query($conn, $sqlInsert);
        }

        $total = mysqli_fetch_array(mysqli_query($conn, $sqlTotal))[0];

        $result = mysqli_query($conn, $sql);
    }

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
                
                <li><a href="Logout.php"><i class="fa fa-sign-out-alt"></i> Sign out</a></li>
            </ul>
        </div>
        <!-- content -->
        <div class="container-product-page" style="width: 80%; margin-left: 10%">
            <form action="" method="GET" class="toolbar">
                <div class="group-control">
                    <div class="search mr-3">
                        <input class="c" type="text" name="textSearch" id="" placeholder="Nhập tên nhân viên" value="<?php echo $textSearch ?>">
                        <img src="./Images/icons/magnifying-glass-solid.svg" class="icon">
                    </div>
                    <div class="combobox-control" style="margin-right: 8px;">
                        <div class="combobox-lable">
                            Kho hàng
                        </div>
                        <select name="StockId" id="">
                            <option value='-1'>Tất cả</option>
                            <?php
                            while ($stock = mysqli_fetch_assoc($listStock)) {
                            ?>
                                <option value='<?php echo $stock['Id'];  ?>' <?php $selectedStock = $stockId == $stock['Id'] ? 'selected' : '';
                                echo $selectedStock; ?>><?php echo $stock['StockName'];  ?></option>
                            <?php } ?>
                        </select>

                    </div>
                    <div class="combobox-control" style="margin-right: 8px;">
                        <div class="combobox-lable">
                            Ngày lập
                        </div>
                        <select name="SubpierID" id="">
                            <option value='-1'>Tất cả</option>
                            <?php
                            while ($suplier = mysqli_fetch_assoc($listDate)) {
                            ?>
                                <option ><?php echo $suplier['CreateDate'];  ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <input id="search" type="submit" value="Tìm kiếm" name="search">
                </div>
                <div class="btn btn-primar btn-add">Thêm phiếu</div>

            </form>
            <!-- table -->

            <div style="height: 100% ;">
                <table cellpadding="5">
                    <table>
                        <tr style="background-color: #bcbcbc; color:black;">
                            <td class="col-stt">STT</td>
                            <td class="col-employee-id">Tên nhân viên</td>
                            <td class="col-stock-name">Tên kho</td>
                            <td class="col-receipt-type">Phiếu</td>
                            <td class="col-title">Tiêu đề</td>
                            <td class="col-content">Nội dung</td>
                            <td class="col-isappect">Duyệt</td>
                            <td class="col-date">Ngày lập</td>
							<td class="col-action-header" style="width: 50px"></td>
                        </tr>
                            <?php
                            $stt = 0;
                            while ($row = mysqli_fetch_assoc($result)) {
                                $stt++
                            ?>
                                <tr>
                                    <td class="col-stt"><?php echo $stt; ?></td>
                                </td>
                    </div>
                        <td class="col-employee-id"><?php echo $row['FullName']; ?></td>
                        <td class="col-stock-name"><?php echo $row['StockName']; ?></td>
                        <td class="col-receipt-type">Xuất</td>
                        <td class="col-title"><?php echo $row['Title']; ?></td>
					    <td class="col-content"><?php echo $row['Content']; ?></td>
					    <td class="col-isappect">
						<?php 
							$status = '';
							if($row['IsAppect']==1){
								$status = 'Đã Duyệt';
							}
							else
							{
								$status = 'Chưa Duyệt';
							}
						?>
						<?php echo $status; ?>
					</td>
					<td class="col-date"><?php echo $row['CreateDate']; ?></td>
                    <script>
                        var <?php echo 'data_' . $row['Id'] ?> = <?php echo (json_encode($row)); ?>;
                    </script>
                    <td class="col-action" style="border:none;">
                        <a class="btn icon-edit" onclick="<?php echo 'openForm(data_' . $row['Id'] . ')' ?>">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <a class="btn icon-delete" href="Xuat.php?Id=<?php echo $row["Id"];?>">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>

    <div class="paging">

        <div class="total-record">
            <?php
            echo "Số phiếu: <b>",$total;
            ?>
        </div>

    </div>

    <div class="mark-form">
        <div class="form">
            <!-- Title form -->
            <div class="form-header">
                <div class="form-title" style="font-size: 20px; font-weight: bold;">
                    Sửa thông tin phiếu
                </div>
            </div>
            <!-- Content form -->
            <div class="form-content">
                <form action="Xuat.php" method="post" id="form">
                    <input type="hidden" name="ReceiptId" id="ReceiptId">
                    <div class="row mt-3">
                        
                    <div class="col">
                            <div class="combobox-control" style="margin-right: 8px;">
                                <div class="combobox-lable require">
                                    Kho
                                </div>
                                <div class="container-controll">
                                    <select name="StockId" id="StockId">
                                        <?php
                                        while ($stockForm = mysqli_fetch_assoc($listStockForm)) {
                                        ?>
                                            <option value='<?php echo $stockForm['Id']; ?>'><?php echo $stockForm['StockName'];  ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <span class="error-mess"></span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="combobox-control" style="margin-right: 8px;">
                                <div class="combobox-lable require">
                                    Nhân viên
                                </div>
                                <div class="container-controll">
                                    <select name="EmployeeId" id="EmployeeId">
                                        <?php
                                        while ($row = mysqli_fetch_assoc($listEmployeeName)) {
                                        ?>
                                            <option value='<?php echo $row['Id'];  ?>'><?php echo $row['FullName'];  ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <span class="error-mess"></span>

                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col">
                            <div class="input">
                                <div class="input-label require">Tiêu đề</div>
                                <div class="cover-input">
                                    <input type="text" name="Title" id="Title">
                                </div>
                                <span class="error-mess"></span>
                            </div>
                        </div>

                        <div class="col">
                            <div class="input">
                                <div class="input-label require">Ngày lập</div>
                                <div class="cover-input">
                                    <input type="date" name="CreateDate" id="CreateDate">
                                </div>
                                <span class="error-mess"></span>
                            </div>
                        </div>
                    </div>


                    <div class="row mt-3">
                        <div class="col">
                            <div class="combobox-control" style="margin-right: 8px;">
                                <div class="combobox-lable require">
                                    Trạng thái
                                </div>
                                <div class="container-controll">
                                    <select name="IsAppect" id="IsAppect">
                                        <?php
                                        while ($row = mysqli_fetch_assoc($IsCheck)) {
                                        ?>
                                            <option value='<?php echo $row['IsAppect'];  ?>'>
                                            <?php 
                                                if($row['IsAppect']==0){
                                                    echo 'Chưa Duyệt';
                                                }
                                                else {
                                                    echo 'Đã Duyệt';
                                                }
                                            ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <span class="error-mess"></span>

                            </div>
                        </div>

                        <div class="col">
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col">
                            <div class="control-text-area">
                                <div class="textarea-lable require">Nội dung</div>
                                <div class="container-controll">
                                    <textarea name="Content" id="Content" cols="30" rows="5"></textarea>
                                </div>
                                <span class="error-mess"></span>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <!-- footer form -->
            <div class="form-footer">
                <div class="btn2 mr-1 close-form">
                    Đóng
                </div>
                <input type="submit" class="btn2 btn-primar btn-save" value="Lưu" onclick="validationController" style="width: 120px;">

            </div>
        </div>

    </div>
</body>
<script src="./bootstrap/js//bootstrap.min.js"></script>
<script src="./js/jquery.js"></script>
<script src="./js/xuat.js"></script>
</html>
