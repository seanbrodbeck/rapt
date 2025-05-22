// fix video add button
setInterval(function(){
if(jQuery('#html5-video-input-modal').css('display') == 'block') {
jQuery('#html5-video-input-modal').find('.add-video-btn').removeAttr('disabled');
}
}, 1000);
