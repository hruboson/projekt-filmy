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
        $this->loadModel('FilmyNazvy');
        $this->loadModel('Jazyky');
        $this->loadComponent('Paginator');

        $filmytable = $this->getTableLocator()->get('Filmy');

        $filmy =  $filmytable->find('all')
            ->distinct(['Filmy.id_film']) // needed for multiple same language titles
            // here should be min filmynazvy.id_propojeni
            ->contain('FilmyTypy')
            ->contain('FilmyZanry')
            ->contain(['FilmyNazvy' => ['Jazyky']])
            ->where(['Jazyky.jazyk' => 'čeština']);

        $this->set('filmy', $filmy);
    }

    public function film($id)
    {
        $filmytable = $this->getTableLocator()->get('Filmy');
        $filmynazvyTable = $this->getTableLocator()->get('FilmyNazvy');

        $film =  $filmytable->get($id, ['contain' => ['FilmyTypy', 'FilmyZanry', 'FilmyNazvy.Jazyky', 'FilmyHerci.Herci', 'FilmyZeme.Zeme']]);
        $filmynazvy = $filmynazvyTable->find()
            ->contain('Jazyky')
            ->where(['id_film' => $id]);
        /*$film = $filmytable->find()
            ->contain('filmyzanry')
            ->contain('filmytypy')
            ->contain(['filmynazvy' => ['jazyky']])
            ->contain(['filmyherci' => ['herci']])
            ->where(['filmy.id_film' => $id]);*/

        $this->set(compact('film'));
        $this->set(compact('filmynazvy'));
    }

    public function add()
    {
        if ($this->Authentication->getResult()->getData()['role'] == "admin") { // Only authenticated user with admin role can access
            $jazykytable = $this->getTableLocator()->get('Jazyky');
            $herciTable = $this->getTableLocator()->get('Herci');
            $typyTable = $this->getTableLocator()->get('Typy');
            $zanryTable = $this->getTableLocator()->get('Zanry');
            $filmytable = $this->getTableLocator()->get('Filmy');
            $zemetable = $this->getTableLocator()->get('Zeme');
            $filmynazvyTable = $this->getTableLocator()->get('FilmyNazvy');

            $typy = $typyTable->find()->select(['id_typ', 'nazev']);
            $zanry = $zanryTable->find()->select(['id_zanr', 'zanr_nazev']);
            $jazyky = $jazykytable->find('all');
            $herci = $herciTable->find('all');
            $zeme = $zemetable->find('all');

            $this->set(compact('typy'));
            $this->set(compact('zanry'));
            $this->set(compact('herci'));
            $this->set(compact('jazyky'));
            $this->set(compact('zeme'));

            if ($this->request->is(['patch', 'post', 'put'])) {
                $film = $filmytable->patchEntity($filmytable->newEmptyEntity(), $this->request->getData());
                if ($this->Filmy->save($film)) {
                    $nazev = $filmynazvyTable->patchEntity($filmynazvyTable->newEmptyEntity(), $this->request->getData());
                    $nazev->id_jazyk = 1; // výchozí bude čeština
                    $id_film = $film->id_film;
                    $nazev->id_film = $id_film;
                    if ($filmynazvyTable->save($nazev)) {
                        $this->Flash->success(__('Podrobnosti o filmu byly přidány'));

                        return $this->redirect(['controller' => 'Filmy', 'action' => 'edit', $id_film]);
                    }
                    $this->Flash->error(__('Nepodařilo se uložit název filmu. Prosím zkuste to znovu.'));
                }
                $this->Flash->error(__('Nepodařilo se uložit film. Prosím zkuste to znovu.'));
            }
        }
    }

    public function edit($id)
    {
        if ($this->Authentication->getResult()->getData()['role'] == "admin") { // Only authenticated user with admin role can access
            $filmytable = $this->getTableLocator()->get('Filmy');



            $film =  $filmytable->get($id, ['contain' => ['FilmyTypy', 'FilmyZanry', 'FilmyNazvy.Jazyky']]);
            /*->contain('filmytypy')
            ->contain('filmyzanry')
            ->contain(['filmynazvy' => ['jazyky']])
            ->where(['filmy.id_film' => $id]);*/

            $jazykytable = $this->getTableLocator()->get('Jazyky');
            $zemeTable = $this->getTableLocator()->get('Zeme');
            $herciTable = $this->getTableLocator()->get('Herci');
            $typyTable = $this->getTableLocator()->get('Typy');
            $zanryTable = $this->getTableLocator()->get('Zanry');
            $filmyherciTable = $this->getTableLocator()->get('FilmyHerci');
            $filmynazvyTable = $this->getTableLocator()->get('FilmyNazvy');
            $filmyzemeTable = $this->getTableLocator()->get('FilmyZeme');

            $jazyky = $jazykytable->find('all');
            $zeme = $zemeTable->find('all');
            $herci = $herciTable->find('all');
            $typy = $typyTable->find()->select(['id_typ', 'nazev']);
            $zanry = $zanryTable->find()->select(['id_zanr', 'zanr_nazev']);
            $filmyherci = $filmyherciTable->find()
            ->contain('Herci')
            ->where(['FilmyHerci.id_film' => $id]);
            $filmynazvy = $filmynazvyTable->find()
                ->contain('jazyky')
                ->where(['id_film' => $id]);
            $filmyzeme = $filmyzemeTable->find()
                ->contain('Zeme')
                ->where(['id_film' => $id]);


            if ($this->request->is(['patch', 'post', 'put'])) {
                $film = $this->Filmy->patchEntity($film, $this->request->getData());
                if ($this->Filmy->save($film)) {
                    $this->Flash->success(__('Podrobnosti o filmu byly uloženy'));

                    return $this->redirect(['controller' => 'Filmy', 'action' => 'edit', $id]);
                }
                $this->Flash->error(__('Nepodařilo se uložit film. Prosím zkuste to znovu.'));
            }

            $this->set(compact('jazyky'));
            $this->set(compact('zeme'));
            $this->set(compact('film'));
            $this->set(compact('typy'));
            $this->set(compact('zanry'));
            $this->set(compact('herci'));
            $this->set(compact('filmyherci'));
            $this->set(compact('filmynazvy'));
            $this->set(compact('filmyzeme'));

        } else {
            return $this->redirect(['controller' => 'Filmy', 'action' => 'index']);
        }
    }

    public function updateJazyky($id)
    {
        if ($this->Authentication->getResult()->getData()['role'] == "admin") { // Only authenticated user with admin role can access

            $this->loadModel('FilmyNazvy');

            $filmynazvyTable = $this->getTableLocator()->get('FilmyNazvy');
            $nazvy = $filmynazvyTable->find() // one init dataset
                ->contain('Jazyky')
                ->where(['id_film' => $id]);

            if ($this->request->is(['patch', 'post', 'put'])) {
                foreach ($nazvy as $nazev) {
                    $localNazev = $this->request->getData((string)$nazev->id_jazyk);
                    $localNazvy = $filmynazvyTable->get($nazev->id_propojeni);
                    $localNazvy->nazev = $localNazev;
                    if ($filmynazvyTable->save($localNazvy)) {
                        $this->Flash->success(__('Název byl uložen - ' . $nazev->jazyky->jazyk));
                    } else {
                        $this->Flash->error('Název se neuložil -' . $nazev->jazyky->jazyk);
                    }
                }

                return $this->redirect(['controller' => 'Filmy', 'action' => 'edit', $id]);
            }
        }
    }

    public function addJazyk($id)
    {
        if ($this->Authentication->getResult()->getData()['role'] == "admin") { // Only authenticated user with admin role can access
            $this->loadModel('FilmyNazvy');

            $filmynazvyTable = $this->getTableLocator()->get('FilmyNazvy');

            if ($this->request->is(['patch', 'post', 'put'])) {
                $nazev = $filmynazvyTable->newEmptyEntity();
                $nazev->id_jazyk = $this->request->getData('novy_jazyk');
                $nazev->id_film = $id;
                $nazev->nazev = 'Doplnit';
                if ($filmynazvyTable->save($nazev)) {
                    $this->Flash->success(__('Jazyk se přidal'));
                } else {
                    $this->Flash->error('Jazyk se nepřidal. Zkuste to prosím znovu.');
                }
            }
            return $this->redirect(['controller' => 'Filmy', 'action' => 'edit', $id]);
        }
    }

    public function removeJazyk($id)
    {
        if ($this->Authentication->getResult()->getData()['role'] == "admin") { // Only authenticated user with admin role can access
            $this->loadModel('FilmyNazvy');

            $filmynazvyTable = $this->getTableLocator()->get('FilmyNazvy');

            $entity = $filmynazvyTable->get($id);
            $id_film = $entity->id_film;
            $filmynazvyTable->delete($entity);

            return $this->redirect(['controller' => 'Filmy', 'action' => 'edit', $id_film]);
        }
    }

    public function addHerec($id)
    {
        if ($this->Authentication->getResult()->getData()['role'] == "admin") { // Only authenticated user with admin role can access
            $this->loadModel('FilmyHerci');

            $filmyherciTable = $this->getTableLocator()->get('FilmyHerci');

            if ($this->request->is(['patch', 'post', 'put'])) {
                $herec = $filmyherciTable->newEmptyEntity();
                $herec->id_herec = $this->request->getData('novy_herec');
                $herec->id_film = $id;
                if ($filmyherciTable->save($herec)) {
                    $this->Flash->success(__('Herec byl přidán'));
                } else {
                    $this->Flash->error('Herec nebyl přidán. Zkuste to prosím znovu.');
                }
            }
            return $this->redirect(['controller' => 'Filmy', 'action' => 'edit', $id]);
        }
    }

    public function removeHerec($id)
    {
        if ($this->Authentication->getResult()->getData()['role'] == "admin") { // Only authenticated user with admin role can access
            $this->loadModel('FilmyHerci');

            $filmyherciTable = $this->getTableLocator()->get('FilmyHerci');

            $entity = $filmyherciTable->get($id);
            $id_film = $entity->id_film;
            $filmyherciTable->delete($entity);

            return $this->redirect(['controller' => 'Filmy', 'action' => 'edit', $id_film]);
        }
    }

    public function addZeme($id)
    {
        if ($this->Authentication->getResult()->getData()['role'] == "admin") { // Only authenticated user with admin role can access
            $this->loadModel('FilmyZeme');

            $filmyzemeTable = $this->getTableLocator()->get('FilmyZeme');

            if ($this->request->is(['patch', 'post', 'put'])) {
                $zeme = $filmyzemeTable->newEmptyEntity();
                $zeme->id_zeme = $this->request->getData('nova_zeme');
                $zeme->id_film = $id;
                if ($filmyzemeTable->save($zeme)) {
                    $this->Flash->success(__('Země byla přidána'));
                } else {
                    $this->Flash->error('Země nebyla přidána. Zkuste to prosím znovu.');
                }
            }
            return $this->redirect(['controller' => 'Filmy', 'action' => 'edit', $id]);
        }
    }

    public function removeZeme($id)
    {
        if ($this->Authentication->getResult()->getData()['role'] == "admin") { // Only authenticated user with admin role can access
            $this->loadModel('FilmyZeme');

            $filmyzemeTable = $this->getTableLocator()->get('FilmyZeme');

            $entity = $filmyzemeTable->get($id);
            $id_film = $entity->id_film;
            $filmyzemeTable->delete($entity);

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
