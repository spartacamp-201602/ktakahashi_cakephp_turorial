<?php

// コントローラ ... クラスの中でも XXXXControllerと定義されているもの
// アクション ... XXXXControllerの中に定義されているメソッドのこと
class PostsController extends AppController {

    public $helpers = array('Html', 'Form');

    public function index() {

        //. $this->set をすることによって
        // viewの中で下記のように変数が使えるようになる。
        /* <?php echo $posts ?> */
        // $this->Post... app/Model/Post.php
        // $this->Post->find() ... Postクラスのfindメソッド
        $options = array('limit' => '');
        $this->set('posts', $this->Post->find('all', $options));
    }

    // メソッドの中に $id を定義すると、URLの後ろに記載されたデータが取得できる
    // 例： /posts/show/123 => $id の中身が 123 と代入される
    public function show($id) {
        $post = $this->Post->findById($id);
        $this->set('post', $post);
    }
}