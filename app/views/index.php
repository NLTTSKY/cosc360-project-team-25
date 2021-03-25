<!DOCTYPE html>
<html lang='us'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <!-- <link rel='stylesheet' href='/cosc360-project-team-25/vendor/twbs/bootstrap/dist/css/bootstrap.css' type='text/css'> -->
    <link rel='stylesheet' href='/cosc360-project-team-25/public/css/common.css' type='text/css'>
    <link rel='stylesheet' href='/cosc360-project-team-25/public/css/index.css' type='text/css'>
    <script type='text/javascript' src='/cosc360-project-team-25/vendor/components/jquery/jquery.min.js'></script>
    <script type='text/javascript' src='/cosc360-project-team-25/vendor/twbs/bootstrap/dist/js/bootstrap.js'></script>
    <script type='text/javascript' src='/cosc360-project-team-25/public/js/common.js'></script>
    <title>Blog</title>
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

         <div id="main-left">主题-左边</div>

         <div id="main-center">

             <div id="crumbs">
              <ul>
                <li>
                  <a href="#1">LPL</a>
                </li>
                <li>
                  <a href="#2">Two</a>
                </li>
                <li>
                  <a href="#5" class="active">Five</a>
                </li>
              </ul>
            </div>

            <div class="content">
                <div class="blog">
                    Title:<span style="font-size: 20px;font-weight: bold;"> This is a good day</span> 
                    <span style="float: right;">click: 123</span>
                    <br />
                    Catgory:<span style="font-size: 16px;"> Life</span> 
                    <span style="float: right;">last edit time: 123</span>
                </div>
                <div class="blog">
                    
                </div>
                <div class="blog">
                    
                </div>
            </div>

         </div>

         <div id="main-right">主题-右边</div>
     </div>

    <?php include 'footer.php';include 'message.php'; ?>
</body>

</html>



