<!DOCTYPE html>
<html lang='us'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <!-- <link rel='stylesheet' href='/blog/vendor/twbs/bootstrap/dist/css/bootstrap.css' type='text/css'> -->
    <link rel='stylesheet' href='/blog/public/css/common.css' type='text/css'>
    <link rel='stylesheet' href='/blog/public/css/index.css' type='text/css'>
    <script type='text/javascript' src='/blog/vendor/components/jquery/jquery.min.js'></script>
    <script type='text/javascript' src='/blog/vendor/twbs/bootstrap/dist/js/bootstrap.js'></script>
    <script type='text/javascript' src='/blog/public/js/common.js'></script>
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

         <div id="main-left"></div>

         <div id="main-center">

             <div id="crumbs">
              <ul>
                <?php if(isset($cate_id) && $cate_id != null){echo "<li><a href='/blog/'>Home</a></li>
                <li><a href='#'>category:".$cate[$cate_id]."</a></li>";} ?>
                <?php if(isset($keyword) && $keyword != null){echo "<li><a href='/blog/'>Home</a></li>
                <li><a href='#'>keyword:".$keyword."</a></li>";} ?>
                <?php if(!isset($keyword) && !isset($cate_id)){echo "<li><a href='#'>Home</a></li>";} ?>
              </ul>
             </div>
            <hr style="margin-top: 35px;" />
            <div class="content">
                <?php foreach($articles as $k=>$v): ?>
                    <div class="blog">
                        <div class="blog-head">
                            <span style="font-size: 20px;font-weight: bold;"> 
                              <a href="/blog/index/article/id/<?php echo $v['article_no']; ?>">
                                <?php echo $v['title']; ?>
                                <?php if($k<2): ?>
                                  <span style="font-size: 16px;font-weight: normal;color: red;">hot</span> 
                                <?php endif; ?>    
                              </a>
                            </span> 
                            <span style="float: right;">click: <?php echo $v['click']; ?></span>
                        </div>
                        <div class="blog-body">
                           Catgory: <span style="font-size: 16px;"><a href="/blog/index/category/id/<?php echo $v['cate_id']; ?>"><?php echo $v['cate_name']; ?></a></span> 
                            <span style="float: right;">last edit time: <?php echo $v['last_update_time']; ?></span> 
                        </div>  
                    </div>
                <?php endforeach; ?>
            </div>

         </div>

         <div id="main-right"></div>
     </div>

    <?php include 'message.php';include 'footer.php'; ?>
</body>

</html>



