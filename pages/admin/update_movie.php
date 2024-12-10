<?php
include('../../assets/php/config.php'); // Include database connection

$movie = null;  // Ensure movie is initialized
$update_message = '';  // Initialize update_message

// Fetch movie details based on ID
if (isset($_POST['fetch_movie']) && isset($_POST['movie_id'])) {
    $movie_id = $_POST['movie_id'];

    // Prepare and execute the query to fetch the movie by ID
    $query = "SELECT * FROM movies WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $movie_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $movie = $result->fetch_assoc(); // Set $movie with the result
    } else {
        $update_message = "Movie not found."; // Set error message if no movie is found
    }
}

// Update movie details if the update form is submitted
if (isset($_POST['update_movie']) && isset($_POST['movie_id'])) {
    $movie_id = $_POST['movie_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $runtime = $_POST['runtime'];
    $director = $_POST['director'];
    $cast = $_POST['cast'];
    $rating = $_POST['rating'];
    $trailer_link = $_POST['trailer_link'];
    $status = $_POST['status'];

    // New fields for start_date, end_date, time1, time2, time3
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $time1 = $_POST['time1'];
    $time2 = $_POST['time2'];
    $time3 = $_POST['time3'];

    // Handle image upload
    $image_url = isset($movie['image_url']) ? $movie['image_url'] : ''; // Default to current image if not uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_name = mysqli_real_escape_string($conn, $_FILES['image']['name']);  // Sanitize image file name
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_ext = pathinfo($image_name, PATHINFO_EXTENSION);
        $image_new_name = uniqid('movie_', true) . '.' . $image_ext;
        $image_dir = '../../assets/images/' . $image_new_name;

        // Move the uploaded image to the target directory
        if (move_uploaded_file($image_tmp, $image_dir)) {
            $image_url = $image_new_name;
        } else {
            $update_message = "Error uploading image.";
        }
    }

    // Update the movie in the database
    $update_query = "UPDATE movies SET title = ?, description = ?, runtime = ?, director = ?, cast = ?, rating = ?, trailer_link = ?, status = ?, start_date = ?, end_date = ?, time1 = ?, time2 = ?, time3 = ?, image_url = ? WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("ssssssssssssssi", $title, $description, $runtime, $director, $cast, $rating, $trailer_link, $status, $start_date, $end_date, $time1, $time2, $time3, $image_url, $movie_id);
    
    if ($stmt->execute()) {
        $update_message = "Movie updated successfully!";
    } else {
        $update_message = "Error updating movie.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Movie</title>
    <link rel="stylesheet" href="../../assets/css/admin/admin-dashboard.css">
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
    <h1>Update Movie</h1>

    <!-- Display success or error message -->
    <?php if ($update_message): ?>
        <div class="feedback-message">
            <?php echo $update_message; ?>
        </div>
    <?php endif; ?>

    <!-- Form to enter movie ID and fetch details -->
    <form method="POST" action="update_movie.php">
    <label for="movie_id">Enter Movie ID:</label>
    <input type="text" name="movie_id" value="<?php echo isset($_POST['movie_id']) ? $_POST['movie_id'] : ''; ?>" required>
    <button type="submit" name="fetch_movie">Fetch Movie Details</button>
    </form>

    <!-- Display and edit movie details if found -->
    <?php if ($movie): ?>
        <form method="POST" action="update_movie.php" enctype="multipart/form-data">
        <input type="hidden" name="movie_id" value="<?php echo $movie['id']; ?>">

        <label for="title">Title:</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($movie['title']); ?>" required>

        <label for="description">Description:</label>
        <textarea name="description" required><?php echo htmlspecialchars($movie['description']); ?></textarea>

        <label for="runtime">Runtime:</label>
        <input type="text" name="runtime" value="<?php echo htmlspecialchars($movie['runtime']); ?>" required>

        <label for="director">Director:</label>
        <input type="text" name="director" value="<?php echo htmlspecialchars($movie['director']); ?>" required>

        <label for="cast">Cast:</label>
        <input type="text" name="cast" value="<?php echo htmlspecialchars($movie['cast']); ?>" required>

        <label for="rating">Rating:</label>
        <input type="text" name="rating" value="<?php echo htmlspecialchars($movie['rating']); ?>" required>

        <label for="trailer_link">Trailer Link:</label>
        <input type="url" name="trailer_link" value="<?php echo htmlspecialchars($movie['trailer_link']); ?>" required>

        <label for="status">Status:</label>
        <select name="status" required>
            <option value="nowshowing" <?php echo ($movie['status'] == 'nowshowing') ? 'selected' : ''; ?>>Now Showing</option>
            <option value="comingsoon" <?php echo ($movie['status'] == 'comingsoon') ? 'selected' : ''; ?>>Coming Soon</option>
            <option value="index" <?php echo ($movie['status'] == 'index') ? 'selected' : ''; ?>>Home</option>
        </select>

       

        <label for="end_date">End Date:</label>
        <input type="date" name="end_date" value="<?php echo htmlspecialchars($movie['end_date']); ?>" required>

        <label for="time1">Airing Time 1:</label>
        <input type="time" name="time1" value="<?php echo htmlspecialchars($movie['time1']); ?>" required>

        <label for="time2">Airing Time 2:</label>
        <input type="time" name="time2" value="<?php echo htmlspecialchars($movie['time2']); ?>" required>

        <label for="time3">Airing Time 3:</label>
        <input type="time" name="time3" value="<?php echo htmlspecialchars($movie['time3']); ?>" required>

        <label for="image">Image:</label>
        <input type="file" name="image">

        <button type="submit" name="update_movie">Update Movie</button>
        </form>
    <?php endif; ?>
</div>

</body>
</html>

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

<div class="content">
    
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