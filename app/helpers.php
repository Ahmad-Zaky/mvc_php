<?php

/**
 * showErrors function
 *
 * @return void
 */
if (! function_exists("showErrors")) {
    function showErrors()
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    }
}

/**
 * d function
 *
 * @param [type] $dump
 * @return void
 */
if (! function_exists('d')) {
	function d($dump='')
	{
		return is_string($dump) AND die($dump);
	}
}
  
/**
 * dd function
 *
 * @param [type] $dump
 * @return void
 */
if (! function_exists('dd')) {
    function dd()
    {
        foreach (func_get_args() as $dump) {
            echo "<pre>";
            var_dump($dump);
            echo "</pre>";
        }

        die;
    }
}

/**
 * dump function
 *
 * @param [type] $dump
 * @return void
 */
if (! function_exists('dump')) {
    function dump($dump='')
    {
        foreach (func_get_args() as $dump) {
            echo "<pre>";
            var_dump($dump);
            echo "</pre>";
        }
    }
}

  