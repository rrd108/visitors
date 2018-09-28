<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use App\Model\Entity\Visit;

/**
 * Visits Controller
 *
 * @property \App\Model\Table\VisitsTable $Visits
 *
 * @method \App\Model\Entity\Visit[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VisitsController extends AppController
{


	/**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Clubs']
        ];
        $visits = $this->paginate($this->Visits
	        ->find('ByUserId',['user_id' => $this->Auth->user('id')])
        );

        $this->set(compact('visits'));
    }

    /**
     * View method
     *
     * @param string|null $id Visit id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $visit = $this->Visits->get($id, [
            'contain' => ['Clubs', 'Services']
        ]);
		$this->checkAccess($visit);
        $this->set('visit', $visit);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $visit = $this->Visits->newEntity();
        if ($this->request->is('post')) {
            $visit = $this->Visits->patchEntity($visit, $this->request->getData());
            $visit->payed = 0;
            $notEmptyServices = [];
            $hasService = false;
            foreach ($visit->services as $service){
            	if($service->_joinData->full_price_members != 0 || $service->_joinData->discount_price_members !=0){
            		$hasService = true;
            		array_push($notEmptyServices,$service);
	            }
            }
            $visit->services = $notEmptyServices;
            if($hasService) {
	            if ( $this->Visits->save( $visit ) ) {
		            $this->Flash->success( __( 'The visit has been saved.' ) );

		            return $this->redirect( [ 'action' => 'index' ] );
	            }
            }
            $this->Flash->error(__('The visit could not be saved. Please, try again.'));
        }
        $clubs = $this->Visits->Clubs->find('ByUserId',['user_id' => $this->Auth->user('id')])
                                     ->find('list', ['limit' => 200]);
        $services = $this->Visits->Services->find('all');
        $this->set(compact('visit', 'clubs', 'services'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Visit id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
	    $visit = $this->Visits->get($id, [
		    'contain' => ['Services']
	    ]);
	    $this->checkAccess($visit);
	    $daysDifferent = (strtotime($visit->date) - time()) / (60 * 60 *24);
	    if($visit->payed == 1 || $daysDifferent <= 7){
		    $this->Flash->error(__('You can\'t edit this visit yet'));
		    return $this->redirect(['action' => 'index']);
	    }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $visit = $this->Visits->patchEntity($visit,$this->request->getData());
            if ($this->Visits->save($visit)) {
                $this->Flash->success(__('The visit has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The visit could not be saved. Please, try again.'));
        }
        $club = $this->Visits->Clubs->get($visit->club_id);
        $services = $this->Visits->Services->find('list', ['limit' => 200]);
        $servicesVisits = $this->Visits->ServicesVisits
	        ->find('ByVisitId',['visit_id' => $visit->id])->contain('Services');
        $this->set(compact('visit', 'club', 'services','servicesVisits'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Visit id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $visit = $this->Visits->get($id);
        $this->checkAccess($visit);
        if ($this->Visits->delete($visit)) {
            $this->Flash->success(__('The visit has been deleted.'));
        } else {
            $this->Flash->error(__('The visit could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    private function checkAccess(Visit $visit){
	    if($this->Auth->user('role') == 'user') {
		    $userVisits = $this->Visits->find( 'byUserId', [ 'user_id' => $this->Auth->user( 'id' ) ] );
		    $canAccess = false;
		    foreach ($userVisits as $userVisit){
			    if($visit->id == $userVisit->id){
				    $canAccess = true;
			    }
		    }
		    if(!$canAccess) {
			    $this->Flash->error(__('You are not authorized to access that location.'));
			    $this->redirect( $this->redirect( [ 'action' => 'index' ] ) );
		    }
	    }
    }
}
