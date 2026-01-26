<?php

namespace App\Lib\reportesrt;

use App\Lib\FpdfSicaf;

use App\Lib\reportes\easytable\easyTable;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

use function Ramsey\Uuid\v1;

class Reportes extends  FpdfSicaf
{
    //

    protected $fpdf;

    // public function __construct()
    // {
    //     parent::__construct();
    // }

    protected $dias = [
        "0" => "Domingo",
        "1" => "Lunes",
        "2" => "Martes",
        "3" => "Miercoles",
        "4" => "Jueves",
        "5" => "Viernes",
        "6" => "Sabado",
    ];

    protected $coloresAsistenciaHexadecima=[
        "A"=> "#00FF00",
        "F"=> "#FF0000",
        "P"=> "#0000FF",
        ""=> "#000000",
    ];




    public function tarjetaControl($data)
    {


        $inscripcion = $data['inscripcion'];
        $entrenador = $data['entrenador'];
        $pagos = $data['pagos'];
        // dd(public_path())
        $this->SetMargins(7, 5, 5);
        $this->imprimirEncabezado = false;
        $this->imprimirFooter = false;
        $this->SetAutoPageBreak(false);

        $this->SetLineWidth(0.7);
        $this->AddPage("P", [220, 140]);


        $this->SetFont('Arial', 'B', 10);

        $this->verificarFotoInscripcion($inscripcion);
        // $fpdf->Image(FCPATH . 'assets/publico/images/fondo.jpg', 0, 0, 250, 230, 'jpg');

        // $this->SetTextColor(255, 255, 255);

        // $this->Image(public_path('img/logo/fondo.jpg'), 0, 0, 250, 230, 'JPG');
        $this->Image(public_path('img/logo/fondo_2025vt.png'), 0, 0, 140, 220, 'png');

        $this->Image(public_path('img/logo/logo_2023_trans.png'), 30, 130, 75, 60, 'PNG');

        $this->Line(5, 5, 135, 5);
        $this->Line(5, 105, 135, 105);
        $this->Line(5, 105, 5, 5);
        $this->Line(135, 105, 135, 5);



        $this->Line(5, 36, 135, 36);

        $this->setDrawColor(255,255,255);

        $this->Line(132, 78, 108, 78);
        $this->Line(132, 102, 132, 78);
        $this->Line(108, 102, 108, 78);
        $this->Line(132, 102, 108, 102);

        $this->setDrawColor(0,0,0);

        $this->Line(5, 115, 135, 115);
        $this->Line(5, 210, 135, 210);
        $this->Line(5, 210, 5, 115);
        $this->Line(135, 210, 135, 115);

        $this->SetLineWidth(0.1);
        // $this->Line(7, 117, 133, 117);
        // $this->Line(7, 208, 133, 208);
        // $this->Line(7, 208, 7, 117);
        // $this->Line(133, 208, 133, 117);

        // $this->Line(7, 122, 133, 122);
        // $this->Line(7, 129, 133, 129);
        // $this->Line(7, 136, 133, 136);
        // $this->Line(7, 143, 133, 143);
        // $this->Line(7, 150, 133, 150);
        // $this->Line(7, 157, 133, 157);
        // $this->Line(7, 164, 133, 164);
        // $this->Line(7, 171, 133, 171);
        // $this->Line(7, 178, 133, 178);
        // $this->Line(7, 185, 133, 185);
        // $this->Line(7, 192, 133, 192);
        // $this->Line(7, 199, 133, 199);

        // $this->Line(41, 208, 41, 117);
        // $this->Line(71, 208, 71, 117);
        // $this->Line(105, 208, 105, 117);

        $this->SetFont('Arial', 'B', 8);


        $this->setY(8);
        $this->Cell(0, 5, 'TARJETA DE CONTROL DE MENSUALIDADES ' . date('Y'), 0, 1, 'C');
        $this->SetFont('Arial', 'B', 14);

        $this->Cell(0, 5, utf8Decode('CLUB DEPORTIVO "R.T."'), 0, 1, 'C');

        $this->SetFont('Arial', 'B', 11);

        $this->Cell(0, 5, '" Nuevas Estrellas "', 0, 1, 'C');
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(0, 4, utf8Decode("SUCURSAL " . $inscripcion->nombre_sucursal), 0, 1, 'C');

        $this->Cell(0, 4, 'Gestión 2026', 0, 1, 'C');
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(0, 4, 'Consultas y Referencias: cel: 73726566 - 68100601', 0, 1, 'C');

        $this->Image(public_path('img/logo/logo_2023.png'), 8, 8, 25, 20, 'png');
        $this->Image(public_path('img/logo/amfeal.png'), 110, 10, 15, 15, 'png');

        $urlQr = url("/detalle-inscripcion/" . $inscripcion->codigo);

        $base64Qr = "data:image/png;base64," .    $this->getBase64Qr($urlQr);

        // $codigo_qr = $this->weps_inscripcion_reportes_generar_qr($weps_inscripcion->codigo);


        // $this->setXY(10, 75);


        $this->Image($base64Qr, 10, 80, 22, 22, 'png');

        $this->image(public_path('storage/' . $inscripcion->foto), 108, 78, 24, 24);


        $this->Ln(3);
        $this->SetFont('Arial', 'B', 7);
        $this->Cell(18, 4, 'Estudiante:   ');
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(31, 4, utf8Decode($inscripcion->nombre . " " . $inscripcion->paterno . " " . $inscripcion->materno));
        $this->Ln();


        $this->SetFont('Arial', 'B', 7);
        $this->Cell(9, 5, 'Edad:', 0, 0);

        $this->SetFont('Arial', 'B', 8);
        $this->Cell(17, 5, utf8Decode(calcEdad($inscripcion->fecha_nacimiento) . " Años"));

        $this->SetFont('Arial', 'B', 7);
        $this->Cell(5, 5, 'C.I.:', 0, 0, 'L');
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(22, 5,   $inscripcion->numero_documento);

        $this->SetFont('Arial', 'B', 7);
        $this->Cell(22, 5, 'F. de Registro:', 0, 0);
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(25, 5, utf8Decode(fechaMesLiteral($inscripcion->fecha_registro)));

        $this->Ln();

        $this->SetFont('Arial', 'B', 7);
        $this->Cell(17, 6, 'Categoria:', 0, 0);
        $this->SetFont('Arial', 'B', 8);
        $this->MultiCell(100, 3, utf8Decode($inscripcion->nombre_categoria . " - SUC. " . $inscripcion->nombre_sucursal . " TURNO " . $inscripcion->turno), 0);
        $this->Ln(1);

        $this->SetFont('Arial', 'B', 7);
        $this->Cell(17, 5, 'Entrenador:', 0, 0);
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(2, 5,  utf8Decode($entrenador->nombre . " " . $entrenador->paterno . " " . $entrenador->paterno));
        $this->Ln();
        $this->SetFont('Arial', 'B', 7);
        $this->Cell(17, 5, 'Apoderado: ', 0, 0);
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(70, 5, utf8Decode(convMayuscula($inscripcion->apoderado)));
        $this->SetLineWidth(0.1);

        $this->SetFont('Arial', 'B', 7);
        $this->Cell(6, 5, 'CEL:', 0, 0, 'L');
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(20, 5,  utf8Decode($inscripcion->celular), 0, 0, "L");

        $this->Ln();
        $this->SetFont('Arial', 'B', 7);
        $this->Cell(15, 5, 'Domicilio:', 0, 0, 'L');
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(40, 5,  utf8Decode($inscripcion->direccion));
        $this->Ln();

        $this->SetFont('Arial', 'B', 7);
        $this->Cell(27, 5, 'Monto Matricula:', 0, 0, 'L');
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(40, 5,  utf8Decode(formatoMoneda($inscripcion->monto_inscripcion, 0)) . " Bs.", 0, 0, "L");

        $this->Ln(8);

        $this->Cell(3, 4, "", 0, 0, 'C');

        $this->SetFillColor(255, 255, 255);
        // $this->SetTextColor(0, 0, 0);

        $this->Cell(22.01, 4, utf8Decode("N° " . $inscripcion->numero), 0, 0, 'C', true);
        // $this->SetTextColor(255, 255, 255);

        $this->SetFillColor(0, 0, 0);

        $this->Ln(9);
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(55, 30, 'FIRMA DEL PADRE', 0, 0, 'R');
        $this->Cell(50, 30, 'FIRMA DEL ENCARGADO', 0, 0, 'C');
        $this->Ln(32);




        $this->SetLineWidth(0.1);
        // $this->Ln();



        $this->SetFont('Arial', 'B', 8);
        $this->Cell(35, 5, utf8Decode('GESTION - MES'), 1, 0, 'C');
        $this->Cell(25, 5, utf8Decode('MONTO (Bs.)'), 1, 0, 'C');
        $this->Cell(25, 5, utf8Decode('SALDO (Bs.)'), 1, 0, 'C');
        $this->Cell(40, 5, utf8Decode('OBSERVACIÓN'), 1, 1, 'C');


        $this->SetFont('Arial', 'B', 8);

        for ($i = 0; $i < 12; $i++) {
            $this->Cell(35, 7, utf8Decode(""), 1, 0, 'C');
            $this->Cell(25, 7, utf8Decode(''), 1, 0, 'C');
            $this->Cell(25, 7, utf8Decode(''), 1, 0, 'C');
            $this->Cell(40, 7, utf8Decode(''), 1, 1, 'C');
        }



        $this->piePagina();

        return $this->Output();




        exit;
    }




    public function credencialInscripcion($data)
    {


        $inscripcion = $data['inscripcion'];
        // dd(public_path())

        $this->SetMargins(7, 5, 5);
        $this->imprimirEncabezado = false;
        $this->imprimirFooter = false;
        $this->SetAutoPageBreak(false);

        $this->SetLineWidth(0.7);
        $this->AddPage("L", [115, 90]);
        $this->Image(public_path('img/candidato/fondo-credencial.png'), 0, 0, 115, 90, 'png');
        $this->setDrawColor(0, 0, 0);

        $this->SetTextColor(255, 255, 255);

        $this->SetFont('Arial', 'B', 10);


        // $this->verificarFotoInscripcion($inscripcion);

        $this->setDrawColor(255, 255, 255);

        // $this->Line(10, 35, 45, 35);
        // $this->Line(10, 35, 10, 70);
        // $this->Line(45, 35, 45, 70);
        // $this->Line(10, 70, 45, 70);

        // $this->setDrawColor(0, 0, 0);

        // $this->Line(10, 100, 130, 100);
        // $this->Line(10, 170, 130, 170);
        // $this->Line(10, 170, 10, 100);
        // $this->Line(130, 170, 130, 100);




        // $this->Line(10, 35, 45, 35);

        // $this->Line(10, 67, 10, 80);

        // $this->Line(10, 70, 45, 70);

        // $this->Line(10, 70, 45, 70);



        $this->setXY(10, 3);


        $this->AddFont("BebasNeue", "", 'BebasNeue-Regular.php', public_path('assets/fontfpdf/'));
        $this->AddFont("LondrinaOutline", "", 'LondrinaOutline-Regular.php', public_path('assets/fontfpdf/'));
        $this->AddFont("KumarOneOutline", "", 'KumarOneOutline-Regular.php', public_path('assets/fontfpdf/'));
        $this->AddFont("d-LaCruz", "", 'd-la-cruz-font.php', public_path('assets/fontfpdf/'));
        $this->AddFont("BungeeOutline", "", 'BungeeOutline-Regular.php', public_path('assets/fontfpdf/'));
        $this->AddFont("VastShadow", "", 'VastShadow-Regular.php', public_path('assets/fontfpdf/'));


        // $fpdf->Image(FCPATH . 'assets/publico/images/fondo.jpg', 0, 0, 250, 230, 'jpg');

        $this->Image(public_path('img/logo/logo_2023_trans.png'), 55, 115, 70, 50, 'png');



        $this->SetFont('BebasNeue', '', 25);
        // $this->SetFont('BungeeOutline', '', 32);
        // $this->SetFont('VastShadow', '', 15);

        $this->SetTextColor(255, 255, 255);


        // $this->Cell(0, 8, utf8Decode('CLUB DEPORTIVO R.T.'), 0, 1, 'C');
        // $this->Cell(0, 8, '"NUEVAS ESTRELLAS"', 0, 0, 'C');

        $this->SetFont('Arial', 'B', 10);

        $this->SetTextColor(0, 0, 0);
        $this->SetTextColor(255, 255, 255);

        $this->ln(8);
        // $this->Cell(0, 5, utf8Decode("Sucursal: " . $inscripcion->nombre_sucursal), 0, 1, 'C');
        // $this->Cell(0, 7, utf8Decode("Sucursal: ". $inscripcion->nombre_sucursal) , 0, 1, 'C');
        $this->SetFont('Arial', 'B', 7.5);

        // $this->MultiCell(110, 5, utf8Decode("CATEGORIA: " . $inscripcion->nombre_categoria . " - TURNO: " . $inscripcion->turno));

        $this->SetFont('Arial', 'B', 9);


        $this->setXY(10, 32);

        // $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(35, 8, utf8Decode('C.I: ' . $inscripcion->numero_documento), 0, 1, 'C',);


        $this->SetTextColor(0, 132, 30);

        $this->SetFont('Arial', 'B', 10);
        $this->setXY(5, 23);
        $this->Cell(50, 6,  utf8Decode($inscripcion->nombre), 0, 1, 'C');

        $this->setXY(5, 27);
        $this->MultiCell(50, 6,  utf8Decode($inscripcion->paterno . " " . $inscripcion->materno), 0,  'C');



        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(255, 255, 255);
        $this->SetFont('Arial', 'B', 9);

        // $this->ln(2);
        // // $this->setXY(50, 55);
        // $this->SetFont('Arial', 'B', 8);
        // $this->Cell(42, 6, "");
        // $this->Cell(22, 6, 'F. Nac. / Edad: ');

        // $this->SetFillColor(255, 255, 255);
        // $this->SetTextColor(0, 0, 0);
        // $this->Cell(33, 6,  utf8Decode(fechaMesLiteral($inscripcion->fecha_nacimiento)." [ ".calcEdad($inscripcion->fecha_nacimiento) ." años]" ), 0, 1, 'L', true);


        $this->SetFont('Arial', 'B', 8);

        $this->SetFont('Arial', 'B', 10);



        // $this->setXY(106, 51);
        // $this->Cell(30, 5, utf8Decode($inscripcion->numero), 0, 1, 'C', true);

        // $numero_filas = $this->

        // $this->RoundedRect(60, 30, 68, 46, 5, '13', 'DF');

        // $this->Image(public_path('img/logo/logo_2023.png'), 3, 0, 25, 20, 'png');

        // // $this->Image(public_path('img/logo/logo_2023.png'), 115, 0, 25, 20, 'png');


        // $this->Image(public_path('img/logo/fbf.png'), 116, 3, 15, 15, 'png');

        // $this->Image(public_path('img/logo/aflp.png'), 118, 20, 12, 12, 'png');

        // $this->Image(public_path('img/logo/amfeal.png'), 118, 35, 12, 12, 'png');



        // $urlQr = url("/admin/asistencia-estudiante/" . $inscripcion->codigo);

        // $base64QrAsistencia = "data:image/png;base64," .    $this->getBase64Qr($inscripcion->codigo, 400, "png", "L", "", 2);

        // $this->Image($base64QrAsistencia, 77, 59, 20, 20, 'png');

        // $this->SetXY(107, 85);

        // $this->SetTextColor(255, 255, 255);
        // $this->SetFont('Arial', 'B', 8);
        // $this->Cell(40, 5, utf8Decode('QR para asistencia'), 0, 1);
        // $fpdf->Image(FCPATH . 'uploads/img/qr_cel.png', 115, 67, 15, 15, 'png');
        // $this->Image(public_path('img/logo/qr_cel.png'), 110, 58, 25, 25, 'png');



        $urlQr = url("/detalle-inscripcion/" . $inscripcion->codigo);

        $base64Qr = "data:image/png;base64," .    $this->getBase64Qr($urlQr, 400, "png", "M", "/public/img/mts/logo-mts.png", 2);

        $this->Image($base64Qr, 76.5, 59, 20, 20, 'png');

        if (empty($inscripcion->foto) == false) {
            // $this->Image(FCPATH . 'uploads/foto/' . $persona->foto, 110, 80, 20, 20);
            $this->image(public_path('storage/' . $inscripcion->foto), 17.5, 45, 22, 20);
        }

        $this->SetTextColor(0, 0, 0);
        $this->SetTextColor(255, 255, 255);

        $this->SetFont('Arial', 'B', 7);

        // $this->setXY(49, 33);
        // $this->Cell(30, 5, utf8Decode('NOMBRE(S):'));

        // $this->setXY(49, 45);
        // $this->Cell(30, 5, utf8Decode('APELLIDOS:'));


        // $this->SetFont('Arial', 'B', 8);

        // $this->setXY(48, 64);
        // $this->Cell(30, 6, ' Nro Registro:');

        $this->SetFont('d-LaCruz', '', 28);
        // $this->SetFont('Arial', 'B', 20);
        // $this->SetFont('BungeeOutline', '', 32);
        $this->SetTextColor(0, 0, 0);
        $this->SetTextColor(255, 255, 255);


        $this->setXY(48, 77);
        // $this->Cell(30, 6, utf8Decode( "Gestión ".date("Y")));

        $this->setXY(25, 83);
        $this->SetTextColor(0, 0, 0);
        $this->SetTextColor(255, 255, 255);

        $this->SetFont('Arial', 'B', 10);
        // $this->Cell(100, 6, 'Informaciones al celular 73726566', 0, 0, "C");
        // $this->Image(public_path('img/logo/flecha.png'), 120, 83, 5, 5, 'png');


        $this->Ln(3);

        $this->SetFont('Arial', '', 10);
        $this->SetTextColor(0, 0, 0);

        $this->setXY(15, 116);
        // $this->Cell(34, 6, "Ariel Ticona Vargas", "T", 1, 'C', false);


        // $this->SetFont('Arial', 'B', 8);
        // $this->SetTextColor(0, 0, 0);
        // $this->setXY(15, 122.5);
        // $this->Cell(34, 3, utf8Decode('DIRECTOR GENERAL'),0,0,"C");

        // // 		$this->setXY(20, 120);
        // $this->Image(public_path('img/logo/firma.png'), 15, 99, 40, 20, 'png');

        // $this->setXY(90, 120);


        // $this->SetFont('Arial', 'B', 9);

        // $this->setXY(55, 110);
        // $this->MultiCell(70, 6, utf8Decode("La presente Credencial acredita la Inscripción a la Academia de Fútbol R.T. \"Nuevas Estrellas\", y la presentación es de uso personal e intransferible permitiendo al portador participar en los entrenamientos. \n \nNOTA: Recordar la puntualidad de los pagos en la Academia, caso contrario el interés será 5% por día atrasado."));

        // $this->Ln(60);
        // $this->SetFont('Arial', 'B', 8);
        // $this->Cell(55, 30, 'PRESIDENTE', 0, 0, 'R');
        // $this->Cell(50, 30, 'PRESIDENTE  A.F.L.P.', 0, 0, 'C');
        // $this->Ln(32);

        // $this->SetFont('Arial', 'B', 10);

        // $this->Ln(7);
        // $this->SetFont('Arial', 'B', 9);

        $this->Ln(7);

        // $this->piePagina();

        return $this->Output();




        exit;
    }
    public function credencialInscripcion0($data)
    {


        $inscripcion = $data['inscripcion'];
        // dd(public_path())

        $this->SetMargins(7, 5, 5);
        $this->imprimirEncabezado = false;
        $this->imprimirFooter = false;
        $this->SetAutoPageBreak(false);

        $this->SetLineWidth(0.7);
        $this->AddPage("P", [180, 140]);
        $this->Image(public_path('img/logo/fondo_2025vt1.png'), 0, 0, 140, 90, 'png');
        $this->setDrawColor(0, 0, 0);

        $this->SetTextColor(255, 255, 255);

        $this->SetFont('Arial', 'B', 10);


        $this->verificarFotoInscripcion($inscripcion);

        $this->setDrawColor(255, 255, 255);

        $this->Line(10, 35, 45, 35);
        $this->Line(10, 35, 10, 70);
        $this->Line(45, 35, 45, 70);
        $this->Line(10, 70, 45, 70);

        $this->setDrawColor(0, 0, 0);

        $this->Line(10, 100, 130, 100);
        $this->Line(10, 170, 130, 170);
        $this->Line(10, 170, 10, 100);
        $this->Line(130, 170, 130, 100);




        // $this->Line(10, 35, 45, 35);

        // $this->Line(10, 67, 10, 80);

        // $this->Line(10, 70, 45, 70);

        // $this->Line(10, 70, 45, 70);



        $this->setXY(10, 3);


        $this->AddFont("BebasNeue", "", 'BebasNeue-Regular.php', public_path('assets/fontfpdf/'));
        $this->AddFont("LondrinaOutline", "", 'LondrinaOutline-Regular.php', public_path('assets/fontfpdf/'));
        $this->AddFont("KumarOneOutline", "", 'KumarOneOutline-Regular.php', public_path('assets/fontfpdf/'));
        $this->AddFont("d-LaCruz", "", 'd-la-cruz-font.php', public_path('assets/fontfpdf/'));
        $this->AddFont("BungeeOutline", "", 'BungeeOutline-Regular.php', public_path('assets/fontfpdf/'));
        $this->AddFont("VastShadow", "", 'VastShadow-Regular.php', public_path('assets/fontfpdf/'));


        // $fpdf->Image(FCPATH . 'assets/publico/images/fondo.jpg', 0, 0, 250, 230, 'jpg');

        $this->Image(public_path('img/logo/logo_2023_trans.png'), 35, 115, 70, 50, 'png');



        $this->SetFont('BebasNeue', '', 25);
        // $this->SetFont('BungeeOutline', '', 32);
        // $this->SetFont('VastShadow', '', 15);

        $this->SetTextColor(255, 255, 255);


        $this->Cell(0, 8, utf8Decode('CLUB DEPORTIVO R.T.'), 0, 1, 'C');
        $this->Cell(0, 8, '"NUEVAS ESTRELLAS"', 0, 0, 'C');

        $this->SetFont('Arial', 'B', 10);

        $this->SetTextColor(0, 0, 0);
        $this->SetTextColor(255, 255, 255);

        $this->ln(8);
        $this->Cell(0, 5, utf8Decode("Sucursal: " . $inscripcion->nombre_sucursal), 0, 1, 'C');
        // $this->Cell(0, 7, utf8Decode("Sucursal: ". $inscripcion->nombre_sucursal) , 0, 1, 'C');
        $this->SetFont('Arial', 'B', 7.5);

        $this->MultiCell(110, 5, utf8Decode("CATEGORIA: " . $inscripcion->nombre_categoria . " - TURNO: " . $inscripcion->turno));

        $this->SetFont('Arial', 'B', 9);


        $this->setXY(10, 73);

        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(35, 8, utf8Decode('C.I: ' . $inscripcion->numero_documento), 0, 1, 'C', true);


        $this->SetFont('Arial', 'B', 10);
        $this->setXY(50, 38);
        $this->Cell(54, 6,  utf8Decode($inscripcion->nombre), 0, 1, 'L', true);

        $this->setXY(50, 50);
        $this->MultiCell(54, 6,  utf8Decode($inscripcion->paterno . " " . $inscripcion->materno), 0, 1, 'L', true);



        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(255, 255, 255);
        $this->SetFont('Arial', 'B', 9);

        $this->ln(2);
        // $this->setXY(50, 55);
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(42, 6, "");
        $this->Cell(22, 6, 'F. Nac. / Edad: ');

        // $this->SetFillColor(255, 255, 255);
        // $this->SetTextColor(0, 0, 0);
        // $this->Cell(33, 6,  utf8Decode(fechaMesLiteral($inscripcion->fecha_nacimiento)." [ ".calcEdad($inscripcion->fecha_nacimiento) ." años]" ), 0, 1, 'L', true);


        $this->SetFont('Arial', 'B', 8);

        $this->SetFont('Arial', 'B', 10);



        $this->setXY(106, 51);
        $this->Cell(30, 5, utf8Decode($inscripcion->numero), 0, 1, 'C', true);

        // $numero_filas = $this->

        // $this->RoundedRect(60, 30, 68, 46, 5, '13', 'DF');

        $this->Image(public_path('img/logo/logo_2023.png'), 3, 0, 25, 20, 'png');

        // $this->Image(public_path('img/logo/logo_2023.png'), 115, 0, 25, 20, 'png');


        $this->Image(public_path('img/logo/fbf.png'), 116, 3, 15, 15, 'png');

        $this->Image(public_path('img/logo/aflp.png'), 118, 20, 12, 12, 'png');

        $this->Image(public_path('img/logo/amfeal.png'), 118, 35, 12, 12, 'png');



        // $urlQr = url("/admin/asistencia-estudiante/" . $inscripcion->codigo);

        $base64QrAsistencia = "data:image/png;base64," .    $this->getBase64Qr($inscripcion->codigo, 400, "png", "L", "", 2);

        $this->Image($base64QrAsistencia, 106, 55, 30, 30, 'png');

        $this->SetXY(107, 85);

        $this->SetTextColor(255, 255, 255);
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(40, 5, utf8Decode('QR para asistencia'), 0, 1);
        // $fpdf->Image(FCPATH . 'uploads/img/qr_cel.png', 115, 67, 15, 15, 'png');
        // $this->Image(public_path('img/logo/qr_cel.png'), 110, 58, 25, 25, 'png');



        $urlQr = url("/detalle-inscripcion/" . $inscripcion->codigo);

        $base64Qr = "data:image/png;base64," .    $this->getBase64Qr($urlQr);

        $this->Image($base64Qr, 101, 101, 28, 28, 'png');

        if (empty($inscripcion->foto) == false) {
            // $this->Image(FCPATH . 'uploads/foto/' . $persona->foto, 110, 80, 20, 20);
            $this->image(public_path('storage/' . $inscripcion->foto), 10.5, 35.5, 34, 34);
        }

        $this->SetTextColor(0, 0, 0);
        $this->SetTextColor(255, 255, 255);

        $this->SetFont('Arial', 'B', 7);

        $this->setXY(49, 33);
        $this->Cell(30, 5, utf8Decode('NOMBRE(S):'));

        $this->setXY(49, 45);
        $this->Cell(30, 5, utf8Decode('APELLIDOS:'));


        // $this->SetFont('Arial', 'B', 8);

        // $this->setXY(48, 64);
        // $this->Cell(30, 6, ' Nro Registro:');

        $this->SetFont('d-LaCruz', '', 28);
        // $this->SetFont('Arial', 'B', 20);
        // $this->SetFont('BungeeOutline', '', 32);
        $this->SetTextColor(0, 0, 0);
        $this->SetTextColor(255, 255, 255);


        $this->setXY(48, 77);
        $this->Cell(30, 6, utf8Decode( "Gestión ".date("Y")));

        $this->setXY(25, 83);
        $this->SetTextColor(0, 0, 0);
        $this->SetTextColor(255, 255, 255);

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(100, 6, 'Informaciones al celular 73726566', 0, 0, "C");
        // $this->Image(public_path('img/logo/flecha.png'), 120, 83, 5, 5, 'png');


        $this->Ln(3);

        $this->SetFont('Arial', '', 10);
        $this->SetTextColor(0, 0, 0);

        $this->setXY(24, 117);
        $this->Cell(15, 6, "Ariel Ticona Vargas", 0, 1, 'C', false);


        $this->SetFont('Arial', 'B', 8);
        $this->SetTextColor(0, 0, 0);
        $this->setXY(15, 122);
        $this->MultiCell(34, 3, utf8Decode('DIRECTOR GENERAL'));

        // 		$this->setXY(20, 120);
        $this->Image(public_path('img/logo/firma.png'), 15, 102, 40, 20, 'png');

        $this->setXY(90, 120);


        $this->SetFont('Arial', 'B', 9);

        $this->setXY(15, 130);
        $this->MultiCell(110, 6, utf8Decode("La presente Credencial acredita la Inscripción a la Academia de Fútbol R.T. \"Nuevas Estrellas\", y la presentación es de uso personal e intransferible permitiendo al portador participar en los entrenamientos. \nNOTA: Recordar la puntualidad de los pagos en la Academia, caso contrario el interés será 5% por día atrasado."));

        $this->Ln(60);
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(55, 30, 'PRESIDENTE', 0, 0, 'R');
        $this->Cell(50, 30, 'PRESIDENTE  A.F.L.P.', 0, 0, 'C');
        $this->Ln(32);

        $this->SetFont('Arial', 'B', 10);

        $this->Ln(7);
        $this->SetFont('Arial', 'B', 9);

        $this->Ln(7);

        $this->piePagina();

        return $this->Output();




        exit;
    }

    public function piePagina($setY = -10){
        $this->SetY($setY);
        $this->SetFont('Arial', 'I', 6);
        $this->Cell(0, 6, utf8Decode(config('app.constants.sistem')." - ".config('app.constants.sistem_prefix')), 0, 0, "R");
    }

    public function pagosInscripcion($datos)
    {
        $inscripcion = $datos['inscripcion'];
        $pagos = $datos['pagos'];
        $entrenador = $datos['entrenador'];


        $this->imprimirEncabezado = true;
        $this->setterDasher = true;

        $this->AddPage("P", "Letter");

        $this->SetMargins(25, 25, 25);
        $this->setAutoPageBreak(true, 35);

        $this->SetFont('Arial', 'B', 8);

        $this->Cell(0, 10, utf8Decode('F. Impresión: ' . date("d/m/Y")), 0, 0, 'R');

        $this->SetFont('Arial', 'B', 12);


        $this->Ln(5);
        $this->SetTextColor(16, 87, 97);

        $this->Cell(0, 10, utf8Decode('DETALLES DE APORTES'), 0, 1, 'C');
        $this->Ln(2);
        $this->SetFont('Arial', 'B', 10);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(30, 5, utf8Decode('Nro. Inscripción:'), 0);
        $this->SetFont('Arial', '', 8);
        $this->Cell(70, 5, utf8Decode($inscripcion->numero), 0);
        $this->ln();
        $this->SetFont('Arial', 'B', 10);

        $this->Cell(20, 5, utf8Decode('Militante:'), 0);
        $this->SetFont('Arial', '', 8);
        $this->Cell(70, 5, utf8Decode($inscripcion->nombre . " " . $inscripcion->paterno . " " . $inscripcion->materno), 0);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(12, 5, utf8Decode('Edad:'), 0);
        $this->SetFont('Arial', '', 8);
        $this->Cell(25, 5, utf8Decode(calcEdad($inscripcion->fecha_nacimiento) . " Años"), 0);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(15, 5, utf8Decode('Genero:'), 0);
        $this->SetFont('Arial', '', 8);
        $this->Cell(20, 5, utf8Decode($inscripcion->genero), 0);
        $this->ln();
        // $this->SetFont('Arial', 'B', 10);
        // $this->Cell(22, 5, utf8Decode('Apoderado:'), 0);
        $this->SetFont('Arial', '', 8);
        $this->Cell(68, 5, utf8Decode($inscripcion->apoderado), 0);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(12, 5, utf8Decode('C.I.:'), 0);
        $this->SetFont('Arial', '', 8);
        $this->Cell(25, 5, utf8Decode($inscripcion->numero_documento), 0);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(15, 5, utf8Decode('Celular:'), 0);
        $this->SetFont('Arial', '', 8);
        $this->Cell(20, 5, utf8Decode($inscripcion->celular), 0);
        $this->ln();
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(20, 5, utf8Decode('Correo:'), 0);
        $this->SetFont('Arial', '', 8);
        $this->Cell(70, 5, utf8Decode($inscripcion->correo), 0);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(40, 5, utf8Decode('Fecha de Registro:'), 0);
        $this->SetFont('Arial', '', 8);
        $this->Cell(70, 5, utf8Decode(fechaMesLiteral($inscripcion->fecha_registro)), 0);
        $this->ln();
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(20, 5, utf8Decode('Dirección:'), 0);
        $this->SetFont('Arial', '', 8);
        $this->Cell(40, 5, utf8Decode($inscripcion->direccion), 0);
        $this->ln();
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(20, 5, utf8Decode('Distrito:'), 0);
        $this->SetFont('Arial', '', 8);
        $this->Cell(70, 5, utf8Decode($inscripcion->nombre_categoria . " - " . $inscripcion->gestion), 0);
        $this->ln();
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(22, 5, utf8Decode('Encargado:'), 0);
        $this->SetFont('Arial', '', 8);
        $this->Cell(70, 5, utf8Decode($entrenador->nombre . " " . $entrenador->paterno . " " . $entrenador->materno), 0);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(35, 5, utf8Decode('Tipo de militancia:'), 0);
        $this->SetFont('Arial', '', 8);
        $this->Cell(40, 5, utf8Decode($inscripcion->tipo_inscripcion), 0);
        $this->ln();
        $this->SetFont('Arial', 'B', 10);
        // $this->Cell(58, 5, utf8Decode('Monto Inscripción (Matricula) Bs.: '), 0);
        // $this->SetFont('Arial', '', 10);
        // $this->Cell(35, 5, formatoMoneda($inscripcion->monto_inscripcion), 0);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(20, 5, utf8Decode('Casa de campaña'), 0);
        $this->SetFont('Arial', '', 10);
        $this->Cell(40, 5, utf8Decode($inscripcion->nombre_sucursal), 0);
        $this->ln(10);



        $this->SetFont('Arial', 'B', 12);
        $this->SetTextColor(16, 87, 97);
        $this->Cell(0, 5, utf8Decode('DETALLE DE APORTES'), 0, 1, 'C');
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(0, 5, utf8Decode('(Expresado en Bolivianos)'), 0, 1, 'C');

        $this->SetFont('Arial', 'B', 11);

        // amarillo
        // $this->SetFillColor(243, 185, 42);
        // $this->SetTextColor(0, 0, 0);

        $this->SetFillColor(0, 80, 4);
        $this->SetTextColor(255, 255, 255);

        $this->SetWidths([8, 53, 20, 20, 40, 25,]);
        $this->SetTypeCell(['m', 'm', 'm', 'm', 'm', 'm']);
        $this->SetAligns(['C', 'C', 'C', 'C', 'C', 'C']);
        $this->Row([
            utf8Decode('#'),
            utf8Decode('Gestión - Mes'),
            utf8Decode('Monto'),
            utf8Decode('Saldo '),
            utf8Decode('Observación'),
            utf8Decode('Estado'),

        ], "DF");


        $this->SetFont('Arial', '', 9);

        $this->SetTextColor(0, 0, 0);
        $this->SetAligns(['C', 'L', 'R', 'R', 'L', 'C']);

        $this->SetFillColor(255, 255, 255);

        // dd($pagos);

        foreach ($pagos as $key => $pago) {

            $this->SetFillColor(255, 255, 255);
            $this->SetTextColor(0, 0, 0);

            if ($pago->estado_pago == "PENDIENTE") {
                $this->SetFillColor(243, 185, 42);
                $this->SetTextColor(0, 0, 0);
            }

            $this->Row([
                utf8Decode($key + 1),
                utf8Decode($pago->gestion . " - " . $pago->mes),
                utf8Decode($pago->monto),
                utf8Decode($pago->saldo),
                utf8Decode($pago->observacion_pago),
                utf8Decode($pago->estado_pago),

            ], "DF");
        }

        if (count($pagos) == 0) {
            $this->SetTextColor(255, 0, 0);

            $this->Cell(0, 10, utf8Decode('No se Encontraron Registros'), 1, 1, 'C');
        }



        // $this->setterDasher = true;


        return $this->Output();
    }





    public  function getBase64Qr($text, $size = 400, $format = 'png', $qualy = "H", $logoPath = '/public/img/logo/logo_2023_cirular.png', $margin = 5)
    {

        if (empty($text)) {
            throw new \Exception("No se Especificó el Texto para generar el Qr", 1);
        }

        if (empty($logoPath)) {
            return base64_encode(QrCode::encoding('UTF-8')->format($format)->size($size)->errorCorrection($qualy)->margin($margin)->generate($text));
        }

        return base64_encode(QrCode::encoding('UTF-8')->format($format)->merge($logoPath, 0.2)->size($size)->errorCorrection($qualy)->margin($margin)->generate($text));


        // >eyeColor(0, 180, 255, 255, 0, 0, 0)
        //  return base64_encode(QrCode::encoding('UTF-8')->format('png')->merge('/public/assets/logo/logo-circular.png', 0.3)->size(500)->errorCorrection('H')->generate($qrText));

    }


    public function tablaValoracion($datos)
    {

        $valoracion = $datos['valoracion'];
        $caracteristicas = $datos['caracteristicas'];
        $inscripcion = $datos['inscripcion'];
        $datosValoracion = $datos['datosValoracion'];


        $this->imprimirEncabezado = true;
        $this->setterDasher = false;

        $this->AddPage("P", "Letter");

        $this->SetMargins(25, 25, 25);
        $this->setAutoPageBreak(true, 35);

        $this->SetFont('Arial', 'B', 8);

        $this->Cell(0, 10, utf8Decode('F. Impresión: ' . date("d/m/Y")), 0, 1, 'R');



        $this->SetFont('Arial', 'B', 12);

        $this->Ln();
        $this->setXY(25, 50);

        $this->SetFillColor(0, 0, 0);
        // $this->SetFillColor(255, 255, 255);

        $this->SetTextColor(255, 255, 255);

        $this->SetWidths([30, 110, 25]);
        $this->SetTypeCell(['m', 'm', 'm']);
        $this->SetAligns(['C', 'C', 'C']);
        $this->Row([
            utf8Decode(''),
            utf8Decode($inscripcion->nombre . " " . $inscripcion->paterno . " " . $inscripcion->materno),
            utf8Decode(''),
        ], "DF");

        $this->SetTextColor(0, 0, 0);

        $this->Row([
            utf8Decode(''),
            utf8Decode("VALORACIÓN"),
            utf8Decode(''),
        ]);

        $this->SetWidths([30, 55, 55, 25]);
        $this->SetTypeCell(['m', 'm', 'm', 'm']);
        $this->SetAligns(['C', 'C', 'C', 'C']);

        $this->SetFont('Arial', '', 10);

        $this->Row([
            utf8Decode(''),
            utf8Decode($inscripcion->nombre_categoria),
            utf8Decode($datosValoracion->numero_valoracion),
            utf8Decode(''),
        ]);



        $urlFoto = public_path('/assets/images/users/user-dummy-img.jpg');

        if (empty($inscripcion->foto) == false) {
            $urlFoto = public_path('storage/' . $inscripcion->foto);
        }



        $this->image($urlFoto, 25, 50, 30, 30);

        $this->setXY(161, 50);
        $this->Cell(30, 30, "", 1, 0, "", 1);

        $this->image(public_path('img/logo/logo_2023.png'), 162, 55, 30, 20, 'png');

        $this->SetFont('Arial', 'B', 8);



        // $tabla= $this->getHeadTable($this, 6);


        // dd($valoracion);

        $this->SetTextColor(0, 0, 0);


        $this->setXY(0, 80);

        $tabla = $this->getHeadTable($this, 6);
        $tabla->rowStyle('border:1;bgcolor:#000000;valign:M;font-style:B;font-size:7; font-color:#ffffff;');
        $tabla->easyCell(utf8Decode("DATOS DEL JUGADOR"), "colspan:6;align:C;font-style:B");

        $tabla->printRow();

        $tabla->easyCell(utf8Decode("Edad"), " align:C;font-style:B");
        $tabla->easyCell(utf8Decode("Puesto"), " align:C;font-style:B");
        $tabla->easyCell(utf8Decode("Dorsal"), " align:C;font-style:B");
        $tabla->easyCell(utf8Decode("Altura"), " align:C;font-style:B");
        $tabla->easyCell(utf8Decode("Peso"), " align:C;font-style:B");
        $tabla->easyCell(utf8Decode("Pierna"), " align:C;font-style:B");
        $tabla->printRow();

        $tabla->rowStyle('border:1;bgcolor:#fff;valign:M;font-style:B;font-size:8; font-color:#000;');

        $tabla->easyCell(utf8Decode(calcEdad($inscripcion->fecha_nacimiento) . " años"), " align:C;font-style:B");
        $tabla->easyCell(utf8Decode($datosValoracion->puesto), " align:C;font-style:B");
        $tabla->easyCell(utf8Decode($datosValoracion->dorsal), " align:C;font-style:B");
        $tabla->easyCell(utf8Decode($datosValoracion->altura . " m."), " align:C;font-style:B");
        $tabla->easyCell(utf8Decode($datosValoracion->peso . " Kg."), " align:C;font-style:B");
        $tabla->easyCell(utf8Decode($datosValoracion->pierna), " align:C;font-style:B");
        $tabla->printRow();


        $tabla->endTable(0);



        foreach ($caracteristicas as $keyCar => $caracteristica) {


            $atributos = json_decode($caracteristica->atributos ?? "[]");
            $nroColumnas = count($atributos) + 1;

            $tabla = $this->getHeadTable($this, $nroColumnas);

            $tabla->rowStyle('border:1;bgcolor:#000000;valign:M;font-style:B;font-size:7; font-color:#ffffff;');
            $tabla->easyCell(utf8Decode($caracteristica->caracteristica), "colspan:$nroColumnas;align:C;font-style:B");
            $tabla->printRow();


            foreach ($atributos as $keyAttr => $atributo) {
                // $tabla->rowStyle('border:1;bgcolor:#b0c1d7;valign:M;font-style:B;font-size:7;');
                $tabla->easyCell(utf8Decode($atributo->nombre_atributo), " align:C;font-style:B");
            }

            $tabla->easyCell(utf8Decode("Media"), " align:C;font-style:B");
            $tabla->printRow();


            $tabla->rowStyle('border:1;bgcolor:#fff;valign:M;font-style:B;font-size:8; font-color:#000;');
            $rowValoracion = $this->getRowValoracion($valoracion, $caracteristica->id_caracteristica);
            $valoracionAtributo = json_decode($rowValoracion->atributos ?? "[]");
            foreach ($atributos as $keyAttr => $atributo) {

                $value = $this->getAtributeValue($atributo->id_atributo, $valoracionAtributo);

                $tabla->easyCell(utf8Decode($value), " align:C;font-style:B");
            }


            $mediaFila = $this->calcularMedia($valoracionAtributo);
            $tabla->easyCell(utf8Decode($mediaFila), " align:C;font-style:B");
            $tabla->printRow();

            $tabla->rowStyle('border:1;bgcolor:#fff;valign:M;font-style:B;font-size:8; font-color:#000;');

            $tabla->easyCell(utf8Decode("Observaciones: "), ";align:R;font-style:B");
            $tabla->easyCell(utf8Decode($rowValoracion->observacion_valoracion), "colspan:" . ($nroColumnas - 1) . ";align:L;font-style:N");
            $tabla->printRow();



            $tabla->endTable(0);
        }



        // $tabla= $this->getHeadTable($this, 6);



        return $this->Output();
    }

    private function getAtributeValue($idAtributo, $rowCaracteristica)
    {

        $valor = "";

        foreach ($rowCaracteristica as $key => $val) {
            // dd($val);
            $idAtributoFila = (int) $val->id_atributo_fk;

            if ($idAtributoFila == $idAtributo) {
                $valor = $val->valor;
                break;
            }
        }


        return $valor;
    }

    private function calcularMedia($atributos)
    {
        $media = 0;
        $contador = 0;

        foreach ($atributos as $key => $atributo) {

            if ($atributo->valor != null && $atributo->valor != "") {
                $media += $atributo->valor;
                $contador++;
            }
        }

        //redondear media a 1 decimal

        $media = $media == 0 ? " 0" : round($media / $contador, 1);

        return $media;
    }

    private function getRowValoracion($valoracion, $idCaracteristica)
    {

        //bjeto por defecto
        $row = (object) [
            "id_caracteristica" => $idCaracteristica,
            "observacion_valoracion" => "",
            "atributos" => "[]",
        ];

        foreach ($valoracion as $key => $val) {
            // dd($val);
            $idCaracteristicaFila = (int) $val->id_caracteristica;

            if ($idCaracteristicaFila == $idCaracteristica) {
                $row = $val;
                break;
            }
        }

        return $row;
    }





    private function getHeadTable($pdf, $nroCols, $width = 300)
    {

        $cols = "";
        $widthCol = ceil($width / $nroCols);
        for ($i = 0; $i < $nroCols; $i++) {
            $cols .= $widthCol . ",";
        }

        $cols = substr($cols, 0, -1);

        $tabla = new easyTable($pdf, '{' . $cols . '}', 'width:' . $width . '; align:R{LC}; border:1;border-color:#8aa5ca;border-width:0.01;split-row:true;border-style:D;valign:M;bgcolor:#dddddd;');

        return $tabla;
    }














    public function reporteAsignacioness($asignaciones)
    {

        $this->AddPage("P", "Letter");

        $this->SetMargins(20, 20, 20);

        $this->setterDasher = true;


        // $this->AddPage("P", "Letter");
        $this->SetAutoPageBreak(true, 25);

        $this->SetFont('Arial', 'B', 12);

        // $this->Image(public_path('img/membretes/menbrete_horizontal.jpg'), 0, 0, 219, 280, 'JPG');

        //color de borde gris claro


        //cambiar color de texto
        $this->SetTextColor(30, 90, 173);
        //color de lineas de borde
        $this->SetDrawColor(146, 175, 213);

        $this->ln();

        $this->SetY(20);


        $this->Cell(0, 10, utf8Decode("          Reporte de Asignaciones"), 0, 1, 'C');


        $this->SetFont('Arial', '', 6);

        $this->SetY(23);


        $this->Cell(180, 10, utf8Decode("f. impresion: " . date("d/m/Y H:i:s")), 0, 1, 'R');



        $this->ln(5);


        $this->SetFont('Arial', '', 7);


        $this->SetDash(.4, .6);






        // border punteado
        $tabla = new easyTable($this, '{10, 15, 20, 30,40,60,20}', 'width:300; align:R{LC}; border:1;border-color:#8aa5ca;border-width:0.01;split-row:true;border-style:D;valign:M;');
        // $tabla->SetSplitRows(true);

        $tabla->rowStyle('border:1;bgcolor:#b0c1d7;valign:M;font-style:B;font-size:7;');

        $tabla->easyCell(utf8Decode("N°"), " align:C;font-style:B");
        $tabla->easyCell(utf8Decode("Cod. Asignacion"), " align:C;font-style:B");
        $tabla->easyCell(utf8Decode("Fecha Asignación"), " align:C;font-style:B");
        $tabla->easyCell(utf8Decode("Responsable"), " align:C;font-style:B");

        $tabla->easyCell(utf8Decode("Detalles de Asignación"), " align:C;font-style:B");
        $tabla->easyCell(utf8Decode("Activos Asignados"), " align:C;font-style:B");
        $tabla->easyCell(utf8Decode("Estado"), " align:C;font-style:B");


        $tabla->printRow();
        // $tabla->endTable(0);

        // $tabla = new easyTable($this, '{10, 15, 20, 30,50,50,20}', 'width:300; align:R{LC}; border:1;border-color:#8aa5ca;border-width:0.01;split-row:true;border-style:D;valign:M;');


        $contador = 1;
        try {


            foreach ($asignaciones as $asignacion) {



                $activos = json_decode($asignacion->activos ?? "[]");
                $rows = count($activos) > 0 ? count($activos) : 1;

                // dd($activos, $rows);

                $tabla->easyCell(utf8Decode($contador++), " align:C;rowspan:$rows");
                $tabla->easyCell(utf8Decode($asignacion->cod_asignacion), " align:C;font-size:7;rowspan:$rows");
                $tabla->easyCell(utf8Decode(date("d/m/Y", strtotime($asignacion->fecha_asignacion))), " align:C;rowspan:$rows");
                $tabla->easyCell(utf8Decode($asignacion->nombre . " " . $asignacion->paterno . " " . $asignacion->materno . " (" . $asignacion->tipo_personal . ")"), " align:L;rowspan:$rows");
                $tabla->easyCell(utf8Decode($asignacion->detalle_asignacion ?? "-"), " align:L;rowspan:$rows");

                if (count($activos) > 0) {
                    $cantidad_activos = $rows  - 1;
                    foreach ($activos as $key => $item) {
                        $borde = $cantidad_activos == $key ? "border:BR" : ($key == 0 ? "border:TR" : "border:R");
                        $bgCelda = $key % 2 == 0 ? "" : "bgcolor:#f3f6f9;";

                        $tabla->easyCell(utf8Decode(($key + 1) . ". " . $item->cuaf . ($item->cantidad_grupo ? "(" . $item->nro_correlativo_grupo . "/" . $item->nro_correlativo_grupo . ")" : "")), " align:L;font-size:7;$bgCelda" . $borde);
                        $tabla->easyCell(utf8Decode($item->estado_actual), " align:L;font-size:7;$bgCelda" . $borde);
                        $tabla->printRow();
                    }
                } else {

                    $tabla->easyCell(utf8Decode("Sin Datos"), "align:L;font-size:7;colspan:2");
                    $tabla->printRow();
                }

                // $this->CheckPageBreak($this->getY());

            }
        } catch (\Exception $e) {
            // dd($e);
        }

        $tabla->endTable(0);



        $this->SetFont('Arial', 'B', 8);

        //crear nombre del archivo


        $this->SetTitle("Reporte Aignaciones de Activos " . date("d-m-Y"));

        return $this->Output();
    }



    public function reporteActivosFijos($listadoActivos)
    {





        $this->SetMargins(20, 20, 20);

        $this->AddPage("P", "Letter");


        $this->SetFont('Arial', 'B', 12);


        $this->setterDasher = true;


        $this->SetTextColor(30, 90, 173);
        //color de lineas de borde
        $this->SetDrawColor(146, 175, 213);

        $this->ln();


        $this->SetY(20);

        $this->Cell(0, 10, utf8Decode("        Reporte de Activos Fijos "), 0, 1, 'C');


        $this->SetFont('Arial', '', 6);
        $this->SetY(23);


        $this->Cell(180, 10, utf8Decode("f. impresion: " . date("d/m/Y H:i:s")), 0, 1, 'R');


        $this->ln(5);



        $this->SetFont('Arial', '', 6);

        $this->SetDash(.4, .6);




        $this->SetFillColor(30, 90, 173);
        $this->SetFillColor(83, 119, 181);

        $this->SetTextColor(255, 255, 255);

        $this->SetWidths([7, 20, 40, 20, 20, 30, 20, 19]);
        $this->SetTypeCell(['m', 'm', 'm', 'm', 'm', 'm', 'm', 'm']);
        $this->SetAligns(['C', 'C', 'C', 'C', 'C']);
        $this->Row([
            utf8Decode('#'),
            utf8Decode('Codigo'),
            utf8Decode('Activo Fijo'),
            utf8Decode('Fecha Adquisicion'),
            utf8Decode('Financiamiento'),
            utf8Decode('Responsable'),
            utf8Decode('Estado'),
            utf8Decode('Condición Actual'),

        ], "DF");



        // $this->SetTypeCell(['m', 'm', 'm', 'm', 'm', 'm', 'm', 'm']);


        $this->SetAligns(['C', 'C', 'L', 'C', 'C']);


        $contador = 1;
        // $this->SetTextColor(0, 0, 0);
        $this->SetTextColor(83, 119, 181);


        foreach ($listadoActivos as $key => $item) {

            // dd($item);

            $this->Row([
                utf8Decode($contador++),
                utf8Decode($item->cuaf),
                utf8Decode($item->nombre_activo_fijo),
                utf8Decode(fechaMesLiteral($item->fecha_adquisicion)),
                utf8Decode($item->fuente_financiamiento),
                utf8Decode($item->nombre ? $item->nombre . " " . $item->paterno . " " . $item->materno : "Sin Responsable"),
                utf8Decode($item->estado_activo_fijo == "ACTIVO" ? $item->estado_activo_fijo : "DADO DE BAJA \n" . fechaMesLiteral($item->deleted_at)),
                utf8Decode($item->ultima_condicion),

            ]);
        }


        if (count($listadoActivos) == 0) {
            $this->Cell(0, 10, utf8Decode("No se encontraron registros"), 1, 1, 'C');
        }







        $this->SetFont('Arial', 'B', 8);

        $this->SetTitle("Reporte general de Actvos fijos " . date("d-m-Y"));


        return $this->Output();
    }


    private function verificarFotoInscripcion($inscripcion)
    {

        if (empty($inscripcion->foto) || file_exists(public_path('storage/' . $inscripcion->foto)) == false) {

            // error 404

            // abort(404, "No se encontró la foto del estudiante");
            $this->SetFont('Arial', 'B', 12);

            $this->cell(0, 10, "Error:", 0, 1, 'C');
            $this->cell(0, 10, utf8Decode("No se encontró la foto del estudiante"),  0, 1, 'C');
            $this->SetFont('Arial', 'B', 10);
            $this->cell(0, 10, utf8Decode("Porfavor, resuba la Imagen o verifique para poder generar la tarjeta"), 0, 1, 'C');

            $this->Output();
            exit;
        }
    }




    public function tablaAsistencia($datos)
    {
        $this->imprimirEncabezado = false;
        $this->setterDasher = false;

        $this->AddPage("L", "Letter");

        $this->SetMargins(15, 20, 15);



        // $this->AddPage("P", "Letter");
        $this->SetAutoPageBreak(true, 25);

        $this->SetFont('Arial', 'B', 12);

        // $this->Image(public_path('img/membretes/menbrete_horizontal.jpg'), 0, 0, 219, 280, 'JPG');

        //color de borde gris claro


        //cambiar color de texto
        $this->SetTextColor(30, 90, 173);
        //color de lineas de borde
        $this->SetDrawColor(89, 184, 114);

        $this->ln();

        // $this->SetY(20);


        $this->Cell(0, 7, utf8Decode("Reporte de asistencia del mes de {$datos["mes"]} - {$datos["anio"]}"), 0, 1, 'C');

        $this->SetFont('Arial', '', 8);

        $grupo= $datos["grupo"];

        $this->MultiCell(250, 7, utf8Decode("{$grupo["nombre_categoria"]} - {$grupo["nombre_grupo"]}, sucursal:  {$grupo["nombre_sucursal"]}, horario: {$grupo["hora_inicio"]} - {$grupo["hora_fin"]}, dias: {$grupo["dia"]} "), 0, "C");

        $this->SetFont('Arial', '', 6);

        // $this->SetY(23);


        $this->Cell(0, 5, utf8Decode("f. impresion: " . date("d/m/Y H:i:s")), 0, 1, 'R');



        $listadoFechas = $this->generarFechasMesEstrenamiento($datos["grupo"], $datos["nroMes"], $datos["anio"]);
        $cantidadFechas = count($listadoFechas);
        $cantidadSemanas = ceil($cantidadFechas / count($this->generarDiasEntrenamiento($datos["grupo"])));

        $this->ln();


        $this->SetFont('Arial', '', 7);


        $this->SetDash(.4, .6);

        $porColumna = 200 / $cantidadFechas;

        $columnasFechas = "";
        for ($i = 0; $i < $cantidadFechas; $i++) {
            $columnasFechas .= $porColumna . ",";
        }

        // return true;

        // return var_dump($columnasFechas);

        // border punteado

        $tabla = new easyTable($this, '{60,' . $columnasFechas . '15,15,15}', 'width:300; align:R{LC}; border:1;border-color:#000;border-width:0.01;split-row:true;border-style:D;valign:M;');
        // $tabla->SetSplitRows(true);
        $this->SetTextColor(255, 255, 255);

        $tabla->rowStyle('border:1;bgcolor:#59b872;valign:M;font-style:B;font-size:6;font-color:#fff;');

        $tabla->easyCell(utf8Decode("Nombre Inscrito"), " align:C;font-style:B;rowspan:2");


        for ($i = 1; $i <= $cantidadSemanas; $i++) {

            $nroColumnas = $this->contarDiasSemana($listadoFechas, $i);

            $tabla->easyCell(utf8Decode("Semana $i"), "colspan:{$nroColumnas};align:C;font-style:B");
        }


        $tabla->easyCell(utf8Decode("Asistencia"), " align:C;font-style:B;rowspan:2");
        $tabla->easyCell(utf8Decode("Faltas"), " align:C;font-style:B;rowspan:2");
        $tabla->easyCell(utf8Decode("Permisos"), " align:C;font-style:B;rowspan:2");

        $tabla->printRow();



        $this->SetTextColor(0, 0, 0);


        $tabla->rowStyle('border:1;bgcolor:#59b872;valign:M;font-style:B;font-size:6;font-color:#fff;');

        // $tabla->easyCell(utf8Decode("Nombre Inscrito"), " align:C;font-style:B");

        foreach ($listadoFechas as $key => $fecha) {
            $tabla->easyCell(utf8Decode($fecha["dia"] . " \n " . $fecha["nroDiaMensual"]), " align:C;font-style:B");
        }

        $tabla->printRow();


        // $tabla->endTable(0);

        foreach ($datos["asistencias"] as $llave => $fila) {
            $tabla->rowStyle('border:1;bgcolor:#fff;valign:M;font-style:B;font-size:6;');

            $tabla->easyCell(utf8Decode($fila["nombre"]. " ". $fila["paterno"]. " ".$fila["materno"]), " align:L;font-style:B");

            $totalesAsistencias = ["A" => 0, "F" => 0, "P" => 0, "" => 0];

            foreach ($listadoFechas as $key => $fecha) {

                $asistencia = $this->extraerAsistencia($fila->asistencias, $fecha["fecha"]);
                $tabla->easyCell(utf8Decode($asistencia), " align:C;font-style:B;font-color:".$this->coloresAsistenciaHexadecima[$asistencia]);

                $totalesAsistencias[$asistencia]++;
            }

            $tabla->easyCell(utf8Decode($totalesAsistencias["A"]), " align:C;font-style:B");
            $tabla->easyCell(utf8Decode($totalesAsistencias["F"]), " align:C;font-style:B");
            $tabla->easyCell(utf8Decode($totalesAsistencias["P"]), " align:C;font-style:B");

            $tabla->printRow();
        }


        $tabla->endTable(0);

        return $this->Output();
    }

    public function extraerAsistencia($asistencias, $fecha)
    {
        $asistencias = json_decode($asistencias);
        $asistencia = "F";


        if ($fecha > date("Y-m-d")) {
            return "";
        }


        foreach ($asistencias as $key => $item) {

            if (!$item->fecha_asistencia) {
                return $asistencia = "F";
            }

            if ($item->fecha_asistencia != $fecha) {
                $asistencia = "F";
            }

            if ($item->fecha_asistencia == $fecha) {
                if ($item->permiso == "1") {
                    $asistencia = "P";
                    return $asistencia;
                }


                $asistencia = "A";
                return $asistencia;
            }
        }

        return $asistencia;
    }



    public function generarDiasEntrenamiento($grupo)
    {
        $listadoDias = explode(",", $grupo->dia);

        $listadoDias = array_map(function ($item) {
            $item = str_replace("á", "a", $item);
            return trim($item);
        }, $listadoDias);

        $listadoDiasObjeto = [];

        foreach ($this->dias as $key => $diaSem) {

            $diaSem = trim($diaSem);
            if (in_array($diaSem, $listadoDias)) {
                $listadoDiasObjeto[$key] = $diaSem;
            }
        }

        if ($grupo->dia_extra) {

            if (in_array($grupo->dia_extra, $listadoDias) == false) {

                foreach ($this->dias as $key => $diaSem) {
                    $diaSem = trim($diaSem);
                    $diaExtra = str_replace("á", "a", trim($grupo->dia_extra));

                    if ($diaSem == $diaExtra) {
                        $listadoDiasObjeto[$key] = $diaExtra;
                    }
                }
            }
        }

        return $listadoDiasObjeto;
    }

    public function generarFechasMesEstrenamiento($grupo, $mes, $anio)
    {
        $listadoDias = $this->generarDiasEntrenamiento($grupo);


        $ultimoDia = cal_days_in_month(CAL_GREGORIAN, (int)$mes, $anio);



        $diasMes = [];
        for ($i = 1; $i <= $ultimoDia; $i++) {
            $fecha = $anio . "-" . $mes . "-" . $i;
            $diaSemana = date("w", strtotime($fecha));

            $diaMensual = date("d", strtotime($fecha));

            $nombreDia = $this->dias[$diaSemana];

            if (in_array($nombreDia, $listadoDias)) {

                $fechaReal = date("Y-m-d", strtotime($fecha));
                $diasMes[] = [
                    "nroDiaMensual" => $i,
                    "diaSemana" => $diaSemana,
                    "fecha" => $fechaReal,
                    "dia" => $nombreDia,
                    "diaMensual" => $diaMensual,
                    "nroSemana" => $this->getWeekNumber($fechaReal),

                ];
            }
        }

        return $diasMes;
    }



    public function getWeekNumber($fecha)
    {
        $fechaEntrada = new \DateTime($fecha, new \DateTimeZone('America/La_Paz'));
        $firstDayOfMonth = new \DateTime($fechaEntrada->format("Y-m-01"), new \DateTimeZone('America/La_Paz'));
        $dayOfWeek = $firstDayOfMonth->format("w"); // Día de la semana del primer día del mes
        $adjustedDate = $fechaEntrada->format("d") + $dayOfWeek - 1; // Ajustamos la fecha al inicio de la semana
        return floor($adjustedDate / 7) + 1; // Calculamos la semana dentro del mes

    }


    public function contarDiasSemana($fechasMes, $nroSemana)
    {
        $contador = 0;

        foreach ($fechasMes as $key => $fecha) {
            if ($fecha["nroSemana"] == $nroSemana) {
                $contador++;
            }
        }

        return $contador;
    }


    public function reporteAsignacioness2($asignaciones)
    {

        $this->AddPage("P", "Letter");

        $this->SetMargins(20, 20, 20);

        $this->setterDasher = true;


        // $this->AddPage("P", "Letter");
        $this->SetAutoPageBreak(true, 25);

        $this->SetFont('Arial', 'B', 12);

        // $this->Image(public_path('img/membretes/menbrete_horizontal.jpg'), 0, 0, 219, 280, 'JPG');

        //color de borde gris claro


        //cambiar color de texto
        $this->SetTextColor(30, 90, 173);
        //color de lineas de borde
        $this->SetDrawColor(146, 175, 213);

        $this->ln();

        $this->SetY(20);


        $this->Cell(0, 10, utf8Decode("          Reporte de Asignaciones"), 0, 1, 'C');


        $this->SetFont('Arial', '', 6);

        $this->SetY(23);


        $this->Cell(180, 10, utf8Decode("f. impresion: " . date("d/m/Y H:i:s")), 0, 1, 'R');



        $this->ln(5);


        $this->SetFont('Arial', '', 7);


        $this->SetDash(.4, .6);






        // border punteado
        $tabla = new easyTable($this, '{10, 15, 20, 30,40,60,20}', 'width:300; align:R{LC}; border:1;border-color:#8aa5ca;border-width:0.01;split-row:true;border-style:D;valign:M;');
        // $tabla->SetSplitRows(true);

        $tabla->rowStyle('border:1;bgcolor:#b0c1d7;valign:M;font-style:B;font-size:7;');

        $tabla->easyCell(utf8Decode("N°"), " align:C;font-style:B");
        $tabla->easyCell(utf8Decode("Cod. Asignacion"), " align:C;font-style:B");
        $tabla->easyCell(utf8Decode("Fecha Asignación"), " align:C;font-style:B");
        $tabla->easyCell(utf8Decode("Responsable"), " align:C;font-style:B");

        $tabla->easyCell(utf8Decode("Detalles de Asignación"), " align:C;font-style:B");
        $tabla->easyCell(utf8Decode("Activos Asignados"), " align:C;font-style:B");
        $tabla->easyCell(utf8Decode("Estado"), " align:C;font-style:B");


        $tabla->printRow();
        // $tabla->endTable(0);

        // $tabla = new easyTable($this, '{10, 15, 20, 30,50,50,20}', 'width:300; align:R{LC}; border:1;border-color:#8aa5ca;border-width:0.01;split-row:true;border-style:D;valign:M;');


        $contador = 1;
        try {


            foreach ($asignaciones as $asignacion) {



                $activos = json_decode($asignacion->activos ?? "[]");
                $rows = count($activos) > 0 ? count($activos) : 1;

                // dd($activos, $rows);

                $tabla->easyCell(utf8Decode($contador++), " align:C;rowspan:$rows");
                $tabla->easyCell(utf8Decode($asignacion->cod_asignacion), " align:C;font-size:7;rowspan:$rows");
                $tabla->easyCell(utf8Decode(date("d/m/Y", strtotime($asignacion->fecha_asignacion))), " align:C;rowspan:$rows");
                $tabla->easyCell(utf8Decode($asignacion->nombre . " " . $asignacion->paterno . " " . $asignacion->materno . " (" . $asignacion->tipo_personal . ")"), " align:L;rowspan:$rows");
                $tabla->easyCell(utf8Decode($asignacion->detalle_asignacion ?? "-"), " align:L;rowspan:$rows");

                if (count($activos) > 0) {
                    $cantidad_activos = $rows  - 1;
                    foreach ($activos as $key => $item) {
                        $borde = $cantidad_activos == $key ? "border:BR" : ($key == 0 ? "border:TR" : "border:R");
                        $bgCelda = $key % 2 == 0 ? "" : "bgcolor:#f3f6f9;";

                        $tabla->easyCell(utf8Decode(($key + 1) . ". " . $item->cuaf . ($item->cantidad_grupo ? "(" . $item->nro_correlativo_grupo . "/" . $item->nro_correlativo_grupo . ")" : "")), " align:L;font-size:7;$bgCelda" . $borde);
                        $tabla->easyCell(utf8Decode($item->estado_actual), " align:L;font-size:7;$bgCelda" . $borde);
                        $tabla->printRow();
                    }
                } else {

                    $tabla->easyCell(utf8Decode("Sin Datos"), "align:L;font-size:7;colspan:2");
                    $tabla->printRow();
                }

                // $this->CheckPageBreak($this->getY());

            }
        } catch (\Exception $e) {
            // dd($e);
        }

        $tabla->endTable(0);



        $this->SetFont('Arial', 'B', 8);

        //crear nombre del archivo


        $this->SetTitle("Reporte Aignaciones de Activos " . date("d-m-Y"));

        return $this->Output();
    }
}
