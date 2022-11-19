<?php
/*
Plugin Name: Българският Календар
Plugin URI:  https://bgkalendar.com
Description: Добави днешната дата по Българския Календар във формат 'dd m YY' (14 Седми 7525) с кратък код [bgkalendar].
Version:     0.1
Author:      Българският Календар
Author URI:  https://bgkalendar.com
License:     GPL2 etc
License URI: 

Copyright 2020 Bulgarian Calendar
Bulgarian Calendar is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
Bulgarian Calendar is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with Bulgarian Calendar. If not, see (https:// ... ).
*/


function bgkalendar_shortcode() {
	return bgkalendar_today();
} 

add_shortcode('bgkalendar', 'bgkalendar_shortcode'); 

function bgkalendar_today() {
	$bgkalendarURL = "https://bgkalendar.com/api/v0/calendars/bulgarian/dates/today";
	
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $bgkalendarURL);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$output = curl_exec($curl);
	curl_close($curl);
	
	$response = json_decode($output, true);
	return $response['longDate'];
}

?>