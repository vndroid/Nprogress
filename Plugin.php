<?php

/**
 * 为前台页面全局加入加载进度条
 * 
 * @package Nprogress
 * @author Cain
 * @version 1.0.0
 * @link https://wave.red
 */
 
 
 
class Nprogress_Plugin implements Typecho_Plugin_Interface
{
    public static function activate()
    {
        Typecho_Plugin::factory('Widget_Archive')->header = array('Nprogress_Plugin', 'header');
        Typecho_Plugin::factory('Widget_Archive')->footer = array('Nprogress_Plugin', 'footer');			
    }	
	
    public static function deactivate(){}
	
	
	public static function config(Typecho_Widget_Helper_Form $form){

    $jquery = new Typecho_Widget_Helper_Form_Element_Radio(
    'jquery', array('0'=> '手动加载', '1'=> '自动加载'), 0, '选择 jQuery 来源',
	'若选择“手动加载”，则需要手动加载 jQuery 到主题中，若选择“自动加载”，本插件会自动引用 jQuery。');
    $form->addInput($jquery);
	
    $css = new Typecho_Widget_Helper_Form_Element_Radio('css', 
    array(
        'default' => _t('<span style="display: inline-block; width: 24px; height: 15px; background-color:#29d; -webkit-box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset; -moz-box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset; box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset;"></span>'),
        'blue' => _t('<span style="display: inline-block; width: 24px; height: 15px; background-color:#19B5FE; -webkit-box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset; -moz-box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset; box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset;"></span>'),
        'white' => _t('<span style="display: inline-block; width: 24px; height: 15px; background-color:#fff; -webkit-box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset; -moz-box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset; box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset;"></span>'),
        'pumice' => _t('<span style="display: inline-block; width: 24px; height: 15px; background-color: #D2D7D3; -webkit-box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset; -moz-box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset; box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset;"></span>'),
        'gray' => _t('<span style="display: inline-block; width: 24px; height: 15px; background-color: #AAB2BD; -webkit-box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset; -moz-box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset; box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset;"></span>'),
		'grass' => _t('<span style="display: inline-block; width: 24px; height: 15px; background-color: #A0D468; -webkit-box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset; -moz-box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset; box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset;"></span>'),		
        'mint' => _t('<span style="display: inline-block; width: 24px; height: 15px; background-color: #48CFAD; -webkit-box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset; -moz-box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset; box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset;"></span>'),
        'meadow' => _t('<span style="display: inline-block; width: 24px; height: 15px; background-color:#16A085; -webkit-box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset; -moz-box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset; box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset;"></span>'),		
        'crimson' => _t('<span style="display: inline-block; width: 24px; height: 15px; background-color: #FFB3A7; -webkit-box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset; -moz-box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset; box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset;"></span></br>'),
        'sweet' => _t('<span style="display: inline-block; width: 24px; height: 15px; background-color: #FC6E51; -webkit-box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset; -moz-box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset; box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset;"></span>'),
        'red' => _t('<span style="display: inline-block; width: 24px; height: 15px; background-color:#ED5565; -webkit-box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset; -moz-box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset; box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset;"></span>'),
        'radical' => _t('<span style="display: inline-block; width: 24px; height: 15px; background-color:#F62459; -webkit-box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset; -moz-box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset; box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset;"></span>'),        	
        'pink' => _t('<span style="display: inline-block; width: 24px; height: 15px; background-color:#EC87C0; -webkit-box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset; -moz-box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset; box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset;"></span>'),
		'purple' => _t('<span style="display: inline-block; width: 24px; height: 15px; background-color:#BF55EC; -webkit-box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset; -moz-box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset; box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset;"></span>'),
        'wisteria' => _t('<span style="display: inline-block; width: 24px; height: 15px; background-color:#BE90D4; -webkit-box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset; -moz-box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset; box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset;"></span>'),
        'lavender' => _t('<span style="display: inline-block; width: 24px; height: 15px; background-color:#AC92EC; -webkit-box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset; -moz-box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset; box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset;"></span>'),
		'cream' => _t('<span style="display: inline-block; width: 24px; height: 15px; background-color:#F5D76E; -webkit-box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset; -moz-box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset; box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset;"></span>'),
        'dyed' => _t('<span style="display: inline-block; width: 24px; height: 15px; background-color: #E08A1E; -webkit-box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset; -moz-box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset; box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3) inset;"></span>'),
        ),
    'default',
    _t('主题配色'),
	'进度加载条颜色选择。'
	);
    $form->addInput($css);
	

	}
	
	public static function personalConfig(Typecho_Widget_Helper_Form $form){}

    public static function header()
    {
		$options = Helper::options();
        $settings = $options->plugin('Nprogress');
		$cssUrl = Helper::options()->pluginUrl . '/Nprogress/css/' . $settings->css . '.css';
		$jqUrl = 'https://lib.baomitu.com/jquery/3.4.1/jquery.min.js';
		if ($settings->jquery){
			echo '<script src="'.$jqUrl.'"></script>';
		}
		
        echo '<link rel="stylesheet" type="text/css" href="' . $cssUrl . '" />';
    }	
	
    public static function footer() { 
		$nprogressurl = Helper::options()->pluginUrl . '/Nprogress/js/nprogress.min.js';
		echo '<script src="'.$nprogressurl.'"></script>';
		include 'global.php';
    }  	
	
}
