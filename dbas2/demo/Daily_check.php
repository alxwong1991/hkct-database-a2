<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="css/header.css" rel="stylesheet">
    <link href="css/footer.css" rel="stylesheet">

    <!-- temp-content -->
    <link href="css/temp-content.css" rel="stylesheet">

</head>

<body>

    <!-- background-color: rgba(37, 105, 85, 0.4); -->

    <!-- ::::::::::::::::::::::::::::::: header ::::::::::::::::::::::::::::::: -->
    <div>
        <?php
        require "header.php";
        ?>
    </div>
    <!-- ::::::::::::::::::::::::::::::: header ::::::::::::::::::::::::::::::: -->

    <!-- container -->
    <div class="container-fluid">



        <!-- row -->
        <div class="row">


            <div class="temp-content">

                <?php
                // Connect database
                require "./db_connect.php";

                date_default_timezone_set("Asia/Hong_Kong");

                $now_y = date("Y");
                $now_m = date("m");
                $now_d = date("d");

                $DC_y = 0;
                $DC_m = 0;
                $DC_d = 0;

                // SELECT Year sql
                $sql = "SELECT
                                Year(`Product_list`.`DC_datetime`) AS y
                            FROM
                                `Product_list`
                            WHERE
                                `Product_list`.`P_state` = 'inStock' AND `Product_list`.`D_check` = 1
                            GROUP BY
                                `Product_list`.`D_check` = 1
                            ORDER BY
                                `Product_list`.`DC_datetime` ";
                $sql_result = $conn->query($sql);
                while ($row = mysqli_fetch_array($sql_result)) {

                    $DC_y = $row['y'];
                }



                // SELECT MONTH sql
                $sql = "SELECT
                MONTH(`Product_list`.`DC_datetime`) AS m
            FROM
                `Product_list`
            WHERE
                `Product_list`.`P_state` = 'inStock' AND `Product_list`.`D_check` = 1
            GROUP BY
                `Product_list`.`D_check` = 1
            ORDER BY
                `Product_list`.`DC_datetime` ";
                $sql_result = $conn->query($sql);
                while ($row = mysqli_fetch_array($sql_result)) {

                    $DC_m = $row['m'];
                }


                // SELECT DAY sql
                $sql = "SELECT
                DAY(`Product_list`.`DC_datetime`) AS d
            FROM
                `Product_list`
            WHERE
                `Product_list`.`P_state` = 'inStock' AND `Product_list`.`D_check` = 1
            GROUP BY
                `Product_list`.`D_check` = 1
            ORDER BY
                `Product_list`.`DC_datetime` ";
                $sql_result = $conn->query($sql);
                while ($row = mysqli_fetch_array($sql_result)) {

                    $DC_d = $row['d'];
                }


                // reset the check
                if ($now_y > $DC_y || $now_m > $DC_m || $now_d > $DC_d) {

                    $sql = "UPDATE `Product_list` SET `Product_list`.`D_check` = 0 WHERE `Product_list`.`D_check` =1;";
                    $sql_result = $conn->query($sql);
                }

                ?>

                <h1 class='w-100 mb-2 mt-2 text-center text-danger'>Daily Check</h1>

                <!-- <form action="index.php?" method="GET">
                            <button class='w-100 mb-2 mt-2 btn btn-lg rounded-4 btn-success nav-color' type='submit' name='action' value='iwh'>Inventory Warehouse</button>
                            </form> -->


                <?php


                echo "<form action=\"Daily_check.php?\" method=\"GET\">";


                // ALL
                echo "<button class='w-100 mb-2 mt-2 btn btn-lg rounded-4 btn-dark nav-color' type='submit' name='action' value='all'>All Products</button>";

                // Warehouse           
                echo "<button class='w-100 mb-2 mt-2 btn btn-lg rounded-4 btn-dark nav-color' type='submit' name='action' value='WH'>Warehouse</button>";

                // BS1
                echo "<button class='w-100 mb-2 mt-2 btn btn-lg rounded-4 btn-dark nav-color' type='submit' name='action' value='BS1'>Branch Store 1</button>";

                // BS2
                echo "<button class='w-100 mb-2 mt-2 btn btn-lg rounded-4 btn-dark nav-color' type='submit' name='action' value='BS2'>Branch Store 2</button>";

                



                echo "<form>";




                ?>





                <?php

                if (!empty($_GET["action"])) {
                    switch ($_GET["action"]) {
                        case "all": ?>
                            <!-- ///////////////////////////////////////////////////////////////////////////////////   ALL  -->
                            <div>
                                <h2 class='w-100 mb-2 mt-2 text-center text-danger'>ALL Products</h2>

                                <?php
                                // Connect database
                                require "./db_connect.php";



                                $rand = 0;


                                // SELECT P_ID  where is 0
                                $sql = "SELECT DISTINCT `Product_list`.`P_ID` FROM `Product_list` WHERE `Product_list`.`P_state` = 'inStock' AND `Product_list`.`D_check` = 0 
                            GROUP BY `Product_list`.`D_check` ";
                                $sql_result = $conn->query($sql);
                                while ($row = mysqli_fetch_array($sql_result)) {
                                    $rand = $row['P_ID'];
                                }


                                $sql_result = $conn->query($sql);

                                $cq = 0;
                                $tq = 0;

                                // Confirm Execute sql
                                $sql = "SELECT *, COUNT(`Product_list`.`P_ID`) AS allp FROM `Product_list` Where `Product_list`.`D_check` = 1  AND `Product_list`.`P_state` = 'inStock' ";
                                $sql_result = $conn->query($sql);
                                while ($row = mysqli_fetch_array($sql_result)) {
                                    // echo "<h2 class='w-100 mb-2 mt-2 text-center text-danger'>" . $row['allp'] . "</h2>";
                                    $cq = $row['allp'];
                                }


                                // total Execute sql
                                $sql = "SELECT COUNT(`Product_list`.`P_ID`) AS allp FROM `Product_list` WHERE `Product_list`.`P_state` = 'inStock'  ";
                                $sql_result = $conn->query($sql);
                                while ($row = mysqli_fetch_array($sql_result)) {
                                    // echo "<h2 class='w-100 mb-2 mt-2 text-center text-danger'>" . $row['allp'] . "</h2>";
                                    $tq = $row['allp'];
                                }



                                echo "<h2 class='w-100 mb-2 mt-2 text-center text-danger'>" . "CONFIRMED :  " . $cq . " ／ " . $tq . "</h2>";


                                // Scan
                                echo "<button class='w-100 mb-2 mt-2 btn btn-lg rounded-4 btn-success nav-color' type='submit' name='action' value='scan_a' >Scan barcode to Confirm</button>";




                                ?>
                                <!-- data list -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th class="text-danger">Product ID</th>
                                                    <th>Title</th>
                                                    <th>Color </th>
                                                    <th>Size</th>
                                                    <th>Price per piece</th>
                                                    <th>Branch & Warehouse</th>
                                                    <th class="text-danger">Check</th>
                                                    <th>Last check time</th>
                                                </tr>
                                            </thead>


                                            <tbody>
                                                <?php




                                                $sl = 0;

                                                // SQL SELECT RECORD  
                                                $sql = "SELECT
                                                `Product_list`.`P_ID`,
                                                `Product`.`P_code`,
                                                `Product`.`P_title`,
                                                `Product`.`P_color`,
                                                `Product`.`P_size`,
                                                `Product`.`P_price`,
                                                `Real_estate`.`RE_name`,
                                                `Product_list`.`D_check`,
                                                `Product_list`.`DC_datetime`
                                            FROM
                                                `Product`,
                                                `Product_list`,
                                                `Real_estate`
                                            WHERE
                                                `Product`.`P_code` = `Product_list`.`P_code` AND `Product_list`.`RE_ID` = `Real_estate`.`RE_ID` AND `Product_list`.`P_state` = 'inStock'";
                                                // Execute sql
                                                $sql_result = $conn->query($sql);
                                                while ($row = mysqli_fetch_array($sql_result)) {
                                                    $sl++;


                                                    if ($row['D_check'] == 1) {
                                                        $check = 'Confirm';
                                                    } else {
                                                        $check = 'NULL';
                                                    };

                                                ?>

                                                    <tr>
                                                        <td><?php echo $sl; ?></td>
                                                        <th class="text-danger"><?php echo $row['P_ID']; ?></th>
                                                        <td><?php echo $row['P_title']; ?></td>
                                                        <td><?php echo $row['P_color']; ?></td>
                                                        <td><?php echo $row['P_size']; ?></td>
                                                        <td><?php echo "$" . $row['P_price']; ?></td>
                                                        <th><?php echo $row['RE_name']; ?></th>
                                                        <td class="text-danger"><?php echo $check; ?></td>
                                                        <td><?php echo $row['DC_datetime']; ?></td>
                                                    </tr>
                                                <?php }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--  -->

                        <?php break;

                        case "WH": ?>
                            <!-- ///////////////////////////////////////////////////////////////////////////////////   Warehouse  -->
                            <div>




                                <h2 class='w-100 mb-2 mt-2 text-center text-danger'>Warehouse</h2>

                                <?php

                                // Connect database
                                require "./db_connect.php";



                                $rand = 0;


                                // SELECT P_ID  where is 0
                                $sql = "SELECT DISTINCT `Product_list`.`P_ID` FROM `Product_list` WHERE `Product_list`.`P_state` = 'inStock' AND `Product_list`.`D_check` = 0 AND `Product_list`.`RE_ID` = 1
                            GROUP BY `Product_list`.`D_check` ";
                                $sql_result = $conn->query($sql);
                                while ($row = mysqli_fetch_array($sql_result)) {
                                    $rand = $row['P_ID'];
                                }



                                $cq = 0;
                                $tq = 0;

                                // Confirm Execute sql
                                $sql = "SELECT *, COUNT(`Product_list`.`P_ID`) AS allp FROM `Product_list` Where `Product_list`.`D_check` = 1  AND `Product_list`.`P_state` = 'inStock' AND `Product_list`.`RE_ID`=1";
                                $sql_result = $conn->query($sql);
                                while ($row = mysqli_fetch_array($sql_result)) {
                                    // echo "<h2 class='w-100 mb-2 mt-2 text-center text-danger'>" . $row['allp'] . "</h2>";
                                    $cq = $row['allp'];
                                }


                                // total Execute sql
                                $sql = "SELECT COUNT(`Product_list`.`P_ID`) AS allp FROM `Product_list` WHERE `Product_list`.`P_state` = 'inStock' AND `Product_list`.`RE_ID`=1 ";
                                $sql_result = $conn->query($sql);
                                while ($row = mysqli_fetch_array($sql_result)) {
                                    // echo "<h2 class='w-100 mb-2 mt-2 text-center text-danger'>" . $row['allp'] . "</h2>";
                                    $tq = $row['allp'];
                                }



                                echo "<h2 class='w-100 mb-2 mt-2 text-center text-danger'>" . "CONFIRMED :  " . $cq . " ／ " . $tq . "</h2>";


                                // Scan
                                echo "<button class='w-100 mb-2 mt-2 btn btn-lg rounded-4 btn-success nav-color' type='submit' name='action' value='scan_wh' >Scan barcode to Confirm</button>";

                                ?>

                                <!-- data list -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th class="text-danger">Product ID</th>
                                                    <th>Title</th>
                                                    <th>Color </th>
                                                    <th>Size</th>
                                                    <th>Price per piece</th>
                                                    <th>Branch & Warehouse</th>
                                                    <th class="text-danger">Check</th>
                                                    <th>Last check time</th>
                                                </tr>
                                            </thead>


                                            <tbody>
                                                <?php




                                                $sl = 0;

                                                // SQL SELECT RECORD  
                                                $sql = "SELECT
                                                `Product_list`.`P_ID`,
                                                `Product`.`P_code`,
                                                `Product`.`P_title`,
                                                `Product`.`P_color`,
                                                `Product`.`P_size`,
                                                `Product`.`P_price`,
                                                `Real_estate`.`RE_name`,
                                                `Product_list`.`D_check`,
                                                `Product_list`.`DC_datetime`
                                            FROM
                                                `Product`,
                                                `Product_list`,
                                                `Real_estate`
                                            WHERE
                                                `Product`.`P_code` = `Product_list`.`P_code` AND `Product_list`.`RE_ID` = `Real_estate`.`RE_ID` AND `Product_list`.`P_state` = 'inStock' AND `Product_list`.`RE_ID` = 1";
                                                // Execute sql
                                                $sql_result = $conn->query($sql);
                                                while ($row = mysqli_fetch_array($sql_result)) {
                                                    $sl++;


                                                    if ($row['D_check'] == 1) {
                                                        $check = 'Confirm';
                                                    } else {
                                                        $check = 'NULL';
                                                    };

                                                ?>

                                                    <tr>
                                                        <td><?php echo $sl; ?></td>
                                                        <th class="text-danger"><?php echo $row['P_ID']; ?></th>
                                                        <td><?php echo $row['P_title']; ?></td>
                                                        <td><?php echo $row['P_color']; ?></td>
                                                        <td><?php echo $row['P_size']; ?></td>
                                                        <td><?php echo "$" . $row['P_price']; ?></td>
                                                        <th><?php echo $row['RE_name']; ?></th>
                                                        <td class="text-danger"><?php echo $check; ?></td>
                                                        <td><?php echo $row['DC_datetime']; ?></td>
                                                    </tr>
                                                <?php }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--  -->

                        <?php break;

                        case "BS1": ?>
                            <!-- ///////////////////////////////////////////////////////////////////////////////////   Bracnch Store 1  -->
                            <div>

                                <h2 class='w-100 mb-2 mt-2 text-center text-danger'>Branch Store 1</h2>

                                <?php

                                // Connect database
                                require "./db_connect.php";



                                $rand = 0;


                                // SELECT P_ID  where is 0
                                $sql = "SELECT DISTINCT `Product_list`.`P_ID` FROM `Product_list` WHERE `Product_list`.`P_state` = 'inStock' AND `Product_list`.`D_check` = 0 AND `Product_list`.`RE_ID` = 2
                            GROUP BY `Product_list`.`D_check` ";
                                $sql_result = $conn->query($sql);
                                while ($row = mysqli_fetch_array($sql_result)) {
                                    $rand = $row['P_ID'];
                                }


                                $sql_result = $conn->query($sql);


                                $cq = 0;
                                $tq = 0;

                                // Confirm Execute sql
                                $sql = "SELECT *, COUNT(`Product_list`.`P_ID`) AS allp FROM `Product_list` Where `Product_list`.`D_check` = 1  AND `Product_list`.`P_state` = 'inStock' AND `Product_list`.`RE_ID`=2";
                                $sql_result = $conn->query($sql);
                                while ($row = mysqli_fetch_array($sql_result)) {
                                    // echo "<h2 class='w-100 mb-2 mt-2 text-center text-danger'>" . $row['allp'] . "</h2>";
                                    $cq = $row['allp'];
                                }


                                // total Execute sql
                                $sql = "SELECT COUNT(`Product_list`.`P_ID`) AS allp FROM `Product_list` WHERE `Product_list`.`P_state` = 'inStock' AND `Product_list`.`RE_ID`=2 ";
                                $sql_result = $conn->query($sql);
                                while ($row = mysqli_fetch_array($sql_result)) {
                                    // echo "<h2 class='w-100 mb-2 mt-2 text-center text-danger'>" . $row['allp'] . "</h2>";
                                    $tq = $row['allp'];
                                }



                                echo "<h2 class='w-100 mb-2 mt-2 text-center text-danger'>" . "CONFIRMED :  " . $cq . " ／ " . $tq . "</h2>";


                                // Scan
                                echo "<button class='w-100 mb-2 mt-2 btn btn-lg rounded-4 btn-success nav-color' type='submit' name='action' value='scan_bs1' >Scan barcode to Confirm</button>";

                                ?>
                                <!-- data list -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                            <tr>
                                                    <th>No.</th>
                                                    <th class="text-danger">Product ID</th>
                                                    <th>Title</th>
                                                    <th>Color </th>
                                                    <th>Size</th>
                                                    <th>Price per piece</th>
                                                    <th>Branch & Warehouse</th>
                                                    <th class="text-danger">Check</th>
                                                    <th>Last check time</th>
                                                </tr>
                                            </thead>


                                            <tbody>
                                                <?php




                                                $sl = 0;

                                                // SQL SELECT RECORD  
                                                $sql = "SELECT
                                                `Product_list`.`P_ID`,
                                                `Product`.`P_code`,
                                                `Product`.`P_title`,
                                                `Product`.`P_color`,
                                                `Product`.`P_size`,
                                                `Product`.`P_price`,
                                                `Real_estate`.`RE_name`,
                                                `Product_list`.`D_check`,
                                                `Product_list`.`DC_datetime`
                                            FROM
                                                `Product`,
                                                `Product_list`,
                                                `Real_estate`
                                            WHERE
                                                `Product`.`P_code` = `Product_list`.`P_code` AND `Product_list`.`RE_ID` = `Real_estate`.`RE_ID` AND `Product_list`.`P_state` = 'inStock' AND `Product_list`.`RE_ID` = 2";
                                                // Execute sql
                                                $sql_result = $conn->query($sql);
                                                while ($row = mysqli_fetch_array($sql_result)) {
                                                    $sl++;


                                                    if ($row['D_check'] == 1) {
                                                        $check = 'Confirm';
                                                    } else {
                                                        $check = 'NULL';
                                                    };

                                                ?>

                                                    <tr>
                                                        <td><?php echo $sl; ?></td>
                                                        <th class="text-danger"><?php echo $row['P_ID']; ?></th>
                                                        <td><?php echo $row['P_title']; ?></td>
                                                        <td><?php echo $row['P_color']; ?></td>
                                                        <td><?php echo $row['P_size']; ?></td>
                                                        <td><?php echo "$" . $row['P_price']; ?></td>
                                                        <th><?php echo $row['RE_name']; ?></th>
                                                        <td class="text-danger"><?php echo $check; ?></td>
                                                        <td><?php echo $row['DC_datetime']; ?></td>
                                                    </tr>
                                                <?php }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--  -->

                        <?php break;




                        case "BS2": ?>
                            <!-- ///////////////////////////////////////////////////////////////////////////////////   Bracnch Store 2  -->
                            <div>




                                <h2 class='w-100 mb-2 mt-2 text-center text-danger'>Branch Store 2</h2>

                                <?php

                                // Connect database
                                require "./db_connect.php";


                                $rand = 0;


                                // SELECT P_ID  where is 0
                                $sql = "SELECT DISTINCT `Product_list`.`P_ID` FROM `Product_list` WHERE `Product_list`.`P_state` = 'inStock' AND `Product_list`.`D_check` = 0 AND `Product_list`.`RE_ID` = 3
                            GROUP BY `Product_list`.`D_check` ";
                                $sql_result = $conn->query($sql);
                                while ($row = mysqli_fetch_array($sql_result)) {
                                    $rand = $row['P_ID'];
                                }

                                // Confirm Execute sql
                                $sql = "SELECT *, COUNT(`Product_list`.`P_ID`) AS allp FROM `Product_list` Where `Product_list`.`D_check` = 1  AND `Product_list`.`P_state` = 'inStock' AND `Product_list`.`RE_ID`=3";
                                $sql_result = $conn->query($sql);
                                while ($row = mysqli_fetch_array($sql_result)) {
                                    // echo "<h2 class='w-100 mb-2 mt-2 text-center text-danger'>" . $row['allp'] . "</h2>";
                                    $cq = $row['allp'];
                                }


                                // total Execute sql
                                $sql = "SELECT COUNT(`Product_list`.`P_ID`) AS allp FROM `Product_list` WHERE `Product_list`.`P_state` = 'inStock' AND `Product_list`.`RE_ID`=3 ";
                                $sql_result = $conn->query($sql);
                                while ($row = mysqli_fetch_array($sql_result)) {
                                    // echo "<h2 class='w-100 mb-2 mt-2 text-center text-danger'>" . $row['allp'] . "</h2>";
                                    $tq = $row['allp'];
                                }



                                echo "<h2 class='w-100 mb-2 mt-2 text-center text-danger'>" . "CONFIRMED :  " . $cq . " ／ " . $tq . "</h2>";

                                // Scan
                                echo "<button class='w-100 mb-2 mt-2 btn btn-lg rounded-4 btn-success nav-color' type='submit' name='action' value='scan_bs2' >Scan barcode to Confirm</button>";

                                ?>
                                <!-- data list -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                            <tr>
                                                    <th>No.</th>
                                                    <th class="text-danger">Product ID</th>
                                                    <th>Title</th>
                                                    <th>Color </th>
                                                    <th>Size</th>
                                                    <th>Price per piece</th>
                                                    <th>Branch & Warehouse</th>
                                                    <th class="text-danger">Check</th>
                                                    <th>Last check time</th>
                                                </tr>
                                            </thead>


                                            <tbody>
                                                <?php




                                                $sl = 0;

                                                // SQL SELECT RECORD  
                                                $sql = "SELECT
                                                `Product_list`.`P_ID`,
                                                `Product`.`P_code`,
                                                `Product`.`P_title`,
                                                `Product`.`P_color`,
                                                `Product`.`P_size`,
                                                `Product`.`P_price`,
                                                `Real_estate`.`RE_name`,
                                                `Product_list`.`D_check`,
                                                `Product_list`.`DC_datetime`
                                            FROM
                                                `Product`,
                                                `Product_list`,
                                                `Real_estate`
                                            WHERE
                                                `Product`.`P_code` = `Product_list`.`P_code` AND `Product_list`.`RE_ID` = `Real_estate`.`RE_ID` AND `Product_list`.`P_state` = 'inStock' AND `Product_list`.`RE_ID` = 3";
                                                // Execute sql
                                                $sql_result = $conn->query($sql);
                                                while ($row = mysqli_fetch_array($sql_result)) {
                                                    $sl++;


                                                    if ($row['D_check'] == 1) {
                                                        $check = 'Confirm';
                                                    } else {
                                                        $check = 'NULL';
                                                    };

                                                ?>

                                                    <tr>
                                                        <td><?php echo $sl; ?></td>
                                                        <th class="text-danger"><?php echo $row['P_ID']; ?></th>
                                                        <td><?php echo $row['P_title']; ?></td>
                                                        <td><?php echo $row['P_color']; ?></td>
                                                        <td><?php echo $row['P_size']; ?></td>
                                                        <td><?php echo "$" . $row['P_price']; ?></td>
                                                        <th><?php echo $row['RE_name']; ?></th>
                                                        <td class="text-danger"><?php echo $check; ?></td>
                                                        <td><?php echo $row['DC_datetime']; ?></td>
                                                    </tr>
                                                <?php }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--  -->

                        <?php break;
                        case "request": ?>
                            <div>

                                <form action="index.php" method="GET">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label text-danger">Request Product ID</label>
                                        <input type="text" name="pid" class="form-control">
                                        <div class="form-text"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Sender ID </label>
                                        <input type="text" name="s" class="form-control">
                                        <div class="form-text">Warehouse ID = 1 || Branch Store 1 ID = 2 || Branch Store 2 ID = 3</div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">to Destination ID </label>
                                        <input type="text" name="d" class="form-control">
                                        <div class="form-text">Warehouse ID = 1 || Branch Store 1 ID = 2 || Branch Store 2 ID = 3</div>
                                    </div>

                                    <button class='w-100 mb-2 mt-2 btn btn-lg rounded-4 btn-warning nav-color' type='submit' name='action' value='request'>Request product</button>
                                </form>


                                <?php



                                $pid = $_GET['pid'];
                                $s = $_GET['s'];
                                $d = $_GET['d'];

                                require "./db_connect.php";

                                if (empty($pid)) {
                                    echo "<script>";
                                    echo "window.location.href='index.php;";
                                    echo "</script>";
                                } else {

                                    // SQL UPDATE RECORD  
                                    $sql = "UPDATE`Product_list` SET `Product_list`.`RE_ID` = $d 
              WHERE `Product_list`.`P_ID` = $pid";
                                    $sql_result = $conn->query($sql);

                                    $nameS = '';
                                    $nameD = '';

                                    // SQL SELECT RECORD  
                                    $sql = "SELECT * FROM `Real_estate` WHERE  RE_ID = $s ";
                                    $sql_result = $conn->query($sql);
                                    while ($row = mysqli_fetch_array($sql_result)) {

                                        $nameS = $row['RE_name'];
                                    }



                                    // SQL SELECT RECORD  
                                    $sql = "SELECT * FROM `Real_estate` WHERE  RE_ID = $d  ";
                                    $sql_result = $conn->query($sql);
                                    while ($row = mysqli_fetch_array($sql_result)) {

                                        $nameD = $row['RE_name'];
                                    }

                                    echo "<h2 class='w-100 mb-2 mt-2 text-center text-primary'>" . "REQUSEST SUCCEEDED" .  "</h2>";
                                    echo "<h2 class='w-100 mb-2 mt-2 text-center text-primary'>" . $s  . "#" . $nameS . " ---> " . $d . "#" . $nameD . "</h2>";




                                    $pCode = 0;

                                    // SQL SELECT RECORD  
                                    $sql = "select * from 
              `Product`,
              `Product_list`
              where `Product`.`P_code` = `Product_list`.`P_code` AND`Product_list`.`P_ID` =  $pid;";
                                    $sql_result = $conn->query($sql);
                                    while ($row = mysqli_fetch_array($sql_result)) {
                                        echo "<h2 class='w-100 mb-2 mt-2 text-center text-danger'>" . "Product ID#" . $row['P_ID'] . "</h2><h2 class='w-100 mb-2 mt-2 text-center text-muted'>" . $row['P_title'] . "</h2>";
                                        echo "<h2 class='w-100 mb-2 mt-2 text-center text-danger'>" . $row['P_color'] . " @ " . $row['P_size'] . "</h2>";

                                        $pCode = $row['P_code'];
                                    }




                                ?>



                                    <!-- data list -->
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Title </th>
                                                        <th class="text-danger">Product ID</th>
                                                        <th>Color </th>
                                                        <th>Size</th>
                                                        <th>Price per piece</th>
                                                        <th>State</th>
                                                        <th class="text-danger">B&W ID</th>
                                                        <th>Branch & Warehouse</th>
                                                        <th>Address</th>
                                                    </tr>
                                                </thead>


                                                <tbody>
                                                    <?php


                                                    print_r("P_ID" . $pCode);
                                                    $sl = 0;

                                                    // SQL SELECT RECORD  
                                                    $sql = "SELECT
                              *
                           FROM
                               `Product_list`,
                               `Product`,
                               `Real_estate`
                           WHERE
                               (
                                   `Product`.`P_code` = `Product_list`.`P_code`
                               ) AND(
                                   `Product_list`.`RE_ID` = `Real_estate`.`RE_ID`
                               )	AND `Product`.`P_code` =$pCode";
                                                    // Execute sql
                                                    $sql_result = $conn->query($sql);
                                                    while ($row = mysqli_fetch_array($sql_result)) {
                                                        $sl++;
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $sl; ?></td>
                                                            <td><?php echo $row['P_title']; ?></td>
                                                            <th class="text-danger"><?php echo $row['P_ID']; ?></th>
                                                            <td><?php echo $row['P_color']; ?></td>
                                                            <td><?php echo $row['P_size']; ?></td>
                                                            <td><?php echo "$" . $row['P_price']; ?></td>
                                                            <td><?php echo $row['P_state']; ?></td>
                                                            <tH class="text-danger"><?php echo $row['RE_ID']; ?></th>
                                                            <td><?php echo $row['RE_name']; ?></td>
                                                            <td><?php echo $row['RE_address']; ?></td>
                                                            <?php
                                                            ?>
                                                        </tr>
                                                    <?php }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                            </div>


                        <?php  }
                        ?>
                    <?php break;
                        case "spid": ?>
                        <!-- ///////////////////////////////////////////////////////////////////////////////////   SCAN  -->
                        <div>




                            <?php

                            // Connect database
                            require "./db_connect.php";


                            $spid = $_GET['spid'];

                            $pCode = 0;

                            if (empty($spid)) {
                                echo "<script>";
                                echo "window.location.href='index.php;";
                                echo "</script>";
                            } else {

                                // SQL SELECT RECORD  
                                $sql = "select * from 
                                `Product`,
                                `Product_list`
                                where `Product`.`P_code` = `Product_list`.`P_code` AND`Product_list`.`P_ID` =  $spid";
                                $sql_result = $conn->query($sql);
                                while ($row = mysqli_fetch_array($sql_result)) {
                                    echo "<h2 class='w-100 mb-2 mt-2 text-center text-danger'>" . "Product ID#" . $row['P_ID'] .
                                        "</h2><h2 class='w-100 mb-2 mt-2 text-center text-muted'>" . $row['P_title'] . "</h2>";
                                    echo "<h2 class='w-100 mb-2 mt-2 text-center text-danger'>" . $row['P_color'] . " , " . $row['P_size'] .  " ,  $" . $row['P_price'] . "</h2>";
                                    $pCode = $row['P_key'];
                                }



                            ?>



                                <!-- data list -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Title </th>
                                                    <th class="text-danger">Product ID</th>
                                                    <th>Color </th>
                                                    <th>Size</th>
                                                    <th>Price per piece</th>
                                                    <th>State</th>
                                                    <th class="text-danger">B&W ID</th>
                                                    <th>Branch & Warehouse</th>
                                                    <th>Address</th>
                                                </tr>
                                            </thead>


                                            <tbody>
                                                <?php

                                                $sl = 0;

                                                // SQL SELECT RECORD  
                                                $sql = "SELECT
                                                *
                                             FROM
                                                 `Product_list`,
                                                 `Product`,
                                                 `Real_estate`
                                             WHERE
                                                 (
                                                     `Product`.`P_code` = `Product_list`.`P_code`
                                                 ) AND(
                                                     `Product_list`.`RE_ID` = `Real_estate`.`RE_ID`
                                                 )	AND `Product`.`P_key` =$pCode";
                                                // Execute sql
                                                $sql_result = $conn->query($sql);
                                                while ($row = mysqli_fetch_array($sql_result)) {
                                                    $sl++;
                                                ?>
                                                    <tr>
                                                        <td><?php echo $sl; ?></td>
                                                        <td><?php echo $row['P_title']; ?></td>
                                                        <th class="text-danger"><?php echo $row['P_ID']; ?></th>
                                                        <td><?php echo $row['P_color']; ?></td>
                                                        <td><?php echo $row['P_size']; ?></td>
                                                        <td><?php echo "$" . $row['P_price']; ?></td>
                                                        <td><?php echo $row['P_state']; ?></td>
                                                        <tH class="text-danger"><?php echo $row['RE_ID']; ?></th>
                                                        <td><?php echo $row['RE_name']; ?></td>
                                                        <td><?php echo $row['RE_address']; ?></td>
                                                        <?php
                                                        ?>
                                                    </tr>
                                            <?php }
                                            }
                                            ?>
                                            </tbody>
                                        </table>

                                        <form action="index.php" method="GET">
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label text-danger">Request Product ID</label>
                                                <input type="text" name="pid" class="form-control">
                                                <div class="form-text"></div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Sender ID </label>
                                                <input type="text" name="s" class="form-control">
                                                <div class="form-text">Warehouse ID = 1 || Branch Store 1 ID = 2 || Branch Store 2 ID = 3</div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputPassword1" class="form-label">to Destination ID </label>
                                                <input type="text" name="d" class="form-control">
                                                <div class="form-text">Warehouse ID = 1 || Branch Store 1 ID = 2 || Branch Store 2 ID = 3</div>
                                            </div>

                                            <button class='w-100 mb-2 mt-2 btn btn-lg rounded-4 btn-warning nav-color' type='submit' name='action' value='request'>Request product</button>
                                        </form>
                                    </div>
                                </div>
                        </div>

                    <?php break;
                        case "scan_a":
                    ?>
                        <h2 class='w-100 mb-2 mt-2 text-center text-danger'>ALL Products</h2>

                        <?php
                            // Connect database
                            require "./db_connect.php";



                            $rand = 0;


                            // SELECT P_ID  where is 0
                            $sql = "SELECT DISTINCT `Product_list`.`P_ID` FROM `Product_list` WHERE `Product_list`.`P_state` = 'inStock' AND `Product_list`.`D_check` = 0 
                            GROUP BY `Product_list`.`D_check` ";
                            $sql_result = $conn->query($sql);
                            while ($row = mysqli_fetch_array($sql_result)) {
                                $rand = $row['P_ID'];
                            }


                            // update to Confirm
                            $sql = "UPDATE
                            `Product_list`
                        SET
                            `Product_list`.`D_check` = 1
                        WHERE
                            `Product_list`.`P_state` = 'inStock' 
                            AND `Product_list`.`P_ID` = $rand ";

                            $sql_result = $conn->query($sql);

                            // Show to update name 
                            $sql = "select * from 
                                `Product`,
                                `Product_list`
                                where `Product`.`P_code` = `Product_list`.`P_code` AND`Product_list`.`P_ID` =  $rand";
                            $sql_result = $conn->query($sql);
                            while ($row = mysqli_fetch_array($sql_result)) {
                                echo "<h2 class='w-100 mb-2 mt-2 text-center text-primary'>" . "Product ID#" . $row['P_ID'] .
                                    "</h2><h2 class='w-100 mb-2 mt-2 text-center text-muted'>" . $row['P_title'] . "</h2>";
                                echo "<h2 class='w-100 mb-2 mt-2 text-center text-primary'>" . $row['P_color'] . " , " . $row['P_size'] .  " ,  $" . $row['P_price'] . "</h2>";
                                $pCode = $row['P_key'];
                            }

                            $cq = 0;
                            $tq = 0;

                            // Confirm Execute sql
                            $sql = "SELECT *, COUNT(`Product_list`.`P_ID`) AS allp FROM `Product_list` Where `Product_list`.`D_check` = 1  AND `Product_list`.`P_state` = 'inStock' ";
                            $sql_result = $conn->query($sql);
                            while ($row = mysqli_fetch_array($sql_result)) {
                                // echo "<h2 class='w-100 mb-2 mt-2 text-center text-danger'>" . $row['allp'] . "</h2>";
                                $cq = $row['allp'];
                            }


                            // total Execute sql
                            $sql = "SELECT COUNT(`Product_list`.`P_ID`) AS allp FROM `Product_list` WHERE `Product_list`.`P_state` = 'inStock'";
                            $sql_result = $conn->query($sql);
                            while ($row = mysqli_fetch_array($sql_result)) {
                                // echo "<h2 class='w-100 mb-2 mt-2 text-center text-danger'>" . $row['allp'] . "</h2>";
                                $tq = $row['allp'];
                            }



                            echo "<h2 class='w-100 mb-2 mt-2 text-center text-danger'>" . "CONFIRMED :  " . $cq . " ／ " . $tq . "</h2>";


                            // Scan
                            echo "<button class='w-100 mb-2 mt-2 btn btn-lg rounded-4 btn-success nav-color' type='submit' name='action' value='scan_a' >Scan barcode to Confirm</button>";







                        ?>
                        <!-- data list -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Title</th>
                                            <th>Color </th>
                                            <th>Size</th>
                                            <th>Price per piece</th>
                                            <th>Branch & Warehouse</th>
                                            <th class="text-danger">Check</th>
                                            <th>Last check time</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        <?php

                                        $sl = 0;

                                        // SQL SELECT RECORD  
                                        $sql = "SELECT
                                            `Product`.`P_code`,
                                            `Product`.`P_title`,
                                            `Product`.`P_color`,
                                            `Product`.`P_size`,
                                            `Product`.`P_price`,
                                            `Real_estate`.`RE_name`,
                                            `Product_list`.`D_check`,
                                            `Product_list`.`DC_datetime`
                                        FROM
                                            `Product`,
                                            `Product_list`,
                                            `Real_estate`
                                        WHERE
                                            `Product`.`P_code` = `Product_list`.`P_code` AND `Product_list`.`RE_ID` = `Real_estate`.`RE_ID` AND `Product_list`.`P_state` = 'inStock'";
                                        // Execute sql
                                        $sql_result = $conn->query($sql);
                                        while ($row = mysqli_fetch_array($sql_result)) {
                                            $sl++;


                                            if ($row['D_check'] == 1) {
                                                $check = 'Confirm';
                                            } else {
                                                $check = 'NULL';
                                            };

                                        ?>

                                            <tr>
                                                <td><?php echo $sl; ?></td>
                                                <td><?php echo $row['P_title']; ?></td>
                                                <td><?php echo $row['P_color']; ?></td>
                                                <td><?php echo $row['P_size']; ?></td>
                                                <td><?php echo "$" . $row['P_price']; ?></td>
                                                <td><?php echo $row['RE_name']; ?></td>
                                                <td class="text-danger"><?php echo $check; ?></td>
                                                <td><?php echo $row['DC_datetime']; ?></td>
                                            </tr>
                                        <?php }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
            </div>
            <!--  -->

        <?php break;
                        case "scan_wh":
        ?>
            <h2 class='w-100 mb-2 mt-2 text-center text-danger'>Warehouse</h2>

            <?php
                            // Connect database
                            require "./db_connect.php";



                            $rand = 0;


                            // SELECT P_ID  where is 0
                            $sql = "SELECT DISTINCT `Product_list`.`P_ID` FROM `Product_list` WHERE `Product_list`.`P_state` = 'inStock' AND `Product_list`.`D_check` = 0 AND `Product_list`.`RE_ID` = 1
                            GROUP BY `Product_list`.`D_check` ";
                            $sql_result = $conn->query($sql);
                            while ($row = mysqli_fetch_array($sql_result)) {
                                $rand = $row['P_ID'];
                            }


                            // update to Confirm
                            $sql = "UPDATE
                            `Product_list`
                        SET
                            `Product_list`.`D_check` = 1
                        WHERE
                            `Product_list`.`P_state` = 'inStock' AND `Product_list`.`RE_ID` = 1
                            AND `Product_list`.`P_ID` = $rand ";

                            $sql_result = $conn->query($sql);

                            // Show to update name 
                            $sql = "select * from 
                                `Product`,
                                `Product_list`
                                where `Product`.`P_code` = `Product_list`.`P_code` AND`Product_list`.`P_ID` =  $rand";
                            $sql_result = $conn->query($sql);
                            while ($row = mysqli_fetch_array($sql_result)) {
                                echo "<h2 class='w-100 mb-2 mt-2 text-center text-primary'>" . "Product ID#" . $row['P_ID'] .
                                    "</h2><h2 class='w-100 mb-2 mt-2 text-center text-muted'>" . $row['P_title'] . "</h2>";
                                echo "<h2 class='w-100 mb-2 mt-2 text-center text-primary'>" . $row['P_color'] . " , " . $row['P_size'] .  " ,  $" . $row['P_price'] . "</h2>";
                                $pCode = $row['P_key'];
                            }

                            $cq = 0;
                            $tq = 0;

                            // Confirm Execute sql
                            $sql = "SELECT *, COUNT(`Product_list`.`P_ID`) AS allp FROM `Product_list` Where `Product_list`.`D_check` = 1  AND `Product_list`.`P_state` = 'inStock' AND `Product_list`.`RE_ID`=1";
                            $sql_result = $conn->query($sql);
                            while ($row = mysqli_fetch_array($sql_result)) {
                                // echo "<h2 class='w-100 mb-2 mt-2 text-center text-danger'>" . $row['allp'] . "</h2>";
                                $cq = $row['allp'];
                            }


                            // total Execute sql
                            $sql = "SELECT COUNT(`Product_list`.`P_ID`) AS allp FROM `Product_list` WHERE `Product_list`.`P_state` = 'inStock' AND `Product_list`.`RE_ID`=1 ";
                            $sql_result = $conn->query($sql);
                            while ($row = mysqli_fetch_array($sql_result)) {
                                // echo "<h2 class='w-100 mb-2 mt-2 text-center text-danger'>" . $row['allp'] . "</h2>";
                                $tq = $row['allp'];
                            }



                            echo "<h2 class='w-100 mb-2 mt-2 text-center text-danger'>" . "CONFIRMED :  " . $cq . " ／ " . $tq . "</h2>";


                            // Scan
                            echo "<button class='w-100 mb-2 mt-2 btn btn-lg rounded-4 btn-success nav-color' type='submit' name='action' value='scan_wh' >Scan barcode to Confirm</button>";

            ?>

            <!-- data list -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Title</th>
                                <th>Color </th>
                                <th>Size</th>
                                <th>Price per piece</th>
                                <th>Branch & Warehouse</th>
                                <th class="text-danger">Check</th>
                                <th>Last check time</th>
                            </tr>
                        </thead>


                        <tbody>
                            <?php

                            $sl = 0;

                            // SQL SELECT RECORD  
                            $sql = "SELECT
                                        `Product`.`P_code`,
                                        `Product`.`P_title`,
                                        `Product`.`P_color`,
                                        `Product`.`P_size`,
                                        `Product`.`P_price`,
                                        `Real_estate`.`RE_name`,
                                        `Product_list`.`D_check`,
                                        `Product_list`.`DC_datetime`
                                    FROM
                                        `Product`,
                                        `Product_list`,
                                        `Real_estate`
                                    WHERE
                                        `Product`.`P_code` = `Product_list`.`P_code` AND `Product_list`.`RE_ID` = `Real_estate`.`RE_ID` AND `Product_list`.`P_state` = 'inStock' AND `Product_list`.`RE_ID` = 1";
                            // Execute sql
                            $sql_result = $conn->query($sql);
                            while ($row = mysqli_fetch_array($sql_result)) {
                                $sl++;


                                if ($row['D_check'] == 1) {
                                    $check = 'Confirm';
                                } else {
                                    $check = 'NULL';
                                };

                            ?>

                                <tr>
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $row['P_title']; ?></td>
                                    <td><?php echo $row['P_color']; ?></td>
                                    <td><?php echo $row['P_size']; ?></td>
                                    <td><?php echo "$" . $row['P_price']; ?></td>
                                    <td><?php echo $row['RE_name']; ?></td>
                                    <td class="text-danger"><?php echo $check; ?></td>
                                    <td><?php echo $row['DC_datetime']; ?></td>
                                </tr>
                            <?php }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--  -->

    <?php break;
                        case "scan_bs1":
    ?>
        <h2 class='w-100 mb-2 mt-2 text-center text-danger'>Branch Store 1</h2>

        <?php
                            // Connect database
                            require "./db_connect.php";



                            $rand = 0;


                            // SELECT P_ID  where is 0
                            $sql = "SELECT DISTINCT `Product_list`.`P_ID` FROM `Product_list` WHERE `Product_list`.`P_state` = 'inStock' AND `Product_list`.`D_check` = 0 AND `Product_list`.`RE_ID` = 2
                            GROUP BY `Product_list`.`D_check` ";
                            $sql_result = $conn->query($sql);
                            while ($row = mysqli_fetch_array($sql_result)) {
                                $rand = $row['P_ID'];
                            }


                            // update to Confirm
                            $sql = "UPDATE
                            `Product_list`
                        SET
                            `Product_list`.`D_check` = 1
                        WHERE
                            `Product_list`.`P_state` = 'inStock' AND `Product_list`.`RE_ID` = 2
                            AND `Product_list`.`P_ID` = $rand ";

                            $sql_result = $conn->query($sql);

                            // Show to update name 
                            $sql = "select * from 
                                `Product`,
                                `Product_list`
                                where `Product`.`P_code` = `Product_list`.`P_code` AND`Product_list`.`P_ID` =  $rand";
                            $sql_result = $conn->query($sql);
                            while ($row = mysqli_fetch_array($sql_result)) {
                                echo "<h2 class='w-100 mb-2 mt-2 text-center text-primary'>" . "Product ID#" . $row['P_ID'] .
                                    "</h2><h2 class='w-100 mb-2 mt-2 text-center text-muted'>" . $row['P_title'] . "</h2>";
                                echo "<h2 class='w-100 mb-2 mt-2 text-center text-primary'>" . $row['P_color'] . " , " . $row['P_size'] .  " ,  $" . $row['P_price'] . "</h2>";
                                $pCode = $row['P_key'];
                            }

                            $cq = 0;
                            $tq = 0;

                            // Confirm Execute sql
                            $sql = "SELECT *, COUNT(`Product_list`.`P_ID`) AS allp FROM `Product_list` Where `Product_list`.`D_check` = 1  AND `Product_list`.`P_state` = 'inStock' AND `Product_list`.`RE_ID`=2";
                            $sql_result = $conn->query($sql);
                            while ($row = mysqli_fetch_array($sql_result)) {
                                // echo "<h2 class='w-100 mb-2 mt-2 text-center text-danger'>" . $row['allp'] . "</h2>";
                                $cq = $row['allp'];
                            }


                            // total Execute sql
                            $sql = "SELECT COUNT(`Product_list`.`P_ID`) AS allp FROM `Product_list` WHERE `Product_list`.`P_state` = 'inStock' AND `Product_list`.`RE_ID`=2 ";
                            $sql_result = $conn->query($sql);
                            while ($row = mysqli_fetch_array($sql_result)) {
                                // echo "<h2 class='w-100 mb-2 mt-2 text-center text-danger'>" . $row['allp'] . "</h2>";
                                $tq = $row['allp'];
                            }



                            echo "<h2 class='w-100 mb-2 mt-2 text-center text-danger'>" . "CONFIRMED :  " . $cq . " ／ " . $tq . "</h2>";

                            // Scan
                            echo "<button class='w-100 mb-2 mt-2 btn btn-lg rounded-4 btn-success nav-color' type='submit' name='action' value='scan_bs1' >Scan barcode to Confirm</button>";

        ?>

        <!-- data list -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Title</th>
                            <th>Color </th>
                            <th>Size</th>
                            <th>Price per piece</th>
                            <th>Branch & Warehouse</th>
                            <th class="text-danger">Check</th>
                            <th>Last check time</th>
                        </tr>
                    </thead>


                    <tbody>
                        <?php

                            $sl = 0;

                            // SQL SELECT RECORD  
                            $sql = "SELECT
                                        `Product`.`P_code`,
                                        `Product`.`P_title`,
                                        `Product`.`P_color`,
                                        `Product`.`P_size`,
                                        `Product`.`P_price`,
                                        `Real_estate`.`RE_name`,
                                        `Product_list`.`D_check`,
                                        `Product_list`.`DC_datetime`
                                    FROM
                                        `Product`,
                                        `Product_list`,
                                        `Real_estate`
                                    WHERE
                                        `Product`.`P_code` = `Product_list`.`P_code` AND `Product_list`.`RE_ID` = `Real_estate`.`RE_ID` AND `Product_list`.`P_state` = 'inStock' AND `Product_list`.`RE_ID` = 2";
                            // Execute sql
                            $sql_result = $conn->query($sql);
                            while ($row = mysqli_fetch_array($sql_result)) {
                                $sl++;


                                if ($row['D_check'] == 1) {
                                    $check = 'Confirm';
                                } else {
                                    $check = 'NULL';
                                };

                        ?>

                            <tr>
                                <td><?php echo $sl; ?></td>
                                <td><?php echo $row['P_title']; ?></td>
                                <td><?php echo $row['P_color']; ?></td>
                                <td><?php echo $row['P_size']; ?></td>
                                <td><?php echo "$" . $row['P_price']; ?></td>
                                <td><?php echo $row['RE_name']; ?></td>
                                <td class="text-danger"><?php echo $check; ?></td>
                                <td><?php echo $row['DC_datetime']; ?></td>
                            </tr>
                        <?php }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--  -->
<?php break;
                        case "scan_bs2":
?>
    <h2 class='w-100 mb-2 mt-2 text-center text-danger'>Branch Store 2</h2>

    <?php

                            // Connect database
                            require "./db_connect.php";



                            $rand = 0;


                            // SELECT P_ID  where is 0
                            $sql = "SELECT DISTINCT `Product_list`.`P_ID` FROM `Product_list` WHERE `Product_list`.`P_state` = 'inStock' AND `Product_list`.`D_check` = 0 AND `Product_list`.`RE_ID` = 3
                            GROUP BY `Product_list`.`D_check` ";
                            $sql_result = $conn->query($sql);
                            while ($row = mysqli_fetch_array($sql_result)) {
                                $rand = $row['P_ID'];
                            }


                            // update to Confirm
                            $sql = "UPDATE
                            `Product_list`
                        SET
                            `Product_list`.`D_check` = 1
                        WHERE
                            `Product_list`.`P_state` = 'inStock' AND `Product_list`.`RE_ID` = 3
                            AND `Product_list`.`P_ID` = $rand ";

                            $sql_result = $conn->query($sql);

                            // Show to update name 
                            $sql = "select * from 
                                `Product`,
                                `Product_list`
                                where `Product`.`P_code` = `Product_list`.`P_code` AND`Product_list`.`P_ID` =  $rand";
                            $sql_result = $conn->query($sql);
                            while ($row = mysqli_fetch_array($sql_result)) {
                                echo "<h2 class='w-100 mb-2 mt-2 text-center text-primary'>" . "Product ID#" . $row['P_ID'] .
                                    "</h2><h2 class='w-100 mb-2 mt-2 text-center text-muted'>" . $row['P_title'] . "</h2>";
                                echo "<h2 class='w-100 mb-2 mt-2 text-center text-primary'>" . $row['P_color'] . " , " . $row['P_size'] .  " ,  $" . $row['P_price'] . "</h2>";
                                $pCode = $row['P_key'];
                            }

                            $cq = 0;
                            $tq = 0;

                            // Confirm Execute sql
                            $sql = "SELECT *, COUNT(`Product_list`.`P_ID`) AS allp FROM `Product_list` Where `Product_list`.`D_check` = 1  AND `Product_list`.`P_state` = 'inStock' AND `Product_list`.`RE_ID`=3";
                            $sql_result = $conn->query($sql);
                            while ($row = mysqli_fetch_array($sql_result)) {
                                // echo "<h2 class='w-100 mb-2 mt-2 text-center text-danger'>" . $row['allp'] . "</h2>";
                                $cq = $row['allp'];
                            }


                            // total Execute sql
                            $sql = "SELECT COUNT(`Product_list`.`P_ID`) AS allp FROM `Product_list` WHERE `Product_list`.`P_state` = 'inStock' AND `Product_list`.`RE_ID`=3 ";
                            $sql_result = $conn->query($sql);
                            while ($row = mysqli_fetch_array($sql_result)) {
                                // echo "<h2 class='w-100 mb-2 mt-2 text-center text-danger'>" . $row['allp'] . "</h2>";
                                $tq = $row['allp'];
                            }



                            echo "<h2 class='w-100 mb-2 mt-2 text-center text-danger'>" . "CONFIRMED :  " . $cq . " ／ " . $tq . "</h2>";

                            // Scan
                            echo "<button class='w-100 mb-2 mt-2 btn btn-lg rounded-4 btn-success nav-color' type='submit' name='action' value='scan_bs2' >Scan barcode to Confirm</button>";

    ?>

    <!-- data list -->
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Title</th>
                        <th>Color </th>
                        <th>Size</th>
                        <th>Price per piece</th>
                        <th>Branch & Warehouse</th>
                        <th class="text-danger">Check</th>
                        <th>Last check time</th>
                    </tr>
                </thead>


                <tbody>
                    <?php

                            $sl = 0;

                            // SQL SELECT RECORD  
                            $sql = "SELECT
                                        `Product`.`P_code`,
                                        `Product`.`P_title`,
                                        `Product`.`P_color`,
                                        `Product`.`P_size`,
                                        `Product`.`P_price`,
                                        `Real_estate`.`RE_name`,
                                        `Product_list`.`D_check`,
                                        `Product_list`.`DC_datetime`
                                    FROM
                                        `Product`,
                                        `Product_list`,
                                        `Real_estate`
                                    WHERE
                                        `Product`.`P_code` = `Product_list`.`P_code` AND `Product_list`.`RE_ID` = `Real_estate`.`RE_ID` AND `Product_list`.`P_state` = 'inStock' AND `Product_list`.`RE_ID` = 3";
                            // Execute sql
                            $sql_result = $conn->query($sql);
                            while ($row = mysqli_fetch_array($sql_result)) {
                                $sl++;


                                if ($row['D_check'] == 1) {
                                    $check = 'Confirm';
                                } else {
                                    $check = 'NULL';
                                };

                    ?>

                        <tr>
                            <td><?php echo $sl; ?></td>
                            <td><?php echo $row['P_title']; ?></td>
                            <td><?php echo $row['P_color']; ?></td>
                            <td><?php echo $row['P_size']; ?></td>
                            <td><?php echo "$" . $row['P_price']; ?></td>
                            <td><?php echo $row['RE_name']; ?></td>
                            <td class="text-danger"><?php echo $check; ?></td>
                            <td><?php echo $row['DC_datetime']; ?></td>
                        </tr>
                    <?php }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    </div>
    <!--  -->

<?php break;
                        case "reset":
?>

    <!-- ///////////////////////////////////////////////////////////////////////////////////   ALL  -->
    <div>
        <h2 class='w-100 mb-2 mt-2 text-center text-danger'>Check record reset successfully！</h2>

        <?php
                            // Connect database
                            require "./db_connect.php";




                            // total Execute sql
                            $sql = "UPDATE `Product_list` SET `Product_list`.`D_check` = 0 WHERE `Product_list`.`D_check` =1;";
                            $sql_result = $conn->query($sql);




        ?>
        <!-- data list -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Title</th>
                            <th>Color </th>
                            <th>Size</th>
                            <th>Price per piece</th>
                            <th>Branch & Warehouse</th>
                            <th class="text-danger">Check</th>
                            <th>Last check time</th>
                        </tr>
                    </thead>


                    <tbody>
                        <?php




                            $sl = 0;

                            // SQL SELECT RECORD  
                            $sql = "SELECT
                                                `Product`.`P_code`,
                                                `Product`.`P_title`,
                                                `Product`.`P_color`,
                                                `Product`.`P_size`,
                                                `Product`.`P_price`,
                                                `Real_estate`.`RE_name`,
                                                `Product_list`.`D_check`,
                                                `Product_list`.`DC_datetime`
                                            FROM
                                                `Product`,
                                                `Product_list`,
                                                `Real_estate`
                                            WHERE
                                                `Product`.`P_code` = `Product_list`.`P_code` AND `Product_list`.`RE_ID` = `Real_estate`.`RE_ID` AND `Product_list`.`P_state` = 'inStock'";
                            // Execute sql
                            $sql_result = $conn->query($sql);
                            while ($row = mysqli_fetch_array($sql_result)) {
                                $sl++;


                                if ($row['D_check'] == 1) {
                                    $check = 'Confirm';
                                } else {
                                    $check = 'NULL';
                                };

                        ?>

                            <tr>
                                <td><?php echo $sl; ?></td>
                                <td><?php echo $row['P_title']; ?></td>
                                <td><?php echo $row['P_color']; ?></td>
                                <td><?php echo $row['P_size']; ?></td>
                                <td><?php echo "$" . $row['P_price']; ?></td>
                                <td><?php echo $row['RE_name']; ?></td>
                                <td class="text-danger"><?php echo $check; ?></td>
                                <td><?php echo $row['DC_datetime']; ?></td>
                            </tr>
                        <?php }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--  -->


    <!-- end -->
<?php
                    }
                } else { ?>
<form action="index.php" method="GET">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label text-danger">Request Product ID</label>
        <input type="text" name="pid" class="form-control">
        <div class="form-text"></div>
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Sender ID </label>
        <input type="text" name="s" class="form-control">
        <div class="form-text">Warehouse ID = 1 || Branch Store 1 ID = 2 || Branch Store 2 ID = 3</div>
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">to Destination ID </label>
        <input type="text" name="d" class="form-control">
        <div class="form-text">Warehouse ID = 1 || Branch Store 1 ID = 2 || Branch Store 2 ID = 3</div>
    </div>

    <button class='w-100 mb-2 mt-2 btn btn-lg rounded-4 btn-warning nav-color' type='submit' name='action' value='request'>Request product</button>
</form>
<?PHP }


echo "<form action=\"Daily_check.php?\" method=\"GET\">";

// Reset
echo "<button class='w-100 mb-2 mt-2 btn btn-lg rounded-4 btn-warning nav-color' type='submit' name='action' value='reset'>Reset inspection records</button>";

echo "</form>"
?>


<!--  -->
</div>


</div>
<!-- 
            row 
        -->
</div>
<!-- container -->

<!-- ::::::::::::::::::::::::::::::: footer ::::::::::::::::::::::::::::::: -->
<div>

    <?php
    require "footer.php";
    ?>
</div>
<!-- ::::::::::::::::::::::::::::::: footer ::::::::::::::::::::::::::::::: -->

</body>

</html>