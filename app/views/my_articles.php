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
    <title>My Articles</title>
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
                <li><a href='#'>My Articles</a></li>
              </ul>
             </div>
            <hr style="margin-top: 35px;" />
            <div class="content">
              <a href="/blog/admin/new_article"><button class="primary" style="width: 50%;">Add New Article</button></a>
              <hr>
              <div class="limiter">
                <div class="container-table100">
                  <div class="wrap-table100">
                      <div class="table">

                        <div class="row header">
                          <div class="cell" style="width: 10%;">
                            #
                          </div>
                          <div class="cell">
                            Title
                          </div>
                          <div class="cell" style="width: 10%;">
                            Category
                          </div>
                          <div class="cell" style="width: 10%;">
                            Click
                          </div>
                          <div class="cell">
                            Verified
                          </div>
                          <div class="cell">
                            Create Time
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
                            <a target="_blank" href="/blog/index/article/id/<?php echo $v['article_no']; ?>"><?php echo $v['title']; ?></a>
                          </div>
                          <div class="cell">
                            <?php echo $v['cate_name']; ?>
                          </div>
                          <div class="cell">
                            <?php echo $v['click']; ?>
                          </div>
                          <div class="cell" id="verify<?php echo $v['article_no']; ?>">
                            <?php if($v['verify'] == 0){echo "waiting";}else{echo "confirmed";} ?>
                          </div>
                          <div class="cell">
                            <?php echo $v['create_time']; ?>
                          </div>
                          <div class="cell">
                            <a href="/blog/admin/editArticle/id/<?php echo $v['article_no']; ?>">
                              <button  class="success-sm">Edit</button></a>
                            <a href="/blog/admin/deleteArticle/id/<?php echo $v['article_no']; ?>">
                              <button  class="danger-sm">Delete</button>
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
    $("#my-articles").addClass("active");


  })

</script>

</html>



