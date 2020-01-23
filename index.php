<?php 
    header("Content-Type:text/html; charset=UTF-8");
    ini_set("default_charset", "UTF-8");
    $mensagem = "";
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
        <?php
            if(isset($_POST["palavras-chave"])&&!empty($_POST["palavras-chave"]))
            {
                function formatStringToURL($string)
                {
                    $str   = trim($string);
                    $str_a = strtolower($str);
                    $str_b = strip_tags($str_a);
                    $str_c = preg_replace('!\s+!', "-", $str_b);
                    $array_a = array('.', '!', '@', '#', '$', '%', '&', '*', '+', '=', '(', ')', '[', ']', '{', '}', '<', '>', '\'');
                    $array_b = array('-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-');
                    $str_d = str_replace($array_a, $array_b, $str_c);
                    $array_1 = array(',', ';', ':', '/', '~', '?', '!', 'á', 'é', 'í', 'ó', 'ú', 'â', 'ê', 'î', 'ô', 'û', 'à', 'è', 'ì', 'ò', 'ù', 'ã', 'õ', 'ç', 'ñ', 'Á', 'É', 'Í', 'Ó', 'Ú', 'Â', 'Ê', 'Î', 'Ô', 'Û', 'À', 'È', 'Ì', 'Ò', 'Ù', 'Ã', 'Õ', 'Ç', 'Ñ', 'ä', 'Ä', 'ë', 'Ë', 'ï', 'Ï', 'ö', 'Ö', 'ü', 'Ü');
                    $array_2 = array('', '', '', '-', '-', '', '', 'a', 'e', 'i', 'o', 'u', 'a', 'e', 'i', 'o', 'u', 'a', 'e', 'i', 'o', 'u', 'a', 'o', 'c', 'n', 'a', 'e', 'i', 'o', 'u', 'a', 'e', 'i', 'o', 'u', 'a', 'e', 'i', 'o', 'u', 'a', 'o', 'c', 'n', 'a', 'a', 'e', 'e', 'i', 'i', 'o', 'o', 'u', 'u');
                    $str_e = str_replace($array_1, $array_2, $str_d);
                    $str_f = preg_replace('/[-]+/', "-", $str_e);
                    $url = trim($str_f, "-");
                    return $url;
                }
                try {
                    $palavras_chave = $_POST["palavras-chave"];
                    if(empty($palavras_chave))
                    {
                        throw new Exception("Palavras Chave não foram encontradas.", 1);
                    }
                    $pcs = explode(",", $palavras_chave);
                    $n = 0;
                    foreach($pcs as $pc)
                    {
                        if(!empty($pc))
                        {
                            $iso88591_2 = mb_convert_encoding($pc, "ISO-8859-1", "UTF-8");
                            $file = formatStringToURL($iso88591_2);
                            if (!file_exists($file)) {
                                mkdir($file);
                                $n += 1;
                            }
                        }
                    }
                    if($n == 0)
                    {
                      throw new Exception("Nenhum pasta foi criada.", 1);
                    }
                    $mensagem = "<div class=\"alert alert-success text-center\" role=\"alert\">Foram criadas <strong>".$n."</strong> pastas com sucesso.</div>";
                } catch (Exception $e) {
                    $mensagem = "<div class=\"alert alert-danger text-center\" role=\"alert\">".$e->getMessage()."</div>";
                }
            }
        ?>
        <div class="container">
            <br>
            <div class="jumbotron">
                <h1>Gera Pastas</h1>
                <h6>Developed by Daniel Brito - <small>danielb1989@gmail.com</small></h6>
                <hr>
                <p>Digite abaixo uma lista de palavras <strong>separando-as com vírgula</strong> para que seja criada uma pasta para cada palavra.</p>
                <br>
                <?php echo $mensagem; ?>
                <form name="cria-pastas" action="" method="post" accept-charset="UTF-8">
                    <div class="form-group">
                      <textarea name="palavras-chave" class="form-control" rows="10"></textarea>
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