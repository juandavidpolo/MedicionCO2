<?php
include_once 'App/Conexion.inc.php';
include_once 'App/UsersOperations.inc.php';
include_once 'Apertura.inc.php';
if(isset($_POST['cancel'])){
    header('Location: index.php');
    return;
}
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password1 = $_POST['password1'];
    if (strlen($name)<1 || strlen($lastname)<1 || strlen($email)<1 || strlen($password)<1 || strlen($password1)<1){
        $_SESSION['ErrorRegister']='Todos los campos son necesarios';
        header ('Location: Registro.php');
        return;
    }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $_SESSION['ErrorEmail']='Formato de email invalido';
        header ('Location: Registro.php');
        return;
    }elseif (strlen($password)<6){
        $_SESSION['ErrorPassword']='La contraseña es muy corta';
        header ('Location: Registro.php');
        return;
    }elseif ($password !== $password1) {
        $_SESSION['ErrorPassword']='Las contraseñas deben coincidir';
        header ('Location: Registro.php');
        return;
    }else{
        $stmt = $pdo->prepare("SELECT email FROM usuarios WHERE email=:email");
        $stmt->execute(array( ":email" => $email));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row['email'] == $email){
            $_SESSION['ErrorRegister']='El email ya se encuentra registrado. Si '
                    . 'deseas recuperar tu contraseña da clic '
                    . '<a class="linked" href="Recuperacion.php">aquí</a>';
            header ('Location: Registro.php');
            return;
        }else{
            $fullName = $name.' '.$lastname;
            $passwordCryp = hash('md5', $email.$password);
            $stmt = $pdo->prepare('INSERT INTO usuarios(name, email, password) '
                    . 'VALUES(:name, :email, :password)');
            $stmt->execute([
                ':name' => $fullName,
                ':email' => $email,
                ':password' => $passwordCryp
            ]);
            $_SESSION['added']=$email;
            header ('Location: Scripts/activacionURL.inc.php');
            return;
        }
    }
}
?>
<div class="main">
    <div class="gap"></div>
    <div class="user">
        <form class="panel-data" method="POST" autocomplete="off">
            <h2>Registrate</h2>
            <?php flashMessages(); ?>
            <p class="input-data"><label for="name">Nombres:</label>
                <input class="text-input" type="text" name="name" placeholder="Nombres"></p>
            <p class="input-data"><label for="lastname">Apellidos:</label>
                <input class="text-input" type="text" name="lastname" placeholder="Apellidos"></p>
            <p class="input-data"><label for="email">Email:</label>
                <input class="text-input" type="text" name="email" placeholder="Correo electrónico"></p>
            <p class="input-data"><label for="password">Contraseña:</label>
                <input class="text-input" type="password" name="password" placeholder="Contraseña"></p>
            <p class="input-data"><label for="password1">Confirmar contraseña:</label>
                <input class="text-input" type="password" name="password1" placeholder="Confirmar contraseña"></p>
            <button type="submit" name="submit">Regístrar</button>
            <button type="submit" name="cancel">Cancelar</button>
        </form>
    </div>
    <div class="gap"></div>
</div>
<?php
include_once 'Cierre.inc.php';