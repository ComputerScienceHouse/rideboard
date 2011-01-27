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
});