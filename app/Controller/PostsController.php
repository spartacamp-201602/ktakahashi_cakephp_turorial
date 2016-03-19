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

    public function delete($id)
    {
        // $id -> /posts/delete/5 だったら 5になる
        // 今まで -> delete.php?id=5

        if ($this->request->is('get'))
        {
            // GETで来た場合
            throw new MethodNotAllowedException();
        }

        if ($this->Post->delete($id))
        {
            // 削除に成功した場合

            // フラッシュメッセージ
            $this->Flash->error('記事' . $id . 'を削除しました');

            // リダイレクト
            return $this->redirect(array('action' => 'index'));

        }
    }

    public function edit($id)
    {
        // 既存のレコードを取得
        $post = $this->Post->findById($id);

        if (!$post)
        {
            // 既存レコードが見つからない場合
            throw new NotFoundException('そんな記事ないよ〜');
        }

        $this->Post->id = $id;

        // フォームからの送信をチェックします
        if ($this->request->is(array('post', 'put')))
        {
            // 更新を試みる
            if ($this->Post->save($this->request->data))
            {
                // 更新に成功した場合
                // フラッシュメッセージとともにリダイレクト
                // フラッシュメッセージ
                $this->Flash->success('記事' . $id . 'を更新しました！');

                // リダイレクト
                return $this->redirect(array('action' => 'index'));
            }
            else
            {
                // 更新に失敗した場合
                $this->Flash->error('記事を更新できませんでした。。。');
            }
        }

        if (!$this->request->data)
        {
            $this->request->data = $post;
        }
    }
}