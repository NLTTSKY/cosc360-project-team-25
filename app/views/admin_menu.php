<ul class="adm">
	<li class="admi"><a class="menu" href="#admin">Admin Page</a></li>
    <li class="admi"><a id="index-nav" href="/blog/admin/index">Person Profile</a></li>
    <li class="admi"><a id="my-articles" href="/blog/admin/my_articles">My Articles</a></li>
    <li class="admi"><a id="my-comments" href="/blog/admin/my_comments">My Comments</a></li>
    <?php if($_SESSION['type'] == 'admin'): ?>
    	<li class="admi"><a class="menu" href="#admin">System Page</a></li>
        <li class="admi"><a id="all-users" href="/blog/super/all_users">Users</a></li>
        <li class="admi"><a id="all-articles" href="/blog/super/all_articles">Articles</a></li>
        <!-- <li class="admi"><a id="reports" href="/blog/super/all_reports">Reports</a></li> -->
    <?php endif; ?>
</ul>