<?php
/**
 * Created by PhpStorm.
 * User: leequix
 * Date: 1/24/2018
 * Time: 11:00 PM
 */

namespace IcecastStreamer\Stream;

class Connection
{
    /**
     * Host of icecast server
     * @var string
     */
    private $_host;

    /**
     * Port of icecast server
     * @var int
     */
    private $_port;

    /**
     * Mount point of icecast server
     * @var MountPoint
     */
    private $_mountPoint;

    /**
     * Socket of connection to icecast
     * @var resource
     */
    private $_socket;

    /**
     * Connection constructor
     * @param string $_host
     * @param int $_port
     * @param MountPoint $_mountPoint
     */
    public function __construct($_host, $_port, MountPoint $_mountPoint)
    {
        $this->_host = $_host;
        $this->_port = $_port;
        $this->_mountPoint = $_mountPoint;
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->_host;
    }

    /**
     * @param string $host
     */
    public function setHost($host)
    {
        $this->_host = $host;
    }

    /**
     * @return int
     */
    public function getPort()
    {
        return $this->_port;
    }

    /**
     * @param int $port
     */
    public function setPort($port)
    {
        $this->_port = $port;
    }

    /**
     * @return MountPoint
     */
    public function getMountPoint()
    {
        return $this->_mountPoint;
    }

    /**
     * @param MountPoint $mountPoint
     */
    public function setMountPoint($mountPoint)
    {
        $this->_mountPoint = $mountPoint;
    }

    /**
     * Get resource of socket
     * @return resource
     */
    public function getSocket()
    {
        return $this->_socket;
    }

    /**
     * Create socket instance. Throws exception if can not initialize socket
     * @throws \Exception
     */
    public function startup()
    {
        $this->_socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

        if (!$this->_socket) {
            throw new \Exception('Can not create icecast connection socket');
        }
    }

    /**
     * Connects to icecast server. Throws exception if can not connect to server
     * @throws \Exception
     */
    public function open()
    {
        $address = gethostbyname($this->_host);
        if (!socket_connect($this->_socket, $address, $this->_port)) {
            $reasonOfError = socket_strerror(socket_last_error($this->_socket));
            throw new \Exception('Can not connect to icecast server. Reason: ' . $reasonOfError);
        }
    }

    /**
     * Close connection
     */
    public function close()
    {
        socket_close($this->_socket);
    }
}