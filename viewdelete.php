<!DOCTYPE html>
<!--Authors: Ruth Chen-423268 and Chiraag Kapadia-430947-->
<html>
    <head>
        <title>View or delete your files</title>
    </head>
    <body>
        <?php
            session_start();
            if(!isset($_SESSION['logged_in'])) {//security checking. if not logged in, redirect to login.
                header("Location: login.php");  
            }
            //needed variables.
            $username = $_SESSION['username'];
            $viewdelete = $_POST['viewdelete'];
            $filename = $_POST['file'];
            if($viewdelete=="View"){//redirect for file viewing.
                $_SESSION['filenamePath'] = $filename;
                header("Location: view.php");
            }
            elseif($viewdelete=="Delete") {
                unlink("$filename");//delete the file from server.
                header("Location: filesharing.php");
                exit;
            }
            else{
                //share was chosen.
                $shareName = $_POST['shareName'];//get the name to share with.
                if( !preg_match('/^[\w_\-]+$/', $shareName) ){//filter input
                    echo "Invalid username";
                    header("Location: filesharing.php");
                    exit;
                }
                
                //check if given name is a user.
                $userfound = false;
                
                $h = fopen("/srv/uploads/users.txt", "r");
                
                $linenum = 1;
                while(!feof($h)){
                    $trim = trim(fgets($h));
                    if($trim == $shareName) {
                        $userfound=true;
                    }
                    else {
                        $linenum++;
                    }       
                }
                
                fclose($h);
                
                //if the name given is a user,
                if ($userfound) {
                    //copy the file
                    fopen("/srv/uploads/".$shareName."/".basename($filename),"w");//make an empty file with the same name.
                    copy($filename, "/srv/uploads/"."$shareName"."/".basename($filename));//write the same data to the file.
                    header("Location: shareSuccess.php");//redirect.
                    exit;
                }
                else {
                    header("Location: shareFail.php");//show error page.
                    exit;
                }
                
            }
        ?>
    </body>
</html>