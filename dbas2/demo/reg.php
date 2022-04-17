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

    <link href="css/style.css" rel="stylesheet">
    <link href="css/header.css" rel="stylesheet">
    <link href="css/footer.css" rel="stylesheet">
    <link href="css/temp-content.css" rel="stylesheet">


</head>

<body>

    <!-- header -->
    <div>
        <?php
        require "header.php";
        ?>
    </div>
    <!-- header -->

    <div class="top-bg-content"></div>


    <!-- container -->
    <div class="container-fluid">


        <!-- row -->
        <div class="row">

            <!-- registration form -->
            <div>
                <form>
                    <div class="form-floating mt-3 mb-3">
                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="u">
                        <label for="floatingInput">Email address</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="p1">
                        <label for="floatingPassword">Password</label>
                    </div>
                    <div class="form-floating mt-3">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Re-type Password" name="p2">
                        <label for="floatingPassword">Re-type Password</label>
                    </div>

                    <!-- Radio -->
                    <div class="mt-3">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="g" id="inlineRadio1" value="male">
                            <label class="form-check-label" for="inlineRadio1">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="g" id="inlineRadio2" value="female">
                            <label class="form-check-label" for="inlineRadio2">Female</label>
                        </div>
                    </div>
                    <!-- Radios -->

                    <!-- Select -->
                    <div class="mt-3">
                        <select class="form-select" aria-label="Default select example" name=c>
                            <option selected>Location</option>
                            <option value="hk">H.K.</option>
                            <option value="kln">Kowloon</option>
                            <option value="nt">New Territories</option>
                        </select>
                    </div>
                    <!-- Select -->

                    <!-- File input -->
                    <div class="mt-3">
                        <label for="formFile" class="form-label">Passport Photo</label>
                        <input class="form-control" type="file" id="formFile" name="photo">
                    </div>
                    <!-- File input -->

                    <!-- Calendar -->
                    <div class="mt-3">
                        <label for="formFile" class="form-label">DoB:</label>
                        <input type="date" name="d">
                    </div>
                    <!-- Calendar -->

                    <button type="submit" class="btn btn-primary mt-3 mb-3">Submit</button>

                </form>
            </div>
            <!-- registration form -->

        </div>
        <!-- row -->


    </div>
    <!-- container -->

    <!-- footer -->
    <div>
        <?php
        require "footer.php";
        ?>
    </div>
    <!-- footer -->


</body>

</html>