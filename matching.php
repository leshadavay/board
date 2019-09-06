<?php
session_start();
    include_once "CategoryCollection.php";
    include_once "DatabaseManager.php";

$ctype="ALL";
$cname="ALL";
$opt="ALL";
$viewType="GRID";
    if(isset($_GET['ctype']))
        $ctype=$_GET['ctype'];
if(isset($_GET['cname']))
    $cname=$_GET['cname'];
if(isset($_GET['option']))
    $opt=$_GET['option'];
if(isset($_GET['view']))
    $viewType=$_GET['view'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="style/notificationAnimation.css">
    <link rel="stylesheet" href="style/board-style.css">
    <script type="text/javascript" src="scripts/modal-window.js"></script>

    <script type="text/javascript" src="scripts/notification.js"></script>
    <script type="text/javascript" src="scripts/gradientColors.js"></script>
    <script type="text/javascript" src="jquery/jquery.min.js"></script>
    <script type="text/javascript" src="jquery/jquery-3.3.1.min.js"></script>

    <style>



    </style>
    <script>
        var delaytime=0.1;
        var dataRow=[];
        var dataAll=[];

        function printTableRow(boardid,writer,title,gametype,sportstype,teamtype,uploadDate,nowPeo,maxPeo,views,content){
            dataRow=[];
            dataRow.push(boardid,writer,title,gametype,sportstype,teamtype,uploadDate,nowPeo,maxPeo,views,content);
            dataAll.push(dataRow);
            //console.log(dataRow);
            printDataFromDB(dataRow);
        }

        function printDataFromDB(dataRow){
            //var main=document.getElementById("main-page");
            var table=document.getElementById("board-table-body");

            var tr=createRow(dataRow);

            table.appendChild(tr);


        }
        function createRow(row){

            var tr=document.createElement("tr");
            tr.setAttribute("onclick","showDescriptionModal(this,'LIST')");
            tr.setAttribute("class","board-table-row");
            for(var i=0;i<row.length;i++){
                var td=document.createElement("td");


                td.innerHTML=row[i];
                if(i==row.length-1)
                    td.style.display="none";
                tr.appendChild(td);

            }

            tr.style.opacity="0";


            tr.style.animation = "table-row-animation 0.5s";
            tr.style.animationFillMode = "forwards";
            tr.style.animationDelay=""+(delaytime+=0.1)+"s";


            return tr;
        }

    </script>
</head>
<body>
<div id="middle-menu-bar">
    <button id="button-create-category" class="btn-options" onclick="showCreatESportModal()" style="position: absolute;left: 25%;top: 20px;">create </button>
    <ul style="display: inline-block">
        <li><button class="btn-options" id="ALL" onclick="sendOptionRequestParameter(this);">ALL</button></li>
        <li><button class="btn-options" id="TEAM" onclick="sendOptionRequestParameter(this);">팀</button></li>
        <li><button class="btn-options" id="SINGLE" onclick="sendOptionRequestParameter(this);">개인</button></li>

    </ul>
    <button class="btn-options" style="position: absolute;right: 22%;top: 18px;">my page </button>
    <div id="view" onclick="changeView(this);">  </div>
</div>
<div id="left-menu-bar">

    <label class="left-category-title">Sports Category</label>
    <ul>

        <li class="left-ul-li"><label id="ALL" onclick="sendSportRequestParameter(this);"> <img class="left-logo" src="resources/all.png">  <button class="left-bar-btn-category">ALL</button></label></li>
        <li class="left-ul-li"><label id="SOCCER" onclick="sendSportRequestParameter(this);"> <img class="left-logo" src="resources/soccer.png"><button class="left-bar-btn-category">Soccer</button></label></li>
        <li class="left-ul-li"><label id="BASEBALL" onclick="sendSportRequestParameter(this);"> <img class="left-logo" src="resources/baseball2.png"><button class="left-bar-btn-category">Baseball</button></label></li>
        <li class="left-ul-li"><label id="PINGPONG" onclick="sendSportRequestParameter(this);"> <img class="left-logo" src="resources/pingpong2.png"><button class="left-bar-btn-category">Ping pong</button></label></li>
        <li class="left-ul-li"><label id="BASKETBALL" onclick="sendSportRequestParameter(this);"> <img class="left-logo" src="resources/basketball.png"><button class="left-bar-btn-category">Basketball</button></label></li>
        <li class="left-ul-li"><label id="TENNIS" onclick="sendSportRequestParameter(this);"> <img class="left-logo" src="resources/tennis.png"><button class="left-bar-btn-category">Tennis</button></label></li>
        <li class="left-ul-li"><label id="ETC" onclick="sendSportRequestParameter(this);"> <img class="left-logo" src="resources/etc.png"><button class="left-bar-btn-category">...</button></label></li>
    </ul>

</div>
<div id="right-menu-bar">

    <label class="right-category-title">E-Sports Category</label>
    <ul>

        <li class="right-ul-li"><label id="ALL" onclick="sendESportRequestParameter(this);"> <button class="right-bar-btn-category">ALL</button><img class="right-logo" src="resources/all.png"></label></li>
        <li class="right-ul-li"><label id="BATTLEGROUND" onclick="sendESportRequestParameter(this);"> <button class="right-bar-btn-category">BattleGround</button> <img class="right-logo" src="resources/battleground.png"></li>
        <li class="right-ul-li"><label id="OVERWATCH" onclick="sendESportRequestParameter(this);"> <button class="right-bar-btn-category"> Overwatch</button><img class="right-logo" src="resources/overwatch.png"></li>
        <li class="right-ul-li"><label id="LOL" onclick="sendESportRequestParameter(this);"> <button class="right-bar-btn-category">LOL</button><img class="right-logo" src="resources/lol.png"></li>
        <li class="right-ul-li"><label id="ROCKET" onclick="sendESportRequestParameter(this);"> <button class="right-bar-btn-category">Rocket</button><img class="right-logo" src="resources/rocket.png"></li>
        <li class="right-ul-li"><label id="ETC" onclick="sendESportRequestParameter(this);"> <button class="right-bar-btn-category">...</button><img class="right-logo" src="resources/etc.png"></li>
    </ul>

</div>

<div id="main-page" >

    <div id="categories">
        <?php
        $collection = new CategoryCollection();

        if(!isset($_SESSION['data'])){
            $collection->fetchBoardFromDB();
            $data=$collection->getAllCategories();
            $_SESSION['data']=serialize($data);
            echo "<script>showNotification('Fetched data from Database');</script>";

        }
        else{
            $data=unserialize($_SESSION['data']);
            echo "<script>showNotification('Unserialized objects from php Session');</script>";
        }

        echo getPrintData($opt, $ctype, $cname, $data,$viewType);

        ?>
    </div>
</div>
<div id="create-category-modal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2>Create new category</h2>
        </div>
        <form>
        <div class="modal-body">

                <table>
                    <caption>Input information below</caption>
                    <tr><td>Title:</td><td><input  type="text" class="cat-input"></td></tr>
                    <tr><td>Sport type:</td><td><select id="sport-option" onchange="showSportType(this.value);" class="cat-input"><option>SPORT</option><option>ESPORT</option></select></td></tr>
                    <tr><td>Game type:</td><td><select id="sport-type" class="cat-input"></select></td></tr>
                    <tr><td>Single or Team:</td><td><select  class="cat-input"><option>SINGLE</option><option>TEAM</option></select></td></tr>
                    <tr><td>User limit: </td><td><input class="cat-input" type="number"></td></tr>
                    <tr><td>Description:</td><td><textarea rows="5" cols="30" class="cat-input"></textarea></td></tr>
                </table>


        </div>
        <div class="modal-footer" onclick="createNewCategory()">
            <h3>SAVE</h3>
        </div>
        </form>
    </div>

</div>
<div id="show-description-modal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2></h2>
        </div>
        <form>
            <div class="modal-body">

<!--                <table>
                    <caption>Input information below</caption>
                    <tr><td>Category name:</td><td><input  type="text" class="cat-input"></td></tr>
                    <tr><td>Sport option:</td><td><select id="sport-option" onchange="showSportType(this.value);" class="cat-input"><option>Sport</option><option>E-Sport</option></select></td></tr>
                    <tr><td>Sport type:</td><td><select id="sport-type" class="cat-input"></select></td></tr>
                    <tr><td>Category type:</td><td><select  class="cat-input"><option>Single</option><option>Team</option></select></td></tr>
                    <tr><td>User limit: </td><td><input class="cat-input" type="number"></td></tr>
                    <tr><td>Description:</td><td><textarea rows="5" cols="30" class="cat-input"></textarea></td></tr>
                </table>
-->

            </div>
            <div class="modal-footer" >

            </div>
        </form>
    </div>

</div>

<script>




    showSportType("SPORT");
    function showSportType(type) {
        var sportNode=document.getElementById("sport-type");

        switch (type) {
            case "SPORT":{
                while(sportNode.hasChildNodes()){
                    sportNode.removeChild(sportNode.lastChild);
                }
                sportNode.appendChild(createElement("option","SOCCER"));
                sportNode.appendChild(createElement("option","BASEBALL"));
                sportNode.appendChild(createElement("option","PINGPONG"));
                sportNode.appendChild(createElement("option","BASKETBALL"));
                sportNode.appendChild(createElement("option","TENNIS"));

            }break;
            case "ESPORT":{
                while(sportNode.hasChildNodes()){
                    sportNode.removeChild(sportNode.lastChild);
                }
                sportNode.appendChild(createElement("option","BATTLEGROUND"));
                sportNode.appendChild(createElement("option","OVERWATCH"));
                sportNode.appendChild(createElement("option","LOL"));
                sportNode.appendChild(createElement("option","ROCKET"));
            }break;
        }

    }
    function createElement(elementName,elementValue){
        var node = document.createElement(elementName);
        if(elementValue!=""){
            node.innerHTML = elementValue;
        }
        return node;
    }

    function createNewCategory() {
        var input=document.getElementsByClassName("cat-input");
        var emptyFound=false;
        for(var i=0;i<input.length;i++){
            if(input[i].value==""){
                alert("Please, input empty fields");
                emptyFound=true;
                break;
            }
        }
        if(!emptyFound){

            $.post('postController.php', {
                newcategory: "yes",
                crname: "user1",
                title: input[0].value,
                stype: input[1].value,
                gtype: input[2].value,
                ttype:input[3].value,
                ulimit:input[4].value,
                desc: input[5].value

            }, function(response) {
                //alert(response);
                if(response==1){
                    showNotification("All data successfully stored");

                    window.location.replace("matching.php?option=ALL&ctype=ALL&cname=ALL&view="+viewType+"");
                }
                else
                    alert("Error on connecting database");
            });

        }
    }


</script>
<?php
function getPrintData($option,$ctype,$cname,$data,$view){

    $print="";
    if($view=="GRID") {

        $SPORTTitlePrinted = false;
        $ESPORTTitlePrinted = false;
        for ($i = 0; $i < sizeof($data); $i++) {
        if ($ctype == "ALL" && $cname == "ALL") {

            if ($option == "ALL") {


                   /* if (!$SPORTTitlePrinted && $data[$i]->getSportType() == "SPORT") {
                        $print .= "<hr><br><h1 class='sport-type-title'>Sport Matching</h1>  ";
                        $SPORTTitlePrinted = true;
                    } else if (!$ESPORTTitlePrinted && $data[$i]->getSportType() == "ESPORT") {
                        $print .= "<hr><br><h1 class='sport-type-title'>E - Sport Matching</h1>";
                        $ESPORTTitlePrinted = true;
                    }*/
                    $print .= "<div class='cat-box' onclick='showDescriptionModal(this,".json_encode($view).")'><fieldset> <legend><h3>" . $data[$i]->getTitle() . "</h3></legend>";
                    $print .= "<div class='hidden-data'>" . $data[$i]->getId() . "</div>";
                    $print .= "<b>Game Type:</b> <span>" . $data[$i]->getGameType() . "</span><br>";
                    $print .= "<b>Sport Type:</b> <span>" . $data[$i]->getSportType() . "</span><br>";
                    $print .= "<b>Single/Team:</b> <span>" . $data[$i]->getTeamType() . "</span><br>";
                    $print .= "<b>Created Data:</b> <span>" . $data[$i]->getCreatedDate() . "</span><br>";
                    $print .= "<b>Current Users:</b> <span>" . $data[$i]->getUsersCount() . "</span><br>";
                    $print .= "<b>Max Users:</b> <span>" . $data[$i]->getUserLimit() . "</span><br>";
                    $print .= "<b>Views:</b> <span>" . $data[$i]->getViewCount() . "</span>";
                    $print .= "<div class='hidden-data'>" . $data[$i]->getSportType() . "</div>";
                    $print .= "<div class='hidden-data'>" . $data[$i]->getCreatedName() . "</div>";
                    $print .= "<div class='hidden-data'>" . $data[$i]->getDescription() . "</div></fieldset></div>";


            } else {

                  /*  if (!$SPORTTitlePrinted && $data[$i]->getSportType() == "SPORT") {
                        $print .= "<hr><br><h1 class='sport-type-title'>Sport Matching</h1>";
                        $SPORTTitlePrinted = true;
                    } else if (!$ESPORTTitlePrinted && $data[$i]->getSportType() == "ESPORT") {
                        $print .= "<hr><br><h1 class='sport-type-title'>E - Sport Matching</h1>";
                        $ESPORTTitlePrinted = true;
                    }*/
                    if ($data[$i]->getTeamType() == $option) {
                        $print .= "<div class='cat-box' onclick='showDescriptionModal(this,".json_encode($view).")'><fieldset> <legend><h3>" . $data[$i]->getTitle() . "</h3></legend>";
                        $print .= "<div class='hidden-data'>" . $data[$i]->getId() . "</div>";
                        $print .= "<b>Game Type:</b> <span>" . $data[$i]->getGameType() . "</span><br>";
                        $print .= "<b>Sport Type:</b> <span>" . $data[$i]->getSportType() . "</span><br>";
                        $print .= "<b>Single/Team:</b> <span>" . $data[$i]->getTeamType() . "</span><br>";
                        $print .= "<b>Created Data:</b> <span>" . $data[$i]->getCreatedDate() . "</span><br>";
                        $print .= "<b>Current Users:</b> <span>" . $data[$i]->getUsersCount() . "</span><br>";
                        $print .= "<b>Max Users:</b> <span>" . $data[$i]->getUserLimit() . "</span><br>";
                        $print .= "<b>Views:</b> <span>" . $data[$i]->getViewCount() . "</span>";
                        $print .= "<div class='hidden-data'>" . $data[$i]->getSportType() . "</div>";
                        $print .= "<div class='hidden-data'>" . $data[$i]->getCreatedName() . "</div>";
                        $print .= "<div class='hidden-data'>" . $data[$i]->getDescription() . "</div></fieldset></div>";
                    }


            }
        } else if ((($ctype == "SPORT") || ($ctype == "ESPORT")) && $cname == "ALL") {
            if ($option == "ALL") {

                 /*   if (!$SPORTTitlePrinted && $ctype == "SPORT") {
                        $print .= "<hr><br><h1 class='sport-type-title'>Sport Matching</h1>";
                        $SPORTTitlePrinted = true;
                    } else if (!$ESPORTTitlePrinted && $ctype == "ESPORT") {
                        $print .= "<hr><br><h1 class='sport-type-title'>E - Sport Matching</h1>";
                        $ESPORTTitlePrinted = true;
                    }*/
                    if ($data[$i]->getSportType() == $ctype) {
                        $print .= "<div class='cat-box' onclick='showDescriptionModal(this,".json_encode($view).")'><fieldset> <legend><h3>" . $data[$i]->getTitle() . "</h3></legend>";
                        $print .= "<div class='hidden-data'>" . $data[$i]->getId() . "</div>";
                        $print .= "<b>Game Type:</b> <span>" . $data[$i]->getGameType() . "</span><br>";
                        $print .= "<b>Sport Type:</b> <span>" . $data[$i]->getSportType() . "</span><br>";
                        $print .= "<b>Single/Team:</b> <span>" . $data[$i]->getTeamType() . "</span><br>";
                        $print .= "<b>Created Data:</b> <span>" . $data[$i]->getCreatedDate() . "</span><br>";
                        $print .= "<b>Current Users:</b> <span>" . $data[$i]->getUsersCount() . "</span><br>";
                        $print .= "<b>Max Users:</b> <span>" . $data[$i]->getUserLimit() . "</span><br>";
                        $print .= "<b>Views:</b> <span>" . $data[$i]->getViewCount() . "</span>";
                        $print .= "<div class='hidden-data'>" . $data[$i]->getSportType() . "</div>";
                        $print .= "<div class='hidden-data'>" . $data[$i]->getCreatedName() . "</div>";
                        $print .= "<div class='hidden-data'>" . $data[$i]->getDescription() . "</div></fieldset></div>";
                    }

            } else {

                   /* if (!$SPORTTitlePrinted && $ctype == "SPORT") {
                        $print .= "<hr><br><h1 class='sport-type-title'>Sport Matching</h1>";
                        $SPORTTitlePrinted = true;
                    } else if (!$ESPORTTitlePrinted && $ctype == "ESPORT") {
                        $print .= "<hr><br><h1 class='sport-type-title'>E - Sport Matching</h1>";
                        $ESPORTTitlePrinted = true;
                    }*/

                    if ($data[$i]->getTeamType() == $option) {
                        if ($data[$i]->getSportType() == $ctype) {
                            $print .= "<div class='cat-box' onclick='showDescriptionModal(this,".json_encode($view).")'><fieldset> <legend><h3>" . $data[$i]->getTitle() . "</h3></legend>";
                            $print .= "<div class='hidden-data'>" . $data[$i]->getId() . "</div>";
                            $print .= "<b>Game Type:</b> <span>" . $data[$i]->getGameType() . "</span><br>";
                            $print .= "<b>Sport Type:</b> <span>" . $data[$i]->getSportType() . "</span><br>";
                            $print .= "<b>Single/Team:</b> <span>" . $data[$i]->getTeamType() . "</span><br>";
                            $print .= "<b>Created Data:</b> <span>" . $data[$i]->getCreatedDate() . "</span><br>";
                            $print .= "<b>Current Users:</b> <span>" . $data[$i]->getUsersCount() . "</span><br>";
                            $print .= "<b>Max Users:</b> <span>" . $data[$i]->getUserLimit() . "</span><br>";
                            $print .= "<b>Views:</b> <span>" . $data[$i]->getViewCount() . "</span>";
                            $print .= "<div class='hidden-data'>" . $data[$i]->getSportType() . "</div>";
                            $print .= "<div class='hidden-data'>" . $data[$i]->getCreatedName() . "</div>";
                            $print .= "<div class='hidden-data'>" . $data[$i]->getDescription() . "</div></fieldset></div>";
                        }
                    }

            }
        } else {
            if ($option == "ALL") {

                  /*  if (!$SPORTTitlePrinted && $ctype == "SPORT") {
                        $print .= "<hr><br><h1 class='sport-type-title'>Sport Matching</h1>";
                        $SPORTTitlePrinted = true;
                    } else if (!$ESPORTTitlePrinted && $ctype == "ESPORT") {
                        $print .= "<hr><br><h1 class='sport-type-title'>E - Sport Matching</h1>";
                        $ESPORTTitlePrinted = true;
                    }*/
                    if ($ctype == $data[$i]->getSportType()) {
                        if ($cname == $data[$i]->getGameType()) {
                            $print .= "<div class='cat-box' onclick='showDescriptionModal(this,".json_encode($view).")'><fieldset> <legend><h3>" . $data[$i]->getTitle() . "</h3></legend>";
                            $print .= "<div class='hidden-data'>" . $data[$i]->getId() . "</div>";
                            $print .= "<b>Game Type:</b> <span>" . $data[$i]->getGameType() . "</span><br>";
                            $print .= "<b>Sport Type:</b> <span>" . $data[$i]->getSportType() . "</span><br>";
                            $print .= "<b>Single/Team:</b> <span>" . $data[$i]->getTeamType() . "</span><br>";
                            $print .= "<b>Created Data:</b> <span>" . $data[$i]->getCreatedDate() . "</span><br>";
                            $print .= "<b>Current Users:</b> <span>" . $data[$i]->getUsersCount() . "</span><br>";
                            $print .= "<b>Max Users:</b> <span>" . $data[$i]->getUserLimit() . "</span><br>";
                            $print .= "<b>Views:</b> <span>" . $data[$i]->getViewCount() . "</span>";
                            $print .= "<div class='hidden-data'>" . $data[$i]->getSportType() . "</div>";
                            $print .= "<div class='hidden-data'>" . $data[$i]->getCreatedName() . "</div>";
                            $print .= "<div class='hidden-data'>" . $data[$i]->getDescription() . "</div></fieldset></div>";
                        }

                }
            } else {


                   /* if (!$SPORTTitlePrinted && $ctype == "SPORT") {
                        $print .= "<hr><br><h1 class='sport-type-title'>Sport Matching</h1>";
                        $SPORTTitlePrinted = true;
                    } else if (!$ESPORTTitlePrinted && $ctype == "ESPORT") {
                        $print .= "<hr><br><h1 class='sport-type-title'>E - Sport Matching</h1>";
                        $ESPORTTitlePrinted = true;
                    }*/
                    if ($option == $data[$i]->getTeamType()) {
                        if ($ctype == $data[$i]->getSportType()) {
                            if ($cname == $data[$i]->getGameType()) {
                                $print .= "<div class='cat-box' onclick='showDescriptionModal(this,".json_encode($view).")'><fieldset> <legend><h3>" . $data[$i]->getTitle() . "</h3></legend>";
                                $print .= "<div class='hidden-data'>" . $data[$i]->getId() . "</div>";
                                $print .= "<b>Game Type:</b> <span>" . $data[$i]->getGameType() . "</span><br>";
                                $print .= "<b>Sport Type:</b> <span>" . $data[$i]->getSportType() . "</span><br>";
                                $print .= "<b>Single/Team:</b> <span>" . $data[$i]->getTeamType() . "</span><br>";
                                $print .= "<b>Created Data:</b> <span>" . $data[$i]->getCreatedDate() . "</span><br>";
                                $print .= "<b>Current Users:</b> <span>" . $data[$i]->getUsersCount() . "</span><br>";
                                $print .= "<b>Max Users:</b> <span>" . $data[$i]->getUserLimit() . "</span><br>";
                                $print .= "<b>Views:</b> <span>" . $data[$i]->getViewCount() . "</span>";
                                $print .= "<div class='hidden-data'>" . $data[$i]->getSportType() . "</div>";
                                $print .= "<div class='hidden-data'>" . $data[$i]->getCreatedName() . "</div>";
                                $print .= "<div class='hidden-data'>" . $data[$i]->getDescription() . "</div></fieldset></div>";
                            }
                        }
                    }
                }
            }
        }

    }
    else{ //list-view
        $print.='<div id="main-page">
       <table class="table table-hover table-dark" id="board-table">
				<thead>
					<tr>
						<th scope="col">ID</th>
						<th scope="col">By</th>
						<th scope="col">Title</th>
						<th scope="col">종목</th>
						<th scope="col">Sport/E-Sport</th>
						<th scope="col">Single/Team</th>
						<th scope="col">Date</th>
						<th scope="col">Current</th>
						<th scope="col">Limit</th>
						<th scope="col">Views</th>
					</tr>
				</thead>
				<tbody id="board-table-body">

				</tbody>
			</table></div> ';

        for ($i = 0; $i < sizeof($data); $i++) {
            if ($ctype == "ALL" && $cname == "ALL") {
                if ($option == "ALL") {
                    $description=$data[$i]->getDescription();
                    $print.= "<script>printTableRow(".json_encode($data[$i]->getId()).",".json_encode($data[$i]->getCreatedName()).",".json_encode($data[$i]->getTitle()).",".json_encode($data[$i]->getGameType()).",".json_encode($data[$i]->getSportType()).",".json_encode($data[$i]->getTeamType()).",".json_encode($data[$i]->getCreatedDate()).",".json_encode($data[$i]->getUsersCount()).",".json_encode($data[$i]->getUserLimit()).",".json_encode($data[$i]->getViewCount()).",".json_encode($description).");</script>";
                } else {
                        if ($data[$i]->getTeamType() == $option) {
                            $description=$data[$i]->getDescription();
                            $print.= "<script>printTableRow(".json_encode($data[$i]->getId()).",".json_encode($data[$i]->getCreatedName()).",".json_encode($data[$i]->getTitle()).",".json_encode($data[$i]->getGameType()).",".json_encode($data[$i]->getSportType()).",".json_encode($data[$i]->getTeamType()).",".json_encode($data[$i]->getCreatedDate()).",".json_encode($data[$i]->getUsersCount()).",".json_encode($data[$i]->getUserLimit()).",".json_encode($data[$i]->getViewCount()).",".json_encode($description).");</script>";
                        }
                }
            } else if ((($ctype == "SPORT") || ($ctype == "ESPORT")) && $cname == "ALL") {
                if ($option == "ALL") {
                    if ($data[$i]->getSportType() == $ctype) {
                            $description=$data[$i]->getDescription();
                            $print.= "<script>printTableRow(".json_encode($data[$i]->getId()).",".json_encode($data[$i]->getCreatedName()).",".json_encode($data[$i]->getTitle()).",".json_encode($data[$i]->getGameType()).",".json_encode($data[$i]->getSportType()).",".json_encode($data[$i]->getTeamType()).",".json_encode($data[$i]->getCreatedDate()).",".json_encode($data[$i]->getUsersCount()).",".json_encode($data[$i]->getUserLimit()).",".json_encode($data[$i]->getViewCount()).",".json_encode($description).");</script>";
                        }
                } else {
                        if ($data[$i]->getTeamType() == $option) {
                            if ($data[$i]->getSportType() == $ctype) {
                                $description=$data[$i]->getDescription();
                                $print.= "<script>printTableRow(".json_encode($data[$i]->getId()).",".json_encode($data[$i]->getCreatedName()).",".json_encode($data[$i]->getTitle()).",".json_encode($data[$i]->getGameType()).",".json_encode($data[$i]->getSportType()).",".json_encode($data[$i]->getTeamType()).",".json_encode($data[$i]->getCreatedDate()).",".json_encode($data[$i]->getUsersCount()).",".json_encode($data[$i]->getUserLimit()).",".json_encode($data[$i]->getViewCount()).",".json_encode($description).");</script>";
                            }
                        }
                }
            } else {
                if ($option == "ALL") {
                        if ($ctype == $data[$i]->getSportType()) {
                            if ($cname == $data[$i]->getGameType()) {
                                $description=$data[$i]->getDescription();
                                $print.= "<script>printTableRow(".json_encode($data[$i]->getId()).",".json_encode($data[$i]->getCreatedName()).",".json_encode($data[$i]->getTitle()).",".json_encode($data[$i]->getGameType()).",".json_encode($data[$i]->getSportType()).",".json_encode($data[$i]->getTeamType()).",".json_encode($data[$i]->getCreatedDate()).",".json_encode($data[$i]->getUsersCount()).",".json_encode($data[$i]->getUserLimit()).",".json_encode($data[$i]->getViewCount()).",".json_encode($description).");</script>";
                            }
                        }

                } else {
                        if ($option == $data[$i]->getTeamType()) {
                            if ($ctype == $data[$i]->getSportType()) {
                                if ($cname == $data[$i]->getGameType()) {
                                    $description=$data[$i]->getDescription();
                                    $print.= "<script>printTableRow(".json_encode($data[$i]->getId()).",".json_encode($data[$i]->getCreatedName()).",".json_encode($data[$i]->getTitle()).",".json_encode($data[$i]->getGameType()).",".json_encode($data[$i]->getSportType()).",".json_encode($data[$i]->getTeamType()).",".json_encode($data[$i]->getCreatedDate()).",".json_encode($data[$i]->getUsersCount()).",".json_encode($data[$i]->getUserLimit()).",".json_encode($data[$i]->getViewCount()).",".json_encode($description).");</script>";
                                }
                            }
                        }
                    }
                }

            }




            //$description=$data[$i]->getDescription().replaceAll("\\r?\\n", " ");
            //$description=$data[$i]->getDescription();
            //$print.= "<script>printTableRow(".json_encode($data[$i]->getId()).",".json_encode($data[$i]->getCreatedName()).",".json_encode($data[$i]->getTitle()).",".json_encode($data[$i]->getGameType()).",".json_encode($data[$i]->getSportType()).",".json_encode($data[$i]->getTeamType()).",".json_encode($data[$i]->getCreatedDate()).",".json_encode($data[$i]->getUsersCount()).",".json_encode($data[$i]->getUserLimit()).",".json_encode($data[$i]->getViewCount()).",".json_encode($description).");</script>";

        }


   return $print;
}


?>



<script type="text/javascript" src="scripts/board-animation.js"></script>

</body>
</html>


<?php
    if($opt=="") $opt="ALL";
    if($ctype=="") $ctype="ALL";
    if($cname=="") $cname="ALL";

    echo "<script>init('$opt','$ctype','$cname'); </script>";

    /*switch ($ctype){
        case "SPORT":{
            switch ($cname){
                case "ALL":{

                }
            }
        }
        break;
        case "ESPORT":{

        }
        break;

    }*/



    ?>