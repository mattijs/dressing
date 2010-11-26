<?php
/**
 * Dressing.php
 *
 * @package     Dressing
 * @author      Mattijs Hoitink <mattijs@monkeyandmachine.com>
 * @copyright   Copyright (c) 2010 Mattijs Hoitink
 * @license     The MIT License
 */

namespace dressing;

/**
 * The main class of the Dressing library. This class renders files using one 
 * of the registered engines
 */
class Dressing
{
    /**
     * List of supported engines and their names
     * @var array
     */
    public $engines = array(
        'markdown' => '\dressing\sauce\Markdown',
        'twig'     => '\dressing\sauce\Twig',
        'textile'  => '\dressing\sauce\Textile',
        'liquid'   => '\dressing\sauce\Liquid',
    );
    
    /**
     * List of alternative engine names. These refer to the register engine name
     * @var array
     */
    public $alternatives = array(
        'md'    => 'markdown',
        'mdown' => 'markdown',
    );
    
    /**
     * List of engine instances
     * @var array
     */
    public $instances = array();
    
    /** **/
    
    /**
     * Pick a dressing of your linking: get an instance of that sauce at your 
     * disposal.
     * @param string $language
     * @return Sauce
     */
    public function pick($name)
    {
        // Get the correct language if a language alternative name was passed
        if (array_key_exists($name, $this->alternatives)) {
            $name = $this->alternatives[$name];
        }
        
        // Check if we already have an instance for the language
        if (array_key_exists($name, $this->instances)) {
            return $this->instances[$name];
        }
        
        // Check if we have an engine for the language name
        if (array_key_exists($name, $this->engines)) {
            $className = $this->engines[$name];
            $this->instances[$name] = new $className();
            return $this->instances[$name];
        }
        
        // No engine found
        return null;
    }
    
    /**
     * Poor a Sauce based on the file.
     * @param string $file 
     * @param array $parameters
     * @return string
     */
    public function poor($file, array $parameters = array())
    {
        // Construct a SplFileInfo object for file inspection
        $fileInfo = new \SplFileInfo($file);
        $fileName = $fileInfo->getFileName();
        $fileExtension = strtolower(substr($fileName, strrpos($fileName, '.') + 1));
        
        // Get the sauce
        $sauce = $this->pick($fileExtension);
        if (null === $sauce) {
            throw new \Exception("Sauce '{$fileExtension}' could not be found");
        }
        
        // Return the output
        return $sauce->apply($file, $parameters);
    }
    
    /**
     * Overload to pass method calls to dressing engines
     * @param string $name
     */
    public function __get($name)
    {
        $engine = $this->pick(strtolower($name));
        if (null !== $engine) {
            return $engine;
        }
    }
}