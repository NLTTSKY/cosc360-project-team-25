<!DOCTYPE html>
<html lang='us'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <!-- <link rel='stylesheet' href='/blog/vendor/twbs/bootstrap/dist/css/bootstrap.css' type='text/css'> -->
    <link rel='stylesheet' href='/blog/public/css/common.css' type='text/css'>
    <!-- <link rel='stylesheet' href='/blog/public/css/index.css' type='text/css'> -->
    <link rel='stylesheet' href='/blog/public/css/admin.css' type='text/css'>
    <link rel='stylesheet' href='/blog/public/css/vert.css' type='text/css'>
    <script type='text/javascript' src='/blog/vendor/components/jquery/jquery.min.js'></script>
    <script type='text/javascript' src='/blog/vendor/twbs/bootstrap/dist/js/bootstrap.js'></script>
    <script type='text/javascript' src='/blog/public/js/common.js'></script>
    <title>All Reports</title>
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
                <li><a href='#'>All Reports</a></li>
              </ul>
             </div>
            <hr style="margin-top: 35px;" />
            <div class="content">
                <div id="vert">
                    <h3>统计数据</h3>
                    <ul>
                        <li class="c1">130</li>
                        <li class="c2">40</li>
                        <li class="c3">20</li>
                        <li class="c4">40</li>
                     
                    </ul>
                </div>

            </div>

         </div>

         <div id="main-right"></div>
     </div>

    <?php include 'message.php';include 'footer.php'; ?>
</body>
<script type="text/javascript">
  $(function(){
    $("#reports").addClass("active");
  })

</script>

</html>



