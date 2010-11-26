<?php
/**
 * TwigLoader.php
 *
 * @package     Dressing
 * @subpackage  Util
 * @author      Mattijs Hoitink <mattijs@monkeyandmachine.com>
 * @copyright   Copyright (c) 2010 Mattijs Hoitink
 * @license     The MIT License
 */

namespace dressing\util;

/**
 * Special loader for Twig to load files based on their full path.
 * @uses \Twig_LoaderInterface
 */
class TwigLoader implements \Twig_LoaderInterface
{
    /**
     * @see Twig_LoaderInterface::getSource()
     */
    public function getSource($file)
    {
        if (!file_exists($file)) {
            throw new \Twig_Error_Loader("Unable to find file '{$file}'");
        }
        
        return file_get_contents($file);
    }
    
    /**
     * @see Twig_LoaderInterface::getCacheKey()
     */
    public function getCacheKey($file)
    {
        return $file;
    }
    
    /**
     * @see Twig_LoaderInterface::isFresh()
     */
    public function isFresh($file, $time)
    {
        return filemtime($file) < $time;
    }
}
