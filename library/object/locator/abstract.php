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
 * Abstract Object Locator
 *
 * @author  Johan Janssens <http://github.com/johanjanssens>
 * @package Nooku\Library\Object
 */
abstract class ObjectLocatorAbstract extends Object implements ObjectLocatorInterface
{
    /**
     * The class prefix sequence in FIFO order
     *
     * @var array
     */
    protected $_sequence = array();

    /**
     * The locator type
     *
     * @var string
     */
    protected $_type = '';

    /**
     * Package/domain pairs to search
     *
     * @var array
     */
    protected $_packages = array();

    /**
     * Constructor.
     *
     * @param ObjectConfig $config  An optional KObjectConfig object with configuration options
     */
    public function __construct(ObjectConfig $config)
    {
        parent::__construct($config);

        $this->_sequence = ObjectConfig::unbox($config->sequence);
    }

    /**
     * Initializes the options for the object
     *
     * Called from {@link __construct()} as a first step of object instantiation.
     *
     * @param  ObjectConfig $config An optional KObjectConfig object with configuration options.
     * @return  void
     */
    protected function _initialize(ObjectConfig $config)
    {
        $config->append(array(
            'sequence' => array(),
        ));

        parent::_initialize($config);
    }

    /**
     * Returns a fully qualified class name for a given identifier.
     *
     * @param ObjectIdentifier $identifier An identifier object
     * @param bool  $fallback   Use the fallback sequence to locate the identifier
     * @return string|false  Return the class name on success, returns FALSE on failure
     */
    public function locate(ObjectIdentifier $identifier, $fallback = true)
    {
        if(empty($identifier->domain)) {
            $domain  = ucfirst($this->getPackage($identifier->package));
        } else {
            $domain = ucfirst($identifier->domain);
        }

        $package = ucfirst($identifier->package);
        $path    = StringInflector::camelize(implode('_', $identifier->path));
        $file    = ucfirst($identifier->name);

        $class   = $path.$file;

        $info = array(
            'class'   => $class,
            'package' => $package,
            'domain'  => $domain,
            'path'    => $path,
            'file'    => $file
        );

        return $this->find($info, $fallback);
    }

    /**
     * Find a class
     *
     * @param array  $info      The class information
     * @param bool   $fallback  If TRUE use the fallback sequence
     * @return bool|mixed
     */
    public function find(array $info, $fallback = true)
    {
        $result = false;

        //Find the class
        foreach($this->_sequence as $template)
        {
            $class = str_replace(
                array('<Domain>',      '<Package>'     ,'<Path>'      ,'<File>'      , '<Class>'),
                array($info['domain'], $info['package'], $info['path'], $info['file'], $info['class']),
                $template
            );

            if(class_exists($class))
            {
                $result = $class;
                break;
            }

            if(!$fallback) {
                break;
            }
        }

        return $result;
    }

    /**
     * Register a package
     *
     * @param  string $name    The package name
     * @param  string $domain  The domain for the package
     * @return ObjectLocatorInterface
     */
    public function registerPackage($name, $domain)
    {
        $this->_packages[$name] = $domain;
        return $this;
    }

    /**
     * Get the registered package domain
     *
     * If no domain has been registered for this package, the default 'Nooku' domain will be returned.
     *
     * @param string $package
     * @return string The registered domain
     */
    public function getPackage($package)
    {
        $domain = isset($this->_packages[$package]) ?  $this->_packages[$package] : 'Nooku';
        return $domain;
    }

    /**
     * Get the registered packages
     *s
     * @return array An array with package names as keys and domain as values
     */
    public function getPackages()
    {
        return $this->_packages;
    }

    /**
     * Get the type
     *
     * @return string
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     * Get the locator fallback sequence
     *
     * @return array
     */
    public function getSequence()
    {
        return $this->_sequence;
    }
}