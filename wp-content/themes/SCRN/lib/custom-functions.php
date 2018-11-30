<?php 
//This function shows the top menu if the user didn't create the menu in Appearance -> Menus.
if( !function_exists( 'show_top_menu') )
{
	function show_top_menu() {
		echo '<ul class="nav navbar-nav">';
		$pages = get_pages('number=4&sort_column=menu_order&sort_order=ASC');
		$count = count($pages);
		echo '<li><a href="' . get_home_url() . '/#intro">Home</a>';
		for($i = 0; $i < $count; $i++) {
			echo '<li><a href="' . get_home_url() . '/#' . $pages[$i]->post_name . '">' . $pages[$i]->post_title . '</a></li>' . PHP_EOL;
		}
		echo '<li><a href="' . get_home_url() . '/#contact">Contact</a></li>';
		echo '</ul>';
	}
}
?>