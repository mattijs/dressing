<?php
/**
 * Twig.php
 *
 * @package     Dressing
 * @subpackage  Sauce
 * @author      Mattijs Hoitink <mattijs@monkeyandmachine.com>
 * @copyright   Copyright (c) 2010 Mattijs Hoitink
 * @license     The MIT License
 */

namespace dressing\sauce;
use \dressing\Sauce as Sauce;

class Twig extends Sauce
{
    /**
     * Twig environment
     * @var \Twig_Environment
     */
    protected $twig = null;
    
    /** **/
    
    /**
     * Construct a new Twig based converter
     */
    public function __construct()
    {
        // Set up Twig autoloading
        require_once 'Twig/Autoloader.php';
        \Twig_Autoloader::register();
        
        // Set up the Twig environment, use our own loader
        $loader = new \dressing\util\TwigLoader();
        $this->twig = new \Twig_Environment($loader, array());
    }
    
    /**
     * @see Sauce::apply()
     */
    public function apply($file, array $parameters = array())
    {
        if (null === $this->twig) {
            throw new \Exception('Twig environment was not loaded properly');
        }
        
        // Load the template from the Twig environment
        $template = $this->twig->loadTemplate($file);
        
        // Convert the template using the parameters
        return $template->render($parameters);
    }
}
