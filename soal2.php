<!DOCTYPE html>
<html>
<head>
    <title>soal2</title>
</head>
<body>
    <h1>Laporan Hobi dan Jumlah Orang</h1>

    <!-- Form pencarian hobi -->
    <form method="GET">
        <input type="text" name="searchHobi" placeholder="Cari hobi" style="width: 400px; height: 20px;">
        <input type="submit" value="SEARCH">
    </form>

    <table border="1" style="margin-top: 20px;">
        <tr>
            <th>Hobi</th>
            <th>Jumlah Orang</th>
        </tr>

        <?php
        $db_host = "localhost"; 
        $db_user = "root";
        $db_pass = "";
        $db_name = "testdb";

        $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

        if (!$conn) {
            die("Koneksi database gagal: " . mysqli_connect_error());
        }

        // Ambil nilai search dari form jika ada
        $searchHobi = isset($_GET['searchHobi']) ? $_GET['searchHobi'] : '';

        // Query SQL dengan kondisi pencarian
        $sql = "SELECT hobi.hobi, COUNT(DISTINCT hobi.person_id) AS jumlah_orang
                FROM hobi
                WHERE hobi.hobi LIKE ?
                GROUP BY hobi.hobi
                ORDER BY jumlah_orang DESC";

        // Prepared statement untuk keamanan dari SQL injection
        $stmt = mysqli_prepare($conn, $sql);
        $paramHobi = "%$searchHobi%";  // Format untuk LIKE dengan wildcard
        mysqli_stmt_bind_param($stmt, "s", $paramHobi);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        // Jika ada hasil, tampilkan dalam tabel
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['hobi'] . "</td>";
                echo "<td>" . $row['jumlah_orang'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='2'>Tidak ada data ditemukan</td></tr>";
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        ?>
    </table>
</body>
</html>