<?php
/*
Template Name: Full-width layout
Template Post Type: post, page, event
*/

?>
<?php get_header(); ?>

<?php

global $wpdb;
$table_name = $wpdb->prefix . "sw_contact_form_data";
$results = $wpdb->get_results("SELECT * FROM $table_name");
/* echo "<pre>";
print_r($results);

die(); */
$output = "";
$output .= "<div class='container'>
<h3 class='text-center'>Fetch data from sw_contact_form table</h3>
<div class='table-responsive'>
<table class='table table-striped text-center'>
<thead class='thead-dark'>
<tr>
    <th>Sno</th>
    <th>Name</th>
    <th>Email</th>
    <th>Number</th>
</tr>
</thead>
<tbody>";
if (!empty($results)) {
    foreach($results as $row){
        $output .= "<tr>
        <td>" . $row->id . "</td>
        <td>" . ucfirst($row->name) . "</td>
        <td>" . $row->email . "</td>
        <td>" . $row->mobile . "</td>
        </tr>";
    }
    
}
else{
    $output .="<tr>
    <td colspan='9'>No Data Available</td>
    </tr>";
}

$output .= "</tbody>
</table>
</div>

</div>";
echo $output;
?>
<?php get_footer(); ?>
