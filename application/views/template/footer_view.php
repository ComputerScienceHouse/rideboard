</div>
<script type="text/javascript">
    var create_new_post = '<?=site_url('post_processor/new_post')?>';
</script>
<div id="new-post-modal" class="modal">
    <div class="modal-container">
        <form name="new-post-form" id="new-post-form">
            <div class="div-row clearboth">
                <div class="label">
                    Post Title:
                </div>
                <div class="field">
                    <input type="text" name="post_title" id="login-username">
                </div>
            </div>
            <div class="div-row clearboth">
                <div class="label">
                    Group:
                </div>
                <div class="field">
                    <?=$group_dropdown?>
                </div>
            </div>
            <div class="div-row clearboth">
                <div class="label">
                    Content:
                </div>
                <div class="field-large">
                    <textarea name="post_content" id="post_content"></textarea>
                </div>
            </div>
            <div class="div-row clearboth">
                <div class="label">
                    <input type="submit" class="button-blue float-left" value="Post" id="submit-login">
                </div>
                <div class="field" id="new-post-status">
                    <span class="error" id="login-error"></span>
                </div>

            </div>
        </form>
        <div class="modal-spinner clearboth" id="posting">
            <div class="spinner">
                <img src="<?=site_url('css/images/ajax-loader.gif')?>">
            </div>
            <div class="loading-text">
                Posting...
            </div>
        </div>
    </div>
</div>
</body>
</html>