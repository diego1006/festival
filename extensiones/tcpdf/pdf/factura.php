<?php
require_once "../../../models/ordenes.modelo.php";
class imprimirFactura{

public $codigo;

public function traerImpresionFactura(){

$id=$this->codigo;

$respuesta = ModeloOrdenes::mdlFactura($id);
$electrodomesticos=json_decode($respuesta["electrodomesticos"], true);
$fecha=substr($respuesta["fechaIngreso"], 0, 10);
$fecha2=substr($respuesta["fechaIngreso"], 10, strlen($respuesta["fechaIngreso"]));
$newDate = date("d/m/Y", strtotime($fecha));

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);


$pdf->AddPage('P', 'A7');

//---------------------------------------------------------

$bloque1 = <<<EOF


<table style="font-size:9px; ">
    
	<tr style="text-align:center">
	    
		
		<td style="width:160px;">
		<img src="../../../img/plantilla/logo.jpeg" >
		
	
		<div>ORDEN Nº<br><strong style="font-size:20px">*** $respuesta[id] ***</strong></div>
			<div style="text-align:left">fecha impresiòn:  $newDate $fecha2 <br>
			Direcciòn: Calle 7 # 15 - 53 <br>
			Telèfono: 317 710 9424  - 566 1071</div> <br>
		</td>
		

	</tr>
	<tr  style="text-align:left">
		
		<td style="width:160px;">
			INFORMACIÒN DEL CLIENTE: 
			Nombre: $respuesta[cliente]<br>
			Tel: $respuesta[telefono] <br>
			Dir.$respuesta[direccion] <br> <br>

			INFORMACIÒN DE LA ORDEN:
			<div style="font-size:8px;">
				Asesor: $respuesta[asesor]  <br>
				Estado: $respuesta[estadoProducto]  <br>
			   
			    	 
			</div>
			<br>
			ELECTRODOMÈSTICOS:
			
			
	   
		</td>
		

	</tr>


</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

foreach ($electrodomesticos as $key => $item) {

$bloque2 = <<<EOF

<table style="font-size:9px; ">

	<tr style="text-align:left">
		
		<td style="text-align:left">
	
		
		$item[electrodomesticos] $item[marca] 
			
		</td>
		

	</tr>
	


</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');


}

$bloque3 = <<<EOF
<table style="font-size:9px; ">


	<tr  style="text-align:justify">
		<br>
		<td style="width:160px;">
			<span style="font-size:7px;text-align:center">Consulte el estado de su orden desde www.electroestufas.com ingresando el còdigo</span>
			------------------------------------------------<br>
			<span style="text-align:center">CÒDIGO: $respuesta[codigoAleatorio]  </span><br>
			-------------------------------------------------<br>

			
			
	   
		</td>
		

	</tr>


</table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

//SALIDA DEL ARCHIVO 

//$pdf->Output('factura.pdf', 'D');
$pdf->Output('factura.pdf');

}

}

$factura = new imprimirFactura();
$factura -> codigo = $_GET["codigo"];
$factura -> traerImpresionFactura();

?>