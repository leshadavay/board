<?php
/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 5/7/2019
 * Time: 3:33 PM
 */
session_start();
include_once "CategoryCollection.php";
$collection=CategoryCollection::getInstance();
if(isset($_POST['newcategory'])){
    $createdBy=$_POST['crname'];
    $title=$_POST['title'];
    $stype=$_POST['stype'];
    $gtype=$_POST['gtype'];
    $ttype=$_POST['ttype'];
    $userLimit=$_POST['ulimit'];
    $description=$_POST['desc'];
    $date = new DateTime();
    //$date->format('Y-m-d')
    $result= $collection->addNewCategoryToDB($title,$stype,$gtype,$ttype,$createdBy,$userLimit,0,0,$description);

    if($result) unset($_SESSION['data']);

    //$result=$controller->saveNewCollectionIntoDB($gname,$original,$meaning,$example);
    //unset($_SESSION['initgnames']);
    //unset($_SESSION['initwords']);
    //echo $result;
    echo $result;
}
if(isset($_POST['view'])){
    $boardID=$_POST['boardID'];
    if(isset($_SESSION['data'])){
        $data=unserialize($_SESSION['data']);
        for($i=0;$i<sizeof($data);$i++){
            if($data[$i]->getId()==$boardID){
                $data[$i]->viewIncrement();
                $result=$collection->viewIncrement($boardID);

                $_SESSION['data']=serialize($data);
                echo $result;
                break;
            }
        }

    }

}