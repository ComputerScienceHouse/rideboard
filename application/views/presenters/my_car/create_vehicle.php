<script type="text/javascript">
    var create_vehicle = '<?=site_url('post_processor/create_vehicle')?>';
</script>

<h1>Create Vehicle</h1>
<div class="form-container">
    <form name="create-vehicle" id="create-vehicle">
        <div class="row clearboth">
            <div class="label">
                Name
            </div>
            <div class="field">
                <input type="text" name="vehicle_name" id="vehicle_name">
            </div>
        </div>
        <div class="row clearboth">
            <div class="label">
                Type
            </div>
            <div class="field">
                <select name="vehicle_type" id="vehicle_type" class="type">
                    <option value="Sedan">Sedan</option>
                    <option value="Truck">Truck</option>
                    <option value="Wagon">Wagon</option>
                    <option value="Hatchback">Hatchback</option>
                    <option value="Coupe">Coupe</option>
                    <option value="Van">Van</option>
                    <option value="SUV">SUV</option>
                </select>
            </div>
        </div>
        <div class="row clearboth">
            <div class="label">
                Number of Seats
            </div>
            <div class="field">
                <select name="num_seats" id="num_seats" class="num_seats">
                <?php
                for($i = 0; $i < 10; $i++)
                {
                    echo '<option value="'.($i+1).'">'.($i+1).'</option>';
                }
                ?>
                </select>
            </div>
        </div>
        <div class="row clearboth">
            <div class="label">
                Default Seats
            </div>
            <div class="field">
                <div id="seats">
                    <div class="seat">
                        1. <select name="seat_type_1" id="seat_type_1">
                            <option value="Regular">Regular</option>
                            <option value="VIP">VIP</option>
                            <option value="Bitch">Bitch</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="div-row clearboth">
            <div class="label">
                <input type="submit" class="button-blue float-left" value="Create" id="submit-event">
            </div>
            <div class="field">
                <div class="text">
                    <div class="text" id="create-car-status">
                        <span class="error" id="login-error"></span>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>