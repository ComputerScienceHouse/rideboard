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
            <a href="<?=site_url('g/'.$post['group']['group_name'].'/post/'.$post['post_id'])?>"><?=$post['post_title']?></a> <a href="#" class="source">(<?=$post['group']['group_name']?>)</a>
        </div>
        <div class="sub-title">
            posted <?=timespan($post['date_posted'])?> ago by <?=$post['username']?>
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
    <br>
<?php
$counter++;
}
?>