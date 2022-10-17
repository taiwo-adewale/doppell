<aside id="side-bar">
    <!-- SEARCH BAR -->
    <div class="search-bar-container">
        <div class="search-bar">
            <form action="">
                <input type="search" placeholder="Search...">
                <button><i class="fas fa-search"></i></button>
            </form>
        </div>
    </div>

    <div class="recent-posts">
        <h2>Recent Posts</h2>

        <ul>
            
            <?php foreach($posts as $post): ?>
                <li>
                <!-- PHP FOR ALL ANCHOR TAGS -->
                    <a href="post-details.php?potitle=<?php echo $post['post_slug']; ?>"><?php echo $post['post_title']; ?></a>
                </li>
            <?php endforeach; ?>

        </ul>
    </div>

    <div class="recent-comments">
        <h2>Recent Comments</h2>

        <p>No comments to show.</p>

        <ul>

        </ul>
    </div>
</aside>