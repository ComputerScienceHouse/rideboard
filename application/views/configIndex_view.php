<div id="main-with-left">
    <script type="text/javascript">
        var create_group = '<?=site_url('config/create_group')?>';
    </script>
    <h1>Create Group</h1>
    <div class="form-container">
        <form name="create-group" id="create-group">
            <div class="row">
                <div class="label">
                    Group Name
                </div>
                <div class="field">
                    <input type="text" name="group_name" id="group_name">
                </div>
            </div>
            <div class="row">
                <div class="label" id="group-response">
                </div>
                <div class="field">
                    <input type="submit" class="button-blue float-right" value="Create Group">
                </div>
            </div>
        </form>
    </div>
    <br>
    <h1>Current Groups</h1>
    <div id="group-list">
        <?=$groups_table?>
    </div>
</div>