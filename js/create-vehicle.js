/**
 * Created by JetBrains PhpStorm.
 * User: seanmcgary
 * Date: 2/5/11
 * Time: 9:32 PM
 * To change this template use File | Settings | File Templates.
 */
Ext.onReady(function(){});

$(document).ready(function(){
    var seats_div = $('#seats');

    $('#num_seats').change(function(){
        console.log($(this).val());

        seats_div.html('');
        var num_seats = $(this).val();
        for(var i = 0; i < num_seats; i++)
        {

            var seat = '<div class="seat">'+ (i+1) +'. <select name="seat_type_' + (i+1) +'" id="seat_type_' + (i+1) +'"><option value="Regular">Regular</option><option value="VIP">VIP</option><option value="Bitch">Bitch</option></select></div>';

            seats_div.append(seat);
        }
    });



    $('#create-vehicle').submit(function(){
        var elements = $(this).find('input:text, select.num_seats, select.type');
        var seat_configs = $(this).find('[id*="seat_type_"]');
        var status = $('#create-car-status');
        var data = {};

        elements.each(function(index){
            data[$(this).attr('name')] = $(this).val();
        });

        data.seats = [];

        seat_configs.each(function(index){
            console.log($(this).val());
            data.seats.push($(this).val());
        });

        if($('#vehicle_name').val().length < 1)
        {
            //error
            $('#create-car-status').html('');
            $('#create-car-status').append('<span class="error">Please give your car a name</span>');

        }
        else
        {
            Ext.Ajax.request({
                url:create_vehicle,
                success: function(response, opts)
                {
                    var obj = Ext.decode(response.responseText);
                    console.log(obj);
                    if(obj.status == 'true')
                    {

                        console.log('success');
                        //window.location = obj.redirect;
                        //$('#post-container').html("");
                        //$('#post-container').append(obj.posts);

                        $('#main-with-left').html('');
                        $('#main-with-left').append(obj.vehicles);

                    }
                    else
                    {
                        status.append(obj.msg);
                        $('#posting').toggle('fast');
                    }
                },
                failure: function(response, opts)
                {
                    var obj = Ext.decode(response.responseText);
                },
                params: {vehicle_data: Ext.encode(data)}
            });
        }

        return false;
    });
});