<?php
    //open connection to mysql db
    $connection = mysqli_connect("localhost","bps3500_ipds","jatimsukses35","bps3500_santriapp") or die("Error " . mysqli_error($connection));

    //fetch table rows from mysql db
    $sql = "SELECT an_reservasi.id, an_reservasi.nama, kode as nomor, progres-2 as status,process_by as processedby, an_tujuan.nama as layanan FROM `an_reservasi` inner join an_tujuan on an_reservasi.tujuan=an_tujuan.id where progres in (2,3) and an_reservasi.tanggal=CURRENT_DATE()";
    $result = mysqli_query($connection, $sql) or die("Error in Selecting " . mysqli_error($connection));

    //create an array
    $emparray = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $emparray[] = $row;
    }
    echo json_encode($emparray, JSON_NUMERIC_CHECK);

    //close the db connection
    mysqli_close($connection);
?>