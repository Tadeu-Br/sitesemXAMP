<?php
require_once("bootstrap.php")
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Registrar PHP</title>
    </head>
<body>
    <h2>Login</h2>
    <form action="" method="post">
        Nome Completo
        <input name="nome" type="text" placeholder="Ex: André Silva" required><br>
        E-mail
        <input name="email" type="email" placeholder="E-mail (o mesmo da compra)" required><br>
        Senha
        <input name="senha1" type="password" placeholder="6 ou mais digitos" autocomplete="off" required><br>
        Repita a senha
        <input name="senha2" type="password" placeholder="Confirme sua senha" autocomplete="off" required><br>

        <input type="checkbox" required="" name="termos">Eu li e aceito os Termos de Serviço<br>
    
<button type="submit" class="btn btn-block mt-lg, btn-default"><b>Cadastrar</b></button>

</form>
</body>
</html>
<?php
if($_POST){
date_default_timezone_set('Brazil/East');

$nome = $_POST['nome'];
$nome=htmlspecialchars($nome,ENT_QUOTES);

$email = $_POST['email'];
$email=htmlspecialchars($email,ENT_QUOTES);

#$cpf = 
#$cpf=htmlspecialchars($cpf,ENT_QUOTES);
#$numero=htmlspecialchars($numero,ENT_QUOTES);

$termos = $_POST['termos'];
$termos=htmlspecialchars($termos,ENT_QUOTES);

#para ter segurança
$senha1 = $_POST['senha1'];
$senha1=htmlspecialchars($senha1,ENT_QUOTES);

$senha2 = $_POST['senha2'];
$senha2=htmlspecialchars($senha2,ENT_QUOTES);

$senhacrip = hash('sha384' , $senha2);
$data = date("Y-m-d H:i:s");

$ip = $_SERVER['REMOTE_ADDR'];

    if (empty($email)){
        echo "<script>window.alert('Digite o Email!');</script>";
        echo"<meta http-equiv='refresh' content='0;register'>";
        return false;
    }
    $veric = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    $verifc = mysqli_num_rows($veric);

    if ($verifc == true) {
        echo "<script> window.alert('Você já cadastrou!');</script>";
        echo "<meta http-equiv='refresh' content='0;'>";
        return false; 
    }

$veric2 = mysqli_query($conn, "SELECT * FROM users WHERE cpf='$cpf'");
$veric2 = mysqli_num_rows($veric2);

if ($veric2 == true) {
    echo "<script>window.alert('Você já cadastrou!!');</script>";
    echo "<meta http-equiv='refresh' content='0;index'>";
    return false;

    if (empty($termos)){
        echo "<script>window.alert('Concorde com os termos!');</script>";
        echo "<meta http-equiv='refresh' content='0;'";
        return false;
    }
if (empty($senha1)){
    echo "<script>window.alert('Digite uma Senha!');window.history.go(-1);</script>";
return false;
}
if (empty($senha2)){
    echo "<script>window.alert('Confirme Sua Senha!');window.history.go(-1);</script>";
    return false;
}
if (strlen($senha1) < 6){
    echo "<script>window.alert('Sua Senha deve conter no minimo 6 digitos!');window.history.go(-1);</script>";
    return false;
}

if ($senha1 != $senha2) {
    echo "<script>window.alert('Senhas Diferentes!');</script>";
    echo "<meta http-equiv='refresh' content='0;'>";
    return false;
}

$senhacrip = hash('sha256', $senha2);

$data = date("Y-m-d H:i:s");

$ip = $_SERVER['REMOTE_ADDR'];

    echo "<meta http-equiv='refresh' content='0;registrar.php?q=true'>";
$sql1=mysqli_query($conn,"INSERT INTO users (nome, email, senha, ip, data) VALUES ('$nome', '$email', '$senhacrip', '$ip', '$data')");
}
}
?>
</body>
</html>