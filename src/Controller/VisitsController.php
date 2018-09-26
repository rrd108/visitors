<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Visits Controller
 *
 * @property \App\Model\Table\VisitsTable $Visits
 *
 * @method \App\Model\Entity\Visit[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VisitsController extends AppController
{

	/*public function beforeFilter( Event $event ) {
		parent::beforeFilter($event);
		$this->Auth->deny();
		if($this->Auth->user('role') == 'user') {
			$this->Auth->deny();
			$pathArray =  explode('/',$this->request->getPath());
			$currentVisitId = $pathArray[count($pathArray)-1];
			$currentVisit = $this->Visits->get($currentVisitId);
			$visits = $this->Visits->find( 'byUserId', [ 'user_id' => $this->Auth->user( 'id' ) ] );
			foreach ($visits as $visit){
				if($currentVisit == $visit){
					$this->Auth->allow(['edit','view']);
				}
			}
		}
	}*/

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
	    if($this->Auth->user('role') == 'user') {
		    $this->Auth->deny();
		    $pathArray =  explode('/',$this->request->getPath());
		    $currentVisitId = $pathArray[count($pathArray)-1];
		    $currentVisit = $this->Visits->get($currentVisitId);
		    $visits = $this->Visits->find( 'byUserId', [ 'user_id' => $this->Auth->user( 'id' ) ] );
		    $canAccess = false;
		    foreach ($visits as $visit){
			    if($currentVisit == $visit){
				   $canAccess = true;
			    }
		    }
		    if(!$canAccess) {
			    $this->Flash(__('You are not authorized to access that location.'));
			    $this->redirect( $this->redirect( [ 'action' => 'index' ] ) );
		    }
	    }
        $visit = $this->Visits->get($id, [
            'contain' => ['Clubs', 'Services']
        ]);

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
            if ($this->Visits->save($visit)) {
                $this->Flash->success(__('The visit has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The visit could not be saved. Please, try again.'));
        }
        $clubs = $this->Visits->Clubs->find('ByUserId',['user_id' => $this->Auth->user('id')])
                                     ->find('list', ['limit' => 200]);
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
	    if($this->Auth->user('role') == 'user') {
		    $this->Auth->deny();
		    $pathArray =  explode('/',$this->request->getPath());
		    $currentVisitId = $pathArray[count($pathArray)-1];
		    $currentVisit = $this->Visits->get($currentVisitId);
		    $visits = $this->Visits->find( 'byUserId', [ 'user_id' => $this->Auth->user( 'id' ) ] );
		    $canAccess = false;
		    foreach ($visits as $visit){
			    if($currentVisit == $visit){
				    $canAccess = true;
			    }
		    }
		    if(!$canAccess) {
			    $this->Flash(__('You are not authorized to access that location.'));
			    $this->redirect( $this->redirect( [ 'action' => 'index' ] ) );
		    }
	    }
        $visit = $this->Visits->get($id, [
            'contain' => ['Services']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $visit = $this->Visits->patchEntity($visit,$this->request->getData());
	        $daysDifferent = (time() - strtotime($visit->date)) / (60 * 60 *24);
	        if($visit->payed == 1 || $daysDifferent <= 7){
		        $this->Flash->error(__('You can\'t edit this visit yet'));
		        return $this->redirect(['action' => 'index']);
	        }
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
	    if($this->Auth->user('role') == 'user') {
		    $this->Auth->deny();
		    $pathArray =  explode('/',$this->request->getPath());
		    $currentVisitId = $pathArray[count($pathArray)-1];
		    $currentVisit = $this->Visits->get($currentVisitId);
		    $visits = $this->Visits->find( 'byUserId', [ 'user_id' => $this->Auth->user( 'id' ) ] );
		    $canAccess = false;
		    foreach ($visits as $visit){
			    if($currentVisit == $visit){
				    $canAccess = true;
			    }
		    }
		    if(!$canAccess) {
			    $this->Flash(__('You are not authorized to access that location.'));
			    $this->redirect( $this->redirect( [ 'action' => 'index' ] ) );
		    }
	    }
        $this->request->allowMethod(['post', 'delete']);
        $visit = $this->Visits->get($id);
        if ($this->Visits->delete($visit)) {
            $this->Flash->success(__('The visit has been deleted.'));
        } else {
            $this->Flash->error(__('The visit could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
