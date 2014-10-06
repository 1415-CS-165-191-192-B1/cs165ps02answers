<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Custom Form Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/form_helper.html
 */

// ------------------------------------------------------------------------

/**
 * Multi-select menu
 *
 * @access	public
 * @param	string
 * @param	array
 * @param	mixed
 * @param	string
 * @return	type
 */
if ( ! function_exists('custom_form_multiselect'))
{
  function custom_form_multiselect($name = '', $options = array(), $selected = array(), $extra = '', $option_extra = '')
  {
    if ( ! strpos($extra, 'multiple'))
    {
      $extra .= ' multiple="multiple"';
    }

    return form_dropdown($name, $options, $selected, $extra, $item_extra);
  }
}

// --------------------------------------------------------------------

/**
 * Drop-down Menu
 *
 * @access	public
 * @param	string
 * @param	array
 * @param	string
 * @param	string
 * @return	string
 */
if ( ! function_exists('custom_form_dropdown'))
{
  function custom_form_dropdown($name = '', $options = array(), $selected = array(), $extra = '', $option_extra = '')
  {
    if ( ! is_array($selected))
    {
      $selected = array($selected);
    }

    // If no selected state was submitted we will attempt to set it automatically
    if (count($selected) === 0)
    {
      // If the form name appears in the $_POST array we have a winner!
      if (isset($_POST[$name]))
      {
        $selected = array($_POST[$name]);
      }
    }

    if ($extra != '') $extra = ' '.$extra;

    $multiple = (count($selected) > 1 && strpos($extra, 'multiple') === FALSE) ? ' multiple="multiple"' : '';

    $form = '<select name="'.$name.'"'.$extra.$multiple.">\n";

    foreach ($options as $key => $val)
    {
      $key = (string) $key;

      if (is_array($val) && ! empty($val))
      {
        $form .= '<optgroup label="'.$key.'">'."\n";

        foreach ($val as $optgroup_key => $optgroup_val)
        {
          $sel = (in_array($optgroup_key, $selected)) ? ' selected="selected"' : '';

          $form .= '<option value="'.$optgroup_key.'"'.$sel.' '.$option_extra.'>'.(string) $optgroup_val."</option>\n";
        }

        $form .= '</optgroup>'."\n";
      }
      else
      {
        $sel = (in_array($key, $selected)) ? ' selected="selected"' : '';

        $form .= '<option value="'.$key.'"'.$sel.' '.$option_extra.'>'.(string) $val."</option>\n";
      }
    }

    $form .= '</select>';

    return $form;
  }
}

// ------------------------------------------------------------------------

/* End of file custom_form_helper.php */
/* Location: ./application/helpers/custom_form_helper.php */
