/**
 * Created by JetBrains PhpStorm.
 * User: seanmcgary
 * Date: 1/27/11
 * Time: 1:49 AM
 * To change this template use File | Settings | File Templates.
 */
Ext.onReady(function(){});

$(document).ready(function(){
    $('a#new-post-link, #new-post').click(function(){
        $("#new-post-modal").modal({
            opacity:60,
	        overlayCss: {backgroundColor:"#7f7f7f"},
            overlayClose:true
        });

        return false;
    });

    $('#new-post-form').submit(function(){
        var status = $('#new-post-status');
        status.html("");
        $('#posting').toggle('fast');

        Ext.Ajax.request({
            url: create_new_post,
            form: 'new-post-form',
            success: function(response, opts)
            {
                var obj = Ext.decode(response.responseText);
                if(obj.status == 'true')
                {
                    status.append(obj.msg);
                    $('#posting').toggle('fast');

                    setTimeout(function(){
                        $.modal.close();
                    }, 1000);

                    $('#post-container').html("");
                    $('#post-container').append(obj.posts);

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
                status.append(obj.msg);
                $('#posting').toggle('fast');
            }
        });

        return false;
    });
});