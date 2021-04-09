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
    <title>Edit Profile</title>
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
                <li><a href='#'>Edit Profle</a></li>
              </ul>
             </div>
            <hr style="margin-top: 35px;" />
            <div class="content">
              <div class="container">
                  <form action="/blog/admin/editprofile_check" method="POST" id="form" enctype="multipart/form-data">
                        <label for="nickname">Name</label>
                        <input type="text" id="nickname" class="te" name="nickname" value="<?php echo $loginUser['nick_name'] ?>" disabled="disabled">

                        <label for="realname">RealName
                            <span id="warn-realname" class="warn">realname too short</span></label>
                        <input type="text" onblur="checkRealname()" id="realname" class="te" name="realname" placeholder="Your RealName">

                        <label for="email">Email
                            <span id="email-format" class="warn">error email format</span></label>
                            <span id="warn-email" class="warn">email has been registered</span></label>
                        <input type="email" onblur="checkEmail()" id="email" required="required" class="te" name="email" placeholder="Your email" value="<?php echo $loginUser['email'] ?>">

                        <label for="phone">Phone
                            <span id="warn-phone" class="warn">phone number too short</span></label>
                        <input type="text" onblur="checkPhone()" id="phone" class="te" name="phone" placeholder="Your phone" value="<?php echo $loginUser['phone'] ?>">

                        <label for="pic">Profile picture 
                          <span style="color:red;font-size: 14px;">(it will not be modified if it is not uploaded)</span>
                        </label>
                        <input type="file" id="pic" class="te" name="pic" accept="image/*" placeholder="Your profile picture">
                        <!-- <label for="country">Country</label>
                        <select id="country" name="country">
                          <option value="australia">Australia</option>
                          <option value="canada">Canada</option>
                          <option value="usa">USA</option>
                        </select> -->                                                                                                                                                              
                        <input type="submit" value="Edit" class="sub" id="sub">

                  </form>
                  <a href="/blog/admin/index"><button class="info" style="width: 100%;">Return</button></a>
              </div>
            </div>

         </div>

         <div id="main-right"></div>
     </div>

    <?php include 'message.php'; ?>
</body>
<script type="text/javascript">
  function checkRealname(){
        var realname = $("#realname").val();
        if(realname  == null || realname == undefined || realname == "" || realname.length<3){
          $("#warn-realname").css("visibility", "visible");
          return;
        }else{
          $("#warn-realname").css("visibility", "hidden");
        }
    }

    function checkPhone(){
        var phone = $("#phone").val();
        if(phone  == null || phone == undefined || phone == "" || phone.length<7){
          $("#warn-phone").css("visibility", "visible");
          return;
        }else{
          $("#warn-phone").css("visibility", "hidden");
        }
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
            url: "/blog/admin/email_check",
            async: false,
            data: { "email": email},
            success: function(data) {
                console.log(data);
                var a = $.parseJSON(data);
                console.log(a);
                if (a.code == 1) {
                    $("#email-format").css("visibility", "hidden");
                    $("#warn-email").css("visibility", "hidden");
                }else{
                    alert(a.msg);
                }
            }
        });
    }

  $(function(){
    $("#index-nav").addClass("active");
  })

</script>

</html>



