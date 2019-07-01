<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    public function beforeFilter(\Cake\Event\Event $event){
        parent::beforeFilter($event);
        $this->Auth->allow(['add']);
    }

    public function isAuthorized($user){
        if (isset($user['role']) && $user['role'] === 'user') {
            if ($this->request->getParam('action') === 'logout') {
                return true;
            }
            if ($this->request->getParam('action') === 'home') {
                return true;
            }
            if ($this->request->getParam('action') === 'view') {
                return true;
            }
        }
        return parent::isAuthorized($user);
    }

    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            else {
                $this->Flash->error('Datos son invalidos, por favor intente nuevamente', ['key' => 'auth']);
            }
        }
        if ($this->Auth->user()) {
            return $this->redirect(['controller' => 'Users', 'action' => 'home']);
        }
    }

    public function home(){
        $this->render();
    }

    public function logout(){
        return $this->redirect($this->Auth->logout());
    }

    public function index()
    {
        $users =$this->paginate($this->Users);
        $this->set('users', $users);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id)
    {
        $user = $this->Users->get($id);
        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();

        if($this->request->is('post')){
            //debug($this->request->data);

            $user = $this->Users->patchEntity($user, $this->request->getData());

            $user->role = 'user';
            $user->active = 1;

            if($this->Users->save($user)){
                $this->Flash->success('Usuario creado corectamente');
                return $this->redirect(['controller' => 'Users', 'action' => 'login']);
            }
            else {
                $this->Flash->error('El usuario no pudo ser creado. Por favor, intente nuevamente.');
            }
        }

        $this->set(compact('user'));
    }

    public function edit($id = null){

        $user = $this->Users->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success('El usuario ha sido modificado');
                return $this->redirect(['action' => 'index']);
            }
            else {
                $this->Flash->error('El usuario no pudo ser modificado');
            }
        }

        $this->set(compact('user'));
    }

    public function delete($id = null){
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);

        if ($this->Users->delete($user)) {
            $this->Flash->success('El usuario fue eliminado');
        }
        else {
            $this->Flash->error('el usuario fue eliminado');
        }
        return $this->redirect(['action' => 'index']);
    }
}
