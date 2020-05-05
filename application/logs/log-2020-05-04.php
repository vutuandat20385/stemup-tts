<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-05-04 08:52:02 --> Severity: Warning --> session_id(): Cannot change session id when session is active C:\xampp\htdocs\stemup-tts\application\libraries\Session.php 53
ERROR - 2020-05-04 09:01:48 --> Severity: Warning --> session_id(): Cannot change session id when session is active C:\xampp\htdocs\stemup-tts\application\libraries\Session.php 53
ERROR - 2020-05-04 10:45:09 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\stemup-tts\application\views\admin\pages\thongke_point.php 46
ERROR - 2020-05-04 10:45:11 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\stemup-tts\application\views\admin\pages\thongke_point.php 46
ERROR - 2020-05-04 10:45:12 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\stemup-tts\application\views\admin\pages\thongke_point.php 46
ERROR - 2020-05-04 10:45:15 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\stemup-tts\application\views\admin\pages\thongke_point.php 46
ERROR - 2020-05-04 10:45:15 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\stemup-tts\application\views\admin\pages\thongke_point.php 46
ERROR - 2020-05-04 10:45:20 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\stemup-tts\application\views\admin\pages\thongke_point.php 46
ERROR - 2020-05-04 10:52:07 --> Severity: Warning --> session_id(): Cannot change session id when session is active C:\xampp\htdocs\stemup-tts\application\libraries\Session.php 53
ERROR - 2020-05-04 10:58:33 --> Severity: Warning --> session_id(): Cannot change session id when session is active C:\xampp\htdocs\stemup-tts\application\libraries\Session.php 53
ERROR - 2020-05-04 11:11:29 --> Severity: Warning --> session_id(): Cannot change session id when session is active C:\xampp\htdocs\stemup-tts\application\libraries\Session.php 53
ERROR - 2020-05-04 11:17:56 --> Severity: Warning --> session_id(): Cannot change session id when session is active C:\xampp\htdocs\stemup-tts\application\libraries\Session.php 53
ERROR - 2020-05-04 11:24:06 --> Severity: Warning --> session_id(): Cannot change session id when session is active C:\xampp\htdocs\stemup-tts\application\libraries\Session.php 53
ERROR - 2020-05-04 11:30:28 --> Severity: Warning --> session_id(): Cannot change session id when session is active C:\xampp\htdocs\stemup-tts\application\libraries\Session.php 53
ERROR - 2020-05-04 11:38:52 --> Severity: Warning --> session_id(): Cannot change session id when session is active C:\xampp\htdocs\stemup-tts\application\libraries\Session.php 53
ERROR - 2020-05-04 11:47:31 --> Severity: Warning --> session_id(): Cannot change session id when session is active C:\xampp\htdocs\stemup-tts\application\libraries\Session.php 53
ERROR - 2020-05-04 13:53:17 --> Severity: Warning --> session_id(): Cannot change session id when session is active C:\xampp\htdocs\stemup-tts\application\libraries\Session.php 53
ERROR - 2020-05-04 14:02:06 --> Severity: Warning --> session_id(): Cannot change session id when session is active C:\xampp\htdocs\stemup-tts\application\libraries\Session.php 53
ERROR - 2020-05-04 14:08:29 --> Severity: Warning --> session_id(): Cannot change session id when session is active C:\xampp\htdocs\stemup-tts\application\libraries\Session.php 53
ERROR - 2020-05-04 14:14:39 --> Severity: Warning --> session_id(): Cannot change session id when session is active C:\xampp\htdocs\stemup-tts\application\libraries\Session.php 53
ERROR - 2020-05-04 14:21:53 --> Severity: Warning --> session_id(): Cannot change session id when session is active C:\xampp\htdocs\stemup-tts\application\libraries\Session.php 53
ERROR - 2020-05-04 14:29:30 --> Severity: Warning --> session_id(): Cannot change session id when session is active C:\xampp\htdocs\stemup-tts\application\libraries\Session.php 53
ERROR - 2020-05-04 14:43:38 --> Severity: Warning --> session_id(): Cannot change session id when session is active C:\xampp\htdocs\stemup-tts\application\libraries\Session.php 53
ERROR - 2020-05-04 19:32:22 --> Severity: Warning --> session_id(): Cannot change session id when session is active C:\xampp\htdocs\stemup-tts\application\libraries\Session.php 53
ERROR - 2020-05-04 19:32:22 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'UNIONSELECT Date, a.totalNewUsers_lmonth, b.totalNewUsers_crmonth
             ' at line 6 - Invalid query: SELECT Date, a.totalNewUsers_lmonth, b.totalNewUsers_crmonth
                        FROM (SELECT DATE_FORMAT(DATE(registered_date), '%d') Date, COUNT(DISTINCT uid) totalNewUsers_lmonth 
                        FROM quiz.savsoft_users WHERE MONTH(DATE(registered_date)) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) 
                        AND YEAR(DATE(registered_date)) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH) GROUP BY DATE(registered_date) ) AS a LEFT JOIN (SELECT DATE_FORMAT(DATE(registered_date), '%d') Date, COUNT(DISTINCT uid) totalNewUsers_crmonth 
                        FROM quiz.savsoft_users  WHERE MONTH( DATE(registered_date))= MONTH(NOW()) 
                        AND YEAR( DATE(registered_date)) = YEAR(NOW()) GROUP BY DATE(registered_date)) AS b USING(Date)UNIONSELECT Date, a.totalNewUsers_lmonth, b.totalNewUsers_crmonth
                        FROM (SELECT DATE_FORMAT(DATE(registered_date), '%d') Date, COUNT(DISTINCT uid) totalNewUsers_lmonth 
                        FROM quiz.savsoft_users WHERE MONTH(DATE(registered_date)) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) 
                        AND YEAR(DATE(registered_date)) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH) GROUP BY DATE(registered_date) ) AS a RIGHT JOIN (SELECT DATE_FORMAT(DATE(registered_date), '%d') Date, COUNT(DISTINCT uid) totalNewUsers_crmonth 
                        FROM quiz.savsoft_users  WHERE MONTH( DATE(registered_date))= MONTH(NOW()) 
                        AND YEAR( DATE(registered_date)) = YEAR(NOW()) GROUP BY DATE(registered_date)) AS b USING(Date)
ERROR - 2020-05-04 19:32:22 --> Severity: error --> Exception: Call to a member function num_rows() on bool C:\xampp\htdocs\stemup-tts\application\models\admin\Admin_model.php 355
ERROR - 2020-05-04 19:32:24 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'UNIONSELECT Date, a.totalNewUsers_lmonth, b.totalNewUsers_crmonth
             ' at line 6 - Invalid query: SELECT Date, a.totalNewUsers_lmonth, b.totalNewUsers_crmonth
                        FROM (SELECT DATE_FORMAT(DATE(registered_date), '%d') Date, COUNT(DISTINCT uid) totalNewUsers_lmonth 
                        FROM quiz.savsoft_users WHERE MONTH(DATE(registered_date)) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) 
                        AND YEAR(DATE(registered_date)) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH) GROUP BY DATE(registered_date) ) AS a LEFT JOIN (SELECT DATE_FORMAT(DATE(registered_date), '%d') Date, COUNT(DISTINCT uid) totalNewUsers_crmonth 
                        FROM quiz.savsoft_users  WHERE MONTH( DATE(registered_date))= MONTH(NOW()) 
                        AND YEAR( DATE(registered_date)) = YEAR(NOW()) GROUP BY DATE(registered_date)) AS b USING(Date)UNIONSELECT Date, a.totalNewUsers_lmonth, b.totalNewUsers_crmonth
                        FROM (SELECT DATE_FORMAT(DATE(registered_date), '%d') Date, COUNT(DISTINCT uid) totalNewUsers_lmonth 
                        FROM quiz.savsoft_users WHERE MONTH(DATE(registered_date)) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) 
                        AND YEAR(DATE(registered_date)) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH) GROUP BY DATE(registered_date) ) AS a RIGHT JOIN (SELECT DATE_FORMAT(DATE(registered_date), '%d') Date, COUNT(DISTINCT uid) totalNewUsers_crmonth 
                        FROM quiz.savsoft_users  WHERE MONTH( DATE(registered_date))= MONTH(NOW()) 
                        AND YEAR( DATE(registered_date)) = YEAR(NOW()) GROUP BY DATE(registered_date)) AS b USING(Date)
ERROR - 2020-05-04 19:32:24 --> Severity: error --> Exception: Call to a member function num_rows() on bool C:\xampp\htdocs\stemup-tts\application\models\admin\Admin_model.php 355
ERROR - 2020-05-04 19:32:24 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'UNIONSELECT Date, a.totalNewUsers_lmonth, b.totalNewUsers_crmonth
             ' at line 6 - Invalid query: SELECT Date, a.totalNewUsers_lmonth, b.totalNewUsers_crmonth
                        FROM (SELECT DATE_FORMAT(DATE(registered_date), '%d') Date, COUNT(DISTINCT uid) totalNewUsers_lmonth 
                        FROM quiz.savsoft_users WHERE MONTH(DATE(registered_date)) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) 
                        AND YEAR(DATE(registered_date)) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH) GROUP BY DATE(registered_date) ) AS a LEFT JOIN (SELECT DATE_FORMAT(DATE(registered_date), '%d') Date, COUNT(DISTINCT uid) totalNewUsers_crmonth 
                        FROM quiz.savsoft_users  WHERE MONTH( DATE(registered_date))= MONTH(NOW()) 
                        AND YEAR( DATE(registered_date)) = YEAR(NOW()) GROUP BY DATE(registered_date)) AS b USING(Date)UNIONSELECT Date, a.totalNewUsers_lmonth, b.totalNewUsers_crmonth
                        FROM (SELECT DATE_FORMAT(DATE(registered_date), '%d') Date, COUNT(DISTINCT uid) totalNewUsers_lmonth 
                        FROM quiz.savsoft_users WHERE MONTH(DATE(registered_date)) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) 
                        AND YEAR(DATE(registered_date)) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH) GROUP BY DATE(registered_date) ) AS a RIGHT JOIN (SELECT DATE_FORMAT(DATE(registered_date), '%d') Date, COUNT(DISTINCT uid) totalNewUsers_crmonth 
                        FROM quiz.savsoft_users  WHERE MONTH( DATE(registered_date))= MONTH(NOW()) 
                        AND YEAR( DATE(registered_date)) = YEAR(NOW()) GROUP BY DATE(registered_date)) AS b USING(Date)
ERROR - 2020-05-04 19:32:24 --> Severity: error --> Exception: Call to a member function num_rows() on bool C:\xampp\htdocs\stemup-tts\application\models\admin\Admin_model.php 355
ERROR - 2020-05-04 19:32:46 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'UNIONSELECT Date, a.totalNewUsers_lmonth, b.totalNewUsers_crmonth
             ' at line 6 - Invalid query: SELECT Date, a.totalNewUsers_lmonth, b.totalNewUsers_crmonth
                        FROM (SELECT DATE_FORMAT(DATE(registered_date), '%d') Date, COUNT(DISTINCT uid) totalNewUsers_lmonth 
                        FROM quiz.savsoft_users WHERE MONTH(DATE(registered_date)) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) 
                        AND YEAR(DATE(registered_date)) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH) GROUP BY DATE(registered_date) ) AS a LEFT JOIN (SELECT DATE_FORMAT(DATE(registered_date), '%d') Date, COUNT(DISTINCT uid) totalNewUsers_crmonth 
                        FROM quiz.savsoft_users  WHERE MONTH( DATE(registered_date))= MONTH(NOW()) 
                        AND YEAR( DATE(registered_date)) = YEAR(NOW()) GROUP BY DATE(registered_date)) AS b USING(Date)UNIONSELECT Date, a.totalNewUsers_lmonth, b.totalNewUsers_crmonth
                        FROM (SELECT DATE_FORMAT(DATE(registered_date), '%d') Date, COUNT(DISTINCT uid) totalNewUsers_lmonth 
                        FROM quiz.savsoft_users WHERE MONTH(DATE(registered_date)) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) 
                        AND YEAR(DATE(registered_date)) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH) GROUP BY DATE(registered_date) ) AS a RIGHT JOIN (SELECT DATE_FORMAT(DATE(registered_date), '%d') Date, COUNT(DISTINCT uid) totalNewUsers_crmonth 
                        FROM quiz.savsoft_users  WHERE MONTH( DATE(registered_date))= MONTH(NOW()) 
                        AND YEAR( DATE(registered_date)) = YEAR(NOW()) GROUP BY DATE(registered_date)) AS b USING(Date)
ERROR - 2020-05-04 19:32:46 --> Severity: error --> Exception: Call to a member function num_rows() on bool C:\xampp\htdocs\stemup-tts\application\models\admin\Admin_model.php 355
ERROR - 2020-05-04 19:33:35 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'UNIONSELECT Date, a.totalNewUsers_lmonth, b.totalNewUsers_crmonth
             ' at line 6 - Invalid query: SELECT Date, a.totalNewUsers_lmonth, b.totalNewUsers_crmonth
                        FROM (SELECT DATE_FORMAT(DATE(registered_date), '%d') Date, COUNT(DISTINCT uid) totalNewUsers_lmonth 
                        FROM quiz.savsoft_users WHERE MONTH(DATE(registered_date)) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) 
                        AND YEAR(DATE(registered_date)) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH) GROUP BY DATE(registered_date) ) AS a LEFT JOIN (SELECT DATE_FORMAT(DATE(registered_date), '%d') Date, COUNT(DISTINCT uid) totalNewUsers_crmonth 
                        FROM quiz.savsoft_users  WHERE MONTH( DATE(registered_date))= MONTH(NOW()) 
                        AND YEAR( DATE(registered_date)) = YEAR(NOW()) GROUP BY DATE(registered_date)) AS b USING(Date)UNIONSELECT Date, a.totalNewUsers_lmonth, b.totalNewUsers_crmonth
                        FROM (SELECT DATE_FORMAT(DATE(registered_date), '%d') Date, COUNT(DISTINCT uid) totalNewUsers_lmonth 
                        FROM quiz.savsoft_users WHERE MONTH(DATE(registered_date)) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) 
                        AND YEAR(DATE(registered_date)) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH) GROUP BY DATE(registered_date) ) AS a RIGHT JOIN (SELECT DATE_FORMAT(DATE(registered_date), '%d') Date, COUNT(DISTINCT uid) totalNewUsers_crmonth 
                        FROM quiz.savsoft_users  WHERE MONTH( DATE(registered_date))= MONTH(NOW()) 
                        AND YEAR( DATE(registered_date)) = YEAR(NOW()) GROUP BY DATE(registered_date)) AS b USING(Date)
ERROR - 2020-05-04 19:33:35 --> Severity: error --> Exception: Call to a member function num_rows() on bool C:\xampp\htdocs\stemup-tts\application\models\admin\Admin_model.php 355
ERROR - 2020-05-04 19:33:48 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'UNIONSELECT Date, a.totalNewUsers_lmonth, b.totalNewUsers_crmonth
             ' at line 6 - Invalid query: SELECT Date, a.totalNewUsers_lmonth, b.totalNewUsers_crmonth
                        FROM (SELECT DATE_FORMAT(DATE(registered_date), '%d') Date, COUNT(DISTINCT uid) totalNewUsers_lmonth 
                        FROM quiz.savsoft_users WHERE MONTH(DATE(registered_date)) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) 
                        AND YEAR(DATE(registered_date)) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH) GROUP BY DATE(registered_date) ) AS a LEFT JOIN (SELECT DATE_FORMAT(DATE(registered_date), '%d') Date, COUNT(DISTINCT uid) totalNewUsers_crmonth 
                        FROM quiz.savsoft_users  WHERE MONTH( DATE(registered_date))= MONTH(NOW()) 
                        AND YEAR( DATE(registered_date)) = YEAR(NOW()) GROUP BY DATE(registered_date)) AS b USING(Date)UNIONSELECT Date, a.totalNewUsers_lmonth, b.totalNewUsers_crmonth
                        FROM (SELECT DATE_FORMAT(DATE(registered_date), '%d') Date, COUNT(DISTINCT uid) totalNewUsers_lmonth 
                        FROM quiz.savsoft_users WHERE MONTH(DATE(registered_date)) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) 
                        AND YEAR(DATE(registered_date)) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH) GROUP BY DATE(registered_date) ) AS a RIGHT JOIN (SELECT DATE_FORMAT(DATE(registered_date), '%d') Date, COUNT(DISTINCT uid) totalNewUsers_crmonth 
                        FROM quiz.savsoft_users  WHERE MONTH( DATE(registered_date))= MONTH(NOW()) 
                        AND YEAR( DATE(registered_date)) = YEAR(NOW()) GROUP BY DATE(registered_date)) AS b USING(Date)
ERROR - 2020-05-04 19:33:48 --> Severity: error --> Exception: Call to a member function num_rows() on bool C:\xampp\htdocs\stemup-tts\application\models\admin\Admin_model.php 355
ERROR - 2020-05-04 19:38:17 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\stemup-tts\application\views\admin\pages\thong_ke_user.php 22
ERROR - 2020-05-04 19:38:17 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\stemup-tts\application\views\admin\pages\thong_ke_user.php 28
ERROR - 2020-05-04 19:38:17 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\stemup-tts\application\views\admin\pages\thong_ke_user.php 120
ERROR - 2020-05-04 19:38:17 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\stemup-tts\application\views\admin\pages\thong_ke_user.php 131
ERROR - 2020-05-04 19:38:17 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\stemup-tts\application\views\admin\pages\thong_ke_user.php 134
ERROR - 2020-05-04 19:38:17 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\stemup-tts\application\views\admin\pages\thong_ke_user.php 145
ERROR - 2020-05-04 19:38:17 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\stemup-tts\application\views\admin\pages\thong_ke_user.php 148
ERROR - 2020-05-04 19:38:17 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\stemup-tts\application\views\admin\pages\thong_ke_user.php 158
ERROR - 2020-05-04 19:38:17 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\stemup-tts\application\views\admin\pages\thong_ke_user.php 161
ERROR - 2020-05-04 19:38:49 --> Severity: Warning --> session_id(): Cannot change session id when session is active C:\xampp\htdocs\stemup-tts\application\libraries\Session.php 53
ERROR - 2020-05-04 19:38:49 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\stemup-tts\application\views\admin\pages\thong_ke_user.php 22
ERROR - 2020-05-04 19:38:49 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\stemup-tts\application\views\admin\pages\thong_ke_user.php 28
ERROR - 2020-05-04 19:38:49 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\stemup-tts\application\views\admin\pages\thong_ke_user.php 120
ERROR - 2020-05-04 19:38:49 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\stemup-tts\application\views\admin\pages\thong_ke_user.php 131
ERROR - 2020-05-04 19:38:49 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\stemup-tts\application\views\admin\pages\thong_ke_user.php 134
ERROR - 2020-05-04 19:38:49 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\stemup-tts\application\views\admin\pages\thong_ke_user.php 145
ERROR - 2020-05-04 19:38:49 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\stemup-tts\application\views\admin\pages\thong_ke_user.php 148
ERROR - 2020-05-04 19:38:49 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\stemup-tts\application\views\admin\pages\thong_ke_user.php 158
ERROR - 2020-05-04 19:38:49 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\stemup-tts\application\views\admin\pages\thong_ke_user.php 161
ERROR - 2020-05-04 19:39:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\stemup-tts\application\views\admin\pages\thong_ke_user.php 22
ERROR - 2020-05-04 19:39:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\stemup-tts\application\views\admin\pages\thong_ke_user.php 131
ERROR - 2020-05-04 19:39:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\stemup-tts\application\views\admin\pages\thong_ke_user.php 145
ERROR - 2020-05-04 19:39:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\stemup-tts\application\views\admin\pages\thong_ke_user.php 158
ERROR - 2020-05-04 19:43:08 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\stemup-tts\application\views\admin\pages\thong_ke_user.php 22
ERROR - 2020-05-04 19:43:15 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\stemup-tts\application\views\admin\pages\thong_ke_user.php 22
