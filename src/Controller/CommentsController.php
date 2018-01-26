<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Comments Controller
 *
 * @property \App\Model\Table\CommentsTable $Comments
 */
class CommentsController extends AppController
{
    /**
    * 全てのアクションにリファラー実装
    * 
    * @param object evemnt
    */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Function->referer();
    }
    
    /**
     * Index method
     *
     * @param string $thread_id 選択されたスレッドID
     * @return \Cake\Network\Response|null
     */
    public function index($thread_id = null)
    {
        $query    = $this->Comments->findByThreadId($thread_id);
        $comments = $this->paginate($query);
        $thread   = $this->Comments->Threads->get($thread_id);
        $user     = $this->Comments->Users->get($thread->author_id);
        
        $this->set(compact('comments', 'thread', 'user'));
        $this->set('_serialize', ['comments']);
        $this->set('_serialize', ['thread']);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @param string $thread_id
     * @return \Cake\Network\Response|void
     */
    public function add($thread_id = null)
    {
        $thread  = $this->Comments->Threads->get($thread_id);
        $comment = $this->Comments->newEntity();
        if ($this->request->is('post')) {
            
            $comment = $this->Comments->patchEntity($comment, $this->request->data);
            
            if ($thread->comment_flag === 0) {
                $thread = $this->Comments->Threads->patchEntity($thread, ['comment_flag' => 1], ['validate' => false]);
                // modifiedを自動更新拒否
                $thread->dirty('modified', true);
                $this->Comments->Threads->save($thread);
            }
            
            if ($this->Comments->save($comment)) {
                $this->Flash->success(__('登録しました'));
                return $this->redirect(['action' => 'index', $thread->id]);
            } else {
                $this->Flash->error(__('エラーがあります'));
            }
            
        }
        $this->set(compact('comment', 'thread'));
        $this->set('_serialize', ['comment']);
        $this->set('_serialize', ['thread']);
    }

    /**
     * Edit method
     *
     * @param string|null $comment_id
     * @param string|null $thread_id
     * @return \Cake\Network\Response|void
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function edit($comment_id = null, $thread_id = null)
    {
        $comment = $this->Comments->get($comment_id);
        $thread  = $this->Comments->Threads->get($thread_id);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $comment = $this->Comments->patchEntity($comment, $this->request->data);
            if ($this->Comments->save($comment)) {
                $this->Flash->success(__('更新しました'));
                return $this->redirect(['action' => 'index', $thread->id]);
            } else {
                $this->Flash->error(__('エラーがあります'));
            }
        }
        $this->set(compact('comment', 'thread'));
        $this->set('_serialize', ['comment']);
        $this->set('_serialize', ['thread']);
    }

    /**
     * Delete method
     *
     * @param string|null $id
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $comment = $this->Comments->get($id);
        if ($this->Comments->delete($comment)) {
            $this->Flash->success(__('削除しました'));
        } else {
            $this->Flash->error(__('削除できませんでした'));
        }
        return $this->redirect(['action' => 'index', $comment->thread_id]);
    }
    
    /**
    * コメントテキストデータ取得(AJAX)
    *
    * @param string $comment_id
    * @return bool|json
    */
    public function getbody()
    {
        $this->autoRender = false;
        
        if ($this->request->is('ajax')) {
            $comment = $this->Comments->get($this->request->data['comment_id']);
            $this->response->body(json_encode($comment->body));
            return $this->response;
        }
        return false;
    }
}
