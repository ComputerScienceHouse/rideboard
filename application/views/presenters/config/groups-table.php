<table class="group-table">
    <thead>
        <tr>
            <th>Group Name</th>
            <th>Public/Private</th>
            <th>Edit</th>
            <th>Hide</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
    <?php
    foreach($groups as $group)
    {
    ?>
        <tr>
            <td><?=$group['group_name']?></td>
            <td><?=(($group['status'] == 'public') ? 'Public' : 'Private')?></td>
            <td>Edit</td>
            <td>Hide</td>
            <td><a href="#" class="delete">Delete</a></td>
        </tr>
    <?php
    }
    ?>
    </tbody>
</table>