<!DOCTYPE html>
<html>

<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="Style\WebTemplate.css">
        <link rel="stylesheet" type="text/css" href="FontAwesome\css\all.css">
        <link rel="icon" href="Images\Logo.PNG" type="image/x-icon">
        <link rel="stylesheet" href="./Style/style.css">
        <link rel="stylesheet" href="./Style/page/index.css">


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
        $sql = "SELECT s.*, COUNT(p.StockId) AS TotalProduct FROM stock s RIGHT JOIN product p ON s.Id = p.StockId GROUP BY s.Id";
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
                                <li><a href="HangHoa.php"><i class="fa fa-clipboard-list"></i> Products</a></li>
                                <li><a href="Kho.php"><i class="fa fa-arrow-alt-circle-down"></i> Warehouse</a></li>

                                <li><a href="Nhap.php"><i class="fa fa-arrow-alt-circle-down"></i> Import</a></li>
                                <li><a href="Xuat.php"><i class="fa fa-arrow-alt-circle-up"></i> Export</a></li>
                                
                                
                                <li><a href="Logout.php"><i class="fa fa-sign-out-alt"></i> Sign out</a></li>
                        </ul>
                </div>

                <div class="content">
                        <div class="grid-item">
                                <canvas id="myChart" width="400" height="100" ></canvas>
                        </div>
                        <div class="grid-item">
                                
                        </div>
                        <div class="grid-item">3</div>
                        <div class="grid-item">4</div>

                </div>


        </div>

      
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="./js/trangchu.js"></script>
        <script>
                var data = []
                <?php while ($item = mysqli_fetch_assoc($result)) {
                        echo  "data.push(" . json_encode($item) . ");";
                }   ?>

                setData(data)
        </script>
</body>

</html>