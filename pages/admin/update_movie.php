    <?php
    include('../config.php'); // Include database connection

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
        $cinema = $_POST['cinema'];

        // Handle image upload
        $image_url = isset($movie['image_url']) ? $movie['image_url'] : ''; // Default to current image if not uploaded
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $image_name = mysqli_real_escape_string($conn, $_FILES['image']['name']);  // Sanitize image file name
            $image_tmp = $_FILES['image']['tmp_name'];
            $image_ext = pathinfo($image_name, PATHINFO_EXTENSION);
            $image_new_name = uniqid('movie_', true) . '.' . $image_ext;
            $image_dir = '../Asset/images' . $image_new_name;

            // Move the uploaded image to the target directory
            if (move_uploaded_file($image_tmp, $image_dir)) {
                $image_url = $image_new_name;
            } else {
                $update_message = "Error uploading image.";
            }
        }

        // Update the movie in the database
        $update_query = "UPDATE movies SET title = ?, description = ?, runtime = ?, director = ?, cast = ?, rating = ?, trailer_link = ?, status = ?, start_date = ?, end_date = ?, time1 = ?, time2 = ?, time3 = ?, image_url = ?, cinema = ? WHERE id = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("ssssssssssssssii", $title, $description, $runtime, $director, $cast, $rating, $trailer_link, $status, $start_date, $end_date, $time1, $time2, $time3, $image_url, $cinema, $movie_id);
        
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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
        <title>Update Movie</title>
        <link rel="stylesheet" href="../Asset/css/update_movie.css">
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
                        <img src="../Asset/images/update-movie-bg.png" alt="Sample Image">
                    </div>
                </div>
            </div>

    <div class="content">


        <!-- Display success or error message -->
        <?php if ($update_message): ?>
            <div class="feedback-message">
                <?php echo $update_message; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="update_movie.php" class="movie-form">
        <label for="movie_id">Enter Movie ID:</label>
        <input type="text" name="movie_id" value="<?php echo isset($_POST['movie_id']) ? $_POST['movie_id'] : ''; ?>" required>
        <button type="submit" name="fetch_movie">Show Movie Details</button>
    </form>

    <?php if ($movie): ?>
        <form method="POST" action="update_movie.php" enctype="multipart/form-data">
            <input type="hidden" name="movie_id" value="<?php echo $movie['id']; ?>">

            <h1>Edit Movie Details</h1> <!-- Title added for the form -->

            <label for="title" class="form-label">Title:</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($movie['title']); ?>" class="form-control" required>

            <label for="description" class="form-label">Description:</label>
            <textarea name="description" class="form-control" required><?php echo htmlspecialchars($movie['description']); ?></textarea>

            <label for="runtime" class="form-label">Runtime:</label>
            <input type="text" name="runtime" value="<?php echo htmlspecialchars($movie['runtime']); ?>" class="form-control" required>

            <label for="director" class="form-label">Director:</label>
            <input type="text" name="director" value="<?php echo htmlspecialchars($movie['director']); ?>" class="form-control" required>

            <label for="cast" class="form-label">Cast:</label>
            <input type="text" name="cast" value="<?php echo htmlspecialchars($movie['cast']); ?>" class="form-control" required>

            <label for="rating" class="form-label">Rating:</label>
            <input type="text" name="rating" value="<?php echo htmlspecialchars($movie['rating']); ?>" class="form-control" required>

            <label for="trailer_link" class="form-label">Trailer Link:</label>
            <input type="url" name="trailer_link" value="<?php echo htmlspecialchars($movie['trailer_link']); ?>" class="form-control" required>

            <label for="status" class="form-label">Status:</label>
            <select name="status" class="form-select" required>
                <option value="nowshowing" <?php echo ($movie['status'] == 'nowshowing') ? 'selected' : ''; ?>>Now Showing</option>
                <option value="comingsoon" <?php echo ($movie['status'] == 'comingsoon') ? 'selected' : ''; ?>>Coming Soon</option>
                <option value="index" <?php echo ($movie['status'] == 'index') ? 'selected' : ''; ?>>Home</option>
            </select>

            <label for="start_date" class="form-label">Start Date:</label>
            <input type="date" name="start_date" value="<?php echo htmlspecialchars($movie['start_date']); ?>" class="form-control" required>

            <label for="end_date" class="form-label">End Date:</label>
            <input type="date" name="end_date" value="<?php echo htmlspecialchars($movie['end_date']); ?>" class="form-control" required>

            <label for="time1" class="form-label">Airing Time 1:</label>
            <input type="time" name="time1" value="<?php echo htmlspecialchars($movie['time1']); ?>" class="form-control" required>

            <label for="time2" class="form-label">Airing Time 2:</label>
            <input type="time" name="time2" value="<?php echo htmlspecialchars($movie['time2']); ?>" class="form-control" required>

            <label for="time3" class="form-label">Airing Time 3:</label>
            <input type="time" name="time3" value="<?php echo htmlspecialchars($movie['time3']); ?>" class="form-control" required>

            <label for="image" class="form-label">Image:</label>
            <input type="file" name="image" class="form-control">

            <label for="cinema" class="form-label">Cinema:</label>
            <select name="cinema" class="form-select" required>
                <?php for ($i = 1; $i <= 8; $i++): ?>
                    <option value="<?php echo $i; ?>" <?php echo ($movie['cinema'] == $i) ? 'selected' : ''; ?>>Cinema <?php echo $i; ?></option>
                <?php endfor; ?>
            </select>



            <button type="submit" name="update_movie" class="btn-primary">Update Movie</button>
        </form>
    <?php endif; ?>

    <script>
        function toggleSidebar() {
        const sidebar = document.querySelector('.sidebar'); // Hinahanap ang sidebar
        sidebar.classList.toggle('open'); // Nagta-toggle ng 'open' class
    }
        </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    </body>
    </html>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Delete Movie</title>
        <link rel="stylesheet" href="../../assets/css/admin/admin-dashboard.css">
        
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