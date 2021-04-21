<?php   
    if($pages != "None"){
        foreach($pages AS $page){
            for($page_number = 1; $page_number <= $page; $page_number++){
                if($this->session->userdata("current_page") == $page_number){ ?>
                    <li class="page-item active"><a id="<?= $page_number ?>" class="page-link" href="#"><?= $page_number ?></a></li>
<?php           }
                else{ ?>
                    <li class="page-item"><a id="<?= $page_number ?>" class="page-link" href="#"><?= $page_number ?></a></li>
<?php           }
            }
        }
    } 
?>