<?php
// Enable error display
ini_set('display_errors', 1);
error_reporting(E_ALL);
class Home_model {
    private $db;
    public function __construct() {
        // Create object from Database class
        $this->db = new Database();
        // Check status
        if ($this->db == false) {
            echo "<script>console.log('Connection failed.');</script>";
        } else {
            echo "<script>console.log('Connected successfully.');</script>";
        }
    }
    public function input_data($data) {
        try {
            // Check if all required fields are present
            if(!isset($data['reg_number']) || !isset($data['nim_number']) || 
               !isset($data['email']) || !isset($data['fullname']) || !isset($data['password'])) {
                return "FAILED"; // Missing required fields
            }
            
            // Validate user input - don't use escape_string since it doesn't exist
            $reg_number = $data['reg_number'];
            $nim_number = $data['nim_number'];
            $email = $data['email'];
            $fullname = $data['fullname'];
            $password = password_hash($data['password'], PASSWORD_DEFAULT);
            
            // Set timezone
            date_default_timezone_set('Asia/Makassar');
            $datanow = date("Y-m-d H:i:s");
            
            // Insert SQL query with proper quoting
            $sql = "INSERT INTO tbl_students (reg_number, nim_number, email, fullname, password, created_at, updated_at) 
                    VALUES ('$reg_number', '$nim_number', '$email', '$fullname', '$password', '$datanow', '$datanow')";
            
            // Execute query
            if ($this->db->query($sql) === TRUE) {
                return "SUCCESS";
            } else {
                // Log the error for debugging
                error_log("Database error: " . $this->db->error);
                return "FAILED";
            }
        } catch (Exception $e) {
            error_log("Exception: " . $e->getMessage());
            return "ERROR";
        }
    }
} // This closing brace was missing
?>