<?php

/**
 * Get the settings
 *
 * @param string $key Only get a specific key.
 * @return mixed
 */
function siteorigin_panels_setting($key = ''){

	if( has_action('after_setup_theme') ) {
		// Only use static settings if we've initialized the theme
		static $settings;
	}
	else {
		$settings = false;
	}

	if( empty($settings) ){
		$display_settings = get_option('siteorigin_panels_display', array());

		$settings = get_theme_support('siteorigin-panels');
		if(!empty($settings)) $settings = $settings[0];
		else $settings = array();

		$settings = wp_parse_args( $settings, array(
			'home-page' => false,																								// Is the home page supported
			'home-page-default' => false,																						// What's the default layout for the home page?
			'home-template' => 'home-panels.php',																				// The file used to render a home page.
			'post-types' => get_option('siteorigin_panels_post_types', array('page', 'post')),									// Post types that can be edited using panels.

			'bundled-widgets' => !isset( $display_settings['bundled-widgets'] ) ? true : $display_settings['bundled-widgets'],	// Include bundled widgets.
			'responsive' => !isset( $display_settings['responsive'] ) ? true : $display_settings['responsive'],				    // Should we use a responsive layout
			'mobile-width' => !isset( $display_settings['mobile-width'] ) ? 780 : $display_settings['mobile-width'],			// What is considered a mobile width?

			'margin-bottom' => !isset( $display_settings['margin-bottom'] ) ? 30 : $display_settings['margin-bottom'],			// Bottom margin of a cell
			'margin-sides' => !isset( $display_settings['margin-sides'] ) ? 30 : $display_settings['margin-sides'],				// Spacing between 2 cells
			'affiliate-id' => false,																							// Set your affiliate ID
			'copy-content' => !isset( $display_settings['copy-content'] ) ? true : $display_settings['copy-content'],			// Should we copy across content
			'animations' => !isset( $display_settings['animations'] ) ? true : $display_settings['animations'],					// Do we need animations
			'inline-css' => !isset( $display_settings['inline-css'] ) ? true : $display_settings['inline-css'],				    // How to display CSS
		) );

		// Filter these settings
		$settings = apply_filters('siteorigin_panels_settings', $settings);
		if( empty( $settings['post-types'] ) ) $settings['post-types'] = array();
	}

	if( !empty( $key ) ) return isset( $settings[$key] ) ? $settings[$key] : null;
	return $settings;
}

/**
 * Add the options page
 */
function siteorigin_panels_options_admin_menu() {
	// add to Genesis menu as last menu item
    add_submenu_page('genesis', 'Page Builder for Genesis', 'Page Builder', 'manage_options', 'page_builder', 'siteorigin_panels_options_page');
}
add_action( 'admin_menu', 'siteorigin_panels_options_admin_menu', 100);

/**
 * Display the admin page.
 */
function siteorigin_panels_options_page(){
	include plugin_dir_path(POOTLEPAGE_BASE_FILE) . '/tpl/options.php';
}

/**
 * Register all the settings fields.
 */
function siteorigin_panels_options_init() {
	register_setting( 'pootlepage-general', 'siteorigin_panels_post_types', 'siteorigin_panels_options_sanitize_post_types' );
	register_setting( 'pootlepage-display', 'siteorigin_panels_display', 'siteorigin_panels_options_sanitize_display' );
    register_setting( 'pootlepage-widgets', 'pootlepage-widgets');

	add_settings_section( 'general', __('General', 'siteorigin-panels'), '__return_false', 'pootlepage-general' );
    add_settings_section( 'widgets', __('Widgets', 'siteorigin-panels'), '__return_false', 'pootlepage-widgets' );
    add_settings_section( 'styling', __('Widgets', 'siteorigin-panels'), 'pootlepage_options_page_styling', 'pootlepage-styling' );
	add_settings_section( 'display', __('Display', 'siteorigin-panels'), '__return_false', 'pootlepage-display' );

	add_settings_field( 'post-types', __('Post Types', 'siteorigin-panels'), 'siteorigin_panels_options_field_post_types', 'pootlepage-general', 'general' );
	add_settings_field( 'copy-content', __('Copy Content to Post Content', 'siteorigin-panels'), 'siteorigin_panels_options_field_display', 'pootlepage-general', 'general', array( 'type' => 'copy-content' ) );
	add_settings_field( 'animations', __('Animations', 'siteorigin-panels'), 'siteorigin_panels_options_field_display', 'pootlepage-general', 'general', array(
		'type' => 'animations',
		'description' => __('Disable animations to improve Page Builder interface performance', 'siteorigin-panels'),
	) );
	add_settings_field( 'bundled-widgets', __('Bundled Widgets', 'siteorigin-panels'), 'siteorigin_panels_options_field_display', 'pootlepage-general', 'general', array( 'type' => 'bundled-widgets' ) );

    // widgets
    add_settings_field( 'reorder-widgets', __('', 'siteorigin-panels'), 'pootlepage_reorder_widgets', 'pootlepage-widgets', 'widgets' );
    add_settings_field( 'unused-widgets', __('', 'siteorigin-panels'), 'pootlepage_unused_widgets', 'pootlepage-widgets', 'widgets' );

	// The display fields
	add_settings_field( 'responsive', __('Responsive', 'siteorigin-panels'), 'siteorigin_panels_options_field_display', 'pootlepage-display', 'display', array( 'type' => 'responsive' ) );
	add_settings_field( 'mobile-width', __('Mobile Width', 'siteorigin-panels'), 'siteorigin_panels_options_field_display', 'pootlepage-display', 'display', array( 'type' => 'mobile-width' ) );
	add_settings_field( 'margin-sides', __('Margin Sides', 'siteorigin-panels'), 'siteorigin_panels_options_field_display', 'pootlepage-display', 'display', array( 'type' => 'margin-sides' ) );
	add_settings_field( 'margin-bottom', __('Margin Bottom', 'siteorigin-panels'), 'siteorigin_panels_options_field_display', 'pootlepage-display', 'display', array( 'type' => 'margin-bottom' ) );
	add_settings_field( 'inline-css', __('Inline CSS', 'siteorigin-panels'), 'siteorigin_panels_options_field_display', 'pootlepage-display', 'display', array(
		'type' => 'inline-css',
		'description' => __('Disabling this will generate CSS using a separate query.', 'siteorigin-panels'),
	));
}
add_action( 'admin_init', 'siteorigin_panels_options_init' );

function pootlepage_options_page_styling() {
    $customizeUrl = admin_url('customize.php');
    echo "<p>Folio uses the WordPress customizer to allow you to style your widgets and preview them easily. Click <a href='" . esc_attr($customizeUrl) . "'>here</a> to go to these settings.</p>";
}

function pootlepage_reorder_widgets() {
    global $wp_widget_factory;

    $widgetSettings = get_option('pootlepage-widgets', array());
    if (!is_array($widgetSettings)) {
        $widgetSettings = array();
    }
    if (!isset($widgetSettings['reorder-widgets'])) {
        $widgetSettings['reorder-widgets'] = '[]';
    }
    if (!isset($widgetSettings['unused-widgets'])) {
        $widgetSettings['unused-widgets'] = '[]';
    }

    $widgetSettings['reorder-widgets'] = json_decode($widgetSettings['reorder-widgets'], true);
    $widgetSettings['unused-widgets'] = json_decode($widgetSettings['unused-widgets'], true);

    if (!is_array($widgetSettings['reorder-widgets'])) {
        $widgetSettings['reorder-widgets'] = array();
    }
    if (!is_array($widgetSettings['unused-widgets'])) {
        $widgetSettings['unused-widgets'] = array();
    }

    if (count($widgetSettings['reorder-widgets']) == 0 &&
        count($widgetSettings['unused-widgets']) == 0
    ) {
        $widgetSettings['reorder-widgets'] = array('Pootle_Text_Widget',
            'SiteOrigin_Panels_Widgets_PostLoop', 'Woo_Widget_Component');

        foreach ($wp_widget_factory->widgets as $class => $widget_obj) {
            if (!in_array($class, $widgetSettings['reorder-widgets'])) {
                $widgetSettings['unused-widgets'][] = $class;
            }
        }

        $usedSequence = $widgetSettings['reorder-widgets'];
    } else {

        $usedSequence = $widgetSettings['reorder-widgets'];

        foreach ($wp_widget_factory->widgets as $class => $widget_obj) {
            if (!in_array($class, $widgetSettings['reorder-widgets']) && !in_array($class, $widgetSettings['unused-widgets'])) {
                $usedSequence[] = $class;
            }
        }

        // make visual editor as first one
        if (in_array('Pootle_Text_Widget', $usedSequence)) {
            $temp = array();
            $temp[] = 'Pootle_Text_Widget';
            foreach ($usedSequence as $class) {
                if ($class != 'Pootle_Text_Widget') {
                    $temp[] = $class;
                }
            }

            $usedSequence = $temp;
        }
    }

    ?>
    <h3>Re-order how widgets appear in page builder by dragging them around</h3>
    <ul class="panel-type-list used-list">

        <?php for ($i = 0; $i < count($usedSequence); ++$i) :
            $class = $usedSequence[$i];
             if (isset($wp_widget_factory->widgets[$class])) {
                 $widget_obj = $wp_widget_factory->widgets[$class];
            ?>
            <li class="panel-type"
                    data-class="<?php echo esc_attr($class) ?>"
                    data-title="<?php echo esc_attr($widget_obj->name) ?>"
                        >
                    <div class="panel-type-wrapper">
                        <h3><?php echo esc_html($widget_obj->name) ?></h3>
            <?php if(!empty($widget_obj->widget_options['description'])) : ?>
                <small class="description"><?php echo esc_html($widget_obj->widget_options['description']) ?></small>
            <?php endif; ?>
            </div>
            </li>
        <?php
             }

        endfor; ?>

        <div class="clear"></div>
    </ul>

    <?php
        $json = json_encode($usedSequence);
    ?>
    <input type="hidden" id="pootlepage_widgets_used" name="pootlepage-widgets[reorder-widgets]" value="<?php esc_attr_e($json) ?>" />

    <?php
}

function pootlepage_unused_widgets() {

    global $wp_widget_factory;

    $widgetSettings = get_option('pootlepage-widgets', array());
    if (!is_array($widgetSettings)) {
        $widgetSettings = array();
    }
    if (!isset($widgetSettings['reorder-widgets'])) {
        $widgetSettings['reorder-widgets'] = '[]';
    }
    if (!isset($widgetSettings['unused-widgets'])) {
        $widgetSettings['unused-widgets'] = '[]';
    }

    $widgetSettings['reorder-widgets'] = json_decode($widgetSettings['reorder-widgets'], true);
    $widgetSettings['unused-widgets'] = json_decode($widgetSettings['unused-widgets'], true);

    if (!is_array($widgetSettings['reorder-widgets'])) {
        $widgetSettings['reorder-widgets'] = array();
    }
    if (!is_array($widgetSettings['unused-widgets'])) {
        $widgetSettings['unused-widgets'] = array();
    }

    if (count($widgetSettings['reorder-widgets']) == 0 &&
        count($widgetSettings['unused-widgets']) == 0
    ) {
        $widgetSettings['reorder-widgets'] = array('Pootle_Text_Widget',
            'SiteOrigin_Panels_Widgets_PostLoop', 'Woo_Widget_Component');

        foreach ($wp_widget_factory->widgets as $class => $widget_obj) {
            if (!in_array($class, $widgetSettings['reorder-widgets'])) {
                $widgetSettings['unused-widgets'][] = $class;
            }
        }

        $usedSequence = $widgetSettings['reorder-widgets'];
    } else {

        $usedSequence = $widgetSettings['reorder-widgets'];

        foreach ($wp_widget_factory->widgets as $class => $widget_obj) {
            if (!in_array($class, $widgetSettings['reorder-widgets']) && !in_array($class, $widgetSettings['unused-widgets'])) {
                $usedSequence[] = $class;
            }
        }

        // make visual editor as first one
        if (in_array('Pootle_Text_Widget', $usedSequence)) {
            $temp = array();
            $temp[] = 'Pootle_Text_Widget';
            foreach ($usedSequence as $class) {
                if ($class != 'Pootle_Text_Widget') {
                    $temp[] = $class;
                }
            }

            $usedSequence = $temp;
        }
    }

    $sequence = $widgetSettings['unused-widgets'];
?>
    <h3>Drag them here if you don't want them to be used with Genesis Page Builder</h3>

    <ul class="panel-type-list unused-list">

        <?php for ($i = 0; $i < count($sequence); ++$i) :
            $class = $sequence[$i];
            if (isset($wp_widget_factory->widgets[$class])) {
                $widget_obj = $wp_widget_factory->widgets[$class];
                ?>
                <li class="panel-type"
                    data-class="<?php echo esc_attr($class) ?>"
                    data-title="<?php echo esc_attr($widget_obj->name) ?>"
                    >
                    <div class="panel-type-wrapper">
                        <h3><?php echo esc_html($widget_obj->name) ?></h3>
                        <?php if(!empty($widget_obj->widget_options['description'])) : ?>
                            <small class="description"><?php echo esc_html($widget_obj->widget_options['description']) ?></small>
                        <?php endif; ?>
                    </div>
                </li>
            <?php
            }

        endfor; ?>

        <div class="clear"></div>
    </ul>
    <?php

    $json = json_encode($sequence);
    ?>
    <input type="hidden" id="pootlepage_widgets_unused" name="pootlepage-widgets[unused-widgets]" value="<?php esc_attr_e($json) ?>" />
    <?php
}

/**
 * Display the field for selecting the post types
 *
 * @param $args
 */
function siteorigin_panels_options_field_post_types($args){
	$panels_post_types = siteorigin_panels_setting('post-types');

	$all_post_types = get_post_types(array('_builtin' => false));
	$all_post_types = array_merge(array('page' => 'page', 'post' => 'post'), $all_post_types);
	unset($all_post_types['ml-slider']);

	foreach($all_post_types as $type){
		$info = get_post_type_object($type);
		if(empty($info->labels->name)) continue;
		$checked = in_array(
			$type,
			$panels_post_types
		);
		
		?>
		<label>
			<input type="checkbox" name="siteorigin_panels_post_types[<?php echo esc_attr($type) ?>]" value="<?php echo esc_attr($type) ?>" <?php checked($checked) ?> />
			<?php echo esc_html($info->labels->name) ?>
		</label><br/>
		<?php
	}
	
	?><p class="description"><?php _e('Post types that will have the page builder available', 'siteorigin-panels') ?></p><?php
}

/**
 * Display the fields for the other settings.
 *
 * @param $args
 */
function siteorigin_panels_options_field_display($args){
	$settings = siteorigin_panels_setting();
	switch($args['type']) {
		case 'responsive' :
		case 'copy-content' :
		case 'animations' :
		case 'inline-css' :
		case 'bundled-widgets' :
			?><label><input type="checkbox" name="siteorigin_panels_display[<?php echo esc_attr($args['type']) ?>]" <?php checked($settings[$args['type']]) ?> /> <?php _e('Enabled', 'siteorigin-panels') ?></label><?php
			break;
		case 'margin-bottom' :
		case 'margin-sides' :
		case 'mobile-width' :
			?><input type="text" name="siteorigin_panels_display[<?php echo esc_attr($args['type']) ?>]" value="<?php echo esc_attr($settings[$args['type']]) ?>" class="small-text" /> <?php _e('px', 'siteorigin-panels') ?><?php
			break;
	}

	if(!empty($args['description'])) {
		?><p class="description"><?php echo esc_html($args['description']) ?></p><?php
	}
}

/**
 * Check that we have valid post types
 *
 * @param $types
 * @return array
 */
function siteorigin_panels_options_sanitize_post_types($types){
	if(empty($types)) return array();
	$all_post_types = get_post_types(array('_builtin' => false));
	$all_post_types = array_merge(array('post' => 'post', 'page' => 'page'), $all_post_types);
	foreach($types as $type => $val){
		if(!in_array($type, $all_post_types)) unset($types[$type]);
		else $types[$type] = !empty($types[$type]);
	}
	
	// Only non empty items
	return array_keys(array_filter($types));
}

/**
 * Sanitize the other options fields
 *
 * @param $vals
 * @return mixed
 */
function siteorigin_panels_options_sanitize_display($vals){
	foreach($vals as $f => $v){
		switch($f){
			case 'inline-css' :
			case 'responsive' :
			case 'copy-content' :
			case 'animations' :
			case 'bundled-widgets' :
				$vals[$f] = !empty($vals[$f]);
				break;
			case 'margin-bottom' :
			case 'margin-sides' :
			case 'mobile-width' :
				$vals[$f] = intval($vals[$f]);
				break;
		}
	}
	$vals['responsive'] = !empty($vals['responsive']);
	$vals['copy-content'] = !empty($vals['copy-content']);
	$vals['animations'] = !empty($vals['animations']);
	$vals['inline-css'] = !empty($vals['inline-css']);
	$vals['bundled-widgets'] = !empty($vals['bundled-widgets']);
	return $vals;
}