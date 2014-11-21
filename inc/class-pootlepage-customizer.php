<?php
/**
 * Created by Alan on 19/5/2014.
 */

class PootlePage_Customizer {

    private $options;

    public function __construct() {
        add_action( 'customize_register', array($this, 'register') );
        add_action( 'wp_head', array($this, 'output_css'), 50);
        add_action( 'wp_head', array($this, 'google_webfonts') );

        $this->init_options();
        $this->init_options_defaults();
    }

    public function init_options() {

        $choices = array();
        for ($i = 0; $i <= 20; ++$i) {
            $choices[$i] = $i . 'px';
        }


        $this->options = array(

            'pp_paragraph' => array(
                'id' => 'pp_paragraph',
                'type' => 'font',
                'label' => __('Paragraph', 'pootlepage'),
                'section' => 'page_builder_font_section',
                'settings' => array(
                    'font_id' => 'pp_paragraph_font_id',
                    'font_size' => 'pp_paragraph_font_size',
                    'font_size_unit' => 'pp_paragraph_font_size_unit',
                    'font_color' => 'pp_paragraph_font_color',
                    'font_weight_style' => 'pp_paragraph_font_weight_style'
                ),
                'defaults' => array(
                    'font_id' => "Lato",
                    'font_size' => 18,
                    'font_size_unit' => 'px',
                    'font_color' => '#333333',
                    'font_weight_style' => '300'
                ),
                'priority' => 10
            ),

            'pp_address' => array(
                'id' => 'pp_address',
                'type' => 'font',
                'label' => __('Address', 'pootlepage'),
                'section' => 'page_builder_font_section',
                'settings' => array(
                    'font_id' => 'pp_address_font_id',
                    'font_size' => 'pp_address_font_size',
                    'font_size_unit' => 'pp_address_font_size_unit',
                    'font_color' => 'pp_address_font_color',
                    'font_weight_style' => 'pp_address_font_weight_style'
                ),
                'defaults' => array(
                    'font_id' => "Lato",
                    'font_size' => 18,
                    'font_size_unit' => 'px',
                    'font_color' => '#333333',
                    'font_weight_style' => '300italic'
                ),
                'priority' => 11
            ),

            'pp_pre' => array(
                'id' => 'pp_pre',
                'type' => 'font',
                'label' => __('Pre', 'pootlepage'),
                'section' => 'page_builder_font_section',
                'settings' => array(
                    'font_id' => 'pp_pre_font_id',
                    'font_size' => 'pp_pre_font_size',
                    'font_size_unit' => 'pp_pre_font_size_unit',
                    'font_color' => 'pp_pre_font_color',
                    'font_weight_style' => 'pp_pre_font_weight_style'
                ),
                'defaults' => array(
                    'font_id' => "monospace",
                    'font_size' => 1,
                    'font_size_unit' => 'em',
                    'font_color' => '#333333',
                    'font_weight_style' => '300'
                ),
                'priority' => 12
            ),

            'pp_h1' => array(
                'id' => 'pp_h1',
                'type' => 'font',
                'label' => __('H1', 'pootlepage'),
                'section' => 'page_builder_font_section',
                'settings' => array(
                    'font_id' => 'pp_h1_font_id',
                    'font_size' => 'pp_h1_font_size',
                    'font_size_unit' => 'pp_h1_font_size_unit',
                    'font_color' => 'pp_h1_font_color',
                    'font_weight_style' => 'pp_h1_font_weight_style'
                ),
                'defaults' => array(
                    'font_id' => "Lato",
                    'font_size' => 36,
                    'font_size_unit' => 'px',
                    'font_color' => '#333333',
                    'font_weight_style' => '400'
                ),
                'priority' => 21
            ),

            'pp_h2' => array(
                'id' => 'pp_h2',
                'type' => 'font',
                'label' => __('H2', 'pootlepage'),
                'section' => 'page_builder_font_section',
                'settings' => array(
                    'font_id' => 'pp_h2_font_id',
                    'font_size' => 'pp_h2_font_size',
                    'font_size_unit' => 'pp_h2_font_size_unit',
                    'font_color' => 'pp_h2_font_color',
                    'font_weight_style' => 'pp_h2_font_weight_style'
                ),
                'defaults' => array(
                    'font_id' => "Lato",
                    'font_size' => 30,
                    'font_size_unit' => 'px',
                    'font_color' => '#333333',
                    'font_weight_style' => '400'
                ),
                'priority' => 22
            ),

            'pp_h3' => array(
                'id' => 'pp_h3',
                'type' => 'font',
                'label' => __('H3', 'pootlepage'),
                'section' => 'page_builder_font_section',
                'settings' => array(
                    'font_id' => 'pp_h3_font_id',
                    'font_size' => 'pp_h3_font_size',
                    'font_size_unit' => 'pp_h3_font_size_unit',
                    'font_color' => 'pp_h3_font_color',
                    'font_weight_style' => 'pp_h3_font_weight_style'
                ),
                'defaults' => array(
                    'font_id' => "Lato",
                    'font_size' => 24,
                    'font_size_unit' => 'px',
                    'font_color' => '#333333',
                    'font_weight_style' => '400'
                ),
                'priority' => 23
            ),

            'pp_h4' => array(
                'id' => 'pp_h4',
                'type' => 'font',
                'label' => __('H4', 'pootlepage'),
                'section' => 'page_builder_font_section',
                'settings' => array(
                    'font_id' => 'pp_h4_font_id',
                    'font_size' => 'pp_h4_font_size',
                    'font_size_unit' => 'pp_h4_font_size_unit',
                    'font_color' => 'pp_h4_font_color',
                    'font_weight_style' => 'pp_h4_font_weight_style'
                ),
                'defaults' => array(
                    'font_id' => "Lato",
                    'font_size' => 20,
                    'font_size_unit' => 'px',
                    'font_color' => '#333333',
                    'font_weight_style' => '400'
                ),
                'priority' => 24
            ),

            'pp_h5' => array(
                'id' => 'pp_h5',
                'type' => 'font',
                'label' => __('H5', 'pootlepage'),
                'section' => 'page_builder_font_section',
                'settings' => array(
                    'font_id' => 'pp_h5_font_id',
                    'font_size' => 'pp_h5_font_size',
                    'font_size_unit' => 'pp_h5_font_size_unit',
                    'font_color' => 'pp_h5_font_color',
                    'font_weight_style' => 'pp_h5_font_weight_style'
                ),
                'defaults' => array(
                    'font_id' => "Lato",
                    'font_size' => 28,
                    'font_size_unit' => 'px',
                    'font_color' => '#333333',
                    'font_weight_style' => '400'
                ),
                'priority' => 25
            ),

            'pp_h6' => array(
                'id' => 'pp_h6',
                'type' => 'font',
                'label' => __('H6', 'pootlepage'),
                'section' => 'page_builder_font_section',
                'settings' => array(
                    'font_id' => 'pp_h6_font_id',
                    'font_size' => 'pp_h6_font_size',
                    'font_size_unit' => 'pp_h6_font_size_unit',
                    'font_color' => 'pp_h6_font_color',
                    'font_weight_style' => 'pp_h6_font_weight_style'
                ),
                'defaults' => array(
                    'font_id' => "Lato",
                    'font_size' => 16,
                    'font_size_unit' => 'px',
                    'font_color' => '#333333',
                    'font_weight_style' => '400'
                ),
                'priority' => 26
            ),

            'pp_widget_bg_color' => array(
                'id' => 'pp_widget_bg_color',
                'type' => 'color',
                'label' => __('Widget Background Color', 'scratch'),
                'section' => 'page_builder_widget_section',
                'default' => '',
                'priority' => 10
            ),

            'pp_widget_border' => array(
                'id' => 'pp_widget_border',
                'type' => 'border',
                'label' => __('Widget Border', 'scratch'),
                'section' => 'page_builder_widget_section',
                'settings' => array(
                    'border_width' => 'pp_widget_border_width',
                    'border_style' => 'pp_widget_border_style',
                    'border_color' => 'pp_widget_border_color',
                ),
                'defaults' => array(
                    'border_width' => 0,
                    'border_style' => 'solid',
                    'border_color' => '#dbdbdb',
                ),
                'priority' => 11
            ),

            'pp_widget_padding' => array(
                'id' => 'pp_widget_padding',
                'type' => 'padding',
                'label' => 'Widget Padding',
                'section' => 'page_builder_widget_section',
                'settings' => array(
                    'top_bottom_width' => 'pp_widget_padding_top_bottom',
                    'left_right_width' => 'pp_widget_padding_left_right',
                    'unit' => 'pp_widget_padding_unit'
                ),
                'defaults' => array(
                    'top_bottom_width' => 0,
                    'left_right_width' => 0,
                    'unit' => '%'
                ),
                'priority' => 12
            ),

//            'pp_widget_title' => array(
//                'id' => 'pp_widget_title',
//                'type' => 'font',
//                'label' => __('Widget Title', 'scratch'),
//                'section' => 'pootlepage_section',
//                'settings' => array(
//                    'font_id' => 'pp_widget_title_font_id',
//                    'font_size' => 'pp_widget_title_font_size',
//                    'font_size_unit' => 'pp_widget_title_font_size_unit',
//                    'font_color' => 'pp_widget_title_font_color',
//                    'font_weight_style' => 'pp_widget_title_font_weight_style'
//                ),
//                'defaults' => array(
//                    'font_id' => "Helvetica",
//                    'font_size' => 14,
//                    'font_size_unit' => 'px',
//                    'font_color' => '#555555',
//                    'font_weight_style' => '700'
//                ),
//                'priority' => 13
//            ),
//
//            'pp_widget_title_bottom_border' => array(
//                'id' => 'pp_widget_title_bottom_border',
//                'type' => 'border',
//                'label' => __('Widget Title Bottom Border', 'scratch'),
//                'section' => 'pootlepage_section',
//                'settings' => array(
//                    'border_width' => 'pp_widget_title_bottom_border_width',
//                    'border_style' => 'pp_widget_title_bottom_border_style',
//                    'border_color' => 'pp_widget_title_bottom_border_color',
//                ),
//                'defaults' => array(
//                    'border_width' => 1,
//                    'border_style' => 'solid',
//                    'border_color' => '#e6e6e6',
//                ),
//                'priority' => 14
//            ),
//
//            'pp_widget_text' => array(
//                'id' => 'pp_widget_text',
//                'type' => 'font',
//                'label' => __('Widget Text', 'scratch'),
//                'section' => 'pootlepage_section',
//                'settings' => array(
//                    'font_id' => 'pp_widget_text_font_id',
//                    'font_size' => 'pp_widget_text_font_size',
//                    'font_size_unit' => 'pp_widget_text_font_size_unit',
//                    'font_color' => 'pp_widget_text_font_color',
//                    'font_weight_style' => 'pp_widget_text_font_weight_style'
//                ),
//                'defaults' => array(
//                    'font_id' => "Helvetica",
//                    'font_size' => 13,
//                    'font_size_unit' => 'px',
//                    'font_color' => '#555555',
//                    'font_weight_style' => '400'
//                ),
//                'priority' => 15
//            ),

            'pp_widget_border_radius' => array(
                'id' => 'pp_widget_border_radius',
                'type' => 'select',
                'label' => __('Widget Rounded Corners', 'scratch'),
                'section' => 'page_builder_widget_section',
                'default' => '0',
                'choices' => $choices,
                'priority' => 16
            ),

            // tab widget is only for canvas, so remove these options
//            array(
//                'id' => 'pp_widget_tab_bg_color',
//                'type' => 'color',
//                'label' => __('Tabs Widget Background color', 'scratch'),
//                'section' => 'pootlepage_section',
//                'default' => '',
//                'priority' => 17
//            ),
//
//            array(
//                'id' => 'pp_widget_tab_inside_bg_color',
//                'type' => 'color',
//                'label' => __('Tabs Widget Inside Background Color', 'scratch'),
//                'section' => 'pootlepage_section',
//                'default' => '',
//                'priority' => 18
//            ),
//
//            array(
//                'id' => 'widget_tab_title',
//                'type' => 'font',
//                'label' => __('Tabs Widget Title', 'scratch'),
//                'section' => 'pootlepage_section',
//                'settings' => array(
//                    'font_id' => 'pp_widget_tab_title_font_id',
//                    'font_size' => 'pp_widget_tab_title_font_size',
//                    'font_color' => 'pp_widget_tab_title_font_color',
//                    'font_weight_style' => 'pp_widget_tab_title_font_weight_style'
//                ),
//                'defaults' => array(
//                    'font_id' => "Helvetica",
//                    'font_size' => 12,
//                    'font_color' => '#555555',
//                    'font_weight_style' => '700'
//                ),
//                'priority' => 19
//            ),
//
//            array(
//                'id' => 'widget_tab_meta',
//                'type' => 'font',
//                'label' => __('Tabs Widget Meta / Tabber Font', 'scratch'),
//                'section' => 'pootlepage_section',
//                'settings' => array(
//                    'font_id' => 'pp_widget_tab_meta_font_id',
//                    'font_size' => 'pp_widget_tab_meta_font_size',
//                    'font_color' => 'pp_widget_tab_meta_font_color',
//                    'font_weight_style' => 'pp_widget_tab_meta_font_weight_style'
//                ),
//                'defaults' => array(
//                    'font_id' => "Helvetica",
//                    'font_size' => 11,
//                    'font_color' => '#999999',
//                    'font_weight_style' => '400'
//                ),
//                'priority' => 20
//            ),
        );
    }

    public function init_options_defaults() {

        $parentTheme = get_template();
        if ($parentTheme == 'canvas') {
            $widgetBgColor = get_option('woo_widget_bg', '');
            $widgetBorder = get_option('woo_widget_border', array('width' => 0, 'style' => 'solid', 'color' => '#dbdbdb'));
            $widgetPaddingTopBottom = get_option('woo_widget_padding_tb', 0);
            $widgetPaddingLeftRight = get_option('woo_widget_padding_lr', 0);

            $widgetTitleFont = get_option('woo_widget_font_title', array('size' => '14','unit' => 'px', 'face' => 'Helvetica, Arial, sans-serif','style' => 'bold','color' => '#555555'));
            $widgetTitleFontFamily = $widgetTitleFont['face'];
            $widgetTitleFontSize = $widgetTitleFont['size'];
            $widgetTitleFontSizeUnit = $widgetTitleFont['unit'];
            $widgetTitleFontStyle = $this->convert_canvas_font_style_to_pp($widgetTitleFont['style']);
            $widgetTitleFontColor = $widgetTitleFont['color'];

            $widgetTitleBottomBorder = get_option('woo_widget_title_border', array('width' => '1','style' => 'solid','color' => '#e6e6e6'));
            $widgetTitleBottomBorderWidth = $widgetTitleBottomBorder['width'];
            $widgetTitleBottomBorderStyle = $widgetTitleBottomBorder['style'];
            $widgetTitleBottomBorderColor = $widgetTitleBottomBorder['color'];

            $widgetTextFont = get_option('woo_widget_font_text', array('size' => '13','unit' => 'px', 'face' => 'Helvetica, Arial, sans-serif','style' => 'thin','color' => '#555555'));
            $widgetTextFontFamily = $widgetTextFont['face'];
            $widgetTextFontSize = $widgetTextFont['size'];
            $widgetTextFontSizeUnit = $widgetTextFont['unit'];
            $widgetTextFontStyle = $this->convert_canvas_font_style_to_pp($widgetTextFont['style']);
            $widgetTextFontColor = $widgetTextFont['color'];

            $widgetBorderRadius = get_option('woo_widget_border_radius', '0');

            $this->options['pp_widget_bg_color']['default'] = $widgetBgColor;
            $this->options['pp_widget_border']['defaults'] = array(
                'border_width' => $widgetBorder['width'],
                'border_style' => $widgetBorder['style'],
                'border_color' => $widgetBorder['color']
            );
            $this->options['pp_widget_padding']['defaults'] = array(
                'top_bottom_width' => $widgetPaddingTopBottom,
                'left_right_width' => $widgetPaddingLeftRight
            );
            $this->options['pp_widget_title']['defaults'] = array(
                'font_id' => $widgetTitleFontFamily,
                'font_size' => $widgetTitleFontSize,
                'font_size_unit' => $widgetTitleFontSizeUnit,
                'font_color' => $widgetTitleFontColor,
                'font_weight_style' => $widgetTitleFontStyle
            );
            $this->options['pp_widget_title_bottom_border']['defaults'] = array(
                'border_width' => $widgetTitleBottomBorderWidth,
                'border_style' => $widgetTitleBottomBorderStyle,
                'border_color' => $widgetTitleBottomBorderColor
            );
            $this->options['pp_widget_text']['defaults'] = array(
                'font_id' => $widgetTextFontFamily,
                'font_size' => $widgetTextFontSize,
                'font_size_unit' => $widgetTextFontSizeUnit,
                'font_color' => $widgetTextFontColor,
                'font_weight_style' => $widgetTextFontStyle
            );
            $this->options['pp_widget_border_radius']['default'] = $widgetBorderRadius;

        } else if ($parentTheme == 'twentythirteen') {

            $widgetBgColor = '#F7F5E7';
            $widgetBorder = array('width' => 0, 'style' => 'solid', 'color' => '#dbdbdb');
            $widgetPaddingTopBottom = 20;
            $widgetPaddingLeftRight = 20;

            $widgetTitleFont = array('size' => '20','unit' => 'px', 'face' => '"Source Sans Pro", Helvetica, sans-serif','style' => '300 italic','color' => '#141412');
            $widgetTitleFontFamily = $widgetTitleFont['face'];
            $widgetTitleFontSize = $widgetTitleFont['size'];
            $widgetTitleFontSizeUnit = $widgetTitleFont['unit'];
            $widgetTitleFontStyle = $this->convert_canvas_font_style_to_pp($widgetTitleFont['style']);
            $widgetTitleFontColor = $widgetTitleFont['color'];

            $widgetTitleBottomBorder = array('width' => '0','style' => 'solid','color' => '#e6e6e6');
            $widgetTitleBottomBorderWidth = $widgetTitleBottomBorder['width'];
            $widgetTitleBottomBorderStyle = $widgetTitleBottomBorder['style'];
            $widgetTitleBottomBorderColor = $widgetTitleBottomBorder['color'];

            $widgetTextFont = array('size' => '14','unit' => 'px', 'face' => '"Source Sans Pro", Helvetica, sans-serif','style' => 'normal','color' => '#141412');
            $widgetTextFontFamily = $widgetTextFont['face'];
            $widgetTextFontSize = $widgetTextFont['size'];
            $widgetTextFontSizeUnit = $widgetTextFont['unit'];
            $widgetTextFontStyle = $this->convert_canvas_font_style_to_pp($widgetTextFont['style']);
            $widgetTextFontColor = $widgetTextFont['color'];

            $widgetBorderRadius = 0;

            $this->options['pp_widget_bg_color']['default'] = $widgetBgColor;
            $this->options['pp_widget_border']['defaults'] = array(
                'border_width' => $widgetBorder['width'],
                'border_style' => $widgetBorder['style'],
                'border_color' => $widgetBorder['color']
            );
            $this->options['pp_widget_padding']['defaults'] = array(
                'top_bottom_width' => $widgetPaddingTopBottom,
                'left_right_width' => $widgetPaddingLeftRight
            );
            $this->options['pp_widget_title']['defaults'] = array(
                'font_id' => $widgetTitleFontFamily,
                'font_size' => $widgetTitleFontSize,
                'font_size_unit' => $widgetTitleFontSizeUnit,
                'font_color' => $widgetTitleFontColor,
                'font_weight_style' => $widgetTitleFontStyle
            );
            $this->options['pp_widget_title_bottom_border']['defaults'] = array(
                'border_width' => $widgetTitleBottomBorderWidth,
                'border_style' => $widgetTitleBottomBorderStyle,
                'border_color' => $widgetTitleBottomBorderColor
            );
            $this->options['pp_widget_text']['defaults'] = array(
                'font_id' => $widgetTextFontFamily,
                'font_size' => $widgetTextFontSize,
                'font_size_unit' => $widgetTextFontSizeUnit,
                'font_color' => $widgetTextFontColor,
                'font_weight_style' => $widgetTextFontStyle
            );
            $this->options['pp_widget_border_radius']['default'] = $widgetBorderRadius;
        } else if ($parentTheme == 'make') {

            $widgetBgColor = '';
            $widgetBorder = array('width' => 0, 'style' => 'solid', 'color' => '#dbdbdb');
            $widgetPaddingTopBottom = 0;
            $widgetPaddingLeftRight = 0;

            $widgetTitleFont = array('size' => '13','unit' => 'px', 'face' => '"Helvetica Neue", Helvetica, Arial, sans-serif','style' => 'bold','color' => '#171717');
            $widgetTitleFontFamily = $widgetTitleFont['face'];
            $widgetTitleFontSize = $widgetTitleFont['size'];
            $widgetTitleFontSizeUnit = $widgetTitleFont['unit'];
            $widgetTitleFontStyle = $this->convert_canvas_font_style_to_pp($widgetTitleFont['style']);
            $widgetTitleFontColor = $widgetTitleFont['color'];

            $widgetTitleBottomBorder = array('width' => '0','style' => 'solid','color' => '#e6e6e6');
            $widgetTitleBottomBorderWidth = $widgetTitleBottomBorder['width'];
            $widgetTitleBottomBorderStyle = $widgetTitleBottomBorder['style'];
            $widgetTitleBottomBorderColor = $widgetTitleBottomBorder['color'];

            $widgetTextFont = array('size' => '13','unit' => 'px', 'face' => '"Open Sans", Helvetica, Arial, sans-serif','style' => 'normal','color' => '#171717');
            $widgetTextFontFamily = $widgetTextFont['face'];
            $widgetTextFontSize = $widgetTextFont['size'];
            $widgetTextFontSizeUnit = $widgetTextFont['unit'];
            $widgetTextFontStyle = $this->convert_canvas_font_style_to_pp($widgetTextFont['style']);
            $widgetTextFontColor = $widgetTextFont['color'];

            $widgetBorderRadius = '0';

            $this->options['pp_widget_bg_color']['default'] = $widgetBgColor;
            $this->options['pp_widget_border']['defaults'] = array(
                'border_width' => $widgetBorder['width'],
                'border_style' => $widgetBorder['style'],
                'border_color' => $widgetBorder['color']
            );
            $this->options['pp_widget_padding']['defaults'] = array(
                'top_bottom_width' => $widgetPaddingTopBottom,
                'left_right_width' => $widgetPaddingLeftRight
            );
            $this->options['pp_widget_title']['defaults'] = array(
                'font_id' => $widgetTitleFontFamily,
                'font_size' => $widgetTitleFontSize,
                'font_size_unit' => $widgetTitleFontSizeUnit,
                'font_color' => $widgetTitleFontColor,
                'font_weight_style' => $widgetTitleFontStyle
            );
            $this->options['pp_widget_title_bottom_border']['defaults'] = array(
                'border_width' => $widgetTitleBottomBorderWidth,
                'border_style' => $widgetTitleBottomBorderStyle,
                'border_color' => $widgetTitleBottomBorderColor
            );
            $this->options['pp_widget_text']['defaults'] = array(
                'font_id' => $widgetTextFontFamily,
                'font_size' => $widgetTextFontSize,
                'font_size_unit' => $widgetTextFontSizeUnit,
                'font_color' => $widgetTextFontColor,
                'font_weight_style' => $widgetTextFontStyle
            );
            $this->options['pp_widget_border_radius']['default'] = $widgetBorderRadius;

        } else if ($parentTheme == 'genesis') {

            $widgetBgColor = '#ffffff';
            $widgetBorder = array('width' => 0, 'style' => 'solid', 'color' => '#dbdbdb');
            $widgetPaddingTopBottom = 40;
            $widgetPaddingLeftRight = 40;
            $widgetPaddingUnit = '%';

//            $widgetTitleFont = array('size' => '16','unit' => 'px', 'face' => 'Lato, sans-serif','style' => 'bold','color' => '#333333');
//            $widgetTitleFontFamily = $widgetTitleFont['face'];
//            $widgetTitleFontSize = $widgetTitleFont['size'];
//            $widgetTitleFontSizeUnit = $widgetTitleFont['unit'];
//            $widgetTitleFontStyle = $this->convert_canvas_font_style_to_pp($widgetTitleFont['style']);
//            $widgetTitleFontColor = $widgetTitleFont['color'];
//
//            $widgetTitleBottomBorder = array('width' => '0','style' => 'solid','color' => '#e6e6e6');
//            $widgetTitleBottomBorderWidth = $widgetTitleBottomBorder['width'];
//            $widgetTitleBottomBorderStyle = $widgetTitleBottomBorder['style'];
//            $widgetTitleBottomBorderColor = $widgetTitleBottomBorder['color'];
//
//            $widgetTextFont = array('size' => '16','unit' => 'px', 'face' => '"Helvetica Neue", Helvetica, Arial, sans-serif','style' => '300','color' => '#999999');
//            $widgetTextFontFamily = $widgetTextFont['face'];
//            $widgetTextFontSize = $widgetTextFont['size'];
//            $widgetTextFontSizeUnit = $widgetTextFont['unit'];
//            $widgetTextFontStyle = $this->convert_canvas_font_style_to_pp($widgetTextFont['style']);
//            $widgetTextFontColor = $widgetTextFont['color'];

            $widgetBorderRadius = '0';

            $this->options['pp_widget_bg_color']['default'] = $widgetBgColor;
            $this->options['pp_widget_border']['defaults'] = array(
                'border_width' => $widgetBorder['width'],
                'border_style' => $widgetBorder['style'],
                'border_color' => $widgetBorder['color']
            );
            $this->options['pp_widget_padding']['defaults'] = array(
                'top_bottom_width' => $widgetPaddingTopBottom,
                'left_right_width' => $widgetPaddingLeftRight,
                'unit' => $widgetPaddingUnit
            );
//            $this->options['pp_widget_title']['defaults'] = array(
//                'font_id' => $widgetTitleFontFamily,
//                'font_size' => $widgetTitleFontSize,
//                'font_size_unit' => $widgetTitleFontSizeUnit,
//                'font_color' => $widgetTitleFontColor,
//                'font_weight_style' => $widgetTitleFontStyle
//            );
//            $this->options['pp_widget_title_bottom_border']['defaults'] = array(
//                'border_width' => $widgetTitleBottomBorderWidth,
//                'border_style' => $widgetTitleBottomBorderStyle,
//                'border_color' => $widgetTitleBottomBorderColor
//            );
//            $this->options['pp_widget_text']['defaults'] = array(
//                'font_id' => $widgetTextFontFamily,
//                'font_size' => $widgetTextFontSize,
//                'font_size_unit' => $widgetTextFontSizeUnit,
//                'font_color' => $widgetTextFontColor,
//                'font_weight_style' => $widgetTextFontStyle
//            );
            $this->options['pp_widget_border_radius']['default'] = $widgetBorderRadius;
        }
    }

    public function google_webfonts() {

        if (!function_exists('wf_get_google_fonts')) {
            return;
        }

        $google_fonts = wf_get_google_fonts();

        $fonts_to_load = array();
        $output = '';

        // Go through the options
        if ( ! empty( $this->options ) && ! empty( $google_fonts ) ) {
            foreach ( $this->options as $key => $option ) {

                if ( is_array( $option ) && $option['type'] == 'font' ) {

                    $fontFamilySettingId = $option['settings']['font_id'];
                    $fontFamilyDefault = $option['defaults']['font_id'];
                    $fontFamily = get_option($fontFamilySettingId, $fontFamilyDefault);

                    // Go through the google font array
                    foreach ( $google_fonts as $font ) {
                        // Check if the google font name exists in the current "face" option
                        if ( $fontFamily == $font['name'] && ! in_array( $font['name'], array_keys( $fonts_to_load ) ) ) {
                            // Add google font to output
                            $variant = '';
                            if ( isset( $font['variant'] ) ) $variant = $font['variant'];
                            $fonts_to_load[$font['name']] = $variant;
                        }
                    }
                }
            }

            // Output google font css in header
            if ( 0 < count( $fonts_to_load ) ) {
                $fonts_and_variants = array();
                foreach ( $fonts_to_load as $k => $v ) {
                    $fonts_and_variants[] = $k . $v;
                }
                $fonts_and_variants = array_map( 'urlencode', $fonts_and_variants );
                $fonts = join( '|', $fonts_and_variants );

                $output .= "\n<!-- Google Webfonts -->\n";
                $output .= '<link href="http'. ( is_ssl() ? 's' : '' ) .'://fonts.googleapis.com/css?family=' . $fonts .'" rel="stylesheet" type="text/css" />'."\n";

                echo $output;
            }
        }
    }

    public function convert_canvas_font_style_to_pp($style) {
        if ($style == '300') {
            return '100';
        } else if ($style == '300 italic') {
            return '100italic';
        } else if ($style == 'normal') {
            return '400';
        } else if ($style == 'italic') {
            return '400italic';
        } else if ($style == 'bold') {
            return '700';
        } else if ($style == 'bolditalic') {
            return '700italic';
        } else {
            return '';
        }
    }

    public function convert_pp_font_style_to_canvas($style) {
        if ($style == '100') {
            return '300';
        } else if ($style == '100italic') {
            return '300 italic';
        } else if ($style == '400') {
            return 'normal';
        } else if ($style == '400italic') {
            return 'italic';
        } else if ($style == '700') {
            return 'bold';
        } else if ($style == '700italic') {
            return 'bolditalic';
        } else {
            return '';
        }
    }

    public function register(WP_Customize_Manager $customizeManager)
    {

        require_once dirname(__FILE__) . '/class-pootlepage-font-control.php';
        require_once dirname(__FILE__) . '/class-pootlepage-border-control.php';
        require_once dirname(__FILE__) . '/class-pootlepage-padding-control.php';

        // sections
        $customizeManager->add_panel( 'page_builder', array(
            'title'       => __( 'Page Builder' ),
            'priority'    => 10,
        ));

        $customizeManager->add_section('page_builder_font_section', array(
            'title' => 'Fonts',
            'priority' => 10,
            'panel' => 'page_builder'
        ));

        $customizeManager->add_section('page_builder_widget_section', array(
            'title' => 'Widgets',
            'priority' => 11,
            'panel' => 'page_builder'
        ));

        foreach ($this->options as $k => $option) {

            if ($option['type'] == 'color') {

                $customizeManager->add_setting($option['id'], array(
                    'default' => $option['default'],
                    'type' => 'option' // use option instead of theme_mod
                ));

                $customizeManager->add_control(new WP_Customize_Color_Control($customizeManager, $option['id'], array(
                    'label' => $option['label'],
                    'section' => $option['section'],
                    'settings' => $option['id'],
                    'priority' => $option['priority']
                )));

            } else if ($option['type'] == 'border') {
                foreach ($option['settings'] as $key => $settingID) {
                    $defaultValue = $option['defaults'][$key];
                    $customizeManager->add_setting($settingID, array(
                        'default' => $defaultValue,
                        'type' => 'option'
                    ));
                }

                $customizeManager->add_control(new PootlePage_Border_Control($customizeManager, $option['id'], $option));

            } else if ($option['type'] == 'padding') {

                foreach ($option['settings'] as $key => $settingID) {
                    $defaultValue = $option['defaults'][$key];
                    $customizeManager->add_setting($settingID, array(
                        'default' => $defaultValue,
                        'type' => 'option'
                    ));
                }

                $customizeManager->add_control(new PootlePage_Padding_Control($customizeManager, $option['id'], $option));

            } else if ($option['type'] == 'font') {

                foreach ($option['settings'] as $key => $settingID) {
                    $defaultValue = $option['defaults'][$key];
                    $customizeManager->add_setting($settingID, array(
                        'default' => $defaultValue,
                        'type' => 'option'
                    ));
                }

                $customizeManager->add_control(new PootlePage_Font_Control($customizeManager, $option['id'], $option));

            } else if ($option['type'] == 'select') {

                $customizeManager->add_setting($option['id'], array(
                    'default' => $option['default'],
                    'type' => 'option'
                ));

                $customizeManager->add_control(new WP_Customize_Control($customizeManager, $option['id'], $option));
            }

        }

    }

    private function get_font_css_value($element) {
        $fontOption = $this->options[$element];

        $fontFamily = get_option($element . '_font_id');
        if (empty($fontFamily)) {
            $fontFamily = $fontOption['defaults']['font_id'];
        }

        $fontSize = get_option($element . '_font_size');
        if ($fontSize === false) {
            $fontSize = $fontOption['defaults']['font_size'];
        }

        $fontSizeUnit = get_option($element . '_font_size_unit');
        if ($fontSizeUnit === false) {
            $fontSizeUnit = $fontOption['defaults']['font_size_unit'];
        }

        $fontColor = get_option($element . '_font_color');
        if ($fontColor === false) {
            $fontColor = $fontOption['defaults']['font_color'];
        }

        $fontWeightStyle = get_option($element . '_font_weight_style');
        if (empty($fontWeightStyle)) {
            $fontWeightStyle = $fontOption['defaults']['font_weight_style'];
        }

        $fontStyle = (strpos($fontWeightStyle, 'italic') === false ? 'normal' : 'italic');
        $fontWeight = str_replace('italic', '', $fontWeightStyle);

        if (empty($fontWeight)) {
            $fontWeight = '400';
        }

        $result = array(
            'font-family' => '"' . $fontFamily . '"',
            'font-size' => $fontSize . $fontSizeUnit,
            'color' => $fontColor,
            'font-style' => $fontStyle,
            'font-weight' => $fontWeight
        );

        return $result;
    }



    public function output_css() {

        $output = '';

        $widget_css = '';

        $widget_bg = get_option('pp_widget_bg_color');

        if ( $widget_bg ) {
            $widget_css .= 'background-color:'.$widget_bg.';';
        } else {
            $widget_css .= 'background-color: transparent;';
        }

        $widget_border_width = get_option('pp_widget_border_width', 0);
        // don't need border style
        $widget_border_style = 'solid'; //get_option('pp_widget_border_style', 'solid');
        $widget_border_color = get_option('pp_widget_border_color', '#dbdbdb');

        if ($widget_border_width > 0) {
            $widget_css .= 'border:'.$widget_border_width.'px '.$widget_border_style . ' ' . $widget_border_color . ';';
        }

        $widget_padding_left_right = get_option('pp_widget_padding_left_right', 0);
        $widget_padding_top_bottom = get_option('pp_widget_padding_top_bottom', 0);
        $widget_padding_unit = get_option('pp_widget_padding_unit', 'px');

        if (!$widget_padding_left_right) {
            $widget_css .= 'padding-left: 0; padding-right: 0;';
        } else {
            $widget_css .= 'padding-left: ' . $widget_padding_left_right . $widget_padding_unit . ' ; padding-right: ' . $widget_padding_left_right . $widget_padding_unit . ';';
        }

        if (!$widget_padding_top_bottom) {
            $widget_css .= 'padding-top: 0; padding-bottom: 0;';
        } else {
            $widget_css .= 'padding-top: ' . $widget_padding_top_bottom . $widget_padding_unit . ' ; padding-bottom: ' . $widget_padding_top_bottom . $widget_padding_unit . ';';
        }

//        $widget_text_font = $this->get_font_css_value('pp_widget_text');
//
//        $widget_css .= 'font-family: ' . $widget_text_font['font-family'] .
//            ' !important; font-size: ' . $widget_text_font['font-size'] .
//            ' !important; font-style: ' . $widget_text_font['font-style'] .
//            ' !important; font-weight: ' . $widget_text_font['font-weight'] .
//            ' !important; color: ' . $widget_text_font['color'] . ' !important; ';
//
//


//        $widget_title_font = $this->get_font_css_value('pp_widget_title');
//
//        $widget_title_css = '';
//        $widget_title_css .= 'font-family: ' . $widget_title_font['font-family'] .
//            '; font-size: ' . $widget_title_font['font-size'] .
//            '; font-style: ' . $widget_title_font['font-style'] .
//            '; font-weight: ' . $widget_title_font['font-weight'] .
//            '; color: ' . $widget_title_font['color'] . '; ';


//        $widget_title_border_width = get_option('pp_widget_title_bottom_border_width', 1);
//        $widget_title_border_style = get_option('pp_widget_title_bottom_border_style', 'solid');
//        $widget_title_border_color = get_option('pp_widget_title_bottom_border_color', '#e6e6e6');
//
//        if ( $widget_title_border_width > 0 ) {
//            $widget_title_css .= 'border-bottom:' . $widget_title_border_width . 'px ' . $widget_title_border_style . ' ' . $widget_title_border_color . ';';
//        }
//        if ( isset( $widget_title_border_width ) AND $widget_title_border_width == 0 ) {
//            $widget_title_css .= 'margin-bottom:0;';
//        }

        $widget_border_radius = get_option('pp_widget_border_radius', 0);
        if ( $widget_border_radius > 0) {
            $widget_css .= 'border-radius:' . $widget_border_radius . 'px; -moz-border-radius:' . $widget_border_radius . 'px; -webkit-border-radius:' . $widget_border_radius . 'px;';
        }

        if ( $widget_css != '' ) {
            $output .= '.panel-grid-cell .widget {' . $widget_css . '}' . "\n";
        }

        $font_css = '';

        $paragraph_font = $this->get_font_css_value('pp_paragraph');
        $font_css .= '.panel-grid-cell .widget p { font-family: ' . $paragraph_font['font-family'] .
            ' !important; font-size: ' . $paragraph_font['font-size'] .
            ' !important; font-style: ' . $paragraph_font['font-style'] .
            ' !important; font-weight: ' . $paragraph_font['font-weight'] .
            ' !important; color: ' . $paragraph_font['color'] . " !important; }\n";

        $address_font = $this->get_font_css_value('pp_address');
        $font_css .= '.panel-grid-cell .widget address { font-family: ' . $address_font['font-family'] .
            ' !important; font-size: ' . $address_font['font-size'] .
            ' !important; font-style: ' . $address_font['font-style'] .
            ' !important; font-weight: ' . $address_font['font-weight'] .
            ' !important; color: ' . $address_font['color'] . " !important; }\n";

        $pre_font = $this->get_font_css_value('pp_pre');
        $font_css .= '.panel-grid-cell .widget pre { font-family: ' . $pre_font['font-family'] .
            ' !important; font-size: ' . $pre_font['font-size'] .
            ' !important; font-style: ' . $pre_font['font-style'] .
            ' !important; font-weight: ' . $pre_font['font-weight'] .
            ' !important; color: ' . $pre_font['color'] . " !important; }\n";

        $h1_font = $this->get_font_css_value('pp_h1');
        $font_css .= '.panel-grid-cell .widget h1 { font-family: ' . $h1_font['font-family'] .
            ' !important; font-size: ' . $h1_font['font-size'] .
            ' !important; font-style: ' . $h1_font['font-style'] .
            ' !important; font-weight: ' . $h1_font['font-weight'] .
            ' !important; color: ' . $h1_font['color'] . " !important; }\n";

        $h2_font = $this->get_font_css_value('pp_h2');
        $font_css .= '.panel-grid-cell .widget h2 { font-family: ' . $h2_font['font-family'] .
            ' !important; font-size: ' . $h2_font['font-size'] .
            ' !important; font-style: ' . $h2_font['font-style'] .
            ' !important; font-weight: ' . $h2_font['font-weight'] .
            ' !important; color: ' . $h2_font['color'] . " !important; }\n";

        $h3_font = $this->get_font_css_value('pp_h3');
        $font_css .= '.panel-grid-cell .widget h3 { font-family: ' . $h3_font['font-family'] .
            ' !important; font-size: ' . $h3_font['font-size'] .
            ' !important; font-style: ' . $h3_font['font-style'] .
            ' !important; font-weight: ' . $h3_font['font-weight'] .
            ' !important; color: ' . $h3_font['color'] . " !important; }\n";

        $h4_font = $this->get_font_css_value('pp_h4');
        $font_css .= '.panel-grid-cell .widget h4 { font-family: ' . $h4_font['font-family'] .
            ' !important; font-size: ' . $h4_font['font-size'] .
            ' !important; font-style: ' . $h4_font['font-style'] .
            ' !important; font-weight: ' . $h4_font['font-weight'] .
            ' !important; color: ' . $h4_font['color'] . " !important; }\n";

        $h5_font = $this->get_font_css_value('pp_h5');
        $font_css .= '.panel-grid-cell .widget h5 { font-family: ' . $h5_font['font-family'] .
            ' !important; font-size: ' . $h5_font['font-size'] .
            ' !important; font-style: ' . $h5_font['font-style'] .
            ' !important; font-weight: ' . $h5_font['font-weight'] .
            ' !important; color: ' . $h5_font['color'] . " !important; }\n";

        $h6_font = $this->get_font_css_value('pp_h6');
        $font_css .= '.panel-grid-cell .widget h6 { font-family: ' . $h6_font['font-family'] .
            ' !important; font-size: ' . $h6_font['font-size'] .
            ' !important; font-style: ' . $h6_font['font-style'] .
            ' !important; font-weight: ' . $h6_font['font-weight'] .
            ' !important; color: ' . $h6_font['color'] . " !important; }\n";


        if ($font_css != '') {
            $output .= $font_css . "\n";
        }

//        if ( $widget_title_css != '' ) {
//            $output .= '.panel-grid-cell .widget > .widget-title {' . $widget_title_css . '}' . "\n";
//        }

        ?>
        <style>
            <?php echo $output ?>
        </style>
    <?php
    }
} 