/**
 * Created by JetBrains PhpStorm.
 * User: seanmcgary
 * Date: 1/29/11
 * Time: 8:35 PM
 * To change this template use File | Settings | File Templates.
 */
Ext.onReady(function(){});

$(document).ready(function(){
    $('.toggle-reply').live('click', function(){
        var post_id = $(this).attr('value');

        console.log(post_id);
        var reply_div = '#reply_' + post_id;
        $(reply_div).toggle();
        return false;
    });

    $('.local-reply-form').live('submit', function(){
        var form_id = $(this).attr('id');
        var post_id = $(this).attr('value');

        var extras = {
            parent_id: post_id,
            root_post_id: root_id,
            group_id: current_group,
            post_title: root_title
        }

        Ext.Ajax.request({
            url: reply_submit,
            form: form_id,
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