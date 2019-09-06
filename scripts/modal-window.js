
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
    var currentUsers=null;
    var maxUsers=null;
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
        currentUsers= parent.firstChild.childNodes[21].innerHTML;

        table.appendChild(createElement("tr", ""));
        table.appendChild(createElement("td", "Max Users: "));
        table.appendChild(createElement("td", parent.firstChild.childNodes[25].innerHTML));//limit
        maxUsers=parent.firstChild.childNodes[25].innerHTML;

        table.appendChild(createElement("tr", ""));
        table.appendChild(createElement("td", "Description: "));
        table.appendChild(createElement("td", parent.firstChild.childNodes[32].innerHTML));//limit

    }
    else{
        boardID=parent.childNodes[0].innerHTML;
        header.childNodes[3].innerHTML = parent.childNodes[2].innerHTML;
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
        currentUsers=parent.childNodes[7].innerHTML;

        table.appendChild(createElement("tr", ""));
        table.appendChild(createElement("td", "Max Users: "));
        table.appendChild(createElement("td", parent.childNodes[8].innerHTML));
        maxUsers=parent.childNodes[8].innerHTML;

        table.appendChild(createElement("tr", ""));
        table.appendChild(createElement("td", "Description: "));
        table.appendChild(createElement("td", parent.childNodes[10].innerHTML));//limit

    }
    var footerNode=document.createElement("div");
    var title=document.createElement("h2");
    title.innerHTML="Send Request";
    title.style.color="#B3FFFF";
    footerNode.addEventListener("click", function () {

        //check for user limit
        if(parseInt(currentUsers)>=parseInt(maxUsers)){
            alert("Sorry, this group is already full");
            return;
        }

        $.post('postController.php', {
            request: "yes",
            boardID: boardID

        }, function(response) {
            //alert(response);
            if(response==1){
                alert("Request has been successfully sent");
                location.reload();
            }
            else
                alert("Error on connecting database");
        });
    });
    footerNode.appendChild(title);
    footer.appendChild(footerNode);
    function sendRequestForJoin(){
        alert("request ok");
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
