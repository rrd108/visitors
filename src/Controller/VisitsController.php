<?php
namespace App\Controller;

use App\Model\Entity\Visit;
use Cake\Mailer\Email;

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
        if($this->Auth->user('role') === 'user') {
            $visits = $this->paginate( $this->Visits
                ->find( 'ByUserId', [ 'user_id' => $this->Auth->user( 'id' ) ] )
            );
        }
        if($this->Auth->user('role') === 'superuser') {
            $visits = $this->paginate( $this->Visits
                ->find( 'all' )
            );
        }

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
            'contain' => ['Clubs', 'ServicesVisits','ServicesVisits.Services']
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
        $clubs = $this->Visits->Clubs
            ->find('ByUserId', ['user_id' => $this->Auth->user('id')])
            ->find('list', ['limit' => 200]);
        if ($this->request->is('post')) {
            $this->loadModel('ServicesDays');
            $visit = $this->Visits->patchEntity($visit, $this->request->getData());
            if (!$clubs->count()) {
                $clubsUser = $this->Visits->Clubs->ClubsUsers->newEntity();
                $this->Visits->Clubs->save($visit->club);
                $clubsUser->club_id = $visit->club->id;
                $clubsUser->user_id = $this->Auth->user('id');
                $this->Visits->Clubs->ClubsUsers->save($clubsUser);
            }
            $visit->payed = 0;
            if ($this->Visits->save($visit)) {
                $this->Flash->success(__('The visit has been saved.'));
                if (!$clubs->count()) {
                    $email = new Email();
                    $email->setEmailFormat('html');
                    $email->setTo($this->Auth->user('email'));
                    $email->setSubject(__('Add datas for your club'));
                    $email->setTemplate('clubdata');
                    $email->setViewVars(['club_id' => $visit->club->id]);
                    $email->send();
                }

                return $this->redirect([ 'action' => 'index' ]);
            }
            $this->Flash->error(__('The visit could not be saved. Please, try again.'));
        }
        $services = $this->Visits->Services->find()->groupBy('type')->toArray();
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
            $visit->payed = 0;
                if ( $this->Visits->save( $visit ) ) {
                    $this->Flash->success( __( 'The visit has been saved.' ) );

                    return $this->redirect( [ 'action' => 'index' ] );
                }
            $this->Flash->error(__('The visit could not be saved. Please, try again.'));
        }
        $club = $this->Visits->Clubs->get($visit->club_id);
        $allServices = $this->Visits->Services->find('all');
        $services = [];
        foreach($allServices as $service){
           $servicesVisits = $this->Visits->ServicesVisits->find('all')->where(['visit_id' => $visit->id, 'service_id' => $service->id])->toArray();
           if($servicesVisits != []){
               $service->servicesVisit = $servicesVisits[0];
           }
           array_push($services,$service);
        }
        $this->set(compact('visit', 'club', 'services'));
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
