<footer>
    <?php 
        echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
        // if(date("H:i:s",(time())) < date("H:i:s",strtotime("07:00:00"))
        //     && date("H:i:s",(time())) > date("H:i:s",strtotime("00:00:00"))){
        //         print("test");  
        // }
        // echo '<pre>' . print_r(date("H:i:s",(time())), TRUE) . '</pre>';
        // echo '<pre>' . print_r(date("H:i:s",strtotime("00:00:00")), TRUE) . '</pre>';
        $arr = array();
        $arr[] = "hello";
        // echo '<pre>' . print_r($arr, TRUE) . '</pre>';
        
    ?>
</footer>

</body>
</html>