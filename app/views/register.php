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
    <title>Register</title>
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
                    <li><a href='#'>Register</a></li>
                </ul>
            </div>
            <hr style="margin-top: 50px;" />
            <div class="content" >
                <div class="container">
                    <form action="/blog/index/register_check" method="POST" id="form" enctype="multipart/form-data">
                        <label for="nickname">Name<span id="warn-name" class="warn">name has been registered</span></label>
                        <input type="text" onblur="checkName()" id="nickname" required="required" class="te" name="nickname" placeholder="Your name">

                        <label for="email">Email
                            <span id="email-format" class="warn">error email format</span></label>
                            <span id="warn-email" class="warn">email has been registered</span></label>
                        <input type="email" onblur="checkEmail()" id="email" required="required" class="te" name="email" placeholder="Your email">

                        <label for="password">Password
                        </label>

                        <input type="password" id="password" class="te" required="required" name="password" placeholder="Your password">
                        <label for="repassword">Repeat Password
                            <span id="warn-repeat" class="warn">The repeat passwords are not the same</span></label>
                        </label>
                        <input type="password" onblur="checkRepaeat()" id="repassword" class="te" required="required" name="repassword" placeholder="Repeat password">
                        <label for="pic">Profile picture</label>
                        <input type="file" id="pic" class="te" name="pic" accept="image/*" required="required" placeholder="Your profile picture">
                        <!-- <label for="country">Country</label>
                        <select id="country" name="country">
                          <option value="australia">Australia</option>
                          <option value="canada">Canada</option>
                          <option value="usa">USA</option>
                        </select> -->
                        <label for="pic">captcha
                            
                        </label><br/>
                        <img id="cap" src="/blog/index/captcha" />
                        <button type="button" class="btn btn-info btn-sm" id="change_captcha">change</button>
                        <input type="text" id="captcha" class="te" name="captcha" required="required" placeholder="captcha">
                        <input type="submit" value="Register" class="sub" id="sub">
                    </form>
                </div>
            </div>

         </div>

         <div id="main-right"></div>
     </div>

    <?php include 'message.php'; ?>
</body>

<script type="text/javascript">
    function checkName(){
        var nickname = $("#nickname").val();
        if(nickname  == null || nickname == undefined || nickname == "" ){
            return;
        }
        $.ajax({
            type: "post",
            url: "/blog/index/check_name",
            async: false,
            data: { "nickname": nickname},
            success: function(data) {
                console.log(data);
                var a = $.parseJSON(data);
                console.log(a);
                if (a.code == 1) {
                    $("#warn-name").css("visibility", "hidden");
                }else{
                    $("#warn-name").css("visibility", "visible");
                }
            }
        });
    }
    function checkEmail(){
        var email = $("#email").val();
        var reg = /^([a-zA-Z]|[0-9])(\w|\-)+@[a-zA-Z0-9]+\.([a-zA-Z]{2,4})$/;
        if (email == null || email == undefined || email == "" || !reg.test(email)) {
            $("#email-format").css("visibility", "visible");
            return;
        } else {
            $("#email-format").css("visibility", "hidden");
        }
        $.ajax({
            type: "post",
            url: "/blog/index/email_check",
            async: false,
            data: { "email": email},
            success: function(data) {
                console.log(data);
                var a = $.parseJSON(data);
                console.log(a);
                if (a.code == 1) {
                    $("#email-format").css("visibility", "hidden");
                    $("#warn-email").css("visibility", "hidden");
                }else if(a.code == -1){
                    $("#email-format").css("visibility", "visible");
                    $("#warn-email").css("visibility", "hidden");
                }else{
                    $("#warn-email").css("visibility", "visible");
                    $("#email-format").css("visibility", "hidden");
                }
            }
        });
    }

    function checkRepaeat(){
        var repassword = $("#repassword").val();
        var password = $("#password").val();
        if (repassword == null || repassword == undefined || repassword == "" || repassword != password) {
            $("#warn-repeat").css("visibility", "visible");
            return;
        } else {
            $("#warn-repeat").css("visibility", "hidden");
        }
    }

    $(function(){
        $("#change_captcha").click(function() {
            var rand = parseInt(new Date().getTime()) + Math.random();
            console.log("rand:/blog/index/captcha/id/" + rand);
            $('#cap').attr('src', '/blog/index/captcha/id/' + rand);
        });

    })


</script>

</html>



