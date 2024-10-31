//COPYRIGHT © SkyBlow Company VATIN: PL5170154130 www.it.skyblow.com, www.ofeatures.com

function scrollToElement(selector, time, offset) {
    jQuery('html, body').animate({
        scrollTop: jQuery(selector).offset().top - offset
    }, time);
}

function scrollToEveryPage(copyCode) {
    if (copyCode == true){       
       var oldPlaceholder = jQuery('#ofeatures_footer').attr('placeholder')
       
       jQuery('#ofeatures_footer').attr('placeholder', 'Adding the Shortcode...')
       
       setTimeout(function(){
            var t = jQuery(".code-block .code:visible").text()
            var empty = jQuery('#ofeatures_footer').val() == ""
            jQuery('#ofeatures_footer').val(jQuery('#ofeatures_footer').val()+(empty ? "" : "\n") + t)
            jQuery('#ofeatures_footer').addClass('pasted')
            
            setTimeout(function(){
                 jQuery('#ofeatures_footer').removeClass('pasted')
                 jQuery('#ofeatures_footer').attr('placeholder', oldPlaceholder)
            }, 1000)
       }, 2500)
    }
    
    jQuery('.every-place-block').fadeIn()
    jQuery('html, body').animate({
        scrollTop: jQuery(".every-place-block").offset().top - 70
    }, 1500);
    
    jQuery('.show-every-page-button').fadeOut()
}

jQuery.fn.selectText = function() {
    this.find('input').each(function() {
        if ($(this).prev().length == 0 || !$(this).prev().hasClass('p_copy')) {
            $('<p class="p_copy" style="position: absolute; z-index: -1;"></p>').insertBefore($(this));
        }
        $(this).prev().html($(this).val());
    });
    var doc = document;
    var element = this[0];
    console.log(this, element);
    if (doc.body.createTextRange) {
        var range = document.body.createTextRange();
        range.moveToElementText(element);
        range.select();
    } else if (window.getSelection) {
        var selection = window.getSelection();
        var range = document.createRange();
        range.selectNodeContents(element);
        selection.removeAllRanges();
        selection.addRange(range);
    }
}

var invokeAction = function(params, successCallback, failCallback, alwaysCallback, method) {
    if (method == undefined || method == null)
        method = 'POST';

    jQuery.post(ajaxurl, params).done(function(data) {
        if (successCallback != undefined && successCallback != null)
            successCallback(data)
    }).fail(function(xhr, textStatus, errorThrown) {
        if (failCallback != undefined && failCallback != null)
            failCallback();
        else
            console.log("Cannot execute request " + textStatus + errorThrown);
    }).always(function() {
        if (alwaysCallback != undefined && alwaysCallback != null)
            alwaysCallback()
    });
}

function synchronize(ofeatures_configuration_no_features_info, currentDomain, pluginType) {
    invokeAction({
        action: "synchronize_ofeatures",
        plugintype: pluginType
    }, function(data) {
    
        var syncAgainInfo = '<br/><br/><button class="button button-default" type="submit">Try again <i class="fa fa-refresh"></i></button>' 
    
        if (data == "no-access-rights") {
            jQuery('.preloader img').fadeOut()
            jQuery('.preloader .text').html("Cannot synchronize. Please provide the correct plugin access data." + syncAgainInfo)
            return
        }
        if (data == "no-features-found") {
            jQuery('.preloader img').fadeOut()
            var noFeaturesInfo = ofeatures_configuration_no_features_info.replace("[DOMAIN]", currentDomain)
            jQuery('.preloader .text').html("<span>" + noFeaturesInfo + "</span>" + syncAgainInfo)
            return
        }
                
        jQuery('.preloader').fadeOut()
        jQuery('.ok-status').fadeIn()
        jQuery('.features').append(data)
        jQuery('.code').click(function() {
            jQuery(this).selectText()
        })
        
        if (jQuery('.feature-block').length == 1){
            jQuery('.feature-block').click()
        }else{
            scrollToElement('.ok-status', 2000, 60)
        }

    }, null, function() {
    })
}


function showLanguages(button, languageIndex, featureId){
    
    var selector = " .feature-index-" + featureId;
    jQuery(selector).fadeIn()
    jQuery(button).fadeOut()
}

window.showFeatureCode = function(){   
    jQuery('.code-block').hide()
    
    if (window.selectedFeature != null){
        jQuery('.code-block[lang-id="'+ window.selectedLangId+'"][feature-id="'+window.selectedFeature+'"]').fadeIn(1000)
    }
}

window.addFeature = function (e){
     window.selectedFeature = jQuery(e).attr('feature-id');
     jQuery('.code-block').hide();
     jQuery('.languages-selection').fadeIn(800);
     
     scrollToElement('.features', 2000, 100);
     window.showFeatureCode()
}

window.languageClicked = function (e){
    jQuery('.lang-button').removeClass('active');
    jQuery(e).addClass('active');
    
    window.selectedLangId = jQuery(e).attr('lang-id');
    window.showFeatureCode()
}

function remove_excluded(id){
    jQuery("[excludedid='" + id + "']").remove()
    var val = jQuery(".excluded-page-ids").val()
    val = val.replace(id, '').replace(' ', '').replace(',,',',').replace(/^,/ ,'').replace(/,$/ ,'')
    jQuery(".excluded-page-ids").val(val)
}

document.addEventListener('DOMContentLoaded', function() {
    var ytpath = 'yekJaYSxlz8'
    var ytratio = 9/16;

    function onPlayerStateChange(event) {
      if (event.data == YT.PlayerState.ENDED) {
        event.target.playVideo();
      }
    }
    
    function onPlayerReady (event) {
        event.target.seekTo(0)
        event.target.setPlaybackQuality('hd720')
        event.target.playVideo();
        event.target.setPlaybackQuality('hd720')
        event.target.setLoop(true)
        jQuery('.video-box').width('500')
        jQuery('.video-box').fadeIn()
    }

    function showYT(){
    
        window.player = new YT.Player('video-box-id', {
          height: '220',
          videoId: ytpath,
          playerVars: { 'autoplay': 1
            , modestbranding:1  
            ,theme:'light', 'showinfo': 0, 'controls': 1 },
          events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
          }
        });
        jQuery('.video-title').show()
        jQuery('.show-video').hide()
        setTimeout(function(){
            jQuery('#youtube-video').width('500')
            jQuery('#youtube-video').show()
            
          
        },100)
        setTimeout(function(){
            jQuery('.maximize-button').fadeIn()
        },2500)
    }
    
    window.showYT = showYT

    setInterval(function(){
        var w = jQuery('.video-box').width()
        var h = w * ytratio;
        jQuery('.video-box').height(h)
    }, 500) 

    setTimeout(function(){
        if (window.ofeatures_config_counter == 1){
            if (jQuery('.video-box').length > 0){
                showYT()
            }
        }else{
            jQuery('.show-video').show()
        }
    }, 500)
    
    window.maximizeVideo = function(){
        jQuery('.video-box').width('90%')
        jQuery('.maximize-button.max').hide()
    }
    
    window.hideVideo = function(){
        jQuery('.video-box').remove();
        jQuery('.maximize-button').hide()
    }
    
});