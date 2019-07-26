<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ServicesDays Controller
 *
 * @property \App\Model\Table\ServicesDaysTable $ServicesDays
 *
 * @method \App\Model\Entity\ServicesDay[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ServicesDaysController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow('listNonServicesDays');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $servicesDays = $this->paginate($this->ServicesDays);

        $this->set(compact('servicesDays'));
    }

    /**
     * View method
     *
     * @param string|null $id Services Day id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $servicesDay = $this->ServicesDays->get($id, [
            'contain' => []
        ]);

        $this->set('servicesDay', $servicesDay);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $servicesDay = $this->ServicesDays->newEntity();
        if ($this->request->is('post')) {
            $servicesDay = $this->ServicesDays->patchEntity($servicesDay, $this->request->getData());
            if ($this->ServicesDays->save($servicesDay)) {
                $this->Flash->success(__('The services day has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The services day could not be saved. Please, try again.'));
        }
        $this->set(compact('servicesDay'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Services Day id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $servicesDay = $this->ServicesDays->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $servicesDay = $this->ServicesDays->patchEntity($servicesDay, $this->request->getData());
            if ($this->ServicesDays->save($servicesDay)) {
                $this->Flash->success(__('The services day has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The services day could not be saved. Please, try again.'));
        }
        $this->set(compact('servicesDay'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Services Day id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $servicesDay = $this->ServicesDays->get($id);
        if ($this->ServicesDays->delete($servicesDay)) {
            $this->Flash->success(__('The services day has been deleted.'));
        } else {
            $this->Flash->error(__('The services day could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function listNonServicesDays()
    {
        $nonServicesDays =  $this->ServicesDays->find('list')->toArray();
        foreach ($nonServicesDays as &$servicesDay) {
            $servicesDay = date_format($servicesDay, "m/d/Y");
        }
        $this->set(compact('nonServicesDays'));
        $this->set('_serialize', ['nonServicesDays']);
    }
}
