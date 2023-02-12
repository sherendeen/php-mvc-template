<?php
namespace app\Views\Shared;
class LayoutView {
    public function render($content) {
        echo '<main>';
        echo $content;
        echo '</main>';
    }
}

?>