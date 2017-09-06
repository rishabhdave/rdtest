<?php error_reporting(E_ALL);
//ini_set('memory_limit','1024M');
$content=file_get_contents('temporary2.html');

$content = preg_replace('/>\s+</', "><", $content);

echo $content;
//exit;
include_once('dompdf/autoload.inc.php');
 $dompdf = new Dompdf\Dompdf();
    $options =new Dompdf\Options();
    $options->setIsRemoteEnabled(true);
    $options->isPhpEnabled(true);
    $dompdf->setOptions($options);

 $dompdf->loadHtml($content);

    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('letter', 'landscape');

        $dompdf->set_option('dpi', '113');
		  //$dompdf->set_option('defaultMediaType', 'print');
		//$context = stream_context_create([ 
//	'ssl' => [ 
//		'verify_peer' => FALSE, 
//		'verify_peer_name' => FALSE,
//		'allow_self_signed'=> TRUE 
//	] 
//]);
//$dompdf->setHttpContext($context);

    // Render the HTML as PDF
    $dompdf->render();         
		
    //$dompdf->stream('test.pdf',array('compress'=>0));
$output = $dompdf->output(array('compress'=>1));
   file_put_contents('Brochure.pdf', $output);