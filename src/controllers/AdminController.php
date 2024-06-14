<?php

require_once 'AppController.php';
require_once 'AccessController.php';
require_once __DIR__.'/../repository/OrderRepository.php';
require_once __DIR__.'/../repository/EmployeeOrdersRepository.php';
require_once __DIR__.'/../repository/ServiceRepository.php';
require_once __DIR__.'/../repository/UserRepository.php';

class AdminController extends AppController {
    public function adminHeader() {
        $this->render(AccessController::AccessCheck('adminHeader'));
    }

    public function adminDashboard() {
        $this->render(AccessController::AccessCheck('adminDashboard'));
    }

    public function adminReservations() {
        ob_start();

        if (!$this->isPost()) {
            $this->render(AccessController::AccessCheck('adminReservations'));
        }

        $repoOrder = new OrderRepository();
        $repoUser = new UserRepository();
        $repoEmployeeOrder = new EmployeeOrdersRepository();

        if (isset($_POST['delete']) && !empty($_POST['delete'])) {
            $deleteId = htmlspecialchars($_POST['delete']);
            $success = $repoOrder->deleteObject($deleteId);

            if ($success) {
                header("Location: /adminReservations");
                exit();
            } else {
                header("Location: /main");
                exit();
            }
        }

        if (isset($_POST['users-button']) && !empty($_POST['users-button'])) {
            $userAndOrderId = htmlspecialchars($_POST['users-button']);
            $parts = explode(" ", $userAndOrderId);

            $orderId = $parts[0];
            $userEmail = $parts[1];
            $userId = $repoUser->getObject($userEmail)->getId();
            $repoOrder->changeObject($orderId, 'w trakcie realizacji');
            $repoEmployeeOrder->createObject($userId, $orderId);

            header("Location: /adminReservations");
            exit();
        }

        if (isset($_POST['done']) && !empty($_POST['done'])) {
            $orderId = htmlspecialchars($_POST['done']);
            $result = $repoOrder->changeObject($orderId, 'wykonane');

            header("Location: /adminReservations");
            exit();
        }

        ob_end_flush();
    }

    public function adminUsers() {
        if (!$this->isPost()) {
            $this->render(AccessController::AccessCheck('adminUsers'));
        }

        $repo = new UserRepository();

        if (isset($_POST['delete']) && !empty($_POST['delete'])) {
            $deleteId = htmlspecialchars($_POST['delete']);
            $success = $repo->deleteObject($deleteId);

            if ($success) {
                header("Location: /adminUsers");
                exit();
            } else {
                header("Location: /main");
                exit();
            }
        }

        if (isset($_POST['add_admin']) && !empty($_POST['add_admin'])) {
            $adminId = htmlspecialchars($_POST['add_admin']);
            $repo->changeObject($adminId, 'admin');
            header("Location: /adminUsers");
            exit();
        }

        if (isset($_POST['add_employee']) && !empty($_POST['add_employee'])) {
            $clientId = htmlspecialchars($_POST['add_employee']);
            $repo->changeObject($clientId, 'employee');
            header("Location: /adminUsers");
            exit();
        }
    }

    public function adminClients() {
        if (!$this->isPost()) {
            $this->render(AccessController::AccessCheck('adminUsers'));
        }

        $repo = new UserRepository();

        if (isset($_POST['delete']) && !empty($_POST['delete'])) {
            $deleteId = htmlspecialchars($_POST['delete']);
            $success = $repo->deleteObject($deleteId);

            if ($success) {
                header("Location: /adminUsers");
                exit();
            } else {
                header("Location: /main");
                exit();
            }
        }

        if (isset($_POST['add_admin']) && !empty($_POST['add_admin'])) {
            $adminId = htmlspecialchars($_POST['add_admin']);
            $repo->changeObject($adminId, 'admin');
            header("Location: /adminUsers");
            exit();
        }

        if (isset($_POST['add_employee']) && !empty($_POST['add_employee'])) {
            $clientId = htmlspecialchars($_POST['add_employee']);
            $repo->changeObject($clientId, 'employee');
            header("Location: /adminUsers");
            exit();
        }
    }
}
