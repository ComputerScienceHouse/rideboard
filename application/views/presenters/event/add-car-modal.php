<div id="add-car-modal" class="modal">
    <div class="modal-container">
        <div id="vehicle_container">
            <?=$user_vehicle?>
            <div class="div-row clearboth">
                <div class="label">
                    <input type="submit" class="button-blue-small float-left" value="Add Vehicle" id="submit-add-car">
                </div>
                <div class="field">
                    <div class="text" id="new-event-status">
                        <span class="error" id="login-error"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-spinner clearboth" id="vehicle-spinner">
            <div class="spinner">
                <img src="<?=site_url('css/images/ajax-loader.gif')?>">
            </div>
            <div class="loading-text">
                Processing...
            </div>
        </div>
    </div>
</div>