<?php
require_once 'includes/db.php';

if (!defined('DEFAULT_URL')) {
    define('DEFAULT_URL', 'http://localhost/projects/to-do_list/');
}
function debug($tmp){
    echo '<pre>';
    print_r($tmp);
    echo '</pre>';
    exit();
}
function dbCheckError($query)
{
    $errInfo = $query->errorInfo();
    if ($errInfo[0] !== PDO::ERR_NONE){
        echo $errInfo[2];
        exit();
    }
    return true;
}

function redirect(){
    header('Location: ' . DEFAULT_URL . 'index.php');
    exit();
}

function pdo_prepare($sql, $params = []) {
    global $pdo;
    $query = $pdo->prepare($sql);
    $query->execute($params);
//    debug($query);
    dbCheckError($query);
    return $query;
}

function CRUD($type, $task = null, $id = null) {
    global $pdo;
    $sql = [
        'delete' => "DELETE FROM tasks WHERE tasks.id = :id",
        'create' => "INSERT INTO tasks (id, task) VALUES (NULL, :task)",
        'update' => "UPDATE tasks SET task = :task WHERE id = :id",
        'select_one' => "SELECT * FROM tasks WHERE id = :id",
        'select_all' => "SELECT * FROM tasks",
        'search' => "SELECT * FROM tasks WHERE task LIKE :search"
    ];

    if ($type === 'select_one' || $type === 'select_all') {
        if ($id === null) {
            return pdo_prepare($sql['select_all'])->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return pdo_prepare($sql['select_one'], [':id' => $id])->fetch(PDO::FETCH_ASSOC);
        }
    } elseif ($type === 'create') {
        pdo_prepare($sql['create'], [':task' => $task]);
    } elseif ($type === 'update') {
        pdo_prepare($sql['update'], [':task' => $task, ':id' => $id]);
    } elseif ($type === 'search') {
        return pdo_prepare($sql['search'], [':search' => $task])->fetchAll(PDO::FETCH_ASSOC);
    } elseif ($type === 'delete') {
        pdo_prepare($sql['delete'], [':id' => $id]);
    }
}


$all_data = CRUD($type = 'select_all');
$search_result = '';
$data = '';

//Поиск
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['search'])){
    $searchQuery = trim($_GET['search']);
    $search_result = CRUD(type: 'search', task: $searchQuery);
}
//Добавление записи
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_todo'])){
    CRUD(type: 'create', task: $_POST['add_todo']);
    redirect();
}
//Удаление
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    CRUD(type: 'delete', id: $id);
    redirect();
}
//Для update.php
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['update_id'])){
    $id_update = $_GET['update_id'];
    $data = CRUD(type: 'select_one', id : $id_update);
}
//Update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task_update'])){
    CRUD(type: 'update', id: $_POST['id_update'], task: $_POST['task_update']);
    redirect();
}