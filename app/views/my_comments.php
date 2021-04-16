<!DOCTYPE html>
<html lang='us'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <!-- <link rel='stylesheet' href='/blog/vendor/twbs/bootstrap/dist/css/bootstrap.css' type='text/css'> -->
    <link rel='stylesheet' href='/blog/public/css/common.css' type='text/css'>
    <!-- <link rel='stylesheet' href='/blog/public/css/index.css' type='text/css'> -->
    <link rel='stylesheet' href='/blog/public/css/admin.css' type='text/css'>
    <link rel='stylesheet' href='/blog/public/css/table.css' type='text/css'>
    <script type='text/javascript' src='/blog/vendor/components/jquery/jquery.min.js'></script>
    <script type='text/javascript' src='/blog/vendor/twbs/bootstrap/dist/js/bootstrap.js'></script>
    <script type='text/javascript' src='/blog/public/js/common.js'></script>
    <title>My Comments</title>
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
                <li><a href='#'>My Comments</a></li>
              </ul>
             </div>
            <hr style="margin-top: 35px;" />
            <div class="content">
              <div class="limiter">
                <div class="container-table100">
                  <div class="wrap-table100">
                      <div class="table">

                        <div class="row header">
                          <div class="cell" style="width: 10%;">
                            #
                          </div>
                          <div class="cell" style="width: 30%;">
                            Comment Content
                          </div>
                          <div class="cell" style="width: 20%;">
                            Article Title
                          </div>
                          <div class="cell" style="width: 15%;">
                            Article Category
                          </div>
                          <div class="cell">
                            Comment Time
                          </div>
                          <div class="cell">
                            Operation
                          </div>
                      </div>
                        <?php foreach($comments as $k=>$v): ?>
                        <div class="row">
                          <div class="cell">
                            <?php echo ++$k; ?>
                          </div>
                          <div class="cell">
                            <?php echo $v['content']; ?>
                          </div>
                          <div class="cell">
                            <a target="_blank" href="/blog/index/article/id/<?php echo $v['article_no']; ?>"><?php echo $v['title']; ?></a>
                          </div>
                          <div class="cell">
                            <?php echo $v['cate_name']; ?>
                          </div>
                          <div class="cell">
                            <?php echo $v['create_time']; ?>
                          </div>
                          <div class="cell">
                            <a href="/blog/admin/deleteComment/id/<?php echo $v['comment_no']; ?>">
                              <button  class="danger-sm" style="width: 100%;">Delete</button>
                            </a>
                          </div>
                        </div>
                        <?php endforeach; ?>
                        
                      </div>
                  </div>
                </div>
              </div>

            </div>

         </div>

         <div id="main-right"></div>
     </div>

    <?php include 'message.php';include 'footer.php'; ?>
</body>
<script type="text/javascript">
  $(function(){
    $("#my-comments").addClass("active");


  })

</script>

</html>



