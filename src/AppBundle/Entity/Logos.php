<?php

namespace AppBundle\Entity;

/**
 * Logos
 */
class Logos
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $userId;

    /**
     * @var int
     */
    private $buttonNumber;

    /**
     * @var int
     */
    private $clickNumber;

    /**
     * @var \DateTime
     */
    private $recordedTime;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return Logos
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set buttonNumber
     *
     * @param integer $buttonNumber
     *
     * @return Logos
     */
    public function setButtonNumber($buttonNumber)
    {
        $this->buttonNumber = $buttonNumber;

        return $this;
    }

    /**
     * Get buttonNumber
     *
     * @return int
     */
    public function getButtonNumber()
    {
        return $this->buttonNumber;
    }

    /**
     * Set clickNumber
     *
     * @param integer $clickNumber
     *
     * @return Logos
     */
    public function setClickNumber($clickNumber)
    {
        $this->clickNumber = $clickNumber;

        return $this;
    }

    /**
     * Get clickNumber
     *
     * @return int
     */
    public function getClickNumber()
    {
        return $this->clickNumber;
    }

    /**
     * Set recordedTime
     *
     * @param \DateTime $recordedTime
     *
     * @return Logos
     */
    public function setRecordedTime($recordedTime)
    {
        $this->recordedTime = $recordedTime;

        return $this;
    }

    /**
     * Get recordedTime
     *
     * @return \DateTime
     */
    public function getRecordedTime()
    {
//        return $this->recordedTime ->format('Y-m-d H:i:s:ms:mcs');
        return $this->recordedTime ->format('ms:mcs');
    }
}

