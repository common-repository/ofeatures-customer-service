<?php

if (!function_exists('support_panel_ofeatures_html_page')){
    
    function support_panel_ofeatures_html_page() {
        $clientId = get_option('ofeatures_clientid');
        global $plugin_name;
        global $settings_label;

        if (get_option('ofeatures_clientid')){ ?>
            <a class="settings-button" style='display: none' href='options-general.php?page=ofeatures-customer-service'>&nbsp;<i class="fa fa-cogs" aria-hidden="true"></i> oFeatures plugin settings &nbsp;
            </a>
                
            <br/><br/>
            <img alt="" style="border-radius: 6px; margin-left:20px;" src="<?php echo plugins_url() . "/".$plugin_name;?>/ofeatures-wp-core/img/ofeatures-logo-128px128px.png" /><br/>
            <h4 class="" style="margin-left:20px;">
                <?php _e("Loading Support Panel...")?><br/>
                <img  alt="" src="<?php echo plugins_url() . "/".$plugin_name;?>/ofeatures-wp-core/img/preloader.gif" />
            
            </h4>
              
            <iframe style=""  id="ofeatures-frame"></iframe>

            <script>
               var clientBasePanelUrl = "https://<?php echo $clientId ?>.panel.ofeatures.com";

               jQuery('#ofeatures-frame').attr('src', clientBasePanelUrl + "/skyblow.clientbackend/customerservice/alert")
               jQuery('#ofeatures-frame').on('load', function(){
                   jQuery(".support-panl-preloader").hide()  
               })

                //Backward Wordpress compatibility
                function updateSupportPanelArea(){
                    //size
                    jQuery('#ofeatures-frame').height(jQuery(window).height() - jQuery('#ofeatures-frame').offset().top)
                    
                    if (jQuery(window).width() != jQuery(document).width() || jQuery('.wp-responsive-open').length > 0){
                        jQuery('#ofeatures-frame').width(jQuery(window).width() - jQuery('#ofeatures-frame').offset().left) 
                    }else{
                        jQuery('#ofeatures-frame').width('')
                    }
                    
                    //position
                    if (jQuery('#wp-admin-bar-menu-toggle').length == 0){
                        var leftMenuWidth = jQuery('#adminmenuwrap').width()
                        jQuery('#wpcontent').css('margin-left',leftMenuWidth)
                    }

                    if (jQuery('#wpadminbar').css('position') == "absolute"){
                        jQuery('#ofeatures-frame').css('top',jQuery('#wpadminbar').height())
                    }else{
                        jQuery('#ofeatures-frame').css('top', 0)
                    }
                }
               
                setInterval(function(){
                    updateSupportPanelArea()
                }, 1000)               
               
                jQuery('#collapse-menu, #wp-admin-bar-menu-toggle').click(function(){
                    setTimeout(updateSupportPanelArea, 50)
                })
                
                updateSupportPanelArea()
                
                jQuery(window).resize(function(){
                    updateSupportPanelArea()
                })
            </script>
            
            <style>
                #wpcontent{
                   padding-left:0px;
                }

                .auto-fold #wpcontent {
                   padding-left:0px;
                }
            </style>
            
<?php    } else { ?>
            
  
            <br/><br/>
            <script>
                window.ofeatures_config_counter = <?php echo increase_and_get_config_counter() ?>
            </script>
            <img alt="" style="border-radius: 6px; opacity:1!important" src="<?php echo plugins_url() . "/".$plugin_name;?>/ofeatures-wp-core/img/ofeatures-logo-128px128px.png" /><br/>
            <h2>
                <?php echo (_e("Please provide oFeatures access data in settings: ") 
                    . "Left menu <i class='fa fa-arrow-circle-right'></i> Settings <i class='fa fa-arrow-circle-right'></i> <a href='options-general.php?page=ofeatures-customer-service'> oFeatures settings</a>") ?><br/>
                
            </h2>
            <h3 style="display:none" class="show-video" onclick="window.showYT()">
                Video guide about this plugin. <i class="fa fa-youtube-play"></i>
            </h3>
            <h3 style="margin-bottom:0px; margin-top:30px;display:none" class="video-title">
                 How to use this plugin - video guide.
            </h3>
            <div class="video-box" id="video-box-id" ></div> <br/>
            <div onclick="window.maximizeVideo()" style="vertical-align: 10px; display:none" class="maximize-button button button-primary">Maximize this video <i class="fa fa-expand"></i></div>
             <h3>
                <br/>
                <br/>
                                
                <?php echo (_e("You can contact us at any time to get support, leave feedback, request feature or functionality:")) ?><br/><br/>
                - <?php echo (_e("Skype support")) ?>: <a href="skype:ofeatures.support?add">ofeatures.support</a><br/>
                - <?php echo (_e("On our website")) ?>: <a target="_blank" href="http://ofeatures.com">ofeatures.com</a>
                
            </h3>            
          

<?php   }
    }
}
?>