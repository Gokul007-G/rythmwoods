<?php
require('../connect.php');
require 'dompdf/autoload.inc.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;
use Dompdf\CanvasFactory;

// instantiate and use the dompdf class
$dompdf = new Dompdf();

// Fetch data from the database
$query11 = $con->query("select * from `meetinginsert`");

// HTML content for the table
$html = '<table border="1" cellspacing="0" cellpadding="5">
            <tr>
                <th style="width: 20px;">ID</th>
                <th style="width: 80px;">Date</th>
                <th style="width: 50px;">Time</th>
                <th style="width: 120px;">Title</th>
                <th style="width: 200px;">Description</th>
                <th style="width: 120px;">Organizer</th>
                <th style="width: 80px;">Amount</th>
				<th style="width: 80px;">Received Amount</th>
				<th style="width: 80px;">Pending Amount</th>
            </tr>';

while ($index = $query11->fetch(PDO::FETCH_ASSOC)) {
	$eventid=$index['id'];
										$totalamount=$index['amount'];
										$query12 = $con->query("SELECT *,sum(amount) as totalopaidamt FROM `eventpayment` where eventid='$eventid'");
										while ($data = $query12->fetch(PDO::FETCH_ASSOC)){
											
										$paidtotalamt=$data['totalopaidamt'];
										$pendingamt=$totalamount-$paidtotalamt;
										if($paidtotalamt!='')
											 {
												$paymentamt=$paidtotalamt;
												
											 }
											 else
											 {
												 $paymentamt=0;
											 }
    $html .= '<tr>
                <td>' . $index['id'] . '</td>
                <td>' . $index['date'] . '</td>
                <td>' . $index['time'] . '</td>
                <td>' . $index['title'] . '</td>
                <td>' . $index['description'] . '</td>
                <td>' . $index['organizer'] . '</td>
                <td>' . $index['amount'] . '</td>
				<td>' . $paymentamt . '</td>
				<td>' . $pendingamt . '</td>
              </tr>';
										}
}

$html .= '</table>';

// Render the HTML as PDF for the first page
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();

// Add a new page for the next page
$canvas = $dompdf->getCanvas();
$canvas->page_script(function ($pageNumber, $pageCount, $canvas) {
    $canvas->text(20, 20, 'Next Page Heading');
});

// Output the generated PDF to Browser
$dompdf->stream('pdfopenpge.pdf', ['Attachment' => false]);
?>
