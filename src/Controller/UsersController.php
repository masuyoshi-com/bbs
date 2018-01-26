<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Routing\Router;
use Cake\Event\Event;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    
    /**
    * 初期処理 - ログイン画面のみ非ログイン許可
    *
    * @param object Event $event
    * @return void
    */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow('login');
    }

    /**
     * ログイン - 2系から新たにログインする際にsha1であればsha256にrehashする
     *
     * @param void
     * @return redirect \pages\home
    */
    public function login()
    {
        $this->viewBuilder()->layout('login');
         
        if ($this->request->is('post')) {
             
            $user = $this->Auth->identify();
             
            if ($user) {
                $this->Auth->setUser($user);
                if ($this->Auth->authenticationProvider()->needsPasswordRehash()) {
                    $user = $this->Users->get($this->Auth->user('id'));
                    $user->password = $this->request->data('password');
                    $this->Users->save($user);
                }
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('ユーザー名とパスワードが一致しません'));
        }
    }
     
     /**
     * ログアウト - セッション破棄後ログアウト処理
     * 
     * @param void
     * @return redirect \users\login
     */
    public function logout()
    {
        $this->Function->referer();
        $this->Session->destroy();
        return $this->redirect($this->Auth->logout());
    }
    
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        if (isset($this->request->query['key'])) {
            $query = $this->Users->findByNameOrUsernameOrEmail($this->request->query['key']);
            $users = $this->paginate($query);
            
            $this->Session->write('user_search_request', $this->request->query);
            $this->Session->write('user_search_uri', Router::reverse($this->request, true));
            
        } else {
            $users = $this->paginate($this->Users);
        }
        
        if ($this->Session->check('user_search_request')) {
            $this->request->data = $this->Session->read('user_search_request');
        }
        
        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('登録しました'));
                
                if ($this->Session->check('user_search_uri')) {
                    return $this->redirect($this->Session->read('user_search_uri'));
                }
                
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('エラーがあります'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id
     * @return \Cake\Network\Response|void
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function edit($id = null)
    {
        $this->Function->referer();
        $user = $this->Users->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($this->request->data['new_password']) {
                $this->request->data['password'] = $this->request->data['new_password'];
            }
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('更新しました'));
                if ($this->Session->check('user_search_uri')) {
                    return $this->redirect($this->Session->read('user_search_uri'));
                }
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('エラーがあります'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
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
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('削除しました'));
        } else {
            $this->Flash->error(__('削除できませんでした'));
        }
        if ($this->Session->check('user_search_uri')) {
            return $this->redirect($this->Session->read('user_search_uri'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
