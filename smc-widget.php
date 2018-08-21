<?php
$curtm = wp_get_theme();

if ( $curtm->get('AuthorURI') == 'https://mahathemes.com' ) {
    add_action('widgets_init', 'maha_widget_load_smc');
}

function maha_widget_load_smc()
{
    register_widget('maha_social_counter');
}

class maha_social_counter extends WP_Widget
{
    public function __construct()
    {
        parent::__construct(
            'maha_smc', // Base ID
            __('Maha - Social Media Counter'), // Name
            array(
              'width' => 290,
              'height' => 300,
              'id_base' => 'maha_widget_smc'
            ), // Control
            array(
              'classname' => 'maha_smc',
              'description' => __('Widget to Social Media links with fans number'),
            ) // Setting
        );
    }


    public function widget($args, $instance)
    {
        extract($args);

        /* Our variables from the widget settings. */
        $title = apply_filters('widget_title', $instance['title']);
        $tw_label = $instance['tw_label'];
        $tw_id = $instance['tw_id'];
        $fb_label = $instance['fb_label'];
        $fb_id = $instance['fb_id'];
        $yt_label = $instance['yt_label'];
        $yt_id = $instance['yt_id'];
        $gp_label = $instance['gp_label'];
        $gp_id = $instance['gp_id'];
        $ig_label = $instance['ig_label'];
        $ig_id = $instance['ig_id'];
        $pin_label = $instance['pin_label'];
        $pin_id = $instance['pin_id'];
        $sc_label = $instance['sc_label'];
        $sc_id = $instance['sc_id'];
        // $tb_label = $instance['tb_label'];
        // $tb_id = $instance['tb_id'];
        $rss_title = $instance['rss_title'];
        $rss_label = $instance['rss_label'];
        $rss_url = $instance['rss_url'];

        /* Before widget (defined by themes). */
        echo $before_widget;

        $smc_api = new Maha_SocialApi();

        /* Display the widget title if one was input (before and after defined by themes). */
        if ($title) {
            echo $before_title . $title . $after_title;
        } ?>

        <?php if ($ig_id) {
            $ig_count = $smc_api->get_social_counter('instagram', $ig_id, $widget_id); ?>
  			<div class="social-network instagram">
  				<a class="social-network-icon trans-it" target="_blank" href="https://instagram.com/<?php echo $ig_id; ?>"><i class="tm-instagram trans-it"></i></a>
  				<div class="social-network-counter">
  					<div class="social-network-count"><?php echo $ig_count['count']; ?></div>
  					<div class="social-network-unit"><?php echo $ig_label; ?></div>
  				</div>
  				<div class="clearfix"></div>
  			</div>
		<?php
        } ?>

        <?php if ($fb_id) {
            $fb_count = $smc_api->get_social_counter('facebook', $fb_id, $widget_id); ?>
  			<div class="social-network facebook">
  				<a class="social-network-icon trans-it" target="_blank" href="https://facebook.com/<?php echo $fb_id; ?>"><i class="tm-facebook trans-it"></i></a>
  				<div class="social-network-counter">
  					<div class="social-network-count"><?php echo $fb_count['count']; ?></div>
  					<div class="social-network-unit"><?php echo $fb_label; ?></div>
  				</div>
  				<div class="clearfix"></div>
  			</div>
		<?php
        } ?>

        <?php if ($tw_id) {
            $tw_count = $smc_api->get_social_counter('twitter', $tw_id, $widget_id); ?>
  			<div class="social-network twitter">
  				<a class="social-network-icon trans-it" target="_blank" href="https://twitter.com/<?php echo $tw_id; ?>"><i class="tm-twitter trans-it"></i></a>
  				<div class="social-network-counter">
  					<div class="social-network-count"><?php echo $tw_count['count']; ?></div>
  					<div class="social-network-unit"><?php echo $tw_label; ?></div>
  				</div>
  				<div class="clearfix"></div>
  			</div>
		<?php
        } ?>

        <?php if ($yt_id) {
            $yt_count = $smc_api->get_social_counter('youtube', $yt_id, $widget_id); ?>
  			<div class="social-network youtube">
  				<a class="social-network-icon trans-it" target="_blank" href="https://www.youtube.com/<?php echo $yt_id; ?>"><i class="tm-youtube trans-it"></i></a>
  				<div class="social-network-counter">
  					<div class="social-network-count"><?php echo $yt_count['count']; ?></div>
  					<div class="social-network-unit"><?php echo $yt_label; ?></div>
  				</div>
  				<div class="clearfix"></div>
  			</div>
		<?php
        } ?>

        <?php if ($gp_id) {
            $gp_count = $smc_api->get_social_counter('googleplus', $gp_id, $widget_id); ?>
  			<div class="social-network gplus">
  				<a class="social-network-icon trans-it" target="_blank" href="https://plus.google.com/<?php echo $gp_id; ?>"><i class="tm-googleplus trans-it"></i></a>
  				<div class="social-network-counter">
  					<div class="social-network-count"><?php echo $gp_count['count']; ?></div>
  					<div class="social-network-unit"><?php echo $gp_label; ?></div>
  				</div>
  				<div class="clearfix"></div>
  			</div>
		<?php
        } ?>

        <?php if ($pin_id) {
            $pin_count = $smc_api->get_social_counter('pinterest', $pin_id, $widget_id); ?>
  			<div class="social-network pinterest">
  				<a class="social-network-icon trans-it" target="_blank" href="https://pinterest.com/<?php echo $pin_id; ?>"><i class="tm-pinterest trans-it"></i></a>
  				<div class="social-network-counter">
  					<div class="social-network-count"><?php echo $pin_count['count']; ?></div>
  					<div class="social-network-unit"><?php echo $pin_label; ?></div>
  				</div>
  				<div class="clearfix"></div>
  			</div>
		<?php
        } ?>

        <?php if ($sc_id) {
            $sc_count = $smc_api->get_social_counter('soundcloud', $sc_id, $widget_id); ?>
  			<div class="social-network soundcloud">
  				<a class="social-network-icon trans-it" target="_blank" href="https://soundcloud.com/<?php echo $sc_id; ?>"><i class="tm-soundcloud trans-it"></i></a>
  				<div class="social-network-counter">
  					<div class="social-network-count"><?php echo $sc_count['count']; ?></div>
  					<div class="social-network-unit"><?php echo $sc_label; ?></div>
  				</div>
  				<div class="clearfix"></div>
  			</div>
		<?php
        } ?>

        <?php if ($rss_url) { ?>
  			<div class="social-network rss">
  				<a class="social-network-icon trans-it" target="_blank" href="<?php echo $rss_url; ?>"><i class="tm-rss trans-it"></i></a>
  				<div class="social-network-counter">
  					<div class="social-network-count"><?php echo $rss_title; ?></div>
  					<div class="social-network-unit"><?php echo $rss_label; ?></div>
  				</div>
  				<div class="clearfix"></div>
  			</div>
		<?php
        } ?>

		<?php

        /* After widget (defined by themes). */
        echo $after_widget;
    }

    /**
     * Update the widget settings.
     */
    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;

        /* Strip tags for title and name to remove HTML (important for text inputs). */
        $instance['title'] = strip_tags($new_instance['title']);

        $instance['tw_id'] = strip_tags($new_instance['tw_id']);
        $instance['tw_label'] = strip_tags($new_instance['tw_label']);

        $instance['fb_id'] = strip_tags($new_instance['fb_id']);
        $instance['fb_label'] = strip_tags($new_instance['fb_label']);

        $instance['ig_id'] = strip_tags($new_instance['ig_id']);
        $instance['ig_label'] = strip_tags($new_instance['ig_label']);

        $instance['yt_id'] = strip_tags($new_instance['yt_id']);
        $instance['yt_label'] = strip_tags($new_instance['yt_label']);

        $instance['gp_id'] = strip_tags($new_instance['gp_id']);
        $instance['gp_label'] = strip_tags($new_instance['gp_label']);

        $instance['pin_id'] = strip_tags($new_instance['pin_id']);
        $instance['pin_label'] = strip_tags($new_instance['pin_label']);

        $instance['sc_id'] = strip_tags($new_instance['sc_id']);
        $instance['sc_label'] = strip_tags($new_instance['sc_label']);

        // $instance['tb_id'] = strip_tags($new_instance['tb_id']);
        // $instance['tb_label'] = strip_tags($new_instance['tb_label']);

        $instance['rss_title'] = strip_tags($new_instance['rss_title']);
        $instance['rss_label'] = strip_tags($new_instance['rss_label']);
        $instance['rss_url'] = strip_tags($new_instance['rss_url']);

        return $instance;
    }


    public function form($instance)
    {

        /* Set up some default widget settings. */
        $defaults = array(
            'title' => 'Get Connect',
            'tw_label' => '',
            'tw_id' => '',
            'fb_label' => '',
            'fb_id' => '',
            'pin_label' => '',
            'pin_id' => '',
            // 'tb_label' => '',
            // 'tb_id' => '',
            'yt_label' => '',
            'yt_id' => '',
            'gp_label' => '',
            'gp_id' => '',
            'sc_label' => '',
            'sc_id' => '',
            'rss_url' => '',
            'rss_label' => '',
            'rss_title' => '',
            'ig_label' => '',
            'ig_id' => ''
        );
        $instance = wp_parse_args((array) $instance, $defaults); ?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" style="width:96%;" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('fb_label'); ?>">Facebook Caption:</label>
			<input id="<?php echo $this->get_field_id('fb_label'); ?>" name="<?php echo $this->get_field_name('fb_label'); ?>" value="<?php echo $instance['fb_label']; ?>" style="width:96%;" /><br />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id('fb_id'); ?>">Facebook ID:</label>
			<input id="<?php echo $this->get_field_id('fb_id'); ?>" name="<?php echo $this->get_field_name('fb_id'); ?>" value="<?php echo $instance['fb_id']; ?>" style="width:96%;" /><br />
		</p>

        <p>
			<label for="<?php echo $this->get_field_id('ig_label'); ?>">Instagram Caption:</label>
			<input id="<?php echo $this->get_field_id('ig_label'); ?>" name="<?php echo $this->get_field_name('ig_label'); ?>" value="<?php echo $instance['ig_label']; ?>" style="width:96%;" /><br />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id('ig_id'); ?>">Instagram Username:</label>
			<input id="<?php echo $this->get_field_id('ig_id'); ?>" name="<?php echo $this->get_field_name('ig_id'); ?>" value="<?php echo $instance['ig_id']; ?>" style="width:96%;" /><br />
		</p>

        <p>
			<label for="<?php echo $this->get_field_id('tw_label'); ?>">Twitter Caption:</label>
			<input id="<?php echo $this->get_field_id('tw_label'); ?>" name="<?php echo $this->get_field_name('tw_label'); ?>" value="<?php echo $instance['tw_label']; ?>" style="width:96%;" /><br />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id('tw_id'); ?>">Twitter Username:</label>
			<input id="<?php echo $this->get_field_id('tw_id'); ?>" name="<?php echo $this->get_field_name('tw_id'); ?>" value="<?php echo $instance['tw_id']; ?>" style="width:96%;" /><br />
		</p>

        <p>
			<label for="<?php echo $this->get_field_id('yt_label'); ?>">Youtube Caption:</label>
			<input id="<?php echo $this->get_field_id('yt_label'); ?>" name="<?php echo $this->get_field_name('yt_label'); ?>" value="<?php echo $instance['yt_label']; ?>" style="width:96%;" /><br />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id('yt_id'); ?>">Youtube ID:</label>
			<input id="<?php echo $this->get_field_id('yt_id'); ?>" name="<?php echo $this->get_field_name('yt_id'); ?>" value="<?php echo $instance['yt_id']; ?>" style="width:96%;" /><br />
		</p>

        <p>
			<label for="<?php echo $this->get_field_id('gp_label'); ?>">Google+ Caption:</label>
			<input id="<?php echo $this->get_field_id('gp_label'); ?>" name="<?php echo $this->get_field_name('gp_label'); ?>" value="<?php echo $instance['gp_label']; ?>" style="width:96%;" /><br />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id('gp_id'); ?>">Google+ ID:</label>
			<input id="<?php echo $this->get_field_id('gp_id'); ?>" name="<?php echo $this->get_field_name('gp_id'); ?>" value="<?php echo $instance['gp_id']; ?>" style="width:96%;" /><br />
            <p>Please use "+" for the Google+ ID. If using id number, don't put the "+"</p>
		</p>

        <p>
			<label for="<?php echo $this->get_field_id('pin_label'); ?>">Pinterest Caption:</label>
			<input id="<?php echo $this->get_field_id('pin_label'); ?>" name="<?php echo $this->get_field_name('pin_label'); ?>" value="<?php echo $instance['pin_label']; ?>" style="width:96%;" /><br />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id('pin_id'); ?>">Pinterest ID:</label>
			<input id="<?php echo $this->get_field_id('pin_id'); ?>" name="<?php echo $this->get_field_name('pin_id'); ?>" value="<?php echo $instance['pin_id']; ?>" style="width:96%;" /><br />
		</p>

        <!-- <p>
			<label for="<?php echo $this->get_field_id('tb_label'); ?>">Tumblr Caption:</label>
			<input id="<?php echo $this->get_field_id('tb_label'); ?>" name="<?php echo $this->get_field_name('tb_label'); ?>" value="<?php echo $instance['tb_label']; ?>" style="width:96%;" /><br />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id('tb_id'); ?>">Tumblr ID:</label>
			<input id="<?php echo $this->get_field_id('tb_id'); ?>" name="<?php echo $this->get_field_name('tb_id'); ?>" value="<?php echo $instance['tb_id']; ?>" style="width:96%;" /><br />
		</p> -->

        <p>
			<label for="<?php echo $this->get_field_id('sc_label'); ?>">Soundcloud Caption:</label>
			<input id="<?php echo $this->get_field_id('sc_label'); ?>" name="<?php echo $this->get_field_name('sc_label'); ?>" value="<?php echo $instance['sc_label']; ?>" style="width:96%;" /><br />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id('sc_id'); ?>">Soundcloud ID:</label>
			<input id="<?php echo $this->get_field_id('sc_id'); ?>" name="<?php echo $this->get_field_name('sc_id'); ?>" value="<?php echo $instance['sc_id']; ?>" style="width:96%;" /><br />
		</p>

        <p>
			<label for="<?php echo $this->get_field_id('rss_title'); ?>">RSS Title:</label>
			<input id="<?php echo $this->get_field_id('rss_title'); ?>" name="<?php echo $this->get_field_name('rss_title'); ?>" value="<?php echo $instance['rss_title']; ?>" style="width:96%;" /><br />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id('rss_label'); ?>">RSS Name:</label>
			<input id="<?php echo $this->get_field_id('rss_label'); ?>" name="<?php echo $this->get_field_name('rss_label'); ?>" value="<?php echo $instance['rss_label']; ?>" style="width:96%;" /><br />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id('rss_url'); ?>">RSS URL:</label>
			<input id="<?php echo $this->get_field_id('rss_url'); ?>" name="<?php echo $this->get_field_name('rss_url'); ?>" value="<?php echo $instance['rss_url']; ?>" style="width:96%;" /><br />
		</p>
        <p>
            If you have any issue with this widget, please try to delete this widget. Or you can try reinstall the plugin to get the latest version of the plugin.
        </p>


	  <?php
    }
}
?>
