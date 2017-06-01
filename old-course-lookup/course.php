<?php
    //print $argv[1] . " " . $argv[2];
    if(count($argv)<2) {
        print "no command given, try import or lookup\n";
    }
    elseif($argv[1]==='import') {
        
        $db = new SQLite3('courses.db');
        $create_table = $db->query("CREATE TABLE Classes (department TEXT, subject TEXT, bulletin_prefix TEXT, course_number TEXT, name TEXT, min_points INTEGER, max_points INTEGER)");
        
        if(!$create_table) {
            echo $db->lastErrorMsg();
        } else {
            echo "Table created successfully\n";
        }
        
        $file = fopen('courses.csv', 'r');
        
        while(($line = fgetcsv($file)) !== false) {
            
            $name = str_replace("'", "''", $line[4]);
            $min_points = (int)$line[5];
            $max_points = (int)$line[6];
            $query = $db->query("INSERT INTO Classes VALUES ('$line[0]','$line[1]', '$line[2]', '$line[3]', '$name', $min_points, $max_points)");
            
            if(!$query) {
                print $line[0] ." ". $line[1] ." ". $line[2] ." ". $line[3] ." ". $line[4] ." ". $line[5] . " " . $line[6] . "\n";
                echo $db->lastErrorMsg(); 
            } else {
                //print "successful";
            }
        }
        
        print "Successfully imported courses\n";
        
        $db->close();
        fclose($file);
    }
    elseif($argv[1]==='lookup') {        
        $term = explode(" ", $argv[2]);
        $subject = $term[0];
        
        if($term[1] > 5) {
            $pref_length = 2;
        } else {
            $pref_length = 1;
        }
        
        $prefix = substr($term[1], 0, $pref_length);
        $number = substr($term[1], $pref_length, 4);
        
        $db = new SQLite3('courses.db');
        $query = "SELECT * FROM Classes WHERE subject LIKE '$subject' AND bulletin_prefix LIKE '$prefix' AND course_number LIKE '$number'";
        
        $result = $db->query($query);

        if(!$result->fetchArray()) {
            print "The course $argv[2] was not found\n";
        } else {  
            $cols = $result->numColumns();
            $result->reset();
            while($row = $result->fetchArray()) {
                for($i = 1; $i < $cols; $i++) {
                    echo $result->columnName($i) . ': ';
                    echo $row[$i] . "\n";
                }
            }
            $db->close();
        }

    }

    elseif($argv[1]==='stats') {
        $db = new SQLite3('courses.db');
        $result = $db->query("SELECT department, count(*) FROM Classes GROUP BY department ORDER BY count(*) DESC");
        
        print "Departments with most courses\n";
        $i = 0;
        while($i<5) {
            $row = $result->fetchArray();
            echo $row[0] . "        " . $row[1] ,"\n";
            $i++;
        }
        
        $result2 = $db->query("SELECT name FROM Classes");
        $words = array();
        while($row=$result2->fetchArray()) {
            
            $strings = explode(" ", strtolower($row[0]));
            
            foreach($strings as $string) {
                if(!array_key_exists($string, $words)) {
                    $words[$string] = 1;
                } else {
                    $words[$string] = $words[$string] + 1;   
                }
            } 
        }

        print "\nTop ten most used words\n";
        
        arsort($words);
        $i = 0;
        while($i<10) {
            $row = each($words);
            print "$row[0]        $row[1]\n";
            $i++;
        }
            
        $db->close();
    }
    


?>
