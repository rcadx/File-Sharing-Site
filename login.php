<!DOCTYPE html>
<!--Authors: Ruth Chen-423268 and Chiraag Kapadia-430947-->
<html>
    <head>
        <title>File Sharing by Ruth and Chiraag</title>
        <link rel="stylesheet" type="text/css" href="login.css">
    </head>
    <body>
        <div>
            <div id="welcome">
                <h1>Welcome to Ruth and Chiraag's File Sharing Site!</h1>
                <form method="POST">
                    <p>
                        <label for="usernameinput">Please enter your username:</label>
                        <input type="text" name="username" id="usernameinput"/>
                    </p>
                    <p>
                        <input type="submit" value="Log in"/>
                        <input type="reset"/>
                    </p>
                </form>
            </div>
            <?php
                if(isset($_POST['username'])){//if a username had been entered.
                    session_start();//to utilize session variables.
                    
                   $username = $_POST['username'];
                    if( !preg_match('/^[\w_\-]+$/', $username) ){//filter input.
                        ?>
                        <div id="invalidusername">
                        <br>
                        <?php
                            echo "Invalid username. Usernames cannot have spaces.";
                        ?>
                        </div>
                        <?php
                        exit;//exit the script.
                    }
                    $_SESSION['username'] = $username;//username is safe to use from now on.
                    
                    $userfound = false;//priming.
                    $h = fopen("/srv/uploads/users.txt", "r");
                    //read line by line.
                    $linenum = 1;
                    while(!feof($h)){
                        $trim = trim(fgets($h));
                        if($trim == $username) {
                            $userfound=true;
                        }
                        else {
                            $linenum++;          
                        }       
                    }
                    
                    fclose($h);
                    
                    if ($userfound) {
                        $_SESSION['logged_in'] = "yes";//security session.
                        header("Location: filesharing.php"); //redirect to the files.
                        exit;
                    }
                    else {
                        //ask to create a new account
                        ?>
                        <div id="error">
                            <br>
                            <?php echo "Username does not exist. Would you like to create a new account under the name <strong>$username</strong>?";
                            ?>
                            <form action="newaccount.php" method="POST">
                                <input type="submit" name="newaccount" value="Yes"/>
                                <input type="submit" name="newaccount" value="No"/>
                            </form>
                        </div>
                        <?php
                        //then redirect.
                    }
                }
            ?>
        </div>
    </body>
</html>