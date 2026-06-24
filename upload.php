<?php
// SQLite ডাটাবেস কানেকশন এবং টেবিল তৈরি
$db = new PDO('sqlite:database.sqlite');
$db->exec("CREATE TABLE IF NOT EXISTS deployments (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT,
    folder_path TEXT,
    expires_at DATETIME
)");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // ইউজারের নাম ক্লিন করা (যাতে স্পেস বা স্পেশাল ক্যারেক্টার না থাকে)
    $username = preg_replace('/[^a-zA-Z0-9_-]/', '', $_POST['username']);
    
    if(empty($username)) {
        die("<h2 style='color:red;'>Invalid Username!</h2>");
    }

    // ইউনিক ফোল্ডার তৈরি (ইউজারনেম + টাইমস্ট্যাম্প)
    $folder_name = $username . '_' . time();
    $target_dir = "hosts/" . $folder_name . "/";

    if(!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // ফাইল দুটি আপলোড করা
    $file1 = $_FILES['file1']['name'];
    $file2 = $_FILES['file2']['name'];

    move_uploaded_file($_FILES['file1']['tmp_name'], $target_dir . $file1);
    move_uploaded_file($_FILES['file2']['tmp_name'], $target_dir . $file2);

    // ২৪ ঘণ্টা পরের সময় নির্ধারণ
    $expires_at = date('Y-m-d H:i:s', strtotime('+24 hours'));

    // SQLite-এ তথ্য সেভ করা
    $stmt = $db->prepare("INSERT INTO deployments (username, folder_path, expires_at) VALUES (?, ?, ?)");
    $stmt->execute([$username, $target_dir, $expires_at]);

    // লাইভ ওয়েবসাইটের লিংক তৈরি
    $live_url = "http://" . $_SERVER['HTTP_HOST'] . "/" . $target_dir;

    // সাকসেস পেজ দেখানো
    echo "
    <div style='background:#000; color:#fff; height:100vh; display:flex; flex-direction:column; align-items:center; justify-content:center; font-family:sans-serif;'>
        <h1 style='color:#4ade80;'>✅ Deployment Successful!</h1>
        <p style='color:#aaa;'>আপনার ওয়েবসাইট সফলভাবে হোস্ট করা হয়েছে এবং ২৪ ঘণ্টা পর মুছে যাবে।</p>
        <div style='margin-top:20px; padding:20px; background:#111; border:1px solid #333; border-radius:10px;'>
            <p>আপনার লাইভ লিংক:</p>
            <a href='{$live_url}' target='_blank' style='color:#60a5fa; font-size:20px; text-decoration:none;'>{$live_url}</a>
        </div>
        <a href='index.php' style='margin-top:30px; color:#fff; text-decoration:underline;'>Go Back</a>
    </div>
    ";
}
?>
