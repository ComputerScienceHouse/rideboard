<ul>
    <?php
    foreach($groups as $group)
    {
    ?>
    <li>
        <div class="item">
           <a href="<?=site_url('g/'.$group['group_name'])?>"><?=$group['group_name']?></a>
        </div>
    </li>
    <?php
    }
    ?>
</ul>