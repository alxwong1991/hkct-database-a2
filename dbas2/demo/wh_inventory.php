<?php
// Warehouse invrntory          
echo "<button class='w-100 mb-2 mt-2 btn btn-lg rounded-4 btn-success nav-color' type='submit' name='action' value='IWH'>Inventory Warehouse</button>";


// Connect database
require "./db_connect.php";

$spid = $_GET['spid'];

$pCode = 0;

// SQL SELECT RECORD  
$sql = "select * from 
`Product`,
`Product_list`
where `Product`.`P_code` = `Product_list`.`P_code` AND`Product_list`.`P_ID` =  $spid";
$sql_result = $conn->query($sql);
while ($row = mysqli_fetch_array($sql_result)) {
    echo "<h2 class='w-100 mb-2 mt-2 text-center text-danger'>" . "Product ID#" . $row['P_ID'] . "</h2><h2 class='w-100 mb-2 mt-2 text-center text-muted'>" . $row['P_title'] . "</h2>";
    echo "<h2 class='w-100 mb-2 mt-2 text-center text-danger'>" . $row['P_color'] . " @ " . $row['P_size'] . "</h2>";
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
                ?>
            </tbody>
        </table>

        <form action="dbas2.php" method="GET">
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