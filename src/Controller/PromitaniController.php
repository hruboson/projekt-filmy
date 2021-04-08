<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;


class PromitaniController extends AppController
{

    public function beforeFilter(EventInterface $event)
    {
        $this->Authentication->allowUnauthenticated(['index']);

        parent::beforeFilter($event);
    }

    public function index()
    {
        $promitaniTable = $this->getTableLocator()->get('Promitani');
        $promitani = $promitaniTable->find('all')
            ->contain('filmy')
            ->contain('filmy.filmynazvy')
            ->contain('saly')
            ->where(['filmynazvy.id_jazyk' => 1]); // 1 pro češtinu

        $this->set(compact('promitani'));
    }

    public function add()
    {
        if ($this->Authentication->getResult()->getData()['role'] == "admin") { // Only authenticated user with admin role can access
            $promitaniTable = $this->getTableLocator()->get('Promitani');
            $filmyTable = $this->getTableLocator()->get('Filmy');
            $salyTable = $this->getTableLocator()->get('Saly');

            $filmy = $filmyTable->find('all')
                ->contain('filmynazvy');
            $saly = $salyTable->find('all');

            $this->loadModel('Promitani');
            if ($this->request->is(['patch', 'post', 'put'])) {
                $promitani = $this->Promitani->patchEntity($this->Promitani->newEmptyEntity(), $this->request->getData());
                if ($this->Promitani->save($promitani)) {
                    $id_promitani = $promitani->id_promitani;
                    $this->Flash->success(__('Promítání bylo přidáno'));

                    return $this->redirect(['controller' => 'Promitani', 'action' => 'edit', $id_promitani]);
                }
                $this->Flash->error(__('Nepodařilo se uložit promítání. Prosím zkuste to znovu.'));
            }

            $this->set(compact('filmy'));
            $this->set(compact('saly'));
        }
    }

    public function edit($id)
    {
        if ($this->Authentication->getResult()->getData()['role'] == "admin") { // Only authenticated user with admin role can access
            $promitaniTable = $this->getTableLocator()->get('Promitani');
            $filmyTable = $this->getTableLocator()->get('Filmy');
            $salyTable = $this->getTableLocator()->get('Saly');

            $filmy = $filmyTable->find('all')
                ->contain('filmynazvy');
            $saly = $salyTable->find('all');

            $this->loadModel('Promitani');
            $promitani = $this->Promitani->get($id);
            $this->set(compact('promitani'));

            if ($this->request->is(['patch', 'post', 'put'])) {
                $promitani = $this->Promitani->patchEntity($promitani, $this->request->getData());
                if ($this->Promitani->save($promitani)) {
                    $this->Flash->success(__('Podrobnosti o promítání byly uloženy'));

                    return $this->redirect(['controller' => 'Promitani', 'action' => 'edit', $id]);
                }
                $this->Flash->error(__('Nepodařilo se uložit podrobnosti o promítání. Prosím zkuste to znovu.'));
            }

            $this->set(compact('filmy'));
            $this->set(compact('saly'));
        }
    }

    public function delete($id = null)
    {
        if ($this->Authentication->getResult()->getData()['role'] == "admin") { // Only authenticated user with admin role can access

            $this->request->allowMethod(['post', 'delete']);
            $promitani = $this->Promitani->get($id);
            if ($this->Promitani->delete($promitani)) {
                $this->Flash->success(__('Promítání bylo smazáno'));
            } else {
                $this->Flash->error(__('Nepodařilo se smazat promítání. Prosím zkuste to znovu.'));
            }

            return $this->redirect(['action' => 'index']);
        }
    }

    public function buy($id)
    {
        $promitaniTable = $this->getTableLocator()->get('Promitani');
        $promitani = $promitaniTable->get($id, ['contain' => ['filmy.filmynazvy', 'saly']]);

        $cenyOptions = array('100' => 'dítě', '200' => 'dospělý', '150' => 'senior'); // mělo by se potom tahat z databáze (typy lístků)

        $this->loadModel('Vstupenky');
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vstupenka = $this->Vstupenky->patchEntity($this->Vstupenky->newEmptyEntity(), $this->request->getData());
            $vstupenka->datum_cas_prodani = date('Y-m-d H:i:s');
            $vstupenka->id_user = $this->Authentication->getResult()->getData()['id'];
            $vstupenka->id_promitani = $id;
            if ($this->Vstupenky->save($vstupenka)) {
                $this->Flash->success(__('Podrobnosti o promítání byly uloženy'));

                return $this->redirect(['controller' => 'Users', 'action' => 'edit', $id]);
            }
            $this->Flash->error(__('Nepodařilo se uložit podrobnosti o promítání. Prosím zkuste to znovu.'));
        }

        $this->set(compact('promitani'));
        $this->set(compact('cenyOptions'));
    }
}
