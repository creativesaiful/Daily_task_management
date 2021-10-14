<?php
$connection = mysqli_connect("localhost", "root", "", "daily_task");

$inc_query = "SELECT * FROM `task` WHERE `task_status`=0";

$inc_result = mysqli_query($connection, $inc_query);

$com_query = "SELECT * FROM `task` WHERE `task_status`=1";

$com_result = mysqli_query($connection, $com_query);




?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Task Sheet</title>
    <link rel="icon" href="Logo.png" type="image/gif" sizes="16x16">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">

</head>

<body>

    <div class="container">
        <h2 class="text-center mt-5">Daily Task Sheet</h2>

        <h4>Complete Task</h4>

        <table class="table">
            <thead>
                <tr>
                    <th>Task Name</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                <?php

                while ($com_res = mysqli_fetch_assoc($com_result)) {


                ?>
                    <tr>
                        <td> <?php echo $com_res['task_name'] ?> </td>
                        <td><?php echo $com_res['task_date'] ?></td>
                        <td>
                            Complete
                        </td>
                    </tr>
                <?php
                }
                ?>

            </tbody>
        </table>

        <h4 class="mt-5">Upcomming Task</h4>

        <table class="table">
            <thead>
                <tr>
                    
                    <th>Task Name</th>
                    <th>Date</th>
                    <th>Action</th>

                </tr>
            </thead>

            <tbody>

                <?php while ($res = mysqli_fetch_assoc($inc_result)) {
                ?>

                    <tr>
                      

                        <td> <?php echo $res['task_name'] ?> </td>
                        <td> <?php echo $res['task_date'] ?></td>
                        <td>
                            <a href="#" class="make_complete" data-taskid=<?php echo $res['id'] ?>> Make Complete</a> ||

                            <a href="#" class="delete" data-delid= <?php echo $res['id'] ?>> Delete</a>

                            
                        </td>
                    </tr>

                <?php } ?>


            </tbody>
        </table>

        <h4 class="mt-5">Add Task</h4>

        <form action="action.php" method="POST">
            <div class="form-group">
                <label for="tname">Task Name</label>
                <input type="text" name="tname" class="form-control">
            </div>

            <div class="form-group">
                <label for="tdate">Task Date</label>
                <input type="date" name="tdate" class="form-control">
            </div>

            <input type="submit" value="Add Task" name="button" class="btn btn-primary mt-2">
        </form>


    
        <form action="action.php"  method="POST" id="com_from">
            <input type="hidden" name="action" value="complete">
            <input type="hidden" name="taskid" class="taskid">
        </form>


        <form action="action.php"  method="POST" id="del_from">
            <input type="hidden" name="action" value="delete">
            <input type="hidden" name="delid" class="delid">
        </form>

       
    </div>




</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        $(".make_complete").on("click", function() {
            $taskId = ($(this).data("taskid"));

            $(".taskid").val($taskId);
            $("#com_from").submit();
        })

        $(".delete").on("click", function() {
            $delId = ($(this).data("delid"));

            $(".delid").val($delId);
            $("#del_from").submit();
        })
    })
</script>

</html>