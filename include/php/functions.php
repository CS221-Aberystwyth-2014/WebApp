<?php 

// Create and format pagination links 
function paginate($page, $total_pages, $page_links, $url) {
    
    // Calculate the page range to be displayed
    $range = ($page_links - 1) / 2;
    $output = "\n\t\t\t<br />\n";
    $output .= "\t\t\t<ul class=\"pages\">\n";

    // If not on page 1, show back links
    if ($page > 1) {
        $output .= "\t\t\t\t<li><a href='{$url}page=1'>First</a></li>\n "; 
        $prev_page = $page - 1;
        $output .= "\t\t\t\t<li><a href='{$url}page=$prev_page'>Prev</a></li>\n ";
    }

    // Shows links to pages around current page
    for ($i = ($page - $range); $i < (($page + $range) + 1); $i++) {
       
        // If page number is valid
        if (($i > 0) && ($i <= $total_pages)) {

            // If page link is the current page
            if ($i == $page) {
                $output .= "\t\t\t\t<li><a class=\"current\">$i</a></li>\n ";
            
            // If page link is not the current page
            } else {
                $output .= "\t\t\t\t<li><a href='{$url}page=$i'>$i</a></li>\n ";
            }
        }
    }
                     
    // If not on last page, show forward links 
    if ($page != $total_pages) {
       $next_page = $page + 1;
       $output .= "\t\t\t\t<li><a href='{$url}page=$next_page'>Next</a></li>\n ";
       $output .= "\t\t\t\t<li><a href='{$url}page=$total_pages'>Last</a></li>\n ";
    }
    
    $output .= "\t\t\t</ul>\n";
    $output .= "\t\t\t<br />\n";
    
    return $output;
}

?>
