<?php

   require_once 'CAS.php';
   require_once 'config.php';
   require 'param_conexion.php';

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

   $user = phpCAS::getUser();
   //print_r($user);
    
    function ejecutar(){
        require 'param_conexion.php';
        $ora_db_location = "(DESCRIPTION =
        (ADDRESS = (PROTOCOL = TCP)(HOST =".$oci_host.")(PORT = ".$oci_port."))
        (CONNECT_DATA=(SERVER=DEDICATED)(SERVICE_NAME= ".$oci_DB."))(Client_CSet = UTF-8))";

        $conn = oci_connect($oci_user, $oci_pass,  $ora_db_location); 
        
        if($conn){
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

            $res = [];

            while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
                array_push($res,$row);            
            }
            return $res;

        }
    }
?>

        