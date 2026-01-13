<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// panggil autoload dompdf nya
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
use Dompdf\Options;
class Pdfgenerator {
    public function generate($html, $filename='', $paper = '', $orientation = '', $stream=TRUE)
    {   
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        if ($stream) {
            $dompdf->stream($filename.".pdf", array("Attachment" => 0));
        } else {
            // return $dompdf->output();
            $pdf = $dompdf->output();
            // $file_location = $_SERVER['DOCUMENT_ROOT']."/projek/palawija/".$filename.".pdf";
            $file_location = FCPATH .$filename.".pdf";
            file_put_contents($file_location,$pdf);
        }

        

    }
}