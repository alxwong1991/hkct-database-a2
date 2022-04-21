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
                <h1 class='w-100 mb-2 text-center text-danger'>Product Information</h1>

                <!-- <form action="index.php?" method="GET">
                            <button class='w-100 mb-2 mt-2 btn btn-lg rounded-4 btn-success nav-color' type='submit' name='action' value='iwh'>Inventory Warehouse</button>
                            </form> -->


                <?php


                echo "<form action=\"index.php?\" method=\"GET\">";

                // ALL
                echo "<button class='w-100 mb-2 mt-2 btn btn-lg rounded-4 btn-dark nav-color' type='submit' name='action' value='all'>All Products</button>";

                // Warehouse           
                echo "<button class='w-100 mb-2 mt-2 btn btn-lg rounded-4 btn-dark nav-color' type='submit' name='action' value='WH'>Warehouse</button>";

                // BS1
                echo "<button class='w-100 mb-2 mt-2 btn btn-lg rounded-4 btn-dark nav-color' type='submit' name='action' value='BS1'>Branch Store 1</button>";

                // BS2
                echo "<button class='w-100 mb-2 mt-2 btn btn-lg rounded-4 btn-dark nav-color' type='submit' name='action' value='BS2'>Branch Store 2</button>";

                // Scan
                echo "<button class='w-100 mb-2 mt-2 btn btn-lg rounded-4 btn-success nav-color' type='submit' name='action' value='scan' >Scan barcode to Search</button>";

                echo "<form>";


                ?>



                <?php

                if (!empty($_GET["action"])) {
                    switch ($_GET["action"]) {
                        case "all": ?>
                            <!-- ///////////////////////////////////////////////////////////////////////////////////   ALL  -->
                            <div>
                                <?php
                                require "searchCode.php";
                                ?>
                            </div>

                            <div>
                                <h2 class='w-100 mb-2 mt-2 text-center text-danger'>ALL Products</h2>

                                <!-- data list -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th class="text-danger">Product Code</th>
                                                    <th>Title</th>

                                                    <th>Color </th>
                                                    <th>Size</th>
                                                    <th>Price per piece</th>
                                                    <th>Quantity</th>
                                                    <th>State</th>
                                                    <!-- <th>Location ID</th>
                                                    <th>Location Title</th>
                                                    <th>Address</th> -->
                                                </tr>
                                            </thead>


                                            <tbody>
                                                <?php

                                                // Connect database
                                                require "./db_connect.php";


                                                $sl = 0;

                                                // SQL SELECT RECORD  
                                                $sql = "SELECT
                                                `Product`.`P_code`,
                                                `Product`.`P_title`,
                                                `Product_list`.`P_type_ID`,
                                                `Product_type`.`P_type_color`,
                                                `Product_type`.`P_type_size`,
                                                `Product_type`.`P_type_price`,
                                                `Product_list`.`P_state`,
                                                COUNT(*) AS countQ
                                            FROM
                                                `Product`,
                                                `Product_list`,
                                                `Product_type`
                                            WHERE
                                                `Product`.`P_code` = `Product_type`.`P_code` AND `Product_type`.`P_type_ID` = `Product_list`.`P_type_ID` AND `Product_list`.`P_state` = 'inStock'
                                            GROUP BY
                                                `Product_type`.`P_type_ID`;";
                                                // Execute sql
                                                $sql_result = $conn->query($sql);
                                                while ($row = mysqli_fetch_array($sql_result)) {
                                                    $sl++;
                                                ?>
                                                    <tr>
                                                        <td><?php echo $sl; ?></td>
                                                        <th class="text-danger"><?php echo $row['P_code']; ?></th>
                                                        <td><?php echo $row['P_title']; ?></td>

                                                        <td><?php echo $row['P_type_color']; ?></td>
                                                        <td><?php echo $row['P_type_size']; ?></td>
                                                        <td><?php echo "$" . $row['P_type_price']; ?></td>
                                                        <td><?php echo $row['countQ']; ?></td>
                                                        <td><?php echo $row['P_state']; ?></td>
                                                    </tr>
                                                <?php }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>


                            </div>
                            
                            <!--  -->

                        <?php break;

                        case "WH": ?>
                            <!-- ///////////////////////////////////////////////////////////////////////////////////   Warehouse  -->
                            <div>
                                <div>
                                    <?php
                                    require "searchCode.php";
                                    ?>
                                </div>



                                <h2 class='w-100 mb-2 mt-2 text-center text-danger'>Warehouse</h2>
                                <!-- data list -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th class="text-danger">Product Code</th>
                                                    <th>Title</th>

                                                    <th>Color </th>
                                                    <th>Size</th>
                                                    <th>Price per piece</th>
                                                    <th>Quantity</th>
                                                    <th>State</th>
                                                    <!-- <th>Location ID</th>
                                                    <th>Location Title</th>
                                                    <th>Address</th> -->
                                                </tr>
                                            </thead>


                                            <tbody>
                                                <?php

                                                // Connect database
                                                require "./db_connect.php";


                                                $sl = 0;

                                                // SQL SELECT RECORD  
                                                $sql = "SELECT
                                                `Product`.`P_code`,
                                                `Product`.`P_title`,
                                                `Product_list`.`P_type_ID`,
                                                `Product_type`.`P_type_color`,
                                                `Product_type`.`P_type_size`,
                                                `Product_type`.`P_type_price`,
                                                `Product_list`.`P_state`,
                                                COUNT(*) AS countQ
                                            FROM
                                                `Product`,
                                                `Product_list`,
                                                `Product_type`,
                                                `Location`
                                            WHERE
                                                `Product`.`P_code` = `Product_type`.`P_code` AND `Product_type`.`P_type_ID` = `Product_list`.`P_type_ID` AND `Product_list`.`L_ID` = `Location`.`L_ID` AND `Product_list`.`P_state` = 'inStock' AND `Product_list`.`L_ID` = 1
                                            GROUP BY
                                                `Product_type`.`P_type_ID`;";
                                                // Execute sql
                                                $sql_result = $conn->query($sql);
                                                while ($row = mysqli_fetch_array($sql_result)) {
                                                    $sl++;
                                                ?>
                                                    <tr>
                                                        <td><?php echo $sl; ?></td>
                                                        <th class="text-danger"><?php echo $row['P_code']; ?></th>
                                                        <td><?php echo $row['P_title']; ?></td>

                                                        <td><?php echo $row['P_type_color']; ?></td>
                                                        <td><?php echo $row['P_type_size']; ?></td>
                                                        <td><?php echo "$" . $row['P_type_price']; ?></td>
                                                        <td><?php echo $row['countQ']; ?></td>
                                                        <td><?php echo $row['P_state']; ?></td>
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

                                <div>
                                    <?php
                                    require "searchCode.php";
                                    ?>
                                </div>

                                <h2 class='w-100 mb-2 mt-2 text-center text-danger'>Bracnch Store 1</h2>
                                <!-- data list -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th class="text-danger">Product Code</th>
                                                    <th>Title</th>

                                                    <th>Color </th>
                                                    <th>Size</th>
                                                    <th>Price per piece</th>
                                                    <th>Quantity</th>
                                                    <th>State</th>
                                                    <!-- <th>Location ID</th>
                                                    <th>Location Title</th>
                                                    <th>Address</th> -->
                                                </tr>
                                            </thead>


                                            <tbody>
                                                <?php

                                                // Connect database
                                                require "./db_connect.php";


                                                $sl = 0;

                                                // SQL SELECT RECORD  
                                                $sql = "SELECT
                                                `Product`.`P_code`,
                                                `Product`.`P_title`,
                                                `Product_list`.`P_type_ID`,
                                                `Product_type`.`P_type_color`,
                                                `Product_type`.`P_type_size`,
                                                `Product_type`.`P_type_price`,
                                                `Product_list`.`P_state`,
                                                COUNT(*) AS countQ
                                            FROM
                                                `Product`,
                                                `Product_list`,
                                                `Product_type`,
                                                `Location`
                                            WHERE
                                                `Product`.`P_code` = `Product_type`.`P_code` AND `Product_type`.`P_type_ID` = `Product_list`.`P_type_ID` AND `Product_list`.`L_ID` = `Location`.`L_ID` AND `Product_list`.`P_state` = 'inStock' AND `Product_list`.`L_ID` = 2
                                            GROUP BY
                                                `Product_type`.`P_type_ID`;";
                                                // Execute sql
                                                $sql_result = $conn->query($sql);
                                                while ($row = mysqli_fetch_array($sql_result)) {
                                                    $sl++;
                                                ?>
                                                    <tr>
                                                        <td><?php echo $sl; ?></td>
                                                        <th class="text-danger"><?php echo $row['P_code']; ?></th>
                                                        <td><?php echo $row['P_title']; ?></td>

                                                        <td><?php echo $row['P_type_color']; ?></td>
                                                        <td><?php echo $row['P_type_size']; ?></td>
                                                        <td><?php echo "$" . $row['P_type_price']; ?></td>
                                                        <td><?php echo $row['countQ']; ?></td>
                                                        <td><?php echo $row['P_state']; ?></td>
                                                    </tr>
                                                <?php }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>


                        <?php break;




                        case "BS2": ?>
                            <!-- ///////////////////////////////////////////////////////////////////////////////////   Bracnch Store 2  -->
                            <div>

                                <div>
                                    <?php
                                    require "searchCode.php";
                                    ?>
                                </div>

                                <h2 class='w-100 mb-2 mt-2 text-center text-danger'>Bracnch Store 2</h2>
                                <!-- data list -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th class="text-danger">Product Code</th>
                                                    <th>Title</th>

                                                    <th>Color </th>
                                                    <th>Size</th>
                                                    <th>Price per piece</th>
                                                    <th>Quantity</th>
                                                    <th>State</th>
                                                    <!-- <th>Location ID</th>
                                                    <th>Location Title</th>
                                                    <th>Address</th> -->
                                                </tr>
                                            </thead>


                                            <tbody>
                                                <?php

                                                // Connect database
                                                require "./db_connect.php";


                                                $sl = 0;

                                                // SQL SELECT RECORD  
                                                $sql = "SELECT
                                                `Product`.`P_code`,
                                                `Product`.`P_title`,
                                                `Product_list`.`P_type_ID`,
                                                `Product_type`.`P_type_color`,
                                                `Product_type`.`P_type_size`,
                                                `Product_type`.`P_type_price`,
                                                `Product_list`.`P_state`,
                                                COUNT(*) AS countQ
                                            FROM
                                                `Product`,
                                                `Product_list`,
                                                `Product_type`,
                                                `Location`
                                            WHERE
                                                `Product`.`P_code` = `Product_type`.`P_code` AND `Product_type`.`P_type_ID` = `Product_list`.`P_type_ID` AND `Product_list`.`L_ID` = `Location`.`L_ID` AND `Product_list`.`P_state` = 'inStock' AND `Product_list`.`L_ID` = 3
                                            GROUP BY
                                                `Product_type`.`P_type_ID`;";
                                                // Execute sql
                                                $sql_result = $conn->query($sql);
                                                while ($row = mysqli_fetch_array($sql_result)) {
                                                    $sl++;
                                                ?>
                                                    <tr>
                                                        <td><?php echo $sl; ?></td>
                                                        <th class="text-danger"><?php echo $row['P_code']; ?></th>
                                                        <td><?php echo $row['P_title']; ?></td>

                                                        <td><?php echo $row['P_type_color']; ?></td>
                                                        <td><?php echo $row['P_type_size']; ?></td>
                                                        <td><?php echo "$" . $row['P_type_price']; ?></td>
                                                        <td><?php echo $row['countQ']; ?></td>
                                                        <td><?php echo $row['P_state']; ?></td>
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



                        case "scan": ?>
                            <!-- ///////////////////////////////////////////////////////////////////////////////////   SCAN  -->
                            <div>

                                <div>
                                    <?php
                                    require "searchID.php";
                                    ?>
                                </div>

                                <?php
                                // Connect database
                                require "./db_connect.php";

                                // random num
                                $rand = rand(1, 19);

                                $pCode = 0;

                                // SQL SELECT RECORD  
                                $sql = "SELECT
                                *
                            FROM
                                `Product`,
                                `Product_list`,
                                `Product_type`
                            WHERE
                                `Product`.`P_code` = `Product_type`.`P_code` 
                                AND `Product_type`.`P_type_ID` = `Product_list`.`P_type_ID` 
                                AND `Product_list`.`P_state` = 'inStock' 
                                AND `Product_list`.`P_ID`= $rand";
                                $sql_result = $conn->query($sql);
                                while ($row = mysqli_fetch_array($sql_result)) {
                                    echo "<h2 class='w-100 mb-2 mt-2 text-center text-danger'>" . "Product ID#" . $row['P_ID'] . "</h2><h2 class='w-100 mb-2 mt-2 text-center text-muted'>" . $row['P_title'] . "</h2>";
                                    echo "<h2 class='w-100 mb-2 mt-2 text-center text-danger'>" . $row['P_type_color'] . " , " . $row['P_type_size'] . "</h2>";
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
                                                    <th class="text-danger">Product ID</th>
                                                    <th>Title </th>
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
                                                `Product`,
                                                `Product_list`,
                                                `Product_type`,
                                                `Location`
                                            WHERE
                                                `Product`.`P_code` = `Product_type`.`P_code` AND `Product_type`.`P_type_ID` = `Product_list`.`P_type_ID` AND `Product_list`.`L_ID` = `Location`.`L_ID` AND `Product_list`.`P_state` = 'inStock' AND `Product`.`P_code` = $pCode ORDER by `Product_list`.`P_ID`";
                                                // Execute sql
                                                $sql_result = $conn->query($sql);
                                                while ($row = mysqli_fetch_array($sql_result)) {
                                                    $sl++;
                                                ?>
                                                    <tr>
                                                        <td><?php echo $sl; ?></td>
                                                        <th class="text-danger"><?php echo $row['P_ID']; ?></th>
                                                        <td><?php echo $row['P_title']; ?></td>
                                                        <td><?php echo $row['P_type_color']; ?></td>
                                                        <td><?php echo $row['P_type_size']; ?></td>
                                                        <td><?php echo "$" . $row['P_type_price']; ?></td>
                                                        <td><?php echo $row['P_state']; ?></td>
                                                        <tH class="text-danger"><?php echo $row['L_ID']; ?></th>
                                                        <td><?php echo $row['L_name']; ?></td>
                                                        <td><?php echo $row['L_address']; ?></td>
                                                        <?php
                                                        ?>
                                                    </tr>
                                                <?php }
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

                        <?PHP break;
                        case "request": ?>
                            <div>


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
                                    $sql = "UPDATE`Product_list` SET `Product_list`.`L_ID` = $d 
              WHERE `Product_list`.`P_ID` = $pid";
                                    $sql_result = $conn->query($sql);

                                    $nameS = '';
                                    $nameD = '';

                                    // SQL SELECT RECORD  
                                    $sql = "SELECT * FROM `Location` WHERE  L_ID = $s ";
                                    $sql_result = $conn->query($sql);
                                    while ($row = mysqli_fetch_array($sql_result)) {
                                        // echo "<h2 class='w-100 mb-2 mt-2 text-center text-danger'>" . $row['RE_name'] . "</h2>";
                                        // echo "<h2 class='w-100 mb-2 mt-2 text-center text-danger'>" . "to   " . "</h2>";
                                        $nameS = $row['L_name'];
                                    }



                                    // SQL SELECT RECORD  
                                    $sql = "SELECT * FROM `Location` WHERE L_ID = $d  ";
                                    $sql_result = $conn->query($sql);
                                    while ($row = mysqli_fetch_array($sql_result)) {
                                        // echo "<h2 class='w-100 mb-5  mt-2 text-center text-danger'>" . $row['RE_name'] . "</h2>";
                                        $nameD = $row['L_name'];
                                    }

                                    echo "<h2 class='w-100 mb-2 mt-2 text-center text-primary'>" . "REQUSEST SUCCEEDED" .  "</h2>";
                                    echo "<h2 class='w-100 mb-2 mt-2 text-center text-primary'>" . $s  . "#" . $nameS . " ---> " . $d . "#" . $nameD . "</h2>";




                                    $pCode = 0;

                                    // SQL SELECT RECORD  
                                    $sql = "SELECT
                                    *
                                FROM
                                    `Product`,
                                    `Product_list`,
                                    `Product_type`,
                                    `Location`
                                WHERE
                                    `Product`.`P_code` = `Product_type`.`P_code` AND `Product_type`.`P_type_ID` = `Product_list`.`P_type_ID` AND `Product_list`.`L_ID` = `Location`.`L_ID` AND `Product_list`.`P_state` = 'inStock' AND `Product_list`.`P_ID` = $pid;";
                                    $sql_result = $conn->query($sql);
                                    while ($row = mysqli_fetch_array($sql_result)) {
                                        echo "<h2 class='w-100 mb-2 mt-2 text-center text-danger'>" . "Product ID#" . $row['P_ID'] . "</h2><h2 class='w-100 mb-2 mt-2 text-center text-muted'>" . $row['P_title'] . "</h2>";
                                        echo "<h2 class='w-100 mb-2 mt-2 text-center text-danger'>" . $row['P_type_color'] . " , " . $row['P_type_size'] . "</h2>";

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
                                                        <th class="text-danger">Product ID</th>
                                                        <th>Title </th>
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
                                                `Product`,
                                                `Product_list`,
                                                `Product_type`,
                                                `Location`
                                            WHERE
                                                `Product`.`P_code` = `Product_type`.`P_code` AND `Product_type`.`P_type_ID` = `Product_list`.`P_type_ID` AND `Product_list`.`L_ID` = `Location`.`L_ID` AND `Product_list`.`P_state` = 'inStock' AND `Product`.`P_code` = $pCode ORDER by `Product_list`.`P_ID`";
                                                    // Execute sql
                                                    $sql_result = $conn->query($sql);
                                                    while ($row = mysqli_fetch_array($sql_result)) {
                                                        $sl++;
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $sl; ?></td>
                                                            <th class="text-danger"><?php echo $row['P_ID']; ?></th>
                                                            <td><?php echo $row['P_title']; ?></td>
                                                            <td><?php echo $row['P_type_color']; ?></td>
                                                            <td><?php echo $row['P_type_size']; ?></td>
                                                            <td><?php echo "$" . $row['P_type_price']; ?></td>
                                                            <td><?php echo $row['P_state']; ?></td>
                                                            <tH class="text-danger"><?php echo $row['L_ID']; ?></th>
                                                            <td><?php echo $row['L_name']; ?></td>
                                                            <td><?php echo $row['L_address']; ?></td>
                                                            <?php
                                                            ?>
                                                        </tr>
                                                    <?php }
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


                        <?php  }
                        ?>
                    <?php break;
                        case "spid": ?>
                        <!-- ///////////////////////////////////////////////////////////////////////////////////   SCAN  -->
                        <div>

                            <div>
                                <?php
                                require "searchID.php";
                                ?>
                            </div>


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
                                $sql = "SELECT
                                                                    *
                                                                FROM
                                                                    `Product`,
                                                                    `Product_list`,
                                                                    `Product_type`,
                                                                    `Location`
                                                                WHERE
                                                                    `Product`.`P_code` = `Product_type`.`P_code` AND `Product_type`.`P_type_ID` = `Product_list`.`P_type_ID` AND `Product_list`.`L_ID` = `Location`.`L_ID` AND `Product_list`.`P_state` = 'inStock' AND `Product_list`.`P_ID` = $spid;";
                                $sql_result = $conn->query($sql);
                                while ($row = mysqli_fetch_array($sql_result)) {
                                    echo "<h2 class='w-100 mb-2 mt-2 text-center text-danger'>" . "Product ID#" . $row['P_ID'] . "</h2><h2 class='w-100 mb-2 mt-2 text-center text-muted'>" . $row['P_title'] . "</h2>";
                                    echo "<h2 class='w-100 mb-2 mt-2 text-center text-danger'>" . $row['P_type_color'] . " , " . $row['P_type_size'] . "</h2>";

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
                                                    <th class="text-danger">Product ID</th>
                                                    <th>Title </th>
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


                                                // print_r("P_ID" . $pCode);
                                                $sl = 0;

                                                // SQL SELECT RECORD  
                                                $sql = "SELECT
                                                *
                                            FROM
                                                `Product`,
                                                `Product_list`,
                                                `Product_type`,
                                                `Location`
                                            WHERE
                                                `Product`.`P_code` = `Product_type`.`P_code` AND `Product_type`.`P_type_ID` = `Product_list`.`P_type_ID` AND `Product_list`.`L_ID` = `Location`.`L_ID` AND `Product_list`.`P_state` = 'inStock' AND `Product`.`P_code` = $pCode ORDER by `Product_list`.`P_ID`";
                                                // Execute sql
                                                $sql_result = $conn->query($sql);
                                                while ($row = mysqli_fetch_array($sql_result)) {
                                                    $sl++;
                                                ?>
                                                    <tr>
                                                        <td><?php echo $sl; ?></td>
                                                        <th class="text-danger"><?php echo $row['P_ID']; ?></th>
                                                        <td><?php echo $row['P_title']; ?></td>
                                                        <td><?php echo $row['P_type_color']; ?></td>
                                                        <td><?php echo $row['P_type_size']; ?></td>
                                                        <td><?php echo "$" . $row['P_type_price']; ?></td>
                                                        <td><?php echo $row['P_state']; ?></td>
                                                        <tH class="text-danger"><?php echo $row['L_ID']; ?></th>
                                                        <td><?php echo $row['L_name']; ?></td>
                                                        <td><?php echo $row['L_address']; ?></td>
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
                        case "spk": ?>
                        <!-- ///////////////////////////////////////////////////////////////////////////////////   SCAN  -->
                        <div>

                            <div>
                                <?php
                                require "searchID.php";
                                ?>
                            </div>


                            <?php

                            // Connect database
                            require "./db_connect.php";


                            $spk = $_GET['spk'];

                            $pCode = 0;

                            if (empty($spk)) {
                                echo "<script>";
                                echo "window.location.href='index.php;";
                                echo "</script>";
                            } else {

                                // SQL SELECT RECORD  
                                $sql = "SELECT
                                *
                            FROM
                                `Product`,
                                `Product_list`,
                                `Product_type`,
                                `Location`
                            WHERE
                                `Product`.`P_code` = `Product_type`.`P_code` AND `Product_type`.`P_type_ID` = `Product_list`.`P_type_ID` AND `Product_list`.`L_ID` = `Location`.`L_ID` AND `Product_list`.`P_state` = 'inStock' AND `Product`.`P_code` = $spk ORDER by `Product_list`.`P_ID`";
                                $sql_result = $conn->query($sql);
                                while ($row = mysqli_fetch_array($sql_result)) {
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
                                                    <th class="text-danger">Product ID</th>
                                                    <th>Title </th>
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


                                                // print_r("P_ID" . $pCode);
                                                $sl = 0;

                                                // SQL SELECT RECORD  
                                                $sql = "SELECT
                                                *
                                            FROM
                                                `Product`,
                                                `Product_list`,
                                                `Product_type`,
                                                `Location`
                                            WHERE
                                                `Product`.`P_code` = `Product_type`.`P_code` AND `Product_type`.`P_type_ID` = `Product_list`.`P_type_ID` AND `Product_list`.`L_ID` = `Location`.`L_ID` AND `Product_list`.`P_state` = 'inStock' AND `Product`.`P_code` = $pCode ORDER by `Product_list`.`P_ID`";
                                                // Execute sql
                                                $sql_result = $conn->query($sql);
                                                while ($row = mysqli_fetch_array($sql_result)) {
                                                    $sl++;
                                                ?>
                                                    <tr>
                                                        <td><?php echo $sl; ?></td>
                                                        <th class="text-danger"><?php echo $row['P_ID']; ?></th>
                                                        <td><?php echo $row['P_title']; ?></td>
                                                        <td><?php echo $row['P_type_color']; ?></td>
                                                        <td><?php echo $row['P_type_size']; ?></td>
                                                        <td><?php echo "$" . $row['P_type_price']; ?></td>
                                                        <td><?php echo $row['P_state']; ?></td>
                                                        <tH class="text-danger"><?php echo $row['L_ID']; ?></th>
                                                        <td><?php echo $row['L_name']; ?></td>
                                                        <td><?php echo $row['L_address']; ?></td>
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