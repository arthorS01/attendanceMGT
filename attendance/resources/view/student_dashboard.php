<?php
    $user = new \App\Models\User;
    $sheet = new \App\Models\Sheet;
    $signSheet = new \App\Models\SignSheet;
?>
<main>
    <section class="dashobard-container">

        <form action="/attendance/logout" method="POST">
            <input type="hidden" name="userID" value=<?=$_SESSION['user']->id?>>
            <button>logout</button>
        </form>
        <div class="row">
            <div class="stats-container">
                <div class="num-of-courses"><?=count($courses_taken)?></div>
            </div>
            
            <table>
                <thead>
                    <tr>
                        <td>Code</td>
                        <td>Unit</td>
                        <td>Instructor</td>
                        <td>Status</td>
                        <td>Attendance</td>
                    </tr>
                </thead>

                <tbody>
                <?php foreach($courses_taken as $course):?>
                    <tr>
                        <td><?=$course["code"]?></td>
                        <td><?=$course["unit"]?></td>
                        <td><?=($user->findOrFail(["id"=>$course["instructor_id"]]))->fname?></td>
                        <td>
                            <?=($sheet->findOrFail(["course"=>$course["code"], "status"=>"1"])? "active":"in active")?>
                        </td>
                        <td><?=$signSheet->findOrFail(["course_id"=>$course["id"], "student_id"=>$_SESSION["user"]->id])? "signed-in" :
                        ($sheet->findOrFail(["course"=>$course["code"], "status"=>"1"])?"
                        <form method='POST' action='/attendance/student/sign'>
                            <input type='hidden' name='studentId' value={$_SESSION['user']->id}>
                            <input type='hidden' name='courseId' value={$course['id']}>
                            <input type='hidden' name='sheetId' value={$sheet->findOrFail(['course'=>$course['code'], 'status'=>'1'])->id}>
                            <button id='sign'> Sign in</button></form>":'&nbsp;'
                );
                        ?></td>
                    </tr>

                <?php endforeach;?>
                </tbody>
            </table>
        </div>
        
    </section>
</main>

