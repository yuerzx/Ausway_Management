<?php

include "config.php";

function add_contact_sql(){
  /*创建表，name为唯一的数值，不可重复*/
  global $wpdb;
  global $table_student;
  $table_attachments = $wpdb->prefix.'eazplus_attachments';
  $table_sponsor = $wpdb->prefix.'eazplus_sponsor';
  $table_agency = $wpdb->prefix.'eazplus_agency';
  $table_process = $wpdb->prefix.'eazplus_process';
  if($wpdb->get_var("SHOW TABLES LIKE '".$table_student."'")!=$table_student){
    $sql_students = "
      CREATE TABLE $table_student(
        student_id int(10) NOT NULL AUTO_INCREMENT,
        sponsor_id int(10),
        agency_id int(10),
        student_name varchar(255) NOT NULL UNIQUE,
        student_phone varchar(30),
        student_email varchar(255),
        student_visa varchar(255),
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
    $sql_attachments = "
      CREATE TABLE $table_attachments(
        attachment_id int(10) NOT NULL AUTO_INCREMENT,
        sponsor_id int(10),
        student_id int(10),
        attachment_url varchar(255),
        attachment_checked int(1),
        attachment_name int(255),
        attachment_date date,
        attachment_notes text,
        PRIMARY KEY(attachment_id),
        INDEX (sponsor_id,student_id)
      )CHARSET=utf8;
    ";
    $sql_sponsor = "
      CREATE TABLE $table_sponsor(
        sponsor_id int(10) NOT NULL AUTO_INCREMENT,
        sponsor_name varchar(255) NOT NULL UNIQUE,
        middle_name varchar(254),
        sponsor_notes text,
        PRIMARY KEY(sponsor_id)
      )CHARSET=utf8;
    ";
    $sql_agency = "
      CREATE TABLE $table_agency(
        agency_id int(10) NOT NULL AUTO_INCREMENT,
        agency_name varchar(255) NOT NULL UNIQUE,
        agency_nickname varchar(30),
        agency_phone varchar(30),
        agency_email varchar(255),
        agency_notes text,
        student_id int(10),
        sponsor_id int(10),
        PRIMARY KEY(agency_id),
        INDEX (sponsor_id,student_id)
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
  $wpdb-> query($sql_attachments);
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