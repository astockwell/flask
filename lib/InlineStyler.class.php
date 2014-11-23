<?php
/**
 * Inline Styler
 *
 * Generates style attributes for use inline within HTML tags
 */
class InlineStyler
{
	function __construct()
	{
		$this->styles = array();
	}

	function add($style_string)
	{
		array_push($this->styles, $style_string);
	}

	function write()
	{
		if ( count($this->styles) > 0 )
		{
			return " style=\"" . implode(" ", $this->styles) . "\" ";
		}
		else
		{
			return "";
		}
	}

}
?>
