<?php
function getValueArray($sourceArray, $paramArray, $paramList) {
   $arr = isset($sourceArray[$paramArray])   ? $sourceArray[$paramArray] : null;
   $lst = isset($sourceArray[$paramList])    ? $sourceArray[$paramList]  : null;
   
   $all       = array();
   if ($arr != null) {
       if (is_array($arr)) {
           $all = $arr;
       } else {
           array_push($all, $arr);
       }
   } 
   if ($lst != null) {
      $array = explode(",", $lst);
      $all = array_merge($all, $array);
   } 
   return $all;
}

function isMultipartFormData() {
   if (!isset($_SERVER["CONTENT_TYPE"])) {
        return FALSE;
   } 
   $contentType = $_SERVER["CONTENT_TYPE"];
   $contentType = strtolower($contentType);
   if ($contentType === "multipart/form-data") {
       return TRUE;
   } 
   if (strpos($contentType, "multipart/form-data;") === 0) {
       return TRUE;
   } 
   return FALSE;
}

function completeImage($image, $imageid, $conn) {
    if ($image == null) {
        return null;
    }
    $image["tags"] = array();
    $tagsearchst = $conn->prepare('SELECT t.name name FROM tag t, image_tag it WHERE  it.tagid = t.id AND it.imageid = ? ');
    $tagsearchst->bind_param("i", $imageid);
    $success = $tagsearchst->execute();
    if ($success) {
        $result = $tagsearchst->get_result();
        while ($row = $result->fetch_assoc()) {
            if (isset($row["name"])) {
                array_push($image["tags"], $row["name"]);
            }
        } 
    } 
    $image["senders"] = array();
    $tagsearchst = $conn->prepare('SELECT u.name name FROM user u, image_sender ise WHERE  ise.senderid = u.id AND ise.imageid = ? ');
    $tagsearchst->bind_param("i", $imageid);
    $success = $tagsearchst->execute();
    if ($success) {
        $result = $tagsearchst->get_result();
        while ($row = $result->fetch_assoc()) {
            array_push($image["senders"], $row);
        } 
    } 
    $image["recipients"] = array();
    $tagsearchst = $conn->prepare('SELECT u.name name FROM user u, image_recipient ir WHERE  ir.recipientid = u.id AND ir.imageid = ? ');
    $tagsearchst->bind_param("i", $imageid);
    $success = $tagsearchst->execute();
    if ($success) {
        $result = $tagsearchst->get_result();
        while ($row = $result->fetch_assoc()) {
            array_push($image["recipients"], $row);
        } 
    } 
    return $image;
}

function dropKnownExtensions($file) {
    if ($file == null) {
        return "";
    } 
    $infoarr = pathinfo($file);
    $filename  = isset($infoarr["filename"])  ? $infoarr["filename"]  : "";
    $extension = isset($infoarr["extension"]) ? $infoarr["extension"] : "";
    $ext = strtolower($extension);
    $known = array("png", "jpg", "jpeg", "gif", "svg", "bmp", "tif", "tiff");
    if (in_array($extension, $known)) {
        return $filename;
    } else {
        return $filename . "." . $extension;
    }
} 

function normalizeNameChars($name) {
    if ($name == null || empty($name)) {
        return "";
    }
    $newName = "";
    $arr = str_split($name);
    $allowed = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z",
                     "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z",
                     "1", "2", "3", "4", "5", "6", "7", "8", "9", "0", "-", "_");
    foreach($arr as $chr) {
        if ($chr == ' ' || $chr == "\t" || $chr == "\r" || $chr == "\n") {
            $newName .= "-";
        } else if (in_array($chr, $allowed)) {
            $newName .= $chr;
        } 
    }
    return $newName;
}

function getMimeExtension($mime) {
    $matches = preg_match('/([^\/]*\/)?([^\/;]*)(;.*)?/', $mime, $groups);
    if ($matches && isset($groups[2])) {
        $mime = $groups[2];
    }
    $mime = normalizeNameChars($mime);
    return $mime;
}

function coinUpName($prop) {
    $name = "";
    
    $sendermaxlen = 26;
    $categorymaxlen = 26;
    $mimemaxlen = 26;
    $sizemaxlen = 26;
    $tagsmaxlen = 26;
    $descrmaxlen = 26;
    $filemaxlen  = 26;
    
    $sender   = normalizeNameChars(isset($prop["sender"])      ? $prop["sender"]        : "");
    $category = normalizeNameChars(isset($prop["category"])    ? $prop["category"]      : "");
    $mime     = isset($prop["mime"])        ? $prop["mime"]          : "";
    $size     = normalizeNameChars(isset($prop["size"])        ? $prop["size"]          : "");
    $tags     = isset($prop["tags"])        ? $prop["tags"]          : array();
    $descr    = normalizeNameChars(isset($prop["description"]) ? $prop["description"]   : "");
    $file     = normalizeNameChars(dropKnownExtensions(isset($prop["file"])        ? $prop["file"]          : ""));
    
    $len = strlen($sender);
    if ($len > $sendermaxlen) {
        $sender = substr($sender, 0, $sendermaxlen);
    } else {
        $categorymaxlen += $sendermaxlen - $len;
    }
    $name .= $sender;
    if ($len > 0) {
        $name .= "-";
    } 
    
    $len = strlen($category);
    if ($len > $categorymaxlen) {
        $category = substr($category, 0, $categorymaxlen);
    } else {
        $mimemaxlen += $categorymaxlen - $len;
    }
    $name .= $category;
    if ($len > 0) {
        $name .= "-";
    } 
    
    $mime = getMimeExtension($mime);
    
    $len = strlen($mime);
    if ($len > $mimemaxlen) {
        $mime = substr($mime, 0, $mimemaxlen);
    } else {
        $sizemaxlen += $mimemaxlen - $len;
    }
    $name .= $mime;
    if ($len > 0) {
        $name .= "-";
    }
    
    $len = strlen("" . $size);
    if ($len > $sizemaxlen) {
        $size = substr("".$size, 0, $sizemaxlen);
    } else {
        $tagsmaxlen += $sizemaxlen - $len;
    }
    $name .= $size;
    if ($len > 0) {
        $name .= "-";
    }
    $tagsStr = "";
    if ($tags != null) {
        foreach ($tags as $tag) {
            $tag = normalizeNameChars($tag);
            $tagsStr .= $tag . "-";
        }
    }

    $truncated = false;    
    $len = strlen($tagsStr);
    if ($len > $tagsmaxlen) {
        $tagsStr = substr($tagsStr, 0, $tagsmaxlen);
        $truncated = true;
    } else {
        $descrmaxlen += $tagsmaxlen - $len;
    }
    $name .= $tagsStr;
    if ($truncated) {
        $name .= "-";
    }
    
    $len = strlen($descr);
    if ($len > $descrmaxlen) {
        $descr = substr($descr, 0, $descrmaxlen);
    } else {
        $filemaxlen += $descrmaxlen - $len;
    }
    $name .= $descr;
    if ($len > 0) {
        $name .= "-";
    }
    
    $remaining = 0;
    $len = strlen($file);
    if ($len > $filemaxlen) {
        $file = substr($file, 0, $filemaxlen);
    } else {
        $remaining += $filemaxlen - $len;
    }
    $name .= $file;
    if ($len > 0 && $remaining > 0) {
        $name .= "-";
    }
    
    if ($remaining > 0) {
        $today  = date("Y-m-d-H-i-s-u-e");  
        $random = rand();
        $str = normalizeNameChars($today . "-" . $random);
        $len = strlen($str);
        if ($len > $remaining) {
            $str = substr($str, 0, $remaining);
        }
    } 
    $name .= $str;
    return $name;
}

function saveFileInDataDir($file, $datadir, $prop, $uploader) {
    $category = isset($prop["category"]) ? $prop["category"] : null;
    $mime     = isset($prop["mime"])     ? $prop["mime"] : "";

    $matches = preg_match('/([^\/]*\/)?([^\/;]*)(;.*)?/', $mime, $groups);
    if ($matches && isset($groups[2])) {
        $mime = $groups[2];
    }
    $mime = normalizeNameChars($mime);
    $filename = basename($file);
    $newFile = $datadir;
    if ($category != null) {
        $category = normalizeNameChars($category);
    }
    if ($uploader != null) {
       $uploader = normalizeNameChars($uploader);
    }
    if ($uploader != null) {
        $newFile .= "/".$uploader;
    } else {
        $newFile .= "/anonymous";
    }
    if ($category != null && !empty($category)) {
        $newFile .= "/".$category;
    } else {
        $newFile .= "/uncategorized";
    }
    if ($mime != null && !empty($mime)) {
        $newFile .= "/".$mime;
    } else {
        $newFile .= "/unknown";
    }
    if (!file_exists($newFile)) {
        $created = mkdir($newFile, 0770, true);
        if (!$created) {
            throw new Exception("Cannot find store file. Internal Error CD.");
        } 
    } 
    $testFile = $newFile . "/" .$filename;
    $trys = 100;
    while(file_exists($testFile) && $trys > 0) {
        $trys--;
        $testFile = $newFile . "/" . coinUpName($prop) . (empty($mime)? "" : ".".$mime);
    }
    if ($trys <= 0) {
        throw new Exception("Cannot find free storage name. Internal Error CC.");
    }
    $newFile = $testFile;
    $renamed = rename($file, $newFile);
    if (!$renamed) {
        $copied = copy($file, $newFile);
        if (!$copied) {
            throw new Exception("Cannot find free storage name. Internal Error CE.");
        } 
    } 
    return $newFile;
} 

?>
