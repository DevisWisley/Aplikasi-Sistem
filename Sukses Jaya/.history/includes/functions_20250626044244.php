<?php
session_start();

function checkLogin()
{
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../auth/login.php");
        exit;
    }
}

function isAdmin()
{
    return ($_SESSION['level'] === 'Admin');
}

function isPegawai()
{
    return ($_SESSION['level'] === 'Pegawai');
}

function activeSidebar($page, $currentPage)
{
    return $page === $currentPage ? 'active bg-primary text-white' : '';
}
?>