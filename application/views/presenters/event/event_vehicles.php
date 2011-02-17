<?php
foreach($vehicles as $vehicle)
{
    //Util::printr($vehicle);
    $outline = "";
    if($vehicle['user_id'] == $_SESSION['loggedIn']['user_id'])
    {
        $outline = ' your-vehicle';
    }

?>

<div class="vehicle-view<?=$outline?>">
    <div class="vehicle-name">
        <?=$vehicle['vehicle_name']?> - <span class="vehicle-type">(<?=$vehicle['vehicle_type']?>)</span>
    </div>
    <div class="seat-view">
        <ul>
    <?php
    $count = 0;
    foreach($vehicle['seats'] as $seat)
    {
        if($seat == "Regular")
        {
            echo '<li><div class="seat-button-reg" value="'.$vehicle['vehicle_id'].'_'.$count.'">Regular (Add)</div></li>';
        }
        else if($seat == "VIP")
        {
            echo '<li><div class="seat-button-vip" value="'.$vehicle['vehicle_id'].'_'.$count.'">VIP (Add)</div></li>';
        }
        else if($seat == "Bitch")
        {
            echo '<li><div class="seat-button-bitch" value="'.$vehicle['vehicle_id'].'_'.$count.'">Bitch (Add)</div></li>';
        }
        else
        {
            echo '<li>'.$seat.'</li>';
        }

        $count++;

        //echo '<li>'.$seat.'</li>';
    }
    ?>
        </ul>
    </div>
</div>
<?php
}
?>