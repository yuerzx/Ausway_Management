<?php
/**
 * Created by PhpStorm.
 * User: sun
 * Date: 14-2-16
 * Time: 下午6:46
 */
require_once 'config.php';

get_header();

if(isset($_GET) && !empty($_GET['student_id'])):
    global $wpdb;
    $table_students = $wpdb->prefix.'eazplus_students';
    $student_id = $_GET['student_id'];
    $student = $wpdb->get_row(
        "
        SELECT * FROM $table_students WHERE student_id = $student_id
        ", ARRAY_A
    );
    if($student):
    ?>

    <?php system_nav() ?>
    <div id="main" class="container-fluid">

        <div class="row">
            <div id="base_infor" class="col-md-3 col-md-offset-2">
            <h3>Student Information</h3>

            <dl class="dl-horizontal">
                <dt>
                   <strong>Name:</strong>
                </dt>
                <dd><?php echo $student['student_name'] ?></dd>
                <dt>
                    <strong>Phone:</strong>
                </dt>
                <dd><?php echo $student['student_phone'] ?></dd>
                <dt>
                    <strong>Email:</strong>
                </dt>
                    <dd><?php echo $student['student_email'] ?></dd>
                <dt>
                    <strong>Agency:</strong>
                </dt>
                   <dd><a href="agency_details.php?student_id=<?php echo $student['agency_id'];?>">
                           <?php if($student['agency_id'] == 0) echo '尚未分配';else echo $student['agency_id']; ?></a></dd>

            </dl>
        </div>
        <div id="process" class="col-md-3">
            <h3>Application Process</h3>
            <ul>
                <li>
                    Process: <?php process_bar($student['student_process']) ?>
                </li>
                <li>
                    Stage: <?php process_name($student['student_process']) ?>
                </li>

            </ul>
        </div></div>
        <div class="row">
            <div id="notes" class="col-md-3 col-md-offset-2">
            <h3>Notes</h3>
            <div class="panel panel-default">
                <div class="panel-body">
                    <?php echo $student['student_notes'] ?>
                </div>

            </div>
            </div>
            <div id="Check List" class="col-md-3">
                <p><strong>This is check list Area:</strong></p>
                <div>

                    <dl>
                        <dt>
                            <input type="checkbox" id="inlineCheckbox1" value="option1" checked> Passport
                        </dt>
                        <dd>
                            The bio page of passport.
                        </dd>
                        <dt>
                            <input type="checkbox" id="inlineCheckbox1" value="option1">&nbsp;Passport Photo</dt>
                        </dt>
                        <dd>
                            One recent passport sized photograph (45 mm x 35 mm) of each person included in the application.
                        </dd>
                    </dl>
                </div>
            </div

        </div>

    </div>
    <?php else: ?>
    echo "Please double check the id and retry. Thanks";
    <?php endif ?>
    <?php endif ?>