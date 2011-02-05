<div id="left-col">
    <?php
    if(isset($_SESSION['loggedIn']))
    {
    ?>
    <div class="new-post" id="new-post">
        <a href="#" id="new-post-link">Create New Post</a>
    </div>
    <?php
    }
    ?>
    <div class="heading">
        Groups
    </div>
    <div class="content" id="groups">
        <?=$groups?>
    </div>
</div>