<?php
//COPYRIGHT © SkyBlow Company VATIN: PL5170154130 www.it.skyblow.com, www.ofeatures.com

if (!function_exists('ofeatures_config_page')){
    function ofeatures_config_page($ofeatures_configuration_title
        , $ofeatures_configuration_featuretype
        , $ofeatures_configuration_features_title
        , $ofeatures_configuration_no_features_info
        , $plugin_path
        , $ofeatures_url) { 
        
            //Removing duplicates from ofeatures_footer_excludedpages
            $ofeatures_footer_excludedpages = get_option('ofeatures_footer_excludedpages', '');
            $ofeatures_footer_excludedpages = explode(',', $ofeatures_footer_excludedpages);
            $ofeatures_footer_excludedpages = array_unique($ofeatures_footer_excludedpages);
            $ofeatures_footer_excludedpages = array_filter($ofeatures_footer_excludedpages);
            $ofeatures_footer_excludedpages = implode(',', $ofeatures_footer_excludedpages);
            update_option('ofeatures_footer_excludedpages', $ofeatures_footer_excludedpages);
            $config_counter = increase_and_get_config_counter();
        ?>
        
        <script>
            window.ofeatures_config_counter = <?php echo $config_counter ?>
        </script>
        <br/><br/>
        
        
        <?php if (get_option('ofeatures_clientid')){ ?> 
            

                    <a class="panel-button" style=""  href='admin.php?page=support-panel-ofeatures'>&nbsp;Support Panel </a>

                     <a class="panel-button external" style=""  
                        target="_blank" href='https://<?php echo get_option('ofeatures_clientid') ?>.panel.ofeatures.com/skyblow.clientbackend/customerservice/alert'>
                         <i class="fa fa-external-link" aria-hidden="true"></i> 
                     </a>
        
            <?php } ?>
        
        <img style="border-radius: 4px; width:64px; margin-left:10px;" alt="" src="<?php echo $plugin_path;?>/ofeatures-wp-core/img/ofeatures-logo-128px128px.png" />
        <form  class="ofeatures-form" autocomplete="off" method="post" action="options.php">
            <div>
                <h1 class="ofeatures-config-title"><?php echo $ofeatures_configuration_title;?>  
                <br/>
                <h3 style="margin-bottom:0px; margin-top:30px;display:none" class="video-title">
                    How to use this plugin - video guide.
                </h3>
                <h3 style="display:none" class="show-video" onclick="window.showYT()">
                    Video guide about this plugin. <i class="fa fa-youtube-play"></i>
                </h3>
                
                <span class="video-box" id="video-box-id" >
                </span>     
                <br/>
                <span onclick="window.maximizeVideo()" style="vertical-align: 10px; display:none" class="maximize-button max button button-primary">Maximize video <i class="fa fa-expand"></i></span>
                <span onclick="window.hideVideo()" style="vertical-align: 10px; display:none" class="maximize-button button button-primary">Hide video <i class="fa fa-times"></i></span>
                
                <?php wp_nonce_field('update-options'); ?>
                <h3 class="details-request" style=""><?php _e("Please provide the plugin access data. You can find it in your oFeatures account in Menu > Settings > Plugins")?>
                <?php if (!get_option('ofeatures_clientid')){ ?> 
                    <br/><br/>
                    <span class="no-account-question"><?php _e("Don't Have an Account?")?> <a target="_blank" style="cursor:pointer" href="http://ofeatures.com?utm_source=cms&utm_medium=button-main&utm_campaign=wordpress-plugin"><span style="text-decoration:underline;"><?php _e('Create oFeatures account') ?></span> <i class="fa fa-arrow-circle-right"></i></a></span>
                <?php } ?>  
                
                </h3>
              
                <table>
                    <tr>
                        <td><?php _e("Client id")?></td>
                        <td><input placeholder='<?php _e("oFeatures client id")?>' name="ofeatures_clientid" type="text" id="ofeatures_clientid"
                       value="<?php echo get_option('ofeatures_clientid'); ?>" /></td>
                    </tr>
                    <tr>
                        <td><?php _e("WordPress token")?></td>
                        <td><input placeholder='<?php _e("wordpress token")?>' name="ofeatures_wptoken" type="password" id="ofeatures_wptoken"
                       value="<?php echo get_option('ofeatures_wptoken'); ?>" />
                        </td>
                    </tr>
                </table>
                <input type="hidden" name="action" value="update" />
                <input type="hidden" name="page_options" value="ofeatures_clientid,ofeatures_wptoken,ofeatures_footer,ofeatures_footer_excludedpages" />
                <input type="submit" class='button button-default' value="<?php _e('Save') ?>" />
                <br/>
                <br/>
            </div>
            <h4 class="ok-status" style="display:none">
                <span class="text">
                   <?php _e(" All features have been synchronized.")?> <i class="fa fa-check-circle"></i>  
                   <span onclick="location.reload()" style="font-size:10px; font-weight: normal; text-decoration: underline; color:#777; cursor:pointer; margin-left:10px"><?php _e('synchronize again') ?></span>
                   <br/><b>
                    <?php _e("Every time you change something in your features (for example, the style) please visit this configuration page again to keep your features updated.")?> </b>
                    <br/><br/> 
                    <h3  class="of-step"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> <?php echo $ofeatures_configuration_features_title;?></h3>
                </span>
            </h4>
            <div class="features"></div>
            <?php if (get_option('ofeatures_clientid')){ ?> 
            
            
            
            
                <h4 class="preloader"><span class="text"><?php _e("Synchronizing your features...")?></span><br/>
                    <img style="" alt="" src="<?php echo $plugin_path;?>/ofeatures-wp-core/img/preloader.gif" />
                </h4>
                <script>
                    synchronize("<?php echo $ofeatures_configuration_no_features_info;?>",
                    "<?php echo get_current_domain_no_protocol(); ?>", "<?php echo $ofeatures_configuration_featuretype;?>");
                </script>
            <?php } ?>
                
            <?php if (!get_option('ofeatures_clientid')){ ?> 
                
            <br/>
            <h3><?php _e("Don't Have an Account?")?></h3>
            <a class='button button-primary' target="_blank" href="http://ofeatures.com?utm_source=cms&utm_medium=button-below&utm_campaign=wordpress-plugin"><?php _e('Create oFeatures account') ?></a>
            <br/><br/>
               <?php } ?>
            
            <br/>  <br/> 
            <span class="button button-default show-every-page-button"  onclick="scrollToEveryPage()">Content on all pages <i class="fa fa-angle-down"></i></span>
            <div class="every-place-block" style="display:none" >
                <div class="every-place-content">
                    <h3 class="of-step"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> Place the code on your website.</h3>
                    <h4 style="margin-bottom:5px;"><?php _e(" If your feature is floating paste the Shortcode in this box. Otherwise, paste the code directly to page content.")?></h4>
                    <textarea style="margin-bottom:4px;" placeholder='<?php _e("To add the feature to all pages you can paste the featutre Shortcode in here.")?>' name="ofeatures_footer" id="ofeatures_footer"><?php echo get_option('ofeatures_footer'); ?></textarea>
                    <br/>
                    <input type="submit" class='button button-default' value="<?php _e('Save') ?>" /> <br/>
                    <br/>
                    
                      <h3  class="of-step"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> Exclude some pages if needed.</h3>
                    <?php _e('Excluded pages/posts') ?>:<br/>
                    <textarea style="max-width:300px; max-height:50px;" class='excluded-page-ids' placeholder='<?php _e("Comma separated page/post ids")?>' name="ofeatures_footer_excludedpages" id="ofeatures_footer_excludedpages"><?php echo get_option('ofeatures_footer_excludedpages', '')?></textarea>
<!--                    &nbsp;&nbsp; <input type="submit" class='button button-default' value="<?php _e('Exclude') ?>" />-->
                    <?php
                        $excuded_page_ids = get_option('ofeatures_footer_excludedpages', '');
                        $excuded_page_ids = explode(',', $excuded_page_ids);
                        $excuded_page_ids = array_filter($excuded_page_ids);
                        
                        if (count($excuded_page_ids) > 0){
                            ?>
                                <br/>
                                <br/>
                                <?php _e('Excluded') ?>:<br/><br/>
                            <?php
                        }
                        
                        foreach($excuded_page_ids as $id){
                            $title = get_the_title($id);
                            if ($title == null)
                                $title = "(no title or doesn't exist)";
                            echo "<span class='excluded-page-box' excludedid='$id'>$title ($id) <i  onclick='remove_excluded($id)' class='fa fa-times'></i></span>";
                        }
                    ?>
                     <br/><br/>
                    <input type="submit" class='button button-default' value="<?php _e('Save') ?>" />
                </div>
            </div>
            <br/><br/>
            <br/><br/>
             <h3  class="of-step"><i class="fa fa-phone" aria-hidden="true"></i> Contact our support.</h3>
            <?php echo (_e("You can contact us at any time to get support, leave feedback, request feature or functionality:")) ?><br/><br/>
            <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
 <?php echo (_e("On our website")) ?>: <a target="_blank" href="http://ofeatures.com">ofeatures.com</a>  
         <br/>   <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
 <?php echo (_e("Skype support")) ?>: <a href="skype:ofeatures.support?add">ofeatures.support</a><br/>
           
        </form>

        <?php
    }
}
?>