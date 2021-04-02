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

            $film = $filmytable->find()
                ->contain(['filmynazvy' => ['jazyky']])
                ->contain('filmyzanry')
                ->contain('filmytypy')
                ->contain(['filmyherci' => ['filmy', 'herci']])
                ->where(['filmy.id_film' => $id])
                ->first();

            $typyTable = $this->getTableLocator()->get('Typy');
            $zanryTable = $this->getTableLocator()->get('Zanry');
            $herciTable = $this->getTableLocator()->get('Herci');

            $typy = $typyTable->find()->select(['id_typ', 'nazev']);
            $zanry = $zanryTable->find()->select(['id_zanr', 'zanr_nazev']);
            $jazyky = $jazykytable->find('all');
            $herci = $herciTable->find()
                ->contain('filmyherci')
                ->where(['filmyherci.film' => $id]);

            if ($this->request->is(['patch', 'post', 'put'])) {
                $film = $this->Filmy->patchEntity($film, $this->request->getData());
                if ($this->Filmy->save($film)) {
                    $this->Flash->success(__('Změny byly uloženy'));

                    return $this->redirect(['controller' => 'Filmy', 'action' => 'edit', $id]);
                }
                $this->Flash->error(__('Nepodařilo se uložit film. Prosím zkuste to znovu.'));
            }
            $this->set(compact('film'));
            $this->set(compact('typy'));
            $this->set(compact('zanry'));
            $this->set(compact('herci'));
            $this->set(compact('jazyky'));
        } else {
            return $this->redirect(['controller' => 'Filmy', 'action' => 'index']);
        }
    }

    public function updateJazyky($id)
    {
        if ($this->Authentication->getResult()->getData()['role'] == "admin") { // Only authenticated user with admin role can access

            $this->loadModel('Filmynazvy');

            $filmynazvytable = $this->getTableLocator()->get('Filmynazvy');
            $nazvy = $filmynazvytable->find() // one init dataset
                ->contain('jazyky')
                ->where(['id_film' => $id]);

            if ($this->request->is(['patch', 'post', 'put'])) {
                foreach ($nazvy as $nazev) {

                    $nazev->nazev = $this->request->getData($nazev->jazyky->jazyk);
                    //$nazev->id_propojeni = $nazev->id_propojeni;

                    if ($this->Filmynazvy->save($nazev)) {
                    } else {
                    }
                    $this->Flash->error($nazvy);
                }
                $this->Flash->success(__('Názvy byly uloženy'));
                return $this->redirect(['controller' => 'Filmy', 'action' => 'edit', $id]);
            }
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
