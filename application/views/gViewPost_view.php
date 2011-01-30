<div id="main-with-left">
    <script type="text/javascript">
        var root_id = '<?=$post['post_id']?>';
        var reply_submit = '<?=site_url('post_processor/post_reply')?>';
        var current_group = '<?=$post['group_id']?>';
        var root_title = '<?=$post['post_title']?>';
    </script>
    <div class="flat-post">
        <div class="meta-container">
            <div class="title">
                <a href="<?=site_url('g/'.$post['group']['group_name'].'/post/'.$post['post_id'])?>"><?=$post['post_title']?></a> <a href="#" class="source">(<?=$post['group']['group_name']?>)</a>
            </div>
            <div class="sub-title">
                posted <?=timespan($post['date_posted'])?> ago by <?=$post['username']?>
            </div>
            <div class="post-content">
                <?=$post['post_content']?>
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
    
    <div class="top-reply">
        <form name="top-reply-form" id="top-reply-form" value="<?=$post['post_id']?>">
            <div class="div-row">
                <textarea name="reply_content" id="reply_content"></textarea>
            </div>
            <div class="div-row clearboth">
                <input type="submit" class="button-blue-small" value="Reply">
            </div>
        </form>
    </div>
    <div id="post-replies" class="post-replies">
        <?=$replies?>
    </div>

</div>