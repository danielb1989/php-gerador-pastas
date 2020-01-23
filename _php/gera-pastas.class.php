<?php

	class geraPastas {

        private $local_pastas = "pastas-geradas/";

        private $qtd_pastas_criadas = 0;

        function __construct($lista_palavras = null) {
            try {
                if(empty($lista_palavras)) {
                    throw new Exception("Palavras Chave não foram encontradas.", 1);
                }
                $pcs = explode(",", $lista_palavras);
                foreach($pcs as $pc) {
                    if(!empty($pc)) {
                        $this->geraArquivo($pc);
                    }
                }
                if($this->qtd_pastas_criadas == 0) {
                  throw new Exception("Nenhum pasta foi criada.", 1);
                }
                if($this->qtd_pastas_criadas == 1) {
                    $mensagem = $this->alerta("Foi criada somente <strong>".$this->qtd_pastas_criadas."</strong> pasta com sucesso.", 1);
                }else{
                    $mensagem = $this->alerta("Foram criadas <strong>".$this->qtd_pastas_criadas."</strong> pastas com sucesso.", 1);
                }
                echo $mensagem;
            } catch (Exception $e) {
                echo $this->alerta($e->getMessage());
            }
        }

        private function geraArquivo($string = null) {
            $iso88591_2 = mb_convert_encoding($string, "ISO-8859-1", "UTF-8");
            $file = $this->formataStringParaURL($iso88591_2);
            if (!file_exists($this->local_pastas."/".$file)) {
                mkdir($this->local_pastas."/".$file);
                $this->qtd_pastas_criadas += 1;
            }
        }

		private function formataStringParaURL($string = null) {
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

        private function alerta($msg = null, $tipo = null) {
            switch ($tipo) {
                case 1:
                    $class = "success";
                    break;
                default:
                    $class = "danger";
                    break;
            }
            return "<div class=\"alert alert-".$class." text-center\">".$msg."</div>";
        }

	}