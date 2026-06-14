transactions/issue_book.php
<?php
include("../db.php");

if(isset($_POST['issue'])) {
    $user_id = $_POST['user_id'];
    $book_id = $_POST['book_id'];
    $issue_date = date("Y-m-d");

    // Check if book is available
    $check = mysqli_query($conn, "SELECT * FROM books WHERE id='$book_id' AND status='available'");

    if(mysqli_num_rows($check) > 0) {

        // Insert transaction
        mysqli_query($conn, "INSERT INTO transactions (user_id, book_id, issue_date) 
        VALUES ('$user_id', '$book_id', '$issue_date')");

        // Update book status
        mysqli_query($conn, "UPDATE books SET status='issued' WHERE id='$book_id'");

        echo "Book issued successfully!";
    } else {
        echo "Book is already issued.";
    }
}
?>

<h2>Issue Book</h2>

<form method="POST">

    <label>Select User:</label>
    <select name="user_id" required>
        <?php
        $users = mysqli_query($conn, "SELECT * FROM users");
        while($row = mysqli_fetch_assoc($users)) {
            echo "<option value='{$row['id']}'>{$row['name']}</option>";
        }
        ?>
    </select>

    <br><br>

    <label>Select Book:</label>
    <select name="book_id" required>
        <?php
        $books = mysqli_query($conn, "SELECT * FROM books WHERE status='available'");
        while($row = mysqli_fetch_assoc($books)) {
            echo "<option value='{$row['id']}'>{$row['title']}</option>";
        }
        ?>
    </select>

    <br><br>

    <button type="submit" name="issue">Issue Book</button>

</form>