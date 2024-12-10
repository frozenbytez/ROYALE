<?php
include('../Asset/connection/config.php'); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $runtime = mysqli_real_escape_string($conn, $_POST['runtime']);
    $director = mysqli_real_escape_string($conn, $_POST['director']);
    $cast = mysqli_real_escape_string($conn, $_POST['cast']);
    $rating = mysqli_real_escape_string($conn, $_POST['rating']);
    $genre = mysqli_real_escape_string($conn, $_POST['genre']);
    $trailer_link = mysqli_real_escape_string($conn, $_POST['trailer_link']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
    $end_date = mysqli_real_escape_string($conn, $_POST['end_date']);
    $time1 = mysqli_real_escape_string($conn, $_POST['time1']);
    $time2 = mysqli_real_escape_string($conn, $_POST['time2']);
    $time3 = mysqli_real_escape_string($conn, $_POST['time3']);

    // Image upload handling
    $image_url = ''; 
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];

        // Validate image type
        if (in_array($image_ext, $allowed_extensions)) {
            $image_new_name = uniqid('movie_', true) . '.' . $image_ext;
            $image_dir = '../Asset/images/' . $image_new_name;

            // Ensure directory exists
            if (!is_dir('../Asset/images')) {
                mkdir('../Asset/images', 0777, true); 
            }

            // Move uploaded file
            if (move_uploaded_file($image_tmp, $image_dir)) {
                $image_url = $image_new_name; 
            } else {
                die("Error uploading image. Please try again.");
            }
        } else {
            die("Invalid image format. Allowed types: jpg, jpeg, png, gif.");
        }
    } else {
        die("No image uploaded or upload error.");
    }

    // Prepare SQL query
    $stmt = $conn->prepare("INSERT INTO movies 
        (title, status, image_url, trailer_link, runtime, description, director, cast, rating, genre, start_date, end_date, time1, time2, time3) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param(
        "sssssssssssssss", 
        $title, $status, $image_url, $trailer_link, $runtime, $description, $director, $cast, $rating, $genre, $start_date, $end_date, $time1, $time2, $time3
    );

    // Execute and handle result
    if ($stmt->execute()) {
        $movie_id = $stmt->insert_id;

        // Generate dynamic movie details page
        $filename = preg_replace('/[^a-zA-Z0-9_]/', '_', strtolower($title)) . '.php';
        $filepath = '../movie_details/' . $filename;

        // Generate dynamic content
        $file_content = generateMovieDetailsPage($title, $image_url, $runtime, $description, $director, $cast, $time1, $time2, $time3, $start_date, $end_date);
        
        if (file_put_contents($filepath, $file_content)) {
            echo "Movie added successfully! Page generated: <a href='$filepath'>$filename</a>";
        } else {
            echo "Movie added, but failed to generate details page.";
        }
    } else {
        echo "Error adding movie: " . $stmt->error;
    }
    
    $stmt->close();
}

// Function to generate movie details page content
function generateMovieDetailsPage($title, $image_url, $runtime, $description, $director, $cast, $time1, $time2, $time3, $start_date, $end_date) {
    $daterange_html = '';
    $start = new DateTime($start_date);
    $end = new DateTime($end_date);
    $interval = new DateInterval('P1D');
    $daterange = new DatePeriod($start, $interval, $end->modify('+1 day'));

    foreach ($daterange as $date) {
        $daterange_html .= '<option value="' . $date->format('Y-m-d') . '">' . $date->format('F d, Y') . '</option>';
    }

    return <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>$title</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="movie-container">
        <h1>$title</h1>
        <img src="../Asset/images/$image_url" alt="$title">
        <p><strong>Runtime:</strong> $runtime</p>
        <p><strong>Description:</strong> $description</p>
        <p><strong>Director:</strong> $director</p>
        <p><strong>Cast:</strong> $cast</p>
        <label for="date">Select Date:</label>
        <select id="date">$daterange_html</select>
        <label for="time">Select Time:</label>
        <select id="time">
            <option value="$time1">$time1</option>
            <option value="$time2">$time2</option>
            <option value="$time3">$time3</option>
        </select>
        <button>Book Now</button>
    </div>
</body>
</html>
HTML;
}
?>
