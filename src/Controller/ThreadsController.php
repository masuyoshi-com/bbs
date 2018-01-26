<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Routing\Router;
use Cake\Network\Response;

/**
 * Threads Controller
 *
 * @property \App\Model\Table\ThreadsTable $Threads
 */
class ThreadsController extends AppController
{
    /**
     * スレッド一覧 - 何も検索条件がない場合は現在より4日前からのスレッドを取得する
     * スレッド更新時間から5時間経過しても返答がない場合はスレッド色を変更する
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        if ($this->request->query) {
            $query = $this->Threads->findBySearch($this->request->query);
            
            $this->Session->write('thread_search_request', $this->request->query);
            $this->Session->write('thread_search_uri', Router::reverse($this->request, true));
            
        } else {
            $query = $this->Threads->findAllBy4days();
        }
        $threads = $query->all();
        
        $now = new \DateTime();
        foreach ($threads as $thread) {
            if ($thread->comment_flag === 0) {
                $interval = $now->diff($thread->modified);
                // modified日付はstrtotimeで現在より5時間経過しているか
                if ($interval->days > 0 || $interval->h >= 5) {
                    $thread->time_exceeded = 1;
                }
            }
        }
        $this->set(compact('threads'));
        $this->set('_serialize', ['threads']);
        
        if ($this->Session->check('thread_search_request')) {
            $this->request->data = $this->Session->read('thread_search_request');
        }
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void
     */
    public function add()
    {
        $thread = $this->Threads->newEntity();
        if ($this->request->is('post')) {
            $thread = $this->Threads->patchEntity($thread, $this->request->data);
            if ($this->Threads->save($thread)) {
                $this->Flash->success(__('登録しました'));
                if ($this->Session->check('thread_search_uri')) {
                    return $this->redirect($this->Session->read('thread_search_uri'));
                }
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('エラーがあります'));
            }
        }
        $this->set(compact('thread'));
        $this->set('_serialize', ['thread']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Thread id.
     * @return \Cake\Network\Response|void
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function edit($id = null)
    {
        $this->Function->referer();
        $thread = $this->Threads->get($id);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $thread = $this->Threads->patchEntity($thread, $this->request->data);
            if ($this->Threads->save($thread)) {
                $this->Flash->success(__('更新しました'));
                if ($this->Session->check('thread_search_uri')) {
                    return $this->redirect($this->Session->read('thread_search_uri'));
                }
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('エラーがあります'));
            }
        }
        $this->set(compact('thread'));
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
        $this->Function->referer();
        $this->request->allowMethod(['post', 'delete']);
        $thread = $this->Threads->get($id);
        if ($this->Threads->delete($thread)) {
            $this->Flash->success(__('削除しました'));
        } else {
            $this->Flash->error(__('削除できませんでした'));
        }
        if ($this->Session->check('thread_search_uri')) {
            return $this->redirect($this->Session->read('thread_search_uri'));
        }
        return $this->redirect(['action' => 'index']);
    }
    
    /**
    * スレッドテキストデータ取得(AJAX)
    *
    * @param string $thread_id
    * @return bool|json
    */
    public function getbody()
    {
        $this->Function->referer();
        $this->autoRender = false;
        
        if ($this->request->is('ajax')) {
            $thread = $this->Threads->get($this->request->data['thread_id']);
            $this->response->body(json_encode($thread->body));
            return $this->response;
        }
        return false;
    }
}
