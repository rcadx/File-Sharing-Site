<!DOCTYPE html>
<!--Authors: Ruth Chen-423268 and Chiraag Kapadia-430947-->
<html>
    <head>
        <title>Upload a file</title>
        <link rel="stylesheet" type="text/css" href="filesharing.css">
    </head>
    <body>
        <?php     
            session_start();
            //security check.
            if(!isset($_SESSION['logged_in'])) {
                header("Location: login.php");  
            }
            
            $username = $_SESSION['username'];
        ?>
        <h1>Welcome, <?php echo $username; ?>!</h1>
        <div id="upload">
            <form enctype="multipart/form-data" method="POST">
                <p>
                        <input type="hidden" name="MAX_FILE_SIZE" value="20000000" />
                        <label for="uploadfile_input">Choose a file to upload:</label> <input name="uploadedfile" type="file" id="uploadfile_input" />
                </p>
                <p>
                        <input type="submit" name="upload" value="Upload File" id="uploadfilebutton"/>
                </p>
            </form>
        </div>
        <div id="filesuploaded">
            <h1>Uploaded Files</h1>
            <?php
                
                if(isset($_POST['upload'])){
                    //get the filename and make sure it is valid
                    $filename = basename($_FILES['uploadedfile']['name']);
                    
                    //removing spaces from uploaded file's name
                    $replace="_";
                    $pattern="/[^a-zA-Z0-9\.]/";
                    $filename=preg_replace($pattern,$replace,$filename);                      
                    $filename=str_replace($replace,'',$filename);
                    if(!preg_match('/^[\w_\.\-]+$/', $filename) ){
                        echo "Invalid filename";
                        exit;
                    }
                    
                    // Get the username and make sure it is valid
                    $username = $_SESSION['username'];
                    if(!preg_match('/^[\w_\-]+$/', $username) ){
                        echo "Invalid username";
                        exit;
                    }
                    
                    $full_path = sprintf("/srv/uploads/%s/%s", $username, $filename);
                    
                    //upload files,
                    if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $full_path) ){
                         echo "File upload success!";
                         header("Location: filesharing.php");
                         exit;
                    }
                    else{
                         echo "File upload failure! :(";
                         exit;
                    }
                }
                //make a directory, if need be. if it is a new user.
                $pathToUserDir = "/srv/uploads/" . $username;
                if (!is_dir($pathToUserDir)){
                    mkdir($pathToUserDir, 0777, true);
                }
                
               //check what files are present..
                $filesInDir = scandir($pathToUserDir);
                //Every directory has a reference to . and .., thus any additional files
                //are what should be displayed.
                if(count($filesInDir)<=2){
                    //if true, no files in directory. If false, files in directory.
                    echo("<br><br><br><br><br><br><br><br>You have no files uploaded :(");
                }
                else{
                    
                    for ($i=2; $i< count($filesInDir); ++$i) {
                        //make a view, delete, and share field for all files.
                        echo("<div id=\"individualfile\">");
                        $pathToFile = "$pathToUserDir"."/"."$filesInDir[$i]";
                        printf("%s",$filesInDir[$i]);
                        ?>
                        <form action="viewdelete.php" method="POST">
                            <input type="hidden" name="file" value="<?php echo $pathToFile;?>"/>
                            <input type="submit" name="viewdelete" value="View"/>
                            <input type="submit" name="viewdelete" value="Delete"/>
                            
                            <label for="shareUserInput">Please enter a user to share this file with:</label>
                            <input type="text" name="shareName" id="shareUserInput"/>
                            <input type="submit" value="Share"/>
                        </form>
                        <br>
                        <?php echo("</div><br>");
                    }
                }
            ?>
        </div>
            <!--logout button.-->
        <form action="logout.php" method="POST">
            <input type="submit" value="Log out" id="logout"/>
        </form>
    </body>
</html>