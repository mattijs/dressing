<?php
/**
 * Liquid.php
 *
 * @package     Dressing
 * @subpackage  Sauce
 * @author      Mattijs Hoitink <mattijs@monkeyandmachine.com>
 * @copyright   Copyright (c) 2010 Mattijs Hoitink
 * @license     The MIT License
 */

namespace dressing\sauce;
use \dressing\Sauce as Sauce;

/**
 * Liquid sauce for dressing package
 */
class Liquid extends Sauce
{
    /**
     * Create new Liquid Sauce. The constructor checks if the \LiquidTemplate 
     * class is loaded. This must be done manually.
     */
     public function __construct()
     {
         if (!class_exists('\LiquidTemplate', false)) {
             throw new \Exception('The \LiquidTemplate class could not be found. Please load the php-liquid library.');
         }
     }
    
    /**
     * @see Sauce::apply()
     */
    public function apply($file, array $parameters = array())
    {
        // Check if the file exists
        $this->assertFile($file);
        
        // Create a new LiquidTemplate from the template file
        $liquid = new \LiquidTemplate();
        $contents = \file_get_contents($file);
        $liquid->parse($contents);

        // Render the template with parameters
        return $liquid->render($parameters);
    }
}