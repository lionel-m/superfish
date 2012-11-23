<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (C) 2005-2012 Leo Feyer
 *
 * @package superfish
 * @link    http://www.contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace Contao;

/**
 * Class Superfish 
 *
 * @copyright  Lionel Maccaud 
 * @author     Lionel Maccaud 
 * @package    Controller
 */
class Superfish extends \Frontend {

    public function myGeneratePage($objPage, $objLayout, $objPageRegular) {
        
        $options = array();
        
        $options[0]  = "hoverClass: '".$objLayout->sf_hoverClass."'";
        $options[1]  = (($objLayout->sf_pathClass != NULL) ? "pathClass: '".$objLayout->sf_pathClass."'" : '');
        $options[2]  = (($objLayout->sf_pathClass != NULL) ? "pathLevels: ".$objLayout->sf_pathLevels : '');
        $options[3]  = "delay: ".$objLayout->sf_delay;
        $options[4]  = (($objLayout->sf_animation != NULL) ? "animation: ".$objLayout->sf_animation : '');
        $options[5]  = "speed: ".(is_numeric($objLayout->sf_speed) ? $objLayout->sf_speed : "'".$objLayout->sf_speed."'");
        $options[6]  = (($objLayout->sf_autoArrows == 1) ? '' : "autoArrows: false");
        $options[7]  = (($objLayout->sf_dropShadows == 1) ? '' : "dropShadows: false");
        $options[8]  = (($objLayout->sf_disableHI == 1) ? "disableHI: true" : '');
        $options[9]  = (($objLayout->sf_onInit != NULL) ? "onInit: ".$objLayout->sf_onInit : '');
        $options[10] = (($objLayout->sf_onBeforeShow != NULL) ? "onBeforeShow: ".$objLayout->sf_onBeforeShow : '');
        $options[11] = (($objLayout->sf_onShow != NULL) ? "onShow: ".$objLayout->sf_onShow : '');
        $options[12] = (($objLayout->sf_onHide != NULL) ? "onHide: ".$objLayout->sf_onHide : '');
        
        // remove empty value
        foreach ($options as $key => $value) {
            if (empty($value)) {
                unset($options[$key]);
            }
        }
        
        // Reindex the array
        $options = array_values($options);
        
        // Contert to String
        $options = implode(",\n", $options);
        
        if($objLayout->superfish == 1) {
            $GLOBALS['TL_MOOTOOLS'][] = 
                (($objLayout->hoverIntent == true) ? '<script src="system/modules/superfish/assets/js/hoverIntent_r6.js"></script>' : '') . "\n" .
                "<script src=\"system/modules/superfish/assets/js/superfish.js\"></script>" . "\n" .
                (($objLayout->supersubs == true) ? '<script src="system/modules/superfish/assets/js/supersubs.js"></script>' : '') . "\n" .
                "<script>
                    (function($) { ".
                    (($objLayout->supersubs == false) ? "
                        $(\"ul.sf-menu\").superfish({" ."\n".
                            $options.
                        " });
                        " : "
                        $(\"ul.sf-menu\").supersubs({ 
                                minWidth: ".$objLayout->sf_minWidth.",
                                maxWidth: ".$objLayout->sf_maxWidth.",
                                extraWidth: ".$objLayout->sf_extraWidth."
                            }).superfish({" ."\n".
                                $options.
                            " });
                        ") ."})(jQuery);
                </script>
            ";
        }
    }
}
?>