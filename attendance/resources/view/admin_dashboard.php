
<?php
    $sheet = new \App\Models\Sheet;

?>
<main>
    <section class="dashobard-container">

        <form action="/attendance/logout" method="POST">
            <input type="hidden" name="userID" value=<?=$_SESSION['user']->id?>>
            <button>logout</button>
        </form>
        <div class="row">
            <div class="stats-container">
                <div class="registered-stud"><?=count($registered)?></div>
                <div class="num-of-courses"><?=count($course_collection)?></div>
                <div class="sheet_count"><?=count($sheets)?></div>
            </div>

            <?= ($sheet->findOrFail(["admin_id"=>$_SESSION['user']->id, "status"=>'1']))?
             "<form method='POST' action='/attendance/close'>
             <input type='hidden' name='adminId' value={$_SESSION['user']->id}>
             <input type='hidden' name='sheetId' value={$sheet->findOrFail(["admin_id"=>$_SESSION['user']->id, "status"=>'1'])->id}>
               <button id='close-attendance-btn'>close Attendance </button>
             </form>" :
                "<form method='POST' action='/attendance/generate'>
               <input type='hidden' name='courseId' value={$course_collection[0][0]}>
                 <button id='generate-attendance-btn'>Generate Attendance </button>
            </form>" ?>
        </div>
        
    </section>
</main>
