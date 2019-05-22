<?php
require_once "config.php";

if(isset ($_POST['search_term'])) {
    $search_term = mysqli_real_escape_string(htmlentities($_POST['search_term']));

    if (!empty($search_term)) {
        $search = mysqli_query($con, " SELECT 'book_title', 'book_Category' FROM 'library' WHERE 'library' LIKE '%$search_term%'");
        $result_count = mysqli_num_rows($search);
        $suffix = ($result_count != 1) ? 's' : '';
        echo '<p> Your search for', $search_term, '<strong> returned </strong>',  $result_count, '<strong> result </strong>', $suffix, '</p>';

        while ($result_row =  mysqli_fetch_assoc($search)) {
            echo '<p><strong>', $result_row['book_title'], '</strong><br/>', $result_row['book_Category'], '</p>';
        }

    }
}
?>