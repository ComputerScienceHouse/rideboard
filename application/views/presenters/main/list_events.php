<?php
$counter = 1;
foreach($events as $event)
{
?>
<div class="flat-post">
    <div class="post-number">
        <?=$counter?>
    </div>
    <div class="meta-container">
        <div class="title">
            <a href="<?=site_url('event/'.$event['event_id'])?>"><?=$event['event_name']?></a>
        </div>
        <div class="sub-title">
            date <?=unix_to_human($event['event_date'])?>
        </div>
    </div>
</div>
    <br>
<?php
$counter++;
}
?>