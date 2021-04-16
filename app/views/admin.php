<!DOCTYPE html>
<html lang='us'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <!-- <link rel='stylesheet' href='/blog/vendor/twbs/bootstrap/dist/css/bootstrap.css' type='text/css'> -->
    <link rel='stylesheet' href='/blog/public/css/common.css' type='text/css'>
    <!-- <link rel='stylesheet' href='/blog/public/css/index.css' type='text/css'> -->
    <link rel='stylesheet' href='/blog/public/css/admin.css' type='text/css'>
    <script type='text/javascript' src='/blog/vendor/components/jquery/jquery.min.js'></script>
    <script type='text/javascript' src='/blog/vendor/twbs/bootstrap/dist/js/bootstrap.js'></script>
    <script type='text/javascript' src='/blog/public/js/common.js'></script>
    <title>Person Profile</title>
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
                <li><a href='#'>Person Profile</a></li>
              </ul>
             </div>
            <hr style="margin-top: 35px;" />
            <div class="content">
              <div class="img" style="float: left;">
                <img src="<?php echo IMG_PATH.$loginUser['profile_path']; ?>">
              </div>
              <div class="detail" style="float: left;margin-left: 20px;">
                <h1><?php echo $loginUser['nick_name']; ?> </h1>
                <hr>
                <p class="pname">RealName: <span class="pvalue"><?php echo $loginUser['realname']; ?></span> </p>
                <p class="pname">Email: <span class="pvalue"><?php echo $loginUser['email']; ?></span> </p>
                <p class="pname">Phone: <span class="pvalue"><?php echo $loginUser['phone']; ?></span> </p>
                <p class="pname">Register Time: <span class="pvalue"><?php echo $loginUser['create_time']; ?></span> </p>
                <p class="pname">Last Edit Time: <span class="pvalue"><?php echo $loginUser['last_update_time']; ?></span> </p>
                <hr>
                <p class="pname">Article Number: <span class="pvalue"><?php echo $articleCount; ?></span> </p>
                <p class="pname">Comment Number: <span class="pvalue"><?php echo $commentCount; ?></span> </p>
                <hr>
                <a href="/blog/admin/edit_profile"><button class="primary" style="width: 100%;">Edit Profile</button></a>
                <a href="/blog/admin/change_password"><button class="warning" style="width: 100%;">Change Password</button></a>
              </div>
            </div>

         </div>

         <div id="main-right"></div>
     </div>

    <?php include 'message.php';include 'footer.php'; ?>
</body>
<script type="text/javascript">
  $(function(){
    $("#index-nav").addClass("active");


  })

</script>

</html>



