<?php
	define('ABSPATH', dirname(__FILE__) . '/../../../../');
	require_once(ABSPATH . "wp-config.php");
	
	global $wpdb;
	
	if(isset($_REQUEST['search']))
	{
		require_once(ABSPATH . "wp-includes/post.php");
		
		$searchResults = array();
		$results = $wpdb->get_results( "SELECT post_title FROM $wpdb->posts WHERE post_title!='Sample Page' AND post_title!='Auto Draft'" );
		foreach ($results as $result)
		{
			array_push($searchResults, $result->post_title);
		}
			
		header('Cache-Control: no-cache, must-revalidate');
		header('Content-type: application/json');
		echo json_encode($searchResults);
	}
	else if(isset($_REQUEST['fetch']))
	{
		$posttitle = htmlspecialchars($_REQUEST['fetch']);
		$postid = $wpdb->get_var( "SELECT ID FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );
		echo json_encode(array(get_permalink($postid)));
	}
?>
