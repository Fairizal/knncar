<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'C:\xampp7\htdocs\knncar\vendor\autoload.php';

use Phpml\Classification\KNearestNeighbors;
use Phpml\Math\Distance\Minkowski;

class Test extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		$this->load->helper('url');
		$datasets = [];
		$samples = [];
		$labels = [];
		if (($handle = fopen("C:\\xampp7\htdocs\knncar\TestDataMetPen63.csv", "r")) !== FALSE) {
		    while (($data = fgetcsv($handle, 100, ",")) !== FALSE) {

		        if (!is_null($data[0])) {
		        	array_push($datasets, $data);
		        	$data[3] = (int)$data[3];
		        	$data[4] = (int)$data[4];
		        	$data[5] = (int)$data[5];
		        	if (strtoupper($data[6]) == 'MANUAL') {
						$data[6] = 1;
					} else if (strtoupper($data[6]) == 'OTOMATIS') {
						$data[6] = 2;
					} else if (strtoupper($data[6]) == 'CVT') {
						$data[6] = 3;
					} else {
						$data[6] = 4;
					}

					if (strtoupper($data[2]) == 'SPORT') {
						$data[2] = 1;
					} else if (strtoupper($data[2]) == 'KELUARGA') {
						$data[2] = 2;
					} else if (strtoupper($data[2]) == 'VAN') {
						$data[2] = 3;
					} else if (strtoupper($data[2]) == 'SUV') {
						$data[2] = 4;
					} else if (strtoupper($data[2]) == 'MINI BUS') {
						$data[2] = 5;
					} else {
						$data[2] = 6;
					}
		        	array_push($labels, $data[0] .' '.$data[1]);
		        	array_push($samples, array_slice($data, 2));
		        }
		    }
		    fclose($handle);
		}

		$testDatasets = [];
		$testDatas = [];
		for ($i=0; $i < count($datasets); $i++) { 
			if(count($testDatasets) < 15 && $i % 2 == 0) {
				array_push($testDatasets, $datasets[$i]);	
				array_push($testDatas, $samples[$i]);	
			}
		}

		$classifier = new KNearestNeighbors();
		$classifier->train($samples, $labels);
		if ($this->input->method() == 'post') {
			$hasil = $classifier->predict($testDatas);
			$correct = 0;
			for ($i=0; $i < count($testDatasets); $i++) {
				$carName = $testDatasets[$i][0] . ' ' . $testDatasets[$i][1]; 
				if($carName == $hasil[$i]) {
					$correct += 1;
				}
			}
			$akurasi = ($correct/count($testDatas)) * 100;
			$this->output->set_content_type("application/json")->set_output(json_encode(array('status'=>true, 'akurasi' => $akurasi . '%')));
		} else {
			$this->load->view('test/index');
		}
	}
}
