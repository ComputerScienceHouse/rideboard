</div>
<script type="text/javascript">
    var create_new_event = '<?=site_url('post_processor/new_event')?>';
</script>
<div id="new-event-modal" class="modal">
    <div class="modal-container">
        <form name="new-event-form" id="new-event-form">
            <div class="div-row clearboth">
                <div class="label">
                    Name*:
                </div>
                <div class="field">
                    <input type="text" name="event_name" id="event_name" class="event_name">
                </div>
            </div>
            <div class="div-row clearboth">
                <div class="label">
                    Date*:
                </div>
                <div class="field">
                    <input type="text" name="event_date" id="event_date" class="event_date">
                </div>
            </div>
            <div class="div-row clearboth">
                <div class="label">
                    Address:
                </div>
                <div class="field">
                    <input type="text" name="event_location" id="event_location">
                </div>
            </div>
            <div class="div-row clearboth">
                <div class="label">
                    Description:
                </div>
                <div class="field-large">
                    <textarea name="event_desc" id="event_desc"></textarea>
                </div>
            </div>
            <div class="div-row clearboth">
                <div class="label">
                    <input type="submit" class="button-blue float-left" value="Create Event" id="submit-event">
                </div>
                <div class="field">
                    <div class="text" id="new-event-status">
                        <span class="error" id="login-error"></span>
                    </div>
                </div>
            </div>
        </form>
        <div class="modal-spinner clearboth" id="posting">
            <div class="spinner">
                <img src="<?=site_url('css/images/ajax-loader.gif')?>">
            </div>
            <div class="loading-text">
                Processing...
            </div>
        </div>
    </div>
</div>
</body>
</html>