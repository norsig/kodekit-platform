<?php
/**
 * Nooku Platform - http://www.nooku.org/platform
 *
 * @copyright	Copyright (C) 2007 - 2014 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */

namespace Nooku\Library;

/**
 * Class Loader Interface
 *
 * @author  Johan Janssens <http://github.com/johanjanssens>
 * @package Nooku\Library\Class
 */
interface ClassLoaderInterface
{
    /**
     * Registers the loader with the PHP autoloader.
     *
     * @param Boolean $prepend Whether to prepend the autoloader or not
     * @see \spl_autoload_register();
     */
    public function register($prepend = false);

    /**
     * Unregisters the loader with the PHP autoloader.
     *
     * @see \spl_autoload_unregister();
     */
    public function unregister();

    /**
     * Load a class based on a class name
     *
     * @param string  $class    The class name
     * @throws \RuntimeException If debug is enabled and the class could not be found in the file.
     * @return boolean  Returns TRUE if the class could be loaded, otherwise returns FALSE.
     */
    public function load($class);

    /**
     * Get the path based on a class name
     *
     * @param string $class     The class name
     * @param string $namespace The global namespace. If NULL the active global namespace will be used.
     * @return string|boolean   Returns canonicalized absolute pathname or FALSE of the class could not be found.
     */
    public function getPath($class, $namespace = null);

    /**
     * Get the path based on a class name
     *
     * @param string $class     The class name
     * @param string $path      The class path
     * @param string $namespace The global namespace. If NULL the active global namespace will be used.
     * @return void
     */
    public function setPath($class, $path, $namespace = null);

    /**
     * Register a class locator
     *
     * @param  ClassLocatorInterface $locator
     * @param  bool $prepend If true, the locator will be prepended instead of appended.
     * @return void
     */
    public function registerLocator(ClassLocatorInterface $locator, $prepend = false );

    /**
     * Get a registered class locator based on his type
     *
     * @param string $type The locator type
     * @return ClassLocatorInterface|null  Returns the object locator or NULL if it cannot be found.
     */
    public function getLocator($type);

    /**
     * Register an alias for a class
     *
     * @param string  $class The original
     * @param string  $alias The alias name for the class.
     */
    public function registerAlias($class, $alias);

    /**
     * Get the registered alias for a class
     *
     * @param  string $class The class
     * @return array   An array of aliases
     */
    public function getAliases($class);

    /**
     * Register a global namespace
     *
     * @param  string $namespace
     * @param  string $path The location of the namespace
     * @param  boolean $active Make the namespace active. Default is FALSE.
     * @return  ClassLoaderInterface
     */
    public function registerNamespace($namespace, $path, $active = false);

    /**
     * Set the active global namespace
     *
     * @param string $namespace The namespace
     * @return ClassLoaderInterface
     */
    public function setNamespace($namespace);

    /**
     * Get a global namespace path by name
     *
     * If no namespace is passed in this method will return the active global namespace.
     *
     * @param string|null $namespace The namespace.
     * @return string|false The namespace path or FALSE if the namespace does not exist.
     */
    public function getNamespace($namespace = null);

    /**
     * Get the global namespaces
     *
     * @return array An array with namespaces as keys and path as value
     */
    public function getNamespaces();

    /**
     * Enable or disable class loading
     *
     * If debug is enabled the class loader should throw an exception if a file is found but does not declare the class.
     *
     * @param bool $debug True or false.
     * @return ClassLoader
     */
    public function setDebug($debug);

    /**
     * Check if the loader is running in debug mode
     *
     * @return bool
     */
    public function isDebug();

    /**
     * Tells if a class, interface or trait exists.
     *
     * @params string $class
     * @return boolean
     */
    public function isDeclared($class);
}