<?php
/**
 * Created by PhpStorm.
 * User: leequix
 * Date: 1/24/2018
 * Time: 10:54 PM
 */

namespace IcecastStreamer;


use IcecastStreamer\Stream\Connection;
use IcecastStreamer\Stream\Info;

class Stream
{
    /**
     * Connection to the icecast server
     * @var Connection
     */
    private $_connection;

    /**
     * Information about stream
     * @var Info
     */
    private $_info;

    /**
     * Stream constructor
     * @param Connection $_connection
     * @param Info $_info
     */
    public function __construct(Connection $_connection, Info $_info)
    {
        $this->_connection = $_connection;
        $this->_info = $_info;
    }

    /**
     * @return Connection
     */
    public function getConnection()
    {
        return $this->_connection;
    }

    /**
     * @return Info
     */
    public function getInfo()
    {
        return $this->_info;
    }

    /**
     * Start stream if all ok
     * @throws \Exception
     */
    public function start()
    {
        $this->_connection->startup();
        $this->_connection->open();
        $socket = $this->_connection->getSocket();
        $request = $this->generateRequest();
        socket_write($socket, $request, strlen($request));

        static $expectedResult = 'HTTP/1.1 100 Continue';

        $result = socket_read($socket, strlen($expectedResult));
        if ($result !== $expectedResult) {
            throw new \Exception('Can not start stream(maybe invalid credentials)');
        }
    }

    /**
     * Send mp3 chunk to icecast server
     * @param string $data
     */
    public function write($data)
    {
        $socket = $this->_connection->getSocket();
        socket_write($socket, $data, strlen($data));
    }

    /**
     * Stop stream
     */
    public function stop()
    {
        $this->_connection->close();
    }

    private function generateRequest()
    {
        $request  = 'PUT ' . $this->_connection->getMountPoint()->getName() . ' HTTP/1.1' . PHP_EOL;
        $request .= 'Host: ' . $this->_connection->getHost() . ':' . $this->_connection->getPort() . PHP_EOL;
        $request .= 'Authorization: Basic ' . $this->_connection->getMountPoint()->getCredentials()->toBase64() . PHP_EOL;
        $request .= 'Transfer-Encoding: chunked' . PHP_EOL;
        $request .= 'Content-Type: ' . $this->_info->getContentType() . PHP_EOL;
        $request .= 'Ice-Public: ' . ($this->_info->isPublic() ? '1' : '0') . PHP_EOL;

        if ($this->_info->getName()) {
            $request .= 'Ice-Name: ' . $this->_info->getName() . PHP_EOL;
        }
        if ($this->_info->getDescription()) {
            $request .= 'Ice-Description: ' . $this->_info->getDescription() . PHP_EOL;
        }
        if ($this->_info->getUrl()) {
            $request .= 'Ice-URL: ' . $this->_info->getUrl() . PHP_EOL;
        }
        if ($this->_info->getGenre()) {
            $request .= 'Ice-Genre: ' . $this->_info->getGenre() . PHP_EOL;
        }
        if ($this->_info->getBitrate()) {
            $request .= 'Ice-Bitrate: ' . $this->_info->getBitrate() . PHP_EOL;
        }

        $request .= 'Expect: 100-continue' . PHP_EOL . PHP_EOL;

        return $request;
    }
}