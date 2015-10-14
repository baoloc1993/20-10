<?php
/*
 * Randomly generate a string of length n
 * with full of arbitary character from A-Z and 0-9
*/
function CharacterRandomize($n = 1) {
	return strtoupper(substr(sha1(rand()), 0, $n));
}


/*
 * Generate an activation code which is unique
 * base on the current time (to milliseconds) and
 * some random strings
*/
function ActivationCodeGenerate() {
	$timestamp = microtime();	// Get the exact current time

	// Create some random characters
	$pre_randChar = CharacterRandomize(2);
	$mid_randChar = CharacterRandomize(3);
	$post_randChar = CharacterRandomize(5);

	// Combine the useful parts into one string
	$timestamp_ar = explode(" ", $timestamp);
	$timestamp = $pre_randChar . substr($timestamp_ar[1], 5) . $mid_randChar . substr($timestamp_ar[0], 2) . $post_randChar;

	
	return $timestamp;	// Output
}
?>
