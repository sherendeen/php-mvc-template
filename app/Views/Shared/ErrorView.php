<?php namespace app\Views\Shared;
class ErrorView {
    public function showError($message) {
        echo '<p>Error: ' . $message . '</p>';
    }
}
?>

