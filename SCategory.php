<?php
/**
 * Created by PhpStorm.
 * User: Ramic
 * Date: 01.05.2019
 * Time: 20:16
 */

class SCategory
{
    private $categoryName;
    private $sportType;
    private $categoryType;
    private $optionType;
    private $createdDate;
    private $createdName;
    private $userLimit;
    private $usersCount;
    private $viewCount;

    public function __construct($cname,$stype,$ctype,$otype,$cdate,$uName,$climit,$uCount,$vCount)
    {
        $this->categoryName=$cname;
        $this->sportType=$stype;
        $this->categoryType=$ctype;
        $this->optionType=$otype;
        $this->createdDate=$cdate;
        $this->createdName=$uName;
        $this->userLimit=$climit;
        $this->usersCount=$uCount;
        $this->viewCount=$vCount;
    }

    public function getCategoryName()
    {
        return $this->categoryName;
    }

    public function getSportType()
    {
        return $this->sportType;
    }
    public function getCategoryType()
    {
        return $this->categoryType;
    }
    public function getCreatedDate()
    {
        return $this->createdDate;
    }
    public function getCreatedName()
    {
        return $this->createdName;
    }
    public function getOptionType()
    {
        return $this->optionType;
    }
    public function getUserLimit()
    {
        return $this->userLimit;
    }
    public function getUsersCount()
    {
        return $this->usersCount;
    }
    public function getViewCount()
    {
        return $this->viewCount;
    }
    public function jsonSerialize () { return $this->toArray(); }
}

