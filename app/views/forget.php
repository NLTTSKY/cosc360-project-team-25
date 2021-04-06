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
                    <li><a href='/blog/index/login'>Login</a></li>
                    <li><a href='#'>forget</a></li>
                </ul>
            </div>
            <hr style="margin-top: 50px;" />
            <div class="content" >
                <div class="container">
                    <form action="/blog/index/forget_check" method="POST">
                        <label for="username">UserName</label>
                        <input type="text" id="username" required="required" class="te" name="username" placeholder="Your username">
                        
                        <label for="email">Email</label>
                        <input type="email" id="email" required="required" class="te" name="email" placeholder="Your email">                      
                        <input type="button" value="Submit" class="sub" id="sub">
                      </form>
                </div>
            </div>

         </div>

         <div id="main-right"></div>
     </div>

    <?php include 'message.php'; ?>
</body>
<script type="text/javascript">
    $(function(){
        $("#sub").click(function(){
            var username = $("#username").val();
            var email = $("#email").val();
            var reg = /^([a-zA-Z]|[0-9])(\w|\-)+@[a-zA-Z0-9]+\.([a-zA-Z]{2,4})$/;
            if (username == null || username == undefined || username == "") {
                alert("invalid username");
                return;
            }
            if (email == null || email == undefined || email == "" || !reg.test(email)) {
                alert("invalid email");
                return;
            }
            $.ajax({
                type: "post",
                url: "/blog/index/forget_check",
                async: false,
                data: {"username":username, "email": email},
                success: function(data) {
                    var a = $.parseJSON(data);
                    //console.log(a);
                    if (a.code == 1) {
                        alert(a.msg);
                        window.location.href = '/blog/index/login';
                    }else{
                        alert(a.msg);
                    }
                }
            });
        })
        
    })

</script>

</html>



`