<?php
session_start();

require_once('db_login.php');

$comment = '';


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $valid = TRUE;

    $comment = $db->real_escape_string($_POST['comment']);


    if ($comment == '') {
        $error_comment = "Comment must be filled with text";
        $valid = FALSE;
    }


    if ($valid) {
        $query = "INSERT INTO comments (comment) VALUES ('$comment')";
        $result = $db->query($query);

        if (!$result) {
            die("Could not query the database: <br />" . $db->error . '<br>Query: ' . $query);
        } else {
            $db->close();
            header('Location: index.html?success=1');
            exit;
        }
    }
}
?>
<?php $db->close(); ?>