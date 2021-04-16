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
    <link rel='stylesheet' href='/blog/public/css/login.css' type='text/css'>
    <script type='text/javascript' src='/blog/vendor/components/jquery/jquery.min.js'></script>
    <script type='text/javascript' src='/blog/vendor/twbs/bootstrap/dist/js/bootstrap.js'></script>
    <script type='text/javascript' src='/blog/public/js/common.js'></script>
    <title>Edit Article</title>
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
                <li><a href='/blog/admin/my_articles'>My Articles</a></li>
                <li><a href='#'>Edit Article</a></li>
                
              </ul>
             </div>
            <hr style="margin-top: 35px;" />
            <div class="content">
                <div class="container">
                    <form action="/blog/admin/editAricleSubmit" method="POST">
                        <input type="hidden" name="article_no" value="<?php echo $data['article_no']?>">
                        <label for="title">Title</label>
                        <input type="text" id="title" class="te" required="required" name="title" placeholder="Article Title" value="<?php echo $data['title']?>">

                        <label for="parent_cate">First Category</label>
                        <select id="parent_cate" name="parent_cate">
                          <?php foreach($parent as $k=>$v): ?>
                            <option class="option" style="font-size: 16px;" value="<?php echo $v['cate_id']; ?>"><?php echo $v['cate_name']; ?></option>
                          <?php endforeach; ?>
                        </select>

                        <label for="cate_id">Second Category</label>
                        <select id="cate_id" name="cate_id" required="required">
                          <?php foreach($childCate as $k=>$v): ?>
                            <option class="option" style="font-size: 16px;" value="<?php echo $v['cate_id']; ?>"><?php echo $v['cate_name']; ?></option>
                          <?php endforeach; ?>
                        </select>
                        
                        <label for="password">Content</label>
                        <br/>
                        <textarea  class="content" name="content"><?php echo $data['content']?></textarea>

                        <!--  -->
                      
                        <input type="submit" value="Submit" class="sub">
                      </form>
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

    $("#parent_cate").change(function(){
        $.ajax({
            type: "post",
            url: "/blog/admin/getCategoryByParentId",
            async: false,
            data: { "id": $("#parent_cate").val()},
            success: function(data) {
                var a = $.parseJSON(data);
                var cates = a.data;
                if (a.code == 1) {
                    var childhtml = "";
                    for(var cate in cates){
                        childhtml +="<option value="+cates[cate]['cate_id']+">"+cates[cate]['cate_name']+"</option>"
                    }
                    $("#cate_id").html(childhtml);
                }
            }
        });
      });

  })

</script>

</html>



