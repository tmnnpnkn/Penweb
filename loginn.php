<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/logadd.css">
    <title>Login Page</title>
    <style>
        body {
            background-color: #fff;
            /* สีพื้นหลัง */
            color: #1a237e;
            /* สีข้อความทั่วไป */
        }

        .login-box h1,
        .login-box h3 {
            color: #1a237e;
            /* สีข้อความส่วนหัว */
        }

        .textbox input[type="text"]::placeholder,
        .textbox input[type="password"]::placeholder {
            color: #1a237e;
            /* สีข้อความ Placeholder ในช่อง input */
        }

        .button {
            background-color: #1a237e;
            /* สีปุ่ม */
            color: #fff;
            /* สีข้อความบนปุ่ม */
        }

        .button:hover {
            background-color: #1a237e;
            /* สีเมื่อโฮเวอร์ปุ่ม */
        }

        .fa-user {
            color: #1a237e;
            /* สีที่คุณต้องการ */
        }

        .fa-lock {
            color: #1a237e;
            /* สีที่คุณต้องการ */
        }

        .login-box {
            width: 280px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #1a237e;
        }
        .textbox {
    width: 100%;
    overflow: hidden;
    font-size: 20px;
    padding: 8px 0;
    margin: 8px 0;
    border-bottom: 1px solid #1a237e;
        }
    </style>
</head>

<body>
    <form action="php/login.php" method="post">
        <div class="login-box" style="margin-top: -30px;">
            <h1>P E N
                <h3>intertrade</h3>
            </h1>

            <div class="textbox">
                <i class="fa fa-user" aria-hidden="true"></i>
                <input type="text" placeholder="Username" name="username" value="">
            </div>

            <div class="textbox">
                <i class="fa fa-lock" aria-hidden="true"></i>
                <input type="password" placeholder="Password" name="password" value="">
            </div>

            <input class="button" type="submit" name="login" value="Log In">
        </div>
    </form>
</body>

</html>