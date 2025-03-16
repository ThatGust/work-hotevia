<?php
   function get_custom_posts( $post_type="product", $search=false, $taxonomies_array=false, $order = "1", $page=1, $cant=10, &$total_rows, $table_prefix="WordPress34127_"  ){

      $rows = ($page - 1)*$cant;      

      /*
      SELECT distinct wp.* FROM 
         wp_posts wp 
         INNER JOIN wp_term_relationships wtr ON wtr.object_id = wp.ID
         INNER JOIN wp_terms wt ON wt.term_id = wtr.term_taxonomy_id
         INNER JOIN wp_term_taxonomy wtt ON wtt.term_id = wtt.term_id
         WHERE wp.post_type = "product"
         AND wtt.taxonomy = "product_cat";
      */
      global $wpdb;
      $query = 'SELECT wp.ID, wp.post_title FROM '.$table_prefix.'wp_posts wp ';

      if(is_array($taxonomies_array)):
         $i=1;
         foreach($taxonomies_array as $o_item):
            $sf_term_id = $o_item["term_id"];
            $query .= '
               INNER JOIN '.$table_prefix.'wp_term_relationships wtr'.$i.' ON wtr'.$i.'.object_id = wp.ID
               INNER JOIN '.$table_prefix.'wp_term_taxonomy wtt'.$i.' ON wtt'.$i.'.term_id = wtr'.$i.'.term_id AND wtt'.$i.'.term_id = '.$sf_term_id.'
            ';
            $i++;
         endforeach;
      endif;

      $query .= ' WHERE wp.post_type = "'.$post_type.'" AND wp.post_status="publish" ';
      //$query .= 'OFFSET '.$rows.' ROWS FETCH NEXT '.$cant.' ROWS ONLY;';

      if($order == "1"):
         $query .= ' ORDER BY STR_TO_DATE( wp.post_date, "%Y-%m-%d" ) DESC ';
      elseif($order == "2"):
         $query .= ' ORDER BY wp.post_title ASC ';
      elseif($order == "2"):
         $query .= ' ORDER BY wp.ID DESC ';
      endif;

      $total_rows = count($wpdb->get_results($query));

      $query .= 'LIMIT '.$cant.' OFFSET '.$rows;
     
      //var_dump($query); die();

      $rows = $wpdb->get_results($query);

      return $rows;
   }