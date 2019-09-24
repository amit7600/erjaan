<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
// use setasign\Fpdi\Fpdi;
use TCPDF;

class PdfController extends Controller
{
    public function generate_pdf(Request $request)
    {	
		$no_of_response = __('message.no_of_responses');
    	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    	$pdf->SetTitle("Print chart");
    	$pdf->setPrintHeader(false);
    	$lg = Array();
		// $lg['a_meta_charset'] = 'UTF-8';
		// $lg['a_meta_dir'] = 'rtl';
		// $lg['a_meta_language'] = 'fa';
		// $lg['w_page'] = 'page';
		// $pdf->setLanguageArray($lg);
        $pdf->AddPage();
        $pdf->SetFont('dejavusans', 'B', 12);
        $pdf->setXY(10,10);
        $pdf->MultiCell(0, 10, $request->get('title'),0, 'C', 0, 0, '', '', true);
        $img_base64_encoded = $request->get('imgData');

		$img = '<img src="@' . preg_replace('#^data:image/[^;]+;base64,#', '', $img_base64_encoded) . '">';

		$pdf->SetFont('dejavusans', 'B', 9);
		$pdf->setXY(10,20);
		$pdf->writeHTML($img, true, false, true, false, '');
		$pdf->MultiCell(0, 5, $no_of_response.' : '.$request->get('response'),0, 'C', 0, 0, '', '', true);
		
		$pdf->SetFont('dejavusans', '', 8);
		//this section for left side filter
		if($request->get('user')){
		$pdf->setXY(50,$pdf->getY()+10);
			$pdf->MultiCell(0, 5, __('message.user').' : '.$request->get('user'),0, '', 0, 0, '', '', true);
		}
		if($request->get('city')){
			$pdf->setXY(130,$pdf->getY());
			$pdf->MultiCell(0, 5, __('message.location').' : '.$request->get('city'),0, '', 0, 0, '', '', true);
		}
		if($request->get('type')){
		$pdf->setXY(50,$pdf->getY()+5);
			$pdf->MultiCell(0, 5, __('message.type').' : '.$request->get('type'),0, '', 0, 0, '', '', true);
		}
		if($request->get('group')){
			$pdf->setXY(130,$pdf->getY());
			$pdf->MultiCell(0, 5, __('message.group').' : '.$request->get('group'),0, '', 0, 0, '', '', true);
		}
		if($request->get('category')){
		$pdf->setXY(50,$pdf->getY()+5);
			$pdf->MultiCell(0, 5, __('message.category').' : '.$request->get('category'),0, '', 0, 0, '', '', true);
		}
		if($request->get('sub_category')){
			$pdf->setXY(130,$pdf->getY());
			$pdf->MultiCell(0, 5, __('message.sub_category').' : '.$request->get('sub_category'),0, '', 0, 0, '', '', true);
		}
		if($request->get('time_period')){
		$pdf->setXY(50,$pdf->getY()+5);
			$pdf->MultiCell(0, 5, __("message.time_period").' : '.$request->get('time_period'),0, '', 0, 0, '', '', true);
		}		
		if($request->get('select_chart_type')){
			$pdf->setXY(130,$pdf->getY());
			$chartType = $request->get('select_chart_type') == 1  ? __("message.bar_chart"): __("message.pie_chart");
			$pdf->MultiCell(0, 5, __('message.chart_type').' : '.$chartType,0, '', 0, 0, '', '', true);
		}
		if($request->get('created_from')){
			$pdf->setXY(50,$pdf->getY()+5);
			$pdf->MultiCell(0, 5, __('message.created_from').' : '.$request->get('created_from'),0, '', 0, 0, '', '', true);
		}
		if($request->get('created_to')){
			$pdf->setXY(130,$pdf->getY());
			$pdf->MultiCell(0, 5, __('message.created_to').' : '.$request->get('created_to'),0, '', 0, 0, '', '', true);
		}


       	$pdf->setRTL(false);
        $filename="pdf/test.pdf";
        $pdf->Output(public_path($filename),'F');
		$url = url('/pdf/test.pdf');
    	return response()->json([
            'success' => true,
            'url' => $url
        ],200);
    }
}
