<?php
require_once '../Model/database.php';
include '../Controller/job_functions.php';

function redirectToJobList() {
    $url = "http://localhost/projet/View/job-list.php";
    header("Location: $url");
    exit();
}

// Handling HTTP requests
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handling job creation
    if ($_POST["action"] == "create") {
        $title = $_POST["title"];
        $description = $_POST["description"];
        $requirements = $_POST["requirements"];
        $company_id = $_POST["company_id"];

        if (createJob($title, $description, $requirements, $company_id)) {
            echo "Job created successfully. <br>";
        } else {
            echo "Failed to create job. <br>";
        }

        // Redirecting back to the job list page
        redirectToJobList();
    }

    // Handling job update
    elseif ($_POST["action"] == "update") {
        $job_id = $_POST["job_id"];
        $title = $_POST["title"];
        $description = $_POST["description"];
        $requirements = $_POST["requirements"];
        $company_id = $_POST["company_id"];

        if (updateJob($job_id, $title, $description, $requirements, $company_id)) {
            echo "Job updated successfully. <br>";
        } else {
            echo "Failed to update job. <br>";
        }

        // Redirecting back to the job list page
        redirectToJobList();
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Handling job deletion
    if (isset($_GET["action"]) && $_GET["action"] == "delete") {
        $job_id = $_GET["job_id"];
        $company_id = $_GET["company_id"];

        if (deleteJob($job_id, $company_id)) {
            echo "Job deleted successfully. <br>";
        } else {
            echo "Failed to delete job. <br>";
        }

        // Redirecting back to the job list page
        redirectToJobList();
    }

    // Handling job application
    elseif ($_GET["action"] == "apply") {
        $job_id = $_GET["job_id"];
        $customer_id = $_GET["customer_id"];

        if (applyForJob($job_id, $customer_id)) {
            echo "Applied for job successfully. <br>";
        } else {
            echo "Failed to apply for job. <br>";
        }

        // Redirecting back to the job list page or any other appropriate page
        redirectToJobList();
    }
}
?>

