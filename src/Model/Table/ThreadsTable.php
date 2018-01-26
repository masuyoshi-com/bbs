<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Threads Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Authors
 * @property \Cake\ORM\Association\HasMany $Comments
 *
 * @method \App\Model\Entity\Thread get($primaryKey, $options = [])
 * @method \App\Model\Entity\Thread newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Thread[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Thread|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Thread patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Thread[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Thread findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ThreadsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('threads');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        
        $this->belongsTo('Users', [
            'foreignKey' => 'author_id',
            'joinType'   => 'INNER'
        ]);
        
        $this->hasMany('Comments', [
            'foreignKey' => 'thread_id',
            'dependent'  => true
        ]);
    }

    /**
     * デフォルトバリデート
     *
     * @param \Cake\Validation\Validator $validator
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator->provider('custom', 'App\Model\Validation\CustomValidation');
        
        $validator
            ->allowEmpty('id', 'create');

        $validator
            ->notEmpty('title')
            ->add('title', 'custom', [
                'rule'     => 'isSpace',
                'provider' => 'custom',
                'message'  => '空白文字は受け付けません。'
            ]);

        $validator
            ->notEmpty('body')
            ->add('body', 'custom', [
                'rule'     => 'isSpace',
                'provider' => 'custom',
                'message'  => '空白文字は受け付けません。'
            ]);

        return $validator;
    }
    
    /**
    * スレッド検索 - デフォルト4日前のレコードを取得
    *
    * @param void
    * @return object Query
    */
    public function findAllBy4days()
    {
        return $this->find('all', [
           'conditions' => ['Threads.modified >' => new \DateTime('-4 days')],
           'contain'    => ['Users'],
           'order'      => ['Threads.modified' => 'desc']
        ]);
    }
    
    /**
    * 検索項目取得 -「Search」
    * 
    * @param array $requests
    */
    public function findBySearch($requests = null)
    {
        if (isset($requests['from']) && $requests['from'] !== '') {
            $from = $requests['from'];
        } else {
            $from = '-4 days';
        }
        return $this->find('all')
            ->where(['OR' => [
                ['Threads.title LIKE'  => '%' . $requests['keyword'] . '%'],
                ['Threads.body LIKE'   => '%' . $requests['keyword'] . '%'],
                ['Users.username LIKE' => '%' . $requests['keyword'] . '%']]])
            ->where(['OR' => [
                ['Threads.title LIKE'  => '%' . $requests['keyword2'] . '%'],
                ['Threads.body LIKE'   => '%' . $requests['keyword2'] . '%'],
                ['Users.username LIKE' => '%' . $requests['keyword2'] . '%']]])
            ->where(['Threads.modified >' => new \DateTime($from)])
            ->contain(['Users'])
            ->order(['Threads.modified' => 'desc']);
    }
}
