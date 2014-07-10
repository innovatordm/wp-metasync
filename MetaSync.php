<?php
/*

Author: Innovator Digital Markets AB
Webpage: http://www.innovator.se
Licence: MIT


This class has one purpose. It synchronizes metadata from a keyed array to WordPress metadata system.
It will automatically sync and call the apropriate add_metadata, update_metadata and delete_metadata based on your input

Note: It will not synchronize nested arrays (yet).

Usage: 

$fields = array(
    'field_a' => 'My value for field A',
    'field_b' => 'This is for field B',
    'field_c' => NULL // this field will be deleted
);

MetaSync::sync($post_id, $fields);

Now the values are stored, non existings keys is removed and pre-existing data is updated. The array is 100% mirrored.

Set MetaSync::setDebug() to enable debug output

*/


class MetaSync{
    
    public static function setDebug($enable = true){
        self::$debug = $enable;
    }
    
    public static $debug = false;
 
    public static function sync($post_id, $fields){     
                
        $existing_meta = get_post_custom($post_id);      
        
        // delete non-existing keys
        $keys_to_delete = array_search(NULL, $fields);   
                
        if($keys_to_delete)
        {
            foreach($keys_to_delete as $key => $value){

                if(self::$debug)
                    echo "deleting $post_id, $key \n";

                delete_post_meta($post_id, $key);
            }
        }
        unset($keys_to_delete, $key, $value);
        
        // update existing
        $existing = array_intersect_key($fields, $existing_meta);        
        foreach($existing as $key => $value){
            
            if(self::$debug)
                echo "updating $post_id, $key, $fields[$key] \n";
            
            update_post_meta($post_id, $key, $fields[$key]);
        }
        unset($existing, $key, $value);
        
        // add new
        $new = array_diff_key($fields, $existing_meta);
        foreach($new as $key => $value){
            
                        
            if(self::$debug)
                echo "adding $post_id, $key, {$fields[$key]} \n";
            
            add_post_meta($post_id, $key, $fields[$key]);
        }
        unset($existing, $key, $value);
        
        // cleanup
        unset($existing_meta);
    }
    
    
}



?>
