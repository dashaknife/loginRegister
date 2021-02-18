<?php
    $connect = mysqli_connect("localhost", "root", "", "mysite");
    $output = '';
    if(isset($_POST["export"])) {
    $query = "SELECT * FROM users";
    $result = mysqli_query($connect, $query);
    if(mysqli_num_rows($result) > 0) {
        $output .= '<table class="table" bordered="1">
                    <tr>
                         <th>id</th>
                         <th>email</th>
                         <th>password</th>
                    </tr>';
        while($row = mysqli_fetch_array($result)){
        $output .= '<tr>
                    <td>'.$row["id"].'</td>
                    <td>'.$row["email"].'</td>
                    <td>'.$row["password"].'</td>
                </tr>';
        }
        $output .= '</table>';
        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename=download.xls');
        echo $output;
    }
}
?>