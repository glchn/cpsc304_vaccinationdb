<html>
    <head>
        <title>CPSC 304 PHP/Nurse Login</title>
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
        <form method="POST" action="NurseLogin.php"> <!--refresh page when submitted-->
            <input type="hidden" id="loginRequest" name="loginRequest">
            
            Nurse ID: <input type="text" name="Nurse_ID"> <br /><br />
            Password: <input type="text" name="password"> <br /><br />

            <input type="submit" value="login" name="login"></p>
        </form>

        <br />

<!--    SignUp block TODO
        <form method="POST" action="signup.php"> refresh page when submitted
            <input type="hidden"  id="signupRequest" name="signupRequest">
            <h3>Create Account</h3>
            <input type="submit" value="register" name="register"></p>
        </form>
        <br /> -->

        <?php
        include 'oracle_connection.php';
        
        function handleloginRequest() {
            global $db_conn;
            $Nurse_ID =  $_POST['Nurse_ID'];
            $password = $_POST['password'];
            $result = executePlainSQL("SELECT nPassword FROM Nurse
                                                where ID = '$Nurse_ID'");
            $correctpassword = OCI_Fetch_Array($result, OCI_BOTH);
            if($correctpassword[0] == NULL) {
                echo "Nurse ID cannot be found";
            } else if ($password == $correctpassword[0]) {
                echo "Correct";
            } else {
                echo "Incorrect password";
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
