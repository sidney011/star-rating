
<?php
/**********************
* Database connection
*********************/
$serverName = "localhost";
$userName = "*******";
$password = "*******";
$databaseName = "*******";

$db = new mysqli($serverName, $userName, $password, $databaseName);

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
/**********************
* Rating Program
*********************/
// All Variables

$table = 'Rating';
$pageName = isset($_GET['page']) ? $_GET['page'] : $_SERVER['REQUEST_URI'];
$rating = isset($_GET['rating']) ? $_GET['rating'] : null;

class RatingController {
    public function __construct($pageName, $table, $db)
    {
        $this->page = $pageName;
        $this->table = $table;
        $this->db = $db;
    }
    // Function to check if user has already voted the page
    public function checkIfAlreadyRated () {
        if (!isset($_COOKIE["$this->page"])) {
            return false;
        } else {
            return true;
        }
    }
    // Function to insert user vote if has not already voted
    public function insertRating($rating) {
        $query = "INSERT INTO $this->table (pageName, rating)
        VALUES ('$this->page', '$rating')";
        $this->db->query($query);
        setcookie("$this->page","Rated", time() + (10 * 365 * 24 * 60 * 60));
    }
    // Calculate average of ratings
    public function calcAverage() {
        $query = "SELECT AVG(rating) FROM $this->table WHERE pageName IN ('$this->page')";
        $result = $this->db->query($query);
        $averageRating = mysqli_fetch_array($result);
        return number_format((float)$averageRating[0], 2, '.', '');
    }
    // Return number of ratings in the database
    public function numVote() {
        $query = "SELECT COUNT(*) FROM $this->table WHERE pageName IN ('$this->page')";
        $result = $this->db->query($query);
        $numVote = mysqli_fetch_array($result);
        return $numVote[0];
    }
    // Close connection
    public function __destruct()
    {
        $this->db->close();
    }
}
$getRating = new RatingController($pageName, $table, $db);