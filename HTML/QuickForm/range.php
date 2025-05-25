<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * HTML class for a range field
 * 
 * PHP versions 4 and 5
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category    HTML
 * @package     HTML_QuickForm
 * @author      Jon Goldberg <jon@megaphonetech.com>
 * @copyright   2025 CiviCRM LLC
 * @license     http://www.php.net/license/3_01.txt PHP License 3.01
 * @version     CVS: $Id$
 * @link        http://pear.php.net/package/HTML_QuickForm
 */

/**
 * Base class for <input /> form elements
 */
require_once 'HTML/QuickForm/input.php';

/**
 * HTML class for a text field
 * 
 * @category    HTML
 * @package     HTML_QuickForm
 * @author      Jon Goldberg <jon@megaphonetech.com>
 * @version     Release: 3.2.16
 * @since       3.2.16
 */
class HTML_QuickForm_range extends HTML_QuickForm_input
{
                
    // {{{ constructor

    /**
     * Class constructor
     * 
     * @param     string    $elementName    (optional)Input field name attribute
     * @param     string    $elementLabel   (optional)Input field label
     * @param     mixed     $attributes     (optional)Either a typical HTML attribute string 
     *                                      or an associative array
     * @since     1.0
     * @access    public
     * @return    void
     */
    function HTML_QuickForm_range($elementName=null, $elementLabel=null, $attributes=null)
    {
        HTML_QuickForm_input::HTML_QuickForm_input($elementName, $elementLabel, $attributes);
        $this->_persistantFreeze = false;
        $this->setType('range');
    } //end constructor
  
    function toHtml()
    {
        $valueDisplay = "<span class='range-value-display value-display-for-{$this->getAttribute('id')}'></span>";
        $script = '<script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function() {
                var rangeInput = document.getElementById("' . $this->getAttribute('id') . '");
                var valueDisplay = document.querySelector(".value-display-for-" + rangeInput.id);
                
                if (rangeInput && valueDisplay) {
                    valueDisplay.textContent = formatRangeValue();
                    rangeInput.addEventListener("input", function() {
                        valueDisplay.textContent = formatRangeValue();
                    });
                }
            
                function formatRangeValue() {
                    var value = rangeInput.value;
                    switch (rangeInput.getAttribute("data_type")) {
                        case "Money":
                            return CRM.formatMoney(value);
                        case "Float":
                            return parseFloat(value).toFixed(2);
                        default:
                            return value;
                    }
                }
            });        
        </script>';
        return HTML_QuickForm_input::toHtml() . $valueDisplay . $script; 
    }
} //end class HTML_QuickForm_text
?>
