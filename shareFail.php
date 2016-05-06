<!DOCTYPE html>
    <!--Authors: Ruth Chen-423268 and Chiraag Kapadia-430947-->
<html>
    <head>
        <title>Filesharing error</title>
        <link rel="stylesheet" type="text/css" href="shareFail.css">
    </head>
    <body>
        <div>
            <br>
            <?php
                //simple error page with a redirect button.
                echo "This username does not exist! File sharing failed. Please try again with a valid username.";
            ?>
            <br>
            <form action="filesharing.php">
                <input type="submit" value="Go back"/>
            </form>
        </div>
    </body>
</html>
