<?php 
    header("Content-Type:text/html; charset=UTF-8");
    ini_set("default_charset", "UTF-8");

    include "_php/gera-pastas.class.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="http://getbootstrap.com/favicon.ico">
        <title>Gera Pastas</title>
        <link href="https://getbootstrap.com/docs/4.1/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <br>
            <div class="jumbotron">
                <h1>Gera Pastas</h1>
                <h6>Developed by Daniel Brito - <small>danielb1989@gmail.com</small></h6>
                <hr>
                <p>Digite abaixo uma lista de palavras <strong>separando-as com vírgula</strong> para que seja criada uma pasta para cada palavra.</p>
                <br>
                <?php
                
                    if(isset($_POST["lista-palavras"]) && !empty($_POST["lista-palavras"])){
                        
                        $gp = new geraPastas($_POST["lista-palavras"]);

                    }
                ?>
                <form name="cria-pastas" action="" method="post" accept-charset="UTF-8">
                    <div class="form-group">
                      <textarea name="lista-palavras" class="form-control" rows="10"></textarea>
                    </div>
                    <br>
                    <p><button type="submit" class="btn btn-lg btn-block btn-success" role="button"><span class=""></span>Gerar Pastas!</button></p>
                </form>
            </div>
            <hr>
            <footer class="footer">
                <p>2013 - <?php echo date("Y"); ?></p>
                <br>
            </footer>
        </div>
    </body>
</html>