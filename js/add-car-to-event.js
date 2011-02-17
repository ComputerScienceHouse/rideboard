/**
 * Created by JetBrains PhpStorm.
 * User: seanmcgary
 * Date: 2/13/11
 * Time: 3:22 PM
 * To change this template use File | Settings | File Templates.
 */
Ext.onReady(function(){});

$(document).ready(function(){
    $('#add-car').live('click', function(){
        $("#add-car-modal").modal({
            opacity:60,
	        overlayCss: {backgroundColor:"#7f7f7f"},
            overlayClose:true
        });
    });

    $('[class*="seat-button-"]').live('click', function(){
        var seat_data = $(this).attr('value').split("_");
        var seat_num = seat_data[1];
        var car_id = seat_data[0];

        Ext.Ajax.request({
            url: select_seat,
            success: function(response, opts)
            {
                var obj = Ext.decode(response.responseText);

                if(obj.status == 'true')
                {
                    $('#event_vehicles').html('');
                    $('#event_vehicles').append(obj.event_vehicles);
                }
                else
                {
                    $('#status-console').html('');
                    $('#status-console').append('<span class="error">'+obj.msg+'</span>');

                }
            },
            failure: function(response, opts)
            {
                var obj = Ext.decode(response.responseText);
            },
            params: {data: Ext.encode({seat_num: seat_num, car_id: car_id, event_id: event_id})}
        });

        setTimeout(function(){
            $('#status-console').html('');
        }, 4000);

    });

    $('#remove-car').live('click', function(){
        Ext.Ajax.request({
            url: delete_car,
            success: function(response, opts)
            {
                var obj = Ext.decode(response.responseText);

                if(obj.status == 'true')
                {
                    $('#event_vehicles').html('');
                    $('#event_vehicles').append(obj.event_vehicles);

                    $('#left-col').html('');
                    $('#left-col').append(obj.car_button);
                }
                else
                {
                    $('#status-console').html('');
                    $('#status-console').append('<span class="error">'+obj.msg+'</span>');
                }
            },
            failure: function(response, opts)
            {
                var obj = Ext.decode(response.responseText);
            },
            params: {data: Ext.encode({vehicle_id: user_vehicle_id, event_id: event_id})}
        });
        setTimeout(function(){
            $('#status-console').html('');
        }, 4000);
    });


    $('#submit-add-car').live('click', function(){
        var seat_list = $('ul#modify-seats li');

        var seats = [];

        seat_list.each(function(index){
            seats.push($(this).children('select').val());
        });

        var post = {vehicle_id: user_vehicle_id, seats: Ext.encode(seats), event_id: event_id};
        console.log(post);
        $('#vehicle_container').toggle();
        $('#vehicle-spinner').toggle();
        Ext.Ajax.request({
            url: add_vehicle,
            success: function(response, opts)
            {
                var obj = Ext.decode(response.responseText);

                if(obj.status == "true")
                {
                    $('#event_vehicles').html('');
                    $('#event_vehicles').append(obj.event_vehicles);

                    $('#left-col').html('');
                    $('#left-col').append(obj.car_button);
                }

                setTimeout(function(){
                    $.modal.close();
                }, 1000);

                console.log(obj);
            },
            failure: function(response, opts)
            {
                var obj = Ext.decode(response.responseText);
            },
            params: post
        });

        return false;
    });
});