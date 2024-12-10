<?php
include('../Asset/connection/config.php'); // database connection


if (isset($_POST['delete_movie'])) {
    $movie_id = $_POST['movie_id'];

    
    $delete_query = "DELETE FROM movies WHERE id = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $movie_id);
    if ($stmt->execute()) {
        echo "Movie deleted successfully!";
    } else {
        echo "Error deleting movie.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <title>Delete Movie</title>
    <link rel="stylesheet" href="../Asset/css/delete_movie.css">

</head>
<body>

<!-- Sidebar Toggle Button -->
<button class="toggle-sidebar-btn" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </button>

    
  <div class="sidebar p-3">
    <!--------------LOGO------------------>
    <a class="navbar-brand fs-4" href="home.html">
        <img src="../Asset/images/lllogo.png" alt="Royale Logo" style="height: 50px; width: auto;">
    </a>
    
    <!-- Navigation Menu -->
    <ul class="nav flex-column mt-4">
        <li class="nav-item">
            <a class="nav-link" href="dashboard.html"><i class="fas fa-home"></i> Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="rating_movie.php"><i class="fas fa-chart-line"></i> Analytics</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link active dropdown-toggle" href="#" id="manageMoviesDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-film"></i> Manage Movies
            </a>
            <ul class="dropdown-menu" aria-labelledby="manageMoviesDropdown">
                <li><a class="dropdown-item" href="add_movie.php">Add Movies</a></li>
                <li><a class="dropdown-item" href="update_movie.php">Update Movies</a></li>
                <li><a class="dropdown-item" href="delete_movie.php">Delete Movies</a></li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="available2.html"><i class="fas fa-play"></i> Available Movies</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#"><i class="fas fa-calendar-alt"></i> Edit Screening</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-danger" href="#"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </li>
    </ul>
</div>

    
    <!---------------------------------------------------------------ADD MOVIE CONTENT---------------------------------------------------------->
    <div class="main-content">
    <div class="container-fluid full-width-container">
        <div class="row g-0">
            <div class="col-12">
                <div class="full-width-image">
                    <img src="../Asset/images/delete-movie-bg.png" alt="Sample Image">
                </div>
            </div>
        </div>
 


    <div class="content mt-4">
        <?php
        $query = "SELECT id, title, status, genre, runtime, start_date FROM movies order by status";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            echo "<div class='table-responsive'> <!-- Responsive Wrapper -->
                    <table class='table table-striped table-bordered movie-table'>
                        <thead class='table-dark'>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Page</th>
                                <th>Genre</th>
                                <th>Runtime</th>
                                <th>Showing Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>";

            while ($movie = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$movie['id']}</td>
                        <td>{$movie['title']}</td>
                        <td>{$movie['status']}</td>
                        <td>{$movie['genre']}</td>
                        <td>{$movie['runtime']}</td>
                        <td>{$movie['start_date']}</td>
                        <td>
                            <form method='POST' action='delete_movie.php'>
                                <input type='hidden' name='movie_id' value='{$movie['id']}'>
                                <button type='submit' class='btn btn-danger btn-sm' name='delete_movie' onclick='return confirm(\"Are you sure you want to delete this movie?\");'>Delete</button>
                            </form>
                        </td>
                      </tr>";
            }

            echo "  </tbody>
                    </table>
                  </div>";
        } else {
            echo "<div class='alert alert-info'>No movies available to delete!</div>";
        }
        ?>
    </div>
</div>

<script>
    function toggleSidebar() {
    const sidebar = document.querySelector('.sidebar'); 
    sidebar.classList.toggle('open'); 
}
    </script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>