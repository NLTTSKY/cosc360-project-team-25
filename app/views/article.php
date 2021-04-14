<!DOCTYPE html>
<html lang='us'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <!-- <link rel='stylesheet' href='/blog/vendor/twbs/bootstrap/dist/css/bootstrap.css' type='text/css'> -->
    <link rel='stylesheet' href='/blog/public/css/common.css' type='text/css'>
    <link rel='stylesheet' href='/blog/public/css/index.css' type='text/css'>
    <link rel='stylesheet' href='/blog/public/css/login.css' type='text/css'>
    <script type='text/javascript' src='/blog/vendor/components/jquery/jquery.min.js'></script>
    <script type='text/javascript' src='/blog/vendor/twbs/bootstrap/dist/js/bootstrap.js'></script>
    <script type='text/javascript' src='/blog/public/js/common.js'></script>
    <title>Blog Article</title>
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
                <li><a href='/blog/index/index'>Home</a></li>
                <li><a href="/blog/index/category/id/<?php echo $article['cate_id']; ?>"><?php echo $article['cate_name']; ?></a></li>
                <li><a href='#'>Article Detail</a></li>
              </ul>
            </div>

            <hr style="margin-top: 35px;" />
            <div class="content" >
                <h1 style="text-align: center;"><?php echo $article['title']; ?></h1>
                <hr style="margin-top: 35px;color: #fdecec;">
                <p><span style="float: left;">Category:<?php echo $article['cate_name']; ?></span>
                  <span style="float: right;">Click:<?php echo $article['click']; ?></span></p>
                <hr style="margin-top: 35px;color: #fdecec;">
                <?php echo $article['content']; ?>
                <hr style="margin-top: 35px;color: #fdecec;">
                <p><span style="float: left;">Author:<?php echo $article['nick_name']; ?></span>
                  <span style="float: right;">Last Edit Time:<?php echo $article['last_update_time']; ?></span></p>
                
                <hr style="margin-top: 50px;color: #fdecec;">
                <h3>All Comments</h3>
                <div id="comments">
                  <?php foreach($comments as $k=>$v): ?>
                    <hr>
                    <p><?php echo $v['content']; ?> <span style="float:right;"><?php echo $v['create_time']; ?></span></p>
                  <?php endforeach; ?>
                </div>
                
                <?php if(isset($_SESSION['uid'])): ?>
                  <hr style="margin-top: 150px;color: #fdecec;">
                  <form action="/blog/admin/comment_check" method="POST" id="form">
                    <input type="hidden" name="article_no" id="article_no" value="<?php echo $article['article_no']; ?>">
                    <label for="comment">Your Comment</label>
                    <input type="text" id="comment" required="required" class="te" name="comment" placeholder="Your comment">

                    <label for="pic">captcha</label><br/>
                    <img id="cap" src="/blog/index/captcha" />
                    <button type="button" class="btn btn-info btn-sm" id="change_captcha">change</button>
                    <input type="text" id="captcha" class="te" name="captcha" required="required" placeholder="captcha">
                    <input type="button" value="Comment" class="sub" id="sub" style="width: 30%;">
                  </form>
                <?php endif; ?>
                
            </div>

         </div>

         <div id="main-right"></div>
     </div>

    <?php include 'message.php'; ?>
</body>
<script type="text/javascript">
  $(function(){
        $("#change_captcha").click(function() {
            var rand = parseInt(new Date().getTime()) + Math.random();
            console.log("rand:/blog/index/captcha/id/" + rand);
            $('#cap').attr('src', '/blog/index/captcha/id/' + rand);
        });

        function getComments(){
          $.ajax({
              type: "get",
              url: "/blog/index/get_article_comments/article_no/"+$("#article_no").val(),
              async: false,
              data: {},
              success: function(data) {
                  console.log(data);
                  var res = $.parseJSON(data);
                  console.log(res);
                  var comments = res.data;
                  if (res.code == 1) {
                    var childhtml = "";
                    for(var comment in comments){
                        childhtml +="<hr>";
                        childhtml +="<p>"+comments[comment]['content']+"<span style='float:right;''>"+comments[comment]['create_time']+"</span></p>";
                    }
                    $("#comments").html(childhtml);
                  }else{
                      alert(res.msg);
                  }
              }
          });
        }

        $("#sub").click(function(){
          var comment = $("#comment").val();
          var captcha = $("#captcha").val();
          if (comment == null || comment == undefined || comment == "") {
              alert("comment can't be empty");
              return;
          }
          if (captcha == null || captcha == undefined || captcha == "") {
              alert("captcha can't be empty");
              return;
          }
          $.ajax({
              type: "post",
              url: "/blog/admin/comment_check",
              async: false,
              data: { "article_no":$("#article_no").val(),"comment":comment, "captcha":captcha},
              success: function(data) {
                  var res = $.parseJSON(data);
                  var rand = parseInt(new Date().getTime()) + Math.random();
                  if (res.code == 1) {
                      alert(res.msg);
                      $('#cap').attr('src', '/blog/index/captcha/id/' + rand);
                      getComments();
                  }else{
                      $('#cap').attr('src', '/blog/index/captcha/id/' + rand);
                      alert(res.msg);
                  }
              }
          });
        })

    })
</script>

</html>



