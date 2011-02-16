<?php
foreach($vehicles as $vehicle)
{
?>

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
<?php
}
?>