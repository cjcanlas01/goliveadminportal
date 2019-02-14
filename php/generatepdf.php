<?php
require '../fpdf/fpdf.php';
include 'methodcontainer.php';
include 'server.php';

class PDF extends FPDF {
	function header() {
		$this->Image('../fpdf/resources/logo.png', 20, 15, 20);
		$this->SetFont('Arial','B', 14);
		$this->SetXY(48, 16);
		$this->Cell(10, 10, 'GoLive:', 0, 0, 'C');
		$this->SetXY(110, 23);
		$this->Cell(10, 10, 'Live Streaming Platform for Filipino Business Entrepreneurs', 0, 0, 'C');
		$this->Ln(18);
		$this->Cell(0, 0, '', 1, 0, 'C');
		$this->Ln(8);
	}

	function footer() {
		$this->SetY(-15);
		$this->SetFont('Arial', 'I', 8);
		$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}

	function castDateTypeWord($date) {
		return date_format(date_create($date), 'M d, Y');
	}

	function setBody($dataVars) {
		global $conn; // variable declarations

		$this->SetX(100);
		$this->SetFont('Arial','B',20);
		$this->Cell(10, 10, $dataVars['varTitle'], 0, 0, 'C');
		$this->Ln(20); $this->SetX(20);
		$this->SetFont('Arial','B', 12);
		if ($dataVars['varYearA'] != '' && $dataVars['varYearB'] == '') {
			$this->Cell(10, 10, 'Year:' . ' ' . $dataVars['varYearA'], 0, 0, 'C');
		} else if ($dataVars['varYearA'] != '' && $dataVars['varYearB'] != '') {
			$this->SetX(26);
			$this->Cell(10, 10, 'From:' . ' ' . $this->castDateTypeWord($dataVars['varYearA']) , 0, 0, 'C');
			$this->SetX(80);
			$this->Cell(10, 10, 'To:' . ' ' . $this->castDateTypeWord($dataVars['varYearB']) , 0, 0, 'C');
		}
		$this->Ln(15); $this->SetX(11); //Ln() value is 20
		$this->SetFont('Arial','B', 9);
		$this->Cell(51, 10, $dataVars['varNameA'], 1, 0, 'C');
		$this->Cell(40, 10, $dataVars['varNameB'], 1, 0, 'C');
		$this->Cell(42, 10, $dataVars['varNameC'], 1, 0, 'C');
		$this->Cell(29, 10, $dataVars['varNameD'], 1, 0, 'C');
		$this->Cell(24, 10, $dataVars['varNameE'], 1, 0, 'C');
		$this->Ln();

		$dateVar = ''; $str = '';
		if ($dataVars['varTable'] == 'RecordRequestRegistries') {
			if ($dataVars['varYearA'] != '' && $dataVars['varYearB'] != '') {
				$str = "SELECT $dataVars[varDataA] as A, $dataVars[varDataB] as B, $dataVars[varDataC] as C, $dataVars[varDataD] as D, DATE($dataVars[varDataE]) as E FROM $dataVars[varTable] WHERE DATE(Date) BETWEEN '$dataVars[varYearA]' AND '$dataVars[varYearB]'";
			}
		} else {
			if ($dataVars['varYearA'] != '' && $dataVars['varYearB'] != '') {
				$str = "SELECT $dataVars[varDataA] as A, $dataVars[varDataB] as B, $dataVars[varDataC] as C, $dataVars[varDataD] as D, DATE($dataVars[varDataE]) as E FROM $dataVars[varTable] WHERE DateCreated BETWEEN '$dataVars[varYearA]' AND '$dataVars[varYearB]' AND Role <> 'admin'";
			}
		}
		$query = $conn->query($str);
		$computed_val = 0;
		if (mysqli_num_rows($query) > 0) {
			while ($row = $query->fetch_assoc()) {
				$this->SetX(11);
				$this->SetFont('Arial','', 9);
				$this->Cell(51, 10, $row['A'], 1, 0, 'C');
				$this->Cell(40, 10, $row['B'], 1, 0, 'C');
				if ($dataVars['varTable'] == 'RecordRequestRegistries') {
					$this->Cell(42, 10, $row['C'] / 60 . " " . "Minutes", 1, 0, 'C');
					$this->Cell(29, 10, "PHP " . $row['D'], 1, 0, 'C');
				} else {
					$this->Cell(42, 10, $row['C'], 1, 0, 'C');
					$this->Cell(29, 10, $row['D'], 1, 0, 'C');
				}
				$this->Cell(24, 10, $row['E'], 1, 0, 'C');
				$computed_val += (float) str_ireplace(',', '', $row['D']);
				$this->Ln();
			}
		}
		if ($dataVars['varCond'] == 'setFoot') {
			$this->SetX(102);
			$this->SetFont('Arial','B', 11);
			$this->Cell(42, 10, 'TOTAL:', 1, 0, 'C');
			$this->Cell(53, 10, "PHP " . money_format("%i", $computed_val), 1, 0, 'C');
			$this->Ln(20);
		} else {
			$this->Ln(10);
		}
		$this->SetX(140);
		$this->SetFont('Arial','B', 11);
		$this->Cell(10, 10, 'Prepared by: ________________________________', 0, 0, 'C');
		$this->Ln(); $this->SetX(21);
		$this->SetFont('Arial','', 9);
		$str = 'Date Generated:' . ' ' . date('m-d-Y');
		$this->Cell(30, 10, $str, 0, 0, 'C');
	}
}

if (isset($_GET['yearA']) && isset($_GET['yearB']) && isset($_GET['indicator'])) {
	$yearA = $_GET['yearA'];
	$yearB = $_GET['yearB'];
	$indicator = $_GET['indicator'];

	switch ($indicator) {
		case 'userlist':
			genPDF_UL_Body($yearA, $yearB);
			break;
		case 'packagesummary':
			genPDF_PS_Body($yearA, $yearB);
			break;
	}
}

function genPDF_UL_Body($yearA, $yearB) {
	$varData = array(); //array storage for variable datas
	$generatePDF = new PDF();
	$generatePDF->AliasNbPages();
	$generatePDF->AddPage('P', 'A4', 0);
	$varData['varTitle'] = 'USERS LIST REPORT'; //choices: USERS LIST REPORT or REQUESTS SUMMARY REPORT
	$varData['varTable'] = 'Users';
	$varData['varYearA'] = $yearA;
	$varData['varYearB'] = $yearB;

	$varData['varNameA'] = 'Email';
	$varData['varNameB'] = 'Business Name';
	$varData['varNameC'] = 'Address';
	$varData['varNameD'] = 'Contact Number';
	$varData['varNameE'] = 'Date';

	$varData['varDataA'] = 'Email';
	$varData['varDataB'] = 'BusinessName';
	$varData['varDataC'] = 'Address';
	$varData['varDataD'] = 'PhoneNumber';
	$varData['varDataE'] = 'DateCreated';
	$varData['varCond'] = ''; //setFoot
	$generatePDF->SetTitle($varData['varTitle']);

	$fileName = 'UsersListReport' . ' ' . date('Y-m-d') . '.pdf';
	$generatePDF->setBody($varData);
	$generatePDF->Output('I', $fileName);
}

function genPDF_PS_Body($yearA, $yearB) {
	$varData = array(); //array storage for variable datas
	$generatePDF = new PDF();
	$generatePDF->AliasNbPages();
	$generatePDF->AddPage('P', 'A4', 0);
	$varData['varTitle'] = 'PACKAGE REQUESTS REPORT'; //choices: USERS LIST REPORT or REQUESTS SUMMARY REPORT
	$varData['varTable'] = 'RecordRequestRegistries'; //sets table name
	$varData['varYearA'] = $yearA;
	$varData['varYearB'] = $yearB;

	$varData['varNameA'] = 'Email'; //sets name for columns
	$varData['varNameB'] = 'Package Name';
	$varData['varNameC'] = 'Duration';
	$varData['varNameD'] = 'Price';
	$varData['varNameE'] = 'Date';

	$varData['varDataA'] = 'Email'; //sets table columns
	$varData['varDataB'] = 'PackageName';
	$varData['varDataC'] = 'Duration';
	$varData['varDataD'] = 'Price';
	$varData['varDataE'] = 'Date';
	$varData['varCond'] = 'setFoot'; //setFoot
	$generatePDF->SetTitle($varData['varTitle']);

	$fileName = 'PackageRequestsReport' . ' ' . date('Y-m-d') . '.pdf';
	$generatePDF->setBody($varData);
	$generatePDF->Output('I', $fileName);
}

?>