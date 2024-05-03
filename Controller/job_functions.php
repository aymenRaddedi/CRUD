<?php
require_once '../Model/database.php';

function createJob($title, $description, $requirements, $company_id)
{
    $conn = getDatabaseConnexion();
    $sql = "INSERT INTO jobs (title, description, requirements, company_id) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([$title, $description, $requirements, $company_id]);
}

function deleteJob($job_id, $company_id)
{
    $conn = getDatabaseConnexion();
    $sql = "DELETE FROM jobs WHERE id = ? AND company_id = ?";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([$job_id, $company_id]);
}

function getAllJobs()
{
    $conn = getDatabaseConnexion();
    $sql = "SELECT * FROM jobs";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function applyForJob($job_id, $customer_id)
{
    $conn = getDatabaseConnexion();
    $sql = "INSERT INTO job_applications (job_id, customer_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([$job_id, $customer_id]);
}

function updateJob($job_id, $title, $description, $requirements, $company_id)
{
    $conn = getDatabaseConnexion();
    $sql = "UPDATE jobs SET title = ?, description = ?, requirements = ?, company_id = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([$title, $description, $requirements, $company_id, $job_id]);
}
