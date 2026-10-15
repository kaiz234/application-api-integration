<?php
/**
 * Plugin Name: Qhaiz API Integration Demo
 * Description: A safe, self-contained demo of displaying API-style data in WordPress using a shortcode.
 * Version: 1.0.0
 * Author: Qhaiz
 * License: GPL-2.0-or-later
 * Text Domain: qhaiz-api-demo
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Return synthetic event data.
 *
 * This is intentionally mocked so the demo works in WordPress Playground
 * without relying on an external API, credentials, or network access.
 *
 * Replace this provider with a validated API client when connecting a real API.
 *
 * @return array<int, array<string, string>>
 */
function qhaiz_api_demo_get_events() {
    return array(
        array(
            'title'       => 'Web Development Workshop',
            'date'        => '2026-11-12',
            'description' => 'A sample event demonstrating how API data can be displayed in WordPress.',
        ),
        array(
            'title'       => 'Application Integration Lab',
            'date'        => '2026-11-19',
            'description' => 'A synthetic record for testing data rendering and output escaping.',
        ),
        array(
            'title'       => 'Automation Fundamentals',
            'date'        => '2026-11-26',
            'description' => 'A sample event showing a second type of application workflow.',
        ),
    );
}

/**
 * Render the demo events.
 *
 * Usage: [qhaiz_api_demo]
 *
 * @return string
 */
function qhaiz_api_demo_render_shortcode() {
    $events = qhaiz_api_demo_get_events();

    ob_start();
    ?>
    <section class="qhaiz-api-demo" aria-labelledby="qhaiz-api-demo-title">
        <h2 id="qhaiz-api-demo-title"><?php echo esc_html__('API Integration Demo', 'qhaiz-api-demo'); ?></h2>
        <p class="qhaiz-api-demo__intro">
            <?php echo esc_html__('Sample event records rendered by a WordPress shortcode. Data is mocked for this demo.', 'qhaiz-api-demo'); ?>
        </p>

        <?php if (empty($events)) : ?>
            <p class="qhaiz-api-demo__empty">
                <?php echo esc_html__('No events are currently available.', 'qhaiz-api-demo'); ?>
            </p>
        <?php else : ?>
            <div class="qhaiz-api-demo__events">
                <?php foreach ($events as $event) : ?>
                    <article class="qhaiz-api-demo__event">
                        <h3><?php echo esc_html(isset($event['title']) ? $event['title'] : ''); ?></h3>
                        <?php if (!empty($event['date'])) : ?>
                            <p class="qhaiz-api-demo__date">
                                <strong><?php echo esc_html__('Date:', 'qhaiz-api-demo'); ?></strong>
                                <time datetime="<?php echo esc_attr($event['date']); ?>">
                                    <?php echo esc_html($event['date']); ?>
                                </time>
                            </p>
                        <?php endif; ?>
                        <p><?php echo esc_html(isset($event['description']) ? $event['description'] : ''); ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode('qhaiz_api_demo', 'qhaiz_api_demo_render_shortcode');

/**
 * Add lightweight styles only when the shortcode is present.
 */
function qhaiz_api_demo_enqueue_styles() {
    if (!is_singular()) {
        return;
    }

    global $post;

    if (!($post instanceof WP_Post) || !has_shortcode($post->post_content, 'qhaiz_api_demo')) {
        return;
    }

    $css = '
        .qhaiz-api-demo { max-width: 900px; margin: 2rem auto; color: #202124; }
        .qhaiz-api-demo__intro { color: #5f6368; }
        .qhaiz-api-demo__events { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1rem; }
        .qhaiz-api-demo__event { padding: 1.25rem; border: 1px solid #d9dee5; border-radius: 10px; background: #fff; }
        .qhaiz-api-demo__event h3 { margin-top: 0; }
        .qhaiz-api-demo__date { font-size: .95rem; }
        .qhaiz-api-demo__empty { padding: 1rem; border: 1px dashed #9aa0a6; }
    ';

    wp_register_style('qhaiz-api-demo-inline', false, array(), '1.0.0');
    wp_enqueue_style('qhaiz-api-demo-inline');
    wp_add_inline_style('qhaiz-api-demo-inline', $css);
}
add_action('wp_enqueue_scripts', 'qhaiz_api_demo_enqueue_styles');
