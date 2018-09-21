<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ClubsUsers Controller
 *
 * @property \App\Model\Table\ClubsUsersTable $ClubsUsers
 *
 * @method \App\Model\Entity\ClubsUser[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ClubsUsersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Clubs']
        ];
        $clubsUsers = $this->paginate($this->ClubsUsers);

        $this->set(compact('clubsUsers'));
    }

    /**
     * View method
     *
     * @param string|null $id Clubs User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $clubsUser = $this->ClubsUsers->get($id, [
            'contain' => ['Users', 'Clubs']
        ]);

        $this->set('clubsUser', $clubsUser);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $clubsUser = $this->ClubsUsers->newEntity();
        if ($this->request->is('post')) {
            $clubsUser = $this->ClubsUsers->patchEntity($clubsUser, $this->request->getData());
            if ($this->ClubsUsers->save($clubsUser)) {
                $this->Flash->success(__('The clubs user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The clubs user could not be saved. Please, try again.'));
        }
        $users = $this->ClubsUsers->Users->find('list', ['limit' => 200]);
        $clubs = $this->ClubsUsers->Clubs->find('list', ['limit' => 200]);
        $this->set(compact('clubsUser', 'users', 'clubs'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Clubs User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $clubsUser = $this->ClubsUsers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $clubsUser = $this->ClubsUsers->patchEntity($clubsUser, $this->request->getData());
            if ($this->ClubsUsers->save($clubsUser)) {
                $this->Flash->success(__('The clubs user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The clubs user could not be saved. Please, try again.'));
        }
        $users = $this->ClubsUsers->Users->find('list', ['limit' => 200]);
        $clubs = $this->ClubsUsers->Clubs->find('list', ['limit' => 200]);
        $this->set(compact('clubsUser', 'users', 'clubs'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Clubs User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $clubsUser = $this->ClubsUsers->get($id);
        if ($this->ClubsUsers->delete($clubsUser)) {
            $this->Flash->success(__('The clubs user has been deleted.'));
        } else {
            $this->Flash->error(__('The clubs user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
