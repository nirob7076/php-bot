<?php
$db = new PDO('sqlite:database.sqlite');
$now = date('Y-m-d H:i:s');

// যেসব প্রজেক্টের মেয়াদ শেষ, সেগুলো খুঁজে বের করা
$stmt = $db->prepare("SELECT * FROM deployments WHERE expires_at <= ?");
$stmt->execute([$now]);
$expired_projects = $stmt->fetchAll();

foreach($expired_projects as $project) {
    $folder_path = $project['folder_path'];
    
    // হোস্টিং থেকে ফোল্ডার এবং ভেতরের কোডিং/ফাইল ডিলিট করা
    deleteDirectory($folder_path);

    // ডাটাবেস থেকে ইউজারের রেকর্ড ডিলিট করা
    $db->exec("DELETE FROM deployments WHERE id = " . $project['id']);
}

echo "Cleanup Process Completed.";

// ফোল্ডার ও ফাইল ডিলিট করার ফাংশন
function deleteDirectory($dir) {
    if (!file_exists($dir)) return true;
    if (!is_dir($dir)) return unlink($dir);
    
    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') continue;
        if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) return false;
    }
    return rmdir($dir);
}
?>
