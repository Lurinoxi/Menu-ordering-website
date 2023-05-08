<!DOCTYPE html>
<html>
<head>
    <title>Mitarbeiterauswertung</title>
    <link rel="stylesheet" type="text/css" href="css/calc.css">
</head>
<body>
    <h1>Mitarbeiterauswertung</h1>
    <form method="get" action="">
        <label for="KW">Kalenderwoche:</label>
        <select id="KW" name="KW">
            <option value="">Alle</option>
            <?php
            // Verbindung zur Datenbank herstellen
            include "config/constants.php";

            // SQL-Abfrage zum Abrufen aller Kalenderwochen mit Bestellungen
            $sql = "SELECT DISTINCT KW FROM tbl_order";
            $result = mysqli_query($conn, $sql);

            // Generiere Dropdown-Liste mit Kalenderwochen
            while ($row = mysqli_fetch_assoc($result)) {
                $kw = $row["KW"];
                $selected = "";
                if (isset($_GET["KW"]) && $_GET["KW"] == "KW$kw") {
                    $selected = "selected";
                }
                echo "<option value='KW$kw' $selected>KW $kw</option>";
            }
            ?>
        </select>
        <input type="submit" value="Filtern">
    </form>
    <?php
    // Überprüfen, ob eine Kalenderwoche ausgewählt wurde
    $selectedWeek = "";
    if (isset($_GET["KW"])) {
        $selectedWeek = $_GET["KW"];
    }

    // SQL-Abfrage zum Abrufen aller Mitarbeiter
    $sql = "SELECT * FROM tbl_admin";
    $result = mysqli_query($conn, $sql);

    // Überprüfen, ob Mitarbeiterdaten vorhanden sind
    if (mysqli_num_rows($result) > 0) {
        // Durchlaufe alle Mitarbeiter
        while ($row = mysqli_fetch_assoc($result)) {
            $employeeId = $row["id"];
            $email = $row["email"];
            $role = $row["role"];
            $abgerechnet = 0.0;

            // SQL-Abfrage zum Abrufen der Bestellungen des Mitarbeiters basierend auf der E-Mail und der ausgewählten Kalenderwoche
            $sql2 = "SELECT SUM(price) AS total FROM tbl_order WHERE email = '$email'";
            if (!empty($selectedWeek)) {
                $selectedWeekNumber = substr($selectedWeek, 2); // Extrahiere die Kalenderwochennummer (ohne "KW" Präfix)
                $sql2 .= " AND KW = $selectedWeekNumber"; // Verwende KW als Präfix für die Kalenderwoche in der Datenbank
            }
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $total = $row2["total"];

            // Abrechnung basierend auf der Rolle des Mitarbeiters
            if ($role != "Lehrling" && $role != "Spezialarbeitskraft") {
                // Nur Mitarbeiter außer Lehrlinge und Spezialarbeitskräfte werden abgerechnet
                $abgerechnet = $total;
            }

            // SQL-Abfrage zum Aktualisieren der Abrechnung des Mitarbeiters
$sql3 = "UPDATE tbl_admin SET abgerechnet = '$abgerechnet' WHERE email = '$email'";
mysqli_query($conn, $sql3);

echo "Mitarbeiter ID: " . $employeeId . "<br>";
echo "Name: " . $row["full_name"] . "<br>";
echo "Rolle: " . $role . "<br>";
echo "Total Bestellungen: €" . $total . "<br>";
echo "Abgerechnet: €" . $abgerechnet . "<br><br>";
}
} else {
    echo "Keine Mitarbeiter gefunden.";
}

// Datenbankverbindung schließen
mysqli_close($conn);

?>
