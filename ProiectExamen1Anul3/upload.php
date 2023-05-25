<!DOCTYPE>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Upload Page </title>
        <link rel="stylesheet" type="text/css" href="./css/upload_styling.css">
    </head>
    <body>
        <div class="main-container">

            <div class="nav-container">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="for_visitors.php">Collection</a></li>
                    <li><a href="upload.php">Upload</a><li>
                        |
                    <li><a href="login.php">Login</a><li>
                </ul>
            </div>

            <h1>Incarca o imagine</h1>


            <div class="center-stuff-upload">

                <div id="content">


                    <!-- POST  transfera datele de aici sub numele size, image, text, upload-->    

                    <form method="post" action="save.php" enctype="multipart/form-data">

                        <br><br>

                        <input type="text" name="size" placeholder="Introdu marimea hainei">

                        <br><br>

                        <input type="file" name="image">

                        <br><br>

                        <textarea name="text" cols="40" rows="4" placeholder="Da un nume articolului tau"></textarea>

                        <br><br>

                        <input type="submit" name="upload" value="Upload Image">

                    </form>

                </div>
            </div>
        </div>
    </body>
</html>