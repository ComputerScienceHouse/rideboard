<script type="text/javascript">
    var delete_car = '<?=site_url('my_car/delete_car')?>';
</script>
<div id="main-with-left">
    <?php
        if($exists)
        {
            echo $view_vehicle;
        }
        else
        {
            echo $create;
        }
    ?>
</div>