<?php
    require_once 'CAS.php';
    require_once 'config.php';

    // Enable debugging
    phpCAS::setDebug();
    // Initialize phpCAS
    phpCAS::client(CAS_VERSION_2_0, $cas_host, $cas_port, $cas_context);
    phpCAS::setNoCasServerValidation();
    // force CAS authentication
    phpCAS::forceAuthentication();
    if (isset($_REQUEST['logout'])) {
        phpCAS::logout();
    }

    $ora_db_location = "(DESCRIPTION =
    (ADDRESS = (PROTOCOL = TCP)(HOST = ciruelo)(PORT = 1521))
    (CONNECT_DATA=(SERVER=DEDICATED)(SERVICE_NAME= aleph23))(Client_CSet = UTF-8))";

    $conn = oci_connect("NOR50", "NOR50",  $ora_db_location);

    if($conn){
        echo('CONNECTED');
        $sql = "SELECT z30.z30_note_internal Ubicacion, COUNT(*) Disponibles
        From nor50.z30
        LEFT JOIN nor01.z103 z on substr(Z.Z103_REC_KEY,6,9)=substr(Z30_REC_KEY,1,9)
        LEFT JOIN nor01.z13 on Z13_REC_KEY=substr(Z.Z103_REC_KEY_1,6,9)
        WHERE z30_material='LAPTO'
        and z30_sub_library='INFOR'
        and z.z103_lkr_library='NOR50'
        and z30.z30_date_last_return>TO_NUMBER(TO_CHAR(SYSDATE-360, 'YYYYMMDD'))
        and z30.z30_item_process_status='IP'
        and not exists(select 1 from z36 where Z36_REC_KEY=Z30_REC_KEY)
        GROUP BY  z30.z30_note_internal";

        $stid = oci_parse($conn, $sql);
        oci_execute($stid);
        while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
            // Usar nombres de columna en mayúsculas para los índices del array asociativo
            print_r($row);
            echo("\n");
        }
    }else{
        echo('ERR CONN');
    }

?>