<?php
namespace app\Views;

// view


class PostView {
    public function getPostDisplay($post) {
        return '<article class="post" id=' . $post->id . '>'.
         '<h1>' . $post->author . '</h1>'.
         '<p>' . $post->dateCreated . '</p>'.
         '<br>'.
         '<p>' . $post->description. '</p>'.
         '</article>';
        
        
    }
}

?>