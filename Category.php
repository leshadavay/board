<?php
/**
 * Created by PhpStorm.
 * User: Ramic
 * Date: 01.05.2019
 * Time: 20:16
 */

class Category
{
    private $id;
    private $title;
    private $sportType;
    private $gameType;
    private $teamType;
    private $createdDate;
    private $createdName;
    private $userLimit;
    private $usersCount;
    private $viewCount;
    private $description;
    public function __construct($id,$title,$stype,$gtype,$tType,$cDate,$owner,$uLimit,$uCount,$vCount,$desc)
    {
        $this->id=$id;
        $this->title=$title;
        $this->sportType=$stype;
        $this->gameType=$gtype;
        $this->teamType=$tType;
        $this->createdDate=$cDate;
        $this->createdName=$owner;
        $this->userLimit=$uLimit;
        $this->usersCount=$uCount;
        $this->viewCount=$vCount;
        $this->description=$desc;
    }


    public function getId()
    {
        return $this->id;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function getTitle()
    {
        return $this->title;
    }

    public function getSportType()
    {
        return $this->sportType;
    }
    public function getGameType()
    {
        return $this->gameType;
    }
    public function getCreatedDate()
    {
        return $this->createdDate;
    }
    public function getCreatedName()
    {
        return $this->createdName;
    }
    public function getTeamType()
    {
        return $this->teamType;
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
    public function viewIncrement(){
        $this->viewCount+=1;

    }
    public function jsonSerialize () { return $this->toArray(); }
}

