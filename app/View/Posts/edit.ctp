<h2>Edit Post</h2>

<?php
// フォームの記述

echo $this->Form->create('Post');
echo $this->Form->input('title');
echo $this->Form->input('body', array('rows' => 3));
echo $this->Form->end('Edit Post');
?>