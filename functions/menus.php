<?php

/* Menus and Sidebars */

function register_custom_menus() {
	register_nav_menu('projectsresearch', __('Projects & Research'));
}

add_action('init', 'register_custom_menus');


?>