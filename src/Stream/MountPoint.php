<?php
/**
 * Created by PhpStorm.
 * User: leequix
 * Date: 1/24/2018
 * Time: 11:03 PM
 */

namespace IcecastStreamer\Stream;


class MountPoint
{
    /**
     * Name of mount point
     * @var string
     */
    private $_name;

    /**
     * Credentials(username and password) for mount point
     * @var AuthCredentials
     */
    private $_credentials;

    /**
     * MountPoint constructor
     * @param string $_name
     * @param AuthCredentials $_credentials
     */
    public function __construct($_name, AuthCredentials $_credentials)
    {
        $this->_name = $_name;
        $this->_credentials = $_credentials;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->_name = $name;
    }

    /**
     * @return AuthCredentials
     */
    public function getCredentials()
    {
        return $this->_credentials;
    }

    /**
     * @param AuthCredentials $credentials
     */
    public function setCredentials($credentials)
    {
        $this->_credentials = $credentials;
    }
}