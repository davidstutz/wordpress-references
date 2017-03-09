<?php
/**
 * Plugin Name: Wordpress References
 * Description: References plugin for Wordpress.
 * Version: 0.9
 * Author: David Stutz
 * Author URI: http://davidstutz.de
 * License: GPL 2
 */
/**
 * Copyright (C) 2017  David Stutz
 * 
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 */

/**
 * Main class of the pluign.
 */
class References {

    /**
     * Indicates that JavaScript was not included yet.
     */
    private static $_included = FALSE;

    /**
     * Keepts track of the initialized scopes.
     */
    private static $_scopes = array();

    /**
     * Initialize all provided shortcodes.
     */
    public static function init() {        
        add_shortcode('ref', array('References', 'ref'));
        add_shortcode('lbl', array('References', 'lbl'));
        add_shortcode('refb', array('References', 'refb'));
        add_shortcode('lblb', array('References', 'lblb'));
    }
    
    /**
     * Add a reference to an existing label.
     * 
     * @param string $content
     * @param array $attributes
     * @return string
     */
    public static function ref($attributes, $content = null) {
        extract(shortcode_atts(array(
            'name' => '',
            'scope' => '',
            'style' => '###',
        ), $attributes));
        
        if (References::$_included === FALSE) {
            wp_enqueue_script('jquery-references', plugins_url('/vendor/jquery-references/dist/js/jquery-references.js', __FILE__));
            wp_enqueue_script('jquery-references', plugins_url('/vendor/jquery-references/docs/js/jquery-3.1.1.min.js', __FILE__));
            References::$_included = TRUE;
        }
        
        if (isset($attributes[0])) {
            $name = $attributes[0];
        }
        
        if (isset($attributes[1])) {
            $scope = $attributes[1];
        }
        else if (empty($scope)) {
            $scope = 'default';
        }

        if (empty($style) OR FALSE == strpos($style, '###')) {
            $style = '###';
        }

        if (!empty($name) AND !empty($scope)) {

            $javascript = '';
            if (!isset(References::$_scopes[$scope])) {
                $javascript = '<script type="text/javascript">
                                $(document).ready(function() {
                                    $(\'.wordpress-references-' . $scope . '-lbl\').reference(\'label\', \'' . $scope . '\');
                                    $(\'.wordpress-references-' . $scope . '-ref\').reference(\'reference\', \'' . $scope . '\');
                                });
                                </script>';
                References::$_scopes[$scope] = TRUE;
            }

            return $javascript . str_replace('###', '<span class="wordpress-references-' . $scope . '-ref" id="' . $name . '"></span>', $style);
        }
    }

    /**
     * Add a label.
     * 
     * @param string $content
     * @param array $attributes
     * @return string
     */
    public static function lbl($attributes, $content = null) {
        extract(shortcode_atts(array(
            'name' => '',
            'scope' => '',
            'style' => '###',
        ), $attributes));
        
        if (References::$_included === FALSE) {
            wp_enqueue_script('jquery-references', plugins_url('/vendor/jquery-references/dist/js/jquery-references.js', __FILE__));
            wp_enqueue_script('jquery-references', plugins_url('/vendor/jquery-references/docs/js/jquery-3.1.1.min.js', __FILE__));
            References::$_included = TRUE;
        }

        if (isset($attributes[0])) {
            $name = $attributes[0];
        }
        
        if (isset($attributes[1])) {
            $scope = $attributes[1];
        }
        else if (empty($scope)) {
            $scope = 'default';
        }

        if (empty($style) OR FALSE == strpos($style, '###')) {
            $style = '###';
        }

        if (!empty($name) AND !empty($scope)) {

            $name = $name;
            if (isset($attributes[1])) {
                $name = $attributes[1];
            }

            $scope = $scope;
            if (isset($attributes[0])) {
                $name = $attributes[0];
            }

            $javascript = '';
            if (!isset(References::$_scopes[$scope])) {
                $javascript = '<script type="text/javascript">
                                $(document).ready(function() {
                                    $(\'.wordpress-references-' . $scope . '-lbl\').reference(\'label\', \'' . $scope . '\');
                                    $(\'.wordpress-references-' . $scope . '-ref\').reference(\'reference\', \'' . $scope . '\');
                                });
                                </script>';
                References::$_scopes[$scope] = TRUE;
            }
            
            return $javascript . str_replace('###', '<span class="wordpress-references-' . $scope . '-lbl" id="' . $name . '"></span>', $style);
        }
    }

    /**
     * Add a reference to an existing label.
     * 
     * @param string $content
     * @param array $attributes
     * @return string
     */
    public static function refb($attributes, $content = null) {
        $attributes['style'] = '[###]';
        return References::ref($attributes, $content);
    }

    /**
     * Add a label.
     * 
     * @param string $content
     * @param array $attributes
     * @return string
     */
    public static function lblb($attributes, $content = null) {
        $attributes['style'] = '[###]';
        return References::lbl($attributes, $content);
    }
}

References::init();