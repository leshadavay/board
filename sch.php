<?php
session_start();
error_reporting();
if (!isset($_SESSION['userinfo'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
$userid=$_SESSION['userinfo'][0];
$username=$_SESSION['userinfo'][1];

$to=$_GET['to'];
$create_group=$_GET['create_group_chat_room'];
$connect_group=$_GET['connect_group'];


$_SESSION['to']=$to;
$_SESSION['create_group']=$create_group;
$_SESSION['connect_group']=$connect_group;
$_SESSION['group_name']=$_GET['group_name'];

if(isset($_GET['create_group_chat_room'])){

    $groupname=$_GET['create_group_chat_room'];

    $db = mysqli_connect('localhost', 'root', '', 'sechat');
    $isDuplicate=mysqli_query($db,"select * from group_table where group_name='$groupname'");

    if($isDuplicate->num_rows) {
        echo '<script> alert("'.$groupname.'  is already exists!")</script>';
    }
    else{
        $insert = mysqli_query($db, "insert into group_table (group_name,user_id) values('$groupname','$userid')");

    }
    echo '<script type="text/javascript">
				location.replace("start.php?connect_group='.$groupname.'");
			  </script>';

}
if(isset($_GET['add_user'])){
    $db=mysqli_connect("localhost","root","","sechat");

    $groupname=$_GET['group_name'];
    $add_user_name=$_GET['add_user'];

    $getID=mysqli_query($db,"select userID from users where username='$add_user_name' LIMIT 1");
    $t=$getID->fetch_object();
    $add_user_id=$t->userID;

    $check=mysqli_query($db,"select * from group_table where group_name='$groupname' and user_id='$add_user_id'");
    if($check->num_rows){
        echo '<script> alert("User \"'.$add_user_name.'\" is already exists in this group") </script>';

    }
    else{
        $res=mysqli_query($db,"insert into group_table (group_name,user_id) values ('$groupname','$add_user_id')");
        echo '<script> alert("User \"'.$add_user_name.'\" successfully added") </script>';

    }
    echo '<script type="text/javascript">
				location.replace("start.php?connect_group='.$groupname.'");
			  </script>';

}

?>
<!DOCTYPE html>
<html>
<head>


    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="bootstrap.css">
    <link rel="stylesheet" type="text/css" href="mystyle.css">


    <script src="jquery.min.js"></script>
    <script type="text/javascript">
        function post_msg()
        {

            var msg = document.getElementById("msg").value;
            var username = decodeURIComponent("<?php echo rawurlencode($username); ?>"); //php var to javascript var
            var userid=decodeURIComponent("<?php echo rawurlencode($userid);?>");
            var receiver=decodeURIComponent("<?php echo rawurlencode($to);?>");
            if(msg && username)
            {

                $.ajax
                ({
                    type: 'POST',
                    url: 'save_msg.php',
                    data:
                        {
                            getmessage:msg,
                            getusername:username,
                            getreceiver:receiver,
                            getuserid:userid

                        },
                    success: function (response)
                    {
                        //displayFromDatabase();
                        <?php $_SESSION['msg_sent']=true; ?>
                        document.getElementById("all_messages").innerHTML=response+document.getElementById("all_messages").innerHTML;
                        document.getElementById("msg").value="";
                        document.getElementById("username").value="";
                        document.getElementById("receiver").value="";
                    },
                    error: function(err) {
                        alert(err);
                    }
                });
            }

            return false;
        }
        /*
        function displayFromDatabase() {
            alert("start 2");
            $.ajax({
                url:"save_msg.php",
                type:"POST",
                async:false,
                data:{
                    display:1
                },
                success: function (d) {
                    alert("response 2");
                    document.getElementById("test").innerHTML=d+document.getElementById("test").innerHTML;
                }
            });

        }
        */
    </script>
</head>
<body onload="resizeVideoPage();">
<script>
    function resizeVideoPage(){
        var width = 400;
        var height = 800;
        window.resizeTo(width, height);
        window.moveTo(((screen.width - width) / 2), ((screen.height - height) / 2));
    }
</script>

<div align="center" id="account-div">
    <table id="account-table">

        <tr>
            <td class="acc-td" align="center">
                <div class="text-center">
                    <?php if(isset($_SESSION['userinfo'][1])){
                        echo "<h3 class='h3'>".$_SESSION['userinfo'][1]."</h3>" ;
                    } ?>
                </div>
            </td>
            <td class="acc-td" align="center">
                <a href="#"> <div id="profile_av"><img id="profile_av_img" src="resources/profile.png" </div></a>
            </td>
            <td class="acc-td" align="center">
                <div class="content">
                    <form method="get">
                        <!-- logged in user information -->
                        <?php  if (isset($_SESSION['userinfo'][1])) : ?>

                            <!-- <button name="logout" type="submit">Logout</button> -->
                            <h3 class="h3"><a href="server.php?logout='1'" style="color: red; font-size: 20px;">logout</a></h3>
                        <?php endif ?>
                    </form>
                </div>
            </td>
        </tr>
    </table>
</div>


<!-- main table-->
<div id="main">
    <!-- left -->
    <div id="left">
        <div align="center" >

            <!-- 1 table -->
            <div id="first-table-div">
                <div id="fetch_friends"></div>

                <script type="text/javascript">
                    $(document).ready(function(){
                        setInterval(function(){
                            $('#fetch_friends').load('friend_list.php')
                        },5000);
                    });
                </script>
            </div>
        </div>
    </div>
    <!-- 2 table -->

    <div id="middle">

        <div id="all_messages" style="border: 1px solid black;">
            <script>
                $('#all_messages').scrollTop($('#all_messages')[0].scrollHeight);
            </script>
        </div>

        <script type="text/javascript">
            $(document).ready(function(){
                setInterval(function(){
                    $('#all_messages').load('fetch_messages.php')
                },4000);
            });
        </script>

        <div align="center" id="send_msg_div">
            <form method="POST" action="" onsubmit="return post_msg();">
                <textarea  id="msg" maxlength="50" placeholder="Type message .."></textarea>
                <script>
                    $("#msg").keypress(function (e) {
                        if(e.which == 13 && !e.ctrlKey) {
                            $(this).closest("form").submit();
                            e.preventDefault();
                            return false;
                        }
                    });
                </script>
                <input type="submit"  value="send" id="submit">


            </form>
            <a href="start.php" style="color:darkred; "><button class="btn btn-group-justified" style="width:30%;display: inline;" >Main</button></a>
            <button onclick="setGroupName()" class="btn btn-group-justified" style="width:30%;display: inline;"">Make group chat</button>
            <?php
            if(isset($_SESSION['connect_group']) ) {
                $groupname=$_SESSION['connect_group'];

                echo '  <a href="schedule.php?group_name='.$groupname.'" target="_blank" style="color:darkred; "><button class="btn btn-group-justified" style="width:30%;display: inline;" >Schedule</button></a>';


            }
            ?>
            <script type="text/javascript">
                function setGroupName() {
                    var groupName=prompt("Enter group name:");
                    var userName = decodeURIComponent("<?php echo rawurlencode($username); ?>"); //php var to javascript var
                    if(groupName!=null){
                        //sending GET
                        groupName=groupName.toLowerCase();

                        window.location.href="start.php?register="+userName+"&create_group_chat_room="+groupName;
                        /*
                                                        var mysql = require('mysql');

                                                        var con = mysql.createConnection({
                                                            host: "localhost",
                                                            user: "root",
                                                            password: "",
                                                            database: "sechat"
                                                        });

                                                        con.connect(function(err) {
                                                            if (err) throw err;
                                                            //Select only "name" and "address" from "customers":
                                                            con.query("SELECT * FROM group_chat where group_name in ('groupName') ", function (err, result, fields) {
                                                                if (err) throw err;
                                                                console.log(result);
                                                            });
                                                        });
                        */

                    }

                }
            </script>
        </div>

    </div>




    <!-- 3 table -->
    <div id="right">
        <div id="third-table-div">
            <div id="fetch_users"></div>

            <script type="text/javascript">
                $(document).ready(function(){
                    setInterval(function(){
                        $('#fetch_users').load('fetch_users.php')
                    },1000);
                });
            </script>


        </div>
        <?php print "Selected user: <b> ".$_SESSION['to']." </b>"; ?>
    </div>

</div>
</div>
<div id="test">

</div>

</body>
</html>