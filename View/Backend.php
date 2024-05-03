//placeholder
<?php
    // Include necessary files and functions
    require_once '../Model/database.php'; 
    require_once '../Controller/job_functions.php';

    // Fetch job data from the database
    $jobs = getAllJobs();

    // Start HTML content
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job List</title>
</head>
<body>
        <!-- Header to jump to job-list.php -->
        <h1>Job List</h1>
        <a href="job-list.php">View Job List</a>
        <h1>Tables</h1>
        <a href="tables.php">View Tables</a>

    <!-- Form to create a new job -->
    <h2>Create New Job</h2>
    <form method="post" action="../Controller/job_actions.php">
        <input type="hidden" name="action" value="create">
        <input type="text" name="title" placeholder="Title" required><br>
        <textarea name="description" placeholder="Description" required></textarea><br>
        <textarea name="requirements" placeholder="Requirements" required></textarea><br>
        <input type="number" name="company_id" placeholder="Company ID" required><br>
        <input type="submit" name="submit" value="Create Job">
    </form>

    <hr>

    <!-- List of existing jobs -->
    <h2>Existing Jobs</h2>
    <?php if (!empty($jobs)) : ?>
        <ul>
            <?php foreach ($jobs as $job) : ?>
                <li>
                    <strong><?php echo $job['title']; ?></strong><br>
                    Description: <?php echo $job['description']; ?><br>
                    Requirements: <?php echo $job['requirements']; ?><br>
                    Company ID: <?php echo $job['company_id']; ?><br>
                    <!-- Form to update a job -->
                    <form method="post" action="../Controller/job_actions.php">
                        <input type="hidden" name="action" value="update">
                        <input type="hidden" name="job_id" value="<?php echo $job['id']; ?>">
                        <input type="text" name="title" placeholder="Title" value="<?php echo $job['title']; ?>" required><br>
                        <textarea name="description" placeholder="Description" required><?php echo $job['description']; ?></textarea><br>
                        <textarea name="requirements" placeholder="Requirements" required><?php echo $job['requirements']; ?></textarea><br>
                        <input type="number" name="company_id" placeholder="Company ID" value="<?php echo $job['company_id']; ?>" required><br>
                        <input type="submit" name="submit" value="Update Job">
                    </form>

                    <!-- Form to delete a job -->
                    <form method="get" action="../Controller/job_actions.php">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="job_id" value="<?php echo $job['id']; ?>">
                        <input type="hidden" name="company_id" value="<?php echo $job['company_id']; ?>">
                        <input type="submit" value="Delete Job">
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p>No jobs found.</p>
    <?php endif; ?>
</body>
</html>









