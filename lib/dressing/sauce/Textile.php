<?php
/**
 * Textile.php
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
 * Textile sauce for the dressing library
 */
class Textile extends Sauce
{
    /**
     * Textile class
     * @var \Textile
     */
    public $textile = null;
    
    /** **/
    
    /**
     * Create a new Textile converter. The constructor checks if the \Textile 
     * class is loaded for the conversion.
     */
    public function __construct()
    {
        // Check if markdown is loaded
        if (false === class_loaded('\Textile')) {
            throw new \Exception('\Textile class is not loaded');
        }
    }
    
    /**
     * @see Sauce::apply()
     */
    public function apply(string $file, array $parameters = array())
    {
        // Check if the source file exists
        if (!is_file($file)) {
            throw new \Exception("File '{$file}' was not found");
        }
        
        // Convert the Textile
        $textile = $this->getTextile();
        return $text->TextileThis($source);
    }
    
    /**
     * Get the active Textile instance
     * @return \Textile
     */
    protected function getTextile()
    {
        if (null === $this->textile) {
            $this->textile = new Textile();
        }
        return $this->textile;
    }
}