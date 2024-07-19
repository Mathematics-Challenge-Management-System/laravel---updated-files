<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: url('/images/pupil.jpg') no-repeat center center fixed;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
        }
        .nav-bar {
            width: 100%;
            padding: 20px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(0, 0, 0, 0.5);
        }
        .nav-links {
            display: flex;
            gap: 20px;
        }
        .nav-links a {
            color: white;
            text-decoration: none;
            font-size: 1em;
        }
        .get-started {
            padding: 10px 20px;
            border: 2px solid white;
            border-radius: 5px;
            background: transparent;
            color: white;
            text-decoration: none;
            font-size: 1em;
        }
        .get-started:hover {
            background-color: orange;
            color: #7F00FF;
        }
        .container {
            text-align: center;
            margin-top: 100px;
        }
        .header {
            font-size: 2.5em;
            margin-bottom: 20px;
        }
        .sub-header {
            font-size: 1.2em;
            margin-bottom: 40px;
        }
        .form-container {
            background: rgba(0, 0, 0, 0.5);
            padding: 20px;
            border-radius: 10px;
            display: inline-block;
        }
        .input-field {
            display: block;
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
        }
        .btn {
            padding: 10px 20px;
            background-color: #00BFFF;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: white;
            font-size: 1em;
        }
        .btn:hover {
            background-color: #008CBA;
        }
        .remember-me {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
        }
        .remember-me label {
            display: flex;
            align-items: center;
        }
        .links a {
            color: #00BFFF;
            text-decoration: none;
        }
    </style>
</head>
<body >
    <div class="nav-bar">
        <div class="nav-links">
    
           <div class="get-started"> <a  href="{{ route('login') }}">Login</a></div>
           <div class="get-started"> <a  href="{{ route('dashboard') }}">dashboard</a></div>
    </div>
        <a href="{{ route('virtual-reality') }}" class="get-started">Analytics</a>
    </div>
    <div class="container">
    <div class="header">THE</div>
        <div class="header">MATHEMATICS CHALLENGE COMPETITION</div>
        <div class="sub-header">NUMBERS DONT LIE!!.</div>
        <!--<div class="form-container">
            <input type="text" placeholder="Email or Username" class="input-field">
            <input type="password" placeholder="Password" class="input-field">
            <div class="remember-me">
                <label><input type="checkbox"> Remember me</label>
                <a href="#">Forgot Password?</a>
            </div>
            <button class="btn">Login</button>
        </div>-->
    </div>
</body>
</html>
