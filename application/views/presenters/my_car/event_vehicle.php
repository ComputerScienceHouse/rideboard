<h1>Your Vehicle</h1>
<div class="vehicle-view">
    <div class="vehicle-name">
        <?=$vehicle['vehicle_name']?> - <span class="vehicle-type">(<?=$vehicle['vehicle_type']?>)</span>
    </div>
    <div class="seat-view">
        <ul id="modify-seats">
    <?php
    $types = array('Regular', 'VIP', 'Bitch');
    foreach($vehicle['seats'] as $seat)
    {

        $dropdown = '<select name="seat-config" id="seat-config">';
        foreach($types as $type)
        {
            if($type == $seat)
            {
                $dropdown .= '<option value="'.$type.'" selected>'.$type.'</option>';
            }
            else
            {
                $dropdown .= '<option value="'.$type.'">'.$type.'</option>';
            }
        }

        $dropdown .= '</select>';

        echo '<li>'.$dropdown.'</li>';
    }
    ?>
        </ul>
    </div>
</div>