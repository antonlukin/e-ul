<?php
/**
 * Feedback widget
 *
 * @package e-ul
 * @since 1.2
 */

class Eul_Widget_Feedback extends WP_Widget {
    public function __construct() {
        $options = array(
            'classname' => 'feedback',
            'description' => __( 'Выводит блок обратной связи', 'e-ul' ),
            'customize_selective_refresh' => true
        );

        parent::__construct( 'eul_widget_feedback', __( 'Виджет обратной связи', 'knife-theme' ), $options );
    }


    /**
     * Outputs the content of the widget.
     */
    public function widget( $args, $instance ) {
        $defaults = [
            'title' => '',
            'text' => ''
        ];

        $instance = wp_parse_args( (array) $instance, $defaults );

        if ( ! empty( $instance['text'] ) ) {
            $instance['text'] = wpautop( $instance['text'] );
        }

        include( get_template_directory() . '/template-parts/widget-feedback.php' );
    }


    /**
     * Sanitize widget form values as they are saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $instance['title'] = sanitize_text_field( $new_instance['title'] );
        $instance['text'] = sanitize_textarea_field( $new_instance['text'] );

        return $instance;
    }


    /**
     * Back-end widget form.
     */
    function form( $instance ) {
        $defaults = [
            'title' => '',
            'text' => ''
        ];

        $instance = wp_parse_args( (array) $instance, $defaults );

        printf(
            '<p><label for="%1$s">%3$s</label><input class="widefat" id="%1$s" name="%2$s" type="text" value="%4$s"></p>',
            esc_attr( $this->get_field_id( 'title' ) ),
            esc_attr( $this->get_field_name( 'title' ) ),
            __( 'Заголовок:', 'e-ul' ),
            esc_attr( $instance['title'] )
        );

        printf(
            '<p><label for="%1$s">%3$s</label><textarea class="widefat" rows="8" id="%1$s" name="%2$s">%4$s</textarea></p>',
            esc_attr( $this->get_field_id( 'text' ) ),
            esc_attr( $this->get_field_name( 'text' ) ),
            __( 'Содержимое:', 'e-ul' ),
            esc_attr( $instance['text'] )
        );
    }
}


/**
 * It is time to register widget
 */
register_widget( 'Eul_Widget_Feedback' );