<!DOCTYPE html>
<!--Authors: Ruth Chen-423268 and Chiraag Kapadia-430947-->
<html>
    <head>
        <title>Logging out</title>
        
        <link rel="stylesheet" type="text/css" href="logout.css">
    </head>
    <body>
        <?php
            // Initialize the session for imminent destruction.
            session_start();
            
            // Unset all of the session variables.
            $_SESSION = array();
            
            // If it's desired to kill the session, also delete the session cookies.
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                );
            }

            // Finally, destroy the session.
            session_destroy();
        ?>
        <div>
            <h1>You've been logged out!</h1>
            <form action="login.php" method="POST">
               <!-- make a link to login page. -->
                <input type="submit" value="Log back in">
            </form>
        </div>
    </body>
</html>