<?php
/**
 * Markdown.php
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
 * Markdown sauce for the dressing package
 */
class Markdown extends Sauce
{
    /**
     * Create a new Markdown converter. The constructor checks if the \Markdown 
     * class is loaded for the conversion.
     */
    public function __construct()
    {
        // Check if markdown is loaded
        if (false === \function_exists('\Markdown')) {
            throw new \Exception('\Markdown package is not loaded');
        }
    }
    
    /**
     * @see Sauce::apply()
     */
    public function apply($file, array $parameters = array())
    {
        // Check if the file exists
        if (!is_file($file)) {
            throw new \Exception("File {$file} could not be found");
        }
        
        // Convert the markdown from the file's source
        $source = file_get_contents($file);
        return \Markdown($source);
    }
}