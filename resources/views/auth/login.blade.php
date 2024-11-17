<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasol Online Booking Login</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #ffffff 50%, #1e49a1 50%);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            display: flex;
            width: 850px;
            height: 500px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .left-section {
            flex: 1;
            background-color: #1e49a1;
            color: #fff;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
        }

        .left-section::after {
            content: '';
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            width: 80%;
            height: 10px;
            background-color: rgba(255, 255, 255, 0.3);
            border-radius: 5px;
        }

        .left-section h1 {
            font-size: 40px;
            font-weight: bold;
            margin-bottom: 20px;
            z-index: 1;
        }

        .left-section p {
            font-size: 16px;
            margin-bottom: 30px;
            z-index: 1;
        }

        .left-section img {
            width: 120px;
            margin-bottom: 20px;
            border: 5px solid #fff;
            border-radius: 50%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .right-section {
            flex: 1.2;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .right-section h2 {
            color: #1e49a1;
            font-size: 30px;
            font-weight: bold;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-size: 14px;
            color: #333;
            margin-bottom: 5px;
            display: block;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: #1e49a1;
            box-shadow: 0 0 8px rgba(30, 73, 161, 0.4);
        }

        .password-wrapper {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            top: 67%;
            right: 10px;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
            color: #1e49a1;
        }

        .toggle-password:hover {
            text-decoration: underline;
        }

        .login-button {
            background-color: #1e49a1;
            color: #fff;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 15px;
            transition: background-color 0.3s ease;
        }

        .login-button:hover {
            background-color: #163d82;
        }

        .extra-links {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            font-size: 14px;
        }

        .extra-links a {
            color: #1e49a1;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .extra-links a:hover {
            text-decoration: underline;
            color: #163d82;
        }

    </style>
</head>
<body>
    <div class="login-container">
        <div class="left-section">
            <img src="images/dasollogo.png" alt="Dasol Online Booking Logo">
            <h1>Welcome</h1>
            <p>Your gateway to the best booking experience with Dasol Online Booking.</p>
        </div>
        <div class="right-section">
            <h2>Login</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" required autofocus>
                </div>
                <div class="form-group password-wrapper">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" required>
                    <button type="button" class="toggle-password" onclick="togglePassword()">Show</button>
                </div>
                <button type="submit" class="login-button">Log in</button>
                <div class="extra-links">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">Forgot Password?</a>
                    @endif
                    <a href="{{ url('register') }}">Create an Account</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const toggleButton = document.querySelector('.toggle-password');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleButton.textContent = 'Hide';
            } else {
                passwordField.type = 'password';
                toggleButton.textContent = 'Show';
            }
        }
    </script>
</body>
</html>
