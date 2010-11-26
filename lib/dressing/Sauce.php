<?php
/**
 * Sauce.php
 *
 * @package     Dressing
 * @author      Mattijs Hoitink <mattijs@monkeyandmachine.com>
 * @copyright   Copyright (c) 2010 Mattijs Hoitink
 * @license     The MIT License
 */

namespace dressing;

/**
 * Interface for dressing sauces. This interface must be extended by all 
 * converter engines loaded into the Dressing class
 */
abstract class Sauce
{
    /**
     * Apply a Sauce from a file, using the provided parameters
     * @param string $file
     * @param array $parameters
     * @return string
     */
    abstract public function apply($file, array $parameters = array());
    
    /**
     * Check if a file exists. Will throw an \Exception if the file does not 
     * exist.
     * @param string $file The absolute path to the file
     * @throws \Exception when file does not exist
     */
    public function assertFile($file)
    {
        if (!file_exists($file)) {
            throw new \Exception("File '{$file}' could not be found");
        }
    }
    
    /**
     * Just for semantics, calls the apply() function internally
     * @see Sauce::apply()
     */
    public function poor($file, array $parameters = array())
    {
        return $this->apply($file, $parameters);
    }
}