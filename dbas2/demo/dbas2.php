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
    <link href="css/temp-content.css" rel="stylesheet">

</head>

<body>

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

                echo "<form action=\"dbas2.php?\" method=\"GET\">";

                echo "<button class='w-100 mb-2 mt-2 btn btn-lg rounded-4 btn-dark nav-color' type='submit' name='action' value='all'>All Products</button>";

                echo "<form>";


                echo "<form action=\"dbas2.php\" method=\"GET\">";

                echo "<button class='w-100 mb-2 mt-2 btn btn-lg rounded-4 btn-dark nav-color' type='submit' name='action' value='scan' >Scan</button>";

                echo "<form>";


                ?>


                <?php

                if (!empty($_GET["action"])) {
                    switch ($_GET["action"]) {
                        case "all": ?>
                            <!-- ///////////////////////////////////////////////////////////////////////////////////   ALL  -->
                            <div>
                                <!-- data list -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Product code</th>
                                                    <th>Title</th>
                                                    <th>Color </th>
                                                    <th>Size</th>
                                                    <th>Price per piece</th>
                                                </tr>
                                            </thead>


                                            <tbody>
                                                <?php

                                                // Connect database
                                                require "./db_connect.php";


                                                $sl = 0;

                                                // SQL SELECT RECORD  
                                                $sql = "select * from Product";
                                                // Execute sql
                                                $sql_result = $conn->query($sql);
                                                while ($row = mysqli_fetch_array($sql_result)) {
                                                    $sl++;
                                                ?>
                                                    <tr>
                                                        <td><?php echo $sl; ?></td>
                                                        <td><?php echo $row['P_code'] . $row['P_ID']; ?></td>
                                                        <td><?php echo $row['P_title']; ?></td>
                                                        <td><?php echo $row['P_color']; ?></td>
                                                        <td><?php echo $row['P_size']; ?></td>
                                                        <td><?php echo "$" . $row['P_price']; ?></td>
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

                                <!-- SLECT the product title -->
                                <?php
                                // Connect database
                                require "./db_connect.php";

                                // random num
                                $rand = rand(1, 5);

                                // SQL SELECT RECORD  
                                $sql = "select * from Product where P_id = $rand";
                                $sql_result = $conn->query($sql);
                                while ($row = mysqli_fetch_array($sql_result)) {
                                    echo "<h2 class='w-100 mb-2 mt-2 text-center text-danger'>" . $row['P_title'] . "</h2>";
                                }

                                print_r("P_ID" . $rand);
                                ?>


                                <!-- data list -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Product code</th>
                                                    <th>Color </th>
                                                    <th>Size</th>
                                                    <th>Branch & Warehouse</th>
                                                    <th>Price per piece</th>
                                                    <th>Address</th>
                                                </tr>
                                            </thead>


                                            <tbody>
                                                <?php

                                                // Connect database
                                                require "./db_connect.php";


                                                $sl = 0;

                                                // SQL SELECT RECORD  
                                                $sql = "SELECT * FROM `Product_list`, `Real_estate`, `Product` WHERE ( `Product_list`.`RE_ID` = `Real_estate`.`RE_ID`) AND (`Product`.`P_id` = `Product_list`.`P_ID`) AND (`Product`.`P_ID` = $rand);";
                                                // Execute sql
                                                $sql_result = $conn->query($sql);
                                                while ($row = mysqli_fetch_array($sql_result)) {
                                                    $sl++;
                                                ?>
                                                    <tr>
                                                        <td><?php echo $sl; ?></td>
                                                        <td><?php echo $row['ID'] . $row['P_code'] . $row['P_ID']; ?></td>
                                                        <td><?php echo $row['P_color']; ?></td>
                                                        <td><?php echo $row['P_size']; ?></td>
                                                        <td><?php echo $row['RE_name']; ?></td>
                                                        <td><?php echo $row['P_price']; ?></td>
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

                <?PHP }
                } else {
                    echo 123;
                }
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