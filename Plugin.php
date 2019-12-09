<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

/**
 * 为前台页面全局加入加载进度条
 *
 * @package Nprogress
 * @author Cain
 * @version 1.1.1
 * @link https://github.com/Vndroid/Nprogress
 */
class Nprogress_Plugin implements Typecho_Plugin_Interface
{
    public static function activate()
    {
        Typecho_Plugin::factory('Widget_Archive')->header = array('Nprogress_Plugin', 'header');
        Typecho_Plugin::factory('Widget_Archive')->footer = array('Nprogress_Plugin', 'footer');
    }

    public static function deactivate()
    {
    }

    public static function config(Typecho_Widget_Helper_Form $form)
    {

        $jquery = new Typecho_Widget_Helper_Form_Element_Radio(
            'jquery', array('0' => '手动加载', '1' => '自动加载'), 0, '选择 jQuery 来源',
            '手动加载需要手动加载 jQuery 到页面中；自动加载本插件会自动引用 jQuery。');
        $form->addInput($jquery);

        $css = new Typecho_Widget_Helper_Form_Element_Radio('css',
            array(
                'default' => _t('<span style="display: inline-block; width: 24px; vertical-align:middle; height: 15px; background-color:#031262; box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset;"></span>'),
                'blue' => _t('<span style="display: inline-block; width: 24px; vertical-align:middle; height: 15px; background-color:#0000FF; box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset;"></span>'),
                'navy' => _t('<span style="display: inline-block; width: 24px; vertical-align:middle; height: 15px; background-color:#000080; box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset;"></span>'),
                'prussian' => _t('<span style="display: inline-block; width: 24px; vertical-align:middle; height: 15px; background-color: #003155; box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset;"></span>'),
                'white' => _t('<span style="display: inline-block; width: 24px; vertical-align:middle; height: 15px; background-color:#FFFFFF; box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset;"></span>'),
                'green' => _t('<span style="display: inline-block; width: 24px; vertical-align:middle; height: 15px; background-color:#008000; box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset;"></span>'),
                'pumice' => _t('<span style="display: inline-block; width: 24px; vertical-align:middle; height: 15px; background-color: #D2D7D3; box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset;"></span>'),
                'gray' => _t('<span style="display: inline-block; width: 24px; vertical-align:middle; height: 15px; background-color: #808080; box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset;"></span>'),
                'grass' => _t('<span style="display: inline-block; width: 24px; vertical-align:middle; height: 15px; background-color: #A0D468; box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset;"></span>'),
                'mint' => _t('<span style="display: inline-block; width: 24px; vertical-align:middle; height: 15px; background-color: #48CFAD; box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset;"></span>'),
                'meadow' => _t('<span style="display: inline-block; width: 24px; vertical-align:middle; height: 15px; background-color:#16A085; box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset;"></span>'),
                'crimson' => _t('<span style="display: inline-block; width: 24px; vertical-align:middle; height: 15px; background-color: #DC143C; box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset;"></span>'),
                'red' => _t('<span style="display: inline-block; width: 24px; vertical-align:middle; height: 15px; background-color:#FF0000; box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset;"></span>'),
                'pink' => _t('<span style="display: inline-block; width: 24px; vertical-align:middle; height: 15px; background-color:#FFC0CB; box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset;"></span>'),
                'purple' => _t('<span style="display: inline-block; width: 24px; vertical-align:middle; height: 15px; background-color:#800080; box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset;"></span>'),
                'wisteria' => _t('<span style="display: inline-block; width: 24px; vertical-align:middle; height: 15px; background-color:#BE90D4; box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset;"></span>'),
                'orange' => _t('<span style="display: inline-block; width: 24px; vertical-align:middle; height: 15px; background-color:#FFA500; box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset;"></span>'),
                'lavender' => _t('<span style="display: inline-block; width: 24px; vertical-align:middle; height: 15px; background-color:#967BB6; box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset;"></span>'),
            ),
            'default',
            _t('主题配色'),
            '加载进度条颜色选择'
        );
        $form->addInput($css);


    }

    public static function personalConfig(Typecho_Widget_Helper_Form $form)
    {
    }

    public static function header()
    {
        $options = Helper::options();
        $settings = $options->plugin('Nprogress');
        $cssUrl = Helper::options()->pluginUrl . '/Nprogress/css/' . $settings->css . '.css';
        $jqUrl = 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js';
        if ($settings->jquery) {
            echo '<script src="' . $jqUrl . '"></script>';
        }

        echo '<link rel="stylesheet" type="text/css" href="' . $cssUrl . '" />';
    }

    public static function footer()
    {
        $nprogressurl = Helper::options()->pluginUrl . '/Nprogress/js/nprogress.min.js';
        echo '<script src="' . $nprogressurl . '"></script>';
        include 'global.php';
    }

}
