<?php
/**
 * Theme storage manipulations
 *
 * @package WordPress
 * @subpackage UREACH
 * @since UREACH 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Get theme variable
if (!function_exists('ureach_storage_get')) {
	function ureach_storage_get($var_name, $default='') {
		global $UREACH_STORAGE;
		return isset($UREACH_STORAGE[$var_name]) ? $UREACH_STORAGE[$var_name] : $default;
	}
}

// Set theme variable
if (!function_exists('ureach_storage_set')) {
	function ureach_storage_set($var_name, $value) {
		global $UREACH_STORAGE;
		$UREACH_STORAGE[$var_name] = $value;
	}
}

// Check if theme variable is empty
if (!function_exists('ureach_storage_empty')) {
	function ureach_storage_empty($var_name, $key='', $key2='') {
		global $UREACH_STORAGE;
		if (!empty($key) && !empty($key2))
			return empty($UREACH_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return empty($UREACH_STORAGE[$var_name][$key]);
		else
			return empty($UREACH_STORAGE[$var_name]);
	}
}

// Check if theme variable is set
if (!function_exists('ureach_storage_isset')) {
	function ureach_storage_isset($var_name, $key='', $key2='') {
		global $UREACH_STORAGE;
		if (!empty($key) && !empty($key2))
			return isset($UREACH_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return isset($UREACH_STORAGE[$var_name][$key]);
		else
			return isset($UREACH_STORAGE[$var_name]);
	}
}

// Inc/Dec theme variable with specified value
if (!function_exists('ureach_storage_inc')) {
	function ureach_storage_inc($var_name, $value=1) {
		global $UREACH_STORAGE;
		if (empty($UREACH_STORAGE[$var_name])) $UREACH_STORAGE[$var_name] = 0;
		$UREACH_STORAGE[$var_name] += $value;
	}
}

// Concatenate theme variable with specified value
if (!function_exists('ureach_storage_concat')) {
	function ureach_storage_concat($var_name, $value) {
		global $UREACH_STORAGE;
		if (empty($UREACH_STORAGE[$var_name])) $UREACH_STORAGE[$var_name] = '';
		$UREACH_STORAGE[$var_name] .= $value;
	}
}

// Get array (one or two dim) element
if (!function_exists('ureach_storage_get_array')) {
	function ureach_storage_get_array($var_name, $key, $key2='', $default='') {
		global $UREACH_STORAGE;
		if (empty($key2))
			return !empty($var_name) && !empty($key) && isset($UREACH_STORAGE[$var_name][$key]) ? $UREACH_STORAGE[$var_name][$key] : $default;
		else
			return !empty($var_name) && !empty($key) && isset($UREACH_STORAGE[$var_name][$key][$key2]) ? $UREACH_STORAGE[$var_name][$key][$key2] : $default;
	}
}

// Set array element
if (!function_exists('ureach_storage_set_array')) {
	function ureach_storage_set_array($var_name, $key, $value) {
		global $UREACH_STORAGE;
		if (!isset($UREACH_STORAGE[$var_name])) $UREACH_STORAGE[$var_name] = array();
		if ($key==='')
			$UREACH_STORAGE[$var_name][] = $value;
		else
			$UREACH_STORAGE[$var_name][$key] = $value;
	}
}

// Set two-dim array element
if (!function_exists('ureach_storage_set_array2')) {
	function ureach_storage_set_array2($var_name, $key, $key2, $value) {
		global $UREACH_STORAGE;
		if (!isset($UREACH_STORAGE[$var_name])) $UREACH_STORAGE[$var_name] = array();
		if (!isset($UREACH_STORAGE[$var_name][$key])) $UREACH_STORAGE[$var_name][$key] = array();
		if ($key2==='')
			$UREACH_STORAGE[$var_name][$key][] = $value;
		else
			$UREACH_STORAGE[$var_name][$key][$key2] = $value;
	}
}

// Merge array elements
if (!function_exists('ureach_storage_merge_array')) {
	function ureach_storage_merge_array($var_name, $key, $value) {
		global $UREACH_STORAGE;
		if (!isset($UREACH_STORAGE[$var_name])) $UREACH_STORAGE[$var_name] = array();
		if ($key==='')
			$UREACH_STORAGE[$var_name] = array_merge($UREACH_STORAGE[$var_name], $value);
		else
			$UREACH_STORAGE[$var_name][$key] = array_merge($UREACH_STORAGE[$var_name][$key], $value);
	}
}

// Add array element after the key
if (!function_exists('ureach_storage_set_array_after')) {
	function ureach_storage_set_array_after($var_name, $after, $key, $value='') {
		global $UREACH_STORAGE;
		if (!isset($UREACH_STORAGE[$var_name])) $UREACH_STORAGE[$var_name] = array();
		if (is_array($key))
			ureach_array_insert_after($UREACH_STORAGE[$var_name], $after, $key);
		else
			ureach_array_insert_after($UREACH_STORAGE[$var_name], $after, array($key=>$value));
	}
}

// Add array element before the key
if (!function_exists('ureach_storage_set_array_before')) {
	function ureach_storage_set_array_before($var_name, $before, $key, $value='') {
		global $UREACH_STORAGE;
		if (!isset($UREACH_STORAGE[$var_name])) $UREACH_STORAGE[$var_name] = array();
		if (is_array($key))
			ureach_array_insert_before($UREACH_STORAGE[$var_name], $before, $key);
		else
			ureach_array_insert_before($UREACH_STORAGE[$var_name], $before, array($key=>$value));
	}
}

// Push element into array
if (!function_exists('ureach_storage_push_array')) {
	function ureach_storage_push_array($var_name, $key, $value) {
		global $UREACH_STORAGE;
		if (!isset($UREACH_STORAGE[$var_name])) $UREACH_STORAGE[$var_name] = array();
		if ($key==='')
			array_push($UREACH_STORAGE[$var_name], $value);
		else {
			if (!isset($UREACH_STORAGE[$var_name][$key])) $UREACH_STORAGE[$var_name][$key] = array();
			array_push($UREACH_STORAGE[$var_name][$key], $value);
		}
	}
}

// Pop element from array
if (!function_exists('ureach_storage_pop_array')) {
	function ureach_storage_pop_array($var_name, $key='', $defa='') {
		global $UREACH_STORAGE;
		$rez = $defa;
		if ($key==='') {
			if (isset($UREACH_STORAGE[$var_name]) && is_array($UREACH_STORAGE[$var_name]) && count($UREACH_STORAGE[$var_name]) > 0) 
				$rez = array_pop($UREACH_STORAGE[$var_name]);
		} else {
			if (isset($UREACH_STORAGE[$var_name][$key]) && is_array($UREACH_STORAGE[$var_name][$key]) && count($UREACH_STORAGE[$var_name][$key]) > 0) 
				$rez = array_pop($UREACH_STORAGE[$var_name][$key]);
		}
		return $rez;
	}
}

// Inc/Dec array element with specified value
if (!function_exists('ureach_storage_inc_array')) {
	function ureach_storage_inc_array($var_name, $key, $value=1) {
		global $UREACH_STORAGE;
		if (!isset($UREACH_STORAGE[$var_name])) $UREACH_STORAGE[$var_name] = array();
		if (empty($UREACH_STORAGE[$var_name][$key])) $UREACH_STORAGE[$var_name][$key] = 0;
		$UREACH_STORAGE[$var_name][$key] += $value;
	}
}

// Concatenate array element with specified value
if (!function_exists('ureach_storage_concat_array')) {
	function ureach_storage_concat_array($var_name, $key, $value) {
		global $UREACH_STORAGE;
		if (!isset($UREACH_STORAGE[$var_name])) $UREACH_STORAGE[$var_name] = array();
		if (empty($UREACH_STORAGE[$var_name][$key])) $UREACH_STORAGE[$var_name][$key] = '';
		$UREACH_STORAGE[$var_name][$key] .= $value;
	}
}

// Call object's method
if (!function_exists('ureach_storage_call_obj_method')) {
	function ureach_storage_call_obj_method($var_name, $method, $param=null) {
		global $UREACH_STORAGE;
		if ($param===null)
			return !empty($var_name) && !empty($method) && isset($UREACH_STORAGE[$var_name]) ? $UREACH_STORAGE[$var_name]->$method(): '';
		else
			return !empty($var_name) && !empty($method) && isset($UREACH_STORAGE[$var_name]) ? $UREACH_STORAGE[$var_name]->$method($param): '';
	}
}

// Get object's property
if (!function_exists('ureach_storage_get_obj_property')) {
	function ureach_storage_get_obj_property($var_name, $prop, $default='') {
		global $UREACH_STORAGE;
		return !empty($var_name) && !empty($prop) && isset($UREACH_STORAGE[$var_name]->$prop) ? $UREACH_STORAGE[$var_name]->$prop : $default;
	}
}
?>