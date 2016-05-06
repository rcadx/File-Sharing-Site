<!DOCTYPE html>
<!--Authors: Ruth Chen-423268 and Chiraag Kapadia-430947-->
<html>
    <head>
        <title>Filesharing success</title>
        <link rel="stylesheet" type="text/css" href="shareSuccess.css">
    </head>
    <body>
        <div>
            <br>
            <?php
                //simple success page with a redirect.
                echo "Your file has been successfully shared!";
            ?>
            <br>
            <form action="filesharing.php">
                <input type="submit" value="Go back"/>
            </form>
        </div>
    </body>
</html>
