<html>
    <head>
        <title>CPSC 304 PHP/Patient Login</title>
    </head>

    <style>
    h2 {text-align: center;}
    form {text-align: center;}
    </style>
    <body>
    <br />
    <br />
        <h2>Log in</h2>

        <hr />
        <br />
        <br />
        <br />
        <br />

        <!-- Login block -->
        <form method="POST" action="PatientLogin.php"> <!--refresh page when submitted-->
            <input type="hidden" id="loginRequest" name="loginRequest">
            
            Username: <input type="text" name="username"> <br /><br />
            Password: <input type="text" name="password"> <br /><br />

            <input type="submit" value="login" name="login"></p>
        </form>

        <br />

        <!-- SignUp block TODO-->
        <form method="POST" action="signup.php"> <!--refresh page when submitted-->
            <input type="hidden"  id="signupRequest" name="signupRequest">
            <h3>Create Account</h3>
            <input type="submit" value="register" name="register"></p>
        </form>
        <br />

        <?php
        include 'oracle_connection.php';
        
        function handleloginRequest() {
            global $db_conn;
            $username =  $_POST['username'];
            $password = $_POST['password'];
            $result = executePlainSQL("SELECT ppassword FROM PatientAccount
                                                where Username = '$username'");
            $correctpassword = OCI_Fetch_Array($result, OCI_BOTH);
            if($correctpassword[0] == NULL) {
                echo "Username cannot be found";
            } else if ($password == $correctpassword[0]) {
                echo "correct";
            } else {
                echo "incorrect password";
            }
            OCICommit($db_conn);
        }

    
        // HANDLE ALL POST ROUTES
	    function handlePostRequest() {
            if (connectToDB()) {
                if (array_key_exists('loginRequest', $_POST)) {
                    handleloginRequest();

                disconnectFromDB();
            }
            }
        }

        if (isset($_POST['login'])) {
            handlePostRequest();
        }
		?>
	</body>
</html>
