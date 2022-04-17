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


            <div class="temp-content"></div>


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