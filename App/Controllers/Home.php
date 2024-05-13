<?php

namespace App\Controllers;


use App\Models\Book;
use app\System\Controller;
use App\System\Helpers\FormHelper;
use App\System\Libraries\Database\Database;

class Home extends Controller
{
    /**
     * Index Method for showing homepage and base
     */
    public function index()
    {
        $this->view('home/index');
    }

    /**
     * Ajax Form Submit
     */
    public function ajax_submission()
    {
        $form = $this->helpers('FormHelper');
        $form->validate($_POST);
    }

    public function data()
    {
        $book = new Book;
        $book->table('users');
        $book->select(['mobile','pincode']);
        $book->get();
    }


    public function see_report()
    {

        $db = Database::getInstance();
        $connection = $db->connection;
        if (isset($_GET['entry_by']) && isset($_GET['starting_date']) && isset($_GET['ending_date'])) {

            $entry_by = $_GET['entry_by'];
            $starting_date = $_GET['starting_date'];
            $ending_date = $_GET['ending_date'];
            $statement = $connection->prepare("select * from datatable where ((entry_at BETWEEN :starting_date AND :ending_date)) and entry_by= :entry_by");
            $statement->bindValue(':starting_date', $starting_date);
            $statement->bindValue(':ending_date', $ending_date);
            $statement->bindValue(':entry_by', $entry_by);

        } else if (isset($_GET['starting_date']) && isset($_GET['ending_date'])) {
            $starting_date = $_GET['starting_date'];
            $ending_date = $_GET['ending_date'];

            $statement = $connection->prepare("select * from datatable where ((entry_at BETWEEN :starting_date AND :ending_date)) ");
            $statement->bindValue(':starting_date', $starting_date);
            $statement->bindValue(':ending_date', $ending_date);

        } else if (isset($_GET['entry_by'])) {
            $entry_by = $_GET['entry_by'];

            $statement = $connection->prepare("select * from datatable where entry_by = :entry_by");
            $statement->bindValue(':entry_by', $entry_by);

        } else {
            $statement = $connection->prepare('select * from datatable');
        }

        $statement->execute();
        $results = $statement->fetchAll(\PDO::FETCH_OBJ);
        $data['results'] = $results;
        $userStatement = $connection->prepare('select entry_by from datatable group by  entry_by');
        $userStatement->execute();
        $users = $userStatement->fetchAll(\PDO::FETCH_OBJ);
        $data['users'] = $users;

        $this->view('home/see_report', $data);
    }

    public function testFunc()
    {
        $form = new FormHelper;
    }
}
