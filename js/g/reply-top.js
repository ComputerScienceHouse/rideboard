/**
 * Created by JetBrains PhpStorm.
 * User: seanmcgary
 * Date: 1/27/11
 * Time: 3:16 PM
 * To change this template use File | Settings | File Templates.
 */
Ext.onReady(function(){});

$(document).ready(function(){

    $('#top-reply-form').submit(function(){

        var extras = {
            parent_id: $(this).attr('value'),
            root_post_id: root_id,
            group_id: current_group,
            post_title: root_title
        }

        Ext.Ajax.request({
            url: reply_submit,
            form: $(this).attr('name'),
            success: function(response, opts)
            {
                var obj = Ext.decode(response.responseText);
                if(obj.status == 'true')
                {
                    //alert('success!!');
                    $('#post-replies').html("");
                    $('#post-replies').append(obj.replies);

                    $('#reply_content').val("");
                }
                else
                {

                }
            },
            failure: function(response, opts)
            {
                var obj = Ext.decode(response.responseText);
            },
            params: extras
        });

        return false;
    });
});