<!DOCTYPE html>
<!--Authors: Ruth Chen-423268 and Chiraag Kapadia-430947-->
<html>
    <head>
        <title>Create new account</title>
        <link rel="stylesheet" type="text/css" href="newaccount.css">
    </head>
    <body>
        <?php
            session_start();
            $newusername = $_SESSION['username'];
                    
            $yesorno = $_POST['newaccount'];//do they want a new account?
            
            if($yesorno=="Yes") {//if yes
                if ( preg_match('/\s/',$newusername) ){//filter input
                    ?>
                    <div id="error">
                        <br>
                        <?php
                            echo "Your username cannot contain any spaces. Please try again.";
                        ?>
                        <form action="login.php">
                        <input type="submit" value="Go back"/>
                        </form>
                    </div>
                    <?php
                }
                else {
                    //add it to the file
                    $userfile=fopen("/srv/uploads/users.txt", "a+");
                    fwrite($userfile, "\n".$newusername);
                    ?>
                    <div id="yesplease">
                        <br>
                        <?php
                            echo "Great! An account has been created for you. Your username is <strong><u>$newusername</u></strong>. Please go back to the login page and enter your username.";
                        ?>
                        <form action="login.php">
                        <input type="submit" value="Log me in!"/>
                        </form>
                    </div>
                    <?php
                }
            }
            else {
                ?>
                <div id="denied">
                    <br>
                    <?php //display message and button back to login page.
                        echo "Unfortunately, you need an account to use our filesharing site. We apologize for the inconvenience!";
                    ?>
                    <form action="login.php">
                    <input type="submit" value="Go back"/>
                    </form>
                </div>
                    <?php
            }
        ?>
    </body>
</html>