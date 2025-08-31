<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Attendance System</title>

    <link rel="icon" href="./pics/ict.png" type="image/x-icon">
    
    <!-- CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="index.css">
    
    <!-- JavaScript -->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION['login_id'])) {
        header('location:login.php');
        exit();
    }
    
    include 'db_connect.php';
    include './header.php';

    // Get company name with proper error handling
    $company_name = 'Default Name';
    $query = "SELECT name FROM users WHERE id = 1";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $company_name = htmlspecialchars($row['name']);
    }
    ?>
    
    <!-- Top Navigation Bar -->
    <?php include 'topbar.php'; ?>
    
    <div class="main-container">
        <!-- Side Navigation -->
        <?php include 'navbar.php'; ?>
        
        <!-- Main Content -->
        <main id="view-panel">
            <?php 
            $page = isset($_GET['page']) ? $_GET['page'] : 'home';
            // Validate page parameter to prevent directory traversal
            $page = preg_replace('/[^a-zA-Z0-9_]/', '', $page);
            
            // Check if the file exists before including
            $page_file = $page . '.php';
            if (file_exists($page_file)) {
                include $page_file;
            } else {
                include 'home.php'; // Default to home if page doesn't exist
            }
            ?>
        </main>
    </div>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- CONFIRMATION MODAL -->
    <div class="modal fade" id="confirm_modal" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="delete_content"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="confirm">Continue</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- UNIVERSAL MODAL -->
    <div class="modal fade" id="uni_modal" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <!-- Removed Save and Cancel buttons -->
                </div>
            </div>
        </div>
    </div>

    <!-- VIEWER MODAL -->
    <div class="modal fade" id="viewer_modal" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
                <div class="viewer-content">
                    <!-- Content will be loaded dynamically -->
                </div>
            </div>
        </div>
    </div>

    <!-- Move JavaScript to external file -->
    <script src="index.js"></script>
</body>
</html>
