<h1>Your Vehicle</h1>
<div class="vehicle-view">
    <div class="vehicle-name">
        <?=$vehicle['vehicle_name']?> - <span class="vehicle-type">(<?=$vehicle['vehicle_type']?>)</span>
    </div>
    <div class="seat-view">
        <ul>
    <?php
    foreach($vehicle['seats'] as $seat)
    {
        echo '<li>'.$seat.'</li>';
    }
    ?>
        </ul>
    </div>
</div>
<h1>Manage VIP's</h1>