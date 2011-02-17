<?php
if($user_vehicle == false)
{
?>
    <div class="new-post" id="add-car">
        <a href="#" id="add-car-event">Add My Car</a>
    </div>
<?php
}
else
{
?>
    <div class="new-post" id="remove-car">
        <a href="#" id="remoce-car-event">Remove My Car</a>
    </div>
<?php
}
?>