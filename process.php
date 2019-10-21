<?php
$conn=mysqli_connect("localhost","root","","crud_vue");
if($conn->connect_error){
    die("Connection failed".$conn->connect_error);
}

// 用来输出，数据传递给前端
$result=array('error'=>false);
// 判断类型
$action = '';
if(isset($_GET['action'])){
    $action=$_GET['action'];
}
// 获取数据
if($action == 'read'){
    $sql=$conn->query("SELECT * FROM user");
    $users=array();
    while($row = $sql->fetch_assoc()){
        array_push($users,$row);
    }
    $result['users']=$users;
}
// 添加
if($action == 'create'){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $sql=$conn->query("INSERT INTO user(name,email,phone) VALUES('$name','$email','$phone') ");
    if($sql){
        $result['message']="user added succesfully!";
    }else{
        $result['error']=true;
        $result['message']="faild to add user!";
    }
   
}

// 更新
if($action == 'update'){
    $id=$_POST['id'];
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $sql=$conn->query("UPDATE user SET name ='$name',email='$email',phone='$phone' WHERE id='$id' ");
    if($sql){
        $result['message']="user updated succesfully!";
    }else{
        $result['error']=true;
        $result['message']="faild to update user!";
    }
   
}

// 删除
if($action == 'delete'){
    $id=$_POST['id'];

    $sql=$conn->query("DELETE FROM user  WHERE id ='$id' ");
    if($sql){
        $result['message']="user delete succesfully!";
    }else{
        $result['error']=true;
        $result['message']="faild to delete user!";
    }
   
}

$conn->close();
echo json_encode($result);



?>