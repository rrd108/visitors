<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ServicesVisits Controller
 *
 * @property \App\Model\Table\ServicesVisitsTable $ServicesVisits
 *
 * @method \App\Model\Entity\ServicesVisit[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ServicesVisitsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Services', 'Visits']
        ];
        $servicesVisits = $this->paginate($this->ServicesVisits);

        $this->set(compact('servicesVisits'));
    }

    /**
     * View method
     *
     * @param string|null $id Services Visit id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $servicesVisit = $this->ServicesVisits->get($id, [
            'contain' => ['Services', 'Visits']
        ]);

        $this->set('servicesVisit', $servicesVisit);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $servicesVisit = $this->ServicesVisits->newEntity();
        if ($this->request->is('post')) {
            $servicesVisit = $this->ServicesVisits->patchEntity($servicesVisit, $this->request->getData());
            if ($this->ServicesVisits->save($servicesVisit)) {
                $this->Flash->success(__('The services visit has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The services visit could not be saved. Please, try again.'));
        }
        $services = $this->ServicesVisits->Services->find('list', ['limit' => 200]);
        $visits = $this->ServicesVisits->Visits->find('list', ['limit' => 200]);
        $this->set(compact('servicesVisit', 'services', 'visits'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Services Visit id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $servicesVisit = $this->ServicesVisits->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $servicesVisit = $this->ServicesVisits->patchEntity($servicesVisit, $this->request->getData());
            if ($this->ServicesVisits->save($servicesVisit)) {
                $this->Flash->success(__('The services visit has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The services visit could not be saved. Please, try again.'));
        }
        $services = $this->ServicesVisits->Services->find('list', ['limit' => 200]);
        $visits = $this->ServicesVisits->Visits->find('list', ['limit' => 200]);
        $this->set(compact('servicesVisit', 'services', 'visits'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Services Visit id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $servicesVisit = $this->ServicesVisits->get($id);
        if ($this->ServicesVisits->delete($servicesVisit)) {
            $this->Flash->success(__('The services visit has been deleted.'));
        } else {
            $this->Flash->error(__('The services visit could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
