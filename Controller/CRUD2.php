<?php
require_once '../Model/database.php';

function createJobApplication($job_id, $customer_id, $name, $email, $cover_letter)
{
    $conn = getDatabaseConnexion();
    $application_date = date('Y-m-d');
    $sql = "INSERT INTO job_applications (job_id, customer_id, name, email, cover_letter, application_date) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([$job_id, $customer_id, $name, $email, $cover_letter, $application_date]);
}

function getJobApplicationsByJobId($job_id)
{
    $conn = getDatabaseConnexion();
    $sql = "SELECT * FROM job_applications WHERE job_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$job_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getJobApplicationsByCustomerId($customer_id)
{
    $conn = getDatabaseConnexion();
    $sql = "SELECT * FROM job_applications WHERE customer_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$customer_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getAllJobApplications()
{
    $conn = getDatabaseConnexion();
    $sql = "SELECT * FROM job_applications";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function updateJobApplication($application_id, $job_id, $customer_id, $name, $email, $cover_letter)
{
    $conn = getDatabaseConnexion();
    $sql = "UPDATE job_applications SET job_id = ?, customer_id = ?, name = ?, email = ?, cover_letter = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([$job_id, $customer_id, $name, $email, $cover_letter, $application_id]);
}

function deleteJobApplication($application_id)
{
    $conn = getDatabaseConnexion();
    $sql = "DELETE FROM job_applications WHERE id = ?";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([$application_id]);
}

// CRUD2.php

function getCustomerByEmail($email) {
    $conn = getDatabaseConnexion();
    $sql = "SELECT * FROM customers WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function createCustomer($name, $email) {
    $conn = getDatabaseConnexion();
    $sql = "INSERT INTO customers (name, email) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([$name, $email]);
}

function getCustomerById($customer_id)
{
    $conn = getDatabaseConnexion();
    $sql = "SELECT * FROM customers WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$customer_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function getCustomersByIds($customerIds)
{
    // Check if the input array is not empty
    if (empty($customerIds)) {
        return array();
    }

    // Prepare the SQL statement to fetch customers by IDs
    $placeholders = str_repeat('?,', count($customerIds) - 1) . '?';
    $sql = "SELECT * FROM customers WHERE id IN ($placeholders)";
    
    // Establish database connection and execute the query
    $conn = getDatabaseConnexion();
    $stmt = $conn->prepare($sql);
    $stmt->execute($customerIds);

    // Fetch and return the customers as an associative array
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>


