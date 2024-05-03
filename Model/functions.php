<?php
    require_once '../Model/database.php';
    
    function getJobById($job_id) {
        $conn = getDatabaseConnexion();
        $sql = "SELECT * FROM jobs WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$job_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function isCompanyIdNotExists($company_id)
    {
        $conn = getDatabaseConnexion();
        $sql = "SELECT COUNT(*) FROM companies WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$company_id]);
        $count = $stmt->fetchColumn();
        return $count == 0;
    }
    function getJobApplicationById($application_id) {
        $conn = getDatabaseConnexion();
        $sql = "SELECT * FROM job_applications WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$application_id]);
        $job_application = $stmt->fetch(PDO::FETCH_ASSOC);
        return $job_application;
    }
    
?>