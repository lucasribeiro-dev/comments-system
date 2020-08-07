<?php
    // Conect with DB
    try { 
        $pdo = new PDO("mysql:dbname=sistema_de_comments;host=localhost", "root", "");
    } catch(PDOException $e){
        echo "ERRO: ".$e->getMessage();
        exit;
    }
    // Send datas to DB
    if(isset($_POST['name']) && empty($_POST['name']) == false){
        $name = $_POST['name'];
        $message= $_POST['message'];

        $sql = $pdo->prepare("INSERT INTO mensagens SET 
        nome = :nome, 
        msg= :msg, 
        data_msg = NOW()");

        $sql->bindValue(":nome", $name);
        $sql->bindValue(":msg", $message);
        $sql->execute();
    }
    ?>
<?php
// Get datas in db and show in screen
$sql = "SELECT * FROM mensagens ORDER BY data_msg DESC";
$sql = $pdo->query($sql);

if($sql->rowCount() > 0){
	foreach($sql->fetchAll() as $message):
	?>
	<strong><?php echo $message['nome']; ?></strong><br/>
	<?php echo $message['msg']; ?>
	<hr/>
    <?php
    endforeach;
} else{
    echo "There are no messages.";
}
?>
<html>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css"/>
    <script type="text/javascript" src="assets/js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.bundle.min.js"></script>

    <fildeset>
        <form method="POST">
       <strong> Name:<br/></strong>
        <input class="form-control "  type="text" name="name" placeholder="John"/><br/>

        <strong>Message:<br/></strong>
        <textarea class="form-control form-control-md"  name="message" placeholder="What are you thinking?"></textarea><br/>

        <input class="btn btn-primary" type="submit" value="Send message" />
        </form>

    </fildset>
</html>