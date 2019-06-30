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
    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            else {
                $this->Flash->error('Datos Invalidos, por favor intente nuevamente', ['key' => 'auth']);
            }
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
    public function view($name)
    {
        echo "detalle ususario " . $name;
        exit();
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

            $user = $this->Users->patchEntity($user, $this->request->data);

            if($this->Users->save($user)){
                $this->Flash->success('Usuario creado corectamente');
                return $this->redirect(['controller' => 'Users', 'action' => 'index']);
            }
            else {
                return $this->error('error al crear usuario');
            }
        }

        $this->set(compact('user'));
    }
}
