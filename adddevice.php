<!-- 定义变量用来接收前端传来的数据 -->
<!-- 创建一个连接 -->
<!-- 选择数据库 -->
<!-- 设置编码，防止中文乱码 -->
<!-- php定义一个插入操作 -->
<!-- 预处理 -->
<!-- 绑定参数和值 -->
<!-- 执行 -->

<?php
// require  "./conn.php";
$data = [];
$data['code'] = isset($_GET['code'])? $_GET['code']:'';
$data['name'] = isset($_GET['name'])? $_GET['name']:'';
$data['model'] = isset($_GET['model']) ? $_GET['model'] :'';
$data['fac_num'] = isset($_GET['fac_num']) ? $_GET['fac_num'] : '';
$data['position'] = isset($_GET['position']) ? $_GET['position'] : '';
$data['owner'] = isset($_GET['owner']) ? $_GET['owner'] : '';
$data['country'] = isset($_GET['country']) ? $_GET['country'] : '';
$data['factory'] = isset($_GET['factory']) ? $_GET['factory'] : '';

$servername = "localhost";
$username = "root";
$password = "root";
try {
    $pdo = new PDO("mysql:host=$servername;", $username, $password);
    echo "连接成功"; 
}
catch(PDOException $e)
{
    echo $e->getMessage();
}
//var_dump($data);
if(isset($data)){
try{
        //错误写法
        //$query = "insert into device_info(code,name,model,fac_num,position,owner,country,factory) values(code=:code,name=:name,model=:model,fac_num=:fac_num,position=:position,owner=:owner,country=:country,factory=:factory) ";
        $query = "insert into device_info(code,name,model,fac_num,position,owner,country,factory,) values(:code,:name,:model,:fac_num,:position,:owner,:country,:factory)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':code',$data['code']);
        $stmt->bindParam(':name',$data['name']);
        $stmt->bindParam(':model',$data['model']);
        $stmt->bindParam(':fac_num',$data['fac_num']);
        $stmt->bindParam(':position',$data['position']);
        $stmt->bindParam(':owner',$data['owner']);
        $stmt->bindParam(':country',$data['country']);
        $stmt->bindParam(':factory',$data['factory']);
        $stmt->execute();
        $insert_id = $pdo->lastInsertId();

        if(isset($insert_id)){

                echo json_encode(array('status'=>1,'msg'=>'success'));

        }
} catch (PDOException $e) {
        echo $e->getMessage();
}

}
?>

