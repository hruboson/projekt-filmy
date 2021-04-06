<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\Locator\LocatorAwareTrait;

class FilmyController extends AppController
{

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authentication->allowUnauthenticated(['film', 'index']);
    }

    public function index()
    {
        $this->loadModel('Filmy');
        $this->loadModel('Filmynazvy');
        $this->loadModel('Jazyky');
        $this->loadComponent('Paginator');

        $filmytable = $this->getTableLocator()->get('Filmy');

        $filmy =  $filmytable->find('all')
            ->distinct(['filmy.id_film']) // needed for multiple same language titles
                                        // here should be min filmynazvy.id_propojeni
            ->contain('filmytypy')
            ->contain('filmyzanry')
            ->contain(['filmynazvy' => ['jazyky']])
            ->where(['jazyky.jazyk' => 'čeština']);

        $this->set('filmy', $filmy);
    }

    public function film($id)
    {
        $filmytable = $this->getTableLocator()->get('Filmy');

        $film = $filmytable->find() 
            ->contain('filmyzanry')
            ->contain('filmytypy')
            ->contain(['filmynazvy' => ['jazyky']])
            ->contain(['filmyherci' => ['herci']])
            ->where(['filmy.id_film' => $id])
            ->first();

        $this->set('film', $film);
    }

    public function add()
    {
    }

    public function edit($id)
    {
        if ($this->Authentication->getResult()->getData()['role'] == "admin") { // Only authenticated user with admin role can access
            $filmytable = $this->getTableLocator()->get('Filmy');
            $jazykytable = $this->getTableLocator()->get('Jazyky');


            $film =  $filmytable->get($id, ['contain' => ['filmytypy', 'filmyzanry', 'filmynazvy.jazyky']]);
            /*->contain('filmytypy')
            ->contain('filmyzanry')
            ->contain(['filmynazvy' => ['jazyky']])
            ->where(['filmy.id_film' => $id]);*/

            $herciTable = $this->getTableLocator()->get('Herci');
            $typyTable = $this->getTableLocator()->get('Typy');
            $zanryTable = $this->getTableLocator()->get('Zanry');
            $filmyherciTable = $this->getTableLocator()->get('Filmyherci');
            $filmynazvyTable = $this->getTableLocator()->get('Filmynazvy');

            $typy = $typyTable->find()->select(['id_typ', 'nazev']);
            $zanry = $zanryTable->find()->select(['id_zanr', 'zanr_nazev']);
            $filmynazvy = $filmynazvyTable->find()
                ->contain('jazyky')
                ->where(['id_film' => $id]);
            $jazyky = $jazykytable->find('all');
            $herci = $herciTable->find('all');
            $filmyherci = $filmyherciTable->find()
                ->contain('herci')
                ->where(['filmyherci.film' => $id]);

            if ($this->request->is(['patch', 'post', 'put'])) {
                $film = $this->Filmy->patchEntity($film, $this->request->getData());
                if ($this->Filmy->save($film)) {
                    $this->Flash->success(__('Podrobnosti o filmu byly uloženy'));

                    return $this->redirect(['controller' => 'Filmy', 'action' => 'edit', $id]);
                }
                $this->Flash->error(__('Nepodařilo se uložit film. Prosím zkuste to znovu.'));
            }

            $this->set(compact('film'));
            $this->set(compact('typy'));
            $this->set(compact('zanry'));
            $this->set(compact('herci'));
            $this->set(compact('filmyherci'));
            $this->set(compact('jazyky'));
            $this->set(compact('filmynazvy'));
        } else {
            return $this->redirect(['controller' => 'Filmy', 'action' => 'index']);
        }
    }

    public function updateJazyky($id)
    {
        if ($this->Authentication->getResult()->getData()['role'] == "admin") { // Only authenticated user with admin role can access

            $this->loadModel('Filmynazvy');

            $filmynazvyTable = $this->getTableLocator()->get('Filmynazvy');
            $nazvy = $filmynazvyTable->find() // one init dataset
                ->contain('jazyky')
                ->where(['id_film' => $id]);

            if ($this->request->is(['patch', 'post', 'put'])) {
                foreach ($nazvy as $nazev) {
                    $localNazev = $this->request->getData((string)$nazev->jazyk);
                    $localNazvy = $filmynazvyTable->get($nazev->id_propojeni);
                    $localNazvy->nazev = $localNazev;
                    if($filmynazvyTable->save($localNazvy)){
                        $this->Flash->success(__('Název byl uložen - '.$nazev->jazyky->jazyk));
                    }else{
                        $this->Flash->error('Název se neuložil -'.$nazev->jazyky->jazyk);
                    }
                }

                return $this->redirect(['controller' => 'Filmy', 'action' => 'edit', $id]);
            }
        }
    }

    public function addJazyk($id){
        if ($this->Authentication->getResult()->getData()['role'] == "admin") { // Only authenticated user with admin role can access
            $this->loadModel('Filmynazvy');

            $filmynazvyTable = $this->getTableLocator()->get('Filmynazvy');

            if ($this->request->is(['patch', 'post', 'put'])) {
                $nazev = $filmynazvyTable->newEmptyEntity();
                $nazev->jazyk = $this->request->getData('novy_jazyk');
                $nazev->id_film = $id;
                $nazev->nazev = 'Doplnit';
                if($filmynazvyTable->save($nazev)){
                    $this->Flash->success(__('Jazyk se přidal'));
                }else{
                    $this->Flash->error('Jazyk se nepřidal. Zkuste to prosím znovu.');
                }
            }
            return $this->redirect(['controller' => 'Filmy', 'action' => 'edit', $id]);
        }
    }

    public function removeJazyk($id){
        if ($this->Authentication->getResult()->getData()['role'] == "admin") { // Only authenticated user with admin role can access
            $this->loadModel('Filmynazvy');

            $filmynazvyTable = $this->getTableLocator()->get('Filmynazvy');

            $entity = $filmynazvyTable->get($id);
            $id_film = $entity->id_film;
            $filmynazvyTable->delete($entity);

            return $this->redirect(['controller' => 'Filmy', 'action' => 'edit', $id_film]);

        }
    }

    public function addHerec($id){
        if ($this->Authentication->getResult()->getData()['role'] == "admin") { // Only authenticated user with admin role can access
            $this->loadModel('Filmyherci');

            $filmyherciTable = $this->getTableLocator()->get('Filmyherci');

            if ($this->request->is(['patch', 'post', 'put'])) {
                $herec = $filmyherciTable->newEmptyEntity();
                $herec->herec = $this->request->getData('novy_herec');
                $herec->film = $id;
                if($filmyherciTable->save($herec)){
                    $this->Flash->success(__('Herec byl přidán'));
                }else{
                    $this->Flash->error('Herec nebyl přidán. Zkuste to prosím znovu.');
                }
            }
            return $this->redirect(['controller' => 'Filmy', 'action' => 'edit', $id]);
        }
    }

    public function removeHerec($id){
        if ($this->Authentication->getResult()->getData()['role'] == "admin") { // Only authenticated user with admin role can access
            $this->loadModel('Filmyherci');

            $filmyherciTable = $this->getTableLocator()->get('Filmyherci');

            $entity = $filmyherciTable->get($id);
            $id_film = $entity->film;
            $filmyherciTable->delete($entity);

            return $this->redirect(['controller' => 'Filmy', 'action' => 'edit', $id_film]);

        }
    }

    public function delete($id = null)
    {
        if ($this->Authentication->getResult()->getData()['role'] == "admin") { // Only authenticated user with admin role can access

            $this->request->allowMethod(['post', 'delete']);
            $film = $this->Filmy->get($id);
            if ($this->Filmy->delete($film)) {
                $this->Flash->success(__('Film byl smazán'));
            } else {
                $this->Flash->error(__('Nepodařilo se smazat film. Prosím zkuste to znovu.'));
            }

            return $this->redirect(['action' => 'index']);
        }
    }
}
