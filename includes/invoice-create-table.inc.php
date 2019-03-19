<?php

function generateOutput($v){
    $output = "<tr>"
            ."<td>".$v['idInvoice']."</td>"
            ."<td>".$v['idOrder']."</td>"
            // echo "<td>".$value['idParent']."</td>";
            ."<td>".$v['firstNameChild']." ".$v['lastNameChild']."</td>"
            . "<td>".date("l, d-M-Y",strtotime($v['dueDate']))."</td>"
            . "<td>".$v['datePaid']."</td>"
            . "<td>".$v['paid']."</td>"
            . "<td>".'R '.sprintf("%.2f", $v['totalPrice'])."</td>"
        . "</tr>";
    return $output;
};

function creatInvoiceTable($isUpcoming,$arrChild){
    $outputHead = "<table>
    <thead>"
    ."<tr>"
        . "<th>".'Invoice ID'."</th>"
        ."<th>".'Order ID'."</th>"
        // echo "<td>".'idParent'."</td>";
        . "<th>".'Name'."</th>"
        ."<th>".'Collection Date'."</th>"
        ."<th>".'Date Paid'."</th>"
        . "<th>".'Status'."</th>"
        . "<th>".'Amount'."</th>"
    . "</tr>"
    ."</thead>
    <tbody>";
    $outputBody = "";
    foreach ($arrChild as $key => $value) {
        if(strtotime($value['dueDate'])>=time() && $isUpcoming){
            $outputBody .= generateOutput($value);
        }else if(strtotime($value['dueDate'])<=time()&&!$isUpcoming){
            $outputBody .= generateOutput($value);
        }

    }
    $outputEnd = "";
    $outputEnd .= "</tbody>
        </table>";
    if($outputBody !== ""){
        echo $outputHead.$outputBody.$outputEnd;    
    }else{
        echo "<h3>No Invoices</h3>";
    }
};
