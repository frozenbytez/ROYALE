<?php
include('../../assets/php/config.php'); // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get movie details from the form
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $runtime = mysqli_real_escape_string($conn, $_POST['runtime']);
    $director = mysqli_real_escape_string($conn, $_POST['director']);
    $cast = mysqli_real_escape_string($conn, $_POST['cast']);
    $rating = mysqli_real_escape_string($conn, $_POST['rating']);
    $genre = mysqli_real_escape_string($conn, $_POST['genre']);
    $trailer_link = mysqli_real_escape_string($conn, $_POST['trailer_link']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    // Get airing details
    $start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
    $end_date = mysqli_real_escape_string($conn, $_POST['end_date']);
    $time1 = mysqli_real_escape_string($conn, $_POST['time1']);
    $time2 = mysqli_real_escape_string($conn, $_POST['time2']);
    $time3 = mysqli_real_escape_string($conn, $_POST['time3']);

    // Get cinema selection
    $cinema = intval($_POST['cinema']); // Ensure it's an integer

    // Check if a movie is already assigned to the selected cinema
    $cinema_check_query = "SELECT * FROM movies WHERE cinema = $cinema AND status = 'nowshowing'";
    $cinema_check_result = mysqli_query($conn, $cinema_check_query);

    if (mysqli_num_rows($cinema_check_result) > 0) {
        echo "Error: Cinema $cinema already has a movie assigned. Please choose a different cinema.";
    } else {
        // Handle image upload
        $image_url = ''; // Default empty value for image
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $image_name = mysqli_real_escape_string($conn, $_FILES['image']['name']);
            $image_tmp = $_FILES['image']['tmp_name'];
            $image_ext = pathinfo($image_name, PATHINFO_EXTENSION);
            $image_new_name = uniqid('movie_', true) . '.' . $image_ext;
            $image_dir = '../../assets/images/' . $image_new_name;

            if (!is_dir('../../assets/images')) {
                mkdir('../../assets/images', 0777, true);
            }

            if (move_uploaded_file($image_tmp, $image_dir)) {
                $image_url = $image_new_name;
            } else {
                echo "Error uploading image.";
            }
        }

        // Insert movie into the database
        $query = "INSERT INTO movies (title, status, image_url, trailer_link, runtime, description, director, cast, rating, genre, start_date, end_date, time1, time2, time3, cinema)
                  VALUES ('$title', '$status', '$image_url', '$trailer_link', '$runtime', '$description', '$director', '$cast', '$rating', '$genre', '$start_date', '$end_date', '$time1', '$time2', '$time3', $cinema)";

        if (mysqli_query($conn, $query)) {
            $movie_id = mysqli_insert_id($conn);
            $rows = 5;
            $columns = 10;
            $dates = new DatePeriod(
                new DateTime($start_date),
                new DateInterval('P1D'),
                new DateTime($end_date)
            );
    
            $times = array_filter([$time1, $time2, $time3]);
    
            // Prepare the seats insertion statement
            $seat_stmt = $conn->prepare("INSERT INTO movie_seats (movie_id, date, time, seat_row, seat_col, status) VALUES (?, ?, ?, ?, ?, 'available')");
    
            // Loop through each date
            foreach ($dates as $date) {
                $formatted_date = $date->format('Y-m-d');
                
                // Loop through each time
                foreach ($times as $time) {
                    // Loop through rows and columns to create seats
                    for ($row = 1; $row <= $rows; $row++) {
                        for ($col = 1; $col <= $columns; $col++) {
                            $seat_stmt->bind_param(
                                "issii", 
                                $movie_id, 
                                $formatted_date, 
                                $time, 
                                $row, 
                                $col
                            );
                            $seat_stmt->execute();
                        }
                    }
                }
            }
    
            // Close the prepared statement
            $seat_stmt->close();
            echo "Movie and seats successfully added!";
        } else {
            echo "Error inserting movie into the database: " . mysqli_error($conn);
        }
    }
}

// Fetch movies for the selected page (status)
$status_filter = isset($_POST['status']) ? $_POST['status'] : 'nowshowing'; // Default to 'nowshowing'
$query = "SELECT id, title, genre, runtime, start_date, status FROM movies WHERE status = '$status_filter' ORDER BY start_date";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Add Movie</title>
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
    <h1>Add Movie</h1>
    <form action="add_movie.php" method="POST" enctype="multipart/form-data" id="addMovieForm">
        <!-- Movie Title Validation -->
        <label for="title">Movie Title:</label>
        <input type="text" name="title" id="title" placeholder="Movie Title" required pattern="^[a-zA-Z0-9\s,'-]+$" title="Title can only contain letters, numbers, spaces, commas, apostrophes, and hyphens.">

        <!-- Description Validation -->
        <label for="description">Description:</label>
        <textarea name="description" id="description" placeholder="Movie Description" required minlength="20" title="Description must be at least 20 characters long."></textarea>

        <!-- Director Validation -->
        <label for="director">Director:</label>
        <input type="text" name="director" id="director" placeholder="Director" required pattern="^[a-zA-Z\s]+$" title="Director name can only contain letters and spaces.">

        <!-- Cast Validation -->
        <label for="cast">Cast:</label>
        <input type="text" name="cast" id="cast" placeholder="Cast" required pattern="^[a-zA-Z\s,]+$" title="Cast names can only contain letters, spaces, and commas.">

        <!-- Rating Validation -->
        <label for="rating">Rating:</label>
        <label for="rating">Age Rating:</label>
        <input type="text" name="rating" id="rating" placeholder="e.g., G, PG, PG-13, R" required pattern="^(G|PG|PG-13|R|NC-17|Unrated)$" title="Please enter a valid age rating (e.g., G, PG, PG-13, R, NC-17, Unrated).">


        <!-- Genre Validation -->
        <label for="genre">Genre:</label>
        <input type="text" name="genre" id="genre" placeholder="e.g., Action, Drama" required pattern="^[a-zA-Z\s,]+$" title="Genre can only contain letters and commas.">

        <!-- Runtime Validation -->
        <label for="runtime">Runtime:</label>
        <input type="text" name="runtime" id="runtime" placeholder="Runtime in minutes" required pattern="^\d+$" title="Runtime must be a number.">

        <!-- Trailer Link Validation -->
        <label for="trailer_link">Trailer Link:</label>
        <input type="url" name="trailer_link" id="trailer_link" placeholder="Trailer Link" required pattern="https?://.*" title="Please enter a valid URL starting with http:// or https://">

        <!-- Image Validation -->
        <label for="image">Image:</label>
        <input type="file" name="image" id="image" required accept="image/*" title="Only image files are allowed.">

        <!-- Page Selection Validation -->
        <label for="status">Select Page to Add:</label>
        <select id="status" name="status" required>
            <option value="nowshowing">Now Showing</option>
            <option value="comingsoon">Coming Soon</option>
            <option value="index">Home</option>
        </select>

        <!-- Start Date Validation -->
        <label for="start_date">Start Date:</label>
        <input type="date" name="start_date" id="start_date" required>

        <!-- End Date Validation -->
        <label for="end_date">End Date:</label>
        <input type="date" name="end_date" id="end_date" required>

        <!-- Airing Time 1 Validation -->
        <label for="time1">Airing Time 1:</label>
        <input type="time" name="time1" id="time1" required>

        <!-- Airing Time 2 Validation -->
        <label for="time2">Airing Time 2:</label>
        <input type="time" name="time2" id="time2" required>

        <!-- Airing Time 3 Validation -->
        <label for="time3">Airing Time 3:</label>
        <input type="time" name="time3" id="time3" required>

        <!-- Cinema Selection Validation -->
        <label for="cinema">Select Cinema:</label>
        <select id="cinema" name="cinema" required>
            <option value="">Select Cinema</option>
            <?php for ($i = 1; $i <= 8; $i++) { ?>
                <option value="<?= $i ?>">Cinema <?= $i ?></option>
            <?php } ?>
        </select>
        
        <button type="submit">Add Movie</button>
    </form>
</div>

<script>
    // Additional JavaScript Validation for Date Range (start date should be before end date)
    document.getElementById("addMovieForm").addEventListener("submit", function(event) {
        var startDate = new Date(document.getElementById("start_date").value);
        var endDate = new Date(document.getElementById("end_date").value);
        
        if (startDate > endDate) {
            alert("End date must be later than the start date.");
            event.preventDefault(); // Prevent form submission
        }
    });
</script>


</body>
</html>
