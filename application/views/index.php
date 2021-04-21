<?php
    if($this->session->userdata("current_page") == NULL)
        $this->session->set_userdata("current_page", 1);
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Village88 Training | Web Fundamentals | CSS | Bootstrap">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <title>Ajax | Leads</title>
    </head>
    <body class="d-flex flex-column h-100">
        <nav class="navbar navbar-expand-lg navbar-light bg-primary">
            <div class="container">
                <a class="navbar-brand text-light" href="<?= base_url(); ?>">Leads</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>
        <div class="container">
            <form id="search" action="search" method="POST" class="mt-4">
                <div class="form-row">
                    <div class="col-4">
                        <input type="text" class="form-control" name="name" placeholder="Name">
                    </div>
                    <div class="col-2 offset-4">
                        <input type="date" name="start_date" class="form-control">
                    </div>
                    <div class="col-2">
                        <input type="date" name="end_date" class="form-control">
                    </div>
                </div>
            </form>
            <nav class="float-right mt-5" aria-label="Page navigation example">
                <ul class="pagination">
                </ul>
            </nav>
            <table class="table table-hover table-striped">
                <caption>List of Leads</caption>
                <thead class="bg-primary text-light">
                    <tr>
                        <th>Leads ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Registered Datetime</th>
                        <th>Email Address</th>
                    </tr>
                </thead>
                <tbody id="leads">
                </tbody>
            </table>
        </div>
        <footer class="container footer mt-auto text-primary text-center mt-5">
            <p>© 2021 Village88 | All Rights Reserved</p>
        </footer>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                function search(){
                    $.post($("#search").attr("action"), $("#search").serialize(), function(res){
                        $("#leads").html(res);
                    });
                }

                function update_pagination(){
                    $.get("<?= base_url() ?>leads/update_pagination", function(res){
                        $(".pagination").html(res);
                    });
                }

                search();

                $.get("<?= base_url() ?>leads/get_pages", function(res){
                    $(".pagination").html(res);
                });

                $(document).on("blur", "#search", function(){
                    <?= $this->session->set_userdata("current_page", 1); ?>
                    $.post($(this).attr("action"), $(this).serialize(), function(res){
                        $("#leads").html(res);
                        update_pagination();
                    });

                    return false;
                });

                $(document).on("click", ".page-link", function(){
                    $.get("<?= base_url() ?>page/" + $(this).attr("id"), function(){
                        search();
                        update_pagination();
                    });
                });
            });
        </script>
    </body>
</html>