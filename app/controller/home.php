<?php
// Enable error display
ini_set('display_errors', 1);
error_reporting(E_ALL);
class home extends Controller{
	// Constructor
	public function __construct(){

	}

	// Default method
	public function index($name="Juan", $age="24"){
		// Associative Arrays (arrays with keys)
		$arr_data['name'] = $name;
		$arr_data['age'] = $age;
		$arr_data['title'] = "Home Page";
		// Display page and send data
		$this->display('template/header', $arr_data);
		$this->display("home/default", $arr_data);
		$this->display('template/footer');
	}

	public function page($current_page=2, $next_page=3, $prev_page=1){
		// Associative Arrays (arrays with keys)
		$arr_data['current'] = $current_page;
		$arr_data['next'] = $next_page;
		$arr_data['previous'] = $prev_page;
		$arr_data['title'] = "Personal Page";
		// Display page and send data
		$this->display('template/header', $arr_data);
		$this->display("home/page", $arr_data);
		$this->display('template/footer');
	}

	// Get status
	private function _status(){
		echo "This is home/status.";
	}
	public function inputstudent(){
		session_start();
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$status = $this->logic("Home_model")->input_data($_POST);

			
			if($status === "SUCCESS"){
				echo "You have succesfully input new data.";
			}

			if($status === "FAILED"){
				echo "Failed!";
			}

			if($status === "ERROR"){
				echo "Error while putting data";
			}

		}else{
			echo "MUST REQUEST POST";
		}
	}
}
?>