<select name="groups" id="groups">
<?php
foreach($groups as $group)
{
    echo '<option value="'.$group['group_id'].'">'.$group['group_name'].'</option>';
}
?>
</select>