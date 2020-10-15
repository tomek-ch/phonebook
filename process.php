<?php

    require_once('index.php');
    session_start();

    $mysqli = new mysqli('localhost', 'root', '', 'phonebook') or die(mysqli_error($mysqli));


    $name = '';
    $description = '';
    $phone = '';
    $email = '';
    $website = '';

    $id = 0;
    $update = false;

    if (isset($_POST['add'])) {
        $name = $_POST['company-name'];
        $description = $_POST['company-description'];
        $phone = $_POST['company-phone-number'];
        $email = $_POST['company-email'];
        $website = $_POST['company-website'];

        $mysqli->query("INSERT INTO companies VALUES
            (null, '$name', '$description', '$phone', '$email', '$website')")
            or die($mysqli->error);
        
        $_SESSION['message'] = 'Record has been saved!';
        $_SESSION['msg_type'] = 'save';

        header('location: index.php');
    }

    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $mysqli->query("DELETE FROM companies WHERE id = $id") or die($_GETmysqli->error());

        $_SESSION['message'] = 'Record has been deleted!';
        $_SESSION['msg_type'] = 'delete';
        
        header('location: index.php');
    }

    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $update = true;
        $result = $mysqli->query("SELECT * FROM companies WHERE id=$id") or die($mysqli->error());

        if ($result->num_rows) {
            $row = $result->fetch_array();

            $name = $row['name'];
            $description = $row['description'];
            $phone = $row['phone'];
            $email = $row['email'];
            $website = $row['website'];
        }
    }

    if (isset($_POST['update'])) {
        $id = $_POST['id'];

        $name = $_POST['company-name'];
        $description = $_POST['company-description'];
        $phone = $_POST['company-phone-number'];
        $email = $_POST['company-email'];
        $website = $_POST['company-website'];

        $mysqli->query("UPDATE companies SET
            name = '$name',
            description = '$description',
            phone = '$phone',
            email = '$email',
            website = '$website' WHERE id = $id") or die($mysqli->error());
        
        $_SESSION['message'] = 'Record has been updated!';
        $_SESSION['msg_type'] = 'save';

        header('location: index.php');
    }


    if (!isset($_SESSION['auth'])) {
        $_SESSION['auth'] = false;
    }

    if (isset($_POST['login']) && isset($_POST['password'])) {

        if ($_POST['login'] === 'janusz' && $_POST['password'] === 'janusz123') {

            $_SESSION['auth'] = true;
            header('location: index.php');

        } else {

            $_SESSION['auth'] = false;
            header('location: auth.php');

        }
    }
?>