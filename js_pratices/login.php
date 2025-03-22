<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
    <?php
    session_start();
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        // Default credentials
        $default_username = "meain";
        $default_password = "1234";
        
        if ($username === $default_username && $password === $default_password) {
            $_SESSION['username'] = $username;
            echo "<script>
                alert('Login Successful!');
                window.location.href = 'welcome.php';
            </script>";
        } else {
            echo "<script>alert('Invalid username or password!');</script>";
        }
    }
    ?>

    <div>
        <h2>Login</h2>
        <form id="loginForm" method="POST" onsubmit="return validateForm()">
            <div>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username">
                <div id="usernameError"></div>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password">
                <div id="passwordError"></div>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>

    <script>
        function validateForm() {
            let isValid = true;
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            
            // Reset error messages
            document.getElementById('usernameError').innerHTML = '';
            document.getElementById('passwordError').innerHTML = '';
            
            // Username validation
            if (username.trim() === '') {
                document.getElementById('usernameError').innerHTML = 'Username is required';
                isValid = false;
            }
            
            // Password validation
            if (password.trim() === '') {
                document.getElementById('passwordError').innerHTML = 'Password is required';
                isValid = false;
            }
            
            return isValid;
        }
    </script>
</body>
</html>
