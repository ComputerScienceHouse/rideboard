/**
 * Created by JetBrains PhpStorm.
 * User: seanmcgary
 * Date: 1/27/11
 * Time: 1:49 AM
 * To change this template use File | Settings | File Templates.
 */
Ext.onReady(function(){});

$(document).ready(function(){

    $('#event_date').datepicker({altFormat: '@'});
    

    $('a#new-event-link, #new-event').click(function(){
        $("#new-event-modal").modal({
            opacity:60,
	        overlayCss: {backgroundColor:"#7f7f7f"},
            overlayClose:true
        });

        return false;
    });

    $('#new-event-form').submit(function(){
        var status = $('#new-event-status');
        status.html("");
        

        var fields = $(this).find('.event_name, .event_date');
        console.log(fields);

        var required_error = false;

        fields.each(function(index){
            if($(this).val().length == 0)
            {
                required_error = true;
            }
        });


        if(required_error == true)
        {
            status.append('<span class="error">Please fill out all fields</span>');
        }
        else
        {

            $('#posting').toggle('fast');


            Ext.Ajax.request({
                url: create_new_event,
                form: 'new-event-form',
                success: function(response, opts)
                {
                    var obj = Ext.decode(response.responseText);
                    if(obj.status == 'true')
                    {
                        //status.append(obj.msg);
                        $('#posting').toggle('fast');

                        setTimeout(function(){
                            $.modal.close();
                        }, 1000);
                        console.log('success');
                        //window.location = obj.redirect;
                        //$('#post-container').html("");
                        //$('#post-container').append(obj.posts);

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

                    //console.log(obj);
                    //status.append(obj.msg);
                    //$('#posting').toggle('fast');
                }
            });
        }


        return false;
    });
});