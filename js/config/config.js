/**
 * Created by JetBrains PhpStorm.
 * User: seanmcgary
 * Date: 1/27/11
 * Time: 1:00 AM
 * To change this template use File | Settings | File Templates.
 */
Ext.onReady(function(){});

$(document).ready(function(){
    $('#create-group').submit(function(){
        console.log('foobar');
        
        Ext.Ajax.request({
            url: create_group,
            form: 'create-group',
            success: function(response, opts)
            {
                var obj = Ext.decode(response.responseText);

                if(obj.status == 'true')
                {
                    $('#group-response').html("");
                    $('#group-response').append(obj.msg);

                    $('#group-list').html("");
                    $('#group-list').append(obj.groups);

                    setTimeout(function(){
                        $('#group-response').html("");
                    }, 2000);

                }
                else
                {
                    $('#group-response').html("");
                    $('#group-response').append(obj.msg);
                }
                
            },
            failure: function(response, opts)
            {
                var obj = Ext.decode(response.responseText);

                $('#group-response').html("");
                $('#group-response').html(obj.msg);
            }
        });

        return false;
    });
});