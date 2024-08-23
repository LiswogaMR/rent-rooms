<?php

    include("../connection.php");
    include('../session_data.php');
    set_time_limit(0);

    $dataDraw = (int)($_POST['draw']);
    $dataStart = (int)($_POST['start']);
    $dataLength = (int)($_POST['length']);
    $dataSearch = $_POST['search']['value'];
    $orderColumn = (int)($_POST['order'][0]['column']);
    $orderDirection = $_POST['order'][0]['dir'];

    $columnName = $_POST['columns'][$orderColumn]["name"];

    $data = array();

    $recordsTotal = 0;
    $r = 0;

    $rows = get_records($dataSearch, $columnName, $orderDirection, $dataLength, $dataStart,$conn, false);

    foreach ($rows AS $row) {
        $data['data'][$r]['rowID'] = $r;
        $data['data'][$r]['year'] = $row['year'];
        $data['data'][$r]['total'] = $row['total'];
        $data['data'][$r]['status'] = $row['leave_name'];

        ++$r;
    };

    $rows = get_records($dataSearch, $columnName, $orderDirection, $dataLength, $dataStart,$conn, true);

    $recordsTotal = count($rows);

    if($recordsTotal == 0){
        $data['data'] = [];
    };

    $data['recordsFiltered'] = $recordsTotal;
    $data['recordsTotal'] = $recordsTotal;

    die(json_encode($data));

    function get_records($dataSearch, $columnName, $orderDirection, $dataLength, $dataStart,$conn, $limit = false){
        $appraisal_totals_resultset = "SELECT COUNT(A.id) AS total, A.year, A.leave_type_id, B.name AS leave_name, B.id
                                        FROM leave_management_systems.leave A, leave_management_systems.leave_type B
                                        WHERE A.leave_type_id = B.id "; 
                        
        if($dataSearch != ''){
            $appraisal_totals_resultset .= "AND year LIKE '%".$dataSearch."%' ";
            $appraisal_totals_resultset .= "OR name LIKE '%".$dataSearch."%' ";
        };
        
        $appraisal_totals_resultset .= "Group by year, leave_name ";

        $appraisal_stmt_resultset = mysqli_query($conn, $appraisal_totals_resultset);
        return $rows = mysqli_fetch_all($appraisal_stmt_resultset, MYSQLI_ASSOC);
    }
?>