<!DOCTYPE html>
<html lang='us'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <!-- <link rel='stylesheet' href='/blog/vendor/twbs/bootstrap/dist/css/bootstrap.css' type='text/css'> -->
    <link rel='stylesheet' href='/blog/public/css/common.css' type='text/css'>
    <link rel='stylesheet' href='/blog/public/css/index.css' type='text/css'>
    <link rel='stylesheet' href='/blog/public/css/login.css' type='text/css'>
    <script type='text/javascript' src='/blog/vendor/components/jquery/jquery.min.js'></script>
    <script type='text/javascript' src='/blog/vendor/twbs/bootstrap/dist/js/bootstrap.js'></script>
    <script type='text/javascript' src='/blog/public/js/common.js'></script>
    <title>Login</title>
</head>

<body>
    <?php include 'nav.php'; ?>
     
     <div id="main">
        
        <div class="loading">
            <div class="pic">
                <i></i>
                <i></i>
                <i></i>
                <i></i>
                <i></i>
            </div>
        </div>

         <div id="main-left"></div>

         <div id="main-center">
            <div id="crumbs">
                <ul>
                    <li><a href='/blog/'>Home</a></li>
                    <li><a href='#'>Login</a></li>
                </ul>
            </div>
            <hr style="margin-top: 50px;" />
            <div class="content" >
                <div class="container">
                    <form action="/blog/index/login_check" method="POST">
                        <label for="username">UserName</label>
                        <input type="text" id="username" class="te" required="required" name="username" placeholder="Your username">
                        
                        <label for="password">Password</label>
                        <input type="password" id="password" class="te" required="required" name="password" placeholder="Your password">

                        <!-- <label for="country">Country</label>
                        <select id="country" name="country">
                          <option value="australia">Australia</option>
                          <option value="canada">Canada</option>
                          <option value="usa">USA</option>
                        </select> -->
                      
                        <input type="submit" value="Submit" class="sub">
                        <a class="forget" href="/blog/index/forget">forget password</a>
                      </form>
                </div>
            </div>

         </div>

         <div id="main-right"></div>
     </div>

    <?php include 'message.php';include 'footer.php'; ?>
</body>

</html>



