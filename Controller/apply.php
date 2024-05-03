<?php
// Include necessary files and functions
require_once '../Model/database.php'; 
require_once '../Controller/CRUD2.php';  

// Function to redirect to 404 page
function redirectTo404() {
    $url = "http://localhost/projet/View/404.php";
    header("Location: $url");
    exit();
}

// Function to redirect to job applications page
function redirectToJobApplications() {
    $url = "http://localhost/projet/View/job-applications.php";
    header("Location: $url");
    exit();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form is for creating a new job application
    if (isset($_POST['create_application'])) {
        // Get form data
        $name = $_POST['name'];
        $email = $_POST['email'];
        $cover_letter = $_POST['cover_letter'];
        $job_id = $_POST['job_id']; // Assuming job_id is passed as hidden input in the form
        
        // Check if the customer exists, if not, create a new customer
        $customer = getCustomerByEmail($email);
        if (!$customer) {
            // Create a new customer
            createCustomer($name, $email);
            // Retrieve the newly created customer
            $customer = getCustomerByEmail($email);
        }
        
        // Create the job application
        $success = createJobApplication($job_id, $customer['customer_id'], $name, $email, $cover_letter);
        
        // Redirect to appropriate page based on success/failure
        if ($success) {
            redirectToJobApplications();
        } else {
            redirectTo404();
        }
    } 
    // Check if the form is for updating a job application
    elseif (isset($_POST['update_application'])) {
        // Update the job application
        
        // Get form data
        $application_id = $_POST['application_id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $cover_letter = $_POST['cover_letter'];
        $job_id = $_POST['job_id']; // Assuming job_id is passed as hidden input in the form
        
        // Check if the customer exists, if not, create a new customer
        $customer = getCustomerByEmail($email);
        if (!$customer) {
            // Create a new customer
            createCustomer($name, $email);
            // Retrieve the newly created customer
            $customer = getCustomerByEmail($email);
        }
        
        // Update the job application
        $success = updateJobApplication($application_id, $job_id, $customer['customer_id'], $name, $email, $cover_letter);
        
        // Redirect to appropriate page based on success/failure
        if ($success) {
            redirectToJobApplications();
        } else {
            redirectTo404();
        }
    } 
    // Check if the form is for deleting a job application
    elseif (isset($_POST['delete_application'])) {
        // Delete the job application
        
        // Get application ID
        $application_id = $_POST['application_id'];
        
        // Delete the job application
        $success = deleteJobApplication($application_id);
        
        // Redirect to appropriate page based on success/failure
        if ($success) {
            redirectToJobApplications();
        } else {
            redirectTo404();
        }
    }
}
?>
