<!DOCTYPE html>
<html>
<head>
    <title>Student Page</title>
    <link rel="stylesheet" type="text/css" href="student.css">
</head>
<body>
    <div id="welcome-section">
        <?php
        session_start();

        // Check if user is logged in and has student role
        if (!isset($_SESSION['user_id']) || $_SESSION['acct_type'] != 'student') {
            header('Location: index.php');
            exit;
        }

        // Connect to the database
        include 'dbconnect.php';

        // Get student data
        $user_id = $_SESSION['user_id'];
        $get_student = "SELECT * FROM students WHERE uid=$user_id";
        $result = mysqli_query($conn, $get_student);
        $student = mysqli_fetch_assoc($result);

        // Display student data
        echo '<div><h1>Welcome, ' . $student['firstname'] . ' ' . $student['lastname'] . '!</h1></div>';
        echo '<div><h1>Course: ' . $student['course'] . '</h1></div>';
        ?>
    </div>

    <div id="table-section">
        <table>
            <tr>
                <th>Grade</th>
                <th>Subject</th>
                <th>Subject Description</th>
                <th>Action</th>
            </tr>
            <?php
            // Construct the SQL query to fetch the grades and subjects for the student
            $query = "SELECT grades.gid, grades.grade, subjects.subject, subjects.subject_name
                      FROM grades
                      INNER JOIN subjects ON grades.sbid = subjects.sbid
                      WHERE grades.sid = " . $student['sid'];

            // Execute the query
            $result = mysqli_query($conn, $query);

            // Check if there are any rows in the result
            if (mysqli_num_rows($result) > 0) {
                // Output data of each row
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row["grade"] . "</td>";
                    echo "<td>" . $row["subject"] . "</td>";
                    echo "<td>" . $row["subject_name"] . "</td>";
                    echo '<td><a href="remove_subject.php?grade_id=' . $row['gid'] . '">Remove</a></td>';
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No results found.</td></tr>";
            }

            // Close the database connection
            mysqli_close($conn);
            ?>
        </table>
    </div>

    <div id="logout-section">
        <a href="logout.php">Logout</a>
    </div>

    <?php
    include 'addsub.php';
    ?>
</body>
</html>
