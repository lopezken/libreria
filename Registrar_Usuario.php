<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php
    $Nom=$_POST["Nombre"];
    $Apellido=$_POST["Apellido"];
    $Usuario=$_POST["Usuario"];
    $fecha=date('Y-m-d');
    $pass=sha1($_POST['password']);
    try {
    $base=new PDO('mysql:host=localhost;dbname=ventas','root','');
    $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $base->exec("SET CHARACTER SET utf8");
    $sql="INSERT INTO usuarios(nombre,apellido,email,password,fechaCaptura) VALUES(:Nombre,:Apellido,:Usuario,:password,:fecha)";
    $resultado=$base->prepare($sql);
    $resultado->execute(array(":Nombre"=>$Nom,":Apellido"=>$Apellido,":Usuario"=>$Usuario,":password"=>$pass,":fecha"=>$fecha));
    echo "<script>
                alert('Usuario Registrado');
                window.location= 'index.php'
    </script>"; 
    $resultado->closeCursor();
    } catch (Exception $e) {
        echo "Linea del error: ". $e->getLine();
    }finally{
        $base = null;
    }

    ?>
</body>
</html>