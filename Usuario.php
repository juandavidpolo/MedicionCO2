<?php
include_once 'App/Conexion.inc.php';
include_once 'App/UsersOperations.inc.php';
include_once 'Apertura.inc.php';
if(!isset($_SESSION['name'])){
    header ('Location: index.php');
    return;
}
if(isset($_POST['cancel'])){
    header ('Location: Usuario.php');
    return;
}elseif(isset ($_POST['name'])){
    $stmt = $pdo->prepare("UPDATE usuarios SET name=:name WHERE"
            . " usuarios.id_usuario=".$_SESSION['id_usuario']);
    $stmt->execute([":name" => $_POST['name']]);
    $_SESSION['Edited']='Cambios guardados correctamente';
    $stmt = $pdo->query('SELECT * FROM usuarios WHERE id_usuario="'.$_SESSION['id_usuario'].'"');
    $stmt->execute(array());
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $_SESSION['id_usuario']=htmlentities($row['id_usuario']);
    $_SESSION['name']=htmlentities($row['name']);
    header("Location: Usuario.php");
    return;
}elseif(isset ($_POST['editEmail'])){
    if(strlen($_POST['email'])<1){
        $_SESSION['Edited']='Todos los campos son necesarios';
        header("Location: Usuario.php?editEmail=".$_SESSION['mail']);
        return;
    }elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $_SESSION['ErrorEmail']='Formato de email invalido';
        header ("Location: Usuario.php?editEmail=".$_SESSION['mail']);
        return;
    }else{
        $stmt = $pdo->prepare("UPDATE usuarios SET email=:email WHERE"
            . " usuarios.id_usuario=".$_SESSION['id_usuario']);
        $stmt->execute([":email" => $_POST['email']]);
        $_SESSION['Edited']='Cambios guardados correctamente';
        $stmt = $pdo->query('SELECT * FROM usuarios WHERE id_usuario="'.$_SESSION['id_usuario'].'"');
        $stmt->execute(array());
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['id_usuario']=htmlentities($row['id_usuario']);
        $_SESSION['email']=htmlentities($row['email']);
        header("Location: Usuario.php");
        return;
    }
}elseif(isset ($_POST['editPass'])){
    if(strlen($_POST['password'])<1 || strlen($_POST['newPass'])<1 || strlen($_POST['newPass1'])<1){
        $_SESSION['Edited']='Todos los campos son necesarios';
        header("Location: Usuario.php?editPassword=TRUE");
        return;
    }elseif(strlen($_POST['newPass'])<6 || strlen($_POST['newPass1'])<6){
        $_SESSION['Edited']='La contraseñas es muy corta';
        header("Location: Usuario.php?editPassword=TRUE");
        return;
    }elseif($_POST['newPass'] !== $_POST['newPass1']){
        $_SESSION['Edited']='Las contraseñas no coinciden';
        header("Location: Usuario.php?editPassword=TRUE");
        return;
    }else{
        $stmt = $pdo->query('SELECT password FROM usuarios WHERE id_usuario="'.$_SESSION['id_usuario'].'"');
        $stmt->execute(array());
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (hash('md5', $_SESSION['email'].$_POST['password']) === $row['password']){
            $stmt = $pdo->prepare("UPDATE usuarios SET password=:password WHERE"
                . " usuarios.id_usuario=".$_SESSION['id_usuario']);
            $stmt->execute([":password" => $_POST['newPass']]);
            $_SESSION['Edited']='Cambios guardados correctamente';
            header("Location: Usuario.php");
            return;
        }else{
            $_SESSION['Edited']='Contraseña incorrecta';
            header("Location: Usuario.php?editPassword=TRUE");
            return;
        }
    }
}elseif (isset ($_POST['del'])) {
    if(strlen($_POST['passDel'])<1 || strlen($_POST['passDel1'])<1){
        $_SESSION['Edited']='Todos los campos son necesarios';
        header("Location: Usuario.php?delete=TRUE");
        return;
    }elseif($_POST['passDel'] !== $_POST['passDel1']){
        $_SESSION['Edited']='Las contraseñas no coinciden';
        header("Location: Usuario.php?delete=TRUE");
        return;
    }else{
        $stmt = $pdo->query('SELECT password FROM usuarios WHERE id_usuario="'.$_SESSION['id_usuario'].'"');
        $stmt->execute(array());
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (hash('md5', $_SESSION['email'].$_POST['passDel']) === $row['password']){
            $stmt = $pdo->prepare("UPDATE usuarios SET password=' ' WHERE "
                . "id_usuario=".$_SESSION['id_usuario']);
            $stmt->execute(array());
            include_once 'Scripts/EmailBorrar.inc.php';
            header("Location: Logout.php");
            return;
        }else{
            $_SESSION['Edited']='Contraseña incorrecta';
            header("Location: Usuario.php?delete=TRUE");
            return;
        }
    }
}
?>
<div class="main">
    <div class="gap"></div>
    <div class="user">
        <form class="panel-data" method="POST" autocomplete="off">
            <h2>Información del usuario</h2>
            <?php flashMessages(); ?>
            <p class="input-data"><label for="name">Nombre:</label>
                <a class="link-edit" href="Usuario.php?editName=<?php echo $_SESSION['name'];?>"><?php echo $_SESSION['name'];?>
                    <i class="fa fa-edit"></i></a></p>
                <?php
                if(isset($_GET['editName'])){
                    echo '<input class="edit-input " type="text" name="name" value="'.$_GET['editName'].'">';
                    echo '<p><button class="edit-button" type="submit" name="editName">Editar</button>'
                    . '<button class="edit-button" type="submit" name="cancel">Cancelar</button><p>';
                }
                ?>
            <p class="input-data"><label for="email">Correo electronico:</label>
                <a class="link-edit" href="Usuario.php?editEmail=<?php echo $_SESSION['email'];?>"><?php echo $_SESSION['email'];?>
                    <i class="fa fa-edit"></i></a></p>
                <?php
                if(isset($_GET['editEmail'])){
                    echo '<input class="edit-input " type="text" name="email" value="'.$_GET['editEmail'].'">';
                    echo '<p><button class="edit-button" type="submit" name="editEmail">Editar</button>'
                    . '<button class="edit-button" type="submit" name="cancel">Cancelar</button><p>';
                }
                ?>
            <p class="input-data"><label for="password">Contraseña:</label>
                <a class="link-edit" href="Usuario.php?editPassword=TRUE">Cambiar
                    <i class="fa fa-edit"></i></a></p>
                <?php
                if(isset($_GET['editPassword'])){
                    echo '<input class="edit-input " type="password" name="password" placeholder="Constraseña actual">';
                    echo '<input class="edit-input " type="password" name="newPass" placeholder="Nueva contraseña">';
                    echo '<input class="edit-input " type="password" name="newPass1" placeholder="Confirmar contraseña">';
                    echo '<p><button class="edit-button" type="submit" name="editPass">Editar</button>'
                    . '<button class="edit-button" type="submit" name="cancel">Cancelar</button><p>';
                }
                ?>   
            <a class="link" href="Usuario.php?delete=TRUE">
                    <i class="fa fa-times-circle"></i>Eliminar cuenta</a>
                <?php
                if(isset($_GET['delete'])){
                    echo '<p>Todos tus datos serán eliminados ¿Realmente deseas continuar?</p>';
                    echo '<br><input class="edit-input" type="password" name="passDel" placeholder="Constraseña">';
                    echo '<input class="edit-input " type="password" name="passDel1" placeholder="Confirmar contraseña">';
                    echo '<p><button class="edit-button" type="submit" name="del">Eliminar</button>'
                    . '<button class="edit-button" type="submit" name="cancel">Cancelar</button><p>';
                }
                ?>
            <div>
            </div>  
        </form>
    </div>
    <div class="gap"></div>
</div>
<?php
include_once 'Cierre.inc.php';