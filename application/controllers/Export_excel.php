<?php defined('BASEPATH') OR exit('No direct script access allowed!');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Export_excel extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('Performance_appraisal_model');
	}
	// Export to Excel (TCSP's)
	public function createExcel() {
		$fileName = 'tcsps.xlsx';  
		$tcsps_data = $this->Performance_appraisal_model->export_excel();
		$spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();
      $sheet->setCellValue('A1', 'Emp ID');
      $sheet->setCellValue('B1', 'Name');
      $sheet->setCellValue('C1', 'Position');
      $sheet->setCellValue('D1', 'Province');
	   $sheet->setCellValue('E1', 'District');
      $sheet->setCellValue('F1', 'Tehsil');      
      $sheet->setCellValue('G1', 'UC');      
      $sheet->setCellValue('H1', 'CNIC');      
      $sheet->setCellValue('I1', 'UC/Area level Micro-plans development and desk revision');      
      $sheet->setCellValue('J1', 'UC/Area level Micro-plans field validation');      
      $sheet->setCellValue('K1', 'Status of selection of the house to house vaccination teams');      
      $sheet->setCellValue('L1', '% of teams training attended');      
      $sheet->setCellValue('M1', 'Training of the UC supervisors (Area In-charges)');      
      $sheet->setCellValue('N1', 'Pre campaign data collection, collation and timely transmission to the next level % timeliness and % completeness');
      $sheet->setCellValue('O1', 'Data collection, collation and timely transmission to the next level during the campaign % timeliness and % completeness');
      $sheet->setCellValue('P1', 'Corrective measures following the identification of the gaps. Number of critical siuation handled');
      $sheet->setCellValue('Q1', 'Ensure data collection from the field with more than 95% Post Campaign coverages through extensive monitoring in the field by doing LQAS & Market Surveys');
      $sheet->setCellValue('R1', 'To establish the community AFP Surveillance in his area of assignment through regular health facility visits and ensure that the zero reports are timely been submitted');
      $sheet->setCellValue('S1', 'Reliability');
      $sheet->setCellValue('T1', 'Work independently with minimal supervision');
      $sheet->setCellValue('U1', 'Punctuality');
      $sheet->setCellValue('V1', 'Initiative');
      $sheet->setCellValue('W1', 'Good team player');
      $sheet->setCellValue('X1', 'Fimiliarity with WHO required procedures');
      $sheet->setCellValue('Y1', 'Overall Assessment');
      $sheet->setCellValue('Z1', 'TCSP Remarks');
      $sheet->setCellValue('AA1', 'AC Remarks');
      $rows = 2;
        foreach ($tcsps_data as $val){
            $sheet->setCellValue('A' . $rows, $val['id']);
            $sheet->setCellValue('B' . $rows, $val['name']);
            $sheet->setCellValue('C' . $rows, $val['position']);
            $sheet->setCellValue('D' . $rows, $val['province']);
            $sheet->setCellValue('E' . $rows, $val['district']);
	    	   $sheet->setCellValue('F' . $rows, $val['tehsil']);
            $sheet->setCellValue('G' . $rows, $val['uc']);
            $sheet->setCellValue('H' . $rows, $val['cnic_name']);
            $sheet->setCellValue('I' . $rows, $val['que_one']);
            $sheet->setCellValue('J' . $rows, $val['que_two']);
            $sheet->setCellValue('K' . $rows, $val['que_three']);
            $sheet->setCellValue('L' . $rows, $val['que_four']);
            $sheet->setCellValue('M' . $rows, $val['que_five']);
            $sheet->setCellValue('N' . $rows, $val['que_six']);
            $sheet->setCellValue('O' . $rows, $val['que_seven']);
            $sheet->setCellValue('P' . $rows, $val['que_eight']);
            $sheet->setCellValue('Q' . $rows, $val['que_nine']);
            $sheet->setCellValue('R' . $rows, $val['que_ten']);
            $sheet->setCellValue('S' . $rows, $val['attrib_1']);
            $sheet->setCellValue('T' . $rows, $val['attrib_2']);
            $sheet->setCellValue('U' . $rows, $val['attrib_3']);
            $sheet->setCellValue('V' . $rows, $val['attrib_4']);
            $sheet->setCellValue('W' . $rows, $val['attrib_5']);
            $sheet->setCellValue('X' . $rows, $val['attrib_6']);
            $sheet->setCellValue('Y' . $rows, $val['comment_2']);
            $sheet->setCellValue('Z' . $rows, $val['comment']);
            $sheet->setCellValue('AA' . $rows, $val['assessment_result']);
            $rows++;
        } 
      $writer = new Xlsx($spreadsheet);
   	$writer->save("upload/".$fileName);
   	header("Content-Type: application/vnd.ms-excel");
      redirect(base_url()."/upload/".$fileName);              
    }
// --------------------------------------- Export excel UCPO's ------------------------------------- //
    // Export to Excel (UCPO's).
    public function exportExcel() {
		$fileName = 'ucpos.xlsx';  
		$ucpos_data = $this->Performance_appraisal_model->export_excel_ucpos();
		$spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();
      $sheet->setCellValue('A1', 'Emp ID');
      $sheet->setCellValue('B1', 'Name');
      $sheet->setCellValue('C1', 'Position');
      $sheet->setCellValue('D1', 'Province');
		$sheet->setCellValue('E1', 'District');
      $sheet->setCellValue('F1', 'Tehsil');      
      $sheet->setCellValue('G1', 'UC');      
      $sheet->setCellValue('H1', 'CNIC');      
      $sheet->setCellValue('I1', 'UC/Area level Micro-plans development and desk revision');      
      $sheet->setCellValue('J1', 'UC/Area level Micro-plans field validation');      
      $sheet->setCellValue('K1', 'Status of selection of the house to house vaccination teams');      
      $sheet->setCellValue('L1', 'Training of the vaccination teams');      
      $sheet->setCellValue('M1', 'Training of the UC supervisors (Area In-charges)');      
      $sheet->setCellValue('N1', 'Pre campaign data collection, collation and timely transmission to the next level');    
      $sheet->setCellValue('O1', 'Data collection, collation and timely transmission to the next level during the campaign');
      $sheet->setCellValue('P1', 'Corrective measures following the identification of the gaps');
      $sheet->setCellValue('Q1', 'Reliability');
      $sheet->setCellValue('R1', 'Work independently with minimal supervision');
      $sheet->setCellValue('S1', 'Punctuality');
      $sheet->setCellValue('T1', 'Initiative');
      $sheet->setCellValue('U1', 'Good team player');
      $sheet->setCellValue('V1', 'Familiarity with WHO required procedures');
      $sheet->setCellValue('W1', 'Overall Assessment');
      $sheet->setCellValue('X1', 'UCPO Remarks');
      $sheet->setCellValue('Y1', 'AC Remarks');
      $rows = 2;
      foreach ($ucpos_data as $val){
         $sheet->setCellValue('A' . $rows, $val['id']);
         $sheet->setCellValue('B' . $rows, $val['name']);
         $sheet->setCellValue('C' . $rows, $val['position']);
         $sheet->setCellValue('D' . $rows, $val['province']);
         $sheet->setCellValue('E' . $rows, $val['district']);
    	   $sheet->setCellValue('F' . $rows, $val['tehsil']);
         $sheet->setCellValue('G' . $rows, $val['uc']);
         $sheet->setCellValue('H' . $rows, $val['cnic_name']);
         $sheet->setCellValue('I' . $rows, $val['que_one']);
         $sheet->setCellValue('J' . $rows, $val['que_two']);
         $sheet->setCellValue('K' . $rows, $val['que_three']);
         $sheet->setCellValue('L' . $rows, $val['que_four']);
         $sheet->setCellValue('M' . $rows, $val['que_five']);
         $sheet->setCellValue('N' . $rows, $val['que_six']);
         $sheet->setCellValue('O' . $rows, $val['que_seven']);
         $sheet->setCellValue('P' . $rows, $val['que_eight']);
         $sheet->setCellValue('Q' . $rows, $val['attrib_1']);
         $sheet->setCellValue('R' . $rows, $val['attrib_2']);
         $sheet->setCellValue('S' . $rows, $val['attrib_3']);
         $sheet->setCellValue('T' . $rows, $val['attrib_4']);
         $sheet->setCellValue('U' . $rows, $val['attrib_5']);
         $sheet->setCellValue('V' . $rows, $val['attrib_6']);
         $sheet->setCellValue('W' . $rows, $val['comment_2']);
         $sheet->setCellValue('X' . $rows, $val['comment']);
         $sheet->setCellValue('Y' . $rows, $val['assessment_result']);
         $rows++;
        } 
        $writer = new Xlsx($spreadsheet);
		  $writer->save("upload/".$fileName);
		  header("Content-Type: application/vnd.ms-excel");
        redirect(base_url()."/upload/".$fileName);              
    }
    // ------------------------- Export to excel the pending UCPO's reports --------------------------- //
    // UCPO's
    public function ucpos_report() {
      $fileName = 'ucpos_report.xlsx';  
      $tcsps_data = $this->Performance_appraisal_model->ucpos_report();
      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();
      $sheet->setCellValue('A1', 'Province');
      $sheet->setCellValue('B1', 'District');
      $sheet->setCellValue('C1', 'UC');
      $sheet->setCellValue('D1', 'UCPO Name');
      $sheet->setCellValue('E1', 'UCPO CNIC');
      $sheet->setCellValue('F1', 'PEO Name');      
      $sheet->setCellValue('G1', 'PEO CNIC');      
      $sheet->setCellValue('H1', 'AC Name');      
      $sheet->setCellValue('I1', 'AC CNIC');      
      $rows = 2;
        foreach ($tcsps_data as $val){
            $sheet->setCellValue('A' . $rows, $val['province']);
            $sheet->setCellValue('B' . $rows, $val['district']);
            $sheet->setCellValue('C' . $rows, $val['uc']);
            $sheet->setCellValue('D' . $rows, $val['name']);
            $sheet->setCellValue('E' . $rows, $val['cnic_name']);
            $sheet->setCellValue('F' . $rows, $val['peo_name']);
            $sheet->setCellValue('G' . $rows, $val['peo_cnic']);
            $sheet->setCellValue('H' . $rows, $val['ac_name']);
            $sheet->setCellValue('I' . $rows, $val['ac_cnic']);
            $rows++;
        } 
      $writer = new Xlsx($spreadsheet);
      $writer->save("upload/".$fileName);
      header("Content-Type: application/vnd.ms-excel");
      redirect(base_url()."/upload/".$fileName);              
    }
    // TCSP's
    public function tcsps_report() {
      $fileName = 'tcsps_report.xlsx';  
      $tcsps_data = $this->Performance_appraisal_model->tcsps_report();
      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();
      $sheet->setCellValue('A1', 'Province');
      $sheet->setCellValue('B1', 'District');
      $sheet->setCellValue('C1', 'UC');
      $sheet->setCellValue('D1', 'TCSP Name');
      $sheet->setCellValue('E1', 'TCSP CNIC');
      $sheet->setCellValue('F1', 'PEO Name');      
      $sheet->setCellValue('G1', 'PEO CNIC');      
      $sheet->setCellValue('H1', 'AC Name');      
      $sheet->setCellValue('I1', 'AC CNIC');      
      $rows = 2;
        foreach ($tcsps_data as $val){
            $sheet->setCellValue('A' . $rows, $val['province']);
            $sheet->setCellValue('B' . $rows, $val['district']);
            $sheet->setCellValue('C' . $rows, $val['uc']);
            $sheet->setCellValue('D' . $rows, $val['name']);
            $sheet->setCellValue('E' . $rows, $val['cnic_name']);
            $sheet->setCellValue('F' . $rows, $val['peo_name']);
            $sheet->setCellValue('G' . $rows, $val['peo_cnic']);
            $sheet->setCellValue('H' . $rows, $val['ac_name']);
            $sheet->setCellValue('I' . $rows, $val['ac_cnic']);
            $rows++;
        } 
      $writer = new Xlsx($spreadsheet);
      $writer->save("upload/".$fileName);
      header("Content-Type: application/vnd.ms-excel");
      redirect(base_url()."/upload/".$fileName);              
    }
}


?>