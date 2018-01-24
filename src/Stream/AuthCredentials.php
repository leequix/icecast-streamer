<?php
/**
 * Created by PhpStorm.
 * User: leequix
 * Date: 1/24/2018
 * Time: 11:00 PM
 */

namespace IcecastStreamer\Stream;

class AuthCredentials
{
    /**
     * Username of DJ
     * @var string
     */
    private $_username;

    /**
     * Password of DJ
     * @var string
     */
    private $_password;

    /**
     * AuthCredentials constructor
     * @param string $_username
     * @param string $_password
     */
    public function __construct($_username = 'source', $_password)
    {
        $this->_username = $_username;
        $this->_password = $_password;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->_username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username = 'source')
    {
        $this->_username = $username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->_password = $password;
    }

    public function toBase64()
    {
        return base64_encode($this->_username . ':' . $this->_password);
    }
}