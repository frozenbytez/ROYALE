<?php
include('../../assets/php/config.php'); // Include database connection

// Check if the delete request was made
if (isset($_POST['delete_movie'])) {
    $movie_id = $_POST['movie_id'];

    // Fetch the movie title from the database to use it for the file path
    $query = "SELECT title FROM movies WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $movie_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Get the movie title
        $movie = $result->fetch_assoc();
        $movie_title = $movie['title'];

        // Delete the movie from the database
        $delete_query = "DELETE FROM movies WHERE id = ?";
        $stmt = $conn->prepare($delete_query);
        $stmt->bind_param("i", $movie_id);
        if ($stmt->execute()) {
            echo "Movie deleted successfully!";

            // Generate the file path
            $file_path = "../user/movie_details/" . strtolower(str_replace(" ", "_", $movie_title)) . ".php";

            // Try to delete the associated file
            if (file_exists($file_path)) {
                if (unlink($file_path)) {
                    echo " Movie and associated file deleted successfully!";
                } else {
                    echo " Movie deleted, but failed to delete the associated file.";
                }
            } else {
                echo " Movie deleted, but no associated file found.";
            }
        } else {
            echo "Error deleting movie.";
        }
        $stmt->close();
    } else {
        echo "Movie not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Movie</title>
    <link rel="stylesheet" href="../../assets/css/admin/admin-dashboard.css">
    <style>/* Table Styling */
.movie-table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    font-family: Arial, sans-serif;
    background-color: #f9f9f9;
}

/* Header Styling */
.movie-table thead {
    background-color: #333;
    color: #fff;
}

.movie-table th {
    padding: 10px;
    text-align: left;
}

/* Body Row Styling */
.movie-table tbody tr:nth-child(even) {
    background-color: #f2f2f2;
}

.movie-table tbody tr:hover {
    background-color: #ddd;
}

.movie-table td {
    padding: 8px;
    text-align: left;
    border: 1px solid #ddd;
}

/* Action Button Styling */
.movie-table button[type="submit"] {
    padding: 5px 10px;
    background-color: #007BFF;
    color: #fff;
    border: none;
    cursor: pointer;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.movie-table button[type="submit"]:hover {
    background-color: #0056b3;
}
</style>

</head>
<body>

<div class="sidebar">
    <ul>
        <li><a href="add_movie.php">Add Movie</a></li>
        <li><a href="delete_movie.php">Delete Movie</a></li>
        <li><a href="update_movie.php">Update Movie</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</div>

<div class="content">
    <h1>Delete Movie</h1>
    <!-- Display the movies in a table -->
    <?php
    $query = "SELECT id, title, status, genre, runtime, start_date, cinema FROM movies order by status";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "<table class='movie-table'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Page</th>
                        <th>Genre</th>
                        <th>Runtime</th>
                        <th>Showing Date</th>
                        <th>Cinema</th>
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
                     <td>{$movie['cinema']}</td>
                    

                    
                    <td>
                        <form method='POST' action='delete_movie.php'>
                            <input type='hidden' name='movie_id' value='{$movie['id']}'>
                            <button type='submit' name='delete_movie' onclick='return confirm(\"Are you sure you want to delete this movie?\");'>Delete</button>
                        </form>
                    </td>
                  </tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "No movies available to delete!";
    }
    ?>
</div>

</body>
</html>
