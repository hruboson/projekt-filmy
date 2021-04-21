<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;


class SalyController extends AppController
{

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
    }

    public function index()
    {
        $salyTable = $this->getTableLocator()->get('saly');
        $saly = $salyTable->find('all');

        $this->set(compact('saly'));
    }

    public function add()
    {
        if ($this->Authentication->getResult()->getData()['role'] == "admin") { // Only authenticated user with admin role can access
            $this->loadModel('Saly');
            if ($this->request->is(['patch', 'post', 'put'])) {
                $sal = $this->Saly->patchEntity($this->Saly->newEmptyEntity(), $this->request->getData());
                if ($this->Saly->save($sal)) {
                    $id_salu = $sal->id_sal;
                    $this->Flash->success(__('Sál byl přidán'));

                    return $this->redirect(['controller' => 'Saly', 'action' => 'edit', $id_salu]);
                }
                $this->Flash->error(__('Nepodařilo se uložit promítání. Prosím zkuste to znovu.'));
            }
        }
    }

    public function edit($id)
    {
        if ($this->Authentication->getResult()->getData()['role'] == "admin") { // Only authenticated user with admin role can access
            $salyTable = $this->getTableLocator()->get('saly');
            $sal = $salyTable->get($id);
            $this->loadModel('Saly');
            if ($this->request->is(['patch', 'post', 'put'])) {
                $sal = $this->Saly->patchEntity($this->Saly->newEmptyEntity(), $this->request->getData());
                if ($this->Saly->save($sal)) {
                    $id_salu = $sal->id_sal;
                    $this->Flash->success(__('Sál byl přidán'));

                    return $this->redirect(['controller' => 'Saly', 'action' => 'edit', $id_salu]);
                }
                $this->Flash->error(__('Nepodařilo se uložit sál. Prosím zkuste to znovu.'));
            }
            $this->set(compact('sal'));
        }
    }

    public function delete($id = null)
    {
        if ($this->Authentication->getResult()->getData()['role'] == "admin") { // Only authenticated user with admin role can access

            $this->request->allowMethod(['post', 'delete']);
            $sal = $this->Saly->get($id);
            if ($this->Saly->delete($sal)) {
                $this->Flash->success(__('Sál byl smazán'));
            } else {
                $this->Flash->error(__('Nepodařilo se smazat sál. Prosím zkuste to znovu.'));
            }

            return $this->redirect(['action' => 'index']);
        }
    }
}
