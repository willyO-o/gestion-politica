<?php



if (!function_exists('fecha_literal')) {
    function fechaLiteral($fecha, $formato = 0)
    {
        $dias = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
        $meses = array(1 => "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $infofecha = getdate(strtotime($fecha));
        if (empty($fecha)) {
            return ('');
        } else {
            switch ($formato) {
                case 1:
                    return ($infofecha['mday'] < 10 ? '0' : '') . $infofecha['mday'] . ' de ' . $meses[$infofecha['mon']] . ' de ' . $infofecha['year'];
                    break;
                case 2:
                    return $dias[$infofecha['wday']] . ', ' . ($infofecha['mday'] < 10 ? '0' : '') . $infofecha['mday'] . ' de ' . $meses[$infofecha['mon']] . ' de ' . $infofecha['year'];
                    break;
                case 3:
                    return $dias[$infofecha['wday']] . ', ' . ($infofecha['mday'] < 10 ? '0' : '') . $infofecha['mday'] . ' de ' . $meses[$infofecha['mon']] . ' de ' . $infofecha['year'] . ' [Hrs. ' . ($infofecha['hours'] < 10 ? '0' : '') . $infofecha['hours'] . ':' . ($infofecha['minutes'] < 10 ? '0' : '') . $infofecha['minutes'] . ']';
                    break;
                case 5:
                    return ($infofecha['mday'] < 10 ? '0' : '') . $infofecha['mday'] . ' de ' . $meses[$infofecha['mon']] . ' de ' . $infofecha['year'] . ' [Hrs. ' . ($infofecha['hours'] < 10 ? '0' : '') . $infofecha['hours'] . ':' . ($infofecha['minutes'] < 10 ? '0' : '') . $infofecha['minutes'] . ']';
                    break;
                case 9:
                    return ($infofecha['mday'] < 10 ? '0' : '') . $infofecha['mday'] . '/' . substr(strtolower($meses[$infofecha['mon']]), 0, 3);
                    break;
                case 10:
                    return $infofecha['year'];
                    break;
                case 20:
                    return $infofecha['mon'];
                    break;
                case 30:
                    return $infofecha['mday'];
                    break;
                default:
                    return date('Y-m-d H:i:s', strtotime($fecha));
                    break;
            }
        }
    }
}

if (!function_exists('numero_romano')) {


    function numero_romano($integer, $upcase = true)
    {
        $table = array(
            'M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100,
            'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9,
            'V' => 5, 'IV' => 4, 'I' => 1
        );
        $return = '';
        while ($integer > 0) {
            foreach ($table as $rom => $arb) {
                if ($integer >= $arb) {
                    $integer -= $arb;
                    $return .= ($upcase ? $rom : strtolower($rom));
                    break;
                }
            }
        }
        return $return;
    }
}

if (!function_exists('eliminar_acentos')) {

    function eliminar_acentos($texto)
    {
        $texto = htmlentities($texto, ENT_QUOTES, 'UTF-8');
        $texto = strtolower($texto);
        $patron = array(
            // Espacios, puntos y comas por guion
            '/[\., ]+/' => '-',
            // Vocales
            '/&agrave;/' => 'a',
            '/&egrave;/' => 'e',
            '/&igrave;/' => 'i',
            '/&ograve;/' => 'o',
            '/&ugrave;/' => 'u',
            // Vocales con tilde
            '/&aacute;/' => 'a',
            '/&eacute;/' => 'e',
            '/&iacute;/' => 'i',
            '/&oacute;/' => 'o',
            '/&uacute;/' => 'u',
            // Vocales con diéresis
            '/&auml;/' => 'a',
            '/&euml;/' => 'e',
            '/&iuml;/' => 'i',
            '/&ouml;/' => 'o',
            '/&uuml;/' => 'u',
            // Otras letras y caracteres especiales
            '/&aring;/' => 'a',
            '/&ntilde;/' => 'n',
            // Agregar aqui mas caracteres si es necesario
        );
        $texto = preg_replace(array_keys($patron), array_values($patron), $texto);
        return $texto;
    }
}


if (!function_exists('eliminarAcentos')) {

    function eliminarAcentos($cadena)
    {
        $cadena = str_replace(
            array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
            $cadena
        );

        $cadena = str_replace(
            array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
            array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
            $cadena
        );

        $cadena = str_replace(
            array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
            array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
            $cadena
        );

        $cadena = str_replace(
            array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
            $cadena
        );

        $cadena = str_replace(
            array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
            array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
            $cadena
        );

        $cadena = str_replace(
            array('ñ', 'Ñ', 'ç', 'Ç'),
            array('n', 'N', 'c', 'C'),
            $cadena
        );

        return $cadena;
    }
}

if (!function_exists('nuloSiVacio')) {

    function nuloSiVacio($valor)
    {

        return empty($valor) ? null : $valor;
    }
}

if (!function_exists('formatearFechaLiteral')) {
    function formatearFechaLiteral(string $fecha, string $formato): string
    {
        // set time zone
        setlocale(LC_TIME, 'es_ES.UTF-8');
        return strftime($formato, strtotime($fecha));
    }
}
if (!function_exists('utf8Decode')) {

    function utf8Decode($texto)
    {
        return iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $texto);
    }
}

if (!function_exists('convMayuscula')) {

    function convMayuscula($texto)
    {
        return mb_convert_case($texto, MB_CASE_UPPER, "UTF-8");
    }
}

if (!function_exists('convCapitalize')) {

    function convCapitalize($texto)
    {
        return mb_convert_case($texto, MB_CASE_TITLE, "UTF-8");
    }
}

// helper para convertir solo la primera letra de un parrafo en mayuscula, los demas textos en minuscula ademas manejar acentos y ñ  ejemplo :  ñono es bueno;   salida: Ñono es bueno
if (!function_exists('convCapitalizeFirst')) {

    function convCapitalizeFirst($texto)
    {
        return mb_convert_case($texto, MB_CASE_TITLE, "UTF-8");
    }
}


if (!function_exists('formatDate')) {

    function formatDate($date)
    {
        if (empty($date)) return null;

        return date('d/m/Y', strtotime($date));
    }
}

if (!function_exists('formatoMoneda')) {

    function formatoMoneda($valor)
    {
        return number_format($valor, 2, '.', ',');
    }
}

if (!function_exists('formatoMonedaVacio')) {
    function formatoMonedaVacio($valor, $valorVacio = "")
    {
        if (empty($valor) || $valor == 0) return $valorVacio;

        return number_format($valor, 2, ',', '.');
    }
}




// if (!function_exists('uploadImageB64')) {
//     /**
//      * Sube una imagen en formato Base64 al servidor.
//      *
//      * @param string $base64Image La imagen en formato Base64.
//      * @param string $uploadPath  La ruta de destino para guardar la imagen.
//      * @param string $fileName    El nombre del archivo de imagen.
//      * @return bool True si la imagen se sube correctamente, false en caso contrario.
//      */
//     function uploadImageB64($base64Image, $uploadPath, $fileName)
//     {

//         helper('filesystem');
//         // Decodificar la imagen Base64
//         $imageData = base64_decode($base64Image);

//         // Guardar la imagen en el servidor
//         if (@write_file($uploadPath . $fileName, $imageData)) {
//             return true;
//         } else {
//             return false;
//         }
//     }
// }

if (!function_exists('verifyPath')) {
    /**
     * verifica y crea la ruta si no existe
     *
     */
    function verifyPath($ruta)
    {
        if (!is_dir($ruta)) {
            mkdir($ruta, 0777, true);
        }
    }
}



// if (!function_exists('randomFileName')) {

//     function randomFileName($tipo = "alnum", $longitud = 16)
//     {

//         helper('text');

//         return  uniqid() . '_' . random_string($tipo, $longitud);
//     }
// }



if (!function_exists('deleteFile')) {

    function deleteFile($ruta)
    {

        if (file_exists($ruta)) {
            unlink($ruta);
        }
    }
}


if (!function_exists("arrayToText")) {
    function arrayToText($array, $campo)
    {

        $text = "";
        if (empty($array)) return $text;

        foreach ($array as $key => $value) {

            $text .= $value[$campo] . ", ";
        }

        return substr($text, 0, -2);
    }
}




if (!function_exists("filtrarCampo")) {

    function filtrarCampo($lista, $campo, $valor, $campoRetorno)
    {
        if (count($lista) == 0) return "";

        if (!isset($lista[0][$campo])) return "";

        $resultado = array_filter($lista, function ($item) use ($campo, $valor) {
            return $item[$campo] == $valor;
        });

        $resultado = array_values($resultado);

        if (count($resultado) == 0) return "";

        return $resultado[0][$campoRetorno];
    }
}

if (!function_exists("partidaAnalisis")) {

    function partidaAnalisis($corelativo, $tipoAnalisis): string
    {

        $arrTipo = [1 => 'F', 2 => 'O', 3 => 'D', 4 => 'A'];
        if (is_null($corelativo) || empty($corelativo)) {
            $corelativo = 1;
        } else {
            $corelativo = $corelativo + 1;
        }

        $corelativo = str_pad($corelativo, 6, "0", STR_PAD_LEFT);

        $partida = $arrTipo[$tipoAnalisis] . $corelativo;

        return $partida;
    }
}

if (!function_exists("completarCeros")) {

    function completarCeros($numero, $cantidadCeros = 4)
    {
        return str_pad($numero, $cantidadCeros, "0", STR_PAD_LEFT);
    }
}


// fecha en formato  2021-01-01 a 01 jun, 2021

if (!function_exists("fechaMesLiteral")) {

    function fechaMesLiteral($fecha)
    {
        if (empty($fecha)) return "";
        $meses = ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"];

        if (strpos($fecha, " ")) {
            $fecha = substr($fecha, 0, strpos($fecha, " "));
        }
        $fecha = explode("-", $fecha);
        $mes = $meses[$fecha[1] - 1];

        return $fecha[2] . " " . $mes . ", " . $fecha[0];
    }
}


// splitString

if (!function_exists("splitString")) {

    function splitString($string, $separador = ",")
    {
        if (empty($string)) return [];

        $arr = explode($separador, $string);

        return $arr;
    }
}



if (!function_exists("textoPlural")) {

    function textoPlural($text, $lower = true)
    {

        $vocales = ['a', 'e', 'i', 'o', 'u'];

        $text = trim($text);

        if ($lower) {
            $text = strtolower($text);
        }

        $ultimoCaracter = substr($text, -1);

        $textoPlural = $text;

        if (in_array($ultimoCaracter, $vocales)) {
            $textoPlural .= 's';
        } else {
            $textoPlural .= 'es';
        }

        return $textoPlural;
    }
}


// calcular edad
if (!function_exists("calcEdad")) {

    function calcEdad($fecha)
    {


        if (empty($fecha)) return "";


        $fechaNacimiento = new DateTime($fecha); // Reemplaza con la fecha de nacimiento
        $fechaActual = new DateTime(); // Fecha actual

        $intervalo = $fechaNacimiento->diff($fechaActual);

        $edad = $intervalo->y; // 'y' obtiene los años de diferencia

        return $edad;
    }
}
