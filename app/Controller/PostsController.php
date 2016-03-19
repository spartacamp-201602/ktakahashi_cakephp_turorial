<?php

// コントローラ ... クラスの中でも XXXXControllerと定義されているもの
// アクション ... XXXXControllerの中に定義されているメソッドのこと
class PostsController extends AppController {

    //使用するヘルパー
    public $helpers = array('Html', 'Form');

    public $components = array('Flash');

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

    public function add()
    {
        if ($this->request->is('post'))
        {
            // 保存処理
            if ($this->Post->save($this->request->data))
            {
                // 保存に成功した場合

                // フラッシュメッセージ
                $this->Flash->success('新しい記事を追加しました');

                // リダイレクト
                return $this->redirect(array('action' => 'index'));

            } else
            {
                // 保存に失敗した場合
                $this->Flash->error('保存できませんでした。。。');
            }

        }
    }
}