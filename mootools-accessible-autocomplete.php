<?php

/* 
	Plugin Name: Mootools Accessible Autocomplete
	Plugin URI: http://wordpress.org/extend/plugins/mootools-accessible-autocomplete/
	Description: WAI-ARIA Enabled Autocomplete Plugin for Wordpress
	Version: 1.0
	Author: Votis Konstantinos
	Author URI: http://iti.gr/iti/people/Konstantinos_Votis.html
*/

/**
 * Widget Class
 */
class MootoolsAccessibleAutocomplete extends WP_Widget
{    
    function __construct()
    {
		$widget_ops = array('classname' => 'widget_mootools_accessible_autocomplete', 'description' => __( 'Mootools Accessible Autocomplete' ) );
		parent::__construct('mootools-accessible-autocomplete', __('Mootools Accessible Autocomplete'), $widget_ops);
		$this->alt_option_name = 'widget_mootools_accessible_autocomplete';
		
		if (is_active_widget(false, false, $this->id_base))
		{
			// styles
			wp_register_style('autocomplete_style', (get_bloginfo('wpurl') . '/wp-content/plugins/mootools-accessible-autocomplete/css/style.css'));
			wp_enqueue_style('autocomplete_style');
			
			// scripts
			wp_deregister_script('jquery');
			wp_register_script('jquery', (get_bloginfo('wpurl') .'/wp-includes/js/jquery/jquery.js'));
			wp_enqueue_script('jquery');

			wp_register_script('mootools-core', (get_bloginfo('wpurl') . '/wp-content/plugins/mootools-accessible-autocomplete/js/libs/mootools-core.js'));
			wp_enqueue_script('mootools-core');
			
			wp_register_script('autocomplete', (get_bloginfo('wpurl') . '/wp-content/plugins/mootools-accessible-autocomplete/js/libs/autocomplete.js'));
			wp_enqueue_script('autocomplete');

			wp_register_script('autocomplete_script', (get_bloginfo('wpurl') . '/wp-content/plugins/mootools-accessible-autocomplete/js/script.js'));
			wp_enqueue_script('autocomplete_script');
		}
	}

    /** @see WP_Widget::widget */
    function widget($args, $instance)
    {	
        extract( $args );
        
        // options
        $title = apply_filters('widget_title', $instance['title']);
        if(!$title)
		{
			$title = 'Mootools Accessible Autocomplete';
		}
        
        echo $before_widget;
        
        // if the title is set
		if ( $title )
		{
			echo $before_title . $title . $after_title;
		}
		
		// content
		echo 
		'<div>
			<input name="searchfield" id="searchfield" class="goocompleter_field" type="text" autocomplete="off" />
			<button id="searchsubmit" class="button">View post</button>
		</div>';
		
		echo $after_widget;
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance)
    {		
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		
        return $instance;
    }

    /** @see WP_Widget::form */
    function form($instance)
    {	
		$title = esc_attr($instance['title']);		
		
		?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title:'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
			</p>
		<?php
    }
} // Widget Class

// register widget
add_action('widgets_init', create_function('', 'register_widget("MootoolsAccessibleAutocomplete");'));

?>
