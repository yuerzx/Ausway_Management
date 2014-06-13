<?php

include_once('config.php');

function add_contact_sql(){
  /*创建表，name为唯一的数值，不可重复*/
    global $wpdb;
    global $table_student;
    global $table_agency;
    global $table_sponsor;
    global $table_process;

  if($wpdb->get_var("SHOW TABLES LIKE '".$table_student."'")!=$table_student){
    $sql_students = "
      CREATE TABLE $table_student(
        student_id int(10) NOT NULL AUTO_INCREMENT,
        sponsor_id int(10),
        agency_id int(10),
        student_name varchar(35) NOT NULL UNIQUE,
        student_eng  varchar(254),
        student_phone varchar(30),
        student_email varchar(254),
        student_address varchar (254),
        student_visa varchar(8),
        process_date DATE,
        student_process int(2),
        student_notes text,
        PRIMARY KEY(student_id),
        INDEX (sponsor_id,agency_id)
      )CHARSET=utf8;
    ";
    /*
    Indicator for process 
    1.  Start to prepare documents
    2.  Publishing Ads
    3.  Sporonship Prepare
    4.  Sporonship Submitted
    5.  Sporonship Docuemtns Required
    6.  Sporonship Approval
    7.  Sporonship Failed
    8.  Nomination prepare
    9.  Nomination submitted
    10. Nomination Docuemtns Required
    11. Nomination approval
    12. Nomination Failed
    13. Visa Application Prepare
    14. Visa Application Submit
    15. Visa Application Docuemtns Required
    16. Visa Application Approval
    17. Visa Application Failed
    18. Deal Closed
    */

    $sql_sponsor = "
      CREATE TABLE $table_sponsor(
        sponsor_id int(10) NOT NULL AUTO_INCREMENT,
        sponsor_name varchar(255) NOT NULL UNIQUE,
        middle_man varchar(254),
        sponsor_notes text,
        PRIMARY KEY(sponsor_id)
      )CHARSET=utf8;
    ";
    $sql_agency = "
      CREATE TABLE $table_agency(
        agency_id int(10) NOT NULL AUTO_INCREMENT,
        agency_name varchar(255) NOT NULL UNIQUE,
        agency_company varchar(30),
        agency_address varchar(254),
        agency_phone varchar(30),
        agency_email varchar(254),
        agency_notes text,
        PRIMARY KEY(agency_id)
      )CHARSET=utf8;
    ";

    $sql_process = "
      CREATE TABLE $table_process(
        process_unique_id int(10) NOT NULL AUTO_INCREMENT,
        process_id int(10) NOT NULL UNIQUE,
        process_name varchar(255),
        PRIMARY KEY(process_unique_id),
        INDEX (process_id)
      )CHARSET=utf8;
    ";
  $wpdb->show_errors();
  $wpdb-> query($sql_students);
  $wpdb-> query($sql_sponsor);
  $wpdb-> query($sql_agency);
  $wpdb-> query($sql_process);

  }
  //$sql1 = "ALTER TABLE `wp_contact` CHANGE `webchat` `wechat` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL";
  //$wpdb->query($sql1);
}

add_contact_sql();
echo 'All done, thanks for using Ausway Management System!';

?>