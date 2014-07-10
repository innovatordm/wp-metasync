wp-metasync
===========

A friendly little class to synchronize keyed-arrays with WordPress metadata


This class has one purpose. It synchronizes metadata from a keyed array to WordPress metadata system.
It will automatically sync and call the apropriate add_metadata, update_metadata and delete_metadata based on your input

Note: It will not synchronize nested arrays (yet).

Usage: 

```
$fields = array(
    'field_a' => 'My value for field A',
    'field_b' => 'This is for field B',
    'field_c' => NULL // this field will be deleted
);

MetaSync::sync($post_id, $fields);
```

Now the values are stored, non existings keys is removed and pre-existing data is updated. The array is 100% mirrored.

```
Set MetaSync::setDebug() to enable debug output
```
