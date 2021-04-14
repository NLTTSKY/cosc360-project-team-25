<!DOCTYPE html>
<html lang='us'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <!-- <link rel='stylesheet' href='/blog/vendor/twbs/bootstrap/dist/css/bootstrap.css' type='text/css'> -->
    <link rel='stylesheet' href='/blog/public/css/common.css' type='text/css'>
    <!-- <link rel='stylesheet' href='/blog/public/css/index.css' type='text/css'> -->
    <link rel='stylesheet' href='/blog/public/css/admin.css' type='text/css'>
    <link rel='stylesheet' href='/blog/public/css/login.css' type='text/css'>
    <script type='text/javascript' src='/blog/vendor/components/jquery/jquery.min.js'></script>
    <script type='text/javascript' src='/blog/vendor/twbs/bootstrap/dist/js/bootstrap.js'></script>
    <script type='text/javascript' src='/blog/public/js/common.js'></script>
    <title>Change Password</title>
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

         <div id="main-left">
            <?php include 'admin_menu.php'; ?>
         </div>

         <div id="main-center">

             <div id="crumbs">
              <ul>
                <li><a href='/blog/admin/index'>Admin</a></li>
                <li><a href='/blog/admin/index'>Person Profile</a></li>
                <li><a href='#'>Change Password</a></li>
              </ul>
             </div>
            <hr style="margin-top: 35px;" />
            <div class="content">
              <div class="container">
                  <form action="#" method="POST" id="form" enctype="multipart/form-data">
                        <label for="nickname">Old Password
                        </label>
                        <input type="text" id="old_password" required="required" class="te" name="old_password" placeholder="Old Password">

                        <label for="password">New Password
                          <span id="warn-password" class="warn">New Password to short</span>
                        </label>

                        <input type="password" onblur="checkPassword()" id="password" class="te" required="required" name="password" placeholder="Your password">
                        <label for="repassword">Repeat Password
                            <span id="warn-repeat" class="warn">The repeat passwords are not the same</span>
                        </label>
                        <input type="password" onblur="checkRepaeat()" id="repassword" class="te" required="required" name="repassword" placeholder="Repeat password">
                        
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
  function checkPassword(){
        var password = $("#password").val();
        if (password == null || password == undefined || password == "" || password.length<6) {
            $("#warn-password").css("visibility", "visible");
            return;
        } else {
            $("#warn-password").css("visibility", "hidden");
        }
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
    $("#index-nav").addClass("active");
    $("#sub").click(function(){
        var old_password = $('#old_password').val();
        var password = $("#password").val();
        if (password == null || password == undefined || password == "" || password.length<6) {
            $("#warn-password").css("visibility", "visible");
            return;
        } else {
            $("#warn-password").css("visibility", "hidden");
        }

        var repassword = $("#repassword").val();
        if (repassword == null || repassword == undefined || repassword == "" || repassword != password) {
            $("#warn-repeat").css("visibility", "visible");
            return;
        } else {
            $("#warn-repeat").css("visibility", "hidden");
        }

        $.ajax({
            type: "post",
            url: "/blog/admin/changepwd_check",
            async: false,
            data: { "oldpassword": old_password, 'newpassword': password},
            success: function(data) {
                console.log(data);
                var a = $.parseJSON(data);
                console.log(a);
                if (a.code == 1) {
                    alert(a.msg);
                    window.location.href = '/blog/index/logout';
                }else{
                    alert(a.msg);
                }
            }
        });

    })
  })

</script>

</html>



