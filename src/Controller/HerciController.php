<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\Locator\LocatorAwareTrait;

class HerciController extends AppController
{
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authentication->allowUnauthenticated(['index']);
    }

    public function index()
    {
        $herciTable = $this->getTableLocator()->get('Herci');

        $herci = $herciTable->find('all');

        $this->set(compact('herci'));
    }

    public function edit($id)
    {
        $this->loadModel('Herci');
        $herec = $this->Herci->get($id);

        $this->set(compact('herec'));

        if ($this->request->is(['patch', 'post', 'put'])) {
            $herec = $this->Herci->patchEntity($herec, $this->request->getData());
            if ($this->Herci->save($herec)) {
                $this->Flash->success(__('Podrobnosti o herci byly uloženy'));

                return $this->redirect(['controller' => 'Herci', 'action' => 'edit', $id]);
            }
            $this->Flash->error(__('Nepodařilo se uložit podrobnosti o herci. Prosím zkuste to znovu.'));
        }
    }

    public function add()
    {
        if ($this->Authentication->getResult()->getData()['role'] == "admin") { // Only authenticated user with admin role can access
            $this->loadModel('Herci');
            if ($this->request->is(['patch', 'post', 'put'])) {
                $herec = $this->Herci->patchEntity($this->Herci->newEmptyEntity(), $this->request->getData());
                if ($this->Herci->save($herec)) {
                    $id_herec = $herec->id_herec;
                    $this->Flash->success(__('Herec byl přidán'));

                    return $this->redirect(['controller' => 'Herci', 'action' => 'edit', $id_herec]);
                }
                $this->Flash->error(__('Nepodařilo se uložit herce. Prosím zkuste to znovu.'));
            }
        }
    }

    public function delete($id = null)
    {
        if ($this->Authentication->getResult()->getData()['role'] == "admin") { // Only authenticated user with admin role can access

            $this->request->allowMethod(['post', 'delete']);
            $herec = $this->Herci->get($id);
            if ($this->Herci->delete($herec)) {
                $this->Flash->success(__('Herec byl smazán'));
            } else {
                $this->Flash->error(__('Nepodařilo se smazat herec. Prosím zkuste to znovu.'));
            }

            return $this->redirect(['action' => 'index']);
        }
    }
}
