<?php
session_start();

if (!isset($_SESSION['numbers'])) {
    $_SESSION['numbers'] = [10, 20, 30];
}

$average = null;

if (isset($_POST['action'])) {
    if ($_POST['action'] === 'modify') {
        $posicion = $_POST['number'];
        $newNumber = $_POST['newNumber'];
        $_SESSION['numbers'][$posicion] = $newNumber;
    }

    if ($_POST['action'] === 'average') {
        $average = array_sum($_SESSION['numbers']) / count($_SESSION['numbers']);
    }

    if ($_POST['action'] === 'reset'){
        $_SESSION['numbers'] = [10, 20, 30];
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <h2>Modify array saved in session</h2>
</head>

<body>
    <form method="post">
        <label for="number">Position to modify:</label>
        <select id="number" name="number" required>
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
        </select><br>

        <label for="newNumber">New value:</label>
        <input type="number" name="newNumber"><br>

        <button type="submit" name="action" value="modify">Modify</button>
        <button type="submit" name="action" value="average">Average</button>
        <button type="submit" name="action" value="reset">Reset</button>
    </form>
    <p>Current array:
        <?php echo implode(", ", $_SESSION['numbers']); ?>
    </p>

    <?php
    if ($average !== null) {
        echo "Average: " . round($average, 2);
    }
    ?>
</body>

</html>