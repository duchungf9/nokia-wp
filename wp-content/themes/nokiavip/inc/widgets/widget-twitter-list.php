<?php
/**
 * Twitter List Widget.
 *
 * @package    Saha
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */
class Saha_Twitter_List_Widget extends WP_Widget {

	/**
	 * Sets up the widgets.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		// Set up the widget options.
		$widget_options = array(
			'classname'   => 'widget-saha-twitter-list twitter-list-widget',
			'description' => __( 'Adds support for your tweets.', 'saha' )
		);

		// Create the widget.
		parent::__construct(
			'saha-twitter-list', 					// $this->id_base
			__( '&raquo; Twitter List', 'saha' ), 	// $this->name
			$widget_options                 		// $this->widget_options
		);
	}

	/**
	 * Outputs the widget based on the arguments input through the widget controls.
	 *
	 * @since 1.0.0
	 */
	function widget( $args, $instance ) {
		extract( $args );
		$consumer_key 			= $instance['consumer_key'];
		$consumer_secret 		= $instance['consumer_secret'];
		$access_token 			= $instance['access_token'];
		$access_token_secret 	= $instance['access_token_secret'];
		$twitter_username 		= $instance['twitter_username'];
		$count 					= (int) $instance['count'];
		$widget_id 				= $args['widget_id'];

		// Output the theme's $before_widget wrapper.
		echo $before_widget;

		// If the title not empty, display it.
		if ( $instance['title'] ) {
			echo $before_title . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $after_title;
		}

			if ( $twitter_username && $consumer_key && $consumer_secret && $access_token && $access_token_secret && $count ) {
				$transName = 'list_tweets_'.$widget_id;
				$cacheTime = 10;
				if(false === ($twitterData = get_transient($transName))) {

					$token = get_option('cfTwitterToken_'.$widget_id);

					// get a new token anyways
					delete_option('cfTwitterToken_'.$widget_id);

					// getting new auth bearer only if we don't have one
					if(!$token) {
						// preparing credentials
						$credentials = $consumer_key . ':' . $consumer_secret;
						$toSend = base64_encode($credentials);

						// http post arguments
						$args = array(
							'method' 		=> 'POST',
							'httpversion' 	=> '1.1',
							'blocking' 		=> true,
							'headers' 		=> array(
								'Authorization' => 'Basic ' . $toSend,
								'Content-Type' 	=> 'application/x-www-form-urlencoded;charset=UTF-8'
							),
							'body' => array( 'grant_type' => 'client_credentials' )
						);

						add_filter('https_ssl_verify', '__return_false');
						$response = wp_remote_post('https://api.twitter.com/oauth2/token', $args);

						$keys = json_decode(wp_remote_retrieve_body($response));

						if($keys) {
							// saving token to wp_options table
							update_option('cfTwitterToken_'.$widget_id, $keys->access_token);
							$token = $keys->access_token;
						}
					}
					// we have bearer token wether we obtained it from API or from options
					$args = array(
						'httpversion' 	=> '1.1',
						'blocking' 		=> true,
						'headers' 		=> array(
							'Authorization' => "Bearer $token"
						)
					);

					add_filter('https_ssl_verify', '__return_false');
					$api_url = "https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=$twitter_username&count=$count";
					$response = wp_remote_get($api_url, $args);

					set_transient($transName, wp_remote_retrieve_body($response), 60 * $cacheTime);
				}
				@$twitter = json_decode(get_transient($transName), true);
				if($twitter && is_array($twitter)) { ?>
					<div class="twitter-box">
						<div class="twitter-holder">
							<div class="b">
								<div class="tweets-container" id="tweets_<?php echo esc_attr( $widget_id ); ?>">
									<ul id="saha_jtwt">
										<?php foreach($twitter as $tweet): ?>
										<li class="saha_jtwt_tweet">
											<p class="saha_jtwt_tweet_text">
											<?php
											$latestTweet = $tweet['text'];
											$latestTweet = preg_replace('/http:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', '&nbsp;<a href="http://$1" target="_blank">http://$1</a>&nbsp;', $latestTweet);
											$latestTweet = preg_replace('/@([a-z0-9_]+)/i', '&nbsp;<a href="http://twitter.com/$1" target="_blank">@$1</a>&nbsp;', $latestTweet);
											echo $latestTweet;
											?>
											</p>
											<?php
											$twitterTime = strtotime($tweet['created_at']);
											$timeAgo = $this->ago($twitterTime);
											?>
											<a href="http://twitter.com/<?php echo esc_attr( $tweet['user']['screen_name'] ); ?>/statuses/<?php echo esc_attr( $tweet['id_str'] ); ?>" class="saha_jtwt_date"><?php echo esc_attr( $timeAgo ); ?></a>
										</li>
										<?php endforeach; ?>
									</ul>
								</div>
							</div>
						</div>
						<span class="arrow"></span>
					</div>

				<?php
				}
			}
			
		// Close the theme's widget wrapper.
		echo $after_widget;

	}

	function ago($time) {
		$periods 	= array( __( 'second', 'saha' ), __( 'minute', 'saha' ), __( 'hour', 'saha' ), __( 'day', 'saha' ), __( 'week', 'saha' ), __( 'month', 'saha' ), __( 'year', 'saha' ), __( 'decade', 'saha' ) );
		$lengths 	= array( '60', '60', '24', '7', '4.35', '12', '10' );
		$now 		= time();
		$difference = $now - $time;
		$tense 		= __( 'ago', 'saha' );

		for( $j = 0; $difference >= $lengths[$j] && $j < count( $lengths )-1; $j++ ) {
			$difference /= $lengths[$j];
		}

		$difference = round( $difference );

		if( $difference != 1 ) {
			$periods[$j] .= __( 's', 'saha' );
		}

	   return sprintf('%s %s %s', $difference, $periods[$j], $tense );
	}

	/**
	 * Updates the widget control options for the particular instance of the widget.
	 *
	 * @since 1.0.0
	 */
	function update( $new_instance, $old_instance ) {

		$instance = $new_instance;

		$instance['title']   				= strip_tags( $new_instance['title'] );
		$instance['consumer_key'] 			= $new_instance['consumer_key'];
		$instance['consumer_secret'] 		= $new_instance['consumer_secret'];
		$instance['access_token'] 			= $new_instance['access_token'];
		$instance['access_token_secret'] 	= $new_instance['access_token_secret'];
		$instance['twitter_username'] 		= $new_instance['twitter_username'];
		$instance['count'] 					= $new_instance['count'];

		return $instance;
	}

	/**
	 * Displays the widget control options in the Widgets admin screen.
	 *
	 * @since 1.0.0
	 */
	function form( $instance ) {

		// Default value.
		$defaults = array(
			'title'   				=> esc_html__( 'Latest Tweets', 'saha' ),
			'consumer_key'			=> '',
			'consumer_secret' 		=> '',
			'access_token' 			=> '',
			'access_token_secret' 	=> '',
			'twitter_username' 		=> '',
			'count' 				=> 3
		);

		$instance = wp_parse_args( (array) $instance, $defaults );
	?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">
				<?php _e( 'Title:', 'saha' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('consumer_key'); ?>">
				<?php _e('Consumer Key:', 'saha'); ?>
			</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('consumer_key'); ?>" name="<?php echo $this->get_field_name('consumer_key'); ?>" value="<?php echo esc_attr( $instance['consumer_key'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('consumer_secret'); ?>">
				<?php _e('Consumer Secret:', 'saha'); ?>
			</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('consumer_secret'); ?>" name="<?php echo $this->get_field_name('consumer_secret'); ?>" value="<?php echo esc_attr( $instance['consumer_secret'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('access_token'); ?>">
				<?php _e('Access Token:', 'saha'); ?>
			</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('access_token'); ?>" name="<?php echo $this->get_field_name('access_token'); ?>" value="<?php echo esc_attr( $instance['access_token'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('access_token_secret'); ?>">
				<?php _e('Access Token Secret:', 'saha'); ?>
			</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('access_token_secret'); ?>" name="<?php echo $this->get_field_name('access_token_secret'); ?>" value="<?php echo esc_attr( $instance['access_token_secret'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('twitter_username'); ?>">
				<?php _e('Twitter Username:', 'saha'); ?>
			</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('twitter_username'); ?>" name="<?php echo $this->get_field_name('twitter_username'); ?>" value="<?php echo esc_attr( $instance['twitter_username'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('count'); ?>">
				<?php _e('Number of Tweets:', 'saha'); ?>
			</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" value="<?php echo esc_attr( $instance['count'] ); ?>" />
		</p>

	<?php

	}

}