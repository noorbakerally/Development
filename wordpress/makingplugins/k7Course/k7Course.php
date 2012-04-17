<?php
/*
Plugin Name: k7 Course Management 
Plugin URI: http://yourdomain.com/
Description: A plugin to manage k7 Courses Display 
Version: 1.0
Author: Noor 
Author URI: http://yourdomain.com
License: GPL
*/

function course_display($course)
{
   extract(shortcode_atts(array('course' => 'course'), $course));
   global $wpdb;
   //skip,show
   $result=mysql_query("select course_name,starting_date from wp_courses order by starting_date ASC limit $course,1");
   $courseData=mysql_fetch_array($result);
   $courseName=$courseData[0];
   return $courseName; 
}

function course_management_install()
{
	global $wpdb;
	$table_name = $wpdb->prefix . "courses";
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	$sql = "CREATE TABLE $table_name ( id MEDIUMINT NOT NULL AUTO_INCREMENT primary key,course_name VARCHAR(70) DEFAULT '' NOT NULL,starting_date date);";
	dbDelta($sql);
}

function course_management_remove()
{
	global $wpdb;
        $table = $wpdb->prefix."courses";
	$wpdb->query("DROP TABLE IF EXISTS $table");
}

function course_admin_menu ()
{
	add_options_page('Course Management', 'Course Management', 'administrator','course-management', 'course_html_page');
}


if ( is_admin())
{
	add_action('admin_menu', 'course_admin_menu');
}

add_shortcode( 'printCourse', 'course_display');
register_activation_hook(__FILE__,'course_management_install');
register_deactivation_hook( __FILE__, 'course_management_remove' );
?>

<?php
function course_html_page() {
    global $wpdb;
    $table = $wpdb->prefix."courses";
    $coursesData=$wpdb->get_results("select * from $table");
?>
<table border=1 width=600 id="table_courses">
	<tr>
		<th>Course</th>
		<th>Date</th>
		<th>Controls</th>
	</tr>
	<tr>
		<td align="center"><input id="courseName" type="text" size=40/></td>
		<td align="center"><input id="date" type="text" size=40/></td>
	        <td align="center"><button onClick="add()">Add New</button></td>	
	</tr>	
 
	<?php
	 $rowId=0;
	 foreach ($coursesData as $row)
    	 {
	 ?>
		<tr id="tr<?php echo $rowId; ?>">
			<td align="center"><?php echo $row->course_name; ?></td>
			<td align="center"><?php echo $row->starting_date; ?></td>
			<td align="center"><button onClick="del('<?php echo $row->id;?>','<?php echo $rowId;?>')">Delete</button></td>
		</tr>
	<?php
	$rowId++;
        }
	?>
</table>
<?php
}
add_action('admin_head', 'my_action_javascript');
function my_action_javascript() {
?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" >
	function del(id,$rowId)
	{
		var data = {action: 'my_action',status: "delete",id:id};
                $.post(ajaxurl, data, function(response)
                {
			if (response) 
			{
				alert('Courses deleted');
				$("#tr"+$rowId).remove();
			}
		});
	}
	
	function add()
	{
		var data = {action: 'my_action',status: "add",courseName:$("#courseName").val(),startingDate:$("#date").val()};
		$.post(ajaxurl, data, function(response) 
		{
			if (response) alert('Courses added');
			$('#table_courses tr:last').after('<tr><td align="center">'+$("#courseName").val()+'</td><td align="center">'+$("#date").val()+'</td><td>Reload to delete</td></tr>');
			$("#courseName").val("");
			$("#date").val("");
		});
	}


</script>
<?php
}
add_action('wp_ajax_my_action', 'my_action_callback');
function my_action_callback() {
	global $wpdb; // this is how you get access to the database
        $status=$_POST['status'];
	if ($status=='add')
	{
		$courseName=$_POST['courseName'];
		$startingDate=$_POST['startingDate'];
		$row=$wpdb->query("insert into wp_courses (course_name,starting_date) values ('$courseName','$startingDate')");
		echo $row;
	}
	else if ($status=='delete')
	{
		$id=$_POST['id'];
		$row=$wpdb->query("delete from wp_courses where id=$id");
                echo $row;
	}

	die(); // this is required to return a proper result
}
?>
