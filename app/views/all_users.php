<!DOCTYPE html>
<html lang='us'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <!-- <link rel='stylesheet' href='/blog/vendor/twbs/bootstrap/dist/css/bootstrap.css' type='text/css'> -->
    <link rel='stylesheet' href='/blog/public/css/common.css' type='text/css'>
    <link rel='stylesheet' href='/blog/public/css/login.css' type='text/css'>
    <link rel='stylesheet' href='/blog/public/css/admin.css' type='text/css'>
    <link rel='stylesheet' href='/blog/public/css/table.css' type='text/css'>
    <script type='text/javascript' src='/blog/vendor/components/jquery/jquery.min.js'></script>
    <script type='text/javascript' src='/blog/vendor/twbs/bootstrap/dist/js/bootstrap.js'></script>
    <script type='text/javascript' src='/blog/public/js/common.js'></script>
    <title>All Users</title>
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
                <?php if(isset($search_type) && isset($keyword)): ?>
                  <li><a href='/blog/super/all_users'>All Users</a></li>
                  <li><a href='#'>Search Users</a></li>
                <?php endif; ?>
                <?php if(!isset($search_type) || !isset($keyword)): ?>
                  <li><a href='#'>All Users</a></li>
                <?php endif; ?>
              </ul>
             </div>
            <hr style="margin-top: 35px;" />
            <div class="content">
              <h3>Search Users</h3>
              <div class="container">
                    <form action="/blog/super/all_users" method="POST">
                        <label for="search_type">Search Type</label>
                        <select id="search_type" name="search_type">
                          <option value="name" <?php if(isset($search_type) && $search_type =='name'){echo "selected='selected'";} ?> >name</option>
                          <option value="email" <?php if(isset($search_type) && $search_type =='email'){echo "selected='selected'";} ?> >email</option>
                          <option value="post" <?php if(isset($search_type) && $search_type =='post'){echo "selected='selected'";} ?> >post</option>
                        </select>

                        <label>Keyword</label>
                        <input type="text" class="te" required="required" name="keyword" placeholder="search keyword" 
                        <?php if(isset($keyword)){echo "value='".$keyword."'";} ?> >
                        <input type="submit" value="Search" class="sub" style="width: 30%;">
                      </form>
                </div>
              <hr style="margin-top: 35px;" />

              <div class="limiter">
                <div class="container-table100">
                  <div class="wrap-table100">
                      <div class="table">
                        <div class="row header">
                          <div class="cell" style="width: 10%;">
                            #
                          </div>
                          <div class="cell" style="width: 10%;">
                            User Name
                          </div>
                          <div class="cell" style="width: 20%;">
                            Email
                          </div>
                          <div class="cell" style="width: 10%;">
                            Real Name
                          </div>
                          <div class="cell" style="width: 20%;">
                            Phone
                          </div>
                          <div class="cell" style="width: 10%;">
                            User Type
                          </div>
                          <div class="cell" style="width: 10%;">
                            State
                          </div>
                          <div class="cell">
                            Operation
                          </div>
                      </div>
                        <?php foreach($users as $k=>$v): ?>
                        <div class="row">
                          <div class="cell">
                            <?php echo ++$k; ?>
                          </div>
                          <div class="cell">
                            <?php echo $v['nick_name']; ?>
                          </div>
                          <div class="cell">
                            <?php echo $v['email']; ?>
                          </div>
                          <div class="cell">
                            <?php echo $v['realname']; ?>
                          </div>
                          <div class="cell">
                            <?php echo $v['phone']; ?>
                          </div>
                          <div class="cell">
                            <?php echo $v['type']; ?>
                          </div>
                          <div class="cell">
                            <?php if($v['disabled'] == 0) {echo 'enabled';}else{echo 'disabled';} ?>
                          </div>
                          <div class="cell">
                            <?php if($v['disabled'] == 0): ?>
                              <a href="/blog/super/disable_user/id/<?php echo $v['uid']; ?>">
                                <button  class="danger-sm" style="width: 100%;">Disable</button>
                              </a>
                            <?php endif; ?>
                            <?php if($v['disabled'] == 1): ?>
                              <a href="/blog/super/enable_user/id/<?php echo $v['uid']; ?>">
                                <button  class="info-sm" style="width: 100%;">Enable</button>
                              </a>
                            <?php endif; ?>
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
    $("#all-users").addClass("active");


  })

</script>

</html>



