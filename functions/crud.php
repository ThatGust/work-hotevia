<?php
   /*
      variables for condition of $custom_fields_array: array( array( "meta_key"=>"fecha_de_expiracion", "condition"=>"AND STR_TO_DATE(%meta_value%, '%Y%m%d') >= CURDATE()"))
      %meta_value%
      %meta_key%
   */
   function get_custom_posts( $post_type="product", $search=false, $taxonomies_array=false, $custom_fields_array=false, $order = "1", $page=1, $cant=10, &$total_rows, $table_prefix="WordPress34127_"  ){

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
            $sf_slug = $o_item['terms'];
            $taxonomy = $o_item['taxonomy'];
            
            $query .= '
            INNER JOIN ' . $table_prefix . 'wp_term_relationships wtr' . $i . ' ON wtr' . $i . '.object_id = wp.ID
            INNER JOIN ' . $table_prefix . 'wp_term_taxonomy wtt' . $i . ' ON wtt' . $i . '.term_taxonomy_id = wtr' . $i . '.term_taxonomy_id
            INNER JOIN ' . $table_prefix . 'wp_terms wt' . $i . ' ON wt' . $i . '.term_id = wtt' . $i . '.term_id
            ';
            $query .= ' AND wt' . $i . '.slug = "' . esc_sql($sf_slug) . '"';
            $i++;
         endforeach;
      endif;

      //inners with custom fields
      if(is_array($custom_fields_array)):
         $i=1;
         foreach($custom_fields_array as $o_item):
            $sf_meta_key = $o_item["meta_key"];
            $sf_condition = $o_item["condition"]; 
            $sf_condition = str_replace("%meta_key%", 'wpm'.$i.'.meta_key', $sf_condition);
            $sf_condition = str_replace("%meta_value%", 'wpm'.$i.'.meta_value', $sf_condition);

            $query .= '
               INNER JOIN '.$table_prefix.'wp_postmeta wpm'.$i.' ON wpm'.$i.'.post_id = wp.ID AND wpm'.$i.'.meta_key="'.$sf_meta_key.'" '.$sf_condition.'
            ';
            $i++;
         endforeach;
      endif;

      $query .= ' WHERE wp.post_type = "'.$post_type.'" AND wp.post_status="publish" ';
      
    
      //$query .= 'OFFSET '.$rows.' ROWS FETCH NEXT '.$cant.' ROWS ONLY;';
      if(is_numeric($order)): //template
         if($order == "1"):
            $query .= ' ORDER BY STR_TO_DATE( wp.post_date, "%Y-%m-%d" ) DESC ';
         elseif($order == "2"):
            $query .= ' ORDER BY wp.post_title ASC ';
         elseif($order == "3"):
            $query .= ' ORDER BY wp.ID DESC ';
         endif;
      elseif( is_array($order) ): //array, custom order
         $i=1;
         foreach($order as $str_condition):
            $str_condition = str_replace("%meta_key%", 'wpm'.$i.'.meta_key',$str_condition);
            $str_condition = str_replace("%meta_value%", 'wpm'.$i.'.meta_value',$str_condition);
            if($str_condition):
               $query .= ' '.$str_condition;
            endif;
            $i++;
         endforeach;
      else: //custom string
         $query .= ' '.$order;
      endif;

      $total_rows = count($wpdb->get_results($query));

      $query .= ' LIMIT '.$cant.' OFFSET '.$rows;
     
      //var_dump($query);// die();

      $rows = $wpdb->get_results($query);

      return $rows;
   }