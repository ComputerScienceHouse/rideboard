<div id="main-with-left">
    <script type="text/javascript">
        var event_id = '<?=$event['event_id']?>';
        var user_vehicle_id = '<?=$user_vehicle_data['vehicle_id']?>';
        var add_vehicle = '<?=site_url('post_processor/add_vechicle')?>';
    </script>
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
    <div id="event_vehicles" class="event_vehicles">
        <?=$event_vehicles?>
    </div>
</div>
<?=$add_car_modal?>