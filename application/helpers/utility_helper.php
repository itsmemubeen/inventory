<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


function pdf_create($html, $filename = '', $stream = FALSE)
{
    require_once("dompdf/dompdf_config.inc.php");

    $dompdf = new DOMPDF();
    //$dompdf->set_paper(DEFAULT_PDF_PAPER_SIZE, 'portrait');
    $dompdf->load_html($html);
    $dompdf->render();
    if ($stream) {
        $dompdf->stream($filename . ".pdf");
    } else {
        //write_file('./invoices/' . $filename . '.pdf', $dompdf->output());
        force_download('./invoices/' . $filename . '.pdf', $dompdf->output());
        //return $dompdf->output();
    }
}

?>