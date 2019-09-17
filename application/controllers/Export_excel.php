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
		$ucpos_data = $this->Performance_appraisal_model->export_excel();
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
        $sheet->setCellValue('I1', 'Joining Date');      
        $sheet->setCellValue('J1', 'PEO Name');      
        $sheet->setCellValue('K1', 'AC Name');      
        $sheet->setCellValue('L1', 'Start Date');      
        $sheet->setCellValue('M1', 'End Date');      
        $sheet->setCellValue('N1', 'Evaluation Date');      
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
            $sheet->setCellValue('I' . $rows, $val['join_date']);
            $sheet->setCellValue('J' . $rows, $val['peo_name']);
            $sheet->setCellValue('K' . $rows, $val['ac_name']);
            $sheet->setCellValue('L' . $rows, $val['start_date']);
            $sheet->setCellValue('M' . $rows, $val['end_date']);
            $sheet->setCellValue('N' . $rows, $val['created_at']);
            $rows++;
        } 
        $writer = new Xlsx($spreadsheet);
		$writer->save("upload/".$fileName);
		header("Content-Type: application/vnd.ms-excel");
        redirect(base_url()."/upload/".$fileName);              
    }
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
        $sheet->setCellValue('I1', 'Joining Date');      
        $sheet->setCellValue('J1', 'PEO Name');      
        $sheet->setCellValue('K1', 'AC Name');      
        $sheet->setCellValue('L1', 'Start Date');      
        $sheet->setCellValue('M1', 'End Date');      
        $sheet->setCellValue('N1', 'Evaluation Date');      
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
            $sheet->setCellValue('I' . $rows, $val['join_date']);
            $sheet->setCellValue('J' . $rows, $val['peo_name']);
            $sheet->setCellValue('K' . $rows, $val['ac_name']);
            $sheet->setCellValue('L' . $rows, $val['start_date']);
            $sheet->setCellValue('M' . $rows, $val['end_date']);
            $sheet->setCellValue('N' . $rows, $val['created_at']);
            $rows++;
        } 
        $writer = new Xlsx($spreadsheet);
		$writer->save("upload/".$fileName);
		header("Content-Type: application/vnd.ms-excel");
        redirect(base_url()."/upload/".$fileName);              
    }
}







?>