<?php
/**
 * Created by PhpStorm.
 * User: Ramic
 * Date: 03.05.2019
 * Time: 10:20
 */

include_once "Category.php";
include_once "DatabaseManager.php";
class CategoryCollection
{
    private $allCategories=array();
    private $dbInstance;
    private static $instance=null;
    private $size;

    public static function getInstance(){
        if(!self::$instance){
            self::$instance=new CategoryCollection();

        }
        return self::$instance;
    }

    public function __construct()
    {
        $this->dbInstance= DatabaseManager::getInstance();

    }

    public function addNewCategory($category)
    {
        array_push($this->allCategories,$category);
    }

    public function addNewCategoryToDB($title,$stype,$gtype,$ttype,$createdBy,$userLimit,$current,$views,$description)
    {
        $query="INSERT INTO MATCHBOARD (owner,gametype,sportstype,teamtype,userlimit,currentusers,views,description,title) values('$createdBy','$gtype','$stype','$ttype','$userLimit','$current','$views','$description','$title')";
        $result=$this->dbInstance->getQueryResult($query);
        //unset($_SESSION['data']);
        return $result;
    }
    public function getAllCategories()
    {
        return $this->allCategories;


    }
    public function fetchBoardFromDB(){

        $query="SELECT * FROM MATCHBOARD";
        $result=$this->dbInstance->getQueryResult($query);

        if ($result->num_rows){
            while($row=mysqli_fetch_array($result)){
                 $category=new Category($row['id'],$row['title'],$row['sportstype'],$row['gametype'],$row['teamtype'],$row['createdate'],$row['owner'],$row['userlimit'],$row['currentusers'],$row['views'],$row['description']);
                 $this->addNewCategory($category);
            }
        }
    }

    public function viewIncrement($id){
        $query="UPDATE MATCHBOARD SET views=views+1 WHERE id='$id'";
        $result=$this->dbInstance->getQueryResult($query);
        //unset($_SESSION['data']);
        return $result;

    }



    public function getCategorySize()
    {
        return sizeof($this->allCategories);
    }

    public function jsonSerialize () { return $this->toArray(); }
}

/*$SPORT1=new Category("가대 축구","SPORT","SOCCER","TEAM","2019-01-01","MR KIM",15,0,0,"brief description");
$SPORT2=new Category("홍대 축구","SPORT","SOCCER","TEAM","2019-05-01","MR HONG",14,0,0,"brief description");
$SPORT3=new Category("가대 야구","SPORT","BASEBALL","SINGLE","2019-06-01","MR KANG",5,0,0,"brief description");
$SPORT4=new Category("가대 탁구","SPORT","PINGPONG","TEAM","2019-02-03","MR PARK",6,0,0,"brief description");
$SPORT5=new Category("인하대 탁구","SPORT","PINGPONG","SINGLE","2018-04-01","MR HWANG",4,0,0,"brief description");
$SPORT6=new Category("가대 농구","SPORT","BASKETBALL","TEAM","2018-08-01","MR LEE",14,0,0,"brief description");
$SPORT7=new Category("부천대 농구","SPORT","BASKETBALL","TEAM","2019-09-21","MR LIM",14,0,0,"brief description");
$SPORT8=new Category("가대 테니스","SPORT","TENNIS","SINGLE","2019-11-30","MR KWON",5,0,0,"brief description");
$SPORT9=new Category("세종대 테니스","SPORT","TENNIS","TEAM","2019-04-16","MR LAM",8,0,0,"brief description");
$SPORT10=new Category("구로대 테니스","SPORT","TENNIS","SINGLE","2019-03-13","MR CHING",7,0,0,"brief description");

$ecat1= new Category("가대 베틀","ESPORT","BATTLEGROUND","TEAM","2019-01-04","MR KANG",10,0,0,"brief description");
$ecat2= new Category("홍대 베틀","ESPORT","BATTLEGROUND","TEAM","2019-03-19","MR HWANG",8,0,0,"brief description");
$ecat3= new Category("연세대 베틀","ESPORT","BATTLEGROUND","SINGLE","2019-06-04","MR LIM",7,0,0,"brief description");
$ecat4= new Category("세종대 오버","ESPORT","OVERWATCH","SINGLE","2019-10-15","MR PUNG",5,0,0,"brief description");
$ecat5= new Category("경인대 오버","ESPORT","OVERWATCH","TEAM","2019-08-28","MR KWON",9,0,0,"brief description");
$ecat6= new Category("인하대 롤","ESPORT","LOL","TEAM","2019-12-05","MR PCHAN",12,0,0,"brief description");
$ecat7= new Category("가대 롤","ESPORT","LOL","SINGLE","2019-03-09","MR MOL",8,0,0,"brief description");
$ecat8= new Category("가대 로켓","ESPORT","ROCKET","TEAM","2019-05-19","MR KUNG",4,0,0,"brief description");


$collection = new CategoryCollection();

$collection->addNewCategory($SPORT1);
$collection->addNewCategory($SPORT2);
$collection->addNewCategory($SPORT3);
$collection->addNewCategory($SPORT4);
$collection->addNewCategory($SPORT5);
$collection->addNewCategory($SPORT6);
$collection->addNewCategory($SPORT7);
$collection->addNewCategory($SPORT8);
$collection->addNewCategory($SPORT9);
$collection->addNewCategory($SPORT10);

$collection->addNewCategory($ecat1);
$collection->addNewCategory($ecat2);
$collection->addNewCategory($ecat3);
$collection->addNewCategory($ecat4);
$collection->addNewCategory($ecat5);
$collection->addNewCategory($ecat6);
$collection->addNewCategory($ecat7);
$collection->addNewCategory($ecat8);*/

