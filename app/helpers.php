
<?php
function lower_with_space($value){
     return strtolower(preg_replace('/\s+/', '_', $value));
    }

function base_url(){
     return " http://91.203.133.103:8081";
    }
    ?>