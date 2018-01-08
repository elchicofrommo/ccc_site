<?php
// Set prefix
$prefix = 'ccc';
$panel_id = $prefix . '_testimonials_general';

/***********************************************/
/******************* General *******************/
/***********************************************/
$wp_customize->add_section( $prefix . '_testimonials_general' ,
    array(
        'title'         => __( 'Testimonials Section', 'ccc' ),
        'description'   => __( 'Control various options for testimonials section from front page.', 'ccc' ),
        'priority'      => ccc_get_section_position($prefix . '_testimonials_general'),
        'panel'     => 'homepage_customizer',
    )
);

// Show this section
$wp_customize->add_setting( $prefix . '_testimonials_general_show',
    array(
        'sanitize_callback' => $prefix . '_sanitize_checkbox',
        'default'           => 1,
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control( new Epsilon_Control_Toggle( $wp_customize,
    $prefix . '_testimonials_general_show',
    array(
        'type'      => 'mte-toggle',
        'label'     => __( 'Show this section?', 'ccc' ),
        'section'   => $prefix . '_testimonials_general',
        'priority'  => 1,
    ))
);

// Title
$wp_customize->add_setting( $prefix .'_testimonials_general_title',
    array(
        'sanitize_callback' => 'ccc_sanitize_html',
        'default'           => __( 'Testimonials', 'ccc' ),
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $prefix .'_testimonials_general_title',
    array(
        'label'             => __( 'Title', 'ccc' ),
        'description'       => __( 'Add the title for this section.', 'ccc'),
        'section'           => $prefix . '_testimonials_general',
        'priority'          => 2,
    )
);
$wp_customize->selective_refresh->add_partial( $prefix .'_testimonials_general_title', array(
    'selector' => '#testimonials .section-header h3',
) );

$wp_customize->add_setting( $prefix .'_testimonial_widget_button',
    array(
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
    )
);
$wp_customize->add_control(
    new Epsilon_Control_Button(
        $wp_customize,
        $prefix .'_testimonial_widget_button',
        array(
            'text'         => __( 'Add & Edit Testimonials', 'ccc' ),
            'section_id'    => 'sidebar-widgets-front-page-testimonials-sidebar',
            'icon'          => 'dashicons-plus',
            'section'       => $panel_id,
            'priority'      => 5
        )
    )
);


$wp_customize->add_setting( $prefix . '_testimonials_tab', array(
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
    )
);
$wp_customize->add_control(  new Epsilon_Control_Tab( $wp_customize,
    $prefix . '_testimonials_tab',
    array(
        'type'      => 'epsilon-tab',
        'section'   => $panel_id,
        'buttons'   => array(
            array(
                'name' => __( 'Colors', 'ccc' ),
                'fields'    => array(
                    $prefix . '_testimonials_title_color',
                    $prefix . '_testimonials_dots_color',
                    $prefix . '_testimonials_general_color',
                    $prefix . '_testimonials_author_text_color',
                    $prefix . '_testimonials_text_color',
                    $prefix . '_testimonials_container_background_color',
                    ),
                'active' => true
                ),
            array(
                'name' => __( 'Backgrounds', 'ccc' ),
                'fields'    => array(
                    $prefix . '_testimonials_general_background_image',
                    $prefix . '_testimonials_background_size',
                    $prefix . '_testimonials_background_repeat',
                    $prefix . '_testimonials_background_attachment',
                    $prefix . '_testimonials_background_position',
                    ),
                ),
            ),
    ) )
);

// Background Image
$wp_customize->add_setting( $prefix . '_testimonials_general_background_image', array(
    'sanitize_callback' => 'esc_url',
    'default'           => esc_url( get_template_directory_uri() . '/layout/images/testiomnials-background.jpg' ),
    'transport'         => 'postMessage',
) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $prefix . '_testimonials_general_background_image', array(
    'label'    => __( 'Background Image', 'ccc' ),
    'section'  => $panel_id,
    'settings' => $prefix . '_testimonials_general_background_image',
) ) );
$wp_customize->add_setting( $prefix.'_testimonials_background_position_x', array(
    'default'        => 'center',
    'sanitize_callback' => 'esc_html',
    'transport'         => 'postMessage',
) );
$wp_customize->add_setting( $prefix.'_testimonials_background_position_y', array(
    'default'        => 'center',
    'sanitize_callback' => 'esc_html',
    'transport'         => 'postMessage',
) );
$wp_customize->add_control( new WP_Customize_Background_Position_Control( $wp_customize, $prefix.'_testimonials_background_position', array(
    'label'    => __( 'Background Position', 'ccc' ),
    'section'  => $prefix . '_testimonials_general',
    'settings' => array(
        'x' => $prefix.'_testimonials_background_position_x',
        'y' => $prefix.'_testimonials_background_position_y',
    ),
) ) );
$wp_customize->add_setting( $prefix . '_testimonials_background_size', array(
    'default' => 'cover',
    'sanitize_callback' => 'ccc_sanitize_background_size',
    'transport'         => 'postMessage',
) );
$wp_customize->add_control( $prefix . '_testimonials_background_size', array(
    'label'      => __( 'Image Size', 'ccc' ),
    'section'    => $panel_id,
    'type'       => 'select',
    'choices'    => array(
        'auto'    => __( 'Original', 'ccc' ),
        'contain' => __( 'Fit to Screen', 'ccc' ),
        'cover'   => __( 'Fill Screen', 'ccc' ),
    ),
) );

$wp_customize->add_setting( $prefix . '_testimonials_background_repeat', array(
    'sanitize_callback' => $prefix . '_sanitize_checkbox',
    'default'           => 0,
    'transport'         => 'postMessage',
) );

$wp_customize->add_control(  new Epsilon_Control_Toggle( $wp_customize, $prefix . '_testimonials_background_repeat', array(
    'type'        => 'mte-toggle',
    'label'       => __( 'Repeat Background Image', 'ccc' ),
    'section'     => $panel_id,
) ) );

$wp_customize->add_setting( $prefix . '_testimonials_background_attachment', array(
    'sanitize_callback' => $prefix . '_sanitize_checkbox',
    'default'           => 0,
    'transport'         => 'postMessage',
) );

$wp_customize->add_control(  new Epsilon_Control_Toggle( $wp_customize, $prefix . '_testimonials_background_attachment', array(
    'type'        => 'mte-toggle',
    'label'       => __( 'Scroll with Page', 'ccc' ),
    'section'     => $panel_id,
) ) );

$wp_customize->add_setting( $prefix . '_testimonials_general_color', array(
    'sanitize_callback' => 'sanitize_hex_color',
    'default'           => '#fff',
    'transport'         => 'postMessage',

) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix . '_testimonials_general_color', array(
    'label'    => __( 'Background Color', 'ccc' ),
    'section'  => $panel_id,
    'settings' => $prefix . '_testimonials_general_color',
) ) );

$wp_customize->add_setting( $prefix . '_testimonials_title_color', array(
    'sanitize_callback' => 'sanitize_hex_color',
    'default'           => '#fff',
    'transport'         => 'postMessage',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix . '_testimonials_title_color', array(
    'label'    => __( 'Title Color', 'ccc' ),
    'section'  => $panel_id,
    'settings' => $prefix . '_testimonials_title_color',
) ) );

$wp_customize->add_setting( $prefix . '_testimonials_container_background_color', array(
    'sanitize_callback' => 'sanitize_hex_color',
    'default'           => '#6a4d8a',
    'transport'         => 'postMessage',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix . '_testimonials_container_background_color', array(
    'label'    => __( 'Testimonial Container Color', 'ccc' ),
    'section'  => $panel_id,
    'settings' => $prefix . '_testimonials_container_background_color',
) ) );

$wp_customize->add_setting( $prefix . '_testimonials_text_color', array(
    'sanitize_callback' => 'sanitize_hex_color',
    'default'           => '#fff',
    'transport'         => 'postMessage',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix . '_testimonials_text_color', array(
    'label'    => __( 'Testimonial Content Color', 'ccc' ),
    'section'  => $panel_id,
    'settings' => $prefix . '_testimonials_text_color',
) ) );

$wp_customize->add_setting( $prefix . '_testimonials_author_text_color', array(
    'sanitize_callback' => 'sanitize_hex_color',
    'default'           => '#fff',
    'transport'         => 'postMessage',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix . '_testimonials_author_text_color', array(
    'label'    => __( 'Testimonial Author Text Color', 'ccc' ),
    'section'  => $panel_id,
    'settings' => $prefix . '_testimonials_author_text_color',
) ) );

$wp_customize->add_setting( $prefix . '_testimonials_dots_color', array(
    'sanitize_callback' => 'sanitize_hex_color',
    'default'           => '#fff',
    'transport'         => 'postMessage',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix . '_testimonials_dots_color', array(
    'label'    => __( 'Testimonial Dots Color', 'ccc' ),
    'section'  => $panel_id,
    'settings' => $prefix . '_testimonials_dots_color',
) ) );