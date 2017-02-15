<?php
namespace App\Lib;
use DB;
class Pagging{

   function displayPaginationBelow($table='',$per_page,$page){
         $page_url="?";
         $query = "SELECT COUNT(*) as totalCount FROM {$table}";
         //dd($query);
         //$rec = mysql_fetch_array(mysql_query($query));
         $rec = DB::select(DB::raw($query));
         $total = $rec[0]->totalCount;
         $adjacents = "2"; 

         $page = ($page == 0 ? 1 : $page);  
         $start = ($page - 1) * $per_page;                        
         
         $prev = $page - 1;                     
         $next = $page + 1;
           $setLastpage = ceil($total/$per_page);
         $lpm1 = $setLastpage - 1;
         
         $setPaginate = "";
         if($setLastpage > 1)
         {  
            $setPaginate .= "<ul class='pagination pagination-sm no-margin pull-right'>";
            //$setPaginate .= "<li class='setPage'>Page $page of $setLastpage</li>";
            if ($setLastpage < 7 + ($adjacents * 2))
            {  
               for ($counter = 1; $counter <= $setLastpage; $counter++)
               {
                  if ($counter == $page)
                     $setPaginate.= "<li><a class='current_page active'>$counter</a></li>";
                  else
                     $setPaginate.= "<li><a href='{$page_url}page=$counter'>$counter</a></li>";             
               }
            }
            elseif($setLastpage > 5 + ($adjacents * 2))
            {
               if($page < 1 + ($adjacents * 2))    
               {
                  for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
                  {
                     if ($counter == $page)
                        $setPaginate.= "<li><a class='current_page active'>$counter</a></li>";
                     else
                        $setPaginate.= "<li><a href='{$page_url}page=$counter'>$counter</a></li>";             
                  }
                  $setPaginate.= "<li><a>...</a></li>";
                  $setPaginate.= "<li><a href='{$page_url}page=$lpm1'>$lpm1</a></li>";
                  $setPaginate.= "<li><a href='{$page_url}page=$setLastpage'>$setLastpage</a></li>";     
               }
               elseif($setLastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
               {
                  $setPaginate.= "<li><a href='{$page_url}page=1'>1</a></li>";
                  $setPaginate.= "<li><a href='{$page_url}page=2'>2</a></li>";
                  $setPaginate.= "<li class='dot'><a>...</a></li>";
                  for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
                  {
                     if ($counter == $page)
                        $setPaginate.= "<li><a class='current_page active'>$counter</a></li>";
                     else
                        $setPaginate.= "<li><a href='{$page_url}page=$counter'>$counter</a></li>";             
                  }
                  $setPaginate.= "<li class='dot'><a>...</a></li>";
                  $setPaginate.= "<li><a href='{$page_url}page=$lpm1'>$lpm1</a></li>";
                  $setPaginate.= "<li><a href='{$page_url}page=$setLastpage'>$setLastpage</a></li>";     
               }
               else
               {
                  $setPaginate.= "<li><a href='{$page_url}page=1'>1</a></li>";
                  $setPaginate.= "<li><a href='{$page_url}page=2'>2</a></li>";
                  $setPaginate.= "<li class='dot'><a>...</a></li>";
                  for ($counter = $setLastpage - (2 + ($adjacents * 2)); $counter <= $setLastpage; $counter++)
                  {
                     if ($counter == $page)
                        $setPaginate.= "<li><a class='current_page active'>$counter</a></li>";
                     else
                        $setPaginate.= "<li><a href='{$page_url}page=$counter'>$counter</a></li>";             
                  }
               }
            }
            
            if ($page < $counter - 1){ 
               $setPaginate.= "<li><a href='{$page_url}page=$next'>Next</a></li>";
                   $setPaginate.= "<li><a href='{$page_url}page=$setLastpage'>Last</a></li>";
            }else{
               $setPaginate.= "<li><a class='current_page active'>Next</a></li>";
                   $setPaginate.= "<li><a class='current_page active'>Last</a></li>";
               }

            $setPaginate.= "</ul>\n";     
         }
       
       
           return $setPaginate;
   }
} 