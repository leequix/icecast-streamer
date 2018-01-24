<?php
/**
 * Created by PhpStorm.
 * User: leequix
 * Date: 1/24/2018
 * Time: 11:05 PM
 */

namespace IcecastStreamer\Stream;


class Info
{
    /**
     * Mount point should be advertised to a YP directory or not
     * @var bool
     */
    private $_isPublic;

    /**
     * Name of stream
     * @var string
     */
    private $_name;

    /**
     * Description of stream
     * @var string
     */
    private $_description;

    /**
     * Website of stream
     * @var string
     */
    private $_url;

    /**
     * Genre of stream
     * @var string
     */
    private $_genre;

    /**
     * Content type of stream data
     * @var string
     */
    private $_contentType;

    /**
     * Bitrate of stream
     * @var int
     */
    private $_bitrate;

    /**
     * @return bool
     */
    public function isPublic()
    {
        return $this->_isPublic;
    }

    /**
     * @param bool $isPublic
     */
    public function setIsPublic($isPublic)
    {
        $this->_isPublic = $isPublic;
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
     * @return string
     */
    public function getDescription()
    {
        return $this->_description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->_description = $description;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->_url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->_url = $url;
    }

    /**
     * @return string
     */
    public function getGenre()
    {
        return $this->_genre;
    }

    /**
     * @param string $genre
     */
    public function setGenre($genre)
    {
        $this->_genre = $genre;
    }

    /**
     * @return int
     */
    public function getBitrate()
    {
        return $this->_bitrate;
    }

    /**
     * @param int $bitrate
     */
    public function setBitrate($bitrate)
    {
        $this->_bitrate = $bitrate;
    }

    /**
     * @return string
     */
    public function getContentType()
    {
        return $this->_contentType;
    }

    /**
     * @param string $contentType
     */
    public function setContentType($contentType)
    {
        $this->_contentType = $contentType;
    }
}