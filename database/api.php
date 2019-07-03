<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ALL);
include('../config.php');
include('db.php');
$db = new DB(DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = $_POST;
    if(isset($data['login'])) checkLogin($data['username'], $data['password']);
    else if(isset($data['editStories'])) getStoryList($_SESSION['author_id']);
    else if(isset($data['addStory'])) addStory($data);
    else if(isset($data['getStories'])) getAllStories();
    else if(isset($data['deleteStory'])) deleteStory($data);
    else if(isset($data['getSingleStory'])) getStory($data);
}
function checkLogin($username, $password) {
    global $db;
    $author_query = $db->query("SELECT * FROM authors WHERE LOWER(user_id) = '" . strtolower($username) . "' AND (password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1('" . $password . "'))))) OR password = '" . md5($password) . "') AND status = '1'");
    if ($author_query->num_rows) {
            $db->query("UPDATE authors SET last_login = NOW() WHERE id = '" .  $author_query->row['id'] . "'");
            $_SESSION['author_id'] = $author_query->row['id'];
            echo json_encode(['status' => true]);
        } else echo json_encode(['status' => false, 'msg' => 'Invalid User Id or Password!']);
}
function getStoryList($author) {
    global $db;
    $story = $db->query("select * from stories where author_id = '" . $author . "' order by status asc, date_modified desc");
    if($story->num_rows) echo json_encode(['stories' => $story->rows, 'status' => true]);
    else echo json_encode(['status' => false, 'msg' => "No Stories Found!"]);
}
function addStory($data) {
    global $db;
    $data = json_decode(htmlspecialchars_decode($data['data']), true);
    if(isset($data['id'])) {
        $db->query("update stories set heading = '" . $data['heading'] . "', description = '" . $data['description'] . "', status = '" . $data['status'] . "', date_modified = NOW() where id = '" . $data['id'] . "'");
        if($data['status'] == '1') $db->query("insert into story_history set story_id = '" . $data['id'] . "', heading = '" . $data['heading'] . "', description = '" . $data['description'] . "'");
    } else $db->query("insert into stories set heading = '" . $data['heading'] . "', description = '" . $data['description'] . "', status = '" . $data['status'] . "', author_id = '" . $_SESSION['author_id'] . "'");
    getStoryList($_SESSION['author_id']);
}
function getAllStories() {
    global $db;
    echo json_encode(['status' => true, 'data' => $db->query("select id,heading,DATE_FORMAT(date_modified, '%d-%M-%Y') as date_modified, description, (select name from authors b where a.author_id = b.id) as author_name from stories a where status = 1 order by read_status asc, date_modified desc")->rows]);
}
function deleteStory($data) {
    global $db;
    $data = json_decode(htmlspecialchars_decode($data['data']), true);
    $db->query("delete from stories where id = '" . $data['id'] . "'");
    $db->query("delete from story_history where story_id = '" . $data['id'] . "'");
    getStoryList($_SESSION['author_id']);
}
function getStory($data) {
    global $db;
    $story = $db->query("select read_status,author_id,id,heading,description,DATE_FORMAT(date_modified, '%M %d, %Y') as date_modified, (select name from authors b where a.author_id = b.id) as author_name from stories a where status = 1 and id = '" . $data['story_id'] . "'");
    if($story->num_rows) {
        if(isset($_SESSION['author_id']) && $_SESSION['author_id'] == $story->row['author_id'] && $story->row['read_status'] == '0') {
            $db->query("update stories set read_status = 1 where id = '" . $data['story_id'] . "'");
        }
        echo json_encode(['status' => true, 'data' => $story->row]);
    } else echo json_encode(['status' => false]);
}
?>