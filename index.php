<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phonebook</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        require_once 'process.php';
    ?>
    
    <?php
        $mysqli = new mysqli('localhost', 'root', '', 'phonebook') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM companies") or die(mysqli_error($mysqli));
    ?>
    
    <?php
        if (isset($_SESSION['message'])): ?>
    <div class="alert alert-<?=$_SESSION['msg_type']; ?>">
        <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        ?>
    </div>
    <?php endif ?>

    <main>
        <table class="companies-list" cellspacing="0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>E-mail</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td>
                        <?php echo $row['name']; ?>
                    </td>
                    <td>
                        <?php echo $row['email']; ?>
                    </td>
                    <td>
                        <?php echo $row['phone']; ?>
                    </td>
                    <td>
                        <a class="btn edit-btn" href="index.php?edit=<?php echo $row['id']; ?>">
                            Edit
                        </a>
                        <a class="btn delete-btn" href="process.php?delete=<?php echo $row['id']; ?>">
                            Delete
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </main>
    <form action="process.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="company-name">
            Company name:
        </label>
        <input type="text" name="company-name" id="company-name" required
            value="<?php echo $name; ?>">
        <label for="company-description">
            Description:
        </label>
        <textarea name="company-description" id="company-description" rows="5" resize>
            <?php echo $description ?>
        </textarea>
        <label for="company-phone-number">
            Phone number
        </label>
        <input type="tel" name="company-phone-number" id="company-phone-number"
            value="<?php echo $phone; ?>">
        <label for="company-email">
            E-mail address:
        </label>
        <input type="email" name="company-email" id="company-email"
            value="<?php echo $email; ?>">
        <label for="company-email">
            Website:
        </label>
        <input type="text" name="company-website" id="company-website"
            value="<?php echo $website; ?>">
        <?php if ($update): ?>
            <button class="btn submit-btn update-btn" type="submit" name="update">
                Update
            </button>
        <?php else: ?>
            <button class="btn submit-btn" type="submit" name="add">
                Add to database
            </button>
        <?php endif; ?>
    </form>
</body>
</html>