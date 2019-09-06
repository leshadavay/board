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