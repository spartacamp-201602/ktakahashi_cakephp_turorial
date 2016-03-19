<h2>Blog Posts</h2>
<?php //debug($posts) ?>

<!-- <div Align="right"> -->
<?= $this->Html->link('新規記事投稿',
                       array(
                      'controller' => 'posts',
                      'action' => 'add'
                       )); ?>
<!-- </div> -->
<table>
    <tr>
        <th>Id</th>
        <th>タイトル</th>
        <th>本文</th>
        <th>操作</th>
        <th>投稿日</th>
    </tr>
    <?php foreach ($posts as $post) :?>
    <tr>
        <td><?= h($post['Post']['id']) ?></td>
        <td>
            <?= $this->Html->link(
                $post['Post']['title'],
                array(
                    'controller' => 'posts',
                    'action' => 'show',
                    $post['Post']['id']
                )) ?>
        </td>
        <td><?= h($post['Post']['body']) ?></td>
        <td>
            <?= $this->Html->Link(
                    '編集',
                    array(
                         'controller' => 'posts',
                         'action' => 'edit',
                         $post['Post']['id']
                )); ?>
            <?= $this->Form->postLink(
                    '削除',
                    array('action' => 'delete', $post['Post']['id']),
                    array('confirm' => '削除してよろしいですか？')
                ); ?>
        </td>
        <td><?= h($post['Post']['created']) ?></td>
    </tr>
    <?php endforeach ?>
</table>