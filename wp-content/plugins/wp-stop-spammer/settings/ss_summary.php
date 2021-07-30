<?php

if ( !defined( 'ABSPATH' ) ) {
	http_response_code( 404 );
	die();
}

if ( !current_user_can( 'manage_options' ) ) {
	die( __( 'Access Blocked', 'wp-stop-spammer' ) );
}

if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'protect' ) ) {
	_e( '<div>Jetpack Protect has been detected. Because of a conflict, Stop Spammers has disabled itself.<br />You do not need to disable Jetpack, just the Protect feature.</div>', 'wp-stop-spammer' );
	return;
}

ss_fix_post_vars();
$stats = ss_get_stats();
extract( $stats );
$now = date( 'Y/m/d H:i:s', time() + ( get_option( 'gmt_offset' ) * 3600 ) );

// counter list - this should be copied from the get option utility
// counters should have the same name as the YN switch for the check
// I see lots of missing counters here
$counters = array(
	'cntchkcloudflare'	  => __( 'Pass Cloudflare', 'wp-stop-spammer' ),
	'cntchkgcache'		  => __( 'Pass Good Cache', 'wp-stop-spammer' ),
	'cntchkakismet'	      => __( 'Reported by Akismet', 'wp-stop-spammer' ),
	'cntchkgenallowlist'  => __( 'Pass Generated Allow List', 'wp-stop-spammer' ),
	'cntchkgoogle'		  => __( 'Pass Google', 'wp-stop-spammer' ),
	'cntchkmiscallowlist' => __( 'Pass Allow List', 'wp-stop-spammer' ),
	'cntchkpaypal'		  => __( 'Pass PayPal', 'wp-stop-spammer' ),
	'cntchkscripts'	      => __( 'Pass Scripts', 'wp-stop-spammer' ),
	'cntchkvalidip'	      => __( 'Pass Uncheckable IP', 'wp-stop-spammer' ),
	'cntchkwlem'		  => __( 'Allow List Email', 'wp-stop-spammer' ),
	'cntchkuserid'		  => __( 'Allow Username', 'wp-stop-spammer' ),
	'cntchkwlist'		  => __( 'Pass Allow List IP', 'wp-stop-spammer' ),
	'cntchkyahoomerchant' => __( 'Pass Yahoo Merchant', 'wp-stop-spammer' ),
	'cntchk404'		      => __( '404 Exploit Attempt', 'wp-stop-spammer' ),
	'cntchkaccept'		  => __( 'Bad or Missing Accept Header', 'wp-stop-spammer' ),
	'cntchkadmin'		  => __( 'Admin Login Attempt', 'wp-stop-spammer' ),
	'cntchkadminlog'	  => __( 'Passed Login OK', 'wp-stop-spammer' ),
	'cntchkagent'		  => __( 'Bad or Missing User Agent', 'wp-stop-spammer' ),
	'cntchkamazon'		  => __( 'Amazon AWS', 'wp-stop-spammer' ),
	'cntchkaws'		      => __( 'Amazon AWS Allow', 'wp-stop-spammer' ),
	'cntchkbcache'		  => __( 'Bad Cache', 'wp-stop-spammer' ),
	'cntchkblem'		  => __( 'Block List Email', 'wp-stop-spammer' ),
	'cntchkuserid'		  => __( 'Block Username', 'wp-stop-spammer' ),
	'cntchkblip'		  => __( 'Block List IP', 'wp-stop-spammer' ),
	'cntchkbotscout'	  => __( 'BotScout', 'wp-stop-spammer' ),
	'cntchkdisp'		  => __( 'Disposable Email', 'wp-stop-spammer' ),
	'cntchkdnsbl'		  => __( 'DNSBL Hit', 'wp-stop-spammer' ),
	'cntchkexploits'	  => __( 'Exploit Attempt', 'wp-stop-spammer' ),
	'cntchkgooglesafe'	  => __( 'Google Safe Browsing', 'wp-stop-spammer' ),
	'cntchkhoney'		  => __( 'Project Honeypot', 'wp-stop-spammer' ),
	'cntchkhosting'	      => __( 'Known Spam Host', 'wp-stop-spammer' ),
	'cntchkinvalidip'	  => __( 'Block Invalid IP', 'wp-stop-spammer' ),
	'cntchklong'		  => __( 'Long Email', 'wp-stop-spammer' ),
	'cntchkshort'		  => __( 'Short Email', 'wp-stop-spammer' ),
	'cntchkbbcode'		  => __( 'BBCode in Request', 'wp-stop-spammer' ),
	'cntchkreferer'	      => __( 'Bad HTTP_REFERER', 'wp-stop-spammer' ),
	'cntchksession'	      => __( 'Session Speed', 'wp-stop-spammer' ),
	'cntchksfs'		      => __( 'Stop Forum Spam', 'wp-stop-spammer' ),
	'cntchkspamwords'	  => __( 'Spam Words', 'wp-stop-spammer' ),
	'cntchkurlshort'	  => __( 'Short URLs', 'wp-stop-spammer' ),
	'cntchktld'		      => __( 'Email TLD', 'wp-stop-spammer' ),
	'cntchkubiquity'	  => __( 'Ubiquity Servers', 'wp-stop-spammer' ),
	'cntchkmulti'		  => __( 'Repeated Hits', 'wp-stop-spammer' ),
	'cntchkform'		  => __( 'Check for Standard Form', 'wp-stop-spammer' ),
	'cntchkAD'			  => __( 'Andorra', 'wp-stop-spammer' ),
	'cntchkAE'			  => __( 'United Arab Emirates', 'wp-stop-spammer' ),
	'cntchkAF'			  => __( 'Afghanistan', 'wp-stop-spammer' ),
	'cntchkAL'			  => __( 'Albania', 'wp-stop-spammer' ),
	'cntchkAM'			  => __( 'Armenia', 'wp-stop-spammer' ),
	'cntchkAR'			  => __( 'Argentina', 'wp-stop-spammer' ),
	'cntchkAT'			  => __( 'Austria', 'wp-stop-spammer' ),
	'cntchkAU'			  => __( 'Australia', 'wp-stop-spammer' ),
	'cntchkAX'			  => __( 'Aland Islands', 'wp-stop-spammer' ),
	'cntchkAZ'			  => __( 'Azerbaijan', 'wp-stop-spammer' ),
	'cntchkBA'			  => __( 'Bosnia And Herzegovina', 'wp-stop-spammer' ),
	'cntchkBB'			  => __( 'Barbados', 'wp-stop-spammer' ),
	'cntchkBD'			  => __( 'Bangladesh', 'wp-stop-spammer' ),
	'cntchkBE'			  => __( 'Belgium', 'wp-stop-spammer' ),
	'cntchkBG'			  => __( 'Bulgaria', 'wp-stop-spammer' ),
	'cntchkBH'			  => __( 'Bahrain', 'wp-stop-spammer' ),
	'cntchkBN'			  => __( 'Brunei Darussalam', 'wp-stop-spammer' ),
	'cntchkBO'			  => __( 'Bolivia', 'wp-stop-spammer' ),
	'cntchkBR'			  => __( 'Brazil', 'wp-stop-spammer' ),
	'cntchkBS'			  => __( 'Bahamas', 'wp-stop-spammer' ),
	'cntchkBY'			  => __( 'Belarus', 'wp-stop-spammer' ),
	'cntchkBZ'			  => __( 'Belize', 'wp-stop-spammer' ),
	'cntchkCA'			  => __( 'Canada', 'wp-stop-spammer' ),
	'cntchkCD'			  => __( 'Congo, Democratic Republic', 'wp-stop-spammer' ),
	'cntchkCH'			  => __( 'Switzerland', 'wp-stop-spammer' ),
	'cntchkCL'			  => __( 'Chile', 'wp-stop-spammer' ),
	'cntchkCN'			  => __( 'China', 'wp-stop-spammer' ),
	'cntchkCO'			  => __( 'Colombia', 'wp-stop-spammer' ),
	'cntchkCR'			  => __( 'Costa Rica', 'wp-stop-spammer' ),
	'cntchkCU'			  => __( 'Cuba', 'wp-stop-spammer' ),
	'cntchkCW'			  => __( 'CuraÃ§ao', 'wp-stop-spammer' ),
	'cntchkCY'			  => __( 'Cyprus', 'wp-stop-spammer' ),
	'cntchkCZ'			  => __( 'Czech Republic', 'wp-stop-spammer' ),
	'cntchkDE'			  => __( 'Germany', 'wp-stop-spammer' ),
	'cntchkDK'			  => __( 'Denmark', 'wp-stop-spammer' ),
	'cntchkDO'			  => __( 'Dominican Republic', 'wp-stop-spammer' ),
	'cntchkDZ'			  => __( 'Algeria', 'wp-stop-spammer' ),
	'cntchkEC'			  => __( 'Ecuador', 'wp-stop-spammer' ),
	'cntchkEE'			  => __( 'Estonia', 'wp-stop-spammer' ),
	'cntchkES'			  => __( 'Spain', 'wp-stop-spammer' ),
	'cntchkEU'			  => __( 'European Union', 'wp-stop-spammer' ),
	'cntchkFI'			  => __( 'Finland', 'wp-stop-spammer' ),
	'cntchkFJ'			  => __( 'Fiji', 'wp-stop-spammer' ),
	'cntchkFR'			  => __( 'France', 'wp-stop-spammer' ),
	'cntchkGB'			  => __( 'Great Britain', 'wp-stop-spammer' ),
	'cntchkGE'			  => __( 'Georgia', 'wp-stop-spammer' ),
	'cntchkGF'			  => __( 'French Guiana', 'wp-stop-spammer' ),
	'cntchkGI'			  => __( 'Gibraltar', 'wp-stop-spammer' ),
	'cntchkGP'			  => __( 'Guadeloupe', 'wp-stop-spammer' ),
	'cntchkGR'			  => __( 'Greece', 'wp-stop-spammer' ),
	'cntchkGT'			  => __( 'Guatemala', 'wp-stop-spammer' ),
	'cntchkGU'			  => __( 'Guam', 'wp-stop-spammer' ),
	'cntchkGY'			  => __( 'Guyana', 'wp-stop-spammer' ),
	'cntchkHK'			  => __( 'Hong Kong', 'wp-stop-spammer' ),
	'cntchkHN'			  => __( 'Honduras', 'wp-stop-spammer' ),
	'cntchkHR'			  => __( 'Croatia', 'wp-stop-spammer' ),
	'cntchkHT'			  => __( 'Haiti', 'wp-stop-spammer' ),
	'cntchkHU'			  => __( 'Hungary', 'wp-stop-spammer' ),
	'cntchkID'			  => __( 'Indonesia', 'wp-stop-spammer' ),
	'cntchkIE'			  => __( 'Ireland', 'wp-stop-spammer' ),
	'cntchkIL'			  => __( 'Israel', 'wp-stop-spammer' ),
	'cntchkIN'			  => __( 'India', 'wp-stop-spammer' ),
	'cntchkIQ'			  => __( 'Iraq', 'wp-stop-spammer' ),
	'cntchkIR'			  => __( 'Iran, Islamic Republic Of', 'wp-stop-spammer' ),
	'cntchkIS'			  => __( 'Iceland', 'wp-stop-spammer' ),
	'cntchkIT'			  => __( 'Italy', 'wp-stop-spammer' ),
	'cntchkJM'			  => __( 'Jamaica', 'wp-stop-spammer' ),
	'cntchkJO'			  => __( 'Jordan', 'wp-stop-spammer' ),
	'cntchkJP'			  => __( 'Japan', 'wp-stop-spammer' ),
	'cntchkKE'			  => __( 'Kenya', 'wp-stop-spammer' ),
	'cntchkKG'			  => __( 'Kyrgyzstan', 'wp-stop-spammer' ),
	'cntchkKH'			  => __( 'Cambodia', 'wp-stop-spammer' ),
	'cntchkKR'			  => __( 'Korea', 'wp-stop-spammer' ),
	'cntchkKW'			  => __( 'Kuwait', 'wp-stop-spammer' ),
	'cntchkKY'			  => __( 'Cayman Islands', 'wp-stop-spammer' ),
	'cntchkKZ'			  => __( 'Kazakhstan', 'wp-stop-spammer' ),
	'cntchkLA'			  => __( 'Lao People\'s Democratic Republic', 'wp-stop-spammer' ),
	'cntchkLB'			  => __( 'Lebanon', 'wp-stop-spammer' ),
	'cntchkLK'			  => __( 'Sri Lanka', 'wp-stop-spammer' ),
	'cntchkLT'			  => __( 'Lithuania', 'wp-stop-spammer' ),
	'cntchkLU'			  => __( 'Luxembourg', 'wp-stop-spammer' ),
	'cntchkLV'			  => __( 'Latvia', 'wp-stop-spammer' ),
	'cntchkMD'			  => __( 'Moldova', 'wp-stop-spammer' ),
	'cntchkME'			  => __( 'Montenegro', 'wp-stop-spammer' ),
	'cntchkMK'			  => __( 'Macedonia', 'wp-stop-spammer' ),
	'cntchkMM'			  => __( 'Myanmar', 'wp-stop-spammer' ),
	'cntchkMN'			  => __( 'Mongolia', 'wp-stop-spammer' ),
	'cntchkMO'			  => __( 'Macao', 'wp-stop-spammer' ),
	'cntchkMP'			  => __( 'Northern Mariana Islands', 'wp-stop-spammer' ),
	'cntchkMQ'			  => __( 'Martinique', 'wp-stop-spammer' ),
	'cntchkMT'			  => __( 'Malta', 'wp-stop-spammer' ),
	'cntchkMV'			  => __( 'Maldives', 'wp-stop-spammer' ),
	'cntchkMX'			  => __( 'Mexico', 'wp-stop-spammer' ),
	'cntchkMY'			  => __( 'Malaysia', 'wp-stop-spammer' ),
	'cntchkNC'			  => __( 'New Caledonia', 'wp-stop-spammer' ),
	'cntchkNI'			  => __( 'Nicaragua', 'wp-stop-spammer' ),
	'cntchkNL'			  => __( 'Netherlands', 'wp-stop-spammer' ),
	'cntchkNO'			  => __( 'Norway', 'wp-stop-spammer' ),
	'cntchkNP'			  => __( 'Nepal', 'wp-stop-spammer' ),
	'cntchkNZ'			  => __( 'New Zealand', 'wp-stop-spammer' ),
	'cntchkOM'			  => __( 'Oman', 'wp-stop-spammer' ),
	'cntchkPA'			  => __( 'Panama', 'wp-stop-spammer' ),
	'cntchkPE'			  => __( 'Peru', 'wp-stop-spammer' ),
	'cntchkPG'			  => __( 'Papua New Guinea', 'wp-stop-spammer' ),
	'cntchkPH'			  => __( 'Philippines', 'wp-stop-spammer' ),
	'cntchkPK'			  => __( 'Pakistan', 'wp-stop-spammer' ),
	'cntchkPL'			  => __( 'Poland', 'wp-stop-spammer' ),
	'cntchkPR'			  => __( 'Puerto Rico', 'wp-stop-spammer' ),
	'cntchkPS'			  => __( 'Palestinian Territory, Occupied', 'wp-stop-spammer' ),
	'cntchkPT'			  => __( 'Portugal', 'wp-stop-spammer' ),
	'cntchkPW'			  => __( 'Palau', 'wp-stop-spammer' ),
	'cntchkPY'			  => __( 'Paraguay', 'wp-stop-spammer' ),
	'cntchkQA'			  => __( 'Qatar', 'wp-stop-spammer' ),
	'cntchkRO'			  => __( 'Romania', 'wp-stop-spammer' ),
	'cntchkRS'			  => __( 'Serbia', 'wp-stop-spammer' ),
	'cntchkRU'			  => __( 'Russian Federation', 'wp-stop-spammer' ),
	'cntchkSA'			  => __( 'Saudi Arabia', 'wp-stop-spammer' ),
	'cntchkSC'			  => __( 'Seychelles', 'wp-stop-spammer' ),
	'cntchkSE'			  => __( 'Sweden', 'wp-stop-spammer' ),
	'cntchkSG'			  => __( 'Singapore', 'wp-stop-spammer' ),
	'cntchkSI'			  => __( 'Slovenia', 'wp-stop-spammer' ),
	'cntchkSK'			  => __( 'Slovakia', 'wp-stop-spammer' ),
	'cntchkSV'			  => __( 'El Salvador', 'wp-stop-spammer' ),
	'cntchkSX'			  => __( 'Sint Maarten', 'wp-stop-spammer' ),
	'cntchkSY'			  => __( 'Syrian Arab Republic', 'wp-stop-spammer' ),
	'cntchkTH'			  => __( 'Thailand', 'wp-stop-spammer' ),
	'cntchkTJ'			  => __( 'Tajikistan', 'wp-stop-spammer' ),
	'cntchkTM'			  => __( 'Turkmenistan', 'wp-stop-spammer' ),
	'cntchkTR'			  => __( 'Turkey', 'wp-stop-spammer' ),
	'cntchkTT'			  => __( 'Trinidad And Tobago', 'wp-stop-spammer' ),
	'cntchkTW'			  => __( 'Taiwan', 'wp-stop-spammer' ),
	'cntchkUA'			  => __( 'Ukraine', 'wp-stop-spammer' ),
	'cntchkUK'			  => __( 'United Kingdom', 'wp-stop-spammer' ),
	'cntchkUS'			  => __( 'United States', 'wp-stop-spammer' ),
	'cntchkUY'			  => __( 'Uruguay', 'wp-stop-spammer' ),
	'cntchkUZ'			  => __( 'Uzbekistan', 'wp-stop-spammer' ),
	'cntchkVC'			  => __( 'Saint Vincent And Grenadines', 'wp-stop-spammer' ),
	'cntchkVE'			  => __( 'Venezuela', 'wp-stop-spammer' ),
	'cntchkVN'			  => __( 'Viet Nam', 'wp-stop-spammer' ),
	'cntchkYE'			  => __( 'Yemen', 'wp-stop-spammer' ),
	'cntcap'			  => __( 'Passed CAPTCHA', 'wp-stop-spammer' ), // captha success
	'cntncap'			  => __( 'Failed CAPTCHA', 'wp-stop-spammer' ), // captha not success
	'cntpass'			  => __( 'Total Pass', 'wp-stop-spammer' ), // passed
);

$message  = '';
$nonce	  = '';

if ( array_key_exists( 'ss_stop_spammers_control', $_POST ) ) {
	$nonce = $_POST['ss_stop_spammers_control'];
}

if ( wp_verify_nonce( $nonce, 'ss_stopspam_update' ) ) {
	if ( array_key_exists( 'clear', $_POST ) ) {
		foreach ( $counters as $v1 => $v2 ) {
			  $stats[ $v1 ] = 0;
		}
		$addonstats		     = array();
		$stats['addonstats'] = $addonstats;
		$msg			  	 = '<div class="notice notice-success is-dismissible"><p>' . __( 'Summary Cleared', 'wp-stop-spammer' ) . '</p></div>';
		ss_set_stats( $stats );
		extract( $stats ); // extract again to get the new options
	}
	if ( array_key_exists( 'update_total', $_POST ) ) {
		$stats['spmcount'] = $_POST['spmcount'];
		$stats['spmdate']  = $_POST['spmdate'];
		ss_set_stats( $stats );
		extract( $stats ); // extract again to get the new options
	}
}

$nonce = wp_create_nonce( 'ss_stopspam_update' );

?>

<div id="ss-plugin" class="wrap">
	<h1 class="ss_head"><img src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'images/stop-spammers-icon.png'; ?>" class="ss_icon" ><?php _e( 'Stop Spammers — Summary', 'stop-spammers' ); ?></h1><br />
	<?php _e( 'Version', 'wp-stop-spammer' ); ?> <strong><?php echo SS_VERSION; ?></strong>
	<?php if ( !empty( $summary ) ) { ?>
	<?php }
	$ip = ss_get_ip();
	?>
	| <?php _e( 'Your current IP address is', 'wp-stop-spammer' ); ?>: <strong><?php echo $ip; ?></strong>
	<?php
	if ( !is_plugin_active( 'stop-spammers-premium/stop-spammers-premium.php' ) ) {
		echo ' | <strong>USE CODE SSP4ME FOR $5 OFF THE <a href="https://stopspammers.io/downloads/stop-spammers-premium/" target="_blank" style="color:#67aeca;text-decoration:none">PREMIUM PLUGIN</a></strong>';
	} 
	?>
	<?php
	// check the IP to see if we are local
	$ansa = be_load( 'chkvalidip', ss_get_ip() );
	if ( $ansa == false ) {
		$ansa = be_load( 'chkcloudflare', ss_get_ip() );
	}
	if ( $ansa !== false ) { ?>
		<p><?php _e( 'This address is invalid for testing for the following reason:
			  <span style="font-weight:bold;font-size:1.2em">' . $ansa . '</span>.<br />
			  If you working on a local installation of WordPress, this might be
			  OK. However, if the plugin reports that your
			  IP is invalid it may be because you are using Cloudflare or a proxy
			  server to access this page. This will make
			  it impossible for the plugin to check IP addresses. You may want to
			  go to the Stop Spammers Testing page in
			  order to test all possible reasons that your IP is not appearing as
			  the IP of the machine that your using to
			  browse this site.<br />
			  It is possible to use the plugin if this problem appears, but most
			  checking functions will be turned off. The
			  plugin will still perform spam checks which do not require an
			  IP.<br />
			  If the error says that this is a Cloudflare IP address, you can fix
			  this by installing the Cloudflare plugin. If
			  you use Cloudflare to protect and speed up your site then you MUST
			  install the Cloudflare plugin. This plugin
			  will be crippled until you install it.', 'wp-stop-spammer' ); ?></p>
	<?php }
	// need the current guy
	$sname = '';
	if ( isset( $_SERVER['REQUEST_URI'] ) ) {
		$sname = $_SERVER["REQUEST_URI"];
	}
	if ( empty( $sname ) ) {
		$_SERVER['REQUEST_URI'] = $_SERVER['SCRIPT_NAME'];
		$sname			  	    = $_SERVER["SCRIPT_NAME"];
	}
	if ( strpos( $sname, '?' ) !== false ) {
		$sname = substr( $sname, 0, strpos( $sname, '?' ) );
	}
	if ( !empty( $msg ) ) {
		echo $msg;
	}
	$current_user_name = wp_get_current_user()->user_login;
	if ( $current_user_name == 'admin' ) {
		_e( '<span class="notice notice-warning" style="display:block">SECURITY RISK: You are using the username "admin." This is an invitation to hackers to try and guess your password. Please change this.</span>', 'wp-stop-spammer' );
	}
	$showcf = false; // hide this for now
	if ( $showcf && array_key_exists( 'HTTP_CF_CONNECTING_IP', $_SERVER ) && !function_exists( 'cloudflare_init' ) && !defined( 'W3TC' ) ) {
		_e( '<span class="notice notice-warning" style="display:block">WARNING: Cloudflare Remote IP address detected. Please make sure to <a href="https://support.cloudflare.com/hc/sections/200805497-Restoring-Visitor-IPs" target="_blank">restore visitor IPs</a>.</span>', 'wp-stop-spammer' );
	}
	?>
	<h2><?php _e( 'Summary of Spam', 'wp-stop-spammer' ); ?></h2>
	<div class="main-stats" style="width:95%">
	<?php if ( $spcount > 0 ) { ?>
		<p><?php _e( 'Stop Spammers has stopped <strong>' . $spcount . '</strong> spammers since ' . $spdate . '.', 'wp-stop-spammer' ); ?></p>
	<?php }
	$num_comm = wp_count_comments();
	$num	  = number_format_i18n( $num_comm->spam );
	if ( $num_comm->spam > 0 && SS_MU != 'Y' ) { ?>
		<p><?php _e( 'There are <a href="edit-comments.php?comment_status=spam">' . $num . '</a> spam comments waiting for you to report.', 'wp-stop-spammer' ); ?></p>
	<?php }
	$num_comm = wp_count_comments();
	$num	  = number_format_i18n( $num_comm->moderated );
	if ( $num_comm->moderated > 0 && SS_MU != 'Y' ) { ?>
		<p><?php _e( 'There are <a href="edit-comments.php?comment_status=moderated">' . $num . '</a> comments waiting to be moderated.', 'wp-stop-spammer' ); ?></p></div>
	<?php }
	$summary = '';
	foreach ( $counters as $v1 => $v2 ) {
		if ( !empty( $stats[ $v1 ] ) ) {
			  $summary .= "<div class='stat-box'>$v2: " . $stats[ $v1 ] . "</div>";
		} else {
		// echo "  $v1 - $v2 , ";
		}
	}
	$addonstats = $stats['addonstats'];
	foreach ( $addonstats as $key => $data ) {
	// count is in data[0] and use the plugin name
		$summary .= "<div class='stat-box'>$key: " . $data[0] . "</div>";
	} ?>
	<?php
		echo $summary;
	?>
	<form method="post" action="">
		<input type="hidden" name="ss_stop_spammers_control" value="<?php echo $nonce; ?>" />
		<input type="hidden" name="clear" value="clear summary" />
		<p class="submit" style="clear:both"><input class="button-primary" value="<?php _e( 'Clear Summary', 'wp-stop-spammer' ); ?>" type="submit" /></p>
	</form>
	<?php
	function ss_control()  {
		// this is the display of information about the page.
		if ( array_key_exists( 'resetOptions',$_POST ) ) {
			ss_force_reset_options();
		}
		$ip 	 = ss_get_ip();
		$nonce   = wp_create_nonce( 'ss_options' );
		$options = ss_get_options();
		extract( $options );
	}
	function ss_force_reset_options() {
		$ss_opt = $_POST['ss_opt'];
		$ss_opt = sanitize_text_field( $ss_opt );
		if ( !wp_verify_nonce( $ss_opt, 'ss_options' ) ) {	
			_e( 'Session Timeout — Please Refresh the Page', 'wp-stop-spammer' );
			exit;
		}
		if ( !function_exists( 'ss_reset_options' ) ) {
			ss_require( 'includes/ss-init-options.php' );
		}
		ss_reset_options();
		// clear the cache
		delete_option( 'ss_cache' );
	} ?>
	<h2><?php if ( !is_plugin_active( 'stop-spammers-premium/stop-spammers-premium.php' ) ) { _e( 'Free ', 'wp-stop-spammer' ); } ?><?php _e( 'Options', 'wp-stop-spammer' ); ?></h2>
	<div class="ss_admin_info_boxes_3row">
		<div class="ss_admin_info_boxes_3col">
			<h3><?php _e( 'PROTECTION OPTIONS', 'wp-stop-spammer' ); ?></h3>
			<img src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'images/protection.png'; ?>" class="center_thumb" /><?php _e( 'All options related to checking spam and logins. You can also block whole countries.', 'wp-stop-spammer' ); ?>
			<div class="ss_admin_button">
				<a href="?page=ss_options"><?php _e( 'Protection', 'wp-stop-spammer' ); ?></a>
			</div>
		</div>
		<div class="ss_admin_info_boxes_3col">
			<h3><?php _e( 'ALLOW LISTS', 'wp-stop-spammer' ); ?></h3>
			<img src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'images/allow-list.png'; ?>" class="center_thumb"><?php _e( 'Specify IP addresses always allowed without being checked and whitelist gateways such as PayPal.', 'wp-stop-spammer' ); ?>
			<div class="ss_admin_button">
				<a href="?page=ss_allow_list"><?php _e( 'Allow', 'wp-stop-spammer' ); ?></a>
			</div>
		</div>
		<div class="ss_admin_info_boxes_3col">
			<h3><?php _e( 'BLOCK LISTS', 'wp-stop-spammer' ); ?></h3>
			<img src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'images/block-list.png'; ?>" class="center_thumb"><?php _e( 'Block specified IPs and emails and block comments with certain words and phrases that are often used by spammers.', 'wp-stop-spammer' ); ?>
			<div class="ss_admin_button">
				<a href="?page=ss_block_list"><?php _e( 'Block', 'wp-stop-spammer' ); ?></a>
			</div>
		</div>
	</div>
	<div class="ss_admin_info_boxes_3row">
		<div class="ss_admin_info_boxes_3col">
			<h3><?php _e( 'CHALLENGE &amp; DENY', 'wp-stop-spammer' ); ?></h3>
			<img src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'images/challenge.png'; ?>" class="center_thumb"><?php _e( 'Enable reCAPTCHA and notification options. You can give real users who trigger the spam defender a second chance.', 'wp-stop-spammer' ); ?>
			<div class="ss_admin_button">
				<a href="?page=ss_challenge"><?php _e( 'Challenges', 'wp-stop-spammer' ); ?></a>
			</div>
		</div>
		<div class="ss_admin_info_boxes_3col">
			<h3><?php _e( 'APPROVE REQUESTS', 'wp-stop-spammer' ); ?></h3>
			<img src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'images/approve-requests.png'; ?>" class="center_thumb"><?php _e( 'Review and approve or block users who were blocked and filled out the form requesting access to your site.', 'wp-stop-spammer' ); ?>
			<div class="ss_admin_button">
				<a href="?page=ss_allow_list"><?php _e( 'Approve', 'wp-stop-spammer' ); ?></a>
			</div>
		</div>
		<div class="ss_admin_info_boxes_3col">
			<h3><?php _e( 'WEB SERVICES', 'wp-stop-spammer' ); ?></h3>
			<img src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'images/web-services.png'; ?>" class="center_thumb"><?php _e( 'Connect to StopForumSpam.com and other services for more sophisticated protection and the ability to report spam.', 'wp-stop-spammer' ); ?>
			<div class="ss_admin_button">
				<a href="?page=ss_webservices_settings"><?php _e( 'Web Services', 'wp-stop-spammer' ); ?></a>
			</div>
		</div>
	</div>
	<div class="ss_admin_info_boxes_3row">
		<div class="ss_admin_info_boxes_3col">
			<h3><?php _e( 'CACHE', 'wp-stop-spammer' ); ?></h3>
			<img src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'images/cache.png'; ?>" class="center_thumb"><?php _e( 'Shows the cache of recently detected events.', 'wp-stop-spammer' ); ?>
			<div class="ss_admin_button">
				<a href="?page=ss_cache"><?php _e( 'Cache', 'wp-stop-spammer' ); ?></a>
			</div>
		</div>
		<div class="ss_admin_info_boxes_3col">
			<h3><?php _e( 'LOG REPORT', 'wp-stop-spammer' ); ?></h3>
			<img src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'images/log-report.png'; ?>" class="center_thumb"><?php _e( 'Details the most recent events detected by Stop Spammers.', 'wp-stop-spammer' ); ?>
			<div class="ss_admin_button">
				<a href="?page=ss_reports"><?php _e( 'Log Report', 'wp-stop-spammer' ); ?></a>
			</div>
		</div>
		<div class="ss_admin_info_boxes_3col">
			<h3><?php _e( 'DIAGNOSTICS', 'wp-stop-spammer' ); ?></h3>
			<img src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'images/diagnostics.png'; ?>" class="center_thumb"><?php _e( 'Test an IP, email, or comment against all of the options to shed light about why an IP address might fail.', 'wp-stop-spammer' ); ?>
			<div class="ss_admin_button">
				<a href="?page=ss_diagnostics"><?php _e( 'Diagnostics', 'wp-stop-spammer' ); ?></a>
			</div>
		</div>
	</div>
	<?php if ( !is_plugin_active( 'stop-spammers-premium/stop-spammers-premium.php' ) ) {
		echo '
			<h2>' . __( 'Premium Options', 'wp-stop-spammer' ) . '</h2>
			<div class="ss_admin_info_boxes_1row" >
				<div class="ss_admin_info_boxes_1col" >
					<h3>' . __( 'Add a server-side firewall and themeable login, protect Divi / Elementor / CF7 / bbPress with our honeypot, export logs to excel, restore options, and transfer settings.', 'wp-stop-spammer' ) . '</h3>
					<div class="ss_admin_button">
						<a href="https://stopspammers.io/downloads/stop-spammers-premium/" target="_blank">' . __( 'Go Premium', 'wp-stop-spammer' ) . '</a>
					</div>
				</div>
			</div>
		';
	} else {
		echo '
			<div class="ss_admin_info_boxes_3row">
				<div class="ss_admin_info_boxes_3col">
					<h3>' . __( 'Restore Default Settings', 'wp-stop-spammer' ) . '</h3>
			 	 	<img src="' . plugin_dir_url( dirname( __FILE__ ) ) . 'images/restore-settings_stop-spammers_trumani.png" class="center_thumb" />
			  		' . __( 'Too fargone? Revert to the out-of-the box configurations.', 'wp-stop-spammer' ) . '
			 	 	<div class="ss_admin_button">
			  			<a href="admin.php?page=ssp_premium">' . __( 'RESTORE', 'wp-stop-spammer' ) . '</a>
			  		</div>
				</div>
				<div class="ss_admin_info_boxes_3col">
					<h3>' . __( 'Import/Export Settings', 'wp-stop-spammer' ) . '</h3>
			  		<img src="' . plugin_dir_url( dirname( __FILE__ ) ) . 'images/import-export_stop-spammers_trumani.png" class="center_thumb" />
			  		' . __( 'You can download your personalized configurations and upload them to all of your other sites.', 'wp-stop-spammer' ) . '
			  		<div class="ss_admin_button">
			  			<a href="admin.php?page=ssp_premium">' . __( 'IMPORT/EXPORT', 'wp-stop-spammer' ) . '</a>
			  		</div>
				</div>
				<div class="ss_admin_info_boxes_3col">
			  		<h3>' . __( 'Export Log to Excel', 'wp-stop-spammer' ) . '</h3>
			  		<img src="' . plugin_dir_url( dirname( __FILE__ ) ) . 'images/export-to-excel_stop-spammers_trumani.png" class="center_thumb" />
			  		' . __( 'Save the log report returns for future reference.', 'wp-stop-spammer' ) . '
			  		<div class="ss_admin_button">
			  			<a href="admin.php?page=ssp_premium">' . __( 'EXPORT LOG', 'wp-stop-spammer' ) . '</a>
			  		</div>
				</div>
			</div>
		';
	}
	?>
	<br style="clear:both" />
	<br />
	<h2><?php _e( 'Beta Options', 'wp-stop-spammer' ); ?></h2>
	<span class="notice notice-warning" style="display:block">
		<p><?php _e( 'These features are to be considered experimental. Use with caution and at your own risk.', 'wp-stop-spammer' ); ?></p>
	</span>
	<div class="ss_admin_info_boxes_2row">
		<div class="ss_admin_info_boxes_2col">
			<h3><?php _e( 'Database Cleanup', 'wp-stop-spammer' ); ?></h3>
			<img src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'images/database-cleanup.png'; ?>" class="center_thumb" >	
			<?php _e( 'Delete leftover options from deleted plugins or anything that appears suspicious.', 'wp-stop-spammer' ); ?>
			<div class="ss_admin_button">
				<a href="?page=ss_option_maint"><?php _e( 'Cleanup', 'wp-stop-spammer' ); ?></a>
			</div>
		</div>	   
  		<div class="ss_admin_info_boxes_2col">
			<h3><?php _e( 'Threat Scan', 'wp-stop-spammer' ); ?></h3>
			<img src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'images/threat-scan.png'; ?>" class="center_thumb" >		   
			<?php _e( 'A simple scan to find possibly malicious code.', 'wp-stop-spammer' ); ?>
 			<div class="ss_admin_button">
				<a href="?page=ss_diagnostics"><?php _e( 'Scan', 'wp-stop-spammer' ); ?></a>
			</div>
		</div>   
	</div>
</div>