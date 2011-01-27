<?php
//Util::printr($posts);
$counter = 1;
foreach($posts as $post)
{
?>
<div class="flat-post">
    <div class="post-number">
        <?=$counter?>
    </div>
    <div class="meta-container">
        <div class="title">
            <a href="#"><?=$post['post_title']?></a> <a href="#" class="source">(self.groupname)</a>
        </div>
        <div class="sub-title">
            posted 5 hours ago by <?=$post['username']?> to groupname
        </div>
        <div class="sub-sub-title">
            <ul>
                <li>1337 replies</li>
                <li>save</li>
                <li>report</li>
            </ul>
        </div>
    </div>
</div>
<?php
$counter++;
}
?>