<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Voter Candidates Data</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
            background-color: blanchedalmond;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: red;
        }
        h1{
            text-align: center;
            background-color: yellow;
        }
        h2{
            text-align: center;
            background-color: skyblue;
        }
    </style>
</head>
<body>
    <h1>Total voters and Candidates data:</h1>

    <?php
    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "votingsystem";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to fetch data
    $sql = "SELECT * FROM candidate_voter_form";
    $result = $conn->query($sql);

    // Check if the query was successful
    if ($result === false) {
        die("Error in SQL query: " . $conn->error);
    }

    // Display table with partyname
    echo "<h2>Candidate Data:</h2>";
    echo "<table>";
    echo "<tr><th>ID</th><th>Name</th><th>Party Name</th><th>Mark</th><th>Total Votes</th></tr>";

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        if (!empty($row["partyname"])) {
            // Row with partyname
            echo "<tr><td>" . $row["id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["partyname"] . "</td><td>" . $row["mark"] . "</td><td>"  . $row["total_votes"] . "</td></tr>";
        }
    }

    echo "</table>";

    // Move the result pointer back to the beginning
    $result->data_seek(0);

    // Display table without partyname
    echo "<h2>Voter Data:</h2>";
    echo "<table>";
    echo "<tr><th>ID</th><th>CNIC</th><th>Name</th><th>Pass</th><th>Total Votes</th></tr>";

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        if (empty($row["partyname"])) {
            // Row without partyname
            echo "<tr><td>" . $row["id"] . "</td><td>" . $row["cnic"] . "</td><td>" . $row["name"] . "</td><td>"  . $row["pass"] . "</td><td>" . $row["total_votes"] . "</td></tr>";
        }
    }

    echo "</table>";

    // Close connection
    $conn->close();
    ?>
</body>
</html>
