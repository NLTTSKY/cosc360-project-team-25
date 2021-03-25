<?php
	$dbms='mysql';     // database type
	$host='localhost'; //host name
	$dbName='blog';    // db name
	$user='root';      //db username
	$pass='';          //db password
	$dsn="$dbms:host=$host;dbname=$dbName";
	try {
	    $dbh = new PDO($dsn, $user, $pass); //create a PDO object
	    $sql = 'SELECT * from categories WHERE parent_id IS NULL';
	    $res = $dbh->query($sql);
	    $cate = array();
	} catch (PDOException $e) {
	    die ("Error!: " . $e->getMessage() . "<br/>");
	}

 ?>

<div id="header">

    <ul class="topnav">
        <li style="font-weight: bold;"><a href="/cosc360-project-team-25/" class="active">Blog</a></li>
            <?php foreach($dbh->query($sql) as $row): ?>
                <li class="dropdown">
                    <a class="dropbtn" href="#home"><?php echo $row['cate_name'];?></a>
                    <ul class="dropdown-content">
                        <?php $sql1 = 'SELECT * from categories WHERE parent_id='.$row['cate_id'];foreach($dbh->query($sql1) as $row): ?>
                            <li><a href="/cosc360-project-team-25/index/category/id/<?php echo $row['cate_id'];?>"><?php $cate[$row['cate_id']]=$row['cate_name'];echo $row['cate_name'];?></a></li>
                        <?php endforeach; ?>
                        
                        <!-- <li><a href="">二级菜单2</a></li> -->
                    </ul>
                </li>
            <?php endforeach; ?>
        </li>  
        <?php if(!isset($_SESSION['uid'])): ?>
            <li class="right">
                <a href="/lol/index/login">Login</a>
            </li>
            <li class="right">
                <a href="/lol/index/register" style="color:#6fa8dc;">Register</a>
            </li>
        <?php endif; ?>
        <?php if(isset($_SESSION['uid'])): ?>
            <li class="right">
                <a href="/lol/admin/index" style="color:#6fa8dc;"><?php echo $_SESSION['nickname']; ?></a>
            </li>
            <li class="right">
                <a href="/lol/index/logout">Logout</a>
            </li>
        <?php endif; ?>

        <div class="search-container">
            <form action="/action_page.php">
              <input type="text" placeholder="keyword" name="search">
              <button type="submit">Search</button>
            </form>
        </div>
    </ul>



</div>


