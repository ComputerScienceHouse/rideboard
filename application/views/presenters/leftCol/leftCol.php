<ul>
    <?php
    foreach($groups as $group)
    {
    ?>
    <li>
        <div class="item">
            <?=$group['group_name']?>
        </div>
    </li>
    <?php
    }
    ?>
</ul>