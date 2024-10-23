<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>soal1</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .form-container {
            border: 1px solid black;
            width: 400px;
            padding: 20px;
            margin: 100px auto;
            text-align: left;
        }
        .form-container input[type="text"] {
            width: 50px;
            text-align: center;
        }
        .form-container input[type="submit"] {
            margin-top: 20px;
            padding: 5px 20px;
        }
        .form-row {
            margin-bottom: 10px;
        }
        .form-row label {
            margin-right: 10px;
        }
        .output {
            font-weight: bold;
        }
        .italic {
            font-style: italic;
        }
    </style>
</head>
<body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['baris']) && isset($_POST['kolom'])) {
    // Menangkap jumlah baris dan kolom
    $baris = intval($_POST['baris']);
    $kolom = intval($_POST['kolom']);

    // Jika input text dikirimkan dari tampilan kedua
    if (isset($_POST['submit_data'])) {
        echo '<div class="form-container">';
        for ($i = 1; $i <= $baris; $i++) {
            for ($j = 1; $j <= $kolom; $j++) {
                // Menangkap nilai input untuk setiap cell
                $cell_value = htmlspecialchars($_POST['cell_' . $i . '_' . $j]);
                echo '<p class="output">' . $i . '.' . $j . ' : ' . $cell_value . '</p>';
            }
        }
    } else {
        ?>

        <!-- Tampilan kedua (Form dinamis berdasarkan input baris dan kolom) -->
        <div class="form-container">
            <form method="POST" action="">
                <?php
                for ($i = 1; $i <= $baris; $i++) {
                    for ($j = 1; $j <= $kolom; $j++) {
                        echo '<label for="cell_' . $i . '_' . $j . '">' . $i . '.' . $j . ':</label>';
                        echo '<input type="text" id="cell_' . $i . '_' . $j . '" name="cell_' . $i . '_' . $j . '">';
                    }
                    echo '<br>';
                }
                ?>
                <input type="hidden" name="baris" value="<?php echo $baris; ?>">
                <input type="hidden" name="kolom" value="<?php echo $kolom; ?>">
                <input type="submit" name="submit_data" value="SUBMIT">
            </form>
        </div>

        <?php
    }
} else {
    ?>

    <!-- Tampilan pertama (Form untuk input jumlah baris dan kolom) -->
    <div class="form-container">
        <form method="POST" action="">
            <div class="form-row">
                <label for="baris">Inputkan Jumlah Baris:</label>
                <input type="text" id="baris" name="baris">
            </div>
            <div class="form-row">
                <label for="kolom">Inputkan Jumlah Kolom:</label>
                <input type="text" id="kolom" name="kolom">
            </div>
            <input type="submit" value="SUBMIT">
        </form>
    </div>

    <?php
}
?>

</body>
</html>