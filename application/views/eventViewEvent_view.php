<div id="main-with-left">
    <div class="flat-post">
        <div class="meta-container">
            <div class="meta-container">
                <div class="title">
                    <a href="<?=site_url('event/'.$event['event_id'])?>"><?=$event['event_name']?></a>
                </div>
                <div class="sub-title">
                    Date <?=Util::format_date($event['event_date'])?> | Location: <a href="#"><?=$event['event_location']?></a>
                </div>
                <div class="post-content">
                    <?=Markdown($event['event_desc'])?>
                </div>
            </div>
        </div>
    </div>
    <div id="event_vehicles">
        
    </div>
</div>