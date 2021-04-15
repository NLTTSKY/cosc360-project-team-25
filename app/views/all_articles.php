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
    <title>All Articles</title>
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
                <li><a href='#'>All Articles</a></li>
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
                            Article Title
                          </div>
                          <div class="cell" style="width: 10%;">
                            Cate Name
                          </div>
                          <div class="cell" style="width: 20%;">
                            Create Time
                          </div>
                          <div class="cell" style="width: 10%;">
                            State
                          </div>
                          <div class="cell">
                            Operation
                          </div>
                      </div>
                        <?php foreach($articles as $k=>$v): ?>
                        <div class="row">
                          <div class="cell">
                            <?php echo ++$k; ?>
                          </div>
                          <div class="cell">
                            <?php echo $v['title']; ?>
                          </div>
                          <div class="cell">
                            <?php echo $v['cate_name']; ?>
                          </div>
                          <div class="cell">
                            <?php echo $v['create_time']; ?>
                          </div>
                          <div class="cell">
                            <?php if($v['verify'] == 0) {echo 'wait';}else{echo 'confirmed';} ?>
                          </div>
                          <div class="cell">
                            <?php if($v['verify'] == 0): ?>
                              <a href="/blog/super/confirm_article/id/<?php echo $v['article_no']; ?>">
                                <button  class="primary-sm" style="width: 30%;">Confirm</button>
                              </a>
                            <?php endif; ?>
                            <a href="/blog/admin/editArticle/id/<?php echo $v['article_no']; ?>">
                              <button  class="warning-sm" style="width: 30%;">Edit</button>
                            </a>
                            <a href="/blog/admin/deleteArticle/id/<?php echo $v['article_no']; ?>">
                              <button  class="danger-sm" style="width: 30%;">Delete</button>
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

    <?php include 'message.php'; ?>
</body>
<script type="text/javascript">
  $(function(){
    $("#all-articles").addClass("active");


  })

</script>

</html>



