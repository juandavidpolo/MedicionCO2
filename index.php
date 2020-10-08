<?php
include_once 'App/Conexion.inc.php';
include_once 'App/UsersOperations.inc.php';
include_once 'Apertura.inc.php';

if (isset($_SESSION['name'])){
    header ('Location: Sesion.php');
    return;
}

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (strlen($email)<1 || strlen($password)<1){
        $_SESSION['ErrorLogin']='Todos los campos son necesarios';
        header ('Location: index.php');
        return;
    }else{
        $stmt = $pdo->prepare("SELECT * FROM usuarios RIGHT JOIN cuentausuario "
                . "ON usuarios.id_usuario = cuentausuario.id_usuario WHERE "
                . "usuarios.email = :email");
        $stmt->execute([":email" => $email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row['email'] ==FALSE){
            $_SESSION['ErrorLogin']='El correo electronico y la contraseña '
                    . 'no coinciden';
                header ('Location: index.php');
                return;
        }elseif ($row['estado'] > 0){
            if (hash('md5', $email.$password) === $row['password']){
            $_SESSION['id_usuario']=$row['id_usuario'];
            $_SESSION['name']=$row['name'];
            $_SESSION['email']=$row['email'];
            header ('Location: Sesion.php');
            return;
            }else{
                $_SESSION['ErrorLogin']='El correo electronico y la contraseña '
                    . 'no coinciden';
                header ('Location: index.php');
                return;
            }
        }else{
            $_SESSION['ErrorLogin']='La cuenta a la que intenta acceder está '
                    . 'desactivada. Activela <a class="linked" href="Recuperacion.php">aqui</a>';
                header ('Location: index.php');
                return;
        }
    }
}
?>
        <div class="main">
            <div class="gap"></div>
            <div class="user">
                <form class="panel-data" method="POST" action="" autocomplete="off">
                    <h2>Iniciar sesión</h2>
                    <?php flashMessages();?>
                    <p class="input-data"><label for="email">Email:</label>
                        <input class="text-input" type="text" name="email" placeholder="Correo electrónico"></p>
                    <p class="input-data"><label for="Password">Constraseña:</label>
                        <input class="text-input" type="password" name="password" placeholder="Contraseña"></p>
                    <button type="submit" name="login">Iniciar sesión</button>
                    <hr>
                    <a class="link" href="Registro.php">Regístrate</a> 
                    <a class="link" href="Recuperacion.php">¿Olvidaste tu contraseña?</a> 
            </form> 
            </div>
            <div class="gap"></div>
        </div>
<?php
include_once 'Cierre.inc.php';