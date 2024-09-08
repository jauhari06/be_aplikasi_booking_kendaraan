<?= $this->extend('layouts/navbar'); ?>

<?= $this->section('content'); ?>
<style>

    body {
        font-family: Arial, sans-serif; 
    }
    h1 {
        color: #333;
    }
    form {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    form label {
        display: block;
        margin-bottom: 5px;
    }
    form input {
        display: block;
        margin-bottom: 20px;
        width: 100%;
        padding: 5px;
        box-sizing: border-box;
    }
    form input[type="submit"] {
        padding: 10px 20px;
        background-color: #333;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    form input[type="submit"]:hover {
        background-color: #444;
    }
</style>
<form action="<?= base_url('/admin/login'); ?>" method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username">

    <label for="password">Password:</label>
    <input type="password" id="password" name="password">

    <input type="submit" value="Login">
</form>
<?= $this->endSection(); ?>