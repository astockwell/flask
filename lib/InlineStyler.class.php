<?php
/**
 * Inline Styler
 *
 * Generates style attributes for use inline within HTML tags
 *
 * Usage:
 *	<?php
 *		$theme_dir = get_bloginfo('template_directory');
 *		$styles = new InlineStyler;
 *		$background_pattern = get_field('background_pattern'); if ($background_pattern):
 *			$styles->add("background-image: url('$theme_dir/img/patterns/$background_pattern');");
 *		endif;
 *	?>
 *	<section class="body__wrapper" role="main" <?php echo $styles->write(); ?>>
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
