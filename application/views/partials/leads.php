<?php   if($leads == "No Result"){ ?>
                <div class="col-lg-12">
                    <p>No Leads Available</p>
                </div>
<?php   }
        else{
            foreach($leads as $lead){ ?>
                <tr>
                    <td><?= $lead["leads_id"] ?></td>
                    <td><?= $lead["first_name"] ?></td>
                    <td><?= $lead["last_name"] ?></td>
                    <td><?= DATE("Y-m-d", STRTOTIME($lead["registered_datetime"])) ?></td>
                    <td><?= $lead["email"] ?></td>
                </tr>
<?php       } 
        }?>