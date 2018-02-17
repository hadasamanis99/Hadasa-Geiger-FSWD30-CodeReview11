<?php
use PHPUnit\Framework\TestCase;

class StackTest extends TestCase
{
    public function testNumberOfCarsIsCorrect()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "cr11_hadasa_geiger_car_rental";


        $sql = "select location.street_name as street,location.Zip as zip, count(car.pk_Car_id) as number from location join car on location.pk_Location_id=car.fk_Car_Location group by street, zip";
        $result = $conn->query($sql);
        // connection successful? (no error?)
        $this->assertFalse($conn->connect_error);
        // rows were returned? (then $result->num_rows > 0)
        $this->assertGreaterThan($result->num_rows, 0);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if ($row["street"] === 'Geibelgasse 1') {
                    $this->assertSame($row["number"], 1);
                }
            }
     }
}
?>