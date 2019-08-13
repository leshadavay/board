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
    <link rel="stylesheet" href="notificationAnimation.css">
    <script type="text/javascript" src="notification.js"></script>
    <script type="text/javascript" src="gradientColors.js"></script>
    <script type="text/javascript" src="jquery.min.js"></script>
    <script type="text/javascript" src="jquery-3.3.1.min.js"></script>
    <style>
        body{

            padding:0;
            margin-top: 0;
            width: 100%;
            font-family: 'Oswald', sans-serif;

        }
        * {
            -webkit-transition-property: all;
            -webkit-transition-duration: .2s;
            -moz-transition-timing-function: cubic-bezier(100,50,21,6);
            -moz-transition-property: all;
            -moz-transition-timing-function: cubic-bezier(100,50,21,6);
        }
        h1{
            color: #9deee9;
            font-weight:100;

        }
        .sport-type-title{
            color: #ee5573;
        }

        .left-bar-btn-category{

            color: #c0c0c0;
            background-color: transparent;
            padding:10px 20px;
            font-size:14px;
            text-decoration:none;
            letter-spacing:2px;
            text-transform:uppercase;
            border: none;
            position: absolute;
            left: 80px;
            transition: all 0.2s;
        }

        .left-bar-btn-category:hover{
            border:none;
            transform: scale(1.1);
            background:radial-gradient(circle at 94.02% 88.03%, rgb(90, 101, 133), transparent 100%);
            color: #eee79f;
            cursor: pointer;

        }

        .right-bar-btn-category{
            color: #c0c0c0;
            background-color: transparent;
            padding:10px 20px;
            font-size:14px;
            text-decoration:none;
            letter-spacing:2px;
            text-transform:uppercase;
            border: none;
            position: absolute;
            right: 80px;
            transition: all 0.2s;
        }
        .right-bar-btn-category:hover{
            border:none;
            transform: scale(1.1);
            background:radial-gradient(circle at 04.02% 88.03%, rgb(90, 101, 133),transparent 100%);
            color: #eee79f;
            cursor: pointer;
        }

        .btn-options{
            color:#999;
            background:rgba(0, 0, 0, 0.5);
            padding:10px 20px;
            font-size:12px;
            text-decoration:none;
            letter-spacing:2px;
            text-transform:uppercase;
            border: none;

        }
        .btn-options:hover{
            border:none;
            background:rgba(0, 0, 0, 0.4);
            background:#fff;
            color:#1b1b1b;
            cursor: pointer;

        }
        .footer{
            font-size:8px;
            color:#fff;
            clear:both;
            display:block;
            letter-spacing:5px;
            border:1px solid #fff;
            padding:5px;
            text-decoration:none;
            width:210px;
            margin:auto;
            margin-top:400px;
        }
        #middle-menu-bar{
            width: 97%;
            position: fixed;
            text-align: center;
            margin: auto auto;
            display: table;



        }

        #left-menu-bar{

            position: fixed;
            width: 80px;
            height: 98%;
            background-color: rgba(0, 0, 0, 0.87);
            left: 0;
            display: inline-block;
            overflow: hidden;
            z-index: 10;

        }
        #right-menu-bar{
            position: fixed;
            width: 80px;
            height: 98%;
            background-color: rgba(0, 0, 0, 0.87);
            right: 0;
            overflow: hidden;
            display: inline-block;
            z-index: 10;

        }
        #left-menu-bar ul ,#right-menu-bar ul{
            list-style-type: none;
            margin-top: 70px;

        }
        #left-menu-bar li {
            width: 70px;
            height: 70px;

        }
        #right-menu-bar li{
            width: 70px;
            height: 70px;
        }
        .left-category-title{
            margin: 20px;
            position: absolute;
            left: 0;
            font-family: 'Oswald', sans-serif;
            color: #c1c1c1;
        }
        .right-category-title{
            margin: 20px;
            position: absolute;
            right: 0;
            font-family: 'Oswald', sans-serif;
            color: #c1c1c1;
        }

        #middle-menu-bar ul{
            list-style-type: none;

        }
        #middle-menu-bar ul li{
            display: inline-block;

        }
        .left-logo{
            position: absolute;
            width: 40px;
            height: 40px;
            display: inline;
            left: 18px;
            transition: all 0.1s  ;
        }
        .left-logo:hover{
            cursor: pointer;
            transform: scale(1.3);
            border-radius: 50px;
            box-shadow: 0 0 2px 2px #eee32d;
        }
        .right-logo{
            width: 40px;
            height: 40px;

            position: absolute;
            right: 18px;
            transition: all 0.1s  ;
        }
        .right-logo:hover{
            cursor: pointer;
            transform: scale(1.3);
            border-radius: 50px;
            box-shadow: 0 0 2px 2px #eee32d;
        }
        #main-page{
            position: absolute;
            text-align: center;
            width: 90%;
            left: 80px;
            right: 80px;

            top: 100px;
            z-index: -10;

        }

        .cat-box{
            display: inline-block;
            margin: 20px;
            color: #cbcbcb;
        }

        .cat-box fieldset{

            border-radius: 10px;
            border: 1px solid #818181;
            transition: all 0.15s;
            box-shadow: 0 0 20px 15px black;
        }
        .cat-box fieldset legend h3{
            color:  #9deee9;
        }

        .cat-box fieldset:hover{
            cursor: pointer;
            transform: scale(1.07);
            box-shadow: 0 0 10px 2px whitesmoke;

        }
        .cat-box h3{
            color: white;
        }


        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 20; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            position: relative;
            background-color: #fefefe;
            margin: auto;
            padding: 0;

            border: 1.5px solid black;
            border-radius: 10px;
            width: 60%;
/*            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);*/
            -webkit-animation-name: animatetop;
            -webkit-animation-duration: 0.4s;
            animation-name: animatetop;
            animation-duration: 0.4s
        }

        /* Add Animation */
        @-webkit-keyframes animatetop {
            from {top:-300px; opacity:0}
            to {top:0; opacity:1}
        }

        @keyframes animatetop {
            from {transform: scale(0); opacity:0}
            80%{transform: scale(1.1);}
            to {transform: scale(1); opacity:1}
            /*from {top:-300px; opacity:0}
            to {top:0; opacity:1}*/
        }

        /* The Close Button */
        .close {
            color: white;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        .modal-header {
            padding: 2px 16px;
            background: linear-gradient(120deg, #000000, #434343);
            color: white;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .modal-body {padding: 2px 16px;}

        .modal-footer {
            padding: 2px 16px;
            background: linear-gradient(120deg, #000000, #434343);
            color: white;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
            transition: all 0.2s;

        }
        .modal-footer:hover{

            cursor: pointer;
            background: linear-gradient(120deg, #202020, #474747);

        }
        .hidden-data{
            display: none;
        }
        #view{
            position: absolute;
            right: 12%;
            top: 20px;
            width: 30px;
            height: 30px;
            font-size: 0;
            box-shadow: 0 0 1px 1px grey;
        }
        #view:hover{

            cursor: pointer;
            box-shadow: 0 0 8px 2px white;
        }
        .table{width:100%;max-width:100%;margin-bottom:1rem;background-color:transparent}.table td,.table th{padding:.75rem;vertical-align:top;border-top:1px solid #dee2e6}.table thead th{vertical-align:bottom;border-bottom:2px solid #dee2e6}.table tbody+tbody{border-top:2px solid #dee2e6}.table .table{background-color:#fff}.table-sm td,.table-sm th{padding:.3rem}.table-bordered{border:1px solid #dee2e6}.table-bordered td,.table-bordered th{border:1px solid #dee2e6}.table-bordered thead td,.table-bordered thead th{border-bottom-width:2px}.table-striped tbody tr:nth-of-type(odd){background-color:rgba(0,0,0,.05)}.table-hover tbody tr:hover{background-color:rgba(0,0,0,.075)}.table-primary,.table-primary>td,.table-primary>th{background-color:#b8daff}.table-hover .table-primary:hover{background-color:#9fcdff}.table-hover .table-primary:hover>td,.table-hover .table-primary:hover>th{background-color:#9fcdff}.table-secondary,.table-secondary>td,.table-secondary>th{background-color:#d6d8db}.table-hover .table-secondary:hover{background-color:#c8cbcf}.table-hover .table-secondary:hover>td,.table-hover .table-secondary:hover>th{background-color:#c8cbcf}.table-success,.table-success>td,.table-success>th{background-color:#c3e6cb}.table-hover .table-success:hover{background-color:#b1dfbb}.table-hover .table-success:hover>td,.table-hover .table-success:hover>th{background-color:#b1dfbb}.table-info,.table-info>td,.table-info>th{background-color:#bee5eb}.table-hover .table-info:hover{background-color:#abdde5}.table-hover .table-info:hover>td,.table-hover .table-info:hover>th{background-color:#abdde5}.table-warning,.table-warning>td,.table-warning>th{background-color:#ffeeba}.table-hover .table-warning:hover{background-color:#ffe8a1}.table-hover .table-warning:hover>td,.table-hover .table-warning:hover>th{background-color:#ffe8a1}.table-danger,.table-danger>td,.table-danger>th{background-color:#f5c6cb}.table-hover .table-danger:hover{background-color:#f1b0b7}.table-hover .table-danger:hover>td,.table-hover .table-danger:hover>th{background-color:#f1b0b7}.table-light,.table-light>td,.table-light>th{background-color:#fdfdfe}.table-hover .table-light:hover{background-color:#ececf6}.table-hover .table-light:hover>td,.table-hover .table-light:hover>th{background-color:#ececf6}.table-dark,.table-dark>td,.table-dark>th{background-color:#c6c8ca}.table-hover .table-dark:hover{background-color:#b9bbbe}.table-hover .table-dark:hover>td,.table-hover .table-dark:hover>th{background-color:#b9bbbe}.table-active,.table-active>td,.table-active>th{background-color:rgba(0,0,0,.075)}.table-hover .table-active:hover{background-color:rgba(0,0,0,.075)}.table-hover .table-active:hover>td,.table-hover .table-active:hover>th{background-color:rgba(0,0,0,.075)}.table .thead-dark th{color:#fff;background-color:#212529;border-color:#32383e}.table .thead-light th{color:#495057;background-color:#e9ecef;border-color:#dee2e6}.table-dark{color:#fff;background-color:#212529}.table-dark td,.table-dark th,.table-dark thead th{border-color:#32383e}.table-dark.table-bordered{border:0}.table-dark.table-striped tbody tr:nth-of-type(odd){background-color:rgba(255,255,255,.05)}.table-dark.table-hover tbody tr:hover{background-color:rgba(255,255,255,.075)}@media (max-width:575.98px){.table-responsive-sm{display:block;width:100%;overflow-x:auto;-webkit-overflow-scrolling:touch;-ms-overflow-style:-ms-autohiding-scrollbar}.table-responsive-sm>.table-bordered{border:0}}@media (max-width:767.98px){.table-responsive-md{display:block;width:100%;overflow-x:auto;-webkit-overflow-scrolling:touch;-ms-overflow-style:-ms-autohiding-scrollbar}.table-responsive-md>.table-bordered{border:0}}@media (max-width:991.98px){.table-responsive-lg{display:block;width:100%;overflow-x:auto;-webkit-overflow-scrolling:touch;-ms-overflow-style:-ms-autohiding-scrollbar}.table-responsive-lg>.table-bordered{border:0}}@media (max-width:1199.98px){.table-responsive-xl{display:block;width:100%;overflow-x:auto;-webkit-overflow-scrolling:touch;-ms-overflow-style:-ms-autohiding-scrollbar}.table-responsive-xl>.table-bordered{border:0}}.table-responsive{display:block;width:100%;overflow-x:auto;-webkit-overflow-scrolling:touch;-ms-overflow-style:-ms-autohiding-scrollbar}.table-responsive>.table-bordered{border:0}
        #main-page{

            text-align: center;
            position: absolute;
            width: 90%;
            left: auto;
            top: 50px;
            margin: auto auto;!important;
            z-index: -10;

        }

        #main-page thead{
            background-color:  #666666;
            border-bottom: 5px solid black;
            color:#b3ffff;
        }


        #board-table{

            opacity:0.90;
            text-align:center;
        }

        #board-table thead{
            background-color: rgba(178, 178, 178, 0.43);
            border-bottom: 5px solid black;
            color:#b3ffff;
        }
        #board-table thead tr{
            animation:table-head-animation 1s;

        }
        .board-table-row:hover{
            cursor:pointer;
        }
        #board-table-body{

        }
        @keyframes table-head-animation{
            from{opacity:0;}
            to{opacity:1;}
        }
        @keyframes table-row-animation{
            from{


                transform: scale(0.6);
            }
            to{
                opacity:1;

                transform: scale(1);
            }
        }


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
            <h2>Description</h2>
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
            <div class="modal-footer" onclick="sendRequestForJoin()">
                <h3>Send request</h3>
            </div>
        </form>
    </div>

</div>

<script>


    function showCreatESportModal(){
        var modal = document.getElementById('create-category-modal');

        // Get the button that opens the modal
        //var btn = document.getElementById("button-create-category");
        var modalBox=document.getElementsByClassName("modal-content")[0];
        var header=document.getElementsByClassName("modal-header")[0];
        var footer=document.getElementsByClassName("modal-footer")[0];
        var color=getDarkGradientColor();
        //console.log(color);
        //header.style.backgroundImage=color;
        //footer.style.backgroundImage=color;
        modalBox.style.boxShadow="0 0 10px 1px white";
        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal

        modal.style.display = "block";


        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        };

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        };
    }

    function showDescriptionModal(parent,viewType) {

    // Get the modal
        var modal = document.getElementById('show-description-modal');

        // Get the button that opens the modal
//        var btn = document.getElementById("button-create-category");
        var modalBox=document.getElementsByClassName("modal-content")[1];
        var modalBody=document.getElementsByClassName("modal-body")[1];
        var header=document.getElementsByClassName("modal-header")[1];
        var footer=document.getElementsByClassName("modal-footer")[1];
        var color=getDarkGradientColor();

        //header.style.backgroundImage=color;
        //footer.style.backgroundImage=color;
        modalBox.style.boxShadow="0 0 10px 1px white";
        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[1];

        // When the user clicks the button, open the modal

        modal.style.display = "block";



        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
            location.reload();
        };

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
                location.reload();
            }
        };


        var table=document.createElement("table");
        table.setAttribute("id","description-table");

        var boardID=null;
        if(viewType=="GRID") {


            boardID=parent.firstChild.childNodes[2].innerHTML;
            header.childNodes[3].innerHTML = parent.firstChild.childNodes[1].firstChild.innerHTML;
            //5-tennis
            var opt = parent.firstChild.childNodes[5].innerHTML;

            table.appendChild(createElement("tr", ""));
            table.appendChild(createElement("td", "Created by: "));
            table.appendChild(createElement("td", parent.firstChild.childNodes[31].innerHTML));

            table.appendChild(createElement("tr", ""));
            table.appendChild(createElement("td", "Date: "));
            table.appendChild(createElement("td", parent.firstChild.childNodes[17].innerHTML));

            table.appendChild(createElement("tr", ""));
            table.appendChild(createElement("td", "Game type: "));
            table.appendChild(createElement("td", opt));

            table.appendChild(createElement("tr", ""));
            table.appendChild(createElement("td", "Sport type: "));
            table.appendChild(createElement("td", parent.firstChild.childNodes[9].innerHTML));

            table.appendChild(createElement("tr", ""));
            table.appendChild(createElement("td", "Single/Team: "));
            table.appendChild(createElement("td", parent.firstChild.childNodes[13].innerHTML));

            table.appendChild(createElement("tr", ""));
            table.appendChild(createElement("td", "Current Users: "));
            table.appendChild(createElement("td", parent.firstChild.childNodes[21].innerHTML));//limit

            table.appendChild(createElement("tr", ""));
            table.appendChild(createElement("td", "Max Users: "));
            table.appendChild(createElement("td", parent.firstChild.childNodes[25].innerHTML));//limit

            table.appendChild(createElement("tr", ""));
            table.appendChild(createElement("td", "Description: "));
            table.appendChild(createElement("td", parent.firstChild.childNodes[32].innerHTML));//limit

        }
        else{
            boardID=parent.childNodes[0].innerHTML;
            table.appendChild(createElement("tr", ""));
            table.appendChild(createElement("td", "Created by: "));
            table.appendChild(createElement("td", parent.childNodes[1].innerHTML));

            table.appendChild(createElement("tr", ""));
            table.appendChild(createElement("td", "Date: "));
            table.appendChild(createElement("td", parent.childNodes[6].innerHTML));

            table.appendChild(createElement("tr", ""));
            table.appendChild(createElement("td", "Game type: "));
            table.appendChild(createElement("td", parent.childNodes[3].innerHTML));

            table.appendChild(createElement("tr", ""));
            table.appendChild(createElement("td", "Sport type: "));
            table.appendChild(createElement("td", parent.childNodes[4].innerHTML));

            table.appendChild(createElement("tr", ""));
            table.appendChild(createElement("td", "Single/Team: "));
            table.appendChild(createElement("td", parent.childNodes[5].innerHTML));

            table.appendChild(createElement("tr", ""));
            table.appendChild(createElement("td", "Current Users: "));
            table.appendChild(createElement("td", parent.childNodes[7].innerHTML));

            table.appendChild(createElement("tr", ""));
            table.appendChild(createElement("td", "Max Users: "));
            table.appendChild(createElement("td", parent.childNodes[8].innerHTML));

            table.appendChild(createElement("tr", ""));
            table.appendChild(createElement("td", "Description: "));
            table.appendChild(createElement("td", parent.childNodes[10].innerHTML));//limit


        }

        //footer.style.backgroundColor="lightblue";
        while(modalBody.hasChildNodes()){
            modalBody.removeChild(modalBody.lastChild);
        }
        modalBody.appendChild(table);

        $.post('postController.php', {
            view: "yes",
            boardID: boardID

        }, function(response) {
            //alert(response);
            if(response==1){
                //alert("View++");
            }
            else
                alert("Error on connecting database");
        });


    }
    function sendRequestForJoin(){
        alert("request ok");
    }


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




<script>


    var main=document.getElementById("main-page");
    var leftBar=document.getElementById("left-menu-bar");
    var rightBar=document.getElementById("right-menu-bar");
    //var gradientColors=["#0f2027","#203a43","#2c5364","#c31432", "#240b36","#654ea3","#eaafc8","#ad5389", "#3c1053","#333333","#3e5151", "#decba4"];

    var option;
    var categoryName;
    var categoryType;
    leftBar.onmouseover=expandLeftBar;
    leftBar.onmouseout=reduceLeftBar;
    rightBar.onmouseover=expandRightBar;
    rightBar.onmouseout=reduceRightBar;

   /* for(var i=0;i<leftLi.length;i++){
        leftLi[i].onmouseover=expandLeftBar;
        leftLi[i].onmouseout=reduceLeftBar;
        rightLi[i].onmouseover=expandRightBar;
        rightLi[i].onmouseout=reduceRightBar;
    }*/

    function expandLeftBar() {
        /*for(var i=0;i<leftBtn.length;i++){
            //leftBtn[i].style.display="inline";
        }*/
        leftBar.style.width="250px";

    }
    function reduceLeftBar(){
        /*for(var i=0;i<leftBtn.length;i++){
            //leftBtn[i].style.display="none";
        }*/
        leftBar.style.width="80px";
    }
    function expandRightBar() {
        rightBar.style.width="300px";
    }
    function reduceRightBar(){
        rightBar.style.width="80px";
    }
    function getBackgroundImage(sportType,gameType){
        var image;
        switch(gameType){
            case "ALL": {
                if(sportType=="SPORT")image="url('resources/wall_sport.jpg')";
                else if(sportType=="ESPORT") image="url('resources/wall_esport3.jpg')";
                else image="url('resources/wall_all.jpg')";
            }break;
            case "SOCCER": image="url('resources/wall_soccer.jpg')"; break;
            case "BASEBALL": image="url('resources/wall_baseball.jpg')"; break;
            case "PINGPONG": image="url('resources/wall_pingpong2.jpg')"; break;
            case "BASKETBALL": image="url('resources/wall_basketball.jpg')"; break;

            case "TENNIS": image="url('resources/wall_tennis2.jpg')"; break;
            case "BATTLEGROUND": image="url('resources/wall_battleground.jpg')"; break;
            case "OVERWATCH": image="url('resources/wall_overwatch.jpg')"; break;
            case "LOL": image="url('resources/wall_lol3.jpg')"; break;
            case "ROCKET": image="url('resources/wall_rocket.jpg')"; break;

            default:     image= getDarkGradientColor();
                break;
        }
        console.log(image);
        return image;
    }
    var viewType=sessionStorage.getItem("viewType");
    var viewNode=document.getElementById("view");
    if(viewType==""){
        viewNode.style.background="url('resources/view_grid_white.png') no-repeat center center / cover";
        sessionStorage.setItem("viewType","GRID");
        viewType="GRID";
    }
    else  if(viewType=="GRID"){
        viewNode.style.background="url('resources/view_grid_white.png') no-repeat center center / cover";
    }
    else{
        viewNode.style.background="url('resources/view_list_white.png') no-repeat center center / cover";
    }
    /* if(viewInit.style.backgroundImage==''){
       viewInit.style.background="url('resources/view_grid_white.png') no-repeat center center / cover";
   }*/
    function changeView(node){

        if(viewType=="GRID"){
            //node.style.background="url('resources/view_list_white.png') no-repeat center center / cover";
            sessionStorage.setItem("viewType","LIST");
            location.replace("matching.php?option=" + option + "&ctype=" + categoryType + "&cname=" + categoryName+"&view=LIST");
        }
        else{
            //node.style.background="url('resources/view_grid_white.png') no-repeat center center / cover";
            sessionStorage.setItem("viewType","GRID");
            location.replace("matching.php?option=" + option + "&ctype=" + categoryType + "&cname=" + categoryName+"&view=GRID");
        }
    }
    function init(opt,ctype,cname) {
        //alert(option+"\n"+Sport+"\n"+ESport);
        option = opt;
        categoryType=ctype;
        categoryName=cname;
        document.body.style.background= getBackgroundImage(categoryType,categoryName);
        document.body.style.backgroundSize="cover";

        //document.body.style.background= getDarkGradientColor();
        //document.body.style.background= "linear-gradient(to right, #0f0c29, #302b63, #24243e)";
        var dataBox=document.getElementsByClassName("cat-box");
        //var type=dataBox[0].firstChild.childNodes[4].innerHTML;
        for(var i=0;i<dataBox.length;i++){
            dataBox[i].firstChild.style.background=getDarkGradientColor();

        }

        var middleLi = document.getElementsByClassName("btn-options");
        var leftLi=document.getElementsByClassName("left-logo");
        var rightLi=document.getElementsByClassName("right-logo");

        for (var i = 0; i < middleLi.length; i++) {
            var id = middleLi[i].getAttribute("id");

            if (id == option) {
                middleLi[i].style.backgroundColor = "#fff";
                middleLi[i].style.color = "#1b1b1b";
                break;
            }
        }

        if(categoryType=="SPORT") {
            for (var i = 0; i < leftLi.length; i++) {
                var parent = leftLi[i].parentNode;
                var id = parent.getAttribute("id");

                if (id == categoryName) {
                    leftLi[i].style.transform = "scale(1.3)";
                    //leftLi[i].style.border="1px solid #eee32d";
                    leftLi[i].style.borderRadius = "50px";
                    leftLi[i].style.boxShadow = "0 0 3px 3px #eee32d";

                    //parent.parentNode.style.position="absolute";
                   /* parent.parentNode.style.width="80px";
                    parent.parentNode.style.height="50px";
                    parent.parentNode.style.marginLeft="-30px";
                    parent.parentNode.style.marginTop="-10px";
                    parent.parentNode.style.backgroundColor="white";*/

                    break;
                }

            }
        }
        else if(categoryType=="ESPORT") {
            for (var i = 0; i < rightLi.length; i++) {
                var parent = rightLi[i].parentNode;
                var id = parent.getAttribute("id");
                //console.log(id);
                if (id == categoryName) {
                    rightLi[i].style.transform = "scale(1.3)";
                    //rightLi[i].style.border="1px solid #eee32d";
                    rightLi[i].style.borderRadius = "50px";
                    rightLi[i].style.boxShadow = "0 0 3px 3px #eee32d";
                    break;
                }

            }
        }
        else if(categoryType=="ALL"){
            for (var i = 0; i < leftLi.length; i++) {
                var parent = leftLi[i].parentNode;
                var id = parent.getAttribute("id");

                if (id == categoryName) {
                    leftLi[i].style.transform = "scale(1.3)";
                    //leftLi[i].style.border="1px solid #eee32d";
                    leftLi[i].style.borderRadius = "50px";
                    leftLi[i].style.boxShadow = "0 0 3px 3px #eee32d";

                    //parent.parentNode.style.position="absolute";
                    /* parent.parentNode.style.width="80px";
                     parent.parentNode.style.height="50px";
                     parent.parentNode.style.marginLeft="-30px";
                     parent.parentNode.style.marginTop="-10px";
                     parent.parentNode.style.backgroundColor="white";*/

                    break;
                }

            }
            for (var i = 0; i < rightLi.length; i++) {
                var parent = rightLi[i].parentNode;
                var id = parent.getAttribute("id");
                //console.log(id);
                if (id == categoryName) {
                    rightLi[i].style.transform = "scale(1.3)";
                    //rightLi[i].style.border="1px solid #eee32d";
                    rightLi[i].style.borderRadius = "50px";
                    rightLi[i].style.boxShadow = "0 0 3px 3px #eee32d";
                    break;
                }

            }

        }
    }

    function sendOptionRequestParameter(node) {

        option=node.getAttribute("id");

        location.replace("matching.php?option="+option+"&ctype="+categoryType+"&cname="+categoryName+"&view="+viewType+"");
    }
    function sendSportRequestParameter(node) {
        if (sessionStorage.getItem("slbl")) {
            categoryName = node.getAttribute("id");

            if (categoryName == "ALL") {

                if (sessionStorage.getItem("ESPORT") != null) {
                    if (categoryType == "ALL") {
                        categoryType = "SPORT";
                        sessionStorage.removeItem("SPORT");
                    }
                    else {
                        categoryType = "ALL";
                        sessionStorage.setItem("SPORT", "ON");
                    }

                }
                else {
                    categoryType = "SPORT";
                    sessionStorage.setItem("SPORT", "ON");
                }
            }
            else {
                categoryType = "SPORT";
                sessionStorage.removeItem("SPORT");
                sessionStorage.removeItem("ESPORT");
            }
            sessionStorage.removeItem("slbl");
            location.replace("matching.php?option=" + option + "&ctype=" + categoryType + "&cname=" + categoryName+"&view="+viewType+"");
        }
        else
            sessionStorage.setItem("slbl", "1");
    }
    function sendESportRequestParameter(node) {
        if (sessionStorage.getItem("elbl")) {

            categoryName = node.getAttribute("id");
            if (categoryName == "ALL") {
                if (sessionStorage.getItem("SPORT") != null) {
                    if (categoryType == "ALL") {
                        categoryType = "ESPORT";
                        sessionStorage.removeItem("ESPORT");
                    }
                    else {
                        categoryType = "ALL";
                        sessionStorage.setItem("ESPORT", "ON");
                    }

                }
                else {
                    categoryType = "ESPORT";
                    sessionStorage.setItem("ESPORT", "ON");
                }
            }
            else {
                categoryType = "ESPORT";
                sessionStorage.removeItem("ESPORT");
                sessionStorage.removeItem("SPORT");
            }
            sessionStorage.removeItem("elbl");
            location.replace("matching.php?option=" + option + "&ctype=" + categoryType + "&cname=" + categoryName+"&view="+viewType+"");
        }
        else{
            sessionStorage.setItem("elbl", "1");
        }

    }

    function printObjects(cname,ctype,cdate,uName,climit,uCount,vCount) {

    }
</script>
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