<?php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * 初期化メソッド
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Auth', [
            'authenticate' => [
                'Form' => [
                    'fields' => ['username' => 'mail', 'password' => 'password'],
                    'passwordHasher' => [
                        'className' => 'Fallback',
                        'hashers'   => [
                            'Default',
                            'Weak' => ['hashType' => 'sha1']
                        ]
                    ]
                ]
            ],
            
           'loginRedirect' => '/',
           
           'logoutRedirect' => [
               'controller' => 'Users',
               'action'     => 'login',
           ]
        ]);
        $this->loadComponent('Security');
        $this->loadComponent('Csrf');
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Function');

        $this->Session = $this->request->session();
    }

    /**
     * コントローラのアクションロジックの後、ビューが描画される前に発動する
     * 検索フォームのセッションチェック
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
        
        if (isset($this->Session)) {
            $session_queries = ['thread_search_uri', 'user_search_uri'];
            
            for ($i = 0; $i < count($session_queries); $i++) {
                if ($this->Session->check($session_queries[$i])) {
                    $this->set($session_queries[$i], $this->Session->read($session_queries[$i]));
                }
            }
        }
    }
    
    /**
    * Before Filter - アクションロジック実行前に実行させる共通処理
    * 
    *
    * @param object \Cake\Event\Event $event
    * @return void
    */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Security->config('unlockedActions', ['getbody']);
        // 特定のアクションのみCSRF無効化
        if (in_array($this->request->action, ['index', 'getbody'])) {
            $this->eventManager()->off($this->Csrf);
        }

        $this->set('login', $this->Auth->user());
    }
}
